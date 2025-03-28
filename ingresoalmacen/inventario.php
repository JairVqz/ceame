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
	function fhidden(){ var valor = document.getElementsByClassName("hidden"); var i; for (i = 0; i < valor.length; i++) { valor[i].style.visibility='hidden' } }


    function doPrint(){
                var k = document.getElementsByName("saca");
                for (var i = 0; i < k.length; i++){k[i].style.visibility = "hidden";}
                window.print()
                for (var i = 0; i < k.length; i++){k[i].style.visibility = "visible";}

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
<body class="fcenter">
    
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
if ((!isset($logeado) && !isset($TxtUsuario))){
	fmessage("Acceso No Permitido",1500,2,"../_panel.php");
}else{ 	
	if(!isset($_GET["ex"])){$_GET["ex"]=1;}
	switch ($_GET["ex"]){
    case 1:
            $vl_back="../_panel.php?papa=1546";	
            $_sql="select distinct a.*,b.ciclo,b.primcajas,b.titulo from inventario a,l_libros b WHERE a.idmaterial=b.idmaterial and a.idnivel=".$_SESSION["idnivel"]." and a.idalmacen=".$_SESSION["vg_idalmacen"]." and a.estatus='A' and b.estatus!='X' and b.ciclo='".$_SESSION["vg_cicloescolar"]."' order by a.fecha desc"; 
            //	echo "<br><br><br><br><br><br><br><br<br><br<br><br><br><br>".$_sql; 
            $res=mysql_query($_sql);
            if (!isset($_GET["imprime"])){
                // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
                $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='fbold'>Inventario del nivel de ".$_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"]." )</h3>"; 		 
                $LGback=""; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
                // ----------------------------------------------------------------------------------------------------------------------------------------------------- ?>
                <br><br><br><br><div class="frow">
                    <div class="frow ftop fpadding-tiny fleft-align"> <a name="Reporte" href="<? echo $autollamada."ex=1&imprime"; ?>" class="icon-print fpadding-medium fred fround fbutton"> Reporte</a>&emsp;<a name="saca" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
                
                    <a href="<? echo $autollamada."ex=2";?>" class="fbold fpadding-small fround fbutton fpale-yellow icon-plus fmargin">&emsp;Agregar Clave&emsp;</a>
                </div><? 
            }else{ ?>
                <div class="frow ftop fpadding-tiny fleft-align"> <a name="saca" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="saca" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
                <div><img src="../images/logo_SEVGob.png" weight="800"></div>    
                <h3 style="font-weight:bold">Almacen <? echo $logeado; ?></h3>
                <h3 style="font-weight:bold">Inventario del nivel de <? echo $_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"].")"; ?></h3><br>
            <? } ?>    
            
                <table <? if (!isset($_GET["imprime"])){ ?> class="ftable-all fborder"<? }else{ ?> align="center" style="font-weight:bold" cellpadding="10" cellspacing=0 border=1 <? } ?>> 
                    
                    <tr><th></th><th>Clave</th><th>Titulo</th><th>Cajas</th><th>Ejem x caja</th><th>Sueltos</th><th>Total</th><th>Fecha</th><? if (!isset($_GET["imprime"])){ ?><th></th><? } ?></tr><? 
                        $r=0; 
                        if (mysql_num_rows($res)>0){ 
                            while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); ?>
                                <tr> 
                                    <!-- <td class="fwhite"> -->
                                        <!-- <small><a class="fbutton fround fpale-yellow fpadding-small" href="<? // echo $autollamada."ex=4&".$nomarreglo."=".oculta($caddatos,0); ?>">Detalle</a></small> -->
                                        <!-- <small><a class="fbutton fround fpale-red fpadding-small icon-cancel" href="<?// echo $autollamada."ex=3&eli&clave=".$recset["idmaterial"]; ?>"></a></small> -->
                                    <!-- </td>  -->
                                    <td class="fcenter"><small><? echo ($r+1); ?></small></td> 
                                    <td class="fcenter ftext-indigo"><? echo strtoupper($recset["idmaterial"]); ?></td> 
                                    <td align="left"><? echo $recset["titulo"]; ?></td> 
                                    <td class="fcenter"><? echo $recset["cajas"]; ?></td> 
                                    <td class="fcenter"><? echo $recset["primcajas"]; ?></td>  
                                    <td class="fcenter"><? echo $recset["sueltos"]; ?></td> 
                                    <td class="fcenter"><? echo number_format($recset["cantidad"],0); ?></td> 
                                    <td class="fcenter"><? echo fechalarga($recset["fecha"]); ; ?></td><?
                                    if (!isset($_GET["imprime"])){ ?> 
                                        <td class="fcenter"><? 
                                        
                                            if ($recset["repetido"]=="R"){ ?><a href="<? echo $autollamada."ex=4&ky=".$recset["idmaterial"]."|".$recset["titulo"]; ?>" class="fbutton fround fpadding-small"><small>Historial</small></a> <?} 
                                        ?></td> <? 
                                    }else{$vl_back=$autollamada."ex=1"; }?>


                                </tr> <? 
                                $r++; 
                            } 		 
                        }else{ echo "<tr><td colspan='11' class='fcenter fpadding-large'>No hay registros</td></tr>"; }        ?>    
                </table> 
            <? 


        
            break;        
    case 2:
        $vl_back=$autollamada."ex=1";	
        echo "<h3 class='fpadding-small fmargin fbold'>".$_SESSION["nivel"]."</h3>";
        $titulo="Claves <br>del inventario";      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 		 $arrescuela=explode("|",$_SESSION["escuela"]);   				switch ($_GET["vl_modoact"]){case 1: default: $tit="Agregando"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2; break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
        <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=3' onSubmit='return checa(5);' name='frmactual' method='post'>
            <input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
            <? $ancho=300;   $anchorotulos=160;   $color=".$fdeg.";			if($modo==1){ $titboton1="Agregar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
            <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                <? $rotulo='Clave'; $nombre='clave';  $valor=$arrescuela[1];   $tamano=6; $max_largo=10; //   text   ?>        <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?><input autofocus type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' value=''> <? } ?></td></tr>
                <? $rotulo="Cajas"; $nombre="cajas"; $tamano=5; $max_largo=5; $valor=$arr_mikey[0]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr>
                <? $rotulo="Sueltos"; $nombre="sueltos"; $tamano=5; $max_largo=5; $valor=$arr_mikey[0]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr>
                <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
            </table>  </strong>
        </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div>	<? break; 
    case 3:
        if (isset($_GET["eli"])){
            if (mysql_query("delete from inventario where idmaterial='".$_GET["clave"]."' and idinventario=".$_SESSION["idnivel"]." and idalmacen=".$_SESSION["vg_idalmacen"]." and estatus!='X'")){
                $banpas=1;
                fmessage("Clave eliminada ",2500,2,$autollamada."ex=1");
            }
        }else{    
            $res=mysql_query("select * from l_libros where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and estatus!='X'");
            if (mysql_num_rows($res)>0){
                $reclibros=mysql_fetch_array($res,MYSQL_ASSOC);

                $res=mysql_query("select * from inventario where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and idalmacen=".$_SESSION["vg_idalmacen"]." and ciclo='".$_SESSION["vg_cicloescolar"]."' and estatus!='X'");                
                

  
                $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                if (mysql_num_rows($res)>0){
                    if (mysql_query("update inventario set estatus='H' where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and idalmacen=".$_SESSION["vg_idalmacen"]." and ciclo='".$_SESSION["vg_cicloescolar"]."' and estatus='A'")){
                        mysql_query("insert into inventario values ('".$_POST["clave"]."',".$_SESSION["idnivel"].",".$_SESSION["vg_idalmacen"].",".$_POST["cajas"].",".$reclibros["primcajas"].",".$_POST["sueltos"].",".(($_POST["cajas"]*$reclibros["primcajas"])+$_POST["sueltos"]).",NOW(),'".$_SESSION["vg_cicloescolar"]."','A','R')");
                        fmessage("Clave Registrada otra vez",3500,2,$autollamada."ex=1");
                    }
                }else{
                    if (mysql_query("insert into inventario values ('".$_POST["clave"]."',".$_SESSION["idnivel"].",".$_SESSION["vg_idalmacen"].",".$_POST["cajas"].",".$reclibros["primcajas"].",".$_POST["sueltos"].",".(($_POST["cajas"]*$reclibros["primcajas"])+$_POST["sueltos"]).",NOW()-1,'".$_SESSION["vg_cicloescolar"]."','A','')")){
                        fmessage("Clave Registrada ",3500,2,$autollamada."ex=1");
                    }else{
                        fmessage("No registro",5500,2,$autollamada."ex=2");
                    }
                }    
            }else{ fmessage("Clave ".$_POST["clave"]."<br>de ".$_SESSION["nivel"]."<br>No válida",8500,2,$autollamada."ex=2"); }    
        }
        break;
    case 4:
        $vl_back=$autollamada."ex=1";	$arrky=explode("|",$_GET["ky"]);
        $_sql="select distinct a.*,b.ciclo,b.primcajas,b.titulo from inventario a,l_libros b WHERE a.idmaterial=b.idmaterial and a.idmaterial='".$arrky[0]."' and a.idnivel=".$_SESSION["idnivel"]." and a.idalmacen=".$_SESSION["vg_idalmacen"]." and b.idnivel=".$_SESSION["idnivel"]." and b.estatus!='X' and b.ciclo='".$_SESSION["vg_cicloescolar"]."' order by a.fecha desc"; 
//            	echo "<br><br><br><br><br><br><br><br<br><br<br><br><br><br>".$_sql; 
        $res=mysql_query($_sql);
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='fbold'>Inventario del nivel de ".$_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"]." )</h3>"; 		 
        $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------?>
        <br><br><br><br>
        <div class="frow">
            <br><h3>Historial de la clave <span class="fbold ftext-red"><? echo $arrky[0]."</span><br><strong><small class'fbol'>".$arrky[1]."</small></strong>";?></h3><br>
        </div>
        
            <table class="ftable-all fborder"> 
                
                <tr><th></th><th>Cajas</th><th>Ejem x caja</th><th>Sueltos</th><th>Total</th><th>Fecha</th></tr><? 
                    $r=0; 
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
                            $r++; 
                        } 		 
                    }else{ echo "<tr><td colspan='11' class='fcenter fpadding-large'>No hay registros</td></tr>"; }        ?>    
            </table> 
        <? 
        


        
            break;    


    case 10777777777777777777:
        $vl_back=$autollamada."ex=1";	
        $titulo="Buscando";      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 		 $arrescuela=explode("|",$_SESSION["escuela"]);   				switch ($_GET["vl_modoact"]){case 1: default: $tit="Agregando"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2; break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $titulo; ?></div></div><br><br> <? } 			if ($_SESSION['vg_w']==2){ ?> <div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div> <div id="seccionX" style="width:100%; display:none; height:100%"><? } ?>
        <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=4' onSubmit='return checa(2,<? echo $modo; ?>);' name='frmactual' method='post'>
            <input type="hidden" name="hid_buscado" value=0>
            <? $ancho=320;   $anchorotulos=228.57142857143;   $color=".$fdeg.";			if($modo==1){ $titboton1="Buscar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
            <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="fwhite">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$titulo."</h3></td></tr>"; } ?>
                <? $rotulo='# Pase'; $nombre='numpase';  $valor=$arrescuela[1];   $tamano=6; $max_largo=10; //   text   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?><input autofocus type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' value=''> <? } ?></td></tr>
                <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
            </table>  </strong>
        </form> 	<? if ($_SESSION['vg_w']==2){ ?> <script> 	$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterClose': function(){ location.replace('<? echo $vl_back; ?>'); } }); }); </script><? }else{ ?></div><? } ?>       	</div>	<? break; 




    case 157777777777777777:
        $vl_back=$autollamada."ex=1";
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$logeado."</h3>"; $subtit="<h3 class='fbold'>Conciliación de ".$_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"]." )</h3>"; 		 
        $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
        echo "<br><br><br>";
        $_sql="select h.*,if (isnull(z.recibido)=0,z.recibido,0) as recibido from (select distinct a.idmaterial,a.titulo,a.idtipomat,b.asignacion from l_libros a,l_concilia b where CONCAT(a.idmaterial,a.idnivel)=CONCAT(b.clave,b.idnivel) and b.ciclo='".$_SESSION["vg_cicloescolar"]."' and b.idalmadis=".$_SESSION["vg_idalmacen"]." and a.estatus!='X' and a.idnivel=".$_SESSION["idnivel"]." group by a.idmaterial) h LEFT JOIN (select idmaterial,sum(cantidad) as recibido from l_remisiondetalle where idnivel=".$_SESSION["idnivel"]." and ciclo='".$_SESSION["vg_cicloescolar"]."' and idalmacen=".$_SESSION["vg_idalmacen"]." and estatus='A' group by idmaterial) z ON h.idmaterial=z.idmaterial order by (h.idtipomat*1)";
        //        echo "<br><br><br><br><br><br><br><br><br>he dicho".$_sql; 

         mysql_query("set sql_big_selects=1");
        $res=mysql_query($_sql); 		$r=0; 
        if (mysql_num_rows($res)>0){ ?> 
                <table class="ftable-all fborder"> 
                    <tr><th></th><th>Clave</th><th>Titulo</th><th>Asignado</th><th>Recibido</th><th>Por recibir</th></tr><?    $totalasignado=0; $totalrecibido=0; $totalxrecibir=0;
                        while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); 
                            $nomarreglo=""; $caddatos=$recset[""]."|".$recset[""]; 	?> 
                            <tr> 
                                <td><small><? echo $r+1; ?></small></td> 
                                <td <? if (substr($recset["idmaterial"],0,2)=="SZ"){ echo "class='ftext-brown fbold'";} ?>><? echo $recset["idmaterial"]; ?></td> 
                                <td <? if (substr($recset["idmaterial"],0,2)=="SZ"){ echo "class='ftext-brown fbold'";} ?>><? echo $recset["titulo"]; ?></td> 
                                <td style="text-align:right" <? if ($recset["asignacion"]==$recset["recibido"]){ echo "class='ftext-green fbold'";}else{  if ($recset["recibido"]==0){ echo "class='ftext-red fbold'";}   } ?>><? echo number_format($recset["asignacion"],0); ?></td> 
                                <td style="text-align:right" <? if ($recset["asignacion"]==$recset["recibido"]){ echo "class='ftext-green fbold'";}else{  if ($recset["recibido"]==0){ echo "class='ftext-red fbold'";}   } ?>><? echo number_format($recset["recibido"],0); ?></td>
                                <td style="text-align:right" <? if ($recset["asignacion"]==$recset["recibido"]){ echo "class='ftext-green fbold'";}else{  if ($recset["recibido"]==0){ echo "class='ftext-red fbold'";}   } ?>><? echo number_format(($recset["asignacion"]-$recset["recibido"]),0); ?></td>
                            </tr> <? 
                                $totalasignado=$totalasignado+$recset["asignacion"];
                                $totalrecibido=$totalrecibido+$recset["recibido"];
                                $totalxrecibir=$totalxrecibir+($recset["asignacion"]-$recset["recibido"]);
                            	$r++; 
                        } ?>		 
                        <tr class="fdark-gray"><td colspan='3'>Total</td><td class='fright-align'><? echo number_format($totalasignado,0); ?></td><td class='fright-align'><? echo number_format($totalrecibido,0); ?></td><td class='fright-align'><? echo number_format($totalxrecibir,0); ?></td></tr> 
                </table> 
            <? 
        }else{ fmessage("No hay registros",2500,2); }

        break;
    }    


	?><br><br>
	<div class="fcenter fpadding-large fborder-top fmargin">
		<a name="saca" href="<? echo $vl_back;?>" class="hidden fbutton fshad fpadding-tiny fround"><h4 class="fmargin-left fmargin-right icon-left">&nbsp;Regresar</h4></a>
	</div><?
} ?>	
</body>
</html>