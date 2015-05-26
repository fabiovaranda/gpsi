<?php session_start();?>
<html>
	<head>
		<title>GPSI | Sobre</title>
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
			}
			?>
			<?php include_once('sobreCorpo.php'); ?>
			
		</div>
		<?php include_once('footer.php'); ?>
		<?php include_once('importarScripts.php'); ?>
	</body>
</html>