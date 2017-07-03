<?php require_once("../include/session.php"); ?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>



<?php $contexto = "admin"; ?>
<?php include_once("../include/header.php");?>


		<div id= "main">
			<div id="navigation">
			</div>
		
			<div id="page">	
			
				<h2>Painel de controle</h2><p>Bem vindo à área administrativa, <b> <?php echo htmlentities($_SESSION["usuario"]); ?> </b></p>
				
				<ul>
					<li><a href="content.php">Gerenciar conteúdo</a></li>
					<li><a href="users.php">Gerenciar Usuários</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
		
			</div>
		</div>

<?php include_once("../include/footer.php"); ?>