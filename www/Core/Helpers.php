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
	 * @param array $file, pass in the file. ex: $_FILES["input name"]
	 * @param array $allowTypes, pass in the authorized allowTypes. ex: ['pdf', 'png', 'jpeg'], by default it's 'jpg','png','jpeg','gif'
	 * @return int|string|bool returns the user_id if upload is successfull, returns a string message if there is an error, returns false if no file is passed in.
	 */
	public static function upload(string $directory = '', array $file, array $allowTypes = ['jpg','png','jpeg','gif']) {
		$statusMsg = '';
		$path = 'uploads/' . $directory . '/';
		if (!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		$targetDir = $path;
		$fileName = basename($file["name"]);
		$targetFilePath = $targetDir . date("Y-m-d_H:i:s") . "_" . $fileName;
		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

		if(!empty($file["name"])){
			$image = new Image();

			if (!file_exists($targetFilePath)) {
				if(in_array($fileType, $allowTypes)){
					// Upload file to the server
					if(move_uploaded_file($file["tmp_name"], $targetFilePath)){
						// Insert image file name with path into database
						$image->setFile_name($targetFilePath);
						$image->setUser_id(get_object_vars($_SESSION['userStore'])['id']);
						$image->save();

						$image->find(['file_name' => $targetFilePath]);

						if($image->getId() !== null){
							$statusMsg = "Le fichier <b>".$fileName. "</b> a bien été envoyé.";
							return $image->getId();
						}else{
							$statusMsg = "Erreur lors de l'envoi du fichier, merci de réessayer.";
						} 
					}else{
						$statusMsg = "Désolé, une erreur s'est produite lors du téléchargement du fichier.";
					}
				}else{
					$statusMsg = "Seuls les formats suivant sont autorisés : " . implode(', ', $allowTypes);
				}
			}else{
				$statusMsg = "Le fichier <b>".$fileName. "</b> existe déjà.";
			}
			return ['error' => $statusMsg];
		}
		return false;
	}
}