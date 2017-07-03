<?php include_once("../include/session.php");	?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>

	
<?php 
	encontrar_pagina_selecionada();
		
?>

<?php 
	if (!$categoria_atual) {
		redirect_to("content.php");
	}
 ?>

<?php
	

	if(isset($_POST['submit'])) {
		// Formulário foi submetido
		$id = $categoria_atual['id'];
		$nome = mysql_prep($_POST["nome"]);
		$ordem = $_POST["ordem"];
		$publicado = $_POST["publicado"];		


		if (empty($erros)) {
			

		$query = "UPDATE categorias SET ";
		$query .= "nome = '{$nome}', ";
		$query .= "ordem = {$ordem}, ";
		$query .= "publicado = {$publicado} ";
		$query .= "WHERE id = {$id} ";
		$query .= "LIMIT 1";
		$resultado = mysqli_query($conect, $query);
		
		

		
		if($resultado && mysqli_affected_rows($conect) ==1 ) {
			// Sucesso!
			$_SESSION['mensagem'] = "Categoria foi Editada";
		
		} else {
			// Falhou!
			$_SESSION['mensagem'] = "Categoria não foi Editada! ";
			
		}
	}



	} else {
		// Formulário não foi submetido
		
	}

?>


<?php include_once("../include/header.php");		?>
<div id= "main">
	<div id="navigation">
		<?php echo menu($categoria_atual,$pagina_atual); ?>	
	<br/>
	<a href="categories.php"><small>Adicionar Categoria </small></a>	

	</div>
		
	<div id="page">
		<?php echo messagem(); ?>

		<h2>Editar Categoria: <?php echo htmlentities($categoria_atual["nome"]); ?></h2>

	    <form action="edit_category.php?categoria=<?php echo urlencode($categoria_atual["id"]); ?>" method="post">
			<p>Nome:
	    		<input type="text" name="nome" value="<?php echo htmlentities($categoria_atual["nome"]); ?>">
	    	</p>

	    	<p>Ordem:
	    	<select name="ordem">	    	
	    	<?php
	    		$total_categorias = buscar_categorias(false);
	    		$total_categorias = mysqli_num_rows($total_categorias);
	    		for($i=1; $i <= $total_categorias; $i++) {
	    			echo "<option value=\"{$i}\"";
	    			if($categoria_atual["ordem"] == $i) {
	    				echo " selected";	
	    			}	    			
	    			echo ">{$i}</option>";
	    		}
	    	?>
	    		
	    	</select>
	    	</p>
	    	
	    	<p>Publicado
	    		<input type="radio" name="publicado" value="0" 
	    			<?php if($categoria_atual["publicado"] == 0) {echo "checked"; } ?>
	    		/> Não
	    		
	    		<input type="radio" name="publicado" value="1"
	    			<?php if($categoria_atual["publicado"] == 1) {echo "checked"; } ?>
	    		/> Sim
	    	</p>

	    	<input type="submit" name="submit" value="Editar Categoria">
	    </form>
	    <br />
	    <a href="content.php">Cancelar</a>
	    &nbsp;
	    &nbsp;
	    <a href="delete_category.php?categoria=<?php echo urlencode($categoria_atual["id"]); ?>"onclick="return confirm('tem certeza?')" >Deletar Categoria </a>
	  </div>

	</div>
	
<?php include_once("../include/footer.php"); ?>

