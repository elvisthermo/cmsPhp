<?php 
	
	session_start();

	function messagem(){
		if(isset($_SESSION["mensagem"])){
				$messagem ="<div class=\"message\">";
				$messagem .= $_SESSION["mensagem"];
				$messagem .= "</div>";

				$_SESSION["mensagem"] = NULL;
				
				return $messagem;
			}
	}

 ?>