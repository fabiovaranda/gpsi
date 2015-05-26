<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$res = $da->getNoticia($id);
	while($row = mysqli_fetch_object($res)){
		//informação da disciplina
	echo"
		<p style=' font-color:#333333; font-size:20;'><strong>$row->titulo</font></strong></p>
		<hr style='border-style:inset; border-width: 1px;'>	
			<label><strong>Tags: </strong>$row->tags</label>
			<div class='row'>
				<div class='large-8 columns'>
					<p>$row->texto</p>
				</div>
				<div class='large-4 columns'>
					<ul data-orbit data-options='timer_speed:2000;animation_speed:800; slide_number:false;bullets:false;'>
						<li>
							<img src='img/noticias/$row->foto'/>
						</li>
						";
	}
						$res2 = $da->getFotosNoticia($id);
						while ($row = mysqli_fetch_object($res2)){
						echo"
						<li>
							<img src='img/noticias/$row->nome'/>
							<br/>
						</li>";
						}
						echo"
				</div>
			</div>";
?>