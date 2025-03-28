<? session_start(); 	 $autollamada=basename(__FILE__). "?"; require_once('../phpqrcode/qrlib.php');  ?>
<html><head>
<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Reporte</title><link rel="shortcut icon" href="../images/libro_titulo3.png">
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  


<style type="text/css" media="print">
         @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        } 
        p.SaltoDePagina { PAGE-BREAK-AFTER: always }  
</style>
<style type="text/css">	
        .ftable-print{ border-color:#FBFBFB; font-size:14px }
		.ftable-print-horizontal{ border-color:#FBFBFB; border-right:none; font-size:14px }
  		.ftable-print-horizontal td,th { border-left: none; border-right: none; }
</style>
<SCRIPT TYPE="text/javascript">
		function doPrint(){
			document.all.item("regresar").style.visibility='hidden' 
            document.all.item("Imprimir").style.visibility='hidden' 
            window.print();
            document.all.item("regresar").style.visibility='visible'
            document.all.item("Imprimir").style.visibility='visible'
		}
</SCRIPT>
<script type="text/javascript" languaje="javascript">var message = "";function rtclickcheck(keyp){ if (navigator.appName == "Netscape" && keyp.which == 3){ alert(message); return false; }if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) { alert(message); return false; } }document.onmousedown = rtclickcheck;</script>
<body style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center; font-size:14px;"><?

require_once('../conecta2023.php');   require_once('../inc/funciones_libros_indigena.php');		conectalo("zona");    
if ((!isset($logeado) && !isset($TxtUsuario))){ 	fmessage("Acceso No Permitido",1500,2,$vl_back);
}else{ 
        $vl_procede=1; 
        switch($_SESSION["vg_tipousuario"]){
            case "Almacen":
                $vl_back="../ingresoalmacen/pauta_seleccion_niveles_para_sector_indigena.php?arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"]."&pmsectores=".$_GET["pmsectores"]."&pmzonas=".$_GET["pmzonas"]."&sel=Sectores";		
                $elidnivel=$_GET["idnivel"];
                $elnivel=str_replace("Estatal","",$_GET["nivel"]);  $elnivel=str_replace("Federal","",$elnivel);  $elnivel=str_replace("Indigena","",$elnivel);  

                $elsector=$_GET["cct_sector"];
                $liga="http://www.librosgratuitosveracruz.org/ingresosector/recibo_libros_sector_indigena.php?folio=".$_GET["folio"]."&cct_sector=".$_GET["cct_sector"]."&idnivel=".$_GET["idnivel"]."&nivel=".$elnivel; 
                $arr_niveles=explode("|",$_GET["arrniveles"]);
                $num_niveles_sector=count($arr_niveles);
                break;
            case "Sector":
                $num_niveles_sector=$_SESSION["vg_numniveles"]; // NO SE USO PORQUE TODOS LOS SECTORES SELECCIONARON NIVEL AUN SI SOLO ERAN DE UN NIVEL
                if (!isset($_GET["arr_nivel"])){   // POR SI EL SECTOR TIENE ESCUELAS DE MAS DE UN NIVEL
                    $vl_back="../_panel.php";
                    $vl_procede=0;
                    // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                    $TItulo="<h3 class='fbold ftext-red fcenter'>Sector Escolar ".$_SESSION["vg_cct_sector"]."</h3>"; $subtit=""; 		 
                    $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                    // -----------------------------------------------------------------------------------------------------------------------------------------------------
                    $liga1="Recibo Sector|".$autollamada."||#F9FFE4";	//Boton|liga|Columna|color
                    $liga2="Zonas|".$autollamada."sel=selzona&||#F9FFE4";	//Boton|liga|Columna|color
                    
                    flista_niveles_x_sector("",$liga1,$liga2);                
                }else{
                    $vl_back=$autollamada;
                    if ($_GET["sel"]=="selzona"){
                        $vl_procede=0;
                        $arrnivel=explode("|",$_GET["arr_nivel"]);
                        $elidnivel=$arrnivel[0]; $elnivel=$arrnivel[1];         
                        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                        $TItulo="<h3 class='fbold ftext-red fcenter'>".$_SESSION["logeado"]."</h3>"; $subtit="<h3 class='ftext-green fcenter'>Lista de Zonas de ".$elnivel."</h3>"; 		 
                        $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                        // -----------------------------------------------------------------------------------------------------------------------------------------------------
                        $liga1="Recibo Zona|../ingresosupervisor/recibo_libros_zona_indigena.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
                        $liga2="Escuelas|../ingresosupervisor/pauta_seleccion_escuelas_por_zona_indigena.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
                        flista_ZONAS_x_sector_nivel($_SESSION["vg_cct_sector"],$elidnivel,"",$liga1,$liga2);
                    }else{  // selecciono recibo
                        
                        if ($_SESSION["vg_numniveles"]>1){ 
                            $arrnivel=explode("|",$_GET["arr_nivel"]); 
                            $elidnivel=$arrnivel[0];
                            $elnivel=str_replace("Estatal","",$arrnivel[1]);  
                        }else{
                            $elidnivel=$_SESSION["vg_idniveles"]; 
                            //$vl_back="../../panel.php"; 
                        }
                    }
                }                
                $elsector=$_SESSION["vg_cct_sector"];	
                $liga="http://www.librosgratuitosveracruz.org/ingresosector/recibo_libros_sector_indigena.php";
                break;	
        }
        if ($vl_procede==1){ ?>
            <br><br>
            <img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
            <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
            <div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
                        SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                        SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                        COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                        PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                        CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> <?php   
    //------------------------------------------------------------------------------------------------------------------------------------------
                        //$_sql="select a.cuenta,a.nombre,a.sector,a.nommun,a.folio,b.almadis,b.idalmarec,b.idalmadis,b.almarec,b.idnivel,b.nivel,sum(b.alu_1_24) as alu1,sum(b.alu_2_24) as alu2,sum(b.alu_3_24) as alu3,sum(b.alu_4_24) as alu4,sum(b.alu_5_24) as alu5,sum(b.alu_6_24) as alu6 from sector_c a,ctsev_indigena b where a.cuenta=b.cct_sector and b.idnivel=".$elidnivel." and b.estatus='A' and b.cct_sector='".$elsector."' group by b.cct_sector"; //	echo $_sql; \
                        $_sql="select a.cuenta,a.nombre,a.sector,a.nommun,a.folio,b.almadis,b.idalmarec,b.idalmadis,b.almarec,b.idnivel,b.nivel from sector_c a,ctsev_indigena b where a.cuenta=b.cct_sector and b.idnivel=".$elidnivel." and b.estatus='A' and b.cct_sector='".$elsector."' group by b.cct_sector"; //	echo $_sql; 
                        $res_sector_alumno=mysql_query($_sql); 		 $rec_sector_alumno=mysql_fetch_array($res_sector_alumno,MYSQL_ASSOC);  
                        if ($_SESSION["vg_tipousuario"]=="Sector" && $_SESSION["vg_numniveles"]==1){
                            $elidnivel=$rec_sector_alumno["idnivel"];
                            $elnivel=$rec_sector_alumno["nivel"];
                            $elnivel=str_replace("Estatal","",$rec_sector_alumno["nivel"]);  $elnivel=str_replace("Federal","",$elnivel);  $elnivel=str_replace("Indigena","",$elnivel);  
                        }
                        if ($elidnivel<39){ $campoalmacen="idalmarec"; }else{$campoalmacen="idalmadis";}
                        $_sql="select almacen,responsable from almacen_c where idalmacen=".$rec_sector_alumno[$campoalmacen]; //	echo $_sql; 
                        $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC);
                        ?>                   
                       RECIBO DE LIBROS DE TEXTO EN LENGUA ÍNDIGENA DEL NIVEL DE <? echo strtoupper($elnivel); ?> 
                        <br><br>   
                        
                        <?php    
    //---------------------------------------------------------------------------------------------------------------------------------------------- 
                        if ($rec_sector_alumno["idnivel"]<39){ $elalmacen=$rec_sector_alumno["almarec"]; }else{$elalmacen=$rec_sector_alumno["almadis"]; }    

                        ?>
                        <table class="ftable-print-horizontal" cellpadding="5" cellspacing="0" width="100%" border=1 style="font-weight:bold">
                            <tr><td width="10%">Folio</td><td  width="20%">LTG <? echo $rec_sector_alumno["folio"]; ?></td><td width="14%">Almacen</td><td><? echo  $rec_almacen["almacen"]; ?></td></tr>
                            <tr><td>CCT</td><td><? echo $elsector; ?></td><td>Nombre</td><td><? echo $rec_sector_alumno["nombre"]; ?></td></tr>
                            <tr><td>Sector</td><td><? echo $rec_sector_alumno["sector"]; ?></td><td>Municipio</td><td><? echo $rec_sector_alumno["nommun"]; ?></td></tr>
                        </table><br><br>   

                        <table cellpadding=18 cellspacing=0 border=1 align=center><tr><td>IMPORTANTE: Se significa que los libros de texto que se entregan por Escuela (ciclo escolar 2023-2024) y <br>Alumno (ciclo escolar 2024-2025); su contenido es el mismo</td></tr></table><br><br>  
                        <?php
                        if ($elidnivel>39 && $elidnivel<59 ){$tope=6;}else{$tope=3;}
                        for ($i=1; $i <= $tope; $i++) { 
                            switch($i){ case 1: $tit="Primer"; break;   case 2: $tit="Segundo"; break;      case 3: $tit="Tercer"; break;    case 4: $tit="Cuarto";   break;   case 5: $tit="Quinto";  break;    case 6: $tit="Sexto";  break;      }
                            $_sql="select b.lengua,a.idmaterial as clave,a.titulo,a.idgrado,a.primcajas,a.idnivel,b.alu_".$i."_23,SUM(b.alu_".$i."_24) as alumnos,COUNT(b.id) as escuelas FROM l_libros_indigena a,ctsev_indigena b WHERE a.idmaterial=b.cvelibro".$i." and b.cct_sector='".$elsector."' and a.idgrado=".$i." and a.destino regexp 'A' and a.ciclo='".$_SESSION["vg_cicloescolar"]."' and a.idnivel=".substr($elidnivel,0,1)." group by b.lengua order by a.idnivel"; 	// echo $_sql; 
                            $res_libros=mysql_query($_sql); 		$r=0;    
                            if (mysql_num_rows($res_libros)>0){  ?>
                                <div style='font-size:18px; font-weight:bold; margin:10px'><? echo $tit; ?> Grado</div>
                                <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                                    <tr><td colspan=2 style="border:none;"></td><td style="text-align:center; font-weight:bold" colspan=3>Ciclo escolar<br><?php echo $_SESSION["vg_cicloescolaranterior"]; ?></td><td style="text-align:center; font-weight:bold;">Ciclo escolar<br><?php echo $_SESSION["vg_cicloescolar"]; ?></td><td style="text-align:center; font-weight:bold" colspan=4>Total a recibir</td></tr>
                                    <tr><td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td><td style="text-align:center; font-weight:bold">Entrega<br>Escuela</td><td style="text-align:center; font-weight:bold">Total<br>Escuelas</td><td style="text-align:center; font-weight:bold">Total</td><td style="text-align:center; font-weight:bold">Entrega<br>Alumnos</td><td style="text-align:center; font-weight:bold">Total<br>    General</td><td style="text-align:center; font-weight:bold">Ejemplares<br>por caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td></tr><?
                                    $tot_cajas=0;   $tot_sueltos=0; 
                                    while ($r<mysql_num_rows($res_libros)){ 		$reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                                        $alu=$reclibros["alumnos"];     $ej=$reclibros["primcajas"];    $cajas=floor((($reclibros["alu_".$i."_23"]*$reclibros["escuelas"])+$alu)/$ej);      $sueltos=(($reclibros["alu_".$i."_23"]*$reclibros["escuelas"])+$alu)-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;?>
                                        <tr><td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><td style="text-align:right;"><? echo $reclibros["alu_".$i."_23"]; ?></td><td style="text-align:right;"><? echo $reclibros["escuelas"]; ?></td><td style="text-align:right;"><? echo ($reclibros["alu_".$i."_23"]*$reclibros["escuelas"]); ?></td><td style="text-align:right;"><? echo $alu; ?></td><td style="text-align:right;"><? echo (($reclibros["alu_".$i."_23"]*$reclibros["escuelas"])+$alu); ?></td><td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td></tr><?
                                        $r++;        
                                    }?>                            
                                    <tr><td colspan="8" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                                </table><br><br>                       <?      
                            }                        
                        }
    //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                        <!--      Aviso     --> 
                        <br><br><br><p class='SaltoDePagina' style="text-align:left"><small><? echo $liga; ?></small></p><br><br><br><br><br>
                        <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>Este recibo es un documento oficial y los libros que recibo son propiedad de la Nación, por lo que me comprometo a vigilar el buen uso del material y verificar la entrega a los beneficiarios</td></tr></table>
                        <br><br>
                        <!--      Firmas     -->
                        <? $firma_entrega="DEL ALMACÉN";     $firma_recibe="DEL JEFE DE SECTOR";     
                        $sello_entrega="ALMACEN";         $sello_recibe="SECTOR";
                        $entrego="ALVARO HERNANDEZ ALEMÁN"; ?>
                        <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                        <!--      Aviso     -->
                        <br><br><br>
                        <div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
                        <br>
                        <!--      QR     -->
                        <br><br>
                        <table cellpadding="10" cellspacing="0" width="100%" border=1>
                            <tr><td width="15%" align="center"><? echo GenerarQR("LTG" . number_format( $rec_sector_alumno["folio"],0), "qr_sector_".$elnivel."/"); ?> </td><td style="font-size:18px; font-weight:bold; vertical-align:top">Observaciones</td></tr>
                            <tr><td>NOTA<br>IMPORTANTE</td><td>
                                <ol>
                                    <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                                    <li style="margin:10px">No se le har&aacute; entrega de material alguno, sí el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                                    <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                            </td></tr>
                        <table><br><br><br>  
                        <br><br><br><p style="text-align:left"><small><? echo $liga; ?></small></p>
            </div><?php
        } // fin del procede    
}  ?></div></body></html>
<?
function GenerarQR($contenido, $dir_enviado) {
    $dir = $dir_enviado;
    if (!file_exists($dir))
        mkdir($dir);
    $filename = $dir . $contenido . '.png';
    $tamanio = 4;
    $level = 'M';
    $framesize = 1;
    QRcode::png($contenido, $filename, $level, $tamanio, $framesize);
    echo "<img src='" . $filename . "'/>";
}?>