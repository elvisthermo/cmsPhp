<?php 
	define("DB_HOST","localhost");
	define("DB_USER","elvis");
	define("DB_NOME","elvis");
	define("DB_SENHA", "12345");
	$conect = mysqli_connect(DB_HOST,DB_USER,DB_SENHA,DB_NOME);

	//teste de conexão

	if(mysqli_connect_errno()){
		die("falha na conexão!".mysqli_connect_errno()."(".mysqli_connect_errno().")");
	}

?>