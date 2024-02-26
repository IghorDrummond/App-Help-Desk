				<?php 	
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

					//Abrir Banco de Dados Txt
					$Arquivo = fopen('../app_help_desk/bd_chamados.txt', 'r');	
							
					while(!feof($Arquivo)){
						$Linha = explode(';', fgets($Arquivo));

						if(isset($Linha[1]) === false){
							continue;
						}

						if($Linha[5] != $_SESSION['Usuario_Id']){
							if($_SESSION['Permissao'] === false){
								continue;
							}
						}

						$nPosic = array_search($Linha[4], $Color[0]);//Retorna a Posição da Prioridade do Ticket
						$usuario = $Linha[6];//Retorna o Usuario que abriu o Ticket
				?>
					<div class="chamado m-2 border border-bottom border-top border-dark p-2 <?php echo $Color[1][$nPosic];?>">
						<h3><?php echo($Linha[1]); ?></h3>
						<hr>
						<h4>Categoria: <?php echo("$Linha[2]");?></h4>
						<p class="border border-dark">
							<strong>Descrição:</strong><br>
							<?php
								echo $Linha[3];
							?>
						</p>
						<h6>Aberto pelo Usuario: <?php echo $usuario; ?>.</h6>
						<h6 class="Modalidades">Modalidade: <?php echo "$Linha[4]" ?></h6>
						<h6>Data do Chamado: <time><?php echo trim($Linha[7], PHP_EOL); ?></time></h6>
					</div>
				<?php
					}
					echo("<h6 class='text-center'>Fim dos Chamados</h6>");
					fclose($Arquivo);
				?>