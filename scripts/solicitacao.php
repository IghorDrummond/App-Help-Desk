<?php
	session_start();

	//Declaração de Variaveis
	//String
	$Texto = '';
	$arquivo = '';
	//Array
	$Indices = array_keys($_POST);

	//Validação caso a Categoria não for informada
	if($_POST['Categoria'] === 'Escolha Uma Categoria'){
		header('Location: ../abrir_chamado.php?Categoria=erro');
	}else{
		//Tratando Texto
		//Validando se há ; entre os nomes
		for($nCont = 0; $nCont <= (count($Indices) - 1); $nCont++){
			$_POST[$Indices[$nCont]] = str_replace(';', '-Ponto e Virgula-', $_POST[$Indices[$nCont]]);
		}
		$Texto = implode(';', $_POST);

		if(isset($_SESSION['acesso']) and $_SESSION['acesso'] != ''){
			$Texto = $Texto . ';' . $_SESSION['acesso'];
			$Texto = $Texto . PHP_EOL;//Pula de Linha
		}else{
			echo('Error: problema com o usuario!');
			exit();
		}

		//Abertura, Escrita e Fechamento do Arquivo
		$arquivo = fopen('bd_chamados.txt', 'a+');

		fwrite($arquivo, $Texto);

		fclose($arquivo);

		header('Location: ../home.php?Chamado=Aberto');
	}
?>