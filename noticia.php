<?php session_start();?>
<html>
	<head>
		<title>GPSI | Disciplinas</title>
		<?php include_once('head.php'); ?>
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
			<div class="row">
				<div class="large-12 columns">
					<?php include_once('corpoNoticia.php'); ?>
				</div>   
			</div>
		</div>
		<?php include_once('footer.php'); ?>
		<?php include_once('importarScripts.php'); ?>
	</body>
</html>