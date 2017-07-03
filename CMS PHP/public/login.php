<?php include_once("../include/session.php"); ?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
 

<?php $usuario = ""; ?>
<?php
if (isset($_POST['submit'])) {


    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    
    
    
   
    $usuario_logado = login($usuario,$senha);
    if ($usuario_logado) {
      //certo
      $_SESSION["usuario_id"]=$usuario_logado["id"];
      $_SESSION["usuario"] = $usuario_logado["usuario"];
      redirect_to("admin.php");

    } else {
      // Falhou!
      $_SESSION["mensagem"] = "Usuário ou senha não encontrados!";
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
  
    
    <h2>Logar usuário Usuário</h2>
    <form action="login.php" method="post">
      <p>Usuário:
        <input type="text" name="usuario" value="<?php echo htmlentities($usuario)  ?>" required />
      </p>
      <p>Senha:
        <input type="password" name="senha" value="" required />
      </p>
      <input type="submit" name="submit" value="Entrar" />
    </form>
    <br />
    <a href="users.php">Cancelar</a>
  </div>
</div>

<?php include("../include/footer.php"); ?>
