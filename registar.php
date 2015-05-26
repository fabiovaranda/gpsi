<?php session_start();?>
<?php
if(isset($_SESSION['id'])){
	if (isset($_POST['email'])){
		include_once('DataAccess.php');
		$da = new DataAccess();
		//registar novo prof
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$idTipoUtilizador = $_POST['tipoUtilizador'];
		$idProf = $da->inserirProfessor($nome, $email, $idTipoUtilizador);
		//apagar eventuais disciplinas do prof
		$da->apagarDisciplinaAProf($idProf);
		$contaDisciplina = $_POST['contaDisciplina'];
		for($i = 1; $i<=$contaDisciplina; $i++){
			$ck = "ck".$i;
			if (isset($_POST[$ck])){
				//adicionar a disciplina ao professor
				$da->associarProfADisciplina($idProf, $_POST[$ck]);
			}
		}
		echo "<script>alert('Utilizador registado com sucesso.')</script>";
	}
}else{
	echo"<script>window.location.assign('index.php');</script>";
}
?>
<!-- HTML -->
<html>
	<head>
		<title>GPSI | Inserir Utilizador</title>
		<?php include_once('head.php');//echo "<script>alert(screen.height);</script>"; ?>
		
		<script>	
			// função para validar o email 
			function validarMail(){
				var email = document.getElementById('email');
				var reg = /^[A-Za-z0-9._-]+@[a-z]+\.[a-z]{2,3}(\.[a-z]{2,3})?$/;
				// se o email não tiver as caracteristicas necessárias
				if (reg.test(email.value) == false){
				// dá um alerta e foca-se na caixa de texto do email
					alert('E-mail inválido');
					email.focus();
					return false;
				} // caso contrário o email é válido
				return true;
			}
			
			// função para validar o nome  
			function validarNome(){
				var nome = document.getElementById('nome');
				// se o nome tiver um espaço
				if (nome.value == " "){
				// dá um alerta e foca-se na caixa de texto do nome
					alert('Nome inválido');
					nome.focus();
					return false;
				} // caso contrário o nome é válido
				return true;
			}
			
			// função para validar o formulário 
			function validarForm(){
			// se o email ou o nome forem inválidos
				if (validarMail() == false || validarNome() == false){
				// não valida
					return false;
				}else{ // caso contrário é válido
				return true; 
				}
			}
			
			function verificarTipoUtilizador(){
				var tipoUtilizador = document.getElementById("tipoUtilizador").selectedIndex;
				switch(tipoUtilizador)
				{
					case 1:
					document.getElementById("rowDisciplinas").style.display = "none";
					document.getElementById("tipoUtilizador").selectedIndex = "1";
					break;
					case 2:
					document.getElementById("rowDisciplinas").style.display = "block";
					document.getElementById("tipoUtilizador").selectedIndex = "2";
					break;
					case 0:
					document.getElementById("rowDisciplinas").style.display = "none";
					document.getElementById("tipoUtilizador").selectedIndex = "0";
					break;
					default:
					break;
				}
			}
		</script>
	</head>
	<body style="background:#E6E4E3">
		<div style="position:relative; min-height:87%; top:0; bottom:0">
			<?php
				include_once('menuAdmin.php');
			?>
			<div class='row'>
				<div class='large-12 columns'>
					<br/>
					<p style=' font-color:#333333; font-size:20;'><strong>Inserir Utilizador</font></strong></p>
					<hr style='border-style:inset; border-width: 1px;'>
				</div>
			</div>
			<div class='row' style='background-color: #f2f2f2; margin-top:2%; border-style: solid; border-width: 1px; border-color: #d8d8d8;'>
				<div class='large-12 columns'>
					<form method='post'  action='registar.php'>
						<?php include_once('registar.html'); ?>
					</form>
				</div>
			</div>
		</div>
		<?php include_once('footer.php'); ?>
		<?php include_once('importarScripts.php'); ?>
		
	</body>
</html>