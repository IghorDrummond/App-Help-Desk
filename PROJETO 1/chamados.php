<?php require_once("scripts/validador_acesso.php"); ?>
<!DOCTYPE html>
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

				<?php require_once('scripts/exibir_chamados.php'); ?>
			</section><!-- Fim da Tela de Login -->
		</main><!-- Fim do Conteúdo -->
		<?php 
			require_once("scripts/script_js.php");
		?>
		<script type="text/javascript" src="js/chamado.js"></script>
	</body>
</html>