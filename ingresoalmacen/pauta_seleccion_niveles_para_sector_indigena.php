 <?php
session_start(); 	
require_once('../conecta2023.php');
require_once('../inc/funciones_libros_indigena.php'); 
conectalo("almacen");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selecci�n</title>
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
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit=""; 		 
        $LGback="../_panel.php"; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
        if (isset($_GET["n"])){$_SESSION["nopermiso"]=$_GET["n"];}else{ $_SESSION["nopermiso"]="";}
		echo "<br><br><br>";
        // Esto es exclusivo para nivel preescolar 
        // if ($_SESSION["vg_idalmacen"]==2){  // Xalapa unico que ve todo preescolar 
        //     flista_niveles_x_almacen("almarbo","4,6,7",$autollamada); 
        // }else{
        //     // flista_niveles_x_almacen("almarbo","30,31,32,4,6,7",$autollamada);  // resto de almacenes solo ve CAM en preescolar
        // }  
        // -------------------------------------------   y esto para el resto de niveles
       // echo "<br>";
        //if ($_SESSION["vg_idalmacen"]==2 || $_SESSION["vg_idalmacen"]==15 || $_SESSION["vg_idalmacen"]==18){
            flista_niveles_x_almacen("almarbo","3,40,41,44,46,47,6,7",$autollamada); 
        //}else{
          //  flista_niveles_x_almacen("almarbo","3,6",$autollamada); 
        //}    
	}else{  
        
        $arrnivel=explode("|",$_GET["arr_nivel"]);
        $_SESSION["elidnivel"]=$arrnivel[0]; $_SESSION["elnivel"]=$arrnivel[1];         
        if ($_GET["sel"]=="Sectores"){ // Aqui solo ingresa usuario Almacen
            $liga1="Recibo|../ingresosector/recibo_libros_sector_indigena.php?||#F9FFE4|7";      // titulo del boton|liga|titulo de la columna   
            $liga2="Zonas|../ingresoalmacen/pauta_seleccion_niveles_para_sector_indigena.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
            $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Sectores de ".$_SESSION["elnivel"]."</h3>"; 		 
            $LGback=$autollamada; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
            // -----------------------------------------------------------------------------------------------------------------------------------------------------
            flista_SECTORES_x_almacen_nivel($_SESSION["elidnivel"],"","a.idalmarbo=".$_SESSION["vg_idalmacen"],$liga1,$liga2);
        }else{ // Mostrar� lista de zonas
            $_SESSION["cct_sector"]=$_GET["cct_sector"];
            if (isset($_GET["cct_sector"])){ // zonas federales
                $vl_back=$autollamada."arr_nivel=".$_SESSION["elidnivel"]."|".$_SESSION["elnivel"]."&sel=Sectores";
            }else{ // zonas estatales
                $vl_back=$autollamada;
            }

            if ($_SESSION["elidnivel"]<59 || $_SESSION["elidnivel"]>69){
                $liga1="Recibo de zona|../ingresosupervisor/recibo_libros_zona_indigena.php?sel=reciboalumnos&||#F9FFE4"; // titulo del boton|liga|titulo de la columna|color|nivelesrestringidos
                if ($_SESSION["elidnivel"]<59){ // solo primarias
                  //  $liga2="Recibo 2 titulos|../ingresosupervisor/recibo_libros_zona.php?sel=reciboalum_ex1&||#F9FFE4"; // titulo del boton|liga|titulo de la columna|color|nivelesrestringidos
                }    
            }else{ // para secundarias no se muestra recibo de zona
                $liga1="";
            }     
            // if ($_SESSION["vg_tipousuario"]=="Almacen" && ($_SESSION["elidnivel"]==34 || $_SESSION["elidnivel"]==35 || $_SESSION["elidnivel"]==36 || $_SESSION["elidnivel"]==44 || $_SESSION["elidnivel"]==46 || $_SESSION["elidnivel"]==64 || $_SESSION["elidnivel"]==66)){
            //     $liga3="";
            //     $liga4="";
            // }else{
            //     if ($_SESSION["vg_tipousuario"]!="Supervisor"){$ban="3,6,7";}else{$ban="";}
            //     $liga3="Recibo de plantel escolar|../ingresosupervisor/recibo_libros_zona.php?sel=recibodocentes&||#F9FFE4|".$ban;      // titulo del boton|liga|titulo de la columna|color|nivelesrestringidos
            //     $liga4="Acta zona|../ingresosupervisor/recibo_libros_zona.php?sel=acta&||#F9FFE4|".$ban;      // titulo del boton|liga|titulo de la columna|color|nivelesrestringidos
            // }
            // $liga5="Escuelas|../ingresosupervisor/recibo_libros_zona.php?sel=escuela&||#F9FFE4";      // titulo del boton|liga|titulo de la columna|color|nivelesrestringidos

            $liga2="Escuelas|../ingresosupervisor/recibo_libros_zona_indigena.php?sel=escuela&||#F9FFE4";      // titulo del boton|liga|titulo de la columna|color|nivelesrestringidos

            $cond_particular.="a.idalmarbo=".$_SESSION["vg_idalmacen"];
            if (isset($_GET["cct_sector"])){
                $cond_particular.=" and a.cct_sector='".$_SESSION["cct_sector"]."'";
            }else{
                $cond_particular.="";
            }
            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
            $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='ftext-green'>Lista de Zonas de ".$_SESSION["elnivel"]." del sector ".$_SESSION["cct_sector"]."</h3>"; 		 
            $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
            // -----------------------------------------------------------------------------------------------------------------------------------------------------
            flista_ZONAS_x_almacen_nivel($_SESSION["elidnivel"],$cond_particular,$liga1,$liga2,$liga3,$liga4,$liga5);
        }
    }
    
}
?>
</body>
</html>