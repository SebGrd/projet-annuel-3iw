<?php

namespace App\Core;

class InitDatabase
{
    public static function clearLastname($lastname)
    {
        return mb_strtoupper(trim($lastname));
    }
}
try
{
    $mysqli = new \mysqli(DBHOST, DBUSER, DBPWD);
}
catch (\Exception $e)
{
    echo $e->getMessage(), PHP_EOL;
}

if ($mysqli->select_db(DBNAME) === false)
    $database = false;
else
    $database = true;

// Connexion
$bdd = new \PDO('mysql:host='.DBHOST, DBUSER, DBPASS);
$bdd->setAttribute(\PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
// Création de la base de donnéees 'mediatheque' à moins qu'elle n'existe ou plutôt si elle n'existe pas
$sql = "CREATE DATABASE IF NOT EXISTS mediatheque CHARACTER SET 'utf8';";
// Aucun retour de résultat
$bdd->exec($sql);
if (!($database)) {
    echo "<script>alert('Database just created');</script>";
    Import();
}
// Déconnexion
$bdd = null;

function Import()
{
    // Importation des tables de la base 'mediatheque'
    $filename = 'database.sql';

    // Connexion
    $bdd = new PDO('mysql:host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
    // Variable temporaire stockant la requête (ligne par ligne)
    $templine = '';
    // Lecture entière du fichier
    $lines = file($filename);
    // Boucle à travers chaque ligne
    foreach ($lines as $line){
        // Passage à la ligne suivante si c'est un commentaire (sauf les commentaires de ce type : '/* */')
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Ajout ou concaténation de la ligne au segment actuel
        $templine .= $line;
        // Détection de fin de ligne avec le point-virgule
        if (substr(trim($line), -1, 1) == ';')
        {
            // Exécution de la requête
            $bdd->exec($templine);
            // Réinitialisation de la variable temporaire
            $templine = '';
        }
    }
    // Déconnexion
    $bdd = null;
}

function createTables() {

}

// Connexion
$bdd = new PDO('mysql:host=localhost; dbname=mediatheque', 'root', '');
// Insertion d'un compte admin à titre d'exemple
$sql = "INSERT IGNORE INTO users VALUES ('1', 'Media', 'Theque', 'root', '1999-12-23', '23 rue des Medias, 95 023 Film-sur-Scene', 'media@theque.com', '0123121999', 'A', CURRENT_TIMESTAMP);";
// Aucun retour de résultat
$bdd->exec($sql);
// Déconnexion
$bdd = null;

?>
