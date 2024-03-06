<?php
	session_start();
	
	//String
	$Codigo = $_POST['Codigo'];
	$Email = $_POST['Dado'];
	$Parametro = "";
	$ChaveBanco = "";
	//Booleano
	$lExiste = false;
	//Data
	$data_hj = null;
	$Tempo = null;
    //Constantes
	define('Diretorio_cod', "../../app_help_desk/bd_codigos.txt");
	define("Segundos", 86400);

	date_default_timezone_set('America/Sao_Paulo');
	$data_hj = date('Y-m-d');
	$Tempo = time();

	$ChaveBanco = fopen(Diretorio_cod, "r");

	while(!feof($ChaveBanco)){
		$Linha = explode(";", fgets($ChaveBanco));

		if(!(count($Linha) > 0)){
			continue;
		}

		if($Linha[0] === $Email){
			$Linha[3] = str_replace(PHP_EOL, '', $Linha[3]);
			$Parametro = $Linha[2] . ";" . $Linha[3]. ";" .  $Linha[0];
			$lExiste = true;
			break;
		}
	}

	fclose($ChaveBanco);

	//Verifica se existe o codigo e o email cadastrado no banco
	if($lExiste){	
		//Verifica se o Código está correto
		if($Codigo === $Linha[1]){
			//Verifica se a data segue a regra

			if(strtotime($data_hj) === strtotime($Linha[2])){ 
				$_SESSION['NovaSenha'] = $Parametro;
				//Dia Existente
				RecuperaSenha(1);
			}else if(strtotime($data_hj) > strtotime($Linha[2])){
				if(CalcularTempo($Linha[3], $Tempo)){
					$_SESSION['NovaSenha'] = $Parametro;
					//Dia Existente
					RecuperaSenha(1);
				}
				else{
					//Dia fora da data do codigo
					RecuperaSenha(2);
				}
			}
		}
		else{
			//Código Errado!
			RecuperaSenha(3);
		}
	}else{
		//Nem Existe!
		RecuperaSenha(4);
	}

	function CalcularTempo($Inicial, $Final){
		$Time_Atual = null;

		$Time_Atual =  $Final - (24 * 60 * 60);

		if(($Time_Atual > $Final)){
			$lRet = true;
		}
		else{
			$lRet = false;
		}

		return $lRet;
	}
	
	function RecuperaSenha($Opc){
		
		switch($Opc){
			case 1:
				$Dir = '../NovaSenha.php';
				break;
			case 2:
				$Dir = '../RenovarSenha.php?Validacao=Data&Tela=Segunda&Dado='.$_POST['Dado'];
				break;
			case 3:
				$Dir = '../RenovarSenha.php?Validacao=Codigo&Tela=Segunda&Dado='.$_POST['Dado'];
				break;	
			case 4:
				$Dir = '../RenovarSenha.php?Validacao=Existe&Tela=Segunda&Dado='.$_POST['Dado'];
				break;
		}

		header('Location: ' . $Dir);
	}
