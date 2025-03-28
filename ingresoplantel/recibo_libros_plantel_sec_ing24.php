<? session_start(); 	 $autollamada=basename(__FILE__). "?"; require_once('../phpqrcode/qrlib.php');  ?>
<html><head>
<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Recibo</title>
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
        .ftable-print{ border-color:#FDFDFD; font-size:14px }
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

require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');		conectalo("zona");    
if ((!isset($logeado) && !isset($TxtUsuario))){ 	fmessage("Acceso No Permitido",1500,2,$vl_back);
}else{ 
        switch($_SESSION["vg_tipousuario"]){
            case "Almacen":
                $vl_back="../ingresosupervisor/recibo_libros_zona.php?sel=escuela&cct_zona=".$_SESSION["cct_zona"]."&idnivel=".$_SESSION["elidnivel"]."&nivel".$_SESSION["elnivel"]."&arrniveles=".$_SESSION["elidnivel"]."&nombre=".$_SESSION["nombre_zona"];
                $elidnivel=$_GET["idnivel"];
                $elnivel=str_replace("Estatal","",$_GET["nivel"]);  $elnivel=str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);   
                $elccturno=$_GET["cct"].$_GET["turno"];
                $elccturno2=$_GET["cct"]."-".$_GET["turno"];
                $liga="http://www.librosgratuitosveracruz.org/ingresoplantel/recibo_libros_plantel_sec_ing24.php?folio=".$_GET["folio"]."&cct=".$_GET["cct"]."&turno=".$_GET["turno"]."idnivel=".$_GET["idnivel"]."&nivel=".$elnivel; 
                break;
            case "Plantel":
                $vl_back="../_panel.php";	
                $elccturno=$_SESSION["vg_cct_turno"];
                $elccturno2=$_SESSION["vg_cct"]."-".$_SESSION["vg_turno"];

                $liga="http://www.librosgratuitosveracruz.org/ingresoplantel/recibo_libros_plantel_sec_ing24.php";
                break;
        }    ?>
		<br><br>
		<img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
		<div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
		<div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
            SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
            SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
            COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
            PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
            CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> <?
            //K1LDG,K2LDG,K3LDG,K0CFA,K0LPM,K0MTM,K0TAM         Estos campos se agregaron para el ciclo 24-25
            $_sql="select id,cct,turno,nom_ct,sector,zonaescola,nombrempio,idalmarbo,almarbo,nombreloc,idnivel,nivel,a1 as alu1,a2 as alu2,a3 as alu3,d1,d2,d3,d4,d5,d6,dmgdo,K1LDG,K2LDG,K3LDG,K0CFA,K0LPM,K0MTM,K0TAM from ctsev where estatus='A' and CONCAT(cct,turno)='".$elccturno."'"; 	 
            //echo $_sql;
            
            
            
            $res_cct_alumno=mysql_query($_sql); 		 $rec_cct_alumno=mysql_fetch_array($res_cct_alumno,MYSQL_ASSOC);
            if ($_SESSION["vg_tipousuario"]!="Almacen"){
                $elidnivel=$rec_cct_alumno["idnivel"];
                $elnivel=$rec_cct_alumno["nivel"];
            }

            $elnivel=str_replace("Estatal","",$rec_cct_alumno["nivel"]);  $elnivel=str_replace("Federal","",$elnivel);  
            $elnivel=str_replace("Indigena","",$elnivel);  $elnivel=str_replace("General","",$elnivel);
            
            $_sql="select almacen,responsable from almacen_c where idalmacen=".$rec_cct_alumno["idalmarbo"]; //	echo $_sql; 
            $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC); ?>                    
            RECIBO DE LIBROS DE TEXTO POR ESCUELA DEL NIVEL <? echo strtoupper($elnivel); ?>
            <br><br>   <?php    
            //----------------------------------------------------------------------------------------------------------------------------------------------       ?>
            <table class="ftable-print-horizontal" cellpadding="5" cellspacing="0" width="100%" border=1 style="font-weight:bold">
                <tr><td width="10%">Folio</td><td  width="20%">LTG <? echo $rec_cct_alumno["id"]; ?></td><td width="14%">Almacen</td><td><? echo   $rec_almacen["almacen"]; ?></td></tr>
                <tr><td>CCT</td><td><? echo $elccturno2; ?></td><td>Nombre</td><td><? echo $rec_cct_alumno["nom_ct"]; ?></td></tr>
                <tr><td>Sector</td><td><? echo $rec_cct_alumno["sector"]; ?></td><td>Zona</td><td><? echo $rec_cct_alumno["zonaescola"]; ?></td></tr>
                <tr><td>Localidad</td><td><? echo $rec_cct_alumno["nombreloc"]; ?></td><td>Municipio</td><td><? echo $rec_cct_alumno["nombrempio"]; ?></td></tr>
            </table><br><br>   
            <section><?php  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  LIBROS PARA ALUMNOS DE LOS RESPECTIVOS GRADOS ESCOLARES  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
                $paq_libr_esc=1;
                for ($i=1; $i <= 3; $i++) { 
                    switch($i){ case 1: $tit="Primer"; break;   case 2: $tit="Segundo"; break;      case 3: $tit="Tercer"; break; }

                    //   ================================ CLAVES PARA ALUMNOS DE TODOS LOS NIVELES      claves con (destino=A)     ================================
                                                            //if ($elidnivel<69 && $elidnivel>59){ $bngrd=" REGEXP "; $bndest=" REGEXP 'A|M'"; }else{ $bngrd="="; $bndest="='A'";}
                                                            //$_sql="select idmaterial as clave,titulo,idgrado,primcajas,idnivel,destino FROM l_libros WHERE idgrado=".$bngrd.$i." and destino".$bndest." and ciclo='".$_SESSION["vg_cicloescolar"]."' and idnivel=".substr($elidnivel,0,1)." and idtipomat!=10 and estatus='A' and visible!='N' order by idnivel"; 	    echo $_sql; 
                    $_sql="select idmaterial as clave,titulo,idgrado,primcajas,idnivel,destino FROM l_libros WHERE idgrado=".$i." and titulo REGEXP 'Inglés|Ingles' and destino='A' and ciclo='".$_SESSION["vg_cicloescolar"]."' and idnivel=".substr($elidnivel,0,1)." and idtipomat!=10 and estatus='A' and visible!='N' order by idnivel"; 	//    echo $_sql; 
                    $res_libros=mysql_query($_sql); 		$r=0;    
                    if (mysql_num_rows($res_libros)>0){  
                        //   Titulo de cada Grado ------> ?><div style='font-size:18px; font-weight:bold; margin:10px'><? echo $tit; ?> Grado</div> 

                        <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                            <tr> 
                                <td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td><? 
                                if ($paq_libr_esc>0){ $numcolsespacio=6; ?><td style="text-align:center; font-weight:bold">1 Ejemplar<br>por Escuela</td><td style="text-align:center; font-weight:bold">Alumnos</td><td style="text-align:center; font-weight:bold">Total a recibir</td><? }else{ $numcolsespacio=4; ?>    <td style="text-align:center; font-weight:bold">Alumnos</td><?}?>
                                <td style="text-align:center; font-weight:bold">Ejem_caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td>
                            </tr><?
                            $tot_cajas=0;   $tot_sueltos=0; 
                            while ($r<mysql_num_rows($res_libros)){ 		
                                $reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                                if (intval($reclibros["primcajas"])>0){
                                    $alu=$rec_cct_alumno["alu".$i];     $ej=$reclibros["primcajas"];    $cajas=floor(($alu+$paq_libr_esc)/$ej);      $sueltos=($alu+$paq_libr_esc)-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;
                                } ?>
                                <tr>
                                    <td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><?
                                    if (intval($reclibros["primcajas"])==0){  
                                        if ($paq_libr_esc>0){ ?><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td> <? }else{ ?> <td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td> <? }
                                    }else{ 
                                        if ($paq_libr_esc>0){ ?><td style="text-align:right;"><? echo $paq_libr_esc; ?></td><td style="text-align:right;"><? echo $alu; ?></td><td style="text-align:right;"><? echo $alu+$paq_libr_esc; ?></td><? }else{ ?><td style="text-align:right;"><? echo $alu; ?></td> <?} ?>
                                        <td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td><?
                                    } ?>
                                </tr><?
                                $r++;        
                            }?>                            
                            <tr><td colspan="<? echo $numcolsespacio; ?>" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                        </table><br><br>                       <?      
                    }  
                }   // fin del for de GRADOS    ?>
            </section>


            <? //if ($_GET["vecvesmaest"]=="S"){ ?>    
                <div style='font-size:16px; font-weight:bold; margin:10px'> Claves para el Maestro </div>    
                <section><?php  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  LIBROS PARA MAESTROS DE LOS RESPECTIVOS GRADOS ESCOLARES  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
                    $paq_libr_esc=1;
                    for ($i=1; $i <= 3; $i++) { 
                        switch($i){ case 1: $tit="Primer"; break;   case 2: $tit="Segundo"; break;      case 3: $tit="Tercer"; break; }

                        //   ================================ CLAVES PARA MAESTROS DE TODOS LOS NIVELES      claves con (destino=A)     ================================
                                                                //if ($elidnivel<69 && $elidnivel>59){ $bngrd=" REGEXP "; $bndest=" REGEXP 'A|M'"; }else{ $bngrd="="; $bndest="='A'";}
                                                                //$_sql="select idmaterial as clave,titulo,idgrado,primcajas,idnivel,destino FROM l_libros WHERE idgrado=".$bngrd.$i." and destino".$bndest." and ciclo='".$_SESSION["vg_cicloescolar"]."' and idnivel=".substr($elidnivel,0,1)." and idtipomat!=10 and estatus='A' and visible!='N' order by idnivel"; 	    echo $_sql; 
                        $_sql="select idmaterial as clave,titulo,idgrado,primcajas,idnivel,destino FROM l_libros WHERE idgrado=".$i." and titulo not REGEXP 'Inglés|Ingles' and destino='A' and ciclo='".$_SESSION["vg_cicloescolar"]."' and idnivel=".substr($elidnivel,0,1)." and idtipomat!=10 and estatus='A' and visible!='N' order by idnivel"; 	//    echo $_sql; 
                        $res_libros=mysql_query($_sql); 		$r=0;   $paq_libr_esc=0; 
                        if (mysql_num_rows($res_libros)>0){  
                            //   Titulo de cada Grado ------> ?><div style='font-size:18px; font-weight:bold; margin:10px'><? echo $tit; ?> Grado</div> 

                            <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                                <tr> 
                                    <td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td><? 
                                    $numcolsespacio=4; ?>    <td style="text-align:center; font-weight:bold">Docentes</td>
                                    <td style="text-align:center; font-weight:bold">Ejem_caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td>
                                </tr><?
                                $tot_cajas=0;   $tot_sueltos=0; 
                                while ($r<mysql_num_rows($res_libros)){ 		
                                    $reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                                    if (intval($reclibros["primcajas"])>0){
                                        $doc=$rec_cct_alumno["d".$i];     $ej=$reclibros["primcajas"];    $cajas=floor(($doc+$paq_libr_esc)/$ej);      $sueltos=($doc+$paq_libr_esc)-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;
                                    } ?>
                                    <tr>
                                        <td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><?
                                        if (intval($reclibros["primcajas"])==0){  
                                            if ($paq_libr_esc>0){ ?><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td> <? }else{ ?> <td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td> <? }
                                        }else{ 
                                            if ($paq_libr_esc>0){ ?><td style="text-align:right;"><? echo $paq_libr_esc; ?></td><td style="text-align:right;"><? echo $doc; ?></td><td style="text-align:right;"><? echo $doc+$paq_libr_esc; ?></td><? }else{ ?><td style="text-align:right;"><? echo $doc; ?></td> <?} ?>
                                            <td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td><?
                                        } ?>
                                    </tr><?
                                    $r++;        
                                }?>                            
                                <tr><td colspan="<? echo $numcolsespacio; ?>" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                            </table><br><br>                       <?      
                        }  
                    }   // fin del for de GRADOS    ?>
                </section>
            <? //} ?>
            <br><br><br><p class='SaltoDePagina' style="text-align:left"><small><? echo $liga; ?></small></p><br><br><br><br><br>
            <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>Este recibo es un documento oficial y los libros que recibo son propiedad de la Nación, por lo que me comprometo a vigilar el buen uso del material y verificar la entrega a los beneficiarios</td></tr></table><br><br><?
            //   firmas
                    $firma_entrega="DEL RESPONSABLE DE ALMACÉN";     $firma_recibe="DEL DIRECTOR";     
                    $sello_entrega="ALMACÉN";         $sello_recibe="PLANTEL";
                    $entrego=$rec_almacen["responsable"]; ?>
                <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table><br><br><br>
            <!--      Aviso     -->
                <div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div><br><br><br>
            <!--      QR     -->
                <table cellpadding="10" cellspacing="0" width="100%" border=1>
                    <tr><td width="15%" align="center"><? echo GenerarQR("LTG" . number_format( $rec_cct_alumno["id"],0), "qr_plantel_".$elnivel."/"); ?> </td><td style="font-size:18px; font-weight:bold;  vertical-align:top">Observaciones</td></tr>
                    <tr><td>NOTA<br>IMPORTANTE</td><td>
                        <ol>
                            <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                            <li style="margin:10px">No se le har&aacute; entrega de material alguno, sí, el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                            <li style="margin:10px">En caso de decremento de matr&iacute;cula, me comprometo a devolver los paquetes de los libros sobrantes.</li>
                            <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                    </td></tr>
                <table><br><br><br>            
            <br><br><br><p style="text-align:left"><small><? echo $liga; ?></small></p>
		</div><?php
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