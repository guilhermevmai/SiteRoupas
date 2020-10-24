<?php
	require_once('../config.php');		
	require_once(DBAPI);		

	$users = null;
	$user = null;
	$listas = null;
	$lista = null;

	function ver($id = null){
		global $user;
		$id = $_SESSION['id'];
		$user = find('usuario', $id);
	}
?>

<?php

	function edit(){
		if(isset($_GET['id'])){
			
			$id = $_GET['id'];
			

			if (isset($_POST['user'])) {
				$user = $_POST['user'];
				$senha = $_POST['senha'];


				alterarPerfil('usuario', $id, $user, $senha);

				header('Location: perfil.php');
			}else{
				
				global $user;
				$user = find_users('usuario', $id);
			}
		}else{
			header('Location: perfil.php');
		}
	}
?>

<?php
	
	function view($id = null){

		global $user;
		$user = find_users('usuario', $id);
	}
?>

<?php

	function delete($id = null){

		global $user;
		$user = remove2('usuario', $id);

		header('Location: ../logs');
	}
?>

<?php
	
	function desejos($id = null){
		if (isset($_GET['id'])) {
			$id = $_GET['id']; 
			global $listas;
			$listas = listas($id);
		}

	}	
?>

<?php

	function trocaSenha(){
		if(isset($_GET['id'])){
			
			$id = $_GET['id'];
			

			if (isset($_POST['user'])) {
				$user = $_POST['user'];
				$senhaAntes = $_POST['senhaAntes'];
				$senhaDepois = $_POST['senhaDepois'];



				alterarSenha('usuario', $id, $senhaAntes, $senhaDepois);

				header('Location: perfil.php');
			}else{
				
				global $user;
				$user = find_users('usuario', $id);
			}
		}else{
			header('Location: ../index.php');
		}
	}
?>
