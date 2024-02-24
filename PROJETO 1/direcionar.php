<?php
	$opcao = $_GET['Acessar'];

	switch ($opcao) {
		case 'Cadastrar Conta':
			header('Location: scripts/Cadastrar.php');
			break;
		case 'Esqueci a Senha':
			header('Location: RenovarSenha.php');
			break;
	}
?>