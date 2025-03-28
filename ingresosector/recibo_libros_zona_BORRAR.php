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
<body style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center; font-size:14px;"><?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');		conectalo("zona");    
if ((!isset($logeado) && !isset($TxtUsuario))){ 	fmessage("Acceso No Permitido",1500,2,$vl_back);
}else{ 
        switch($_SESSION["vg_tipousuario"]){
            case "Almacen":
                $vl_back="../ingresoalmacen/pauta_seleccion_niveles_para_sector.php?arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"]."&pmsectores=".$_GET["pmsectores"]."&pmzonas=".$_GET["pmzonas"]."&sel=Zonas";			
                $elidnivel=$_GET["idnivel"];
                $elnivel=$_GET["nivel"];     
                $lazona=$_GET["cct_zona"];
                $liga="http://www.librosgratuitosveracruz.org/ingresosupervisor/recibo_libros_zona.php?folio=".$_GET["folio"]."&cct_zona=".$_GET["cct_zona"]."&idnivel=".$_GET["idnivel"]."&nivel=".$elnivel; 
                break;
            case "Sector":
                $vl_back="../ingresosector/recibo_libros_sector.php?sel=selzona&arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"];
                $elidnivel=$_GET["idnivel"];
                $elnivel=$_GET["nivel"]; 
                $lazona=$_GET["cct_zona"]; 
                $liga="http://www.librosgratuitosveracruz.org/ingresosupervisor/recibo_libros_zona.php";	
                break;  
            case "Supervisor":
                $vl_back="../_panel.php";	
                if (!isset($_GET["arr_nivel"])){   // INGRESAN TODAS LAS ZONAS AUN LAS DE UN NIVEL !
                    // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                    $TItulo="<h3 class='fbold ftext-red fcenter'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
                    $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                    // -----------------------------------------------------------------------------------------------------------------------------------------------------
                    $liga1="Recibo de zona|".$autollamada."sel=reciboalumnos&||#F9FFE4|";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    $liga2="Recibo de plantel escolar|".$autollamada."sel=recibodocentes&||#F9FFE4|3,4,6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    $liga3="Acta Zona|".$autollamada."sel=acta&||#F9FFE4|3,6,7";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    $liga4="Escuelas|".$autollamada."sel=escuela&||#F9FFE4|";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    flista_niveles_x_zona("",$liga1,$liga2,$liga3,$liga4);                   
                }else{
                    $vl_back=$autollamada;
                    switch ($_GET["sel"]){
                        case "reciboalumnos":
                        case "recibodocentes":
                        case "acta":
                            $arrnivel=explode("|",$_GET["arr_nivel"]); 
                            $elidnivel=$arrnivel[0];
                            $elnivel=$arrnivel[1];  
                            $lazona=$_SESSION["vg_cct_zona"];	
                            $liga="http://www.librosgratuitosveracruz.org/ingresosupervisor/recibo_libros_zona.php"; // no se usa para acta
                            break;
                        case "escuela":   //lista de escuelas de la zona
                            $querecibo="";
                            $arrnivel=explode("|",$_GET["arr_nivel"]);
                            $elidnivel=$arrnivel[0]; $elnivel=$arrnivel[1];         
                            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                            $TItulo="<h3 class='fbold ftext-red fcenter'>".$_SESSION["logeado"]."</h3>"; $subtit="<h3 class='ftext-green fcenter'>Lista de Escuelas de ".$elnivel."</h3>"; 		 
                            $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                            // -----------------------------------------------------------------------------------------------------------------------------------------------------
                            $liga1="Recibo Escuela|../ingresoplantel/recibo_libros_plantel.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
                            flista_Escuelas_x_zona_nivel($_SESSION["vg_cct_zona"],$elidnivel,"",$liga1,$liga2);
                            break;
                    }
                }
                break;	
        }
        $elnivel=str_replace("Estatal","",$elnivel);    str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);
        // Para los reportes se requieren estos tres datos : $elidnivel, $elnivel y $lazona
        switch($_GET["sel"]){
            case "reciboalumnos": include("recibo_zona_alumnos91.php"); break;
            case "recibodocentes": include("recibo_zona_docentes.php"); break;
            case "acta": include("recibo_zona_acta.php"); break;
            case "escuela":
                $liga1="Recibo Escuela|../ingresoplantel/recibo_libros_plantel.php?||#F9FFE4";      // titulo del boton|liga|titulo de la columna
                flista_Escuelas_x_zona_nivel($_GET["cct_zona"],$elidnivel,"",$liga1,$liga2);
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
}?>