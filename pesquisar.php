<?php session_start(); ?>
<html>
	<head>
		<title>GPSI | Início</title>
		<?php include_once('head.php'); ?>
	</head>
	<body style="background:#E6E4E3;">
		<div style="position:relative; min-height:90%; top:0; bottom:0;">
			<?php 
			if(isset($_SESSION['id'])){
				include_once('menuAdmin.php'); 
			}
			else{
				include_once('menu.php');
			}
			?>
			<div class="row">
				<div class="large-12 columns">
					<?php 
						if (isset($_POST['texto'])){
							$texto = $_POST['texto'];
							
							//módulos, disciplinas, notícias
							
							//criar uma função no dataaccess 
							include_once('DataAccess.php');
							$da = new DataAccess();
							if (isset($_POST['texto'])){
								
								$res = $da->pesquisarDisciplinasPorTexto($_POST['texto']);
								$contador = 0;
								while($row = mysqli_fetch_object($res)){
									if ($contador == 0)
										echo "<div class='row' style='margin-top:2%;'>
												<h3>Disciplinas<hr/></h3>";
									$contador++;
									echo "
											<div class='large-2 columns'>
												<center>
													<a href='disciplina.php?i=$row->id'><img src='img/$row->img'/><br/>
													$row->nome</a>
												</center>
											</div>
										";
									if ($contador%6 ==0)
										echo "</div><div class='row'>";
							    }
								if ($contador>0){
									while ($contador%6 != 0){
										echo "<div class='large-2 columns'>&nbsp;</div>";
										$contador++;
									}
									echo "</div>";
								}
									
								$res = $da->pesquisarModulosPorTexto($_POST['texto']);	
								$contadorM = 0;
								while($row = mysqli_fetch_object($res)){
									if ($contadorM == 0)
										echo "<div class='row' style='margin-top:2%;'>
												<h3>Módulos<hr/></h3>";
									$contadorM++;
									echo "
											<div class='large-2 columns'>
												<center>
													<a href='modulo.php?i=$row->id'><img src='img/modulos.ico' style='width:48px'/><br/>
													$row->nome</a>
												</center>
											</div>
										";
									if ($contadorM%6 ==0)
										echo "</div><div class='row'>";
							    }
								if ($contadorM>0){
									while ($contadorM%6 != 0){
										echo "<div class='large-2 columns'>&nbsp;</div>";
										$contadorM++;
									}
									echo "</div>";
								}
								
								//$res = $da->pesquisarNoticiasPorTexto($_POST['texto']);
									
							}
						
							
							if ($contador == 0 && $contadorM == 0)
							{
								echo"<script>alert('Erro. Não foram encontrados resultados.');</script>";
								if(isset($_SESSION['id'])){
									echo "<script>window.location='indexAdmin.php'</script>";
								}
								else{
									echo "<script>window.location='index.php'</script>";
								}
							}
							
						}else{
							echo "<script>window.location='index.php'</script>";
						}
					?>			
				</div>   
			</div>
		</div>
		<?php include_once('footer.php'); ?>
		<?php include_once('importarScripts.php'); ?>
	</body>
</html>