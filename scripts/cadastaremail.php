<?php
	$email = $_POST['Email'];
	$senha = [
		0 => $_POST['Senha'],
		1 => $_POST['ConfirmaSenha']
	];

	if(existeConta($email) === false){
		if($senha[0] === $senha[1]){

			$Cadastro = recuperaId();

			$ChaveBanco = fopen('bd_usuarios.txt', 'a+');
			$Cadastro = $Cadastro . ';' . $email . ';' . $senha[0] . ';2' . PHP_EOL;

			fwrite($ChaveBanco, $Cadastro);

			fclose($ChaveBanco);
			header('Location: ../index.php?Validacao=Confirmado');

		}else{
			header('Location: ../Cadastrar.php?Validacao=Senha');
		}
	}
	else{
		//Caso Existir o Email, Retornar uma mensagem de alerta ao usuario
		header('Location: ../Cadastrar.php?Validacao=Email');
	}

	function existeConta($email){
		$ChaveBanco = fopen('bd_usuarios.txt', 'r');

		while(!feof($ChaveBanco)){
			$Linha = explode(';', fgets($ChaveBanco));

			if(strtoupper($Linha[1]) === strtoupper($email)){
				fclose($ChaveBanco);
				return true;
			}
		}

		fclose($ChaveBanco);
		return false;
	}

	function recuperaId(){
		$ChaveBanco = fopen('bd_usuarios.txt', 'r+');

		while(!feof($ChaveBanco)){
			$Linha = explode(';', fgets($ChaveBanco));

			if(isset($Linha[1])){
				$Id = strval(intval($Linha[0]) + 1);
			}else{
				continue;
			}
		}

		fclose($ChaveBanco);

		return $Id;
	}
?>