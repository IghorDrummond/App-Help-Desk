<!DOCTYPE html>
<?php
	require_once("scripts/validador_acesso.php");
	//Declaração de Variaveis Globais
	//String
	$Arquivo = '';
	//Numerico
	$nCont = 0;
	$nPosic = 0;
	//Array
	$Linha = [];
	$Color = [
		0 => ['Baixa', 'Média', 'Alta'],
		1 => ['bg-info', 'bg-warning', 'bg-danger']
	];

	//Abrir Banco de Dados Txt
	$Arquivo = fopen('scripts/bd_chamados.txt', 'r');
?>

<html>
	<head>
		<?php
			require_once("scripts/styles.php");
		?>
		<!-- Estilo da Página -->
		<style type="text/css">
			.linha{
				width: 49%;
			}
			textarea{
				max-height: 330px;
			}
			section{
				width: 50%;
			}
			@media (max-width: 991.98px) {
				section{
					width: 95%;
				}
			}
		</style>

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

				<?php 	
					while(!feof($Arquivo)){
						$Linha = explode(';', fgets($Arquivo));

						if(isset($Linha[1]) === false){
							continue;
						}

						$nPosic = array_search($Linha[3], $Color[0]);//Retorna a Posição da Prioridade do Ticket
						$usuario = retornaUsuario(trim($Linha[4], PHP_EOL));//Retorna o Usuario que abriu o Ticket
				?>
					<div class="m-2 border border-bottom border-top border-dark p-2 <?php echo $Color[1][$nPosic];?>">
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
						<h6>Modalidade: <?php echo "$Linha[3]" ?></h6>
					</div>
				<?php
					}
					echo("<h6 class='text-center'>Fim dos Chamados</h6>");
					fclose($Arquivo);

					function retornaUsuario($Id){
						$ChaveBanco = fopen('scripts/bd_usuarios.txt', 'r');

						while (!feof($ChaveBanco)) {
							$Linha = fgets($ChaveBanco);
							$Ids = explode(';', $Linha);

							if(isset($Ids[1])){
								if ($Ids[0] === $Id){
									return $Ids[1];
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
	</body>
</html>