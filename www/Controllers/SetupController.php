<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Database;
use App\Core\PHPMailer\PHPMailer;
use App\Models\User;
use App\Core\ConstantMaker;

class SetupController {

  public function default() {
		$view = new View('install', 'blank');
    $first_step = $this->formTables();
    $second_step = $this->formSMTP();
    $third_step = $this->formSite();

    if (!isset($_SESSION['step'])) $_SESSION['step'] = 1;

    if (!empty($_POST) && $_SESSION['step'] == 1) {
      // Step one, verify database connection and store it in the .env
      $dbname = htmlspecialchars(strip_tags($_POST['dbname']));
      $username = htmlspecialchars(strip_tags($_POST['username']));
      $password = htmlspecialchars(strip_tags($_POST['password']));
      $dbhost = htmlspecialchars(strip_tags($_POST['dbhost']));
      $dbhost = str_replace(['http://', 'https://', '/'], '', $dbhost);
      $dbport = htmlspecialchars(strip_tags($_POST['dbport']));
      $prefix = htmlspecialchars(strip_tags($_POST['prefix']));
      $envs = ['DBHOST'=>$dbhost, 'DBNAME'=>$dbname, 'DBUSER'=>$username, 'DBPWD'=>$password, 'DBPORT'=>$dbport, 'DBPREFIXE'=>$prefix, 'SALT'=>$this->generateRandomString(20)];

      // Save the new constants
      $this->saveDotenv($envs);
      // Define the new constants
      $cst = new ConstantMaker();

      try {
        $this->pdo = new \PDO(DBDRIVER . ':dbname=' . $dbname . ';host=' . $dbhost . ';port=' . $dbport, $username, $password);
  
        if (ENV == 'dev') {
          $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
          $this->pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }

        // Create the tables and foreign keys
        $db = new Database;
        $db->createTables();
        $db->createForeignKeys();

        $view->assign('success', 'Connexion à la base de données réussie, création des tables réussie.');
        unset($_POST);
        $_SESSION['step'] = 2;
      } catch (\Exception $e) {
        $view->assign('errors', ['Connexion à la base de données impossible, verifiez vos informations de connexion.']);
      }
    }

    if (!empty($_POST) && $_SESSION['step'] == 2) {
      // Check SMTP connection and store it in the .env
      $username = htmlspecialchars(strip_tags($_POST['username']));
      $password = htmlspecialchars(strip_tags($_POST['password']));
      $email = htmlspecialchars(strip_tags($_POST['email']));
      $name = htmlspecialchars(strip_tags($_POST['name']));
      $smtpHost = htmlspecialchars(strip_tags($_POST['smtpHost']));
      $smtpHost = str_replace(['http://', 'https://', '/'], '', $smtpHost);
      $smtpPort = htmlspecialchars(strip_tags($_POST['smtpPort']));
      $secure = htmlspecialchars(strip_tags($_POST['secure']));
      $envs = ['MAIL_HOST'=>$smtpHost, 'MAIL_PORT'=>$smtpPort, 'MAIL_USERNAME'=>$username, 'MAIL_PASSWORD'=>$password, 'MAIL_SENDER'=>$email, 'MAIL_NAME'=>$name];

      try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPAuth = true;
        $mail->Host = $smtpHost;
        $mail->Port = $smtpPort;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = $secure !== 'aucun' ? $secure : '';
        // This function returns TRUE if authentication was successful, or throws an exception otherwise
        $validCredentials = $mail->SmtpConnect();

        if ($validCredentials === true) {
          $view->assign('success', 'Connexion au serveur SMTP réussi.');
          $this->saveDotenv($envs);
          // Define the new constants
          $cst = new ConstantMaker();
          unset($_POST);
          $_SESSION['step'] = 3;
        }

      } catch (\Exception $e) {
        $view->assign('errors', ['Connexion au serveur SMTP impossible, verifiez vos informations de connexion.']); 
      }
    }

    if (!empty($_POST) && $_SESSION['step'] == 3) {
      // Fill out general website informations, and create the admin user
      $firstname = htmlspecialchars(strip_tags($_POST['firstname']));
      $lastname = htmlspecialchars(strip_tags($_POST['lastname']));
      $password = htmlspecialchars(strip_tags($_POST['password']));
      $email = htmlspecialchars(strip_tags($_POST['email']));
      $siteTitle = htmlspecialchars(strip_tags($_POST['siteTitle']));
      $indexVisibility = isset($_POST['indexVisibility']) ? 'true' : 'false';

      $envs = ['APPNAME'=>$siteTitle, 'INDEX_VISIBILITY'=>$indexVisibility, 'SETUP_TERMINATED'=>'true'];
      $hashed_password = crypt($password, '$5$rounds=6666$'.SALT.'$');

      $user = new User();
      $user->setEmail($email);
      $user->setFirstname($firstname);
      $user->setLastname($lastname);
      $user->setPwd($hashed_password);
      $user->setRole('admin');
      $user->save();

      $view->assign('success', 'Vous allez maintenant être redirigé sur la page de connexion.');
      $this->saveDotenv($envs);
      // Define the new constants
      $cst = new ConstantMaker();
      unset($_POST);
      header('Refresh:3; url=/login', true, 303);
    }

    switch ($_SESSION['step']) {
      case 1:
        $view->assign('form', $first_step);
        break;
      case 2:
        $view->assign('form', $second_step);
        break;
      case 3:
        $view->assign('form', $third_step);
        break;
    }
  }

  public function saveDotenv(array $envs) {
    $file = dirname(__DIR__, 1) . '/.env.' . ENV;
    $fp = fopen($file, 'a+');
    foreach ($envs as $key => $env) {
      fwrite($fp, $key.'='.$env."\n");
    }
    fwrite($fp, "\n");
    fclose($fp);
    return true;
  }

  function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function formTables() {
    return [
      'config'=>[
        'method'=>'POST',
        'action'=>'',
        'id'=>'formTables',
        'class'=>'form_builder',
        'submit'=>'Enregistrer'
      ],
      'inputs'=>[
        'dbname'=>[
          'type'=>'text',
          'label'=>'Nom de la base de données',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'dbname',
          'class'=>'form_input w-2',
          'placeholder'=>'Le nom de la base de données que vous souhaitez utiliser.',
          'error'=>'Le nom de la base de données obligatoire',
          'value'=>"",
          'required'=>true
        ],
        'username'=>[ 
          'type'=>'text',
          'label'=>'Identifiant',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'username',
          'class'=>'form_input w-2',
          'placeholder'=>'Votre identifiant.',
          'error'=>'Identifiant obligatoire',
          'required'=>true
        ],
        'password'=>[
          'type'=>'password',
          'label'=>'Mot de passe',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'password',
          'class'=>'form_input w-2',
          'placeholder'=>'Votre mot de passe.',
          'error'=>'Mot de passe obligatoire',
          'required'=>true
        ],
        'dbhost'=>[
          'type'=>'text',
          'label'=>'Hôte de la base de données',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'dbhost',
          'class'=>'form_input w-2',
          'placeholder'=>'Url de la base de données, si localhost ne fonctionne pas.',
          'error'=>'Adresse hôte obligatoire',
          'required'=>true
        ],
        'dbport'=>[
          'type'=>'text',
          'label'=>'Port de la base de données',
          'minLength'=>2,
          'maxLength'=>5,
          'id'=>'dbport',
          'class'=>'form_input w-2',
          'placeholder'=>'Port de la base de données, par défaut 3306.',
          'value'=>'3306',
          'error'=>'Adresse hôte obligatoire',
          'required'=>true
        ],
        'prefix'=>[
          'type'=>'text',
          'label'=>'Préfix de table',
          'minLength'=>1,
          'maxLength'=>20,
          'id'=>'prefix',
          'class'=>'form_input w-2',
          'placeholder'=>'Si vous souhaitez lancer plusieurs instances sur la même base de données, changez le préfix.',
          'error'=>'Adresse hôte obligatoire',
          'value'=>'gojs_',
          'required'=>true
        ]
      ]
    ];
  }

  public function formSMTP() {
    return [
      'config'=>[
        'method'=>'POST',
        'action'=>'',
        'id'=>'formSMTP',
        'class'=>'form_builder',
        'submit'=>'Enregistrer'
      ],
      'inputs'=>[
        'smtpHost'=>[
          'type'=>'text',
          'label'=>'Hôte du serveur SMTP',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'smtpHost',
          'class'=>'form_input w-2',
          'placeholder'=>'Url du serveur SMTP que vous souhaitez utiliser.',
          'error'=>'Url du serveur SMTP obligatoire',
          'value'=>"",
          'required'=>true
        ],
        'smtpPort'=>[
          'type'=>'text',
          'label'=>'Port du serveur SMTP',
          'minLength'=>2,
          'maxLength'=>5,
          'id'=>'smtpPort',
          'class'=>'form_input w-2',
          'placeholder'=>'Port du serveur SMTP.',
          'error'=>'Port SMTP obligatoire',
          'required'=>true
        ],
        'username'=>[ 
          'type'=>'text',
          'label'=>'Identifiant',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'username',
          'class'=>'form_input w-2',
          'placeholder'=>'Votre identifiant.',
          'error'=>'Identifiant obligatoire',
          'required'=>true
        ],
        'password'=>[
          'type'=>'password',
          'label'=>'Mot de passe',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'password',
          'class'=>'form_input w-2',
          'placeholder'=>'Votre mot de passe.',
          'error'=>'Mot de passe obligatoire',
          'required'=>true
        ],
        'email'=>[
          'type'=>'email',
          'label'=>'Email',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'email',
          'class'=>'form_input w-2',
          'placeholder'=>'Votre email.',
          'error'=>'Email obligatoire',
          'required'=>true
        ],
        'name'=>[
          'type'=>'text',
          'label'=>'Nom',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'name',
          'class'=>'form_input w-2',
          'placeholder'=>'Nom affiché.',
          'error'=>'Nom obligatoire',
          'required'=>true
        ],
        'secure'=>[
          'type'=>'select',
          'label'=>'Utiliser TLS ou SSL (optionnel)',
          'id'=>'secure',
          'class'=>'form_input w-2',
          'options'=>['aucun', 'tls', 'ssl'],
          'error'=>'Port SMTP obligatoire',
          'required'=>true
        ],
      ]
    ];
  }

  public function formSite() {
    return [
      'config'=>[
        'method'=>'POST',
        'action'=>'',
        'id'=>'formSite',
        'class'=>'form_builder',
        'submit'=>'Enregistrer'
      ],
      'inputs'=>[
        'siteTitle'=>[
          'type'=>'text',
          'label'=>'Titre du site',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'siteTitle',
          'class'=>'form_input w-2',
          'placeholder'=>'',
          'error'=>'Titre obligatoire.',
          'value'=>"",
          'required'=>true
        ],
        'firstname'=>[
          'type'=>'text',
          'label'=>'Prénom',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'firstname',
          'class'=>'form_input w-2',
          'placeholder'=>'',
          'error'=>'Prénom obligatoire.',
          'value'=>"",
          'required'=>true
        ],
        'lastname'=>[
          'type'=>'text',
          'label'=>'Nom',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'lastname',
          'class'=>'form_input w-2',
          'placeholder'=>'',
          'error'=>'Nom obligatoire.',
          'value'=>"",
          'required'=>true
        ],
        'email'=>[
          'type'=>'email',
          'label'=>'Email',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'email',
          'class'=>'form_input w-2',
          'placeholder'=>'Votre email.',
          'error'=>'Email obligatoire',
          'required'=>true
        ],
        'password'=>[
          'type'=>'password',
          'label'=>'Mot de passe',
          'minLength'=>2,
          'maxLength'=>255,
          'id'=>'password',
          'class'=>'form_input w-2',
          'placeholder'=>'Votre mot de passe.',
          'error'=>'Mot de passe obligatoire',
          'required'=>true
        ],
        'indexVisibility'=>[
          'type'=>'checkbox',
          'name'=>'indexVisibility',
          'label'=>'Visibilité des moteurs de recherche',
          'class'=>'form_input',
          'value'=>'1'
        ],
      ]
    ];
  }

}