<?php
	session_start();	
	require_once('functions.php');


	
	if(isset($_GET['id'])){

		delete($_GET['id']);
		session_destroy();

	}else{

		die("ERRO: ID não definido");
	}

?>