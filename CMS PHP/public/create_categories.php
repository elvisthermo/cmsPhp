<?php include_once("../include/session.php");	?>
<?php include_once("../include/db_conection.php");?>
<?php require_once("../include/function.php"); ?>
<?php 
 confirmar_login();
 ?>
<?php
	if(isset($_POST['submit'])) {
		// Formulário foi submetido
		$nome = mysql_prep($_POST["nome"]);
		$ordem = $_POST["ordem"];
		$publicado = $_POST["publicado"];		

		$query = "INSERT INTO categorias (";
		$query .= " nome, ordem, publicado";
		$query .= ") VALUES (";
		$query .= " '{$nome}', {$ordem}, {$publicado}";
		$query .= ")";
		
		$resultado = mysqli_query($conect, $query);

		if($resultado) {
			// Sucesso!
			$_SESSION['mensagem'] = "Categoria foi criada";
			redirect_to("content.php");
		} else {
			// Falhou!
			$_SESSION['mensagem'] = "Categoria não foi criada! ";
			redirect_to("categories.php");
		}

	} else {
		// Formulário não foi submetido
		redirect_to("categories.php");
	}

?>

<?php if(isset($conect)) { mysqli_close($conect); } ?>