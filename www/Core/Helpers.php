<?php

namespace App\Core;
use App\Core\View;
use App\Models\Image;
use App\Core\PHPMailer\PHPMailer;

class Helpers {
	public static function clearLastname($lastname) {
		return mb_strtoupper(trim($lastname));
	}

	public static function render($view) {
		$view = str_replace('.', '/', $view);
		include "Views/$view.view.php";
		// $view = new View($view, $template ?? 'front');
	}

	public static function v($view) {
		$view = str_replace('.', '/', $view);
		// include "Views/$view.view.php";
		$view = new View($view, $template ?? 'front');
	}

	public static function dump($dump) {
		echo '<pre>' . print_r($dump) . '</pre>';
	}
	
	public static function err($errors) {
		$var = '';
		foreach ($errors as $error) {
			$var .= "<li style='color: red;'>$error</li>";
		}
		return $var;
	}

	/**
	 * @param string $directory, name of the directory to store the files, if none given it will be uploaded to the root of uploads
	 * @param array $allowTypes, pass in the authorized allowTypes. ex: ['jpg' => 'image/jpeg'], by default it's 'jpg','png','jpeg','gif'
	 * @return int|string|bool returns the user_id if upload is successfull, returns a string message if there is an error, returns false if no file is passed in.
	 */
	public static function upload(string $directory = '', array $allowTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif']) {
		
		// Undefined | Multiple Files | $_FILES Corruption Attack
		// If this request falls under any of them, treat it invalid.
		if (!isset($_FILES['upfile']['error'])) {
			return false;
		}
		
		if (is_array($_FILES['upfile']['error'])) {
			return ['error' => "Paramètres invalides."];
		}

		$path = 'uploads/' . $directory . '/';
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		$targetDir = $path;
		$fileName = basename($_FILES['upfile']['tmp_name']);
		$targetFilePath = $targetDir . date("Y-m-d_H-i-s") . "_" . $fileName;
	
		// Check $_FILES['upfile']['error'] value.
		switch ($_FILES['upfile']['error']) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_NO_FILE:
				return false;
			case UPLOAD_ERR_INI_SIZE:
			case UPLOAD_ERR_FORM_SIZE:
				return ['error' => "Taille maximale dépassée."];
			default:
			return ['error' => "Erreur inconnue."];
		}
	
		// You should also check filesize here.
		if ($_FILES['upfile']['size'] > 1000000) {
			return ['error' => "Taille maximale dépassée."];
		}
	
		// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
		// Check MIME Type by yourself.
		$finfo = new \finfo(FILEINFO_MIME_TYPE);
		if (false === $ext = array_search(
			$finfo->file($_FILES['upfile']['tmp_name']),
			$allowTypes,
			true )) {
			return ['error' => "Format du fichier invalide."];
		}
	
		// You should name it uniquely.
		// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
		// On this example, obtain safe unique name from its binary data.
		if (!move_uploaded_file(
			$_FILES['upfile']['tmp_name'],
			sprintf('./uploads/' . $directory . '/%s.%s',
				date("Y-m-d_H-i-s") . "_" . $fileName,
				$ext
			)
		)) {
			return ['error' => "Désolé, une erreur s'est produite lors du téléchargement du fichier."];
		}
		$image = new Image();
		$url = $targetFilePath . '.' . $ext;
		// Insert image file name with path into database
		$image->setFile_name($url);
		$image->setUser_id(get_object_vars($_SESSION['userStore'])['id']);
		$image->save();

		$image->find(['file_name' => $url]);

		if($image->getId() !== null){
			return $image->getId();
		}else{
			return ['error' => "Erreur lors de l'envoi du fichier, merci de réessayer."];
		}
	}

	// This function takes the last comma or dot (if any) to make a clean float, ignoring thousand separator, currency or any other letter :
	public static function tofloat($num) {
		$dotPos = strrpos($num, '.');
		$commaPos = strrpos($num, ',');
		$sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
			((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

		if (!$sep) {
			return floatval(preg_replace("/[^0-9]/", "", $num));
		}

		return floatval(
			preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
			preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
		);
	}

	public static function getImageUrl(int $image_id) {
		$id = htmlspecialchars( strip_tags( $image_id ) );
		$image = new Image();
		$image->find(['id' => $id]);
		$url = $image !== null ? $image->getFile_name() : '';
		return $url;
	}

	public static function mailer(array $from, array $to, string $subject, array $template_params, array $template_replace, bool $isHTML = true, string $body_template) {
		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->Encoding = 'base64';
		$mail->SMTPAuth = true;
		$mail->Host = MAIL_HOST;
		$mail->Port = MAIL_PORT;
		$mail->Username = MAIL_USERNAME;
		$mail->Password = MAIL_PASSWORD;
		$mail->SMTPSecure = 'tls';
		$mail->isHTML($isHTML);

		$mail->setFrom($from['email'], $from['name']);
		$mail->addAddress($to['email'], $to['name']);

		$mail->Subject = $subject;

		$message = str_replace(
			$template_params,
			$template_replace,
			file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Views/Emails/' . $body_template . '.php')
		);
		$mail->msgHTML($message);

		if ($mail->send()) {
			return ['error' => false];
		} else {
			return ['error' => true, 'error_message' => $mail->ErrorInfo];
		}
	}
}
