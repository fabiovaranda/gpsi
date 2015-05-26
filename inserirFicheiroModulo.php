<?php
$target_dir = "ficheiros/Modulos/";
if(isset($_POST["submit"])) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . basename($_FILES["fileToUpload"]["name"]))) 
    {
                echo"<script>alert('Ficheiro inserido com sucesso.');
                     window.location.assign('indexAdmin.php');
             </script>";
    }
}
?>

<?php 
session_start();
if(isset($_SESSION['id'])){
	include_once('DataAccess.php');
	$da = new DataAccess();
	$id = $_GET['i'];
	
	if (isset($_POST['nome']))
	{
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$ficheiro = ($_FILES['fileToUpload']['name']);
		$da->inserirFicheiro($nome, $descricao, $ficheiro, $id);

	}

?>

<html>
	<head>
		<title>GPSI | Ficheiros</title>
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
			<?php
			include_once('menuAdmin.php'); 
			?>
			<div class="row">
				<div class="large-12 columns">
					<br/>
                    <p style=' font-color:#333333; font-size:20;'><strong>Inserir Ficheiro</font></strong></p>
                    <hr style='border-style:inset; border-width: 1px;'>
                    <form method='post' action='' enctype='multipart/form-data'>
                    <div class='row' style='margin-top:2%'>
                        <div class='large-12 columns'>
                            <label>Nome</label>
                            <input type='text' name='nome' style='width:50%;' required></input>
                        </div> 
                    </div>
                    <div class='row' style='margin-top:2%'>
                        <div class='large-12 columns'>
                            <label>Descrição</label>
                            <textarea name='descricao' required></textarea>
                        </div> 
                    </div>
                    <div class='row' style='margin-top:2%'>
                        <div class='large-12 columns'>
                            <label>Ficheiro</label>
                            <input type='file' name='fileToUpload' id='fileToUpload' name='ficheiro' required/>
                        </div> 
                    </div>
                    <div class='row' style='margin-top:2%'>
                        <div class='large-12 columns'>
                            <input type='submit' name='submit' value='Enviar' class='button tiny' onclick='return confirmarEnvio()'/>
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