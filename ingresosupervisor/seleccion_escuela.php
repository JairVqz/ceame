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
    switch($_GET["proceso"]){
        case "pauta":    
            switch($_SESSION["vg_tipousuario"]){case "Almacen":  $lazona=$_GET["cct_zona"]; break;   case "Supervisor": $lazona=$_SESSION["vg_cct_zona"]; break; }
                // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                $TItulo="<h3 class='fbold ftext-red'> ".$lazona."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Escuelas</h3>"; 		 
                $LGback="../ingresoalmacen/pauta_seleccion_niveles_para_sector_zona.php?arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"]."&pmsectores=".$_GET["pmsectores"]."&pmzonas=".$_GET["pmzonas"]."&sel=Zonas"; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                // ----------------------------------------------------------------------------------------------------------------------------------------------------- ?>
            <br><br><br><?    

            $columna1="Recibo|../ingresoplantel/recibo_pauta_libros_plantel.php?||#CDFFB9";	//Boton|liga|Columna|color
            flista_escuelas_zona_nivel($lazona,$elidnivel,$condicion_extra,$columna1,$columna2,$columna3,$titescuelazona);
            break;
    }
}
?>
</body>
</html>