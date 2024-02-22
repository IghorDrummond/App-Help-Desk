<!DOCTYPE html>
<?php
	require_once("scripts/validador_index.php");
?>
<html>
	<head>
		<?php
			require_once("scripts/styles.php");
		?>
		<!-- Estilo da Página -->
		<link rel="stylesheet" type="text/css" href="css/login.css">

		<!-- Favicon -->
		<link rel="icon" href="img/logo.png">

		<!-- Titulo da Página -->
		<title>Help Desk - Login</title>
	</head>
	<body>
		<header class="bg-dark p-2"><!-- Inicio do Cabeçalho -->
			<img src="img/logo.png" width="30">
			<p class="d-inline-block text-white">App Help Desk</p>
		</header><!-- Fim do Cabeçalho -->

		<main class="d-flex align-items-start justify-content-center"><!-- Inicio do Conteúdo -->
			<section class="border mt-4"><!-- Inicio d a tela de Login -->
				<div class="py-2 text-center border-bottom">
					<h5 class="w-25 text-secondary">Login</h5>
				</div>

				<form action="login_vld.php" method="POST" class="form-group p-3">
					<div class="form-group">
						<input class="form-control Email" type="email" name="Email" placeholder="E-mail" required>
					</div>
					<div class="form-group">
						<input class="form-control Senha" type="password" name="Senha" placeholder="Senha" required >						
					</div>
					<?php
						if(isset($_GET['login']) && $_GET['login'] == 'erro'){
					?>			
						<div class="text-danger border border-danger form-group text-center">
							Usuário ou senha Invalido!
						</div>
					<?php } ?>	

					<?php
						if(isset($_GET['Validacao']) and $_GET['Validacao'] === 'Confirmado'){
					?>	
						<div class="w-100 border border-success p-2 mb-2 text-center text-success">
							<h6>Cadastro com Sucesso! Faça Login para Entrar.</h6>
						</div>
					<?php 
						}
					?>
					<div class="form-group">
						<input class="btn btn-info w-100" type="submit" name="Acessar" value="Entrar">
					</div>

					<a class="text-info bg-transparent border m-2 px-1" href="Cadastrar.php">Cadastrar Conta</a>
					<a class="text-info bg-transparent border m-2 px-1" href="RenovarSenha.php">Esqueci a Senha</a>
				</form>
			</section><!-- Fim da Tela de Login -->
		</main><!-- Fim do Conteúdo -->
	</body>
</html>