<?php 
session_start();

if(isset($_SESSION['id'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	$id = $_GET['i'];
	$res = $da->getModulo($id);
	$row = mysqli_fetch_object($res);
	
	if (isset($_POST['numero']))
	{
		$numero = $_POST['numero'];
		$nome = $_POST['nome'];
		$numHoras = $_POST['numHoras'];
		$descricao = $_POST['descricao'];
		$id = $_GET['i'];
		$da->editarModulo($numero, $nome, $descricao, $numHoras, $id);
		echo"<script>alert('Módulo editado com sucesso.');
					 window.location.assign('indexAdmin.php');
			 </script>";
	}
?>
<html>
	<head>
		<title>GPSI | Editar Módulo</title>
		<?php include_once('head.php'); ?>
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea'});</script>
		<script>
			function confirmarEnvio(){
				return confirm('Tem a certeza?');
			}
		</script>
	</head>
	<body style="background:#E6E4E3">
		<div style="position:relative; min-height:87%; top:0; bottom:0">
			<?php include_once('menuAdmin.php'); ?>
			<div class='row'>
				<div class='large-12 columns'>	
				<br/>
				<p style=' font-color:#333333; font-size:20;'><strong>Editar Módulo</font></strong></p>
				<hr style='border-style:inset; border-width: 1px;'>
					<form method='post' action='' enctype='multipart/form-data'>
						<div class='row' style='margin-top:2%' id='row1'>
							<div class='large-3 columns'>	
								<label>Número</label>
								<input type='text' name='numero' value='<?php echo "$row->numero";?>'/>
							</div>
							<div class='large-6 columns'>
								<label>Nome</label>
								<input type='text' name='nome' value='<?php echo"$row->nome"; ?>'/>
							</div>
							<div class='large-3 columns'>
								<label>Número de Horas</label>	
								<input type='text' name='numHoras' value='<?php echo"$row->numHoras"; ?>'/>
							</div>
						</div>
						<div class='row' style='margin-top:2%;' id='row2'>
							<div class='large-12 columns'>	
								<label>Descrição</label>
								<textarea name='descricao'>
									<?php echo"$row->descricao"; ?>
								</textarea>
							</div>
						</div>
						<div class='row' style='margin-top:2%;'>
							<div class='large-12 columns'>
								<input type='submit' name='submit' value='Editar' class='button tiny' onclick='return confirmarEnvio()'/>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php include_once('footer.php'); ?>
		<?php include_once('importarScripts.php'); ?>
	</body>
</html>
<?php
}
else{
	echo"<script>window.location.assign('index.php')</script>";
}
?>