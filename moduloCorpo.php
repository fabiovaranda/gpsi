<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getModulo($id);
	while($row = mysqli_fetch_object($res)){
		//informação do módulo
	echo"
        <br/>
		<p style=' font-color:#333333; font-size:20;'><strong>$row->numero. $row->nome</font></strong></p>
		<hr style='border-style:inset; border-width: 1px;'>
			<div class='row'>
				<div class='large-8 columns'>
					<p style= 'font-color: #333333;'><strong>Duração: $row->numHoras horas</font></strong></p>
					<p style= 'font-color: #333333;'><strong>Objetivos do módulo</font></strong></p>
					<p>$row->descricao</p>
				</div>
				<div class='large-4 columns panel'>
					<center>
					<p style= 'font-color: #333333;'><strong>Ficheiros</font></strong></p>
                    ";
                    $res3 = $da->getFicheirosModulo($id);
                    while($row3 = mysqli_fetch_object($res3)){
                    echo"
                    <label><u><strong>$row3->nome</strong></u></label>
                    <a href='ficheiros/Modulos/$row3->ficheiro'>$row3->ficheiro</a>&nbsp;&nbsp;<img src='img/download.png'/>
                    <label>$row3->descricao</label>
                    <hr/>
                    ";
                    }
    echo"
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
						$res2 = $da->getModulosDisciplina($id);
						while($row2 = mysqli_fetch_object($res2)){
						echo"
							<tr>
								<td><center>$row2->numero</center></td>
								<td><a href='modulo.php?i=$row2->id'>$row2->nome</td>
								<td><center>".$row2->numHoras."h</center></td>
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
