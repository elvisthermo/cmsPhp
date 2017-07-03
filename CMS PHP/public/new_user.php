<?php include_once("../include/session.php"); ?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>
<?php
if (isset($_POST['submit'])) {


    $usuario = mysql_prep($_POST["usuario"]);
    $senha = $_POST["senha"];
    $senha_cryp = encriptar_senha($senha);
    
    
    $query  = "INSERT INTO usuarios (";
    $query .= "  usuario, senha";
    $query .= ") VALUES (";
    $query .= "  '{$usuario}', '{$senha_cryp}' ";
    $query .= ")";
    $resultado = mysqli_query($conect, $query);

    if ($resultado) {
      // Sucesso!
      $_SESSION["mensagem"] = "Usuário criado com sucesso!";
      redirect_to("users.php");
    } else {
      // Falhou!
      $_SESSION["mensagem"] = "Criação de usuário falhou!";
    }
  
 }else {
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
  
    
    <h2>Criar Usuário</h2>
    <form action="new_user.php" method="post">
      <p>Usuário:
        <input type="text" name="usuario" value="" required />
      </p>
      <p>Senha:
        <input type="password" name="senha" value="" required />
      </p>
      <input type="submit" name="submit" value="Criar Usuário" />
    </form>
    <br />
    <a href="users.php">Cancelar</a>
  </div>
</div>

<?php include("../include/footer.php"); ?>
