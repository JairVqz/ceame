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
    if (!isset($_GET["arr_nivel"])){   //  MOSTRARA LISTA DE NIVELES SOLO PARA ALMECEN 	
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit=""; 		 
        $LGback="../_panel.php"; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
        if (isset($_GET["n"])){$_SESSION["nopermiso"]=$_GET["n"];}else{ $_SESSION["nopermiso"]="";}
		echo "<br><br><br>";
        if($_SESSION["vg_idalmacen"]==2 && $_SESSION["vg_tipousuario"]=="Almacen"){ // Xalapa
               flista_niveles_x_almacen("almarec","",$autollamada);    // Usa almarec // Temporalmente    // despues usa almarbo
        }else{
               flista_niveles_x_almacen("almarbo","3",$autollamada);   // Siempre usan almarbo
        }

	}else{  //  MOSTRARA LISTA DE SECTORES (solo para almacen) O ZONAS (para almacen y sectores)
        $arrnivel=explode("|",$_GET["arr_nivel"]);
        $_SESSION["elidnivel"]=$arrnivel[0]; $_SESSION["elnivel"]=$arrnivel[1];         
        if ($_GET["sel"]=="Sectores"){ // MOSTRARA LISTA DE SECTORES SOLO PARA ALMACEN 
            if ($_SESSION["elidnivel"]==31 || $_SESSION["elidnivel"]==32){
                $liga1="Recibo de sector|../ingresosector/recibo_libros_sector.php?||#F9FFE4|4,7";      // titulo del boton|liga|titulo de la columna   
            }else{
                $liga1="";
            }
            $liga2="Zonas|../ingresoalmacen/pauta_seleccion_niveles_para_sector.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
            $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Sectores de ".$_SESSION["elnivel"]."</h3>"; 		 
            $LGback=$autollamada; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
            // -----------------------------------------------------------------------------------------------------------------------------------------------------
            if($_SESSION["vg_idalmacen"]==2 && $_SESSION["vg_tipousuario"]=="Almacen" && $_SESSION["elidnivel"]<40){ // Xalapa y solo nivel PREESCOLAR
                flista_SECTORES_x_almacen_nivel($_SESSION["elidnivel"],"","a.idalmarec=".$_SESSION["vg_idalmacen"],$liga1,$liga2);    // Usa almarec // Temporalmente    // despues usa almarbo
            }else{
                flista_SECTORES_x_almacen_nivel($_SESSION["elidnivel"],"","a.idalmarbo=".$_SESSION["vg_idalmacen"],$liga1,$liga2);   // Siempre usan almarbo
            }
        }else{ // MOSTRARA LISTA DE ZONAS PARA ALMACEN Y SECTOR
            $_SESSION["cct_sector"]=$_GET["cct_sector"];
            if (isset($_GET["cct_sector"])){ 
                $vl_back=$autollamada."arr_nivel=".$_SESSION["elidnivel"]."|".$_SESSION["elnivel"]."&sel=Sectores";
                $subtit="<h3 class='ftext-green'>Lista de Zonas de ".$_SESSION["elnivel"]." del sector ".$_SESSION["cct_sector"]."</h3>"; 		 
            }else{ 
                $vl_back=$autollamada;
                $subtit="<h3 class='ftext-green'>Lista de Zonas de ".$_SESSION["elnivel"]."</h3>"; 		 
            }


            // Cualquier liga se conforma del siguiente arreglo :       titulo del boton|liga|titulo de la columna|color|nivelesrestringidos
            if ($_SESSION["elidnivel"]>59 && $_SESSION["elidnivel"]<69){ // SECUNDARIAS NO DEBE VER EL RECIBO DE ZONA
                $liga1=""; 
            }else{
                $liga1="Recibo de zona|../ingresosupervisor/recibo_libros_zona.php?sel=reciboalumnos&||#F9FFE4"; 
            }    
            $liga2="Escuelas|../ingresosupervisor/recibo_libros_zona.php?sel=escuela&||#F9FFE4";      

            // se uso en ciclo 2023-2024 
            // SUPERVISOR:      $liga="Recibo 2 titulos|../ingresosupervisor/recibo_libros_zona.php?sel=reciboalum_ex1&||#F9FFE4"; 
            // SUPERVISOR:      $liga="Recibo de plantel escolar|../ingresosupervisor/recibo_libros_zona.php?sel=recibodocentes&||#F9FFE4|".$ban;      
            // SUPERVISOR:      $liga="Acta zona|../ingresosupervisor/recibo_libros_zona.php?sel=acta&||#F9FFE4|".$ban;     
            
            if($_SESSION["vg_idalmacen"]==2 && $_SESSION["vg_tipousuario"]=="Almacen" && $_SESSION["elidnivel"]<40){ // Xalapa y solo nivel PREESCOLAR
                $cond_particular.="a.idalmarec=".$_SESSION["vg_idalmacen"];     // Usa almarec // Temporalmente    // despues usa almarbo
            }else{
                $cond_particular.="a.idalmarbo=".$_SESSION["vg_idalmacen"];     // Siempre usan almarbo
            }
            if (isset($_GET["cct_sector"])){
                $cond_particular.=" and a.cct_sector='".$cct_sector."'";
            }else{
                $cond_particular.="";
            }
            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
            $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit=$subtit; 		 
            $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
            // -----------------------------------------------------------------------------------------------------------------------------------------------------
            flista_ZONAS_x_almacen_nivel($_SESSION["elidnivel"],$cond_particular,$liga1,$liga2);
        }
    }
}
// Desarrollado por : L.I. Fernando Rodríguez Colorado 	wwww.sistemas-rc.com
?>
</body>
</html>