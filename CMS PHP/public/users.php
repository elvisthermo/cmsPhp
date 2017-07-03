<?php include_once("../include/session.php"); ?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
 
 <?php 
 confirmar_login();
 ?>

<?php
  $usuarios = encontrar_usuarios();
?>



<?php $contexto = "admin"; ?>
<?php include("../include/header.php"); ?>
<div id="main">
  <div id="navigation">
    &nbsp;
  </div>
  <div id="page">
    <?php echo messagem(); ?>
    <h2>Gerenciar Usuários</h2>
    <table>
      <tr>
        <th style="text-align: left; width: 200px;">Usuário</th>
        <th colspan="2" style="text-align: left;">Ações</th>
      </tr>
    <?php while($usuario = mysqli_fetch_assoc($usuarios)) { ?>

      <tr>
        <td><?php echo htmlentities($usuario["usuario"]); ?><br/> <?php echo htmlentities($usuario["senha"]); ?></td>
        <td><a href="edit_user.php?id=<?php echo urlencode($usuario["id"]); ?>">Editar</a></td>
        <td><a href="delete_user.php?id=<?php echo urlencode($usuario["id"]); ?>" onclick="return confirm('Tem certeza?');">Deletar</a></td>
      </tr>
    <?php } ?>
    </table>
    <br />
    <a href="new_user.php">Adicionar Usuário</a>
    <hr/>
    <br>

  </div>
</div>

<?php include("../include/footer.php"); ?>