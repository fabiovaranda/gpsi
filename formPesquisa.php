<script>
	function naoEncontra(){
		if ( isset($_POST['texto']).value != 
			isset($_POST['texto']).value ){
			alert('Não foi possível encontrar na base de dados!')
		window.location='index.php';
		return false;
		}else
		return true;
		}
	}
</script>
<form method='post' action='pesquisar.php'>
	<div class="row collapse">
		<div class="large-8 small-9 columns" align="left">
			<?php 
				if (isset($_POST['texto']))
					echo "<input type='text' placeholder='Pesquisa' id='texto' name='texto' required value='".$_POST['texto']."'/>";
				else
					echo "<input type='text' placeholder='Pesquisa' id='texto' name='texto' required />";
				
			?>
			
		</div>
		<div class="large-4 small-3 columns">
			<?php 
				if (isset($_POST['texto']))
					echo "<input type='submit' class='button expand hide-for-small hide-for-medium' value='Pesquisar'/>";
				else
					echo "<input type='submit' class='button expand hide-for-small hide-for-medium' onclick='naoEncontra()' value='Pesquisar'/>";
			?>
		</div>
	</div>
</form>