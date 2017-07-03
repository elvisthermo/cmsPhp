<?php

	$errors = array();

	// substitui "_" por espaços em branco
	// depois coloca as primeiras letras em maiúsculas
	function fieldname_as_text($fieldname) {
	  $fieldname = str_replace("_", " ", $fieldname);
	  $fieldname = ucfirst($fieldname);
	  return $fieldname;
	}

	// validar presença de valor
	function has_presence($value) {
		return isset($value) && $value !== "";
	}

	// validar campo preenchido
	function validate_presences($required_fields) {
	  global $errors;
	  foreach($required_fields as $field) {
	    $value = trim($_POST[$field]);
	  	if (!has_presence($value)) {
	  		$errors[$field] = fieldname_as_text($field) . " não pode estar em branco.";
	  	}
	  }
	}

	// tamanho máximo permitido
	function has_max_length($value, $max) {
		return strlen($value) <= $max;
	}

	// validar tamanho máximo dos campos do formulário 
	function validate_max_lengths($fields_with_max_lengths) {
		global $errors;
		// Recebe array associativo
		foreach($fields_with_max_lengths as $field => $max) {
			$value = trim($_POST[$field]);
		  if (!has_max_length($value, $max)) {
		    $errors[$field] = fieldname_as_text($field) . " é muito longo.";
		  }
		}
	}

	// validar presença no array
	function has_inclusion_in($value, $set) {
		return in_array($value, $set);
	}

	// retorna mensagem de erros do formulários
	function form_errors($errors=array()) {
		$output = "<br />";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Por favor, verifique os seguintes campos:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>{$error}</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}	

?>