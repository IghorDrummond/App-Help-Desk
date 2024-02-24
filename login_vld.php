<?php
	session_start();//Inicia a Sessão

	//Comando para sair do site 
	if(isset($_POST['acesso']) and $_POST['acesso'] == 'Sair'){
		session_destroy();
		header('Location: index.php');
	}
	//Comando para caso o usuario estiver logado, redirecionar na página principal
	elseif(isset($_SESSION['logado']) && $_SESSION['logado'] === true){
		header('Location: home.php');
	}
	//Comando para logar o usuario a página com validações
	else{
			//Captura valores enviado da tela de login
			$email = $_POST['Email'];
			$senha = $_POST['Senha'];
			$_existe = false;

			//Inicia Conexão no Banco de Dados
			$ChaveBanco = conectaBanco();
			
			//Verificando Existencia no Banco
			while (!feof($ChaveBanco)){
				$Linha = explode(';', fgets($ChaveBanco));

				if(strtoupper($email) === strtoupper($Linha[1])){
					if($senha == $Linha[2]){
						$_SESSION['logado'] = true;
						$_SESSION['acesso'] = $Linha[0];
						$_SESSION['Permissao'] = trim($Linha[3], PHP_EOL);
						$_existe = true;
						break;
					}
				}
			}

			//Desliga o Banco de Dados
			fclose($ChaveBanco);

			//Valida se existe no banco de dados
			if($_existe === false){
				naoExiste();
			}else{
				header('Location: home.php');
			}
		}

	function naoExiste(){
		$_SESSION['logado'] = false;
		header('Location: index.php?login=erro');	
	}

	function conectaBanco(){
		$ret = fopen('scripts/bd_usuarios.txt', 'r+');
		return $ret;
	}		
?>