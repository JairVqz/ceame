<? session_start(); 	 $autollamada=basename(__FILE__). "?";  ?>
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
<script type="text/javascript" languaje="javascript">var message = "";function rtclickcheck(keyp){ if (navigator.appName == "Netscape" && keyp.which == 3){ alert(message); return false; }if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) { alert(message); return false; } }document.onmousedown = rtclickcheck;</script>
<body style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center; font-size:14px;"><?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');		conectalo("zona");    
if ((!isset($logeado) && !isset($TxtUsuario))){ 	fmessage("Acceso No Permitido",1500,2,$vl_back);
}else{ 
        switch($_SESSION["vg_tipousuario"]){
            case "Sector":
                // $vl_back="../ingresosector/recibo_libros_sector.php?sel=selzona&arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"];
                // $elidnivel=$_GET["idnivel"];
                // $elnivel=$_GET["nivel"]; 
                // $lazona=$_GET["cct_zona"]; 
                // $liga="http://www.librosgratuitosveracruz.org/ingresosupervisor/recibo_libros_zona.php";	
                break;  
            case "Supervisor":
                $vl_back="../_panel.php";	
                if (!isset($_GET["arr_nivel"])){   // INGRESAN TODAS LAS ZONAS AUN LAS DE UN NIVEL !
                    // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                    $TItulo="<h3 class='fbold ftext-red fcenter'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
                    $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                    // -----------------------------------------------------------------------------------------------------------------------------------------------------
                    $liga1="Balance de matricula real|".$autollamada."sel=recibomatricula&||#F9FFE4|6";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    $liga4="Balance Escuelas|".$autollamada."sel=escuela&||#F9FFE4|7,6";	//Boton|liga|Columna|color|idnivel|nivelesrestringidos
                    flista_niveles_x_zona("6",$liga1,$liga2,$liga3,$liga4);                   
                }else{
                    if($_SESSION["vg_tipousuario"]=="Supervisor"){  $vl_back=$autollamada;  }
                    switch ($_GET["sel"]){
                        case "recibomatricula":
                            $arrnivel=explode("|",$_GET["arr_nivel"]); 
                            $elidnivel=$arrnivel[0];
                            $elnivel=$arrnivel[1];  
                            $lazona=$_SESSION["vg_cct_zona"];	
                            $liga=$autollamada; 
                            $elnivel=str_replace("Estatal","",$elnivel);    str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);
                            include("matricula_consulta.php");
                            break;
                        case "escuela":   //lista de escuelas de la zona
                            $querecibo="";
                            $arrnivel=explode("|",$_GET["arr_nivel"]);
                            $elidnivel=$arrnivel[0]; $elnivel=$arrnivel[1]; 
                            $lazona=$_SESSION["vg_cct_zona"];
                            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                            $TItulo="<h3 class='fbold ftext-red fcenter'>".$_GET["logeado"]."</h3>"; $subtit="<h3 class='ftext-green fcenter'>Lista de Escuelas de ".$elnivel."</h3>"; 		 
                            $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                            // -----------------------------------------------------------------------------------------------------------------------------------------------------
                            $liga1="Matrícula real capturada|../ingresoplantel/matricula.php?qwerty=1&||#F9FFE4";      // titulo del boton|liga|titulo de la columna
                            //flista_Escuelas_x_zona_nivel($_SESSION["vg_cct_zona"],$elidnivel,"",$liga1,$liga2);   YANO SE USO Y SE HIZO MEJOR EL INCLUDE
                            include("recibo_matricula_zona_listaescuelas.php");
                            break;
                    }
                }
                break;
            default:
                $elnivel=str_replace("Estatal","",$elnivel);    str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);
                // Para los reportes se requieren estos tres datos : $elidnivel, $elnivel y $lazona
                switch($_GET["sel"]){
                    case "recibomatricula":  include("matricula_consulta.php"); break;
                    case "escuela": 

                            $vl_back="../ingresosupervisor/matricula_consulta.php?ejecucion=2&basenivel=6";
                            if ($_SESSION["vg_tipousuario"]!="Almacen"){ $vl_back=$vl_back."&almacen_seleccionado=".$_GET["almacen_seleccionado"]."&bodega=".$_GET["bodega"]; }
                            $lazona=$_GET["cct_zona"];
                            $elidnivel=$_GET["idnivel"];
                            // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                            $TItulo="<h3 class='fbold ftext-red fcenter'>".$logeado."</h3>"; $subtit="<h3 class='ftext-green fcenter'>Lista de Escuelas de ".$_GET["nivel"]."&emsp;Zona ".$_GET["cct_zona"]."</h3>"; 		 
                            $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                            // -----------------------------------------------------------------------------------------------------------------------------------------------------
                            $liga1="Balance de matricula real|../ingresoplantel/matricula.php?qwerty=1&cct_zona=".$_GET["cct_zona"]."&almacen_seleccionado=".$_GET["almacen_seleccionado"]."&bodega=".$_GET["bodega"]."&||#F9FFE4";     // titulo del boton|liga|titulo de la columna
                            //flista_Escuelas_x_zona_nivel($_GET["cct_zona"],$_GET["idnivel"],"fecha_matricula!='0000-00-00'",$liga1,$liga2); YANO SE USO Y SE HIZO MEJOR EL INCLUDE
                            include("recibo_matricula_zona_listaescuelas.php");
                        break;
                }            
                break;
        }
        
}  ?></div></body></html>
<?


