<?php include_once("../include/session.php"); ?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>

  
<?php 
  encontrar_pagina_selecionada();
  
?>
<?php 
  
  if(!$pagina_atual) {
    // id da categoria não foi informado por algum motivo
   redirect_to("content.php");
  }
  
?>


<?php

  if(isset($_POST['submit'])) {
    // Formulário foi submetido

    $id = $pagina_atual["id"];
    $nome = mysql_prep($_POST["nome"]);
    $ordem = $_POST["ordem"];
    $publicado = $_POST["publicado"];
    $conteudo = mysql_prep($_POST["conteudo"]);


      // Atualizar página     

      $query  = "UPDATE paginas SET ";
      $query .= "nome = '{$nome}', ";
      $query .= "ordem = {$ordem}, ";
      $query .= "publicado = {$publicado}, ";
      $query .= "conteudo = '{$conteudo}' ";
      $query .= "WHERE id = {$id} ";
      $query .= "LIMIT 1";
      $resultado = mysqli_query($conect, $query);

      if($resultado && mysqli_affected_rows($conect) == 1) {
        // Sucesso!
        $_SESSION["mensagem"] = "Página atualizada.";
        redirect_to("content.php?pagina={$id}");
      } else {
        // Falhou!
        $_SESSION["mensagem"] = "Página não pôde ser atualizada.";        
      }

    

  } else {
    // Formulário não foi submetido

  }

?>

<?php $contexto = "admin"; ?>
<?php include_once("../include/header.php");    ?>

<div id="main">
  <div id="navigation">
    <?php echo menu($categoria_atual, $pagina_atual); ?>
  </div>
  <div id="page">
    <?php echo messagem(); ?>       

    <h2>Editar Página: 
      <?php echo htmlentities($pagina_atual["nome"]); ?>
    </h2>

    <form action="edit_paginas.php?pagina=<?php echo urlencode($pagina_atual["id"]); ?>" method="post">

      <p>Nome:
        <input type="text" name="nome" value="<?php echo htmlentities($pagina_atual["nome"]); ?>" />
      </p>

      <p>Ordem:
        <select name="ordem">
        <?php
          $paginas = buscar_paginas($pagina_atual["categoria_id"]);
          $total_paginas = mysqli_num_rows($paginas);
          for($i=1; $i <= $total_paginas; $i++) {
            echo "<option value=\"{$i}\"";
            if($pagina_atual["ordem"] == $i) {
              echo " selected";
            }
            echo ">{$i}</option>";
          }
        ?>          
        </select>
      </p>

      <p>Publicado
        <input type="radio" name="publicado" value="0" <?php if ($pagina_atual["publicado"] == 0) { echo "checked"; } ?> /> Não
        <input type="radio" name="publicado" value="1" <?php if ($pagina_atual["publicado"] == 1) { echo "checked"; } ?> /> Sim          
      </p>

      <p>Conteúdo:<br /><br />
        <textarea name="conteudo" rows="20" cols="80"><?php echo htmlentities($pagina_atual["conteudo"]); ?></textarea>
      </p>

      <input type="submit" name="submit" value="Editar Pagina" />
    </form>
    <br />
    <a href="content.php?categoria=<?php echo urlencode($pagina_atual["id"]); ?>">Cancelar</a>
    &nbsp;
    &nbsp;
    <a href="delete_page.php?pagina=<?php echo urlencode($pagina_atual["id"]); ?>" onclick="return confirm('Tem certeza?');">Deletar Página</a>

  </div>
</div>

<?php include_once("../include/footer.php"); ?>

