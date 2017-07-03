<?php include_once("../include/session.php");	?>
<?php require_once("../include/function.php"); ?>

<?php 
	$_SESSION = array();
	if(isset($_COOKIE[session_name()])){
		setcookie(session_name(),'',time()-42000,'/');
	}
	session_destroy();
	redirect_to("login.php");

 ?>