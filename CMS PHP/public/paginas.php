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
  
  if(!$categoria_atual) {
    // id da categoria não foi informado por algum motivo
    redirect_to("content.php");
  }
  
?>


<?php 
      if(isset($_POST['submit'])){

      
      $categoria_id = $categoria_atual["id"];
      $nome = mysql_prep($_POST["nome"]);
      $ordem = $_POST["ordem"];
      $publicado = $_POST["publicado"];
      $conteudo = mysql_prep($_POST["conteudo"]);

      $query = "INSERT INTO paginas (";
      $query .= "categoria_id, nome, ordem, publicado, conteudo ";
      $query .= ") VALUES (";
      $query .= " {$categoria_id}, '{$nome}', {$ordem}, {$publicado},'{$conteudo}'";
      $query .= ")";
      $resultado = mysqli_query($conect, $query);
    


      if($resultado) {
        // Sucesso!
        $_SESSION["mensagem"] = "Página criada com sucesso!";
        redirect_to("content.php?categoria=". urlencode($categoria_atual["id"]));
      } else {
        // Falhou!
        $_SESSION["mensagem"] = "Página não pôde ser criada.";        
      }
    
    }else{
      

    }

  ?>



<?php include_once("../include/header.php");    ?>
<?php echo messagem(); ?>
<div id= "main">

	<div id="navigation">
		<?php echo menu($categoria_atual,$pagina_atual); ?>	
	<br/>
	<a href="categories.php"><small>Adicionar Pagina </small></a>	

	</div>
		
	<div id="page">
		<?php echo messagem(); ?>

<h2>Criar Página</h2>

    <form action="paginas.php?categoria=<?php echo urlencode($categoria_atual["id"]); ?>" method="post">

      <p>Nome:
        <input type="text" name="nome" required value="" />
      </p>

      <p>Ordem:
        <select name="ordem" required>
        <?php
          $paginas = buscar_paginas($categoria_atual["id"],false);
          $total_paginas = mysqli_num_rows($paginas);
          for($i=1; $i <= ($total_paginas + 1); $i++) {
            echo "<option value=\"{$i}\">{$i}</option>";
          }
        ?>          
        </select>
      </p>

      <p>Publicado
        <input type="radio" name="publicado" required value="0" /> Não
        <input type="radio" name="publicado" value="1" /> Sim          
      </p>

      <p>Conteúdo:<br /><br />
        <textarea name="conteudo" rows="20" required cols="80"></textarea>
      </p>

      <input type="submit" name="submit" value="Criar Pagina" />
    </form>
    <br />
    <a href="content.php?categoria=<?php echo urlencode($categoria_atual["id"]); ?>">Cancelar</a>
    <br>
    <a href="paginas.php?categoria=<?php echo urlencode($pagina_atual["id"]); ?>">Editar Pagina</a>
  </div>
</div>

<?php include_once("../include/footer.php"); ?>

