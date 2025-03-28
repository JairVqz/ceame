<?php
session_start(); 	
require_once('../conecta2023.php');
require_once('../inc/funciones_libros.php'); 
conectalo("almacen");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selección</title>
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />
</head>

<body class="fcenter"><?php
$arr=explode( "/", $_SERVER[ "PHP_SELF "]); $autollamada= $arr[count( $arr)-1]. "?"; 
if ((!isset($logeado) && !isset($TxtUsuario))){
	echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
}else{
    if (!isset($_GET["arr_nivel"])){ 	
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="Seleccione nivel"; 		 
        $LGback="../_panel.php"; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
        if (isset($_GET["n"])){$_SESSION["nopermiso"]=$_GET["n"];}else{ $_SESSION["nopermiso"]="";}
		echo "<br><br>";
        if ($_SESSION["vg_idalmacen"]==2){  flista_niveles($autollamada,"almarec","4|6|7"); }  // Xalapa unico que ve Preescolar 
        echo "<br>";
        flista_niveles($autollamada,"almadis","3"); 
	}else{  
        $arrnivel=explode("|",$_GET["arr_nivel"]);
        $elidnivel=$arrnivel[0]; $elnivel=$arrnivel[1];         
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de ".$_GET["sel"]." de ".$elnivel."</h3>"; 		 
        $LGback=$autollamada; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
        if ($_GET["sel"]=="Sectores"){
            // LISTA DE SECTORES
            flista_SECTORES_x_almacen_nivel($elidnivel,"","Recibo|../ingresosector/recibo_pauta_libros_sector.php?||#F9FFE4");
        }else{
            // LISTA DE ZONAS
            $columna1="Recibo|../ingresosupervisor/recibo_pauta_libros_zona.php?||#F9FFE4";	//Boton|liga|Columna|color
            $columna2="Consultar|../ingresosupervisor/seleccion_escuela.php?proceso=pauta&||#F9FFE4";	//Boton|liga|Columna|color
            flista_ZONAS_x_almacen_nivel($elidnivel,"",$columna1,$columna2);
        }
    }
}
?>
</body>
</html>