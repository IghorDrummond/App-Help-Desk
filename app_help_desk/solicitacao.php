<?php
	session_start();

	//Declaração de Variaveis
	//String
	$Texto = '';
	$arquivo = '';
	//Array
	$Indices = array_keys($_POST);
	//Datas
	$Data = date('d/m/Y'); //Pega a Data atual da abertura do chamado

	//Ajusta a Data do Sistema para Brasil
	date_default_timezone_set('America/Sao_Paulo');


		function recuperaId(){
			$Id = '';
			$ChaveBanco = fopen('../../app_help_desk/bd_chamados.txt', 'r');

			while(!feof($ChaveBanco)){
				$Linha = explode(';', fgets($ChaveBanco));
					
				if(isset($Linha[1])){
					$Id = strval(intval($Linha[0]) + 1);
				}else{
					continue;
				}
			}

			fclose($ChaveBanco);

			return $Id === '' ? '0' : $Id;
		}	

	//Validação caso a Categoria não for informada
	if($_POST['Categoria'] === 'Escolha Uma Categoria'){
		header('Location: ../abrir_chamado.php?Categoria=erro');
	}else{
		//Tratando Texto
		//Validando se há ; entre os nomes
		$_POST['Descricao'] = str_replace(array("\r", "\n", "\r\n"), '', $_POST['Descricao']);
		for($nCont = 0; $nCont <= (count($Indices) - 1); $nCont++){
			$_POST[$Indices[$nCont]] = str_replace(';', '-Ponto e Virgula-', $_POST[$Indices[$nCont]]);
		}

		$Texto = recuperaId() . ';'; 
		$Texto = $Texto . implode(';', $_POST);

		if(isset($_SESSION['Usuario'])){
			$Texto = $Texto . ';' . $_SESSION['Usuario_Id'];
			$Texto = $Texto . ';' . $_SESSION['Usuario'];
			$Texto = $Texto . ';' . strval($Data);
			$Texto = $Texto . PHP_EOL;//Pula de Linhas
		}else{
			echo('Error: problema com o usuario!');
			exit();
		}

		//Abertura, Escrita e Fechamento do Arquivo
		$arquivo = fopen('../../app_help_desk/bd_chamados.txt', 'a+');

		fwrite($arquivo, $Texto);

		fclose($arquivo);

		header('Location: ../home.php?Chamado=Aberto');
	}
?>