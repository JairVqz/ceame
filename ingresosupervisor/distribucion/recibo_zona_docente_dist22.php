<?php

session_start(); 	
require_once('../../conecta2023.php');
require_once('../../inc/funciones_libros.php'); 
require_once('../../phpqrcode/qrlib.php');  
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
        $liga=$_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"];
        
        if ($_SESSION["vg_tipousuario"]=="Almacen" && !isset($_GET["x"])){
            $vl_back="../../_panel.php?papa=1765";
            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
            $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Zonas de ".$elnivel."</h3>"; 		 
            $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
            // -----------------------------------------------------------------------------------------------------------------------------------------------------
            echo "<br><br><br><br>";   $liga1="Ver Escuelas|".$autollamada."x||#F9FFE4";
            $_sql="select distinct a.sector,a.zonaescola,a.cct_zona,b.nombre from ctver_distribucion6 a, supervis_c b where a.cct_zona=b.cuenta and a.idalmadis=".$_SESSION["vg_idalmacen"]." and a.idnivel=".$_GET["n"]; 	//echo "<br><br><br><br>".$_sql; 
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
                                        <small><a class="fbutton fpadding-tiny fround fbold fpale-green" href="<? echo $autollamada."x&n=".$_GET["n"]."&".$nomarreglo."=".oculta($caddatos,0); ?>">Recibo Libros de texto adicional</a></small>    
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
                $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                // -----------------------------------------------------------------------------------------------------------------------------------------------------
                $liga1="Libros primaria adicionales|".$autollamada."seleccionado&||#F9FFE4|3,6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
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
                $_sql_escuelas="select * from ctver_distribucion6 where cct_zona='".$vg_cct_zona."' and idnivel=".$vl_idnivel; 	//echo $_sql; 
                $res_esc=mysql_query($_sql_escuelas); $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);  

                ?>
                <br><br>
                <img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
                <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
                <div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
                            SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                            SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                            COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                            PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                            CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> 
                            <? $elnivel=str_replace("Estatal","",$elnivel);  $elnivel=str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);   ?>
                            <span style="font-weight:bold; font-size:16px">RECIBO DE ZONA "LIBROS DE TEXTO GRATUITOS NIVEL PRIMARIA ADICIONAL" <br>
                            <? // if ($vl_idnivel<69){echo "Nivel ".strtoupper($elnivel);}else{ echo "Nivel SECUNDARIA&emsp;Modalidad ".strtoupper($elnivel); } ?></span><br><br> <?
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
                   
                            <table width="100%" align="center" cellpadding=5 cellspacing=0  style="font-size:12px"><!-- Tabla descriptiva, sin cantidades variables por eso no se usa programa para llenarla -->
                                <tr><td style="vertical-align:top">
                                    <table width="100%" align="left" cellpadding=5 cellspacing=0 border=1 style="border-color:#F8F8F8"> 
                                        <tr><td style="font-size:14px; font-weight:bold"></td><td style="font-size:14px; font-weight:bold">Clave</td><td style="font-size:14px; font-weight:bold">Grado</td><td style="font-size:14px; font-weight:bold;">Titulo</td><tr>

                                        <tr><td>1	</td><td>P1PAA</td><td style="text-align:CENTER">1</td><td style="text-align:left">Libro de proyectos de aula</td><tr>
                                        <tr><td>2	</td><td>P1PEA</td><td style="text-align:CENTER">1</td><td style="text-align:left">Libro de proyectos escolares</td><tr>
                                        <tr><td>3	</td><td>P1PCA</td><td style="text-align:CENTER">1</td><td style="text-align:left">Libro de proyectos comunitarios</td><tr>
                                        <tr><td>4	</td><td>P1MLA</td><td style="text-align:CENTER">1</td><td style="text-align:left">Múltiples lenguajes</td><tr>
                                        <tr><td>5	</td><td>P1SDA</td><td style="text-align:CENTER">1</td><td style="text-align:left">Nuestros saberes: Libro para alumnos, maestros y familia</td><tr> 
                                        <tr><td>6	</td><td>P1TPA</td><td style="text-align:CENTER">1</td><td style="text-align:left">Múltiples Lenguajes: Trazos y palabras</td><tr>

                                        <tr><td>7	</td><td>P2PAA</td><td style="text-align:CENTER">2</td><td style="text-align:left">Libro de proyectos de aula</td><tr>
                                        <tr><td>8	</td><td>P2PEA</td><td style="text-align:CENTER">2</td><td style="text-align:left">Libro de proyectos escolares</td><tr>
                                        <tr><td>9	</td><td>P2PCA</td><td style="text-align:CENTER">2</td><td style="text-align:left">Libro de proyectos comunitarios</td><tr>
                                        <tr><td>10	</td><td>P2MLA</td><td style="text-align:CENTER">2</td><td style="text-align:left">Múltiples lenguajes</td><tr>
                                        <tr><td>11	</td><td>P2SDA</td><td style="text-align:CENTER">2</td><td style="text-align:left">Nuestros saberes: Libro para alumnos, maestros y familia</td><tr>

                                        <tr><td>12	</td><td>P3PAA</td><td style="text-align:CENTER">3</td><td style="text-align:left">Libro de proyectos de aula</td><tr>
                                        <tr><td>13	</td><td>P3PEA</td><td style="text-align:CENTER">3</td><td style="text-align:left">Libro de proyectos escolares</td><tr>
                                        <tr><td>14	</td><td>P3PCA</td><td style="text-align:CENTER">3</td><td style="text-align:left">Libro de proyectos comunitarios</td><tr>
                                        <tr><td>15	</td><td>P3MLA</td><td style="text-align:CENTER">3</td><td style="text-align:left">Múltiples lenguajes</td><tr>
                                        <tr><td>16	</td><td>P3SDA</td><td style="text-align:CENTER">3</td><td style="text-align:left">Nuestros saberes: Libro para alumnos, maestros y familia</td><tr>
                                        <tr><td>17	</td><td>P4PAA</td><td style="text-align:CENTER">4</td><td style="text-align:left">Libro de proyectos de aula</td><tr>

                                    </table>
                                </td>
                                <td  style="vertical-align:top">
                                    <table width="100%"  cellpadding=5 align="rigth" cellspacing=0 border=1 style="border-color:#F8F8F8"> 
                                        <tr><td style="font-size:14px; font-weight:bold"></td><td style="font-size:14px; font-weight:bold">Clave</td><td style="font-size:14px; font-weight:bold">Grado</td><td style="font-size:14px; font-weight:bold;">Titulo</td><tr>
                                        <tr><td>18	</td><td>P4PEA</td><td style="text-align:CENTER">4</td><td style="text-align:left">Libro de proyectos escolares</td><tr>

                                        <tr><td>19	</td><td>P4PCA</td><td style="text-align:CENTER">4</td><td style="text-align:left">Libro de proyectos comunitarios</td><tr>
                                        <tr><td>20	</td><td>P4MLA</td><td style="text-align:CENTER">4</td><td style="text-align:left">Múltiples lenguajes</td><tr>
                                        <tr><td>21	</td><td>P4SDA</td><td style="text-align:CENTER">4</td><td style="text-align:left">Nuestros saberes: Libro para alumnos, maestros y familia</td><tr>

                                        <tr><td>22	</td><td>P5PAA</td><td style="text-align:CENTER">5</td><td style="text-align:left">Libro de proyectos de aula</td><tr>
                                        <tr><td>23	</td><td>P5PEA</td><td style="text-align:CENTER">5</td><td style="text-align:left">Libro de proyectos escolares</td><tr>
                                        <tr><td>24	</td><td>P5PCA</td><td style="text-align:CENTER">5</td><td style="text-align:left">Libro de proyectos comunitarios</td><tr>
                                        <tr><td>25	</td><td>P5MLA</td><td style="text-align:CENTER">5</td><td style="text-align:left">Múltiples lenguajes Quinto grado</td><tr>
                                        <tr><td>26	</td><td>P5SDA</td><td style="text-align:CENTER">5</td><td style="text-align:left">Nuestros saberes: Libro para alumnos, maestros y familia</td><tr>

                                        <tr><td>27	</td><td>P6PAA</td><td style="text-align:CENTER">6</td><td style="text-align:left">Libro de proyectos de aula</td><tr>
                                        <tr><td>28	</td><td>P6PEA</td><td style="text-align:CENTER">6</td><td style="text-align:left">Libro de proyectos escolares</td><tr>
                                        <tr><td>29	</td><td>P6PCA</td><td style="text-align:CENTER">6</td><td style="text-align:left">Libro de proyectos comunitarios</td><tr>
                                        <tr><td>30	</td><td>P6MLA</td><td style="text-align:CENTER">6</td><td style="text-align:left">Múltiples lenguajes</td><tr>
                                        <tr><td>31	</td><td>P6SDA</td><td style="text-align:CENTER">6</td><td style="text-align:left">Nuestros saberes: Libro para alumnos, maestros y familia Sexto grado</td><tr>

                                        <tr><td>32	</td><td>P0SHA</td><td style="text-align:CENTER">4,5,6</td><td style="text-align:left">Nuestros saberes: México grandeza y diversidad</td><tr>
                                    </table>
                                </td>
                            </table>
                            <p class="SaltoDePagina" style="text-align:left"><small><? echo $liga; ?></small></p>
                            <?
                //----------------------------------------------------------------------------------------------------------------------------------------------  ?>
                            <br><br><br>
                            <table cellpadding="7" cellspacing="0" width="100%" border=1 style="border-color:#F8F8F8"><tr><td>Importante: Se está entregando dos juegos de 1° a 6° grado de libros de texto gratuitos<br>por escuela, para uso del docente y este deberá permanecer en el plantel escolar</td></tr></table>
                            <br><br>
                            <?  $_sql="select * from ctver_distribucion22 where cct_zona='".$vg_cct_zona."' and idnivel=".$vl_idnivel; 	//echo $_sql; 
                                $res_esc=mysql_query($_sql); 		   $r=1;  $x=1;  ?>

                            
                            <table width="100%" cellpadding=5 cellspacing=0>
                            <tr><td></td><td style="border-bottom:1px solid; text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                                <td style="border-bottom:1px solid; font-size:12px; font-weight:bold;" width="300">&emsp;&emsp;Nombre CT</td>
                                <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">1°g</td>
                                <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">2°g</td>
                                <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">3°g</td>
                                <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">4°g</td>
                                <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">5°g</td>
                                <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">6°g</td>
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
                                                    <td style="border-bottom:1px solid; font-size:12px; font-weight:bold;" width="300">&emsp;&emsp;Nombre CT</td>
                                                    <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">1°g</td>
                                                    <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">2°g</td>
                                                    <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">3°g</td>
                                                    <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">4°g</td>
                                                    <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">5°g</td>
                                                    <td width="40" style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">6°g</td>
                                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Nombre</td>
                                                    <td style="border-bottom:1px solid; text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                                                </tr>
                                                <tr><td colspan="7">&emsp;</td></tr><?
                                        }

                                                                               
                                            ?>
                                            <tr>
                                                <td width="5"><small><? echo $r; ?></small></td>
                                                <td width="105" style="text-align:center"><small><? echo $rec_esc["cct"]." ".$rec_esc["turno"]; ?></small></td>
                                                <td style="text-align:left;"><small>&emsp;<? echo $rec_esc["nom_ct"]; ?></small></td>
                                                <td style="text-align:center"><small>2</small></td>
                                                <td style="text-align:center"><small>2</small></td>
                                                <td style="text-align:center"><small>2</small></td>
                                                <td style="text-align:center"><small>2</small></td>
                                                <td style="text-align:center"><small>2</small></td>
                                                <td style="text-align:center"><small>2</small></td>
                                                <td>________________</td>
                                                <td>________________</td>
                                            </tr>
                                            <?
                                        
                                        $r++;   $x++;
                                    }?>
                                    <tr><td colspan="12"><hr></td></tr>
                                    <tr><td colspan=3 align="right">Totales</td>                                                
                                        <td style="text-align:center"><small><? echo ($r-1)*2; ?></small></td>
                                        <td style="text-align:center"><small><? echo ($r-1)*2; ?></small></td>
                                        <td style="text-align:center"><small><? echo ($r-1)*2; ?></small></td>
                                        <td style="text-align:center"><small><? echo ($r-1)*2; ?></small></td>
                                        <td style="text-align:center"><small><? echo ($r-1)*2; ?></small></td>
                                        <td style="text-align:center"><small><? echo ($r-1)*2; ?></small></td>
                                    </tr>



                                   
                            </table>
                            <!--      Aviso     --> 
                            <br><br>
                            <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>

                            <br><br><br><br>       


                            <table cellpadding="7" cellspacing="0" width="100%" border=1  style="border-color:#f8f8f8"><tr><td>Este recibo es un documento oficial y los libros que recibo son propiedad de la Nación, <br>por lo que me comprometo a vigilar el buen uso del material y verificar la entrega a los berneficiarios</td></tr></table>
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
                            <table cellpadding="10" cellspacing="0" width="100%" border=1 align="left">
                                <tr><td width="15%" align="center"><?  echo GenerarQR("LTG" . number_format( $rec_zona_alumno["folio"],0), "qr_zona_adicional".$elnivel."/"); ?> </td><td style="font-size:18px; font-weight:bold;  vertical-align:center">Observaciones</td></tr>
                                <tr><td>NOTA<br>IMPORTANTE</td><td style="text-align:left">
                                    <ol>
                                        <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                                        <li style="margin:10px">No se le har&aacute; entrega de material alguno si el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                                        <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                                </td></tr>
                            </table>&emsp;<hr><p style="text-align:left"><small><? echo $liga; ?></small></p><br><br><br>
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