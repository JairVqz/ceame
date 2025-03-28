<?php
session_start(); 	
require_once('../../conecta2023.php');
require_once('../../inc/funciones_libros.php'); 
conectalo("almacen");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin tí­tulo</title>
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" href="../../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../../css/frcico.css" type="text/css" media="screen" />
<style type="text/css" media="print">
        @page 
        {
            size: landscape;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
       
        H1.SaltoDePagina { PAGE-BREAK-AFTER: always }  
    </style>
<script language="javascript">


function doPrint(){
                document.all.item("regresar").style.visibility='hidden' 
                document.all.item("Imprimir").style.visibility='hidden' 

                window.print()
                document.all.item("regresar").style.visibility='visible'
                document.all.item("Imprimir").style.visibility='visible'
            }
</script>
</head>

<body class="fcenter"><?php
$arr=explode( "/", $_SERVER[ "PHP_SELF "]); $autollamada= $arr[count( $arr)-1]. "?"; 
if ((!isset($logeado) && !isset($TxtUsuario))){
	echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
}else{
    if (!isset($_GET["arr_nivel"])){ 	
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="Seleccione nivel"; 		 
        $LGback="../../_panel.php"; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
		echo "<br><br>"; flista_niveles($autollamada."ex=1","almadis"); 
	}else{       

        $arrnivel=explode("|",$_GET["arr_nivel"]);
        $elidnivel=$arrnivel[0]; $elnivel=$arrnivel[1]; 
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="Almacen ".$logeado;  $subtit="<h3 class='fbold ftext-red fpadding-tiny'>".$pmzonas." zonas de ".$elnivel." para la entrega de FICHERO Y CUADERNILLO</h3>";
        $LGback=$autollamada; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
                    $_sql="select t1.zonaescola,t1.cct_zona,count(cct) as escuelas,c.municipio,c.nommun,c.nomloc as localidad FROM ctsev t1,supervis_c c where t1.cct_zona=c.cuenta and t1.idalmadis='".$_SESSION["vg_idalmacen"]."' and t1.idnivel=".$elidnivel." and estatus!='B' group by t1.cct_zona order by t1.cct";
                    //echo  $_sql."<br>regs=".mysql_num_rows($res);
                    $res=mysql_query($_sql); 		$r=0; 
                    if (mysql_num_rows($res)>0){ ?> 
                        <br><br><div class="fix7 fshad"> 
                            <table class="ftable-all"> 
                                <tr><th>Zona</th><th>Clave</th><th>Escuelas</th><th>Municipio</th><th>Localidad</th><th></th></tr><? 
                                    while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC);   ?>
                                        <tr> 
                                            <td class="fright-align"><? echo $recset["zonaescola"]; ?></td> 
                                            <td><? echo $recset["cct_zona"]; ?></td> 
                                            <td class="fright-align"><? echo $recset["escuelas"]; ?></td> 
                                            <td><? echo $recset["nommun"]; ?></td> 
                                            <td><? echo $recset["localidad"]; ?></td> 
                                            <td align="center"><small><a href="../../ingresosupervisor/distribucion/23_febrero_recibo_escuelas_ficherocuadernillo.php?arr_nivel=<?  echo $arrnivel[0]."|".$arrnivel[1]."&zona=".$recset['cct_zona'];  ?>" class="fbutton fpale-green">Ver escuelas</a></small></td>
                                        </tr> <? 
                                       	$r++; 
                                    } ?>		 
                                    <!-- <tr class="fdark-gray"><td colspan='3'>Total</td><td class='fright-align'><? // echo $tot; ?></td></tr>  -->
                            </table> 
                        </div><? 
                    }else{ fmessage("No hay registros",2500,2); }  
    }
}
?>
</body>
</html>