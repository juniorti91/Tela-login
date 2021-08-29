<?php 

	//verificação para saber se a sessão existe
	session_start();
	if (!isset($_SESSION['id_usuario'])) { //se o ID_Usuario não existe então voltará para login.php
		header("location: index.php");
		exit;
	}
 ?>
 
 Seja Bem Vindoooooooooooo
 <a href="sair.php"> Sair </a>