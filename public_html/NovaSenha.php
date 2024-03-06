<?php require_once("scripts/validador_Senha.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once("scripts/styles.php");
		?>
		<!-- Estilo da Página -->
		<link rel="stylesheet" type="text/css" href="css/NovaSenha.css">

		<!-- Favicon -->
		<link rel="icon" href="img/logo.png">

		<!-- Titulo da Página -->
		<title>Help Desk - Cadastrar Conta</title>
	</head>
	<body>
		<?php
			require_once('scripts/menu_index.php');
		?>

		<main class="d-flex align-items-start justify-content-center"><!-- Inicio do Conteúdo -->
				<form action="scripts/ConfiguraSenha.php" method="POST" class="form-group p-3">
					<fieldset class="form-group">
						<legend>Senha:</legend>
						<label for="Senha">Insira a Senha:</label>
						<input onkeyup="validaCaracteres()" class="form-control" type="password" name="Senha" minlength="8" placeholder="Insira a Senha" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W+)(?=^.{8,50}$).*$" required>
						<label for="Senha">Confirme a Senha:</label>
						<input pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W+)(?=^.{8,50}$).*$" class="form-control" type="password" name="ConfirmaSenha" minlength="8" placeholder="Insira a Senha" required>
						<br>
						<p>
							Vale Lembrar que a Senha deve Conter:<br>
						</p>		
						<ul class="text-warning">
							<li>8 ou mais Caracteres</li>
							<li>Uma ou mais Letra Maíscula</li>
							<li>Um ou mais Numero</li>
							<li>Um ou mais Símbolo</li>
						</ul>
						<?php
								if(isset($_GET['Validacao']) and $_GET['Validacao'] == 'Senha'){
						?>	
							<div class="bg-danger text-center text-white font-bold border border-dark">
								<h6 class="text-warning">As senhas não se Correspondem!</h6>
								<p>
									Insira a Senha e Confirme a Mesma respeitando as regras!
								</p>
							</div>							
						<?php 	} ?>									
					</fieldset>
					<input class="btn btn-info" type="submit" name="Enviar">
				</form>
		</main><!-- Fim do Conteúdo -->
		<!-- Script da Página -->
		<script type="text/javascript" src="js/NovaSenha.js"></script>
		<?php
			require_once("scripts/script_js.php");
		?>
	</body>
</html>