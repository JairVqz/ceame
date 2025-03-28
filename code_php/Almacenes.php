<?php
function tablaAlmacenes($usuario){
	$query="select DISTINCT(almacen), direccion,responsable,correo,preescolar,primaria,"
                . "secundaria,telesecundaria FROM almacen_c WHERE idalmacen NOT IN (20,21,22,23) ";
      
  //echo $query;              
	$rquery=mysql_query($query)or die('no se puede ejecutar query');
	?>
	<table class="table table-bordered">
  <tr>
    <th style="text-align:center">Ciudad</th>
    <th style="text-align:center">Calle</th>
    
    <th style="text-align:center">Responsable</th>
    <th style="text-align:center">Correo electr&oacute;nico</th>
    <!-- <th class="text-center">Preescolar</th>
    <th class="text-center">Primaria</th>
    <th class="text-center">Secundaria</th>
    <th class="text-center">Telesecundaria</th> -->
  </tr>
  


	<?php
    while($filquery=mysql_fetch_array($rquery)){
		$almacen=$filquery['almacen'];
		$direccion=$filquery['direccion'];
		$responsable=$filquery['responsable'];
		$correo=$filquery['correo'];
              
		$preescolar=$filquery['preescolar'];
		$primaria=$filquery['primaria'];
		$secundaria=$filquery['secundaria'];
		$telesecundaria=$filquery['telesecundaria'];
		
		?>
     	<tr>
        <td><?php echo $almacen;  ?></td>
        <td><?php echo $direccion;  ?></td>
       
        <td><?php echo $responsable;  ?></td>
        <td><?php echo $correo;  ?></td>
        <!-- <td class="text-center"><?php if($preescolar==1){  ?><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><?php } ?></td>
        <td class="text-center"><?php if($primaria==1){  ?><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><?php } ?></td>
        <td class="text-center"><?php if($secundaria==1){  ?><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><?php } ?></td>
        <td class="text-center"><?php if($telesecundaria==1){  ?><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><?php } ?></td> -->
        </tr>
        <?
	}
	mysql_free_result($rquery);
?>
</table>
<?php
}

