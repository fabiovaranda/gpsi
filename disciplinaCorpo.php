<script>
function mostrarElencoModular()
{
	document.getElementById("elencoModular").style.display = "block";
}
</script>

<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getDisciplina($id);
	while($row = mysqli_fetch_object($res)){
		//informação da disciplina
	echo"
        <br/>
		<p style=' font-color:#333333; font-size:20;'><strong>$row->nome</font></strong></p>
		<hr style='border-style:inset; border-width: 1px;'>
			<div class='row'>
				<div class='large-8 columns'>
					<p>$row->descricao</p>
				</div>
				<div class='large-4 columns panel'>
					<center>
					<img src='img/elencomodular.png' onclick='mostrarElencoModular()'>
					<br/>
						<label style='margin-top:4%;' onclick='mostrarElencoModular()'>Ver Elenco Modular</label>
					<br/>
					<a href='$row->ficheiro' target='_blank'><img src='img/pdfmodal.png'/></a>
					<br/>
						<label style='margin-top:2%;'>Ver Programa</label>
					</center>
				</div>
			</div>
			<div class='row'>
				<div class='large-12 columns' id='elencoModular' style='display:none;'>
					<table width='100%'>
						<thead>
							<tr>
								<th width='10%'><center>Número</center></th>
								<th width='70%'><center>Designação</center></th>
								<th width='20%'><center>Duração de referência</center></th>
							</tr>
						</thead>
						<tbody>";
						$id = $_GET['i'];
						include_once('DataAccess.php');
						$da = new DataAccess();
						$res = $da->getModulosDisciplina($id);
						while($row = mysqli_fetch_object($res)){
						echo"
							<tr>
								<td><center>$row->numero</center></td>
								<td><a href='modulo.php?i=$row->id'>$row->nome</td>
								<td><center>".$row->numHoras."h</center></td>
							</tr>
						";
						}
						echo"
						</tbody>
					</table>
				</div>
			</div>";
		}
?>
