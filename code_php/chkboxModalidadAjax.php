<?php
require_once("../conecta.php");
  
$qNivM="SELECT idnivel,nivel,dependenivel FROM nivel_c where dependenivel='$idnivel'";
$rqNivM=mysql_query($qNivM)or die('no se puede ejecutar qNivM');

?>
 <!-- <select name="idnivel_m" id="idnivel_m" onchange="getCboSostAjax();">  -->
  <!--<option value="0"> [Seleccione la modalidad] </option> -->
<?php
  while($filNivM=mysql_fetch_array($rqNivM)){
	  $idnivel_m=$filNivM['idnivel'];
	  $nivel_m=$filNivM['nivel'];
	  
	  ?>
	  <!--<option value="<?php echo $idnivel_m; ?>"><?php echo $nivel_m; ?></option> -->
      <input type="checkbox" value="<?php echo $idnivel_m; ?>" name="idnivel_m[]" id="idnivel_m[]"   /> <?php echo utf8_encode($nivel_m); ?>
      <br />
	  <?php
  }
  mysql_free_result($rqNivM);
?>
 <!-- </select> -->