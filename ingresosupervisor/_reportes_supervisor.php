<? session_start(); 	 $autollamada=basename(__FILE__). "?"; ?>
<html><head>
<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Libros Veracruz - Reporte</title><link rel="shortcut icon" href="../images/libro_titulo3.png">
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  
<SCRIPT TYPE="text/javascript" src="../js/funcfme.js"></SCRIPT>
<script type="text/javascript" src="../inc/fancy217/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />


<style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
        p.SaltoDePagina { PAGE-BREAK-AFTER: always }  
</style>
<style type="text/css">	
		.ftable-horizontal{ border-color:#FBFBFB; border-right:none }
  		.ftable-horizontal td,th { border-left: none; border-right: none; }
</style>
<SCRIPT TYPE="text/javascript">
		function doPrint(){
			document.all.item("regresar").style.visibility='hidden' 
                document.all.item("Imprimir").style.visibility='hidden' 
                document.all.item("ubica").style.visibility='hidden' 
                window.print()
                document.all.item("regresar").style.visibility='visible'
                document.all.item("Imprimir").style.visibility='visible'
                document.all.item("ubica").style.visibility='visible'
		}
</SCRIPT>
<body style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center"><?

require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');		conectalo("zona");    


switch($_GET["num_recibo"]){
	case 2: 		$linkrep="distribucion/_recibo2.php"; break;
	case 48739388:	$linkrep="distribucion/_recibo3.php"; break;
	case 49429933:	$linkrep="distribucion/_recibo4.php"; break;
}
switch($_SESSION["vg_tipousuario"]){
	case "Almacen":
		$vl_back="../ingresoalmacen/distribucion/recibos_zonas.php?recibozona=".$_GET["num_recibo"]."&n=".$_SESSION["nopermiso"];		
		break;
	case "Supervisor":
		$vl_back="../_panel.php";		
		break;	
}




if ((!isset($logeado) && !isset($TxtUsuario))){
	fmessage("Acceso No Permitido",1500,2,$vl_back);
}else{ 
	if ($_SESSION["vg_idnivelunicosupervisor"]<10 && !isset($_GET["seleccionado"])){ 	
		// ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
		$TItulo="<h3 class='fbold ftext-red fcenter'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
		$LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
		// -----------------------------------------------------------------------------------------------------------------------------------------------------
		flista_niveles($autollamada."num_recibo=".$_GET["num_recibo"]."&seleccionado"); 
	}else{ 
		if ($_SESSION["vg_tipousuario"]=="Almacen"){
			$arrnivel=explode("|",$_GET["arr_nivel"]);
			$elidnivel=$arrnivel[0];
			$elnivel=$arrnivel[1];
			$bancond="&arr_nivel=".$_GET["arr_nivel"];			
			$lazona=$_GET["zona"];
		}else{	
			if ($_SESSION["vg_idnivelunicosupervisor"]<10){
					$arrnivel=explode("|",$_GET["arr_nivel"]);
					$elidnivel=$arrnivel[0];
					$elnivel=$arrnivel[1];
					$bancond="&arr_nivel=".$_GET["arr_nivel"];
			}else{
					$elidnivel=$_SESSION["vg_idnivelunicosupervisor"];
					$elnivel=$_SESSION["vg_nivelunicosupervisor"];
					$bancond="&arr_nivel=".$_SESSION["vg_idnivelunicosupervisor"]."|".$_SESSION["vg_nivelunicosupervisor"];
			}		
			$lazona=$_SESSION["vg_cct_zona"];
		} ?>
		<br><br>
		<img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
		<div class="frow fright ftransparent ftop fmargin"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="ubica" href="../../dir_almacenes.php" target="_blank" class="fpadding-medium fblack fleft fround fbutton"> Directorio de almacenes</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
		<div style='margin-left:50px; margin-right:50px; font-size:14px; font-weight:bold'>
					SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
					SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
					COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
					PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
					CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br>


					<? 
						include($linkrep); 
						
					?>


					<!--      Firmas     -->
					<table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>_____________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br>	                                                                                  ___________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA DEL ALMACÉN</small> <br>                                                            </td>	                                                            <td style="vertical-align:middle;" >SELLO<br>ALMACÉN</td>                                                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>_____________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA DEL SUPERVISOR ESCOLAR</small><br>                                                            </td>                                                            <td style="vertical-align:middle;">SELLO<br>SUPERVISIÓN</td>                                                        </tr>
                    </table>
                    <br><br>
					<div class="fcenter"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
					<br>

		</div><?php
	}
}  ?></div></body></html>
