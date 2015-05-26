<?php

$id = $_GET['i'];
include_once('DataAccess.php');
$da = new DataAccess();
$da->eliminarUtilizadores($id);

echo "<script>
    alert('Utilizador eliminado com sucesso');
    window.location='gerirUtilizadores.php';
</script>";
?>