<?php 
	
	session_start();
	unset($_SESSION['id_usuario']);//ele apaga a variavel e destroi a sessão
	header("location: index.php");

 ?>