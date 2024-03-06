<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	require_once('../../app_help_desk/Exception.php');
	require_once('../../app_help_desk/SMTP.php');
	require_once('../../app_help_desk/PHPMailer.php');
	//Declaração de variavei
	//String
	$ChaveBanco = "";
	$Email = $_POST['Email'];
	$Ret = "";
	//Array
	$Linha = [];
	//Booleano
	$lRet = false;

	//Definido
	define('Diretorio_cod', "../../app_help_desk/bd_codigos.txt");
	define('Diretorio', "../../app_help_desk/bd_usuarios.txt");

	$ChaveBanco = fopen(Diretorio, "a+");

	while(!feof($ChaveBanco)){
		$Linha = explode(";", fgets($ChaveBanco));

		if(isset($Linha[1]) === false){
			continue;
		}

		if($Linha[1] === $Email){
			EnviarEmail($Linha[1]);
			$lRet = true;
			break;
		}
	}

	fclose($ChaveBanco);

	switch ($lRet) {
		case true:
			$Ret = "../RenovarSenha.php?Tela=Segunda&Dado=".$Linha[1];
			break;
		
		default:
			$Ret = "../RenovarSenha.php?Validacao=email";
			break;
	}

	header('Location: ' . $Ret);

#============================Função==========================================
	function EnviarEmail($Valores){
		//String
		$Chave = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890#_@%';
		$Codigo = "";
		$ChaveBanco2 = "";
		$Texto = "";
		$Modo = "";
		//Array
		$Linha = [];
		//Data
		$Data = date('Y-m-d');
		$Tempo = time();
		//Gera Código
		for($nCont = 0; $nCont <= 7; $nCont++){
			$Codigo .= substr($Chave, random_int(0, 39), 1);
		}

		//Verifica se há um codigo gerando anteriormente e gera um novo
		RemoveAnteriores($Valores);
		//Abre um banco
		$ChaveBanco2 = fopen(Diretorio_cod, "a+");
		//Define o horario 
		date_default_timezone_set('America/Sao_Paulo');

		$Texto = $Valores . ';' . $Codigo . ';' . strval($Data) . ';' . strval($Tempo) . PHP_EOL; 
		//Escreve no banco
		fwrite($ChaveBanco2, $Texto);
		//Fecha o Banco
		fclose($ChaveBanco2);
		//Inicia o Envio do Email
		$mail = new PHPMailer(true);

		try {
			//Configuarações do Servidor
			//$mail->SMTPDebug = 2; 
			$mail->isSMTP();                                            
			$mail->SMTPAuth   = true;                                   
			$mail->Username   = 'seuemail';                     
			$mail->Password   = 'suasenha';                               
			$mail->SMTPSecure = 'tls';            
			$mail->SMTPAutoTLS = false;
			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
			$mail->CharSet="UTF-8";
			$mail->Host       = 'smtp.email.com';                     
			$mail->Port       = 587;
			//Destinatário e Remetente
			$mail->setFrom('seuemail', 'Nao-Responda');
			$mail->addAddress($Valores, 'Usuario de Código');     

			//Corpo do Email
			$mail->isHTML(true);                                  
			$mail->Subject = 'Nao Responda - Código';
			$mail->Body    = CorpoHtml($Codigo);
			$mail->AltBody = 'Este é o seu Código para Recuperar a Senha: ' . $Codigo;
			//Envio do Email
			$mail->send();
		} catch (Exception $e) {
			echo "Email não foi Enviado, ocorreu problema: {$mail->ErrorInfo}";
		}	
	}

	function RemoveAnteriores($Email){
		//Numerico
		$nCont = 0;
		//String
		$ChaveBanco3 = "";
		//array
		$Nova_linha = [];

		$ChaveBanco3 = fopen(Diretorio_cod, "r");

		while(!feof($ChaveBanco3)){
			$Linha = explode(';', fgets($ChaveBanco3));

			if($Linha[0] != $Email){
				$Nova_linha[$nCont] = implode(';', $Linha);
				$nCont++;
			}
		}

		//Fecha Arquivo
		fclose($ChaveBanco3);
		//Apaga o Arquivo Anterior
		unlink(Diretorio_cod);

		$ChaveBanco3 = fopen(Diretorio_cod, "x+");

		for ($nCont=0; $nCont <= count($Nova_linha) - 1 ; $nCont++){ 
			fwrite($ChaveBanco3, $Nova_linha[$nCont]);
		}
		//Fecha Arquivo
		fclose($ChaveBanco3);	
	}	

	function CorpoHtml($Codigo){
		$Ret = '';

		$Ret = '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>Código Gerado</title>
				<style type="text/css">
					*{
						padding: 0;
						margin: 0;
					}
					main{
						height: 100vh;
							font-family: arial;
					}
					.cabecalho{
						width: 100%;
						background: #343a40;
						height: 40%;
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
						-webkit-box-pack: center;
						    -ms-flex-pack: center;
						        justify-content: center;
						-webkit-box-align: center;
						    -ms-flex-align: center;
						        align-items: center;
						-webkit-box-orient: vertical;
						-webkit-box-direction: normal;
						    -ms-flex-direction: column;
						        flex-direction: column;
					}
					.cabecalho>img{
						display: block;
						width: 200px;
					}
					.cabecalho h2{
						color: white;
						margin-top: 30px;
					}
					.codigo{
						padding: 50px;
						-webkit-box-sizing: border-box;
						        box-sizing: border-box;
					}
					.campo{
						background: gray;
						color: white;
						font-weight: bold;
						width: 50%;
						text-align: center;
						letter-spacing: 15px;
						margin-top: 25px;
					}
					p{
						margin-top: 50px;
						width: 90%;
					}
				</style>
			</head>
			<body>
				<main>
					<section class="cabecalho">
						<img src="logo.png">
						<h2>Help Desk</h2>
					</section>
					<section class="codigo">
						<h1>Seu Código Foi Gerado com Sucesso!</h1>
						<h1 class="campo">
						'
							. $Codigo .
						'
						</h1>
						<p>		
							<strong>Atenção usuário:</strong><br> Ao receber um código de segurança para trocar sua senha, tenha cautela. Mantenha o código privado e não o compartilhe com ninguém. Verifique sempre a autenticidade da fonte antes de inserir o código. Sua segurança é primordial.<br><br>
							A segurança da senha é fundamental para proteger nossas informações pessoais e manter nossa privacidade online. Aqui estão algumas razões pelas quais a segurança da senha é tão importante:
							<br><br>					Proteção de Dados Pessoais: Senhas fortes ajudam a proteger nossas informações pessoais, como dados bancários, endereços, histórico de compras e comunicações privadas. Sem uma senha segura, essas informações podem ser facilmente acessadas por pessoas não autorizadas.
							<br><br>					Prevenção contra Acesso Não Autorizado: Uma senha forte é a primeira linha de defesa contra hackers e cibercriminosos que tentam acessar nossas contas online. Se nossas senhas forem fracas ou fáceis de adivinhar, nossa conta se torna vulnerável a ataques de força bruta, phishing e outras técnicas de hacking.
							<br><br>					Evitar Roubos de Identidade: Senhas seguras ajudam a evitar o roubo de identidade, onde alguém pode usar nossas informações pessoais para se passar por nós e cometer fraudes em nosso nome. Uma senha forte dificulta a tentativa de roubo de identidade e protege nossa reputação online.
							<br><br>					Manter a Confidencialidade: Senhas são usadas para proteger informações confidenciais, como dados comerciais, propriedade intelectual e segredos comerciais. Sem uma senha forte, essas informações podem ser expostas e comprometer a competitividade e a segurança de uma organização.
							<br><br>					Preservar a Segurança Financeira: Muitos serviços online estão vinculados a contas bancárias e cartões de crédito. Uma senha segura é essencial para proteger nossas finanças e evitar que criminosos acessem e abusem de nossos fundos.
							<br><br>					Garantir a Integridade das Comunicações: Senhas protegem nossas contas de e-mail, mensagens e redes sociais, garantindo que apenas pessoas autorizadas possam acessar nossas comunicações privadas. Isso é especialmente importante para manter a confiança e a privacidade em relacionamentos pessoais e profissionais.
							<br><br>					Em resumo, a segurança da senha desempenha um papel crucial na proteção de nossas informações pessoais, financeiras e profissionais. Portanto, é essencial criar e manter senhas fortes e únicas para cada uma de nossas contas online.	
						</p>
					</section>
				</main>
			</body>
		</html>
		';

		return $Ret;
	}
?>