<?php session_start();     $autollamada=basename(__FILE__); ?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Libros Veracruz - Men�</title><link rel="shortcut icon" href="images/libro_titulo3.png">
        <link rel="stylesheet" href="css/frc.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/frcico.css" type="text/css" media="screen" />
        <script type="text/javascript" src="inc/fancy217/lib/jquery-1.10.2.min.js"></script>	<script type="text/javascript" src="22_inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>	
        <link rel="stylesheet" type="text/css" href="22_inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />
        <SCRIPT TYPE="text/javascript" src="js/bootstrap.min.js"></SCRIPT>
        <SCRIPT TYPE="text/javascript" src="_funciones.js"></SCRIPT>
        <style type="text/css">.seleccion:hover {background:#F3FFE1;}</style>
</head>
<body class="fcenter"><?php  require_once('conecta2023.php');    require_once('inc/funciones_libros.php');             conectalo("panel");
            if (isset($_POST["hid_tipousuario"]) && !isset($_POST["TxtPassword"])) {  $vl_back="ingreso.php";                  if (isset($_POST["hid_tipousuario"])){   $vl_back=$vl_back."?tipousuario=".$_POST["hid_tipousuario"]; }   ?> <script type="text/javascript" languaje="javascript">setTimeout("window.location.replace('<? echo $vl_back; ?>')", 15000);</script><br><br><br>  <? }
            if(isset($_GET["w"])){   $_SESSION["vg_width"]=$_GET["w"];     if ($_GET["w"]<500){$_SESSION["vg_w"]=1;}else{$_SESSION["vg_w"]=2; }     }    if($_SESSION["vg_w"]==1){$ban22=" fleft"; $ban223="left";}else{$ban22=""; $ban223="center";}     $vl_letratituloprincipal = "roja_20";
            if (isset($_POST["hid_tipousuario"]) || isset($_GET["tipousuario"])){$_SESSION["vg_tipousuario"]=$_POST["hid_tipousuario"]; }
            $vl_back = "ingreso.php?tipousuario=".$_SESSION["vg_tipousuario"];
            switch ($_SESSION["vg_tipousuario"]) { 
                case "Sector":
                    conectalo("zona");  $vl_sql="select * FROM sector_c where cuenta='".strtoupper($_POST["TxtUsuario"]). "' and status='A'  and cve_ingr='".strtoupper($_POST["TxtPassword"])."'";      
                    $vl_letratituloprincipal = "roja_16";
                    break;
                case "Supervisor":
                    conectalo("zona");  $vl_sql="select * FROM supervis_c where cuenta='".strtoupper($_POST["TxtUsuario"]). "' and cve_ingr='".strtoupper($_POST["TxtPassword"])."'";
                    break;
                case "Plantel":
                    $vl_letratituloprincipal = "roja_14";
                    conectalo("director");
                    $vl_back = "ingreso_plantel.php?tipousuario=Plantel";
                    $vl_sql = "select * FROM ctsev where cct='" . strtoupper($_POST["TxtUsuario"]) . "' and turno=" . $_POST["TxtTurno"]." and estatus!='X' and cve_911 regexp '".strtoupper($_POST["TxtPassword"])."'";
                    break;
                case "Maestro":
                    conectalo("maestro");   $vl_sql = "select distinct a.cct as cuenta,a.turno,a.curp,a.tipousuario,concat(a.paterno,' ',a.materno,' ',a.nombre) as nombre,b.textomenu,b.ligamenu,b.enotravent,b.id,a.cambiopassw,b.visible,b.nivnopermiso FROM maestros_c a, _menu b,ct_c12_secundarias c where concat(a.cct,a.turno)=concat(c.cct,c.turno) and a.tipousuario=b.tipousuario and a.cct='" . strtoupper($_POST["TxtUsuario"]) . "' and a.passw='" . strtoupper($_POST["TxtPassword"]) . "' order by b.orden";
                    $vl_back = "ingreso_plantel.php?tipousuario=Maestro";   mysql_query("set sql_big_selects=1"); // por si la tabla es grande 
                    break;
                case "Almacen":
                    conectalo("almacen");  $vl_sql = "select a.cambiopassw,a.cuenta,a.tipousuario,a.responsable,b.textomenu,b.ligamenu,b.enotravent,b.id,a.idalmacen,a.almacen as nombre,b.visible,nivelesrec,nivelesdis,b.nivnopermiso FROM almacen_c a, _menu b,(select z.idalmarec,count(distinct z.idnivel) as nivelesrec from ctsev z where z.idalmarec='".substr($_POST["TxtUsuario"],7)."' and z.estatus!='B') c,(select y.idalmadis,count(distinct y.idnivel) as nivelesdis from ctsev y where y.idalmadis='".substr($_POST["TxtUsuario"],7)."' and y.estatus!='B') d where a.tipousuario=b.tipousuario and a.cuenta='" . strtoupper($_POST["TxtUsuario"]) . "' and a.passw='" . strtoupper($_POST["TxtPassword"]) . "' order by b.orden";
                    break;
                default:
                    conectalo("zona");
                    $vl_back = "ingreso.php";
                    $vl_sql = "select a.cuenta,a.tipousuario,a.nombre,'' as usuario_indefinido FROM _usuarios a where a.cuenta='" . strtoupper($_POST["TxtUsuario"]) . "' and a.passw='" . strtoupper($_POST["TxtPassword"]) . "'";
                    break;
            }
            if (!isset($_SESSION["logeado"]) or isset($permiso)) { 
                $resultado = mysql_query($vl_sql);          $numregs = mysql_affected_rows();       $recset = mysql_fetch_array($resultado);
                if ($numregs > 0) {
                            if (isset($recset["usuario_indefinido"])){$_SESSION["vg_tipousuario"]=$recset["tipousuario"];}
                            if ($_SESSION["vg_w"]==1){$campo="chico"; $campoinicio="1,0";}else{$campo="grande"; $campoinicio="0,1";}
                            $resacceso = mysql_query("select * from accesos where tipousuario='".$_SESSION["vg_tipousuario"]."' and fecha='".date("Y/m/d")."'"); 
                            $regsacceso = mysql_fetch_array($resacceso);
                            if ($regsacceso>0){
                                mysql_query("update accesos set ".$campo."=(".$campo."+1) where tipousuario='".$_SESSION["vg_tipousuario"]."' and fecha='".date("Y/m/d")."'");
                            }else{
                                mysql_query("insert into accesos values(NOW(),'".$_SESSION["vg_tipousuario"]."',".$campoinicio.")");
                            } 
                    //-------------------------------------
                    $vl_procede = "SI";
                    $_SESSION["vg_cicloescolar"]="2024-2025";
                    $_SESSION["vg_cicloescolaranterior"]="2023-2024";
                    switch ($_SESSION["vg_tipousuario"]) {  
                        case "Sector":
                            $_SESSION["vg_sector"]=$recset["sector"];
                            $_SESSION["vg_cct_sector"]=$recset["cuenta"];
                            $_SESSION["logeado"]=strtoupper($recset["nombre"]);
                            $_SESSION["vg_numniveles"]=$recset["fer_numniveles"];
                            $_SESSION["vg_idniveles"]=$recset["fer_idniveles"];
                            $_SESSION["vg_descniveles"]=$recset["fer_descniveles"];                            
                            
                            $_SESSION["colortit"]="black";
                            break;
                        case "Supervisor":
                            $_SESSION["vg_idalmacen"]= $recset["idalmacen"];
                            $_SESSION["vg_zonaescola"]=$recset["zonaescola"];
                            $_SESSION["vg_cct_sector"]=$recset["cct_sector"];
                            $_SESSION["vg_sector"]=$recset["sector"];
                            $_SESSION["vg_cct_zona"]=$recset["cuenta"];
                            $_SESSION["vg_foliozona"]=$recset["folio"];
                            $_SESSION["logeado"]=strtoupper($recset["nombre"]);
                            $_SESSION["colortit"]="black";
                            $_SESSION["vg_valid_nuevoreg"]=$recset["valid_nuevoreg"];
                            if (strlen($recset["estatusvalid"])==strlen($recset["fer_idniveles"])){
                                $_SESSION["vg_estatusvalidacion"]=1;    
                            }else{
                                $_SESSION["vg_estatusvalidacion"]=0;        
                            }
                            $_SESSION["vg_numniveles"]=$recset["fer_numniveles"];
                            $_SESSION["vg_idniveles"]=$recset["fer_idniveles"];
                            $_SESSION["vg_descniveles"]=$recset["fer_descniveles"];
                            if ($recset["niveles"]!=1){ 
                                $_SESSION["vg_estatusvalidaciononiveles"]=$recset["estatusvalid"];
                                $_SESSION["vg_idnivelunicosupervisor"]=strlen($recset["fer_niveles"]); $_SESSION["niveles_supervis"]=$recset["fer_niveles"]; $_SESSION["vg_nivelunicosupervisor"]=""; 
                            }else{
                                $_SESSION["vg_idnivelunicosupervisor"]=$recset["idnivelunicosupervisor"];  $_SESSION["vg_nivelunicosupervisor"]=$recset["nivelunicosupervisor"]; 
                            }
                            //---------------------------------------------
                            $vl_letratituloprincipal = "roja_14";
                            break;
                        case "Plantel":
                            $_SESSION["vg_cct_turno"]=$_POST["TxtUsuario"].$_POST["TxtTurno"];
                            $_SESSION["vg_cct"]=$_POST["TxtUsuario"];
                            $_SESSION["vg_turno"]=$_POST["TxtTurno"];
                            $_SESSION["logeado"]=strtoupper($recset["nom_ct"]);
                            $_SESSION["colortit"]="green";

                            $_SESSION["arr_matricula"]=array($recset["alu_1"], $recset["alu_2"], $recset["alu_3"], $recset["alu_4"], $recset["alu_5"], $recset["alu_6"], $recset["a1"], $recset["a2"], $recset["a3"], $recset["a4"], $recset["a5"], $recset["a6"]);
                            $_SESSION["vg_fecha_matricula"]=$recset["fecha_matricula"];


                            $_SESSION["vg_ctausr"]=$recset["cct"] . $recset["turno"];
                            $_SESSION["vg_cct_zona"]=$recset["cct_zona"];
                            
                            if ($vl_secundaria=="SI") {
                                $_SESSION["vg_secundaria"]="SI";
                                $_SESSION["vg_statuslibros"]=$recset["statuslibros"];
                            }
                            $_SESSION["vg_idnivel"]=$recset["idnivel"];
                            $_SESSION["vg_idalmadis"]=$recset["idalmadis"];
                            $_SESSION["vg_municipio"]=$recset["municipio"];

                            $correo_e = $recset['correo_e'];
                            $director = $recset['director'];
                            $telefono = $recset['telefono'];
                            $domicilio = $recset['domicilio'];
                            $curp_director = $recset['curp_director'];

                            $_SESSION["vg_multigrado"]=$recset["multigrado"];    
                            $_SESSION["vg_lenguas"]=$recset["lenguas"];       

                            $vl_letratituloprincipal="roja_14";
                            break;
                        case "Maestro":
                            $_SESSION["vg_ctausr"]=$recset["cuenta"];
                            $_SESSION["vg_curp"]=$recset["curp"];
                            $_SESSION["logeado"]=strtoupper($recset["nombre"]);
                            $_SESSION["colortit"]="black";
                            if ($recset["cambiopassw"]=="NO") {
                                $vl_procede="NO";?> 
                                <script languaje="javascript" type="text/JavaScript">cl2("camb_pw.php?chpswjmkl=lok"); </script><?php
                            }
                            break;
                        case "Almacen":
                            $vl_letratituloprincipal="roja_14";
                            $_SESSION["vg_idalmacen"]=$recset["idalmacen"];
                            if ($recset["cambiopassw"]=="NO") {
                                $vl_procede="NO";
                                fquit($_SERVER['PHP_SELF']."?chpswjmkl=lok"); 
                            }
                            $_SESSION["logeado"]=strtoupper($recset["nombre"]);
                            $_SESSION["vg_responsable"]=strtoupper($recset["responsable"]);
                            $_SESSION["colortit"]="black";
                            $_SESSION["vg_nivelesrecalmacen"]=$recset["nivelesrec"];  
                            $_SESSION["vg_nivelesdisalmacen"]=$recset["nivelesdis"];
                            break;
                        case "informatica":
                            $vl_letratituloprincipal="roja_14";
                            if ($recset["cambiopassw"]=="NO") {
                                $vl_procede="NO";
                                fquit($_SERVER['PHP_SELF']."?chpswjmkl=lok"); 
                            }
                            $_SESSION["logeado"]=strtoupper($recset["nombre"]);
                            $_SESSION["colortit"]="black";
                            break; 
                        default:
                            $_SESSION["logeado"]=strtoupper($recset["nombre"]);                           
                            break;
                    }
                }else{
                    $vl_procede="NO";
                    echo "<br><div class='alert alert-danger'><span class='glyphicon glyphicon-ban-circle'></span>Verifique sus datos</div><br><a href='" . $vl_back . "' class='btn btn-default'>Intentar nuevamente</a>";
                }
            }
            // Desarrollado por : L.I. Fernando Rodr�guez Colorado 	wwww.sistemas-rc.com
            $ban2="Seleccione una opci�n";  
            if (!isset($_GET["papa"])){
                $vl_menusql="select * FROM _menu where visible='S' and papa=0 and tipousuario regexp '" . $_SESSION["vg_tipousuario"] . "' order by proceso,orden";
            }else{
                $vl_menusql="select * FROM _menu where visible='S' and papa=".$_GET["papa"]." and tipousuario regexp '" . $_SESSION["vg_tipousuario"] . "' order by proceso,orden";
            }
            $resultado=mysql_query($vl_menusql);
            $recmenu=mysql_fetch_array($resultado);
            $regsmenu=mysql_affected_rows();
            if ($vl_procede!="NO") { 
                // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                $TItulo="<h3 class='fbold ftext-".$_SESSION["colortit"]."'>".$_SESSION["logeado"]."</h3>"; $subtit=""; 
                if (isset($_GET["papa"])){ $vl_back="_panel.php";}		 
                $LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                
                $c = 1; $idregreso=$recmenu["hijoback"]; ?>
                <table class="ftable-all fmargin-top" align="center"<? if($_SESSION["vg_w"]==1){echo " width='100%'"; } ?>>
                        <tr><th colspan=3><? if ($regsmenu>0){ echo "<h4 class='fbold'>".$ban2."</h4>";}else{ echo "<h4>Sin opciones por el momento</h4>";} ?></th></tr><?
                        $proceso_recep="";    $proceso_dist="";   $proceso_redis="";    $proceso_inven="";   $proceso_adic="";    
                        while ($c <= $regsmenu) {
                            $_SESSION["idmenu"]=$recmenu["id"];
                            $vl_mostrar="SI";
                            switch($_SESSION["vg_tipousuario"]){ 
                                case "Sector":  
                                    if ($recmenu["nivnopermiso"]!=""){ 
                                        if ($_SESSION["vg_numniveles"]==1){
                                            if (stristr($recmenu["nivnopermiso"], $_SESSION["vg_idniveles"])){ $vl_mostrar = "NO";  }   // parametros = p1 -> en esta cadena,p2 -> busca esta otra
                                        }else{
                                            $arrmenunivsinpermiso=explode(",",$recmenu["nivnopermiso"]);
                                            foreach($arrmenunivsinpermiso as $value){
                                                    if (stristr($_SESSION["vg_idniveles"], $value)){ $vl_mostrar = "NO";   }
                                            }
                                        } 
                                    } 
                                break;                                                                  
                                case "Supervisor": 
                                    if ($recmenu["nivnopermiso"]!=""){ 
                                        if ($_SESSION["vg_numniveles"]==1){
                                            if (fencuentra($_SESSION["vg_idniveles"],$recmenu["nivnopermiso"])){ $vl_mostrar = "NO";  }   
                                        }else{
                                            
                                            $arrniveles=explode(",",$_SESSION["vg_idniveles"]);
                                            foreach($arrniveles as $value){
                                                if (fencuentra($value,$recmenu["nivnopermiso"])){ $vl_mostrar = "NO"; }else{  $vl_mostrar = "SI";  break;  }   
                                            }
                                        } 
                                    }  
                                break;
                                case "Plantel":
                                    if ($recmenu["nivnopermiso"]!=""){ 
                                        if (fencuentra($_SESSION["vg_idnivel"],$recmenu["nivnopermiso"])){  $vl_mostrar = "NO";  }
                                    }                                     
                                break;
                            }
                            if ($vl_mostrar!="NO") {
                                if (strlen($recmenu["ligamenu"]) < 5) { $laliga=$_SERVER['PHP_SELF']."?papa=".$recmenu["ligamenu"]; } else { $laliga=$recmenu["ligamenu"]; /*  $_SESSION["vg_backpanel"] = str_repeat("../", substr_count($recmenu["ligamenu"], "/")).$autollamada."?idmenu=".$swkl; */ }
                                if ($recmenu["enotravent"] == "S") {  $eltarget=" target=\"_blank\""; }else{ $eltarget=""; } 

                                if ($_SESSION["vg_tipousuario"]=="Almacen"){  
                                    if($recmenu["proceso"]=="1recep" && $proceso_recep==""){ $rotproc="Recepci�n"; $proceso_recep="xxx"; ?><tr><td colspan=3 class="seleccion fpadding-large fcenter fbold" style="background:#D1D1D1;"><? echo $rotproc; ?></td></tr><? } 
                                    if($recmenu["proceso"]=="2dist" && $proceso_dist==""){ $rotproc="Distribuci�n"; $proceso_dist="xxx"; ?><tr><td colspan=3 class="seleccion fpadding-large fcenter fbold" style="background:#D1D1D1;"><? echo $rotproc; ?></td></tr><? } 
                                    if($recmenu["proceso"]=="3redis" && $proceso_redis==""){ $rotproc="Redistrbuci�n"; $proceso_redis="xxx"; ?><tr><td colspan=3 class="seleccion fpadding-large fcenter fbold" style="background:#D1D1D1;"><? echo $rotproc; ?></td></tr><? } 
                                    if($recmenu["proceso"]=="4inven" && $proceso_inven==""){ $rotproc="Inventario"; $proceso_inven="xxx"; ?><tr><td colspan=3 class="seleccion fpadding-large fcenter fbold" style="background:#D1D1D1;"><? echo $rotproc; ?></td></tr><? } 
                                    if($recmenu["proceso"]=="5adic" && $proceso_adic==""){ $rotproc="Adicional"; $proceso_adic="xxx"; ?><tr><td colspan=3 class="seleccion fpadding-large fcenter fbold" style="background:#D1D1D1;"><? echo $rotproc; ?></td></tr><? } 
                                    if($recmenu["proceso"]=="6cata" && $proceso_cata==""){ $rotproc="Catalogos"; $proceso_cata="xxx"; ?><tr><td colspan=3 class="seleccion fpadding-large fcenter fbold" style="background:#D1D1D1;"><? echo $rotproc; ?></td></tr><? } 
                                } 
                                $banliga=$laliga.$eltarget;    // se puede accesar en cualquier caso !!!!   
                                ?>
                                <tr><td  class="seleccion fpadding-large">
                                    <a style="text-align:left;" href='<? echo $banliga; ?>'>
                                        <div><span class="icon-right-circled2"></span>     <? 
                                            echo $recmenu["textomenu"]; 
                                        ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                    </a>
                                </td>
                                </tr>
                                <?php
                            }                         
                            $c++;
                            $recmenu = mysql_fetch_array($resultado);
                        } 
                        ?>
                </table><?
                mysql_close(); ?><br><br>
                 <div align="center">  
                    <a href="<?php 
                            if (!isset($vl_back)){  
                                switch($_SESSION["vg_tipousuario"]){
                                    case "Sector":  case "Supervisor":          $vl_back = "ingreso.php?tipousuario=".$_SESSION["vg_tipousuario"];  break;
                                    case "AlmacenGeneral":  case "Almacen":     $vl_back = "ingreso.php?tipousuario=Almacen";   break;    
                                    case "Plantel": case "Maestro":             $vl_back = "ingreso_plantel.php?tipousuario=".$_SESSION["vg_tipousuario"];  break;
                                    default:                                    $vl_back="ANALIZA";   break;                 
                                } 
                            }
                            if (isset($_GET["papa"])){ $vl_back="_panel.php";}
                            if (!isset($_GET["papa"])) { echo $vl_back;  } else {   if ($idregreso == 0) {  echo $autollamada; } else {echo $autollamada."?papa=" . $idregreso;  } }
                    ?>" class="fbutton fpale-yellow" ><span class="icon-left-1"></span> Regresar</a>
                </div> <?
            }
            ?>
            <br><br>

</body>
</html>