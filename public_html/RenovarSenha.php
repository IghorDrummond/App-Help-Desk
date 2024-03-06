<?php require_once("scripts/validador_index.php"); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once("scripts/styles.php");
		?>
		<!-- Estilo da Página -->
		<link rel="stylesheet" type="text/css" href="css/RenovarSenha.css">

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
			<?php
				if (isset($_GET['Tela']) === false) {
			?>
				<section class="border mt-4 text-left"><!-- Inicio d a tela de Login -->
					<div class="p-2 border-bottom">
						<h5 class="w-25 text-secondary">Recuperar Senha</h5>
					</div>

					<form class="form-group" action="scripts/requerirsenha.php" method="POST" class="form-group p-3">
						<fieldset class="form-group m-2">
							<legend class="form-group" for="Email">Digite seu Email:</legend>
							<input class="form-control" name="Email" type="email" placeholder="youremail@email.com" required>
						</fieldset>
						<fieldset class="form-group">
							<?php if (isset($_GET['Validacao']) && $_GET['Validacao'] === 'email') { ?>
								<div class=" w-50 m-auto border border-dark bg-danger p-2 mb-2 text-center">
									<h6>Prezado(a) usuário(a)</h6>
									<p>
										Gostaríamos de informar que o endereço de email que você forneceu não foi encontrado em
										nossos registros.<br>
										Por favor, verifique se o endereço de email foi digitado corretamente e tente novamente.
									</p>
								</div>
							<?php } ?>
						</fieldset>
						<input class="btn btn-info w-50 m-auto d-block" type="submit" name="Acesso" value="Enviar">
					</form>
				</section><!-- Fim da Tela de Login -->
			<?php
				}else{
			?>
				<section class="border mt-4 text-left">
					<div class="p-2 border-bottom">
						<h5 class="w-25 text-secondary">Insira o Código</h5>
					</div>

					<!-- Inicio do Formulario -->
					<form class="form-group" action="scripts/verificarCodigo.php" method="POST" class="form-group p-3">
						<fieldset class="form-group m-2"><!-- Primeiro Corpo do Formulario -->
							<input class="d-none" readonly name="Dado" value="<?php echo($_GET['Dado']); ?>">
							<legend class="form-group" for="Codigo">Insira o Codigo:</legend>
							<input class="form-control" name="Codigo" type="text" maxlength="8" placeholder="..." required>
						</fieldset><!-- Fim do Primeiro Corpo do Formulario -->

						<fieldset class="form-group"><!-- Segundo Corpo do Formulario -->
							<?php
								if(isset($_GET['Validacao']) === false){ 
							?>
								<p id="sucesso" class="p-1 m-2 text-success">
									Seu Codigo foi enviado para
									<span name="Email">
									<?php
										print($_GET['Dado']);
									?>
									</span> via Email, verifique sua caixa de entrada ou spam.
								</p>
							<?php
								}
							?>
							<p class="m-2 text-warning bg-light p-1">
								Importante: O código tem a validade de 1 dia completo, caso seu código expirou a data de dias
								obrigatório, solicitar um novo código fazendo uma nova solicitação de senha.
							</p>

							<?php 
								if(isset($_GET['Validacao'])){ 
									if($_GET['Validacao'] === 'Codigo'){
							?>
								<div class=" w-50 m-auto border border-dark bg-danger p-2 mb-2 text-center">
									<h6>Código Invalido!</h6>
									<p>
										O código Inserido está invalido, Insira-o Novamente ou tente mais tarde.
									</p>
								</div>
							<?php 
								} 
								else if($_GET['Validacao'] === 'Data'){
							?>
								<div class=" w-50 m-auto border border-dark bg-danger p-2 mb-2 text-center">
									<h6>Data Expirada!</h6>
									<p>
										O Código Inserido está com a data Expirada, Gere um Novo Código No botão abaixo
									</p>
									<a class="btn btn-info d-inline-block m-auto" href="RenovarSenha.php">Novo Código</a> ou
									<a class="btn btn-info d-inline-block m-auto" href="index.php">Voltar ao Inicio</a>
								</div>
							<?php 
								} 
								else if($_GET['Validacao'] === 'Existe'){
							?>
								<div class=" w-50 m-auto border border-dark bg-danger p-2 mb-2 text-center">
									<h6>Solicitação Inexistente!</h6>
									<p>
										Não Foi encontrado Nenhuma Solicitalção Existente em Nossos Bancos de Dados, Caso queira trocar a senha, selecione o botão Abaixo

									</p>
									<a class="btn btn-info d-inline-block m-auto" href="RenovarSenha.php">Solicitar Nova Senha</a> ou
									<a class="btn btn-info d-inline-block m-auto" href="index.php">Voltar ao Inicio</a>
								</div>
							<?php 
								} 
							}
							?>							
						</fieldset><!-- Fim do Segundo Corpo do Formulario -->

						<input class="btn btn-info w-50 m-auto d-block" type="submit" name="Acesso" value="Validar">
					</form><!-- Fim do Formulario -->
				</section>
			<?php
				}
			?>
		</main><!-- Fim do Conteúdo -->
		<!-- Script da Página -->
		<script type="text/javascript" src="js/renovarsenha_js.js"></script>
		<?php
			require_once("scripts/script_js.php");
		?>
	</body>
</html>