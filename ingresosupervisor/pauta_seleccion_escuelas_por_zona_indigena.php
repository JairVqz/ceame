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
<title></title>
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />
</head>

<body class="fcenter"><?php
$arr=explode( "/", $_SERVER[ "PHP_SELF "]); $autollamada= $arr[count( $arr)-1]. "?"; 
if ((!isset($logeado) && !isset($TxtUsuario))){
	echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
}else{
    switch($_SESSION["vg_tipousuario"]){
        case "Almacen":
            $vl_back="../ingresoalmacen/pauta_seleccion_niveles_para_sector_indigena.php?arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"]."&pmsectores=".$_GET["pmsectores"]."&pmzonas=".$_GET["pmzonas"]."&sel=Zonas";
            $clavezona=$_GET["cct_zona"];
            break;
        case "Sector":    
            $vl_back="../ingresosector/recibo_libros_sector_indigena.php?sel=selzona&arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"];
            $clavezona=$_GET["cct_zona"];
            break;
        case "Supervisor":
            $clavezona=$_SESSION["vg_cct_zona"];
            break;    
    }   

        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Escuelas de la zona ".$clavezona." de ".$_GET["nivel"]."</h3>"; 		 
        $LGback=$vl_back;		$fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
        echo "<br><br><br><br>";
        if($_SESSION["vg_tipousuario"]!="Plantel"){$el_cct_zona=$_GET["cct_zona"];}else{$el_cct_zona=$_SESSION["vg_cct_zona"];}
        $liga1="Recibo|../ingresoplantel/recibo_libros_plantel.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
        if($_SESSION["vg_tipousuario"]=="Almacen"){
            flista_Escuelas_x_zona_nivel($el_cct_zona,$_GET["idnivel"],"",$liga1);
        }else{
            flista_Escuelas_x_zona_nivel($el_cct_zona,$_GET["idnivel"],"");
        }
}
?>
</body>
</html>