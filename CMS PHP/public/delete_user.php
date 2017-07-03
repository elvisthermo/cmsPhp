<?php include_once("../include/session.php"); ?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>

<?php
  $usuario = encontrar_usuario_por_id($_GET["id"]);
  if(!$usuario) {
    // usuario não pode ser encontrado por algum motivo
    redirect_to("users.php");
  }
  
  $id = $usuario["id"];
  $query = "DELETE FROM usuarios WHERE id = {$id} LIMIT 1";
  $resultado = mysqli_query($conect, $query);

  if ($resultado && mysqli_affected_rows($conect) == 1) {
    // Sucesso!
    $_SESSION["mensagem"] = "Usuário deletado!";
    redirect_to("users.php");
  } else {
    // Falhou!
    $_SESSION["mensagem"] = "Usuário não pôde ser deletado.";
    redirect_to("users.php");
  }
  
?>
