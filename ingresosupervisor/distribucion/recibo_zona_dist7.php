<?php
session_start(); 	
require_once('../../conecta2023.php');
require_once('../../inc/funciones_libros.php'); 
conectalo("almacen");
switch($_GET["n"]){
    case 30:    $elnivel="Preescolar Estatal";  break;
    case 31:    $elnivel="Preescolar Federal";  break;
    case 32:    $elnivel="Preescolar Indigena";  break;
    case 40:    $elnivel="Primaria Estatal";  break;
    case 41:    $elnivel="Primaria Federal";  break;
    case 42:    $elnivel="Primaria Indigena";  break;
    case 60:    $elnivel="Secundaria Estatal";  break;
    case 61:    $elnivel="Secundaria General";  break;
    case 65:    $elnivel="Secundaria Técnica";  break;    
    case 72:    $elnivel="Telesecundaria Estatal";  break;
    case 73:    $elnivel="Telesecundaria Federal";  break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selección</title>
<link rel="stylesheet" href="../../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../css/frcico.css" type="text/css" media="screen" />
<style type="text/css" media="print">
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        } 
        p.SaltoDePagina { PAGE-BREAK-AFTER: always }  
        tr.SaltoDePagina { PAGE-BREAK-AFTER: always }  
</style>
<style type="text/css">	
        .ftable-print{ border-color:#FDFDFD; font-size:14px }
		.ftable-print-horizontal{ border-color:#FBFBFB; border-right:none; font-size:14px }
  		.ftable-print-horizontal td,th { border-left: none; border-right: none; }
</style>
<SCRIPT TYPE="text/javascript">
		function doPrint(){
			document.all.item("regresar").style.visibility='hidden'; 
            document.all.item("Imprimir").style.visibility='hidden';
            window.print();
            document.all.item("regresar").style.visibility='visible';
            document.all.item("Imprimir").style.visibility='visible';
		}
</SCRIPT>
<script type="text/javascript" languaje="javascript">var message = "";function rtclickcheck(keyp){ if (navigator.appName == "Netscape" && keyp.which == 3){ alert(message); return false; }if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) { alert(message); return false; } }document.onmousedown = rtclickcheck;</script>


<body <? if (!isset($_GET["x"]) && ($_SESSION["vg_tipousuario"]=="Almacen")){ ?> class="fcenter" <?}else{ ?> style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center; font-size:14px;" <? } ?>>  <?
    $arr=explode( "/", $_SERVER[ "PHP_SELF "]); $autollamada= $arr[count( $arr)-1]. "?"; 
    if ((!isset($logeado) && !isset($TxtUsuario))){
        echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
    }else{
        switch ($_GET["ex"]){
        case 1:  //  ingresa Almacen /// No se uso para sectores este recibo
            // $vl_back="../../_panel.php?papa=1575";
            // // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
            // $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Sectores de ".$elnivel."</h3>"; 		 
            // $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob_temporal.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
            // // -----------------------------------------------------------------------------------------------------------------------------------------------------
            // echo "<br><br><br><br>";   $liga1="Ver Escuelas|".$autollamada."x||#F9FFE4";
            // $_sql="select distinct a.sector,a.cct_sector,b.nombre from ctver_distribucion7 a, sector_c b where a.cct_sector=b.cuenta and a.idalmadis=".$_SESSION["vg_idalmacen"]." and a.idnivel=".$_GET["n"]; 	//echo "<br><br><br><br>".$_sql; 
            // $res=mysql_query($_sql); 		$r=0; 
            // if (mysql_num_rows($res)>0){ ?> 
                 <!-- <div class="fix7 fshad fdeg"> 
                     <table class="ftable-all fborder"> 
                         <tr><th>Sector</th><th>Nombre</th><th></th><th></th></tr> -->
                         <? 
            //                 while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); $tot=0; 
            //                     $nomarreglosector="arrsector"; $caddatos=$recset["cct_sector"]."|".$recset["nombre"]; 	
            ?> 
                                 <!-- <tr> 
                                     <td><? //echo $recset["sector"]; ?></td> 
                                     <td><small><? // echo $recset["nombre"]; ?></small></td> 
                                     <td>
                                         <small><a class="fbutton fpadding-tiny fround fbold fpale-green" href="<? //echo $autollamada."ex=2&n=".$_GET["n"]."&".$nomarreglosector."=".oculta($caddatos,0); ?>">Recibo de Biblioteca SEP</a></small>    
                                     </td> 
                                     <td>
                                         <small><a class="fbutton fpadding-tiny fround fbold fpale-green" href="<? //echo $autollamada."ex=5&n=".$_GET["n"]."&".$nomarreglosector."=".oculta($caddatos,0) ?>">Ver zonas</a></small>    
                                     </td>
                                 </tr> --> 
                                 <?  
                                 
            //                     $r++; 
            //                 } 
            ?>		 
                            
                <!--     </table> 
                 </div>  --><? 
            // }else{ fmessage("No hay registros",2500,2); }
            break;
        case 2:  //  Ingresa Almacen (de la liga en ex=1) e ingresa Supervisor (de su menu principal)
            /// ESTE RECIBO SE HIZO PARA ALUMNOS PERO DE BIBLIOTECAS QUE LLEGARON EN DICIEMBRE DE 2023 ! 
            if ($_SESSION["vg_tipousuario"]=="Supervisor" && !isset($_GET["seleccionado"])){
                $vl_back="../../_panel.php";
                // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                $TItulo="<h3 class='fbold ftext-red fcenter'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
                $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob_temporal.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                // -----------------------------------------------------------------------------------------------------------------------------------------------------
                $liga1="Recibo de Libros de texto del alumno (adicional)|".$autollamada."ex=2&seleccionado&||#F9FFE4|";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                flista_niveles_x_zona("",$liga1);  
                $vl_procede=0;
            }else{
                if ($_SESSION["vg_tipousuario"]=="Supervisor"){
                    $vl_back=$autollamada."ex=2";
                    $arrnivel=explode("|",$arr_nivel); 
                    $elnivel=$arrnivel[1];
                    $vl_idnivel=$arrnivel[0];
                    $vg_cct_zona=$_SESSION["vg_cct_zona"];
                }else{    
                    $vl_back=$autollamada."ex=5&n=".$_GET["n"];
                    $arr_zona=explode("|",oculta($arrzona,1)); 
                    $vg_cct_zona=$arr_zona[0];
                    $vl_idnivel=$_GET["n"];
                    
                }
                $vl_procede=1;
            } 
            if ($vl_procede==1){ 
                $_sql_escuelas="select * from ctver_distribucion7 where cct_zona='".$vg_cct_zona."' and idnivel=".$vl_idnivel; 	echo $_sql; 
                $res_esc=mysql_query($_sql_escuelas); $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);  

                ?>
                <br><br>
                <img src='../../images/logo_SEVGob_temporal.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
                <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
                <div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
                            SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                            SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                            COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                            PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                            CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> 
                            RECIBO DE ZONA: 
                            <? $elnivel=str_replace("Estatal","",$elnivel);  $elnivel=str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);   ?>
                            <span style="font-weight:bold; font-size:16px">Libros de Texto del alumno<br>
                            <? if ($vl_idnivel<69){echo "Nivel ".strtoupper($elnivel);}else{ echo "Nivel SECUNDARIA&emsp;Modalidad ".strtoupper($elnivel); } ?></span><br><br> <?
                //------------------------------------------------------------------------------------------------------------------------------------------
                            //mysql_query("SET SQL_BIG_SELECTS=1");
                            $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,a.nommun as municipio,a.folio,b.idalmarbo,b.almarbo,a.nomloc as nombreloc,b.idnivel,b.nivel,count(b.cct) as numescuelas from supervis_c a,ctsev b where a.cuenta=b.cct_zona and b.idnivel=".$vl_idnivel." and b.estatus='A' and b.cct_zona='".$vg_cct_zona."' group by b.cct_zona"; //	echo $_sql; 
                            $res_zona_alumno=mysql_query($_sql); 		 $rec_zona_alumno=mysql_fetch_array($res_zona_alumno,MYSQL_ASSOC);  

                            $_sql="select almacen,responsable from almacen_c where idalmacen=".$rec_esc["idalmadis"]; //	echo $_sql; 
                            $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC);                          
                //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                            <table class="ftable-print-horizontal" cellpadding="5" cellspacing="0" width="100%" border=1 style="font-weight:bold">
                                <tr><td width="10%">Folio</td><td  width="20%">LTG <? echo $rec_zona_alumno["folio"]; ?></td><td width="14%">Almacen</td><td><? echo  $rec_almacen["almacen"]; ?></td></tr>
                                <tr><td>CCT</td><td><? echo $vg_cct_zona; ?></td><td>Nombre</td><td><? echo $rec_zona_alumno["nombre"]; ?></td></tr>
                                <tr><td>Sector</td><td><? echo $rec_zona_alumno["sector"]; ?></td><td>Zona</td><td><? echo $rec_zona_alumno["zonaescola"]; ?></td></tr>
                                <tr><td>Localidad</td><td><? echo $rec_zona_alumno["nombreloc"]; ?></td><td>Municipio</td><td><? echo $rec_zona_alumno["municipio"]; ?></td></tr>
                            </table><br><br>  
                           
                            
                            <h4 style="font-weight:bold">"Se entregán 2 paquetes de Libros de Texto Gratuitos del Alumno de 1° a 6° Grado por plantel escolar de organización completa, para su uso y resguardo en el centro escolar"</h4>
                            
                            

                           
                            <?
                //----------------------------------------------------------------------------------------------------------------------------------------------  ?>
                            <br><br><br>
                            <?  $_sql="select * from ctver_distribucion7 where cct_zona='".$vg_cct_zona."' and idnivel=".$vl_idnivel; 	//echo $_sql; 
                                $res_esc=mysql_query($_sql); 		   $r=1;  $x=1;  ?>

                            
                            <table width="100%" cellpadding=5 cellspacing=0>
                            <tr><td></td><td style="border-bottom:1px solid; text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                                <td style="border-bottom:1px solid; font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                                <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Municipio</td>
                                <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Localidad</td>
                                <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Asignado<br><small>2 paquetes</small></td>
                                <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Nombre</td>
                                <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                            </tr> 
                            <tr><td colspan="7">&emsp;</td></tr>
                            
                            <?
                                    $sum1=0;    $sum4=0;    $sum5=0;    $sum6=0;
                                    while ($r<=mysql_num_rows($res_esc)){
                                        $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);    

                                        //if ($r==6 || $x==30){ $ban=1; $x=0;}else{$ban=0;}         
                                        if ($x==20){ $ban=1; $x=0;}else{$ban=0;}         
                                        if ($ban==1){ ?>
                                            </table>
                                            <br>
                                            <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>
                                            
                                            <br><br><br><br><br>
                                            <table width="100%" cellpadding=5 cellspacing=0>
                                                <tr><td></td><td style="border-bottom:1px solid; text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                                                    <td style="border-bottom:1px solid; font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Municipio</td>
                                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Localidad</td>
                                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Asignado<br><small>2 paquetes</small></td>
                                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Nombre</td>
                                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                                                </tr>
                                                <tr><td colspan="7">&emsp;</td></tr><?
                                        }

                                                                                
                                            ?>
                                            <tr>
                                                <td width="5"><small><? echo $r; ?></small></td>
                                                <td width="105" style="text-align:center"><small><? echo $rec_esc["cct"]." ".$rec_esc["turno"]; ?></small></td>
                                                <td style="text-align:left;"><small><? echo $rec_esc["escuelas"]; ?></small></td>
                                                <td style="text-align:left"><small><?  echo $rec_esc["nombrempio"]; ?></small></td>
                                                <td style="text-align:left"><small><?  echo $rec_esc["nombreloc"]; ?></small></td>
                                                <td style="text-align:center"><small><?  echo $rec_esc["2paqltg1a6"]; ?></small></td>
                                                <td>________________</td>
                                                <td>________________</td>
                                            </tr>
                                            <?
                                        
                                        $r++;   $x++;   $sum1=$sum1+$rec_esc["2paqltg1a6"];
                                    }?>
                                    <tr><td colspan="7">------------------------------------------------------------------------------------------------------------------------</td><tr>
                                    <tr><td colspan="5">Total</td><td><? echo $sum1; ?></td><tr>


                                    
                            </table>
                            <!--      Aviso     --> 
                            <br><br>
                            <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>

                            <br><br><br><br><br><br>        


                            <!-- <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>Asignado 2 paquetes de libros de texto gratuitos del alumno de 1 a 6</td></tr></table>  -->
                            <br><br>


                            <!--      Firmas     -->

                            <? 
                            if ($_SESSION["elidnivel"]==31 ||  $_SESSION["elidnivel"]==32){
                                $firma_entrega="DE SECTOR";     $firma_recibe="DEL SUPERVISOR";     
                                $sello_entrega="SECTOR";         $sello_recibe="SUPERVISIÓN"; 
                                $entrego="";  
                            }else{
                                $firma_entrega="DEL ALMACÉN";     $firma_recibe="DEL SUPERVISOR";     
                                $sello_entrega="ALMACEN";         $sello_recibe="SUPERVISIÓN"; 
                                $entrego=$rec_almacen["responsable"]; 
                            }

                            
                            ?>
                            <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                            <!--      Aviso     -->
                            <br><br><br>
                            <div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
                            <br>
                            <!--      QR     -->
                            <br><br>
                            <!-- <table cellpadding="10" cellspacing="0" width="100%" border=1>
                                <tr><td width="15%" align="center"><? //echo GenerarQR("LTG-".$vg_cct_zona, "qr_zona_".$vg_cct_zona."/"); ?> </td><td style="font-size:18px; font-weight:bold;  vertical-align:top">Observaciones</td></tr>
                                <tr><td>NOTA<br>IMPORTANTE</td><td>
                                    <ol>
                                        <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                                        <li style="margin:10px">No se le har&aacute; entrega de material alguno si el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                                        <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                                </td></tr>
                            <table><br><br><br>             -->

                            <br><br><br><p style="text-align:left"><small><? echo $liga; ?></small></p>
                </div><?php
            }
            break;
        case 5:
                
                

            ///////////////////////////////////////////////////////////////////////////////////////////////    RECIBO DE ZONA
            if ($_SESSION["vg_tipousuario"]=="Almacen" && !isset($_GET["w"])){
                $vl_back="../../_panel.php?papa=1575";
                // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Zonas de ".$elnivel."</h3>"; 		 
                $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob_temporal.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                // -----------------------------------------------------------------------------------------------------------------------------------------------------
                echo "<br><br><br><br>";   $liga1="Ver Escuelas|".$autollamada."x||#F9FFE4";
                $_sql="select distinct a.sector,a.zonaescola,a.cct_zona,b.nombre from ctver_distribucion7 a, supervis_c b where a.cct_zona=b.cuenta and a.idalmadis=".$_SESSION["vg_idalmacen"]." and a.idnivel=".$_GET["n"]; 	//echo "<br><br><br><br>".$_sql; 
                $res=mysql_query($_sql); 		$r=0; 
                if (mysql_num_rows($res)>0){ ?> 
                    <div class="fix7 fshad fdeg"> 
                        <table class="ftable-all fborder"> 
                            <tr><th>Sector</th><th>Zona</th><th>Cct-zona</th><th>Nombre</th><th></th></tr><? 
                                while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); $tot=0; 
                                    $nomarreglo="arrzona"; $caddatos=$recset["cct_zona"]."|".$recset["nombre"]; 	?> 
                                    <tr> 
                                        <td><? echo $recset["sector"]; ?></td> 
                                        <td><? echo $recset["zonaescola"]; ?></td> 
                                        <td><? echo $recset["cct_zona"]; ?></td> 
                                        <td><small><? echo $recset["nombre"]; ?></small></td> 
                                        <td>
                                            <small><a class="fbutton fpadding-tiny fround fbold fpale-green" href="<? echo $autollamada."x&ex=2&n=".$_GET["n"]."&".$nomarreglo."=".oculta($caddatos,0); ?>">Recibo de libros de texto adicional</a></small>    
                                        </td> 
                                    </tr> <? 
                                    $r++; 
                                } ?>		 
                            
                        </table> 
                    </div><? 
                }else{ fmessage("No hay registros",2500,2); }

            }else{
                /// ESTE RECIBO SE HIZO PARA ALUMNOS PERO DE BIBLIOTECAS QUE LLEGARON EN DICIEMBRE DE 2023 ! 
                if ($_SESSION["vg_tipousuario"]=="Supervisor" && !isset($_GET["seleccionado"])){
                    $vl_back="../../_panel.php";
                    // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                    $TItulo="<h3 class='fbold ftext-red fcenter'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
                    $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob_temporal.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                    // -----------------------------------------------------------------------------------------------------------------------------------------------------
                    $liga1="Recibo de Biblioteca SEP|".$autollamada."seleccionado&||#F9FFE4|";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    flista_niveles_x_zona("",$liga1);  
                    $vl_procede=0;
                }else{
                    if ($_SESSION["vg_tipousuario"]=="Supervisor"){
                        $vl_back=$autollamada;
                        $arrnivel=explode("|",$arr_nivel); 
                        $elnivel=$arrnivel[1];
                        $vl_idnivel=$arrnivel[0];
                        $vg_cct_zona=$_SESSION["vg_cct_zona"];
                    }else{    
                        $vl_back=$autollamada."n=".$_GET["n"];
                        $arr_zona=explode("|",oculta($arrzona,1)); 
                        $vg_cct_zona=$arr_zona[0];
                        $vl_idnivel=$_GET["n"];
                        
                    }
                    $vl_procede=1;
                } 
                if ($vl_procede==1){ 
                    $_sql_escuelas="select * from ctver_distribucion7 where cct_zona='".$vg_cct_zona."' and idnivel=".$vl_idnivel; 	//echo $_sql; 
                    $res_esc=mysql_query($_sql_escuelas); $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);  

                    ?>
                    <br><br>
                    <img src='../../images/logo_SEVGob_temporal.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
                    <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
                    <div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
                                SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                                SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                                COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                                PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                                CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> 
                                <? $elnivel=str_replace("Estatal","",$elnivel);  $elnivel=str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);   ?>
                                <span style="font-weight:bold; font-size:16px">RECIBO DE ZONA:  "Biblioteca SEP Centenaria para la Actualización del Magisterio (BAM) 2023" <br>
                                <? if ($vl_idnivel<69){echo "Nivel ".strtoupper($elnivel);}else{ echo "Nivel SECUNDARIA&emsp;Modalidad ".strtoupper($elnivel); } ?></span><br><br> <?
                    //------------------------------------------------------------------------------------------------------------------------------------------
                                //mysql_query("SET SQL_BIG_SELECTS=1");
                                $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,a.nommun as municipio,a.folio,b.idalmarbo,b.almarbo,a.nomloc as nombreloc,b.idnivel,b.nivel,count(b.cct) as numescuelas from supervis_c a,ctsev b where a.cuenta=b.cct_zona and b.idnivel=".$vl_idnivel." and b.estatus='A' and b.cct_zona='".$vg_cct_zona."' group by b.cct_zona"; //	echo $_sql; 
                                $res_zona_alumno=mysql_query($_sql); 		 $rec_zona_alumno=mysql_fetch_array($res_zona_alumno,MYSQL_ASSOC);  

                                $_sql="select almacen,responsable from almacen_c where idalmacen=".$rec_esc["idalmadis"]; //	echo $_sql; 
                                $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC);                          
                    //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                                <table class="ftable-print-horizontal" cellpadding="5" cellspacing="0" width="100%" border=1 style="font-weight:bold">
                                    <tr><td width="10%">Folio</td><td  width="20%">LTG <? echo $rec_zona_alumno["folio"]; ?></td><td width="14%">Almacen</td><td><? echo  $rec_almacen["almacen"]; ?></td></tr>
                                    <tr><td>CCT</td><td><? echo $vg_cct_zona; ?></td><td>Nombre</td><td><? echo $rec_zona_alumno["nombre"]; ?></td></tr>
                                    <tr><td>Sector</td><td><? echo $rec_zona_alumno["sector"]; ?></td><td>Zona</td><td><? echo $rec_zona_alumno["zonaescola"]; ?></td></tr>
                                    <tr><td>Localidad</td><td><? echo $rec_zona_alumno["nombreloc"]; ?></td><td>Municipio</td><td><? echo $rec_zona_alumno["municipio"]; ?></td></tr>
                                </table><br><br>  
                                <h4 style="text-align:center">Contenido de la Biblioteca</h4>  
                                <table width="100%" cellpadding=5 cellspacing=0> <!-- Tabla descriptiva, sin cantidades variables por eso no se usa programa para llenarla -->
                                    <tr><td style="font-size:14px; font-weight:bold">Clave</td><td style="font-size:14px; font-weight:bold;">Titulo</td><tr>
                                    <tr><td>BCDZ045</td><td style="text-align:left">&emsp;Didáctica. Las nuevas claves de la enseñanza y el aprendizaje</td><tr>
                                    <tr><td>BCDZ046</td><td style="text-align:left">&emsp;Educación y marxismo latinoamericano. Ensayos de pedagogía crítica para proyectos emancipatorios</td><tr>
                                    <tr><td>BCDZ047</td><td style="text-align:left">&emsp;La metodología del aprendizaje servicio. Aprender mejorando el mundo</td><tr>
                                    <tr><td>BCDZ048</td><td style="text-align:left">&emsp;Nuevos escenarios educativos. Otra gestión para otra enseñanza</td><tr>
                                    <tr><td>BCDZ049</td><td style="text-align:left">&emsp;Evaluación para el aprendizaje. Alternativas y nuevos desarrollos</td><tr>
                                    <tr><td>BCDZ050</td><td style="text-align:left">&emsp;Gestionar desde las diversidades en aulas instituciones y territorios; hacia una articulación educativa <br>&emsp;sustentable. Trayectorias inclusivas en escenarios entramados</td><tr>
                                    <tr><td>BCDZ051</td><td style="text-align:left">&emsp;Claves didácticas para renovar la enseñanza. Planificar estratégicamente</td><tr>
                                    <tr><td>BCDZ052</td><td style="text-align:left">&emsp;Estrategias docentes para un aprendizaje significativo</td><tr> 
                                    <tr><td>BCDZ053</td><td style="text-align:left">&emsp;Educación Popular. Historicidad y potencial emancipador</td><tr>
                                    <tr><td>BCDZ054</td><td style="text-align:left">&emsp;Paulo Freire y Orlando Fals Borda. Educadores Populares</td><tr>
                                </table>
                                <br><br><p class="SaltoDePagina" style="text-align:left"><small><? echo $liga; ?></small></p>
                                <?
                    //----------------------------------------------------------------------------------------------------------------------------------------------  ?>
                                <br><br><br>
                                <?  $_sql="select * from ctver_distribucion7 where cct_zona='".$vg_cct_zona."' and idnivel=".$vl_idnivel; 	//echo $_sql; 
                                    $res_esc=mysql_query($_sql); 		   $r=1;  $x=1;  ?>

                                
                                <table width="100%" cellpadding=5 cellspacing=0>
                                <tr><td></td><td style="border-bottom:1px solid; text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                                    <td style="border-bottom:1px solid; font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Municipio</td>
                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Localidad</td>
                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Asignado</td>
                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Nombre</td>
                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                                </tr> 
                                <tr><td colspan="7">&emsp;</td></tr>
                                
                                <?
                                        $sum1=0;    $sum4=0;    $sum5=0;    $sum6=0;
                                        while ($r<=mysql_num_rows($res_esc)){
                                            $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);    
                                            //if ($r==6 || $x==30){ $ban=1; $x=0;}else{$ban=0;}         
                                            if ($x==20){ $ban=1; $x=0;}else{$ban=0;}         
                                            if ($ban==1){ ?>
                                                </table>
                                                <br>
                                                <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>
                                                
                                                <br><br><br><br><br>
                                                <table width="100%" cellpadding=5 cellspacing=0>
                                                    <tr><td></td><td style="border-bottom:1px solid; text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                                                        <td style="border-bottom:1px solid; font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                                                        <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Municipio</td>
                                                        <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Localidad</td>
                                                        <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Asignado</td>
                                                        <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Nombre</td>
                                                        <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                                                    </tr>
                                                    <tr><td colspan="7">&emsp;</td></tr><?
                                            }

                                                                                
                                                ?>
                                                <tr>
                                                    <td width="5"><small><? echo $r; ?></small></td>
                                                    <td width="105" style="text-align:center"><small><? echo $rec_esc["cct"]." ".$rec_esc["turno"]; ?></small></td>
                                                    <td style="text-align:left;"><small><? echo $rec_esc["nom_ct"]; ?></small></td>
                                                    <td style="text-align:left"><small><?  echo $rec_esc["nombrempio"]; ?></small></td>
                                                    <td style="text-align:left"><small><?  echo $rec_esc["nombreloc"]; ?></small></td>
                                                    <td style="text-align:center"><small>1</small></td>
                                                    <td>________________</td>
                                                    <td>________________</td>
                                                </tr>
                                                <?
                                            
                                            $r++;   $x++;
                                        }?>


                                    
                                </table>
                                <!--      Aviso     --> 
                                <br><br>
                                <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>

                                <br><br><br><br><br><br>        


                                <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>Se entrega una Biblioteca con 10 títulos por plantel escolar</td></tr></table>
                                <br><br>


                                <!--      Firmas     -->

                                <? 
                                if ($_SESSION["elidnivel"]==31 ||  $_SESSION["elidnivel"]==32){
                                    $firma_entrega="DE SECTOR";     $firma_recibe="DEL SUPERVISOR";     
                                    $sello_entrega="SECTOR";         $sello_recibe="SUPERVISIÓN"; 
                                    $entrego="";  
                                }else{
                                    $firma_entrega="DEL ALMACÉN";     $firma_recibe="DEL SUPERVISOR";     
                                    $sello_entrega="ALMACEN";         $sello_recibe="SUPERVISIÓN"; 
                                    $entrego=$rec_almacen["responsable"]; 
                                }

                                
                                ?>
                                <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                                <!--      Aviso     -->
                                <br><br><br>
                                <div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
                                <br>
                                <!--      QR     -->
                                <br><br>
                                <!-- <table cellpadding="10" cellspacing="0" width="100%" border=1>
                                    <tr><td width="15%" align="center"><? //echo GenerarQR("LTG-".$vg_cct_zona, "qr_zona_".$vg_cct_zona."/"); ?> </td><td style="font-size:18px; font-weight:bold;  vertical-align:top">Observaciones</td></tr>
                                    <tr><td>NOTA<br>IMPORTANTE</td><td>
                                        <ol>
                                            <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                                            <li style="margin:10px">No se le har&aacute; entrega de material alguno si el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                                            <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                                    </td></tr>
                                <table><br><br><br>             -->

                                <br><br><br><p style="text-align:left"><small><? echo $liga; ?></small></p>
                    </div><?php
                }
            }
            break;
        }    
    } ?>
 </body>
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
}