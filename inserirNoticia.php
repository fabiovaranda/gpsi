<?php
//FALTA VERIFICAÇÃO DE ADMIN
session_start();
session_name('gpsi');

function uploadFile($ficheiro){
	$target_dir = "img/noticias/";
	$target_file = $target_dir . basename($ficheiro["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	// Check if image file is a actual image or fake image
	$check = getimagesize($ficheiro["tmp_name"]);
	if($check !== false) {
		//echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "<script>alert('File is not an image.')</script>";
		$uploadOk = 0;
	}
	
	// Check file size
	if ($ficheiro["size"] > 5242880) {
		echo "<script>alert('Só aceita imagens até 5MB')</script>";
		$uploadOk = 0;
	}
	
	// Allow certain file formats
	$imageFileType = strtolower($imageFileType);
	//echo "<script>alert('$imageFileType')</script>";
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		//echo "Sorry, your file was not uploaded.";
		return -1;
	} else {
		if (move_uploaded_file($ficheiro["tmp_name"], $target_file)) {
			return 1;
			//echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			//echo "Sorry, there was an error uploading your file.";
			return -1;
		}
	}
	/*fim de upload*/
}

if(isset($_SESSION['id'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	if (isset($_POST['titulo'])){
		
		//fazer upload de imagemPrincipal
		$res = uploadFile($_FILES['imagemPrincipal']);
		if ($res != -1){
			$erro = false;
			$titulo = $_POST['titulo'];
			$texto = $_POST['corpo'];
			$data = date("Y-m-d");
			$video = $_POST['video'];
			$tags = $_POST['tags'];
			$idUtilizador = $_SESSION['id'];
			$nomeImagemPrincipal = basename($_FILES['imagemPrincipal']["name"]);
			
			//se upload ok então insere noticia
			$idNoticia = $da->inserirNoticia($titulo, $texto, $data, $video, $tags, $idUtilizador, $nomeImagemPrincipal);
			
			//se tudo ok até aqui insere as outras imagens
			for($i = 0; $i<$_POST['contaImagens'];$i++)
			{
				$nome = 'fileToUpload';
				
				if ($i>0){
					$nome .= "_$i";
				}
				
				if ($_FILES[$nome]['name'] != ""){
					$res = uploadFile($_FILES[$nome]);
					
					if ($res == -1) $erro = true;
					else{
						$foto = basename($_FILES[$nome]['name']);
						$da->inserirFotoNoticia($idNoticia, $foto);
					}
				}
			}
		}else
			$erro = true;
		
		if ($erro == true){
			echo "<script>alert('Noticia inserida com sucesso, apesar de alguma(s) foto(s) não terem sido inseridas corretamente')</script>";
		}else{
			echo "<script>alert('Noticia inserida com sucesso')</script>";
			}
	}
?>

<html>
	<head>
		<title>GPSI | Inserir Notícia</title>
		<?php include_once('head.php'); ?>
		<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
		<script>tinymce.init({selector:'textarea'});</script>
		<script>
			function confirmarEnvio(){
				return confirm('Tem a certeza?');
			}
			
			function addImageButton(){
				var $wrapper = document.getElementById('wrapper');
				HTMLTemporario = $wrapper.innerHTML;
				var x = document.getElementById("wrapper").children;
				var name="";
				var conta = 0;
				conta = x.length / 2;
				name = 'fileToUpload_'+conta;				
				HTMLNovo = "<input type='file' name='"+name+"' class='button tiny' style='width:30%'/><br/>";
				// Concatena as strings colocando o novoHTML antes do HTMLTemporario
				HTMLTemporario = HTMLTemporario + HTMLNovo;
				// Coloca a nova string(que é o HTML) no DOM
				$wrapper.innerHTML = HTMLTemporario;
				document.getElementById('contaImagens').value = conta+1;
			}
		</script>
	</head>
	<body style="background:#E6E4E3">
		<div style="position:relative; min-height:87%; top:0; bottom:0">
			<?php include_once('menuAdmin.php');?>
			<div class='row'>
				<div class='large-12 columns'>	
				<br/>
				<p style=' font-color:#333333; font-size:20;'><strong>Inserir Notícia</font></strong></p>
				<hr style='border-style:inset; border-width: 1px;'>
					<form method='post' action='' enctype='multipart/form-data'>
						<div class='row' style='margin-top:2%'>
							<div class='large-6 columns'>
								<label>Título</label>
								<input type='text' name='titulo' required/>
							</div>
							<div class='large-6 columns'>
								<label>Tags</label>
								<input type='text' name='tags' placeholder='Separe as tags com uma vírgula' required/>
							</div>
						</div>
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns'>	
								<label>Corpo da Notícia</label>
								<textarea name='corpo' ></textarea>
							</div>
						</div>
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns'>	
								<label>Imagem Principal</label>
								<input type='file' name='imagemPrincipal' class='button tiny' style='width:30%' required/>
							</div>
						</div>
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns'>
								<label>Vídeo</label>
								<input type='text' name='video' placeholder='Insira aqui o link do YouTube' required/>
							</div>
						</div>	
						
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns' id='wrapper'>
								<input type='file' name='fileToUpload' class='button tiny' style='width:30%'/><br/>
							</div>
						</div>	
						<div class='row' style='margin-top:2%'>
							<div class='large-12 columns' id='wrapper'>
								<input type='hidden' name='contaImagens' id='contaImagens' value='1'/>
								<a href='#' onclick='addImageButton()'><label>Mais imagens</label></a>
							</div>
						</div>	
						<div class='row' style='margin-top:2%'>
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