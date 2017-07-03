<?php include_once("../include/session.php"); ?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>

<?php
  $usuario = encontrar_usuario_por_id($_GET["id"]);
  
  if (!$usuario) {
    // usuário não encontrado por algum motivo
    redirect_to("users.php");
  }
?>

<?php
  
  if (isset($_POST['submit'])) {
    // Formulário foi submetido
    
    // Validações
    /*$campos_requeridos = array("usuario", "senha");
    validate_presences($campos_requeridos);
    
    $campos_limitados = array("usuario" => 30);
    validate_max_lengths($campos_limitados);
    
    */
      
      // Atualizar usuário 

      $id = $usuario["id"];
      $usuario = mysql_prep($_POST["usuario"]);
      $senha = encriptar_senha($_POST["senha"]);
    
      $query  = "UPDATE usuarios SET ";
      $query .= "usuario = '{$usuario}', ";
      $query .= "senha = '{$senha}' ";
      $query .= "WHERE id = {$id} ";
      $query .= "LIMIT 1";
      $resultado = mysqli_query($conect, $query);

      if ($resultado && mysqli_affected_rows($conect) == 1) {
        // Sucesso!
        $_SESSION["mensagem"] = "Usuário atualizado.";
        redirect_to("users.php");
      } else {
        // Falhou!
        $_SESSION["mensagem"] = "Atualização de usuário falhou.";
      }
    
    
  } else {
    // Formulário não foi submetido  
  }
?>

<?php $contexto = "admin"; ?>
<?php include("../include/header.php"); ?>

<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo messagem(); ?>

    
    <h2>Editar Usuário: <?php echo htmlentities($usuario["usuario"]); ?></h2>
    <form action="edit_user.php?id=<?php echo urlencode($usuario["id"]); ?>" method="post">
      <p>Usuário:
        <input type="text" name="usuario" value="<?php echo htmlentities($usuario["usuario"]); ?>" />
      </p>
      <p>Senha:
        <input type="password" name="senha" value="" />
      </p>
      <input type="submit" name="submit" value="Editar Usuário" />
    </form>
    <br />
    <a href="users.php">Cancelar</a>
  </div>
</div>

<?php include("../include/footer.php"); ?>
