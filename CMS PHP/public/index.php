<?php include_once("../include/session.php");	?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php $contexto = "public"; ?>
<?php include_once("../include/header.php");		?>
	
<?php 
	encontrar_pagina_selecionada(true);
	
?>

<div id= "main">
	<div id="navigation">	
	<?php echo frontend_menu($categoria_atual,$pagina_atual); ?>
	<br/>

		
	<br/>



	</div>
		
	<div id="page">
	<?php echo messagem(); ?>
			
	<?php 
		if($categoria_atual){
	?>
	
	<h2><?php echo htmlentities($pagina_atual["nome"]); ?></h2>	
	<?php echo nl2br(htmlentities($pagina_atual["conteudo"])); ?>


	
	
	<h2>Gerenciar categoria</h2>
	Categoria:<?php echo htmlentities($categoria_atual["nome"]);  ?>
	<?php echo htmlentities($pagina_atual["conteudo"]); ?><br/>
	

				
		<?php } elseif($pagina_atual){ ?>
		
	
	
	
	<?php echo htmlentities($pagina_atual["conteudo"]); ?>
		


			
	<?php } else { ?>
		<h2>Gerenciar Conteúdo</h2>
		<p>Bem vindo</p>
	<?php } ?>

	</div>
		
	</div>
	
	
<?php include_once("../include/footer.php"); ?>

