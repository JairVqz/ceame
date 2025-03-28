<?php
require_once("../conecta.php");

$qGpos="SELECT gpo1,gpo2,gpo3 FROM ct_c12_secundarias WHERE cct='$cct' AND turno='$turno'";
//$qGpos=" SELECT gpo1,gpo2,gpo3,gpo4,gpo5,gpo6 FROM ct_c12 WHERE cct='$cct' AND turno='$turno'"; aquì se habilita para primarias
$rqGpos=mysql_query($qGpos)or die('no se puede ejecutar qGpos');
?>
<?php
$filGpos=mysql_fetch_array($rqGpos);
$gpo1=$filGpos['gpo1'];
$gpo2=$filGpos['gpo2'];
$gpo3=$filGpos['gpo3'];
$gpo4=$filGpos['gpo4'];
$gpo5=$filGpos['gpo5'];
$gpo6=$filGpos['gpo6'];
if($grado==1){
	$grupos=$gpo1;		  
}
if($grado==2){
	$grupos=$gpo2;		  
}
if($grado==3){
	$grupos=$gpo3;		  
}
if($grado==4){
	$grupos=$gpo4;		  
}
if($grado==5){
	$grupos=$gpo5;		  
}
if($grado==6){
	$grupos=$gpo6;		  
}
if($turno==1 || $turno==3 || $turno>4){
		$condicion_turno="idgrupo <=6";
	}
	if($turno==2 || $turno==4){
		$condicion_turno="idgrupo >=7";
	}
	$qGrupo="SELECT DISTINCT(grupo), idgrupo FROM grupos_c where $condicion_turno ORDER BY grupo limit 0,$grupos";
	$rqGrupo=mysql_query($qGrupo)or die('no se pued ejecutar qGrupo');
	while($filGrupo=mysql_fetch_array($rqGrupo)){
		$idgrupo=$filGrupo['idgrupo'];
		$grupo=$filGrupo['grupo'];
		 ?>
       <?php echo $grupo; ?> <input name="grupo" id="grupo" type="radio" value="<?php echo $grupo; ?>" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         
         <?php
	}
	mysql_free_result($rqGrupo);
 
  mysql_free_result($rqGpos);
?>
