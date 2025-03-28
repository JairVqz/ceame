<?php
session_start(); 	
require_once('../conecta.php');
if ((!isset($logeado) && !isset($TxtUsuario))){
	echo "<br><br><br><br><table class='table'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
}else{
	if($es_secundaria==1){
		$tabla="ct_c12_secundarias";	
	}else{
		$tabla="ct_c12";
	}
	$update_cct="UPDATE $tabla set status='$modo' where cct='$cct' and turno='$turno'";
	mysql_query($update_cct)or die('no se puede actualizar update_cct');
	echo "<script>alert('Datos actualizados')</script>";
	echo "<script>window.location.href='../informatica/ficha_cct.php?ejecucion=1'</script>";
	
}







?>