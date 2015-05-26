<?php 
//colocar verificação de acesso para admin!
session_start();
session_name('gpsi'); 

if(isset($_SESSION['id'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	if (isset($_POST['descricao'])){
		$descricao = $_POST['descricao'];
		$idDisciplina = $_POST['idDisciplina'];
		/*fazer upload de ficheiro*/
		$target_dir = "img/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
		//		echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
			//	echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		//	echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		
		// Allow certain file formats
		$imageFileType = strtolower($imageFileType);
		//echo "<script>alert('$imageFileType')</script>";
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		//	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				//echo "<script>alert('$target_file');</script>";
			//	echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				$da->inserirDescricaoDisciplina($descricao, $idDisciplina, $_FILES["fileToUpload"]["name"]);
				echo "<script>alert('Disciplina atualizada com sucesso')</script>";
			} else {
				//echo "Sorry, there was an error uploading your file.";
			}
		}
		/*fim de upload*/
		
	}
?>

<html>
	<head>
		<title>GPSI | Editar Disciplina</title>
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
				<p style=' font-color:#333333; font-size:20;'><strong>Editar Disciplina</font></strong></p>
				<hr style='border-style:inset; border-width: 1px;'>
					<form method='post' action='' enctype='multipart/form-data'>
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns'>	
								<textarea name='descricao'></textarea>
							</div>
						</div>
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns'>	
								<input type='file' name='fileToUpload' class='button tiny'/>
							</div>
						</div>
						<div class='row' style='margin-top:2%'>
							<div class='large-8 columns'>
								<select name='idDisciplina'>
								<?php	
									
									$res = $da->getDisciplinas();
									while($row = mysqli_fetch_object($res)){
										echo "<option value='$row->id'>$row->nome</option>";
									}
								?>
								</select>
							</div>							
							<div class='large-4 columns'>
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