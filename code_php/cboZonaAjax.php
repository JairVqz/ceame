<?php
require_once("../conecta.php");
  
if($idnivel_m==60 || $idnivel_m==61 || $idnivel_m==65 || $idnivel_m==67 || $idnivel_m==68){
	$tabla="ct_c12_secundarias";
}else{
	$tabla="ct_c12";  
}

$qZona="SELECT distinct(t1.cct_zona), t1.nom_ct AS nom_zona, t2.cct FROM zona_c t1,$tabla t2 WHERE t1.cct_zona=t2.cct_zona AND t2.idnivel='".$idnivel_m."'";
$rqZona=mysql_query($qZona)or die('no se puede ejecutar qZona');
?>

<select>
<option>[Seleccione la zona]</option>
<?php
while($filZona=mysql_fetch_array($rqZona)){
	$cct_zona=$filZona['cct_zona'];
	$nom_zona=$filZona['nom_zona'];
	$cct=$filZona['cct'];
	$cct_zona=$filZona['cct_zona'];
	
?>
<option><?php echo $cct_zona."   -  ".$nom_zona; ?></option>

<?
}
mysql_free_result($rqZona);
?>

</select>
