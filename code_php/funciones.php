<?php 
function getNomGrado($idgrado){
	switch($idgrado){
		case 1:
			echo "Primer grado";
			break;
		case 2:
			echo "Segundo grado";
			break;
		case 3:
			echo "Tercer grado";
			break;
		case 4:
			echo "Cuarto grado";
			break;
		case 5:
			echo "Quinto grado";
			break;
		case 6:
			echo "Sexto grado";
			break;
		
	}
	
	
}
// funciones secundarias
function getMunicipioCtSecundaria($cct,$turno){
	$sql="SELECT nombrempio FROM ct_c12_secundarias WHERE cct='$cct' AND turno='$turno'";
	$rsql=mysql_query($sql) or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$nombrempio=$filsql['nombrempio'];
	mysql_free_result($rsql);
	return $nombrempio;
	
}
function getLocalidadCtSecundaria($cct,$turno){
	$sql="SELECT nombreloc FROM ct_c12_secundarias WHERE cct='$cct' AND turno='$turno'";
	$rsql=mysql_query($sql) or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$nombreloc=$filsql['nombreloc'];
	mysql_free_result($rsql);
	return $nombreloc;
}
function getSectorCtSecundaria($cct,$turno){
	$sql="SELECT sector FROM ct_c12_secundarias WHERE cct='$cct' AND turno='$turno'";
	$rsql=mysql_query($sql) or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$sector=$filsql['sector'];
	mysql_free_result($rsql);
	return $sector;
}


function getNumAlumnosAlmacen($idnivel,$idalmacen){
	$sql="SELECT (sum(alu_1)+sum(alu_2)+sum(alu_3)+sum(alu_4)+sum(alu_5)+sum(alu_6))as NumAlumnos FROM ct_c12 where idnivel='$idnivel' and idalmacen='$idalmacen'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$NumAlumnos=$filsql['NumAlumnos'];
	mysql_free_result($rsql);
	return $NumAlumnos;
}
function getNumAlumnosNivelAlmacenGrado($idnivel,$idalmacen,$idgrado){
	// manejar lo de los grados
	switch($idgrado){
		case 1:
			$cad="sum(alu_1)";
			break;
		case 2:
			$cad="sum(alu_2)";
			break;
		case 3:
			$cad="sum(alu_3)";
			break;
		case 4:
			$cad="sum(alu_4)";
			break;
		
	}
	
	$sql="SELECT ($cad)as NumAlumnos FROM ct_c12 where idnivel='$idnivel' and idalmacen='$idalmacen'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$NumAlumnos=$filsql['NumAlumnos'];
	mysql_free_result($rsql);
	return $NumAlumnos;
}
function getNumAlumnosNivel($idnivel){
	$tabla="ct_c12";
	if($idnivel==60 || $idnivel==61 || $idnivel==65 || $idnivel==67 || $idnivel==68){ $tabla="ct_c12_secundarias"; }
	$sql="SELECT (sum(alu_1)+sum(alu_2)+sum(alu_3)+sum(alu_4)+sum(alu_5)+sum(alu_6))as NumAlumnos FROM $tabla where idnivel='$idnivel'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$NumAlumnos=$filsql['NumAlumnos'];
	mysql_free_result($rsql);
	return $NumAlumnos;	
}
function getResponsableAlmacen($idalmacen){
        $sql="SELECT concat(nombres,' ',paterno,' ',materno) as responsable FROM almacen_c WHERE idalmacen='$idalmacen' UNION SELECT almacen FROM almacenteles_c WHERE idalmacen='$idalmacen'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$responsable=$filsql['responsable'];
	mysql_free_result($rsql);
	return $responsable;   
}
function getNomAlmacen($idalmacen){
	$sql="SELECT almacen FROM almacen_c WHERE idalmacen='$idalmacen' UNION SELECT almacen FROM almacenteles_c WHERE idalmacen='$idalmacen'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$almacen=$filsql['almacen'];
	mysql_free_result($rsql);
	return $almacen;
}
function getNomAlmacenBibliZona($cct_zona){
	$sql="SELECT distinct(almacen) FROM almacen_c t1, ct_c12 t2 WHERE t1.idalmacen=t2.alma_bibli and t2.cct_zona='$cct_zona'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$almacen=$filsql['almacen'];
	mysql_free_result($rsql);
	return $almacen;
}
function getNumAlumnosNivelGrado($idnivel,$idgrado){

	$tabla="ct_c12";
	if($idnivel==60 || $idnivel==61 || $idnivel==65 || $idnivel==67 || $idnivel==68){ $tabla="ct_c12_secundarias"; }
	$sql="SELECT (sum(alu_1)+sum(alu_2)+sum(alu_3)+sum(alu_4)+sum(alu_5)+sum(alu_6))as NumAlumnos FROM $tabla where idnivel='$idnivel' and alu_$idgrado='$idgrado'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$NumAlumnos=$filsql['NumAlumnos'];
	mysql_free_result($rsql);
	return number_format($NumAlumnos);
	
}
function getNomNivel($idnivel){
	$sql="SELECT idnivel,nivel,dependenivel FROM nivel_c where idnivel='$idnivel'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$nivel=$filsql['nivel'];
	mysql_free_result($rsql);
	return $nivel;
}
function getNomTipoMaterial($idtipomat){
	$sql="SELECT idtipomat,tipomaterial FROM tipomat_c where idtipomat='$idtipomat'";
	$rsql=mysql_query($sql)or die('no se puede ejeuctar sql');
	$filsql=mysql_fetch_array($rsql);
	$tipomaterial=$filsql['tipomaterial'];
	mysql_free_result($rsql);
	return $tipomaterial;
}
function getNumAlmacenesNivel($idnivel){
	$tabla="ct_c12";
	if($idnivel==60 || $idnivel==61 || $idnivel==65 || $idnivel==67 || $idnivel==68){ $tabla="ct_c12_secundarias"; }
	$sql="SELECT count(distinct(idalmacen))as NumAlmacenes FROM $tabla where idnivel='$idnivel'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$NumAlmacenes=$filsql['NumAlmacenes'];
	mysql_free_result($rsql);
	return $NumAlmacenes;	
	
}
function esSecundaria($cct){
	$es_secundaria=0;
	if(substr($cct,2,3)=="EES" or substr($cct,2,3)=="EST" or substr($cct,2,3)=="ESN" or substr($cct,2,3)=="DES" or substr($cct,2,3)=="DST" or substr($cct,2,3)=="DSN" ){
		$es_secundaria=1;	
	}else{
		$es_secundaria=0;	
	}
	return $es_secundaria;
}
function obtener_mov_cct($lallaveescuela,$grado,$ciclo,$aplica){
	if($aplica=="SI"){
	$sql="SELECT SUM($grado) as baja FROM ct_c12_mov_matricula WHERE concat(cct,turno)='$lallaveescuela' AND tipo in ('Alta de alumnos sin libros','Baja de alumnos') and ciclo='$ciclo'";
	}
	if($aplica=="NO"){
		$sql="SELECT SUM($grado) as baja FROM ct_c12_mov_matricula WHERE concat(cct,turno)='$lallaveescuela' AND tipo in ('Alta de alumnos sin libros','Alta de alumnos con libros','Baja de alumnos') and ciclo='$ciclo'";
	}
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$baja=$filsql['baja'];
	return ($baja);
	//return $sql;

}
function ComparayColorea($alu,$a){
		$color="";
		if($alu>$a){
			$color="#74DF00";	
		}
		if($a>$alu){
			$color="#FA5858";	
		}
		return $color;
	
	}

function tablaDatosCCT($cct,$turno,$tipousuario,$cuenta){
	$es_secundaria=0;
	$tabla="";
	$es_secundaria=esSecundaria($cct);
	if($es_secundaria==1){
		$tabla="ct_c12_secundarias";	
	}else{
		$tabla="ct_c12";
	}
	if($tipousuario=='Supervisor'){
		$sql="SELECT cct,turno,nom_ct,nombrempio,nombreloc,domicilio,director,cct_zona,cct_sector,sector,zonaescola,idalmacen,cve_911,telefono,correo_e,idnivel,status FROM $tabla where cct='$cct' and turno='$turno' and cct_zona='$cuenta'";
	}else{
	$sql="SELECT cct,turno,nom_ct,nombrempio,nombreloc,domicilio,director,cct_zona,cct_sector,sector,zonaescola,idalmacen,cve_911,telefono,correo_e,idnivel,status FROM $tabla where cct='$cct' and turno='$turno'";
	}
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$cct=$filsql['cct'];
	$turno=$filsql['turno'];
	$nom_ct=$filsql['nom_ct'];
	$nombrempio=$filsql['nombrempio'];
	$nombreloc=$filsql['nombreloc'];
	$domicilio=$filsql['domicilio'];
	$director=$filsql['director'];
	$cct_zona=$filsql['cct_zona'];
	$cct_sector=$filsql['cct_sector'];
	$sector=$filsql['sector'];
	$zonaescola=$filsql['zonaescola'];
	$idalmacen=$filsql['idalmacen'];
	$cve_911=$filsql['cve_911'];
	$telefono=$filsql['telefono'];
	$correo_e=$filsql['correo_e'];
	$idnivel=$filsql['idnivel'];
	$status=$filsql['status'];
	mysql_free_result($rsql);
	?>
    <?php
    if($tipousuario=='Supervisor'){
    
    	if($status=='B'){
    ?>
	<a href="../code_php/updCentroT.php?modo=A&cct=<?php echo $cct; ?>&turno=<?php echo $turno; ?>&es_secundaria=<?php echo $es_secundaria; ?>" class="btn btn-info"  >Activar escuela</a> 
    <?PHP
		}
	 	if($status=='A'){
	?>
     <a href="../code_php/updCentroT.php?modo=B&cct=<?php echo $cct; ?>&turno=<?php echo $turno; ?>&es_secundaria=<?php echo $es_secundaria; ?>"  class="btn btn-danger" >Desactivar escuela</a>
    <?php
	 	}
    }?>
    <h4>Datos Generales</h4>
    <table class="table table-responsive table-striped">
  <tr>
    <td>CCT</td>
    <td><?php echo $cct. " ".$turno; ?></td>
    <td>Nombre del CCT</td>
    <td><?php echo $nom_ct;  ?></td>
    
  </tr>
  <tr>
    <td>Municipio</td>
    <td><?php echo $nombrempio; ?></td>
    <td>Localidad</td>
      <td><?php echo $nombreloc; ?></td>
  </tr>
  <tr>
    <td>Domicilio</td>
    <td><?php echo $domicilio; ?></td>
    <td><span class="glyphicon glyphicon-earphone" aria-hidden="true"> Telefono</span></td>
    <td><?php echo $telefono; ?></td>
  </tr>
  <tr>
    <td><span class="glyphicon glyphicon-user" aria-hidden="true"> Nombre del Director</span> </td>
    <td><?php echo $director; ?></td>
    <td><span class="glyphicon glyphicon-envelope" aria-hidden="true"> Correo del CCT o del Director </span></td>
    <td><?php echo $correo_e; ?></td>
  </tr>
  <tr>
    <td>Zona Escolar</td>
    <td><?php echo $cct_zona; ?></td>
    <td>Sector</td>
    <td><?php echo $cct_sector; ?></td>
  </tr>
  <tr>
    <td><?php if($tipousuario!='Supervisor'){  ?> Clave 911<?php } ?></td>
    <td>
	
	<?php if($tipousuario!='Supervisor'){ echo $cve_911; } ?>
    
    </td>
    <td>Nivel</td>
    <td><?php echo getNomNivel($idnivel); ?></td>
  </tr>
</table>
    <?php
}
function tablaMatriculaInicialCCT($cct,$turno,$tipousuario,$cuenta){
	$es_secundaria=0;
	$tabla="";
	$es_secundaria=esSecundaria($cct);
	if($es_secundaria==1){
		$tabla="ct_c12_secundarias";	
	}else{
		$tabla="ct_c12";
	}
	if($tipousuario=='Supervisor'){
		$sql="SELECT alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,gpo1,gpo2,gpo3,gpo4,gpo5,gpo6,idnivel FROM $tabla where cct='$cct' and turno='$turno' and cct_zona='$cuenta'";
	}else{
		$sql="SELECT alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,gpo1,gpo2,gpo3,gpo4,gpo5,gpo6,idnivel FROM $tabla where cct='$cct' and turno='$turno'";
	}
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$alu_1=$filsql['alu_1'];
	$alu_2=$filsql['alu_2'];
	$alu_3=$filsql['alu_3'];
	$alu_4=$filsql['alu_4'];
	$alu_5=$filsql['alu_5'];
	$alu_6=$filsql['alu_6'];
	$gpo1=$filsql['gpo1'];
	$gpo2=$filsql['gpo2'];
	$gpo3=$filsql['gpo3'];
	$gpo4=$filsql['gpo4'];
	$gpo5=$filsql['gpo5'];
	$gpo6=$filsql['gpo6'];
	mysql_free_result($rsql);
	?>
    <?php if($tipousuario!='Supervisor'){ ?>
    <h4>Matricula inicial (asignaci�n de matricula)</h4>
    <table class="table table-responsive table-striped">
    
  <tr><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 1er. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 2do. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 3er. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 4to. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 5to. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 6to. Grado</span></td></tr>
  <tr><td><?php echo $alu_1;  ?></td><td><?php echo $alu_2; ?></td><td><?php echo $alu_3; ?></td><td><?php echo $alu_4; ?></td><td><?php echo $alu_5; ?></td><td><?php echo $alu_6; ?></td></tr>
  <tr><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 1er. Grado </span> </td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 2do. Grado</span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 3er. Grado</span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 4to. Grado </span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 5to. Grado </span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 6to. Grado</span></td></tr>
  <tr><td><?php echo $gpo1;  ?></td><td><?php echo $gpo2;  ?></td><td><?php echo $gpo3;  ?></td><td><?php echo $gpo4;  ?></td><td><?php echo $gpo5;  ?></td><td><?php echo $gpo6;  ?></td></tr>
 

</table>
<?php
	}
?>
	
<?php	
}

function tablaMatriculaCapturaInicialCCT($cct,$turno,$tipousuario,$cuenta){
	$es_secundaria=0;
	$tabla="";
	$es_secundaria=esSecundaria($cct);
	if($es_secundaria==1){
		$tabla="ct_c12_secundarias";	
	}else{
		$tabla="ct_c12";
	}
	if($tipousuario=='Supervisor'){
		$sql="SELECT a1,a2,a3,a4,a5,a6,g1,g2,g3,g4,g5,g6,idnivel FROM $tabla where cct='$cct' and turno='$turno' and cct_zona='$cuenta'";
	}else{
		$sql="SELECT a1,a2,a3,a4,a5,a6,g1,g2,g3,g4,g5,g6,idnivel FROM $tabla where cct='$cct' and turno='$turno'";
	}
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$a1=$filsql['a1'];
	$a2=$filsql['a2'];
	$a3=$filsql['a3'];
	$a4=$filsql['a4'];
	$a5=$filsql['a5'];
	$a6=$filsql['a6'];
	$g1=$filsql['g1'];
	$g2=$filsql['g2'];
	$g3=$filsql['g3'];
	$g4=$filsql['g4'];
	$g5=$filsql['g5'];
	$g6=$filsql['g6'];
	mysql_free_result($rsql);
	?>
    <?php if($tipousuario!='Supervisor'){ ?>
    <h4>Matricula capturada al inicio del ciclo escolar</h4>
    <table class="table table-responsive table-striped">
    
  <tr><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 1er. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 2do. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 3er. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 4to. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 5to. Grado</span></td><td><span class="glyphicon glyphicon-user" aria-hidden="true"> 6to. Grado</span></td></tr>
  <tr><td><?php echo $a1;  ?></td><td><?php echo $a2; ?></td><td><?php echo $a3; ?></td><td><?php echo $a4; ?></td><td><?php echo $a5; ?></td><td><?php echo $a6; ?></td></tr>
  <tr><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 1er. Grado </span> </td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 2do. Grado</span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 3er. Grado</span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 4to. Grado </span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 5to. Grado </span></td><td><span class="glyphicon glyphicon-education" aria-hidden="true"> 6to. Grado</span></td></tr>
  <tr><td><?php echo $g1;  ?></td><td><?php echo $g2;  ?></td><td><?php echo $g3;  ?></td><td><?php echo $g4;  ?></td><td><?php echo $g5;  ?></td><td><?php echo $g6;  ?></td></tr>
 

</table>
<?php } ?>

    <?php
	
	
}
function TablaEscuelasPorMunicipio($cct,$nom_ct,$idmunicipio,$usuario){
	$es_secundaria=0;
	$tabla="";
	$es_secundaria=esSecundaria($cct);
	if($es_secundaria==1){
		$tabla="ct_c12_secundarias";	
	}else{
		$tabla="ct_c12";
	}
	
	$cad_criterio="";
	if($cct!='' and $nom_ct==''){
		if($idmunicipio==00){
			$cad_criterio="cct like '%$cct%' order by nom_ct";
		}else{
			$cad_criterio="cct like '%$cct%' and municipio='$idmunicipio' order by nom_ct";
		}
		
	$sql_1="SELECT cct,turno,nom_ct,nombrempio,nombreloc,domicilio,director,cct_zona,cct_sector,sector,zonaescola,idalmacen,cve_911,telefono,correo_e,idnivel,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6 FROM $tabla where $cad_criterio";
	}
	if($cct=='' and $nom_ct!=''){
		if($idmunicipio==00){
			$cad_criterio="nom_ct like '%$nom_ct%' order by nom_ct";
		}else{
			$cad_criterio="nom_ct like '%$nom_ct%' and municipio='$idmunicipio' order by nom_ct";
		}
		
		
		$sql_1="(SELECT cct,turno,nom_ct,nombrempio,nombreloc,domicilio,director,cct_zona,cct_sector,sector,zonaescola,idalmacen,cve_911,telefono,correo_e,idnivel,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6 FROM ct_c12 where $cad_criterio) UNION (SELECT cct,turno,nom_ct,nombrempio,nombreloc,domicilio,director,cct_zona,cct_sector,sector,zonaescola,idalmacen,cve_911,telefono,correo_e,idnivel,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6 FROM ct_c12_secundarias where $cad_criterio)"; 
		
		
	}
	
	
	//echo mysql_num_rows($rsql);
	
	?>
	<table class='table table-responsive table-striped'><tr><th>No.</th><th>CCT</th><th>Nombre del CCT</th><th>Municipio</th><th>Localidad</th><th>Almacen</th><th>Nivel</th><th>Zona Escolar</th><th>Sector</th><th> Nombre del Director</th><th>Correo del CCT o del Director </th><th>Telefono</th><th>alu_1</th><th>alu_2</th><th>alu_3</th><th>alu_4</th><th>alu_5</th><th>alu_6</th><th>a1</th><th>a2</th><th>a3</th><th>a4</th><th>a5</th><th>a6</th></tr><?php
	$contador=0;
	$rsql_1=mysql_query($sql_1)or die('no se puede ejecutar sql');
	while($filsql_1=mysql_fetch_array($rsql_1)){
		$contador++;
		$cct=$filsql_1['cct'];
		$turno=$filsql_1['turno'];
		$nom_ct=$filsql_1['nom_ct'];
		$nombrempio=$filsql_1['nombrempio'];
		$nombreloc=$filsql_1['nombreloc'];
		$domicilio=$filsql_1['domicilio'];
		$director=$filsql_1['director'];
		$cct_zona=$filsql_1['cct_zona'];
		$cct_sector=$filsql_1['cct_sector'];
		$sector=$filsql_1['sector'];
		$zonaescola=$filsql_1['zonaescola'];
		$idalmacen=$filsql_1['idalmacen'];
		$cve_911=$filsql_1['cve_911'];
		$telefono=$filsql_1['telefono'];
		$correo_e=$filsql_1['correo_e'];
		$idnivel=$filsql_1['idnivel'];
		$alu_1=$filsql_1['alu_1'];
		$alu_2=$filsql_1['alu_2'];
		$alu_3=$filsql_1['alu_3'];
		$alu_4=$filsql_1['alu_4'];
		$alu_5=$filsql_1['alu_5'];
		$alu_6=$filsql_1['alu_6'];
		$a1=$filsql_1['a1'];
		$a2=$filsql_1['a2'];
		$a3=$filsql_1['a3'];
		$a4=$filsql_1['a4'];
		$a5=$filsql_1['a5'];
		$a6=$filsql_1['a6'];
		$lallaveescuela=$cct."".$turno;
		$at1=$a1+obtener_mov_cct($lallaveescuela,'c1',$vg_ciclo,"SI");
		$at2=$a2+obtener_mov_cct($lallaveescuela,'c2',$vg_ciclo,"SI");
		$at3=$a3+obtener_mov_cct($lallaveescuela,'c3',$vg_ciclo,"SI");
		$at4=$a4+obtener_mov_cct($lallaveescuela,'c4',$vg_ciclo,"SI");
		$at5=$a5+obtener_mov_cct($lallaveescuela,'c5',$vg_ciclo,"SI");
		$at6=$a6+obtener_mov_cct($lallaveescuela,'c6',$vg_ciclo,"SI");
		
		
		
	?>
   
  <tr><td><?php echo $contador; ?></td><td><?php echo $cct; ?></td><td><?php echo $nom_ct; ?></td><td><?php echo $nombrempio; ?></td><td><?php echo $nombreloc; ?></td><td><?php echo getNomAlmacen($idalmacen); ?></td><td><?php echo getNomNivel($idnivel); ?></td><td><?php echo $cct_zona; ?></td><td><?php echo $cct_sector; ?></td><td><?php echo $director; ?></td><td><?php echo $correo_e; ?></td><td><?php echo $telefono; ?></td><td><?php echo $alu_1; ?></td><td><?php echo $alu_2; ?></td><td><?php echo $alu_3; ?></td><td><?php echo $alu_4; ?></td><td><?php echo $alu_5; ?></td><td><?php echo $alu_6; ?></td>
  <td bgcolor="<?php echo ComparayColorea($alu_1,$at1); ?>"><?php  echo $at1; ?></td>
  <td  bgcolor="<?php echo ComparayColorea($alu_2,$at2); ?>"><?php echo $at2;//$a2=$a2+obtener_mov_cct($lallaveescuela,'c2'); ?></td>
  <td  bgcolor="<?php echo ComparayColorea($alu_3,$a3=$a3+obtener_mov_cct($lallaveescuela,'c3',$vg_ciclo,"SI")); ?>"><?php echo $at3;//$a3=$a3+obtener_mov_cct($lallaveescuela,'c3');  ?></td>
  <td  bgcolor="<?php echo ComparayColorea($alu_4,$a4=$a4+obtener_mov_cct($lallaveescuela,'c4',$vg_ciclo,"SI")); ?>"><?php echo $at4; ?></td><td  bgcolor="<?php echo ComparayColorea($alu_5,$a5=$a5+obtener_mov_cct($lallaveescuela,'c5',$vg_ciclo,"SI")); ?>"><?php echo $at5; ?></td>
  <td  bgcolor="<?php echo ComparayColorea($alu_6,$a6=$a6+obtener_mov_cct($lallaveescuela,'c6')); ?>"><?php echo $at6; ?>6</td>
  </tr>


    
    <?php	
		
	}mysql_free_result($rsql);
	
?></table><?php

	
}

function TablaMenuPie($regreso,$nivelesdir){
    if($nivelesdir==0){
        $cad="";
    }
    if($nivelesdir==1){
        $cad="../";
    }
    if($nivelesdir==2){
        $cad="../../";
    }
    if($nivelesdir==3){
        $cad="../../../";
    }
    ?>
    <table class="table table-condensed">													
         <tr><td colspan="3" align="center"><a href="<?php echo $cad."".$regreso; ?>" class="btn btn-default" >
                     <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>&nbsp;&nbsp;&nbsp;
                     <a href="<?php echo $cad."_cerrarsesion.php" ?>" class="btn btn-default" ><span class="glyphicon glyphicon-log-out"></span> Cerrar sesi&oacute;n</a></td></tr></table>    
<?php
}
        
?>
