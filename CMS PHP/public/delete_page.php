<?php include_once("../include/session.php"); ?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>
<?php
  $pagina_atual = buscar_pagina_id($_GET["pagina"],false);
  if(!$pagina_atual) {
    // id da página não foi informado por algum motivo
    redirect_to("content.php");
  }
  
  $id = $pagina_atual["id"];
  $query = "DELETE FROM paginas WHERE id = {$id} LIMIT 1";
  $resultado = mysqli_query($conect, $query);

  if ($resultado && mysqli_affected_rows($conect) == 1) {
    // Success
    $_SESSION["mensagem"] = "Página deletada!";
    redirect_to("content.php");
  } else {
    // Failure
    $_SESSION["mensagem"] = "Página não pôde ser deletada.";
    redirect_to("content.php?pagina={$id}");
  }
  
?>
