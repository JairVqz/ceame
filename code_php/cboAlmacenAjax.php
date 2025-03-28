<?php
require_once("../conecta.php");

if($idnivel_m==60 || $idnivel_m==61 || $idnivel_m==65 || $idnivel_m==67 || $idnivel_m==68){
	$tabla="ct_c12_secundarias";
}else{
	$tabla="ct_c12";  
}

if($idnivel_m==62 || $idnivel_m==63){
	$tabla_uno="almacenteles_c";	
}
else{
	$tabla_uno="almacen_c";
}
$qAlmacen="SELECT distinct(t1.almacen),t1.idalmacen
FROM $tabla_uno t1,$tabla t2 WHERE t1.idalmacen =t2.idalmacen AND t2.idnivel='".$idnivel_m."'";
$rqAlmacen=mysql_query($qAlmacen)or die('no se puede ejecutar qZona');
?>

<select onchange="getDivNumAlumnos();" name="idalmacen" id="idalmacen">
<option>[Seleccione el almacen]</option>
<?php
while($filAlmacen=mysql_fetch_array($rqAlmacen)){
	$almacen=$filAlmacen['almacen'];
	$idalmacen=$filAlmacen['idalmacen'];
	
?>
<option value="<?php echo $idalmacen;  ?>"><?php echo $almacen; ?></option>

<?php
}
mysql_free_result($rqAlmacen);
?>

</select>