<!DOCTYPE html>
<?php
	require_once("scripts/validador_acesso.php");
	//Declaração de Variaveis Globais
	//String
	$Arquivo = '';
	$Permissao = '';
	//Numerico
	$nCont = 0;
	$nPosic = 0;
	//Array
	$Linha = [];
	$Color = [
		0 => ['Baixa', 'Média', 'Alta'],
		1 => ['bg-info', 'bg-warning', 'bg-danger']
	];

	//Verifica se é Administrador ou Não
	if(isset($_SESSION['Permissao']) and $_SESSION['Permissao'] === '1'){
		define('Permissao', 'Sim');
	}else{
		define('Permissao', 'Nao');
	}

	//Abrir Banco de Dados Txt
	$Arquivo = fopen('scripts/bd_chamados.txt', 'r');
?>
<html>
	<head>
		<?php
			require_once("scripts/styles.php");
		?>
		<!-- Estilo da Página -->
		<link rel="stylesheet" type="text/css" href="css/chamados.css">

		<!-- Favicon -->
		<link rel="icon" href="img/logo.png">

		<!-- Titulo da Página -->
		<title>Help Desk - Chamados</title>
	</head>
	<body>
		<?php 
			require_once("scripts/menu.php"); 
		?>

		<main class="d-flex align-items-start justify-content-center"><!-- Inicio do Conteúdo -->
			<section class="border mt-4"><!-- Inicio da tela de Login -->
				<div class="p-2 text-left border-bottom">
					<h5 class="text-secondary">Chamados</h5>
				</div>	
				<div class="p-2 text-info">
					<h6 class="d-inline">Filtros:</h6>
					<button class="btn btn-info" onclick="Filtrar(1)">Data Mais Atual</button>
					<button class="btn btn-info" onclick="Filtrar(2)">Data Mais Antiga</button>
					<button class="btn btn-info" onclick="Filtrar(3)">Alfabeto (A-Z)</button>
					<button class="btn btn-info" onclick="Filtrar(4)">Alfabeto (Z-A)</button>
					<button class="btn btn-info" onclick="Filtrar(5)">Modalidade</button>
				</div>

				<?php 	
					while(!feof($Arquivo)){
						$Linha = explode(';', fgets($Arquivo));

						if(isset($Linha[1]) === false){
							continue;
						}

						if(retornaUsuario(trim($Linha[4], PHP_EOL)) != retornaUsuario($_SESSION['acesso'])){
							if(Permissao === 'Nao'){
								continue;
							}
						}

						$nPosic = array_search($Linha[3], $Color[0]);//Retorna a Posição da Prioridade do Ticket
						$usuario = retornaUsuario($Linha[4]);//Retorna o Usuario que abriu o Ticket
				?>
					<div class="chamado m-2 border border-bottom border-top border-dark p-2 <?php echo $Color[1][$nPosic];?>">
						<h3><?php echo($Linha[0]); ?></h3>
						<hr>
						<h4>Categoria: <?php echo("$Linha[1]");?></h4>
						<p class="border border-dark">
							<strong>Descrição:</strong><br>
							<?php
								echo $Linha[2];
							?>
						</p>
						<h6>Aberto pelo Usuario: <?php echo $usuario; ?>.</h6>
						<h6 class="Modalidades">Modalidade: <?php echo "$Linha[3]" ?></h6>
						<h6>Data do Chamado: <time><?php echo trim($Linha[5], PHP_EOL); ?></time></h6>
					</div>
				<?php
					}
					echo("<h6 class='text-center'>Fim dos Chamados</h6>");
					fclose($Arquivo);

					function retornaUsuario($Id){
						$ChaveBanco = fopen('scripts/bd_usuarios.txt', 'r');

						while (!feof($ChaveBanco)) {
							$Linha = explode(';', fgets($ChaveBanco));

							if(isset($Linha[1])){
								if($Linha[0] === $Id){
									return $Linha[1];
								}								
							}else{
								continue;
							}
						}	
					}
				?>
			</section><!-- Fim da Tela de Login -->
		</main><!-- Fim do Conteúdo -->
		<?php 
			require_once("scripts/script_js.php");
		?>
		<script type="text/javascript" src="js/chamado.js"></script>
	</body>
</html>