<?php 
session_start();

if(isset($_SESSION['id'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getDisciplinas();

?>

<script>
	function mostrarModulos()
	{
		var index = document.getElementById("idDisciplina").selectedIndex;
		var value = document.getElementById("idDisciplina").options[index].value;
		
		window.location.href="editarModulos.php?i="+value;
	}
	
	function mostrarInfo()
	{
		var index = document.getElementById("idModulo").selectedIndex;
		var value = document.getElementById("idModulo").options[index].value;
		window.location.href="editarModulo.php?i="+value;
	}
	
</script>

<html>
	<head>
		<title>GPSI | Editar Módulos</title>
		<?php include_once('head.php'); ?>
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
						<div class='row' style='margin-top:2%' id='rowDisciplina'>
							<div class='large-12 columns'>	
								<label>Selecione a disciplina</label>
								<select name='idDisciplina' id='idDisciplina' onchange='mostrarModulos()'>
									<option value='-1'></option>
								<?php	
									while($row = mysqli_fetch_object($res)){
									//disciplina escolhida -> option selected
										if (isset($_GET['i'])){
											if ($_GET['i'] == $row->id)
												echo"<option value='$row->id' selected>$row->nome</option>";
											else
												echo "<option value='$row->id'>$row->nome</option>";
										}else
											echo "<option value='$row->id'>$row->nome</option>";
										
										
									}
								?>
								</select>
							</div>
						</div>
						<div class='row' style='margin-top:2%;' id='rowModulo'>
							<div class='large-12 columns'>	
								<label>Selecione o módulo</label>
								<select name='idModulo' id='idModulo' onchange='mostrarInfo()'>
									<option value='-1'></option>
								<?php
									if (isset($_GET['i'])){
										$id = $_GET['i'];
										$res2 = $da->getModulosDisciplina($id);
								
										while($row = mysqli_fetch_object($res2)){
											echo "<option value='$row->id'>$row->nome</option>";
										}
									}
								?>
								</select>
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