	
	<div class="row hide-for-small" style='margin-top:2%'>
		<div class="large-12 columns">
		<ul data-orbit data-options="timer_speed:2000;animation_speed:800; slide_number:false;bullets:false;">
			<li>
				<img src="img/logoGPSI.jpg" style='width:1000px; height:300px'/>
			</li>
			<li>
				<img src="img/1.jpg" style='width:1000px; height:300px'/>
			</li>
			<li class="active">
				<img src="img/2.jpg" style='width:1000px; height:300px'/>
			</li>
			<li>
				<img src="img/3.jpg" style='width:1000px; height:300px'/>
			</li>
		</ul>
		</div>
	</div>
	<div class="row" style='margin-top:2%'>
	<?php
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getNoticias();
		$conta =0;
		while($row = mysqli_fetch_object($res)){
			$conta++;
			echo "
					<div class='large-4 columns'>	
						<a href='noticia.php?i=$row->id'>
							<img src='img/noticias/$row->foto' style='width:100%; height:200px;'>
						</a>
						<label>$row->titulo</label>
					</div>
				";
			if($conta == 3)
				break;
		}
		if($conta <3){
			for($i=$conta; $i<3; $i++){
				echo "
					<div class='large-4 columns'>	
						&nbsp;
					</div>
				";
			}
		}
	
		
	?>
	</div>
