<?php

namespace App\Core;
use App\Core\View;
use App\Models\Image;

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
		$path = 'uploads/' . $directory . '/';
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		$targetDir = $path;
		$fileName = basename($_FILES['upfile']['tmp_name']);
		$targetFilePath = $targetDir . date("Y-m-d_H:i:s") . "_" . $fileName;

		// Undefined | Multiple Files | $_FILES Corruption Attack
		// If this request falls under any of them, treat it invalid.
		if (!isset($_FILES['upfile']['error']) ||
			is_array($_FILES['upfile']['error'])
		) {
			return ['error' => "Paramètres invalides."];
		}
	
		// Check $_FILES['upfile']['error'] value.
		switch ($_FILES['upfile']['error']) {
			case UPLOAD_ERR_OK:
				break;
			case UPLOAD_ERR_NO_FILE:
				return ['error' => "Aucun fichier envoyé."];
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
				date("Y-m-d_H:i:s") . "_" . $fileName,
				$ext
			)
		)) {
			return ['error' => "Désolé, une erreur s'est produite lors du téléchargement du fichier."];
		}
		$image = new Image();
		// Insert image file name with path into database
		$image->setFile_name($targetFilePath);
		$image->setUser_id(get_object_vars($_SESSION['userStore'])['id']);
		$image->save();

		$image->find(['file_name' => $targetFilePath]);

		if($image->getId() !== null){
			return $image->getId();
		}else{
			return ['error' => "Erreur lors de l'envoi du fichier, merci de réessayer."];
		}
	}
}
