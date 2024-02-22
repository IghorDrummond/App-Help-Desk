<!DOCTYPE html>
<?php
	require_once("scripts/validador_acesso.php");
?>
<html>
	<head>
		<?php
			require_once("scripts/styles.php");
		?>
		<!-- Estilo da Página -->
		<link rel="stylesheet" type="text/css" href="css/home.css">

		<!-- Favicon -->
		<link rel="icon" href="img/logo.png">

		<!-- Titulo da Página -->
		<title>Help Desk - Home</title>
	</head>
	<body>
		<?php
			require_once("scripts/menu.php");
		?>
		<main class="d-flex align-items-start justify-content-center"><!-- Inicio do Conteúdo -->
			<section class="container p-2 border mt-4"><!-- Inicio da tela de Login -->
				<div class="d-flex justify-content-around">
					<div class="mr-auto text-center">
						<a href="abrir_chamado.php">
							<img src="img/formulario_abrir_chamado.png" width="50">
							<h5>Abrir Chamado</h5>
						</a>
					</div>
					<div class="text-center">
						<a href="chamados.php" title="Chamados">
							<img src="img/formulario_consultar_chamado.png" width="50">
							<h5>Consultar Chamado</h5>							
						</a>
					</div>
				</div>
			</section><!-- Fim da Tela de Login -->
		</main><!-- Fim do Conteúdo -->	

		<?php
			if(isset($_GET['Chamado']) and $_GET['Chamado'] === 'Aberto'){
		?>
			<div id="aviso" style="position: absolute;	z-index: 2; left: 25%; top: 30%;" class="border border-info text-center w-50 m-auto">
				<div class="bg-success text-white"><!-- Inicio da Tela de Aviso -->
					<h5>Solicitação Aberta com Sucesso!</h5>
				</div>
				<p>
					Sua Solicitação foi Aberta com Sucesso! Aguarde até que seja revisada pelo Time de Suporte.
				</p>
				<button class="btn btn-success w-25 mt-2" onclick="Fechar()">Ok</button>
			</div><!-- Fim da Tela de Aviso -->
			<script type="text/javascript">
				function Fechar(){
					var tela = document.getElementById("aviso");
					tela.style.display = 'none';
				}
			</script>			
		<?php } ?>	

		<?php
			require_once("scripts/script_js.php");
		?>
	</body>
</html>