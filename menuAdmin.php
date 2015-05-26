<script>
    function searchKeyPress(e)
    {
        // look for window.event in case event isn't passed in
        e = e || window.event;
        if (e.keyCode == 13)
        {
            document.getElementById('btPesquisa').click();
        }
    }
</script>

<?php
function menuLogin()
{
echo"
<div id='divTopBar' style='width:100%; min-height:45px; top:0; position:relative; background: #333333;'>
	<div class='row'>
		<div class='large-12-columns'>
			<nav class='top-bar' data-topbar role='navigation'>
				<ul class='title-area'>
					<li class='hide-for-small hide-for-large hide-for-medium hide-for-xlarge'>
						<font style='color:#C7C5C1' size='5'>{</font>
					</li>
					<li class='name' >
						<h1>
						<font style='color:#C7C5C1' size='3.0625rem'><a href='indexAdmin.php' style='color:white'><b>GPSI</b></a></font>
						</h1>
					</li>
					<li class='toggle-topbar menu-icon'><a href='#'><span>Menu</span></a></li>
				</ul>

  <section class='top-bar-section'>
    <!-- Lado Direito -->
    <ul class='right'>
		<li class='has-form'>";
			include_once('formPesquisa.php');
			echo"
		</li>
		<li class='divider'>
		</li>
		<li>";
			include_once('modalLogin.php');
		echo"</li>
		<li>
							<font class='hide-for-small hide-for-large hide-for-medium hide-for-xlarge style='color:#C7C5C1' size='5'>}</font>
						</li>
    </ul>

    <!-- Lado Esquerdo -->
    <ul class='left'>
				  <li class='divider'></li>
				  <li><a href='sobre.php'>SOBRE</a></li>
				  <li class='divider'></li>
				  <li><a href='disciplinas.php'>DISCIPLINAS</a></li>
				  <li class='divider'></li>
				</ul>
  </section>
  </div>
	</div>
</div>";
}


function menuLogout()
{
echo"
<div id='divTopBar' style='width:100%; top:0; min-height:5%; position:relative; background: #333333;'>
	<div class='row'>
		<div class='large-12-columns'>
			<nav class='top-bar' data-topbar role='navigation'>
				<ul class='title-area'>
					<!--<li class='hide-for-small hide-for-large hide-for-medium hide-for-xlarge'>
						<font style='color:#C7C5C1' size='5'>{</font>
					</li>-->
					<li class='name' >
						<h1>
						<font style='color:#C7C5C1' size='3.0625rem'><a href='indexAdmin.php' style='color:white'><b>GPSI</b></a></font>
						</h1>
					</li>
					<li class='toggle-topbar menu-icon'><a href='#'><span>Menu</span></a></li>
				</ul>

				<section class='top-bar-section'>
					<!-- Lado Direito -->
					<ul class='right'>
						<li class='has-form'>";
						include_once('formPesquisa.php');
						echo"
						</li>
						<li class='divider'>
						</li>
						 <li class='has-dropdown not-click'>
							<a href='#'>OPÇÕES DE UTILIZADOR</a>
							<ul class='dropdown'>
							  <li class='title back js-generated'><h5><a href='javascript:void(0)'><label>Voltar</label></a></h5></li>
                              
							  <li><a href='registar.php'>Inserir Utilizador</a></li>
							  <li><a href='gerirUtilizadores.php'>Gerir Professores</a></li>
							  <li><a href='editarDisciplina.php'>Editar Disciplina</a></li>
							  <li><a href='inserirNoticia.php'>Inserir Notícia</a></li>
							  <li><a href='inserirModulo.php'>Inserir Módulo</a></li>
							  <li><a href='inserirFicheiro.php'>Inserir Ficheiro Módulo</a></li>
							  <li><a href='editarModulos.php'>Editar Módulo</a></li>
							</ul>
						</li>
						<li class='divider'>
						</li>
						<li>
							<a href='sair.php' onclick='return confirmarLogout()'>SAIR</a>
						</li>
						<li>
							<font class='hide-for-small hide-for-large hide-for-medium hide-for-xlarge style='color:#C7C5C1' size='5'>}</font>
						</li>
					</ul>

					<!-- Lado Esquerdo -->
					<ul class='left'>
					  <li class='divider'></li>
					  <li><a href='sobre.php'>SOBRE</a></li>
					  <li class='divider'></li>
					  <li><a href='disciplinas.php'>DISCIPLINAS</a></li>
					  <li class='divider'></li>
					</ul>
				</section>
			</nav>
		</div>
	</div>
</div>";
}
if(isset($_SESSION['id'])){
//está logado
menuLogout();
}
else{
menuLogin();
}

?>

<script>
    function confirmarLogout(){
        return confirm('Tem a certeza que deseja sair?');
    }
</script>