<? session_start(); 	 $autollamada=basename(__FILE__). "?"; require_once('../phpqrcode/qrlib.php');  ?>
<html><head>
<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Recibo</title>
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
<script type="text/javascript" languaje="javascript">
    var message = "";
    function rtclickcheck(keyp){ 
        if (navigator.appName == "Netscape" && keyp.which == 3){ 
            alert(message); return false; 
        }
        if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) { 
            alert(message); return false; 
        } 
    }document.onmousedown = rtclickcheck;
</script>
<body style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center; font-size:14px;"><?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros_indigena.php');		conectalo("zona");    
if ((!isset($logeado) && !isset($TxtUsuario))){ 	fmessage("Acceso No Permitido",1500,2,$vl_back);
}else{ 
        switch($_SESSION["vg_tipousuario"]){
            case "Almacen":
                $vl_back="../ingresoalmacen/pauta_seleccion_niveles_para_sector_indigena.php?cct_sector=".$_SESSION["cct_sector"]."&arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"]."&pmsectores=".$_GET["pmsectores"]."&pmzonas=".$_GET["pmzonas"]."&sel=Zonas";			
                $_SESSION["cct_zona"]=$_GET["cct_zona"];
                $_SESSION["nombre_zona"]=$_GET["nombre"];
                $_SESSION["folio"]=$_GET["folio"];

                $liga="http://www.librosgratuitosveracruz.org/ingresosupervisor/recibo_libros_zona_indigena.php?folio=".$_GET["folio"]."&cct_zona=".$_GET["cct_zona"]."&idnivel=".$_GET["idnivel"]."&nivel=".$_SESSION["elnivel"]; 
                break;
            case "Sector":
                $vl_back="../ingresosector/recibo_libros_sector_indigena.php?sel=selzona&arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"];
                $_SESSION["elidnivel"]=$_GET["idnivel"];
                $_SESSION["elnivel"]=$_GET["nivel"]; 
                $_SESSION["cct_zona"]=$_GET["cct_zona"]; 
                $liga="http://www.librosgratuitosveracruz.org/ingresosupervisor/recibo_libros_zona_indigena.php";	
                break;  
            case "Supervisor":
                $vl_back="../_panel.php";	
                if (!isset($_GET["arr_nivel"])){   // INGRESAN TODAS LAS ZONAS AUN LAS DE UN NIVEL !
                    // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                    $TItulo="<h3 class='fbold ftext-red fcenter'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
                    $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                    // -----------------------------------------------------------------------------------------------------------------------------------------------------
                    $liga1="Recibo de zona|".$autollamada."sel=reciboalumnos&||#F9FFE4|3,6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    // $liga2="Recibo 2 titulos|".$autollamada."sel=reciboalum_ex1&||#F9FFE4|3,6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    // $liga3="Recibo de plantel escolar|".$autollamada."sel=recibodocentes&||#F9FFE4|3,44,46,6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    // $liga4="Acta Zona|".$autollamada."sel=acta&||#F9FFE4|6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    $liga2="Escuela|".$autollamada."sel=escuela&||#F9FFE4|3,6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    flista_niveles_x_zona("3,6,7",$liga1,$liga2);  
                }else{
                    $vl_back=$autollamada;
                    switch ($_GET["sel"]){
                        case "reciboalumnos":
                        case "recibodocentes":
                        case "acta":
                        case "reciboalum_ex1":    
                            $arrnivel=explode("|",$_GET["arr_nivel"]); 
                            $_SESSION["elidnivel"]=$arrnivel[0];
                            $_SESSION["elnivel"]=$arrnivel[1];  
                            $_SESSION["cct_zona"]=$_SESSION["vg_cct_zona"];	
                            $liga="http://www.librosgratuitosveracruz.org/ingresosupervisor/recibo_libros_zona_indigena.php"; // no se usa para acta
                            break;
                        

                        case "escuela":   //lista de escuelas de la zona
                            $querecibo="";
                            $arrnivel=explode("|",$_GET["arr_nivel"]);
                            $_SESSION["elidnivel"]=$arrnivel[0]; $_SESSION["elnivel"]=$arrnivel[1];         
                            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                            $TItulo="<h3 class='fbold ftext-red fcenter'>".$_SESSION["logeado"]."</h3>"; $subtit="<h3 class='ftext-green fcenter'>Lista de Escuelas de ".$_SESSION["elnivel"]."</h3>"; 		 
                            $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                            // -----------------------------------------------------------------------------------------------------------------------------------------------------
                            $liga1="Recibo Escuela|../ingresoplantel/recibo_libros_plantel_indigena.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
                            
                            flista_Escuelas_x_zona_nivel($_SESSION["vg_cct_zona"],$_SESSION["elidnivel"],"",$liga1,$liga2);
                            echo "<hr><br>";
                            break;
                    }
                }
                break;	
        }
        $_SESSION["elnivel"]=str_replace("Estatal","",$_SESSION["elnivel"]);    str_replace("Federal","",$_SESSION["elnivel"]);     $_SESSION["elnivel"]=str_replace("Indigena","",$_SESSION["elnivel"]);
        // Para los reportes se requieren estos tres datos : $_SESSION["elidnivel"], $_SESSION["elnivel"] y $_SESSION["cct_zona"]
        switch($_GET["sel"]){
            case "reciboalumnos": include("recibo_zona_alumnos_indigena.php"); break;
            case "recibodocentes": include("recibo_zona_docentes.php"); break;
            case "acta": include("recibo_zona_acta.php"); break;
            case "reciboalum_ex1": include("recibo_zona_alum_ex1.php"); break;
            case "escuela": // aqui ingresa el almacen y sector, pero no el supervisor
                if ($_SESSION["vg_tipousuario"]!="Supervisor"){
                    if ($_SESSION["vg_tipousuario"]=="Almacen"){
                        $condlocal="idalmarbo=".$_SESSION["vg_idalmacen"];
                        $vl_back="../ingresoalmacen/pauta_seleccion_niveles_para_sector_indigena.php?cct_sector=".$_SESSION["cct_sector"]."&idnivel=".$_SESSION["elidnivel"]."&nivel=".$_SESSION["elnivel"]."&arr_nivel=".$_SESSION["elidnivel"]."|".$_SESSION["elnivel"]."&nombre=".$_SESSION["nombre_zona"]."&folio=".$_SESSION["folio"];
                    }else{
                        $condlocal="";
                    }
                    // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                    if (isset($_SESSION["cct_sector"])){ $sector="&emsp;Sector ".$_SESSION["cct_sector"];}else{ $sector="";} 
                    $TItulo="<h3 class='fbold ftext-red fcenter'>".$_SESSION["logeado"]."</h3>"; $subtit="<h3 class='ftext-green fcenter'>Lista de Escuelas de ".$_SESSION["elnivel"].$sector."&emsp;Zona ".$_GET["cct_zona"]."</h3>"; 		 
                    $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                    // -----------------------------------------------------------------------------------------------------------------------------------------------------
                    
                    $liga1="Recibo Escuela|../ingresoplantel/recibo_libros_plantel_indigena.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
                    flista_Escuelas_x_zona_nivel($_GET["cct_zona"],$_SESSION["elidnivel"],$condlocal,$liga1,$liga2);
                }
                break;
        }
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
}

