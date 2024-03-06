<?php
	session_start();

	if(isset($_SESSION['logado']) && $_SESSION['logado']){
		//header('Location: home.php');
	}else if(isset($_SESSION['NovaSenha'])){
		if(CalcularDias() === false){
			header('Location: RenovarSenha.php');
		}
	}else{
		header('Location: index.php');
	}

	function CalcularDias(){
		$Datas = explode(';', $_SESSION['NovaSenha']);
		$Ret = false;

		//Verifica se a data segue a regra
		if(date('Y-m-d') === $Datas[0]){ 
			//Dia Existente
			$Ret = true;
		}else if(date('Y-m-d') > $Datas[0]){
			if(CalcularTempo(strtotime($Datas[1]), time())){
				//Dia Existente
				$Ret = true;
			}
		}

		return $Ret;
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
?>