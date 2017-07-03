<?php include_once("../include/session.php");	?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>

	


<?php 
	$categoria_atual = buscar_categoria_id($_GET["categoria"]);
	if (!$categoria_atual) {
		redirect_to("content.php");
	}

	$paginas = buscar_paginas($categoria_atual["id"],false);
	
	if(mysqli_num_rows($paginas) > 0){
		$_SESSION["mensagem"] = "Não e possivel deleter uma categoria com paginas";
		redirect_to("content.php?categoria={$categoria_atual["id"]}");
	}


	$id = $categoria_atual["id"];
	$query = "DELETE FROM categorias ";
	$query .= "WHERE id = {$id} ";
	$query .= "LIMIT 1 ";
	$resultado =mysqli_query($conect,$query);

	if ($resultado && mysqli_affected_rows($conect)== 1) {
		$_SESSION["mensagem"] = "Categoria removida com seucesso!";

		redirect_to("content.php");
	 } else {
	 	$_SESSION["mensagem"] = "falha na remoção da categoria!";
	 	redirect_to("content.php?categoria={id}");
	 }
	  

 ?>


