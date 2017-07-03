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
	<small>
		<a href="admin.php">&laquo; Menu Principal</a>	
	</small>	
	<?php echo menu($categoria_atual,$pagina_atual); ?>
	<br/>

		
	<br/>
	+<a href="categories.php"><small>Adicionar Categoria </small></a>


	</div>
		
	<div id="page">
	<?php echo messagem(); ?>
			
	<?php 
		if($categoria_atual){
	?>	

	
	
	<h2>Gerenciar categoria</h2>
	Categoria:<?php echo htmlentities($categoria_atual["nome"]);  ?><br/>
	Posição:<?php echo $categoria_atual["ordem"]; ?><br/>	Publicado:<?php echo $categoria_atual["publicado"]==1 ?'Sim':'Não'; ?><br/>
	
	<?php echo messagem(); ?>


	<small>
		<a href="edit_category.php?categoria=<?php echo urlencode($categoria_atual["id"]); ?> ">Editar Categoria</a>
	</small>

	<div style="margin-top: 2em; border-top: :1px solid #000000" >
		<h4>Páginas nessa categoeria</h4>
		<ul>
			<?php 
			$paginas = buscar_paginas($categoria_atual["id"],false);
			 while ($pagina = mysqli_fetch_assoc($paginas)) {
	              echo "<li>";
	              $pagina_id = urlencode($pagina["id"]);
	              echo "<a href=\"content.php?pagina={$pagina_id}\">";
	              echo htmlentities($pagina["nome"]);
	              echo "</a>";
	              echo "</li>";
	            }

			 ?>

		</ul>
		<br/>
		+ <a href="paginas.php?categoria=<?php echo urlencode($categoria_atual["id"]); ?>">Adicionar nova página
	        nesta categoria</a>
	</div>
				
		<?php } elseif($pagina_atual){ ?>
		
	
	<h2>Gerenciar pagina</h2>
	Categoria:<?php echo htmlentities($pagina_atual["nome"]);  ?><br/>
	Posição:<?php echo $pagina_atual["ordem"]; ?><br/>
	Publicado:<?php echo $pagina_atual["publicado"]==1 ?'Sim':'Não'; ?><br/>
	Conteudo: <br/>
	<div class="view-content">
	<?php echo htmlentities($pagina_atual["conteudo"]); ?>
		
	</div>
	<br/>
	<br/>
	<a href="edit_paginas.php?pagina=<?php echo urlencode($pagina_atual['id']); ?>">Editar Página</a>
	&nbsp;
	&nbsp;
	<a href="delete_page.php?pagina=<?php echo urlencode($pagina_atual['id']); ?>" onclick="return confirm('tem certeza')" >Deletar Páginas</a>



			
	<?php } else { ?>
		<h2>Gerenciar Conteúdo</h2>
		<p>Selecione uma Página ou Categoria</p>
	<?php } ?>

	</div>
		
	</div>
	
	
<?php include_once("../include/footer.php"); ?>

