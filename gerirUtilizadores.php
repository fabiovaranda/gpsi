<?php 
	session_start();
	?>
<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='eliminarUtilizadores.php?i='+i;
        }
    }
	
	function confirmarPWD(){
	if ( document.getElementById('password').value != 
			document.getElementById('password2').value ){
		alert('As palavras-passe têm que ser iguais.');
		return false;
		}else
		return true;
	}
</script>

<html>

	<head>
		<title>GPSI | Gerir Utilizadores</title>
		<?php include_once('head.php');?>
	</head>
	<body style="background:#E6E4E3">
		<div style="position:relative; min-height:87%; top:0; bottom:0">
		<?php 
		
			if(isset($_SESSION['id'])){
			include_once('menuAdmin.php'); 
			}
			else{
			include_once('menu.php');
			}?>
		<div class="row ">
			<div class="large-12 columns" style="position: relative; padding:5">
			<br/>
			<p style=' font-color:#333333; font-size:20;'><strong>Gerir Utilizadores</font></strong></p>
			<hr style='border-style:inset; border-width: 1px;'>
				<table style='width:80%; border:none; background:#E6E4E3' align ='center'>
					<tbody>
						<tr>
							<form method='post' action=''>
								<td style='width:93%;'>
									<input type='text' style='width:100%' name='texto' placeholder='Pesquisa'/>
								</td>
								<td valign='top'>
									<img style='text-align: center; vertical-align: middle;' src='img/pesquisar.png'/>
								</td>
							</form>
						</tr>
						<?php 
							if(isset($_SESSION['id'])){
							include_once('DataAccess.php');
							$da = new DataAccess();
							if (isset($_POST['texto'])){
								//pesquisar utilizador por nome ou email
								$res = $da->pesquisarUtilizadorPorTexto($_POST['texto']);
							}else{
								$res = $da->getUtilizadores();
							}
						?>
					</tbody>
				</table>
				<table style='width:80%' align ='center'>
					<thead>
						<tr>
							<td>
							</td>
							<td>
								<center><strong>Utilizador</strong></center>
							</td>
							<td>
								<center><strong>Editar</strong></center>
							</td>
							<td>
								<center><strong>Remover</strong></center>
							</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							while($row = mysqli_fetch_object($res)){
								echo " 
								<tr style='background-color:white'>
									<td style='width:10%'>
										<center><img src='img/utilizador.png'></center>
									</td>
									<td>
										".$row->nome."
									</td>
									<td style='width:15%'>
										<label>
											<center><a href='#' data-reveal-id='myModal_".$row->id."'><img src='img/editar.png'></a></center>
										</label>
									</td>
									<td style='width:15%'>
										<label>
											<center><img src='img/eliminar.png' onclick='confirmacaoEliminacao(".$row->id.")' value='Eliminar'/></center>
										</label>
									</td>
								</tr>
								";
							}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td style='width:10%'>
							</td>
							<td style='width:60%'>
							</td>
							<td style='width:15%'>
							</td>
							<td style='width:15%'>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>   
		</div>
		
		<?php 
			//Tem de ir buscar o ID do utilizador selecionado, e com esse ID utilizar o método getUtilizador, para depois, em cada
			//caixa de texto, preencher o seu valor de acordo com os dados na bd
			if (isset($_POST['texto'])){
				//pesquisar utilizador por nome ou email
				$res = $da->pesquisarUtilizadorPorTexto($_POST['texto']);
			}else{
				$res = $da->getUtilizadores();
			}
			while($row = mysqli_fetch_object($res)){ 
			echo "
				<div id='myModal_".$row->id."' class='reveal-modal' data-reveal>
					<form method='post' action='gerirUtilizadores.php'>
						<div class='row' style='position:relative; top:30%'>
							<div class='large-4 columns'>&nbsp;</div>
							<div class='large-4 columns'>
								<div class='row panel'>
									<div class='large-12 columns'>
										<input type='hidden' name='id' value ='".$row->id."'/>
										<label>Nome</label>
										<input type='text' id='nome' name='nome' value='".$row->nome."' placeholder='' required/>
									</div>
									<div class='large-12 columns'>
										<label>Email</label>
										<input type='text' id='email' name='email' value='".$row->email."' placeholder='' required/>
									</div>
									<div class='large-12 columns'>
										<label>Palavra-passe</label>
										<input type='password' placeholder='' id='password' name='password' required/>
									</div>
									<div class='large-12 columns'>
										<label>Repetir a palavra-passe</label>
										<input type='password' placeholder='' id='password2' name='password2' required/>
									</div>
									<div class='large-4 large-centered columns'>
										<input type='submit' value='Guardar' onclick='return confirmarPWD()' class='button radius tiny'/>
									</div>
								</div>
							</div>
							<div class='large-4 columns'></div>
						</div>
						<a class='close-reveal-modal'>&#215;</a>
					</form>
				</div>";
			}
		
		
		if(isset($_POST['nome'])){
		//atualizar o utilizador
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$password = md5($_POST['password']);
		$id = $_POST['id'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$da->EditarUtilizador($nome,$email,$password,$id);
		
		echo 
		"<script>alert('O utilizador foi atualizado com sucesso'); 
					window.location='gerirUtilizadores.php';
				</script>";
		}
		?>
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