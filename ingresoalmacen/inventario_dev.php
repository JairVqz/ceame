<? session_start(); 	 $autollamada=basename(__FILE__). "?"; ?>
<!doctype html><html lang="es"> 
<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />      	<meta name="viewport" content="width=device-width, initial-scale=1"> 	
<title>Libros Veracruz - Validación</title><link rel="shortcut icon" href="../images/libro_titulo3.png">
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  
<SCRIPT TYPE="text/javascript" src="../js/_funciones14.js"></SCRIPT> 


<script type="text/javascript" src="../inc/fancy217/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<SCRIPT TYPE="text/javascript"> 
	function checa(modo,soloparaesteprog=0){var m=document.getElementById("error");    var a=document.frmactual;
		switch (modo){
        case 1:
            if (a.rdgrado.value=="") {
                t="Seleccione";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
                a.rdgrado.focus();                     setTimeout ("x()", 2000);  return false;
            }
        break;
        case 2:
            if (a.numpase.value.length==0) {
                 t="Especifique pase";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
                 a.numpase.focus();                     setTimeout ("x()", 2000);  return false;
            }
   		    break;
        case 5:
            if (a.clave.value.length==0) {
                 t="Especifique Clave";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
                 a.clave.focus();                     setTimeout ("x()", 2000);  return false;
            }
            // if (a.cajas.value.length==0) {
            //      t="Especifique Cajas";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
            //      a.cajas.focus();                     setTimeout ("x()", 2000);  return false;
            // }
            // if (a.ejemxcaja.value.length==0) {
            //      t="Especifique Ejemplares por Caja";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
            //      a.ejemxcaja.focus();                     setTimeout ("x()", 2000);  return false;
            // } 
   		    break;                                    
		case 5145645645645:
			if(!document.querySelector('input[name="grado[]"]:checked')) {				t="Especifique grados"; m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";				setTimeout ("x()", 2000);    return false;			}

			if (a.tdocentes.value>6) {
				t="El número máximo de docentes debe ser 6";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
				a.tdocentes.focus();                     setTimeout ("x()", 2000);  return false;
			}

   		    break;
        } 

	}
    function doHide(){
                var j = document.getElementsByClassName("exhibe");
                for (var i = 0; i < j.length; i++){j[i].style.visibility = "hidden";}
    }
    function doPrint(){
                var k = document.getElementsByClassName("saca");
                var j = document.getElementsByClassName("exhibe");
                for (var i = 0; i < k.length; i++){k[i].style.visibility = "hidden";}
                for (var i = 0; i < j.length; i++){j[i].style.visibility = "visible";}
                window.print()
                for (var i = 0; i < k.length; i++){k[i].style.visibility = "visible";}
                for (var i = 0; i < j.length; i++){j[i].style.visibility = "hidden";}
    }
</SCRIPT>

<style type="text/css" media="print">
         @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        } 
        p.SaltoDePagina { PAGE-BREAK-AFTER: always }  
</style>

</head>
<body class="fcenter" onLoad='doHide()'>
    
    <?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');	conectalo("zona");




if (isset($_GET["n"])){ 
    $_SESSION["idnivel"]=$_GET["n"];
    switch($_SESSION["idnivel"]){
        case 3: $_SESSION["nivel"]="Preescolar"; break;
        case 4: $_SESSION["nivel"]="Primaria"; break;
        case 6: $_SESSION["nivel"]="Secundaria"; break;
        case 7: $_SESSION["nivel"]="Telesecundaria"; break;
    }
}

if (isset($_GET["pm_zona"])){ 
    $_SESSION["cct_zona"]=$_GET["pm_zona"];
}
if ((!isset($logeado) && !isset($TxtUsuario))){
	fmessage("Acceso No Permitido",1500,2,"../_panel.php");
}else{ 	
	if(!isset($_GET["ex"])){$_GET["ex"]=1;}
	switch ($_GET["ex"]){
    case 1:
            $vl_back="../_panel.php?papa=1556";	
            $_sql="select distinct a.*,b.ciclo,b.primcajas,b.titulo,c.acumulado from inventario_dev a,l_libros b,(select idmaterial,sum(cantidad) as acumulado from inventario_dev group by idmaterial) c WHERE a.idmaterial=b.idmaterial and a.idmaterial=c.idmaterial and a.idnivel=".$_SESSION["idnivel"]." and a.idalmacen=".$_SESSION["vg_idalmacen"]." and a.cct_zona='".$_SESSION["cct_zona"]."' and a.estatus='A' and b.estatus!='X' and b.ciclo='".$_SESSION["vg_cicloescolar"]."' order by a.fecha desc"; 
            //	echo "<br><br><br><br><br><br><br><br<br><br<br><br><br><br>".$_sql; 
            $res=mysql_query($_sql);?>
                <div class="saca frow ftop fpadding-large fleft-align"> <a class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a></div><br>
                <div><img src="../images/logo_SEVGob.png" weight="800"></div> 
                <div style="text-align:center; font-weigth:bold">  
                        SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                        SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                        COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                        PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                        CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br>  
                        ALMACEN <? echo $logeado; ?><br>
                        DEVOLUCIONES DEL NIVEL <? echo strtoupper($_SESSION["nivel"]); ?><br>
                        ZONA : <? echo $_SESSION["cct_zona"]; ?>
                </div>         
                <div class="frow saca">
                    <a href="<? echo $autollamada."ex=2&vl_modoact=1";?>" class="saca fbold fpadding-small fround fbutton fpale-yellow icon-plus fmargin">&emsp;Registrar devolución&emsp;</a>
                </div> 
            
                <table class="ftable-all fborder" align="center" style="font-weight:bold" cellpadding="10" cellspacing=0 border=1> 
                    
                    <tr><th></th><th>Clave</th><th>Titulo</th><th style="background:#81A600">Cajas</th><th style="background:#81A600">Ejem x caja</th><th style="background:#81A600">Sueltos</th><th style="background:#739300">Total devolución</th><th style="background:#006693">Total Acumulado</th><th>Fecha</th></tr><? 
                        $r=0; 
                        if (mysql_num_rows($res)>0){ 
                            while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); ?>
                                <tr> 
                                    <!-- <td class="fwhite"> -->
                                        <!-- <small><a class="fbutton fround fpale-yellow fpadding-small" href="<? // echo $autollamada."ex=4&".$nomarreglo."=".oculta($caddatos,0); ?>">Detalle</a></small> -->
                                        <!-- <small><a class="fbutton fround fpale-red fpadding-small icon-cancel" href="<?// echo $autollamada."ex=3&eli&clave=".$recset["idmaterial"]; ?>"></a></small> -->
                                    <!-- </td>  -->
                                    <td class="fcenter"><table><tr><td class="saca"><small><?
                                        if ($recset["repetido"]=="R"){ ?><a href="<? echo $autollamada."ex=4&ky=".$recset["idmaterial"]."|".$recset["titulo"]; ?>" class="fbutton fround fpadding-small fpale-green icon-docs">&nbsp;Historial</a> <?}?>
                                        <a class="fbutton fround fpale-red fpadding-small icon-pencil" href="<? echo $autollamada."ex=2&vl_modoact=2&arrmod=".$recset["idmaterial"]."|".$recset["cajas"]."|".$recset["sueltos"]; ?>">Corregir</a></small></td><td>
                                        <? echo ($r+1); ?></td></tr></table> 

                                    </td> 
                                    <td class="ftext-indigo" style="vertical-align:middle"><? echo strtoupper($recset["idmaterial"]); ?></td> 
                                    <td style="vertical-align:middle"><? echo $recset["titulo"]; ?></td> 
                                    <td style="text-align:center; vertical-align:middle"><? echo $recset["cajas"]; ?></td> 
                                    <td style="text-align:center; vertical-align:middle"><? echo $recset["primcajas"]; ?></td>  
                                    <td style="text-align:center; vertical-align:middle"><? echo $recset["sueltos"]; ?></td> 
                                    <td style="text-align:center; vertical-align:middle"><? echo number_format($recset["cantidad"],0); ?></td> 
                                    <td style="text-align:center; vertical-align:middle"><? echo number_format($recset["acumulado"],0); ?></td> 
                                    <td style="text-align:center; vertical-align:middle"><? echo fechalarga($recset["fecha"]); ?></td>
                                        
                                            
                                         
                                        
                                         
                                        


                                </tr> <? 
                                $r++; 
                            } 	
                        }else{ echo "<tr><td colspan='11' class='fcenter fpadding-large'>No hay registros</td></tr>"; }        ?>    
                </table> 
            <? 
            if ($_SESSION["elidnivel"]==31 ||  $_SESSION["elidnivel"]==32){
                $firma_entrega="DE SECTOR";     $firma_recibe="DEL SUPERVISOR";     
                $sello_entrega="SECTOR";         $sello_recibe="SUPERVISIÓN"; 
                $entrego="";  
            }else{
                $firma_entrega="";     $firma_recibe="DEL SUPERVISOR";     
                $sello_entrega="ALMACEN";         $sello_recibe="SUPERVISIÓN"; 
                $entrego=$rec_almacen["responsable"]; 
            }
            ?>
            <br><br><br>
            <table class="exhibe" align="center" cellpadding="10" cellspacing="0" width="1000" border=1 style="border-color:#FBFBFB;">
                <tr><td style="font-size:18px; font-weight:bold;  vertical-align:top">Observaciones</td></tr>
                <tr><td>
                    <br><br><br>
                </td></tr>
            <table><br><br><br>

            <table class="exhibe" cellpadding="7" cellspacing="0" width="1000" align="center" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
            <!--      Aviso     -->
            <br><br><br>
            <div style="text-align:center" class="exhibe"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
            <br>
            <?
            


        
            break;        
    case 2:
        if (!isset($_POST["rdgrado"])){
            $vl_back=$autollamada."ex=1";	
            echo "<h3 class='fpadding-small fmargin fbold'>".$_SESSION["nivel"]."</h3>";
            $titulo="Grado";      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 	// Esto de pm_escuela creo que no se usa
            	  				switch ($_GET["vl_modoact"]){case 1: default: $tit="Seleccione<br>"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2;    $arrmodif=explode("|",$_GET["arrmod"]); break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
            <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=2' onSubmit='return checa(1);' name='frmactual' method='post'>
                <? $ancho=200;   $anchorotulos=160;   $color=".$fdeg.";			$titboton1="Continuar"; $titboton2=""; ?> <strong>
                <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                    <tr><td><? 
                        if ($_SESSION["idnivel"]==4){
                            $valores="1|2|3|4|5|6";   $texval="Primero|Segundo|Tercero|Cuarto|Quinto|Sexto";
                        }else{
                            $valores="1|2|3";   $texval="Primero|Segundo|Tercero";
                        }
                        $radnombre="rdgrado"; 	 			$arrval=explode("|",$valores); $arrtex=explode("|",$texval); 					for ($i=0; $i < count($arrval); $i++) { ?>						&emsp;<input style='margin:7px 3px' type='radio' name='<?echo $radnombre;?>' value='<?echo $arrval[$i];?>'>&nbsp;&nbsp;<? echo $arrtex[$i].'<br>'; 							} ?>
                    </td></tr>	
                    <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
                </table>  </strong>
            </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div><?	
        }else{
            $vl_back=$autollamada."ex=1";	
            echo "<h3 class='fpadding-small fmargin fbold'>Nivel ".$_SESSION["nivel"]."</h3>";
            $titulo="Título a devolver";      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 		  				switch ($_GET["vl_modoact"]){case 1: default: $tit="<small>Seleccione</small><br>"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2;    $arrmodif=explode("|",$_GET["arrmod"]); break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
            <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=3' onSubmit='return checa(5);' name='frmactual' method='post'>
                <input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
                <? $ancho=650;   $anchorotulos=180;   $color=".$fdeg.";			if($modo==1){ $titboton1="Agregar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
                <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                    <tr><td colspan="2"><div class="fcenter"><? switch($_POST["rdgrado"]){ case "1": echo "Primer "; break; case "2": echo "Segundo "; break;    case "3": echo "Tercer "; break; case "4": echo "Cuarto "; break; case "5": echo "Quinto "; break; case "6": echo "Sexto "; break; } ?>grado </div><div class="fbold ftext-red"><? $radnombre="clave"; 	 			$tabla="l_libros"; $campkey="idmaterial"; $camptex="titulo"; $cond=" where estatus='A' and idnivel=".$_SESSION["idnivel"]." and idgrado=".$_POST["rdgrado"]; 							$vl_res=mysql_query("select ".$campkey.",".$camptex." from ".$tabla.$cond); $valores=""; $texval=""; while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ $valores=$valores.$recset[$campkey]."|"; $texval=$texval.$recset[$camptex]."|"; } $valores=substr($valores,0,strlen($valores)-1); $texval=substr($texval,0,strlen($texval)-1);										$arrval=explode("|",$valores); $arrtex=explode("|",$texval); 					for ($i=0; $i < count($arrval); $i++) { ?>						<input style='margin:7px 3px' type='radio' name='<?echo $radnombre;?>' value='<?echo $arrval[$i];?>'>&nbsp;&nbsp;<? echo $arrtex[$i].'<br>'; 							} ?></div></td></tr>				
                    <? $rotulo="# Cajas"; $nombre="cajas"; $tamano=5; $max_largo=5; $valor=$arrmodif[1]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?>&emsp;<input class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr>
                    <? $rotulo="# Sueltos"; $nombre="sueltos"; $tamano=5; $max_largo=5; $valor=$arrmodif[2]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?>&emsp;<input class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr>
                    <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
                </table>  </strong>
            </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div><?	
        }    
        break; 
    case 3:
        if (isset($_GET["eli"])){
            if (mysql_query("delete from inventario_dev where idmaterial='".$_GET["clave"]."' and idinventario=".$_SESSION["idnivel"]." and idalmacen=".$_SESSION["vg_idalmacen"]." and cct_zona='".$_SESSION["cct_zona"]."' and estatus!='X'")){
                $banpas=1;
                fmessage("Clave eliminada ",2500,2,$autollamada."ex=1");
            }
        }else{    
            $res=mysql_query("select * from l_libros where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and estatus!='X'");
            if (mysql_num_rows($res)>0){
                $reclibros=mysql_fetch_array($res,MYSQL_ASSOC);

                if ($_POST["hid_modoact"]==1){
                        $res=mysql_query("select * from inventario_dev where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and idalmacen=".$_SESSION["vg_idalmacen"]." and cct_zona='".$_SESSION["cct_zona"]."' and ciclo='".$_SESSION["vg_cicloescolar"]."' and estatus!='X'");                
                        $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                        if (mysql_num_rows($res)>0){
                            if (mysql_query("update inventario_dev set estatus='H' where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and idalmacen=".$_SESSION["vg_idalmacen"]." and cct_zona='".$_SESSION["cct_zona"]."' and ciclo='".$_SESSION["vg_cicloescolar"]."' and estatus='A'")){
                                mysql_query("insert into inventario_dev values ('".$_POST["clave"]."',".$_SESSION["idnivel"].",".$_SESSION["vg_idalmacen"].",'".$_SESSION["cct_zona"]."',".$_POST["cajas"].",".$reclibros["primcajas"].",".$_POST["sueltos"].",".(($_POST["cajas"]*$reclibros["primcajas"])+$_POST["sueltos"]).",NOW(),'".$_SESSION["vg_cicloescolar"]."','A','R')");
                                fmessage("Clave Registrada otra vez",3500,2,$autollamada."ex=1");
                            }
                        }else{
                            if (mysql_query("insert into inventario_dev values ('".$_POST["clave"]."',".$_SESSION["idnivel"].",".$_SESSION["vg_idalmacen"].",'".$_SESSION["cct_zona"]."',".$_POST["cajas"].",".$reclibros["primcajas"].",".$_POST["sueltos"].",".(($_POST["cajas"]*$reclibros["primcajas"])+$_POST["sueltos"]).",NOW()-1,'".$_SESSION["vg_cicloescolar"]."','A','')")){
                                fmessage("Clave Registrada ",3500,2,$autollamada."ex=1");
                            }else{
                                fmessage("No registro",5500,2,$autollamada."ex=2");
                            }
                        }   
                }else{
                        if (mysql_query("update inventario_dev set cajas=".$_POST["cajas"].", sueltos=".$_POST["sueltos"].",cantidad=".(($_POST["cajas"]*$reclibros["primcajas"])+$_POST["sueltos"])." where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and idalmacen=".$_SESSION["vg_idalmacen"]." and cct_zona='".$_SESSION["cct_zona"]."' and ciclo='".$_SESSION["vg_cicloescolar"]."' and estatus='A'")){
                            fmessage("Modificada",2500,2,$autollamada."ex=1");
                        }    
                }
                        
                        

            }else{ fmessage("Clave ".$_POST["clave"]."<br>de ".$_SESSION["nivel"]."<br>No válida",8500,2,$autollamada."ex=2"); }    
        }
        break;
    case 4:
        $vl_back=$autollamada."ex=1";	$arrky=explode("|",$_GET["ky"]);
        $_sql="select distinct a.*,b.ciclo,b.primcajas,b.titulo from inventario_dev a,l_libros b WHERE a.idmaterial=b.idmaterial and a.idmaterial='".$arrky[0]."' and a.idnivel=".$_SESSION["idnivel"]." and a.idalmacen=".$_SESSION["vg_idalmacen"]." and cct_zona='".$_SESSION["cct_zona"]."' and b.idnivel=".$_SESSION["idnivel"]." and b.estatus!='X' and b.ciclo='".$_SESSION["vg_cicloescolar"]."' order by a.fecha desc"; 
        //            	echo "<br><br><br><br><br><br><br><br<br><br<br><br><br><br>".$_sql; 
        $res=mysql_query($_sql);
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='fbold'>Devoluciones del nivel de ".$_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"]." )</h3>"; 		 
        $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------?>
        <br><br><br><br><h3>Zona : <? echo $_SESSION["cct_zona"]; ?></h3>
        <div class="frow">
            <br><h3>Historial de la clave <span class="fbold ftext-red"><? echo $arrky[0]."</span><br><strong><small class'fbol'>".$arrky[1]."</small></strong>";?></h3><br>
        </div>
        
            <table class="ftable-all fborder"> 
                
                <tr><th></th><th>Cajas</th><th>Ejem x caja</th><th>Sueltos</th><th>Total</th><th>Fecha</th></tr><? 
                    $r=0; $tot=0;
                    if (mysql_num_rows($res)>0){ 
                        while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); ?>
                            <tr> 
                                <td class="fcenter"><small><? echo ($r+1); ?></small></td> 
                                <td class="fcenter"><? echo $recset["cajas"]; ?></td> 
                                <td class="fcenter"><? echo $recset["primcajas"]; ?></td>  
                                <td class="fcenter"><? echo $recset["sueltos"]; ?></td> 
                                <td class="fcenter"><? echo number_format($recset["cantidad"],0); ?></td> 
                                <td class="fcenter"><? echo fechalarga($recset["fecha"]); ?></td> 
                            </tr> <? 
                            $r++; $tot=$tot+(($recset["cajas"]*$recset["primcajas"])+$recset["sueltos"]);
                        } ?><tr><td colspan="4" style="vertical-align:middle; text-align:center">Total acumulado</td><td class="fcenter" style="font-size:20px"><?  echo number_format($tot,0); ?></td><td></td></tr><?

                    }else{ echo "<tr><td colspan='11' class='fcenter fpadding-large'>No hay registros</td></tr>"; }        ?>    
            </table> 
        <? 
        


        
            break;    
    }    


	?><br><br>
	<div class="fcenter fpadding-large fborder-top fmargin saca">
		<a href="<? echo $vl_back;?>" class="fbutton fshad fpadding-tiny fround"><h4 class="fmargin-left fmargin-right icon-left">&nbsp;Regresar</h4></a>
	</div><?
} ?>	
</body>
</html>