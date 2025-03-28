<?php
require_once("../conecta.php");
?>
<select name="sosten" id="sosten" > 
  <option> [Seleccione el sostenimiento] </option>
  <?php
   // hay que agregar la tabla de secundaria
  if($idnivel_m==60 || $idnivel_m==61 || $idnivel_m==65 || $idnivel_m==67 || $idnivel_m==68){
	  $tabla="ct_c12_secundarias";
  }else{
	$tabla="ct_c12";  
  }
  echo $qSost="SELECT  DISTINCT(t1.sosten) FROM sost t1, $tabla t2 where t1.clavecct=t2.cct and t2.idnivel='".$idnivel_m."'";
  $rqSost=mysql_query($qSost)or die('no se puede ejecutar qSost');
                              
                              ?>
<?php
  while($filSost=mysql_fetch_array($rqSost)){
	  
	  $sosten=$filSost['sosten'];
	  
	  ?>
	  <option value="<?php echo $sosten; ?>"><?php echo $sosten; ?></option>
	  <?php
  }
  mysql_free_result($rqSost);
?>
</select>       