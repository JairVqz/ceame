<?php
session_start(); 	
require_once('../conecta2023.php');
require_once('../inc/funciones_libros.php'); 
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
    case 65:    $elnivel="Secundaria T�cnica";  break;    
    case 72:    $elnivel="Telesecundaria Estatal";  break;
    case 73:    $elnivel="Telesecundaria Federal";  break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selecci�n</title>
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />
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
        if ($_SESSION["vg_tipousuario"]=="Almacen"){ $liga="https://librosgratuitosveracruz.org/ingresosupervisor/distribucion/recibo_zona_docente_dist20.php?x&n=".$_GET["n"]; }else{ $liga=""; }
        if ($_SESSION["vg_tipousuario"]=="Almacen" && !isset($_GET["x"])){
            $vl_back="../_panel.php?papa=1770";
            // ------------------------------------------------------------------- BANNER ENCABEZADO usuario almacen --------------------------------------------------------------- 
            $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Zonas de ".$elnivel."</h3>"; 		 
            $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
            // -----------------------------------------------------------------------------------------------------------------------------------------------------
            echo "<br><br><br><br>";   $liga1="Ver Escuelas|".$autollamada."x||#F9FFE4";
            $_sql="select distinct a.sector,a.zonaescola,a.cct_zona,b.nombre from ctsev a, supervis_c b where a.cct_zona=b.cuenta and a.estatus='A' and a.idalmadis=".$_SESSION["vg_idalmacen"]." and a.idnivel=".$_GET["n"]; 	//echo "<br><br><br><br>".$_sql; 
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
                                        <small><a class="fbutton fpadding-tiny fround fbold fpale-blue" href="<? echo $autollamada."x&n=".$_GET["n"]."&".$nomarreglo."=".oculta($caddatos,0); ?>">Recibo del libro de Cartograf�a</a></small>    
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
                $vl_back="../_panel.php";
                // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                $TItulo="<h3 class='fbold ftext-red fcenter'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
                $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                // -----------------------------------------------------------------------------------------------------------------------------------------------------
                $liga1="Recibo del libro de Cartograf�a|".$autollamada."seleccionado&||#F9FFE4|";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                flista_niveles_x_zona("",$liga1);  
                $vl_procede=0;
            }else{
                if ($_SESSION["vg_tipousuario"]=="Supervisor"){
                    $vl_back=$autollamada;
                    $arrnivel=explode("|",$arr_nivel); 
                    $elnivel=$arrnivel[1];
                    $vl_idnivel=$arrnivel[0];
                    $vg_cct_zona=$_SESSION["vg_cct_zona"];
                    $condidalmacen="";
                    $rsalma=mysql_query("select distinct a.cct_zona,a.idalmadis,b.almacen,b.responsable from ctver_distribucion20 a,almacen_c b where a.idalmadis=b.idalmacen and a.estatus='A' and a.idnivel=".$arrnivel[0]." and a.cct_zona='".$_SESSION["vg_cct_zona"]."'"); 
                    if (mysql_num_rows($rsalma)==1){
                        $rcalmacen=mysql_fetch_array($rsalma,MYSQL_ASSOC); 
                        $nomalmacen=$rcalmacen["almacen"];
                    }else{
                        // la zona en ese nivel tiene 2 almacenes distintos VER QUE HACER !!!!
                    }
                    $entrego=$rcalmacen["responsable"];
                }else{    
                    $vl_back=$autollamada."n=".$_GET["n"];
                    $arr_zona=explode("|",oculta($arrzona,1)); 
                    $vg_cct_zona=$arr_zona[0];
                    $vl_idnivel=$_GET["n"];
                    $condidalmacen="and e.idalmarbo=".$_SESSION["vg_idalmacen"];
                    $nomalmacen=$_SESSION["logeado"];
                    $entrego=$_SESSION["vg_responsable"];
                }
                $vl_procede=1;
            } 
            if ($vl_procede==1){ 
                // $_sql_escuelas="---select * from ctver_distribucion20 where estatus='A' and cct_zona='".$vg_cct_zona."' and idnivel=".$vl_idnivel; 	//echo $_sql_escuelas; 
                // $res_esc=mysql_query($_sql_escuelas); $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);  

                ?>
                <br><br>
                <img src='../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
                <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
                <div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
                            SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                            SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                            COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                            PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                            CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> 
                            <? $elnivel=str_replace("Estatal","",$elnivel);  $elnivel=str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);   ?>
                            <span style="font-weight:bold; font-size:16px">Recibo de zona del "Libro de Cartograf�a para alumnos de 4�,5� y 6�" (P0CMA)<br>
                            <? if ($vl_idnivel<69){echo "Nivel ".strtoupper($elnivel);}else{ echo "Nivel SECUNDARIA&emsp;Modalidad ".strtoupper($elnivel); } ?></span><br><br> <?
                //------------------------------------------------------------------------------------------------------------------------------------------
                            //mysql_query("SET SQL_BIG_SELECTS=1");
                            $_sql="select b.cuenta,b.nombre,a.sector,a.zonaescola,b.nommun as municipio,b.folio,b.nomloc as nombreloc,a.idnivel,a.nivel,count(a.cct) as numescuelas from ctver_distribucion20 a,supervis_c b where b.cuenta=a.cct_zona and a.estatus='A' ".$conidalmacen." and a.idnivel=".$vl_idnivel." and a.cct_zona='".$vg_cct_zona."' group by a.cct_zona"; 	//echo $_sql; 
                            $res_zona_alumno=mysql_query($_sql); 		 $rec_zona_alumno=mysql_fetch_array($res_zona_alumno,MYSQL_ASSOC);  

                //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                            <table class="ftable-print-horizontal" cellpadding="5" cellspacing="0" width="100%" border=1 style="font-weight:bold">
                                <tr><td width="10%">Folio</td><td  width="20%">LTG <? echo $rec_zona_alumno["folio"]; ?></td><td width="14%">Almacen</td><td><? echo  $nomalmacen; ?></td></tr>
                                <tr><td>CCT</td><td><? echo $vg_cct_zona; ?></td><td>Nombre</td><td><? echo $rec_zona_alumno["nombre"]; ?></td></tr>
                                <tr><td>Sector</td><td><? echo $rec_zona_alumno["sector"]; ?></td><td>Zona</td><td><? echo $rec_zona_alumno["zonaescola"]; ?></td></tr>
                                <tr><td>Localidad</td><td><? echo $rec_zona_alumno["nombreloc"]; ?></td><td>Municipio</td><td><? echo $rec_zona_alumno["municipio"]; ?></td></tr>
                            </table><br><br>  
                            <?  $_sql="select e.cct,e.turno,d.a4 as 23_a4,d.a5 as 23_a5,d.a6 as 23_a6,e.a4 as 24_a4,e.a5 as 24_a5,e.a6 as 24_a6 from ctsev_2023_2024 d, ctsev e where d.cct_zona=e.cct_zona and concat(d.cct,d.turno)=concat(e.cct,e.turno) and e.estatus='A' ".$condidalmacen." and e.cct_zona='".$vg_cct_zona."' and e.idnivel=".$vl_idnivel; //	echo $_sql; 
                                $res_esc=mysql_query($_sql); 		   $r=1;  $x=1;  ?>

                            
                            <table width="100%" cellpadding=8 cellspacing=0 border=1>
                            <tr><td rowspan=2></td><td style="font-size:16px; font-weight:bold;">Clave</td><td colspan=3 style="font-size:16px; font-weight:bold;">Ciclo <? echo $_SESSION["vg_cicloescolaranterior"]; ?></td><td colspan=3 style="font-size:16px; font-weight:bold;">Ciclo <? echo $_SESSION["vg_cicloescolar"]; ?></td><td colspan=3 style="font-size:16px; font-weight:bold;">&emsp;Conciliaci�n&emsp;</td><td colspan=3 rowspan=2 style="font-size:16px; font-weight:bold;">Firma del director</td></tr>
                            <tr><td style="font-size:16px; font-weight:bold">cct-turno</td>
                                <td style="font-size:16px; font-weight:bold;">4�</td>
                                <td style="font-size:16px; font-weight:bold;">5�</td>
                                <td style="font-size:16px; font-weight:bold;">6�</td>
                                <td style="font-size:16px; font-weight:bold;">4�</td>
                                <td style="font-size:16px; font-weight:bold;">5�</td>
                                <td style="font-size:16px; font-weight:bold;">6�</td>
                                <td style="font-size:16px; font-weight:bold;">4�</td>
                                <td style="font-size:16px; font-weight:bold;">5�</td>
                                <td style="font-size:16px; font-weight:bold;">6�</td>
                            </tr> 
                           
                            
                            <?
                                    $tot4=0;    $tot5=0;    $tot6=0;
                                    while ($r<=mysql_num_rows($res_esc)){
                                        $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);    
                                        //if ($r==6 || $x==30){ $ban=1; $x=0;}else{$ban=0;}         
                                        if ($x==20){ $ban=1; $x=0;}else{$ban=0;}         
                                        if ($ban==1){ ?>
                                            </table>
                                            <br>
                                            <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>
                                            
                                            <br><br><br><br><br>
                                            <table width="100%" cellpadding=8 cellspacing=0 border=1>
                                                <tr><td rowspan=2></td><td style="font-size:16px; font-weight:bold;">Clave</td><td colspan=3 style="font-size:16px; font-weight:bold;">Ciclo <? echo $_SESSION["vg_cicloescolaranterior"]; ?></td><td colspan=3 style="font-size:16px; font-weight:bold;">Ciclo <? echo $_SESSION["vg_cicloescolar"]; ?></td><td colspan=3 style="font-size:16px; font-weight:bold;">&emsp;Conciliaci�n&emsp;</td><td colspan=3 rowspan=2 style="font-size:16px; font-weight:bold;">Firma del director</td></tr>
                                                <tr><td style="font-size:16px; font-weight:bold">cct-turno</td>
                                                    <td style="font-size:16px; font-weight:bold;">4�</td>
                                                    <td style="font-size:16px; font-weight:bold;">5�</td>
                                                    <td style="font-size:16px; font-weight:bold;">6�</td>
                                                    <td style="font-size:16px; font-weight:bold;">4�</td>
                                                    <td style="font-size:16px; font-weight:bold;">5�</td>
                                                    <td style="font-size:16px; font-weight:bold;">6�</td>
                                                    <td style="font-size:16px; font-weight:bold;">4�</td>
                                                    <td style="font-size:16px; font-weight:bold;">5�</td>
                                                    <td style="font-size:16px; font-weight:bold;">6�</td>
                                                </tr> 
                                            <?
                                        }

                                            $dif4=($rec_esc["23_a4"]-$rec_esc["24_a4"]);   $dif5=($rec_esc["23_a5"]-$rec_esc["24_a5"]);    $dif6=($rec_esc["23_a6"]-$rec_esc["24_a6"]);                                   
                                            if($dif4<0){ $tot4=$tot4+$dif4; }   if($dif5<0){ $tot5=$tot5+$dif5; }     if($dif6<0){ $tot6=$tot6+$dif6; }   
                                            ?>
                                            <tr style="border-color:#f8f8f8; height:50px">
                                                <td width="5"><small><? echo $r; ?></small></td>
                                                <td width="140"><? echo $rec_esc["cct"]." ".$rec_esc["turno"]; ?></td>
                                                <td><? echo $rec_esc["23_a4"]; ?></td>
                                                <td><?  echo $rec_esc["23_a5"]; ?></td>
                                                <td><?  echo $rec_esc["23_a6"]; ?></td>
                                                <td><? echo $rec_esc["24_a4"]; ?></td>
                                                <td><?  echo $rec_esc["24_a5"]; ?></td>
                                                <td><?  echo $rec_esc["24_a6"]; ?></td>
                                                <td style="text-align:center<? if($dif4<0){ echo "; color:red "; }?>"><? echo $dif4; ?></td>
                                                <td style="text-align:center<? if($dif5<0){ echo "; color:red "; }?>"><?  echo $dif5; ?></td>
                                                <td style="text-align:center<? if($dif6<0){ echo "; color:red "; }?>"><?  echo $dif6; ?></td>
                                                <td></td>
                                            </tr>
                                            <?
                                        
                                        $r++;   $x++;
                                    }?>
                                                <tr>
                                                    <td colspan=8 style="text-align:right; height:40px">Total por grado</td>
                                                    <td style="font-weight:bold; color:red"><? echo $tot4; ?></td>
                                                    <td style="font-weight:bold; color:red"><? echo $tot5; ?></td>
                                                    <td style="font-weight:bold; color:red"><? echo $tot6; ?></td>
                                                    <td rowspan=2></td>
                                                </tr>
                                                <tr>
                                                    <td colspan=8 style="text-align:right; height:40px">Total a recibir</td>
                                                    <td colspan=3 style="font-weight:bold; color:red"><? echo ($tot4+$tot5+$tot6); ?></td>
                                                </tr>                                                                                            


                                   
                            </table>
                            <!--      Aviso     --> 
                            <br><br>
                            <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>

                            <br><br><br><br><br><br>        


                            <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>NOTA: Recibe del libro de Cartograf�a, la cantidad que se identifica<br>como necesidad por plantel, de acuerdo al an�lisis de matricula real<br> entre los ciclos escolares <? echo $_SESSION["vg_cicloescolaranterior"]." y ". $_SESSION["vg_cicloescolar"]; ?>  </td></tr></table>
                            <br><br>


                            <!--      Firmas     -->

                            <? 
                            if ($_SESSION["elidnivel"]==31 ||  $_SESSION["elidnivel"]==32){
                                $firma_entrega="DE SECTOR";     $firma_recibe="DEL SUPERVISOR";     
                                $sello_entrega="SECTOR";         $sello_recibe="SUPERVISI�N"; 
                                $entrego="";  
                            }else{
                                $firma_entrega="DEL ALMAC�N";     $firma_recibe="DEL SUPERVISOR";     
                                $sello_entrega="ALMACEN";         $sello_recibe="SUPERVISI�N"; 
                            }

                            
                            ?>
                            <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBI�</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                            <!--      Aviso     -->
                            <br><br><br>
                            <div style="text-align:center"><small>Rafaela D�az Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable �nico de distribuci�n de Libros de Texto Gratuitos</small></div>
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