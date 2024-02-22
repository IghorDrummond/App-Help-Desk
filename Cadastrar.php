<?php require_once("scripts/validador_index.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once("scripts/styles.php");
		?>
		<!-- Estilo da Página -->
		<link rel="stylesheet" type="text/css" href="css/cadastrar.css">

		<!-- Favicon -->
		<link rel="icon" href="img/logo.png">

		<!-- Titulo da Página -->
		<title>Help Desk - Cadastrar Conta</title>
	</head>
	<body>
		<header class="bg-dark p-2"><!-- Inicio do Cabeçalho -->
			<img src="img/logo.png" width="30">
			<p class="d-inline-block text-white">App Help Desk</p>
		</header><!-- Fim do Cabeçalho -->

		<main class="d-flex align-items-start justify-content-center"><!-- Inicio do Conteúdo -->
			<section class="border mt-4 text-left"><!-- Inicio d a tela de Login -->
				<div class="p-2 border-bottom">
					<h5 class="w-25 text-secondary">Cadastro</h5>
				</div>

				<form action="scripts/cadastaremail.php" method="POST" class="form-group p-3">
					<fieldset class="form-group">
						<legend>Email</legend>
						<label for="Email">Insira o Email:</label>
						<input class="form-control" type="email" name="Email" required placeholder="Email">
					</fieldset>
					<fieldset class="form-group">
						<legend>Senha:</legend>
						<label for="Senha">Insira a Senha:</label>
						<input class="form-control" type="password" name="Senha" minlength="8" placeholder="Insira a Senha" pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W+)(?=^.{8,50}$).*$" required>
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
							if(isset($_GET['Validacao'])){
								if($_GET['Validacao'] == 'Email'){
						?>		
							<div class="bg-warning text-center text-white font-bold border border-dark">
								<h6 class="text-dark">Este Email ja está Cadastrado! quer Recuperar a Senha?</h6>
								<a href="RenovarSenha.php" class="btn btn-info">Recuperar Senha</a>
								ou
								<a href="index.php" class="btn btn-info">Voltar para Login</a>
							</div>
						<?php 	} ?>
						<?php
								if($_GET['Validacao'] == 'Senha'){
						?>	
							<div class="bg-danger text-center text-white font-bold border border-dark">
								<h6 class="text-warning">As senhas não se Correspondem!</h6>
								<p>
									Insira a Senha e Confirme a Mesma respeitando as regras!
								</p>
								ou<br>
								<a href="index.php" class="btn btn-info">Voltar para Login</a>
							</div>							
						<?php 	} ?>									
						<?php } ?>	
					</fieldset>
					<input class="btn btn-info" type="submit" name="Enviar">
				</form>
			</section><!-- Fim da Tela de Login -->		
		</main>	
		<?php 
			require_once("scripts/script_js.php");
		?>
	</body>
</html>