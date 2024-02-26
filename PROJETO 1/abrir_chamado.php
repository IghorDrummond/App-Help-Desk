<?php require_once("scripts/validador_acesso.php"); ?>
<!DOCTYPE html>
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
		<title>Help Desk - Abrir Chamado</title>
	</head>
	<body>
		<?php 
			require_once("scripts/menu.php"); 
		?>

		<main class="d-flex align-items-start justify-content-center"><!-- Inicio do Conteúdo -->
			<section class="border mt-4"><!-- Inicio da tela de Login -->
				<div class="p-2 text-left border-bottom">
					<h5 class="text-secondary">Abertura de Chamado</h5>
				</div>

				<form action="scripts/solicitacao.php" method="POST" class="form-group p-2">
					<fieldset class="form-group">
						<legend>Título</legend>
						<input type="text" name="Titulo" class="form-control" placeholder="Título" required>
					</fieldset>
					<fieldset class="form-group">
						<legend>Categoria</legend>
						<select class="form-control" Name="Categoria" required>
							<option selected>Escolha Uma Categoria</option>
							<option>Criação de Usuário</option>
							<option>Impressora</option>
							<option>Hardware</option>
							<option>Software</option>
							<option>Rede</option>
						</select>
						<?php 
							if(isset($_GET['Categoria']) and $_GET['Categoria'] === 'erro'){
						?>
							<div class="w-100 border border-danger text-center text-danger p-2 mt-2">
								<h6>Insira uma Categoria Valida!</h6>
							</div>
						<?php 
							}
						?>
					</fieldset>	
					<fieldset class="form-group">
						<legend>Descrição</legend>
						<textarea name="Descricao" class="form-control" required></textarea>
					</fieldset>	
					<fieldset class="form-group">
						<legend>Prioridade</legend>
						<select class="form-control" name="Prioridade">
							<option selected>Baixa</option>
							<option >Média</option>
							<option >Alta</option>
						</select>
					</fieldset>						
					<div class="form-group">
						<a class="btn btn-warning linha mt-2" href="home.php">Voltar</a>
						<input type="submit" class="btn btn-info linha mt-2" href="chamados.php" value="Abrir">
					</div>									
				</form>
			</section><!-- Fim da Tela de Login -->
		</main><!-- Fim do Conteúdo -->

		<?php 
			require_once("scripts/script_js.php");
		?>
	</body>
</html>