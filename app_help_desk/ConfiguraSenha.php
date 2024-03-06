<?php
	session_start();
	//Declaração de Variaveis
	//String
	$Email = "";
	$Extraindo = "";
	//Numerico
	$nCont = 0;
	//Array
	$senha = [
		0 => $_POST['Senha'],
		1 => $_POST['ConfirmaSenha']
	];
	$Nova_Linha = Array();
	//Constantes
	define('Diretorio_user', '../../app_help_desk/bd_usuarios.txt');

	if ($senha[0] === $senha[1]) {
		$Extraindo = strrchr($_SESSION['NovaSenha'], ';');
		$Email = substr($Extraindo, 1);
		$ChaveBanco = fopen(Diretorio_user, 'r');

		while (!feof($ChaveBanco)) {
			$Linha = explode(';', fgets($ChaveBanco));

			if(isset($Linha[1]) ===  false){
				continue;
			}

			if($Linha[1] === $Email){
				$Linha[2] = $senha[0]; 
			}
			
			$Nova_Linha[$nCont] = implode(';', $Linha);
			$nCont++;
		}

		fclose($ChaveBanco);
		//Destroi o Arquivo e recria um novo
		unlink(Diretorio_user);

		$ChaveBanco = fopen(Diretorio_user, 'x+');

		for($nCont = 0; $nCont <= count($Nova_Linha) -1; $nCont++){
			fwrite($ChaveBanco, $Nova_Linha[$nCont]);
		}

		fclose($ChaveBanco);

		header('Location: ../index.php?Validacao=Confirmado');

	} else {
		header('Location: ../NovaSenha.php?Validacao=Senha');
	}
?>