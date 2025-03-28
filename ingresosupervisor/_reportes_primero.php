<?       	session_start(); 	 	require_once('../conecta2014.php');     	conectalo("usr_munic","municipios");     ?>
<html><head><title> </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<LINK REL="stylesheet"  HREF="../_estilos14.css"> 
<SCRIPT TYPE="text/javascript" src="../_funciones14.js"></SCRIPT>
</head>
<body><div align="center">
<?
if ((!isset($logeado) && !isset($TxtUsuario))){
	echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
}else{ 
	switch ($cual){
	case "Gestion":
		$arr_mikey=explode("|",oculta($mikey,1));
		$res=mysql_query("select a.*,b.Dependencia,c.Tipo_de_Gestion from gestiones a,z_gestion_dependencias b, z_gestiontipode c where a.iddependencia=b.iddependencia and a.idtipogestion=c.idtipogestion and a.idgestion=".$arr_mikey[0]);
		$recset=mysql_fetch_array($res);
		if ($vl_back==1){ $vl_back="gestion_registro.php?ejecucion=11&pendientes=1"; }else{ $vl_back="gestion_registro.php?ejecucion=11";    }
		// ********************************    BOTON PARA IMPRIMIR    ********************************************************************************
		$vl_estapagina="_reportes.php?cual=$cual&vl_back=$vl_back&mikey=$mikey&aamdjeijffhf=1";
		if (!isset($aamdjeijffhf)){	?> <table width="800" border="0"><tr><td width="368" align="right"><a target="_blank" href="<? echo $vl_estapagina;?>" onMouseOut="MM_nbGroup('out');" onMouseOver="MM_nbGroup('over','ok','_imagenes/_imprimir2.jpg','_imagenes/_imprimir2.jpg',1);" onClick="MM_nbGroup('down','navbar1','ok','_imagenes/_imprimir2.jpg',1);"><img name="ok" src="_imagenes/_imprimir1.jpg" border="0" id="ok" alt="" /></a></td><td width="50">&nbsp;</td><td width="368"><a href="<? if (isset($vl_back)){ echo $vl_back; }else{print("javascript:self.close();"); }?>" onMouseOut="MM_nbGroup('out');" onMouseOver="MM_nbGroup('over','ok2','_imagenes/_regresar2.jpg','_imagenes/_regresar2.jpg',1);" onClick="MM_nbGroup('down','navbar1','ok2','_imagenes/_regresar2.jpg',1);"><img name="ok2" src="_imagenes/_regresar1.jpg" border="0" id="ok2" alt="" /></a></td></tr></table>
		<? } else{  ?> <script languaje="javascript" type="text/JavaScript">  alert("=======================\nPara imprimir el reporte \nutilice las teclas     ctrl-p \ndespués de que este aparezca\nen la pantalla\n=======================");  </script>  <? }   
		// ****************************************************************************************************************
		?>
        
        
        
	     <table width="800" border="0"><tr><td width="505" align="left" class='negra_22'>Control de gestiones</td><td width="285" class="negra_12" align="right"><? echo fechalarga("actual"); ?></td></tr></table><img src="_imagenes/_rayareporte1.jpg"><br><br>		
        
        <table width="800" border="1" bordercolor="#CFCFCF" cellpadding="7" cellspacing="0" class="negra_14"><tr>
		  <td width="193">Fecha</td>		  <td><? echo fechalarga($recset["fecha_gestion"],"Ymd"); ?></td> </tr>
          <tr><td>Tipo de gesti&oacute;n</td><td><? echo $recset["Tipo_de_Gestion"]; ?></td></tr>
		  <tr><td>Gestion</td><td><? echo $recset["Gestion"]; ?></td></tr>
		  <tr><td>Dependencia</td><td><? echo $recset["Dependencia"]; ?></td></tr>
		  <tr><td>Beneficiarios</td><td><? echo $recset["beneficiarios"]; ?></td></tr>
          <tr><td>&nbsp;&nbsp;&nbsp;
          			<? if ($recset["benef_loc"]=="Todo el municipio") {echo "de"; } else{ echo "Localidad"; } ?>
                    </td><td><? echo $recset["benef_loc"]; ?></td></tr>
		  <tr><td>Importe</td><td>$&nbsp;<? echo $recset["importe"]; ?></td></tr>
		  <tr><td>Gasto</td><td>$&nbsp;<? echo $recset["gasto"]; ?></td></tr>
		  <tr><td>Gestor</td><td><? echo $recset["Gestor"]; ?></td></tr>
          <tr><td>&nbsp;&nbsp;&nbsp;Tel&eacute;fono</td><td><? echo $recset["telgestor"]; ?></td></tr>
		  <tr><td>&nbsp;&nbsp;&nbsp;Correo e.</td><td><? echo $recset["correogestor"]; ?></td></tr>
		  <tr><td>Observaciones</td><td><? echo $recset["observacion_inicial"]; ?></td></tr>
          <? if ($recset["observacion_final"]!=""){ ?>
          				<tr><td>Observaciones</td><td><? echo $recset["observacion_final"]; ?></td></tr>
          <? } ?>
		</table><br><br><img src="_imagenes/_rayareporte2.jpg"><br>
		<? break;	


	case "Actividad":
		$arr_mikey=explode("|",oculta($mikey,1));
		$res=mysql_query("select a.*,b.TipoActividad,c.Sector,d.Localidad from actividades a,z_actividadtipode b, z_Sectores c,localidad_c d where a.idtipoactividad=b.idtipoactividad and a.idsector=c.idsector and a.idlocalidad=d.idlocalidad and a.idactividad=".$arr_mikey[0]);
		$recset=mysql_fetch_array($res);
		if (isset($ultimos)){
				$vl_back="actividad_registro.php?ejecucion=11&ultimos=1";
		}else{
				$vl_back="actividad_registro.php?ejecucion=11";
		}
		?>
		<div id='nopasaimprimir'><table width="800" border="0"><tr><td width="368" align="right"><a href="<?php print("javascript:doPrint();");?>" onMouseOut="MM_nbGroup('out');" onMouseOver="MM_nbGroup('over','ok','_imagenes/_imprimir2.jpg','_imagenes/_imprimir2.jpg',1);" onClick="MM_nbGroup('down','navbar1','ok','_imagenes/_imprimir2.jpg',1);"><img name="ok" src="_imagenes/_imprimir1.jpg" border="0" id="ok" alt="" /></a></td><td width="50">&nbsp;</td><td width="368"><a href="<? if (isset($vl_back)){ echo $vl_back; }else{print("javascript:self.close();"); }?>" onMouseOut="MM_nbGroup('out');" onMouseOver="MM_nbGroup('over','ok2','_imagenes/_regresar2.jpg','_imagenes/_regresar2.jpg',1);" onClick="MM_nbGroup('down','navbar1','ok2','_imagenes/_regresar2.jpg',1);"><img name="ok2" src="_imagenes/_regresar1.jpg" border="0" id="ok2" alt="" /></a></td></tr></table></div> 
        <table width="800" border="0"><tr><td width="505" align="left" class='negra_22'>Actividades</td><td width="285" class="negra_12" align="right"><? echo fechalarga($recset["fecha"],"Ymd"); ?></td></tr></table><img src="_imagenes/_rayareporte1.jpg"><br><br>		
        
        <table width="800" border="0" bordercolor="#CFCFCF" cellpadding="7" cellspacing="0" class="negra_14">
          <tr>
            <td colspan="4" align="center">
            	<img src="<? echo "actividades_fotos/".$recset["carpetafotos"]."/".$recset["foto1"]; ?>"></td>
          </tr>
          <tr>
            <td colspan="4"><? echo $recset["Actividad"]; ?></td>
          </tr>
          </table><br>
           <table width="800" border="1" bordercolor="#CFCFCF" cellpadding="7" cellspacing="0" class="negra_14">
          <tr>
            <td>Lugar</td>
            <td colspan="3"><? echo $recset["Lugar"]; ?></td>
            </tr>
          <tr><td width="193">Tipo de actividad</td><td width="219"><? echo $recset["TipoActividad"]; ?></td>
            <td width="65">Sector</td>
            <td width="257"><? echo $recset["Sector"]; ?></td>
          </tr>
		  <tr><td colspan="4"><br><? echo $recset["Observacion"]; ?><br><br></td></tr>
		</table><br><br>
		<? break;	




	case "ejemplo":
		$vl_enc="<span class='negra_22'>Titulo<br>Subtitulo</span><br>";
							  echo $vl_enc."Primer grado";
							  $anchogrid="800"; $vercols="V|V|v|v";						$vertotregs="NO"; $actual="NO"; 	$subtitulo1=""; $subtitulo2=""; $subtitulo3="";
							  $_sql="select b.idgrado as Grado,b.Grupo,c.familia as Materia,concat(a.paterno,' ',a.materno,' ',a.nombre) as Maestro from maestros_c a, maestros_materias_libros b,familia_c c where a.cct=b.cct and b.idgrado=1 and concat(b.cct,b.turno)='".$vg_ctausr."' and a.curp=b.curp and c.idfamilia=b.idfamilia order by b.idgrado,c.familia,b.grupo";
							  mysql_query("set sql_big_selects=1");
							  gridfer($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_basica","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3,"../");
							  echo "<H1 class='SaltoDePagina'> </H1>";
							  
							  echo $vl_enc."Segundo grado";
							  $anchogrid="800"; $vercols="V|V|v|v";						$vertotregs="NO"; $actual="NO"; 	$subtitulo1=""; $subtitulo2=""; $subtitulo3="";
							  $_sql="select b.idgrado as Grado,b.Grupo,c.familia as Materia,concat(a.paterno,' ',a.materno,' ',a.nombre) as Maestro from maestros_c a, maestros_materias_libros b,familia_c c where a.cct=b.cct and b.idgrado=2 and concat(b.cct,b.turno)='".$vg_ctausr."' and a.curp=b.curp and c.idfamilia=b.idfamilia order by b.idgrado,c.familia,b.grupo";
							  gridfer($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_basica","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3,"../");
		break;	
	}
    // ******************************   CERRADO AUTOMATICO PAGINA    **********************************************************************************************
	if (!isset($aamdjeijffhf)){	
	?>  <table width="650" border="0"><tr><td colspan="3" align="center"><a href="<? echo $vl_back; ?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('img_regresar','','_imagenes/_regresar2.jpg',1)"><img src="_imagenes/_regresar1.jpg" id="img_regresar" border="0" ></a>&nbsp;&nbsp;&nbsp;<a href="_cerrarsesion.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('img_sesion','','_imagenes/_cerrarsesion2.jpg',1)"><img src="_imagenes/_cerrarsesion1.jpg" id="img_sesion" border="0" ></a></td></tr> </table>
	<? } else{  ?> <script languaje="javascript" type="text/JavaScript"> 	setTimeout(function(){self.close()},20000); </script> 	 <? }   
	// ****************************************************************************************************************************		 
	
}  ?>
 </div></body></html>
