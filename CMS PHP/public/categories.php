<?php include_once("../include/session.php");	?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
 <?php 
 confirmar_login();
 ?>
<?php include_once("../include/header.php");		?>

	
<?php 
	encontrar_pagina_selecionada();
	
?>

<div id= "main">
	<div id="navigation">
		<?php echo menu($categoria_atual,$pagina_atual); ?>	
	<br/>
	<a href="categories.php"><small>Adicionar Categoria </small></a>	

	</div>
		
	<div id="page">
		<?php echo messagem(); ?>

		<h2>Criar Categoria</h2>
		<form action="create_categories.php" method="post">
			<p>Nome:
				<input type="text" name=nome>
			</p>

			<p>Ordem:
				<select name="ordem">
				<?php
	    		$total_categorias = buscar_categorias(false);
	    		$total_categorias = mysqli_num_rows($total_categorias);
	    		for($i=1; $i <= ($total_categorias + 1); $i++) {
	    			echo "<option value=\"{$i}\">{$i}</option>";
	    		}
	    	?>
					<option value="1"></option>
					

				</select>
			</p>
			<p>Publicado
				<input type="radio" name="publicado" required value="0"/>Não
				<input type="radio" name="publicado" required value="1"/>Sim
			</p>

			<p>
				<input type="submit" name="submit" value="Criar Categoria">

			</p>



		</form>
		<br/>
		<a href="content.php">Cancelar</a>


	</div>	
	</div>
	
	
<?php include_once("../include/footer.php"); ?>

