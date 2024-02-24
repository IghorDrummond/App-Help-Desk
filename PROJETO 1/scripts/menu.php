<!-- Menu para Páginas -->
<header class="bg-dark p-2"><!-- Inicio do Cabeçalho -->
	<nav class="navbar-nav navbar-expand-lg navbar-dark bg-dark"><!-- Inicio da Navegação -->
		<div class="container-fluid"><!-- Inicio do Container -->
			<div class="row"><!-- Inicio da Linha -->

				<div class="col-6"><!-- Inicio da Primeira Coluna -->
					<a href="home.php">
						<img src="img/logo.png" width="30">
						<p class="d-inline-block text-white">App Help Desk</p>
					</a>
				</div><!-- Fim da Primeira Coluna -->

				<div class="col-6"><!-- Inicio da Segunda Coluna -->
					<!-- Inicio dos Menu Para Celular -->
					<button class="navbar-toggler" data-toggle="collapse" data-target="#menu-item">
          				<span class="navbar-toggler-icon"></span>
        			</button>

					<div class="collapse" id="menu-item"><!-- Menu para Celular/Tablet Inicio-->
						<ul class="navbar-nav text-right">
							<li class="nav-item">
								<a class="nav-link" href="home.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown"href="">Solicitações
								</a>
								<div class="dropdown-menu px-1">
									<a href="abrir_chamado.php">Abrir Chamados</a>
									<br><hr>
									<a href="chamados.php">Chamados Abertos</a>
								</div>
							</li>
							<li class="nav-item">
								<form action="login_vld.php" method="POST" class="form-inline">
									<input class="btn btn-info ml-auto" type="submit" name="acesso" value="Sair">
								</form>
							</li>							
						</ul>
					</div><!-- Menu para Celular/Tablet fim-->
					<!-- Fim dos Menu Para Celular -->

					<!-- Inicio dos Menu Para Desktop -->
					<div class="d-none d-lg-inline"><!-- Inicio Menu para Desktop -->
						<ul class="navbar-nav">
							<li class="nav-item">
								<a class="nav-link" href="home.php">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link dropdown-toggle" data-toggle="dropdown"href="">Solicitações
								</a>
								<div class="dropdown-menu">
									<a href="abrir_chamado.php">Abrir Chamados</a>
									<br><hr>
									<a href="chamados.php">Chamados Abertos</a>
								</div>
							</li>
							<li class="nav-item">
								<form action="login_vld.php" method="POST" class="form-inline">
									<input class="btn btn-info" type="submit" name="acesso" value="Sair">
								</form>
							</li>
						</ul>
					</div><!-- Fim do Menu para Desktop -->
				</div><!-- Fim da Segunda Coluna -->
			</div><!-- Fim da Linha -->
		</div><!-- Fim do Container -->		
	</nav><!-- Fim da Navegação -->
</header><!-- Fim do Cabeçalho -->