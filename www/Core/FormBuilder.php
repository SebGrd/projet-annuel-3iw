<?php

namespace App\Core;

class FormBuilder {
	public static function render($form) {
		$html = "<form 
			method='".($form["config"]["method"]??"GET")."' 
			id='".($form["config"]["id"]??"")."' 
			class='".($form["config"]["class"]??"")."' 
			action='".($form["config"]["action"]??"")."'>";

		foreach ($form["inputs"] as $name => $configInput) {
		    $html .= "<div class='form__field'>";
			$html .="<label class='form__field__label' for='".($configInput["id"]??"")."'>".($configInput["label"]??"")." </label>";

			if($configInput["type"] == "select") {
				$html .= self::renderSelect($name, $configInput);
			} else {
				$html .= self::renderInput($name, $configInput);
			}
			$html .= "</div>";
		}

		$html .= "<input class='btn btn-primary' type='submit' value=\"".($form["config"]["submit"]??"Valider")."\">";
		$html .= '</form>';
		echo $html;
	}

	public static function renderInput($name, $configInput) {
		return "<input 
			class='form__field__input'
			name='".$name."' 
			type='".($configInput["type"]??"text")."'
			id='".($configInput["id"]??"")."'
			class='".($configInput["class"]??"")."'
			placeholder='".($configInput["placeholder"]??"")."'
			".(!empty($configInput["required"])?"required='required'":"")."><br>";
	}

	public static function renderSelect($name, $configInput) {
		$html = "<select 
			class='form__field__input'
			name='".$name."' id='".($configInput["id"]??"")."'
			class='".($configInput["class"]??"")."'>";

		foreach ($configInput["options"] as $key => $value) {
			$html .= "<option value='".$key."'>".$value."</option>";
		}

		$html .= "</select>";
		return $html;
	}
}