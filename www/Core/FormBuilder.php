<?php

namespace App\Core;

class FormBuilder {
	public static function render($form) {
		$html = "<form 
			method='".($form["config"]["method"]??"GET")."' 
			id='".($form["config"]["id"]??"")."' 
			class='".($form["config"]["class"]??"")."' 
			action='".($form["config"]["action"]??"")."'
			enctype='".($form["config"]["enctype"]??"")."'>";

		foreach ($form['inputs'] as $name => $configInput) {
			$html .= "<div class='form__field flex flex-col'>";
			$html .= "<label class='form__field__label' for='".($configInput["id"]??"")."'>".($configInput["label"]??"")." </label>";

			if ($configInput["type"] == "select"){
				$html .= self::renderSelect($name, $configInput);
			} else if ($configInput["type"] == "checkbox") {
				$html .= self::renderCheckbox($name, $configInput);
			} else {
				$html .= self::renderInput($name, $configInput);
			}
			$html .= "</div>";
		}

		$html .= "<input class='btn btn-primary w-100' type='submit' value=\"".($form["config"]["submit"]??"Valider")."\">";
		$html .= '</form>';
		echo $html;
	}

	public static function renderInput($name, $configInput) {
		return "<input 
			name='".($configInput["name"]??$name)."' 
			type='".($configInput["type"]??"text")."'
			id='".($configInput["id"]??"")."'
			class='form__field__input ".($configInput["class"]??"")."'
			placeholder='".($configInput["placeholder"]??"")."'
			value='".($configInput["value"]??"")."'
			".(!empty($configInput["required"])?"required='required'":"")."><br>";
	}

	public static function renderSelect($name, $configInput) {
		$html = "<select 
			name='".$name."' id='".($configInput["id"]??"")."'
			class='form__field__input ".($configInput["class"]??"")."'>";

		foreach ($configInput["options"] as $key => $value) {
			$html .= "<option value='".$key."'>".$value."</option>";
		}

		$html .= "</select>";
		return $html;
	}

	public static function renderCheckbox($name, $configInput) {
		return "<input 
			name='".($configInput["name"]??$name)."'
			type='".($configInput["type"]??"text")."'
			".($configInput["value"] === 1 ? "checked" : "")." 
			class='form__field__input ".($configInput["class"]??"")."'><br>";
	}
}