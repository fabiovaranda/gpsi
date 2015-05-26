<?php
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getDisciplinasPorArea();
	$area = "";
	$contarAreas = 0;
	$contarDisciplinasPorArea = 0;
	
	while($row = mysqli_fetch_object($res)){
		// echo"<script>alert('$row->nome');</script>";
		//nova área disciplinar
		if ($area == "" || $area != $row->area){
		
			if ($contarDisciplinasPorArea != 0 && $contarDisciplinasPorArea <6)
				while($contarDisciplinasPorArea <6){
					echo "<div class='large-2 columns'>&nbsp;</div>";
					$contarDisciplinasPorArea++;
				}
				
			if ($contarAreas >= 1){
				//já existe uma área, por isso temos que fechar a linha e iniciar uma nova
				echo "</div></div></div>";
			}
			$contarAreas++;			
			$contarDisciplinasPorArea = 0;
			$area = $row->area;			
			echo "
				<div class='row' style='margin-top:2%;'>
					<div class='large-12 columns panel' data-equalizer-watch>
						<label><strong>Componente $area</strong></label>
						<hr/>
						<div class='large-12 columns'>					
			";
		}
		$contarDisciplinasPorArea++;
		//echo "<script>alert('$row->nome $contarDisciplinasPorArea')</script>";
		//apresentar disciplinas
		echo "<div class='large-2 columns'>
				<center>
					<a href='disciplina.php?i=$row->id'><img src='img/$row->img'/><br/>
					$row->nome</a>
				</center>
			</div>";
	}
	//adicionar colunas para terminar a última componente
	if ($contarDisciplinasPorArea != 0 && $contarDisciplinasPorArea <6)
		while($contarDisciplinasPorArea <6){
			echo "<div class='large-2 columns'>&nbsp;</div>";
			$contarDisciplinasPorArea++;
		}
	//fechar a última div
	echo "</div></div></div>";
	
?>