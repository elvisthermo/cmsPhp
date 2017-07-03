<?php 

function redirect_to($localizacao){
	header("Location: ".$localizacao);
	exit;
}

function mysql_prep($string){
	global $conect;
	$escaped_string = mysqli_real_escape_string($conect,$string);
	return $escaped_string;
}


function comfirmar_resultado($result){
	if(!$result){
			die("consulta ao banco de dados falhou.");
	}

}

function buscar_categorias($public = true){
	global $conect;

	$query = "SELECT * ";
	$query .=" FROM categorias ";
	if($public){
	
		$query .= "WHERE publicado=1 ";

	}

	$query .="ORDER BY ordem ASC";
		
	$categorias = mysqli_query($conect,$query);
		
	comfirmar_resultado($categorias);

	return $categorias;
}

//buscar usuarios

function encontrar_usuarios(){
	global $conect;

	$query = "SELECT * ";
	$query .=" FROM usuarios ";
	$query .="ORDER BY usuario ASC";
		
	$usuarios = mysqli_query($conect,$query);
		
	comfirmar_resultado($usuarios);

	return $usuarios;
}
//usuarios id

function encontrar_usuario_por_id($usuario_id){
	global $conect;

	$query = "SELECT * ";
	$query .="FROM usuarios ";
	$query .="WHERE id = {$usuario_id} ";
	$query .="LIMIT 1";		
	
	$usuario = mysqli_query($conect,$query);
	comfirmar_resultado($usuario);
	if($usuario = mysqli_fetch_assoc($usuario)){
		return $usuario;
	}else{
		return NULL;
	}

}


function buscar_paginas($categoria_id,$public = true){
	global $conect;

	$query = "SELECT * ";
	$query .="FROM paginas ";
	$query .= "WHERE categoria_id = {$categoria_id} ";
	if ($public) {

		$query .="AND publicado=1 ";
				
	}
	
	

	$query .="ORDER BY ordem ASC";

	
	$paginas = mysqli_query($conect,$query);
		
	comfirmar_resultado($paginas);

	return $paginas;

}

//menu back-end
function menu($categoria_selecionada, $pagina_selecionada) {
	$menu = "<ul class=\"categories\">";
	$categorias = buscar_categorias(false);
	while($categoria = mysqli_fetch_assoc($categorias)) {
		$menu .= "<li";
		if($categoria_selecionada && $categoria["id"] == $categoria_selecionada["id"]) {
				$menu .= " class=\"selected\"";	
		} 			  	
		$menu .= ">";
		$menu .= "<a href=\"content.php?categoria=";
		$menu .= urlencode($categoria["id"]); 
	 	$menu .= "\">";
	  	$menu .= htmlentities($categoria["nome"]);
	  	$menu .= "</a>";		  		
	  	$menu .= "<ul class=\"pages\">";		  		
	  	$paginas = buscar_paginas($categoria["id"],false);		  			
	  	
	  	while($pagina = mysqli_fetch_assoc($paginas)) {
		  	$menu .= "<li";
			if($pagina_selecionada && $pagina["id"] == $pagina_selecionada["id"]) {
				$menu .= " class=\"selected\"";	
			} 			  	
		
			$menu .= ">"; 
			$menu .= "<a href=\"content.php?pagina=";
			$menu .= urlencode($pagina["id"]); 
			$menu .= "\">";
			$menu .= htmlentities($pagina["nome"]);
			$menu .= "</a>";
			$menu .= "</li>";
		}
		
		mysqli_free_result($paginas);	
		$menu .= "</ul>";
		$menu .= "</li>";		  	
	}	

	mysqli_free_result($categorias);	  
	$menu .= "</ul>";
	return $menu;

}

//front-end menu
function frontend_menu($categoria_selecionada, $pagina_selecionada) {
	$menu = "<ul class=\"categories\">";
	$categorias = buscar_categorias();
	while($categoria = mysqli_fetch_assoc($categorias)) {
		$menu .= "<li";
		if($categoria_selecionada && $categoria["id"] == $categoria_selecionada["id"]) {
				$menu .= " class=\"selected\"";	
		} 			  	
		$menu .= ">";
		$menu .= "<a href=\"index.php?categoria=";
		$menu .= urlencode($categoria["id"]); 
	 	$menu .= "\">";
	  	$menu .= htmlentities($categoria["nome"]);
	  	$menu .= "</a>";		  		
	  	

	  	if($categoria_selecionada["id"] ==$categoria["id"] || $pagina_selecionada["categoria_id"] == $categoria["id"]){
	  	$menu .= "<ul class=\"pages\">";		  	
	  	$paginas = buscar_paginas($categoria["id"]);		  			
	  	while($pagina = mysqli_fetch_assoc($paginas)) {
		  	$menu .= "<li";
			if($pagina_selecionada && $pagina["id"] == $pagina_selecionada["id"]) {
				$menu .= " class=\"selected\"";	
			} 			  	
		
				$menu .= ">"; 
				$menu .= "<a href=\"index.php?pagina=";
				$menu .= urlencode($pagina["id"]); 
				$menu .= "\">";
				$menu .= htmlentities($pagina["nome"]);
				$menu .= "</a>";
				$menu .= "</li>";
			}
		
			mysqli_free_result($paginas);	
			$menu .= "</ul>";
		}

			$menu .= "</li>";		  	
	}	

	mysqli_free_result($categorias);	  
	$menu .= "</ul>";
	return $menu;

}


function buscar_categoria_id($categoria_id,$public=null){
	global $conect;

	$query = "SELECT * ";
	$query .="FROM categorias ";
	$query .="WHERE id = {$categoria_id} ";
	if($public){
		$query .= "AND publicado = 1 ";

	}
	$query .="LIMIT 1";		
	
	$categoria = mysqli_query($conect,$query);
	comfirmar_resultado($categoria);
	if($categoria = mysqli_fetch_assoc($categoria)){
		return $categoria;
	}else{
		return NULL;
	}

}

function buscar_pagina_id($pagina_id,$public=true){
	global $conect;


	$query = "SELECT * ";
	$query .="FROM paginas ";
	$query .="WHERE id = {$pagina_id} ";
	if($public){
		$query .="AND publicado = 1 ";
	}
	$query .="LIMIT 1";		
	
	$pagina = mysqli_query($conect,$query);
	comfirmar_resultado($pagina);
	if($pagina = mysqli_fetch_assoc($pagina)){
		return $pagina;
	}else{
		return NULL;
	}

}

function encontrar_pagina_selecionada($public =false){
	global $categoria_atual;
	global $pagina_atual;

	if(isset($_GET["categoria"])){
		$categoria_atual =buscar_categoria_id($_GET["categoria"],$public);
		//if($public){
		$pagina_atual = null;
		//$pagina_atual = $pagina_padrao_da_categoria();
	//}
	}elseif (isset($_GET["pagina"])) {
		$categoria_atual =  null;
		$pagina_atual =buscar_pagina_id($_GET["pagina"],$public);
		 

	}else{

		$categoria_atual = null;
		$pagina_atual = null;

	}

}


	function encriptar_senha($senha) {
		$formato = "$2y$10$";
		$salt = gerar_salt(22);
		$formato_com_salt = $formato . $salt;
		$hash_senha = crypt($senha, $formato_com_salt);
		return $hash_senha;
	}

	function gerar_salt($tamanho) {
		// Gerar uma string aleatoria, única e criptografada com md5
		$string_aleatoria = md5(uniqid(mt_rand(), true));

		// Validar apenas caracteres aceitos no formato [a-zA-Z0-9./]
		$base64_string = base64_encode($string_aleatoria);

		// Retirar o sinal de + que é aceito no base64 encode
		$base64_string = str_replace('+', '.', $base64_string);

		// Cortar a string no tamanho correto
		$salt = substr($base64_string, 0, $tamanho);

		return $salt;
	}

	function checar_senha($senha, $hash) {
		// $hash contém o formato e o salt a ser comparado
		$hash_senha = crypt($senha, $hash);
		if($hash_senha === $hash) {
			return true;
		} else {
			return false;
		}
	}

	function encontrar_usuario($usuario){
		global $conect;

	$query = "SELECT * ";
	$query .="FROM usuarios ";
	$query .="WHERE usuario = '{$usuario}' ";
	$query .="LIMIT 1";		
	
	$usuario = mysqli_query($conect,$query);
	comfirmar_resultado($usuario);
	if($usuario = mysqli_fetch_assoc($usuario)){
		return $usuario;
	}else{
		return NULL;
	}
	}

	function login($usuario,$senha){
		$usuario = encontrar_usuario($usuario);
		if ($usuario) {
			if(checar_senha($senha,$usuario["senha"]))
				return $usuario;
		}else{
			return false;
		}
		}

	function logado(){
		return isset($_SESSION['usuario_id']);
	}

	function confirmar_login() {
		if(!logado()) {
  			redirect_to("login.php");
  	
  		}	
	}


	



?>