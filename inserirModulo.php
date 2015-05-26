<?php
//FALTA VERIFICAÇÃO DE ADMIN
session_start();
session_name('gpsi');

if(isset($_SESSION['id'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	
	if (isset($_POST['numModulo'])){
		echo"<script>alert('numModulo isset')</script>";
		$numModulo = $_POST['numModulo'];
		$nomeModulo = $_POST['nomeModulo'];
		$descricao = $_POST['descricao'];
		$numHoras = $_POST['numHoras'];
		$idDisciplina = $_POST['idDisciplina'];
		
		$da->inserirModulo($numModulo, $nomeModulo, $descricao, $numHoras, $idDisciplina);
		
		echo "<script>alert('Módulo inserido com sucesso')</script>";
	}
?>

<html>
	<head>
		<title>GPSI | Inserir Módulo</title>
		<?php include_once('head.php'); ?>
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea'});</script>
		<script>
			function confirmarEnvio(){
				return confirm('Tem a certeza?');
			}
			
			function validarFormInserirModulo(){
				if ( document.getElementById('idDisciplina').value == -1 ){
					alert('Disciplina inválida');
					document.getElementById('idDisciplina').focus();
					return false;
				}
				return true;
			}
		</script>
	</head>
	<body style="background:#E6E4E3">
		<div style="position:relative; min-height:87%; top:0; bottom:0">
			<?php include_once('menuAdmin.php');?>
			<div class='row'>
				<div class='large-12 columns'>	
				<br/>
				<p style=' font-color:#333333; font-size:20;'><strong>Inserir Módulo</font></strong></p>
				<hr style='border-style:inset; border-width: 1px;'>
					<form method='post' onsubmit='return validarFormInserirModulo()'>
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns'>
								<label>Disciplina</label>
								<select name='idDisciplina' id='idDisciplina'>
									<option value='-1'></option>
								<?php	
									
									$res = $da->getDisciplinas();
									while($row = mysqli_fetch_object($res)){
										echo "<option value='$row->id'>$row->nome</option>";
									}
								?>
								</select>
							</div>
							<div class='large-3 columns'>
								<label>Número do Módulo</label>
								<input type='text' name='numModulo' id='numModulo' required/>
							</div>
							<div class='large-6 columns'>
								<label>Nome do Módulo</label>
								<input type='text' name='nomeModulo' id='nomeModulo' required/>
							</div>
							<div class='large-3 columns'>
								<label>Número de Horas</label>
								<input type='text' name='numHoras' id='numHoras' required/>
							</div>
						</div>
						
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns'>	
								<label>Descrição do Módulo</label>
								<textarea name='descricao' id='descricao' ></textarea>
							</div>
						</div>
						
						<div class='row' style='margin-top:2%'>
							<div class='large-2 large-centered columns'>
								<input type='submit' name='submit' value='Guardar' class='button tiny' onclick='return confirmarEnvio()'/>
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
