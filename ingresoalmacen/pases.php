<? session_start(); 	 $autollamada=basename(__FILE__). "?";   // Desarrollado por : L.I. Fernando Rodríguez Colorado 	wwww.sistemas-rc.com ?>
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
</SCRIPT>

</head>
<body class="fcenter"><?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');	conectalo("zona");



if (isset($_GET["n"])){ 
    $_SESSION["idnivel"]=$_GET["n"]; // perfil almacen
    $_SESSION["almacen"]=$logeado;
}else{
    if (isset($_POST["rdnivel"])){ $_SESSION["idnivel"]=$_POST["rdnivel"]; }  // perfil jefe
}

switch($_SESSION["idnivel"]){
    case 3: $_SESSION["nivel"]="Preescolar"; break;
    case 4: $_SESSION["nivel"]="Primaria"; break;
    case 6: $_SESSION["nivel"]="Secundaria"; break;
    case 7: $_SESSION["nivel"]="Telesecundaria"; break;
}


if ($_SESSION["vg_tipousuario"]=="almacen"){
    if ((!isset($_SESSION["almacen"]) && !isset($TxtUsuario))){
	    fmessage("Acceso No Permitido",1500,2,"../_panel.php");
    }    
}else{ 	
	if(!isset($_GET["ex"])){$_GET["ex"]=1;}
	switch ($_GET["ex"]){
	case 1:
        $vl_back="../_panel.php?papa=17";
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$_SESSION["almacen"]."</h3>"; $subtit="<h3 class='fbold'>Pases de ".$_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"]." )</h3>"; 		 
        $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------?>
        <br><br><br><br><div class="frow">
            <a href="<? echo $autollamada."ex=2";?>" class="fbold fpadding-small fround fbutton fpale-green icon-plus">&emsp;Registro&emsp;</a>
            <a href="<? echo $autollamada."ex=10";?>" class="fbold fpadding-small fround fbutton fpale-green icon-search">&emsp;Consulta&emsp;</a>
            <a href="<? echo $autollamada."ex=15";?>" class="fbold fpadding-small fround fbutton fpale-green icon-doc-text">&emsp;Conciliación&emsp;</a>
        </div><?
        $_sql="select a.*,count(b.idmaterial) as claves FROM l_remision a LEFT JOIN l_remisiondetalle b ON a.idremision=b.idremision WHERE a.idalmacen=".$_SESSION["vg_idalmacen"]." and a.idnivel=".$_SESSION["idnivel"]." and a.estatus!='X' group by a.idremision order by a.idremision desc"; 	//echo $_sql; 


        $res=mysql_query($_sql); 		$r=0; 
        if (mysql_num_rows($res)>0){ ?> 
            <div class="fix5 fshad fdeg fmargin"> 
                <table class="ftable-all fborder"> 
                    <tr><th></th><th></th><th>Número de pase</th><th>Fecha del pase</th><th>Fecha de registro</th><th># Claves</th></tr><? 
                        while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC);  ?>
                            <tr> 
                                <td class="fwhite fpadding-tiny">
                                    <a class="fbutton fround fpale-green fpadding-medium" href="<? echo $autollamada."ex=4&referencia=".$recset["referencia"]."&ky=".$recset["idremision"]; ?>">Detalle</a>
                                    <? if ($recset["claves"]==0){ ?>
                                            <small><a class="fbutton fround fpale-red fpadding-small icon-cancel" href="<? echo $autollamada."ex=3&eli&num=".$recset["idremision"]; ?>"></a></small>
                                    <? } ?>    
                                </td> 
                                <td class="fcenter"><small><? echo (mysql_num_rows($res)-$r); ?></small></td> 
                                <td class="fcenter"><? echo $recset["referencia"]; ?></td> 
                                <td><? echo fechalarga($recset["fecha"]);  ?></td> 
                                <td><? echo fechalarga($recset["fecha_reg"]);  ?></td> 
                                <td class="fcenter"><? echo $recset["claves"];  ?></td> 
                            </tr> <? 
                            $r++; 
                        } ?>		 
                        
                </table> 
            </div><? 
        }else{ fmessage("No hay registros",2500,2); }


        
         break;
    case 2:
			$vl_back=$autollamada."ex=1";	
			$titulo="Pases de ".$_SESSION["nivel"];      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 		 $arrescuela=explode("|",$_SESSION["escuela"]);   				switch ($_GET["vl_modoact"]){case 1: default: $tit="Agregando"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2; break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } 			if ($_SESSION['vg_w']==2){ ?> <div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div> <div id="seccionX" style="width:100%; display:none; height:100%"><? } ?>
			<form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=3' onSubmit='return checa(2,<? echo $modo; ?>);' name='frmactual' method='post'>
				<input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
				<? $ancho=320;   $anchorotulos=228.57142857143;   $color=".$fdeg.";			if($modo==1){ $titboton1="Agregar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
				<table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="fwhite">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
					<? $rotulo='No. Pase'; $nombre='numpase';  $valor=$arrescuela[1];   $tamano=6; $max_largo=10; //   text   ?>                 <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?><input autofocus type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown='return keynum(event);' value=''> <? } ?></td></tr>
                    <? $rotulo="Fecha recepción"; $nombre="txtfecha"; $valor=$arr_mikey[0]; $autofocus="NO"; //date ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; }else{ echo '</td><td>'; } ?><input required class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='date' name='<?echo $nombre;?>' id='<?echo $nombre;?>' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr>
                    <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
				</table>  </strong>
			</form> 	<? if ($_SESSION['vg_w']==2){ ?> <script> 	$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterClose': function(){ location.replace('<? echo $vl_back; ?>'); } }); }); </script><? }else{ ?></div><? } ?>       	</div>	<? break; 
    case 3:
        if (isset($_GET["eli"])){
            if (mysql_query("delete from l_remision where idremision=".$_GET["num"])){
                fmessage("Pase eliminado ",2500,2,$autollamada."ex=1");
            }
        }else{          
            $res=mysql_query("select max(idremision) as maximo from l_remision where estatus!='X'");
            $recset=mysql_fetch_array($res,MYSQL_ASSOC);
            $_SESSION["idremision"]=$recset["maximo"]+1;
            $_SESSION["referencia"]=$_POST["numpase"];
            if (mysql_query("insert into l_remision values ('".$_SESSION["vg_cicloescolar"]."',".$_SESSION["idremision"].",".$_SESSION["vg_idalmacen"].",".$_SESSION["idnivel"].",'".$_POST["numpase"]."','".$_POST["txtfecha"]."',NOW(),'A')")){
                fmessage("Pase Registrado ",2500,2,$autollamada."ex=4");
            }else{
                fmessage("NO REGISTRADO<br><small>Probablemente el pase ya este registrado</small> ",9500,2,$autollamada."ex=2");
            }
        }    
        break;
    case 4:
        $vl_back=$autollamada."ex=1&n=".$_SESSION["idnivel"];	
        if (isset($_POST["hid_buscado"])){
            $_sql="select * from l_remision WHERE idalmacen=".$_SESSION["vg_idalmacen"]." and referencia='".$_POST["numpase"]."' and idnivel=".$_SESSION["idnivel"]." and estatus!='X' and ciclo='".$_SESSION["vg_cicloescolar"]."'"; 
            //	echo $_sql; 
            $res=mysql_query($_sql);
            if (mysql_num_rows($res)>0){ 
                $recbus=mysql_fetch_array($res,MYSQL_ASSOC); 
                $_SESSION["idremision"]=$recbus["idremision"];
                $_SESSION["referencia"]=$_POST["numpase"];
            }else{
                $_SESSION["idremision"]=0;
                fmessage("Pase no encontrado<br>en el nivel de<br>".$_SESSION["nivel"],2500,2,$autollamada."ex=1");
            }    
        }else{
            if (isset($_GET["ky"])){$_SESSION["idremision"]=$_GET["ky"];  $_SESSION["referencia"]=$_GET["referencia"];}
        }
        $_sql="select j.*,k.* from (select a.idmaterial,a.cajas,a.ejemxcaja,a.sueltos,a.cantidad,b.titulo FROM l_remisiondetalle a,l_libros b WHERE CONCAT(a.idmaterial,a.idnivel)=CONCAT(b.idmaterial,b.idnivel) and a.idremision=".$_SESSION["idremision"]." and a.ciclo='".$_SESSION["vg_cicloescolar"]."' and a.estatus!='X' and b.ciclo='".$_SESSION["vg_cicloescolar"]."' and b.estatus!='X' group by a.idmaterial) j,(select e.clave,e.asignacion,sum(f.cantidad) as recibido from l_concilia e,l_remisiondetalle f where e.clave=f.idmaterial and e.idalmadis=".$_SESSION["vg_idalmacen"]." and e.idnivel=".$_SESSION["idnivel"]." and e.ciclo='".$_SESSION["vg_cicloescolar"]."' and e.estatus REGEXP 'A' and f.idalmacen=".$_SESSION["vg_idalmacen"]." and f.idnivel=".$_SESSION["idnivel"]." and f.ciclo='".$_SESSION["vg_cicloescolar"]."' and f.estatus REGEXP 'A' group by f.idmaterial) k where j.idmaterial=k.clave";
       // 	echo "<br><br><br><br><br><br><br><br<br><br<br><br><br><br>".$_sql; 

        $res=mysql_query($_sql);

        
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$_SESSION["almacen"]."</h3>"; $subtit="<h3 class='fbold'>".mysql_num_rows($res)." Libros del pase <span class='ftext-green'>".$_SESSION["referencia"]."</span> de ".$_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"]." )</h3>"; 		 
        $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------?>
        <br><br><br><br><div class="frow">
            <a href="<? echo $autollamada."ex=5";?>" class="fbold fpadding-small fround fbutton fpale-yellow icon-plus fmargin">&emsp;Agregar Clave&emsp;</a>
        </div>
        
            <table class="ftable-all fborder"> 
                <tr><th colspan="8">En este pase</th>
                    <!-- <th colspan="3" style="background:#851800">Conciliación actual</th> -->
                </tr>
                <tr><th></th><th></th><th>Clave</th><th>Titulo</th><th>Cajas</th><th>Ejem x caja</th><th>Sueltos</th><th>Total</th>
                <!-- <th style="color:yellow">Asignado</th><th style="color:yellow">Recibido</th><th style="color:yellow">Por recibir</th> -->
                 </tr><?  
                    $r=0; 
                    if (mysql_num_rows($res)>0){ 
                        while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); 
                            $nomarreglo="arrpase"; $caddatos=$recset["idremision"]."|".$recset["idnivel"]; 	?> 
                            <tr> 
                                <td class="fwhite">
                                    <!-- <small><a class="fbutton fround fpale-yellow fpadding-small" href="<? // echo $autollamada."ex=4&".$nomarreglo."=".oculta($caddatos,0); ?>">Detalle</a></small> -->
                                    <small><a class="fbutton fround fpale-red fpadding-small icon-cancel" href="<? echo $autollamada."ex=6&eli&clave=".$recset["idmaterial"]; ?>"></a></small>
                                </td> 
                                <td class="fcenter"><small><? echo ($r+1); ?></small></td> 
                                <td class="fcenter ftext-indigo"><? echo strtoupper($recset["idmaterial"]); ?></td> 
                                <td><? echo $recset["titulo"]; ?></td> 
                                <td class="fcenter"><? echo $recset["cajas"]; ?></td> 
                                <td class="fcenter"><? echo $recset["ejemxcaja"]; ?></td> 
                                <td class="fcenter"><? echo $recset["sueltos"]; ?></td> 
                                <td class="fcenter"><? echo number_format($recset["cantidad"],0); ?></td> 

                                <!-- <td style='text-align:right' <?  //if ($recset["asignacion"]==$recset["recibido"]){ echo "class='ftext-green fbold'";} ?>><? //echo number_format($recset["asignacion"],0); ?></td> 
                                <td style='text-align:right' <? //if ($recset["asignacion"]==$recset["recibido"]){ //echo "class='ftext-green fbold'";} ?>><? //echo number_format($recset["recibido"],0); ?></td> 
                                <td style='text-align:right' <? //if ($recset["asignacion"]==$recset["recibido"]){ echo "class='ftext-green fbold'";} ?>><? //echo number_format(($recset["asignacion"]-$recset["recibido"]),0); ?></td>  -->


                            </tr> <? 
                            $r++; 
                        } 		 
                    }else{ echo "<tr><td colspan='8' class='fcenter fpadding-large'>No hay registros</td></tr>"; }        ?>    
            </table> 
        <? 
        


        
            break;        
    case 5:
        $vl_back=$autollamada."ex=4";	
        echo "<h3 class='fpadding-small fmargin fbold'>".$_SESSION["nivel"]."</h3>";
        $titulo="Claves <br>del pase <span class='fbold' style='color:yellow'>".$_SESSION["referencia"]."</span>";      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 		 $arrescuela=explode("|",$_SESSION["escuela"]);   				switch ($_GET["vl_modoact"]){case 1: default: $tit="Agregando"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2; break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
        <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=6' onSubmit='return checa(5);' name='frmactual' method='post'>
            <input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
            <? $ancho=300;   $anchorotulos=160;   $color=".$fdeg.";			if($modo==1){ $titboton1="Agregar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
            <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                <? $rotulo='Clave'; $nombre='clave';  $valor=$arrescuela[1];   $tamano=6; $max_largo=10; //   text   ?>        <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?><input autofocus type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' value=''> <? } ?></td></tr>
                <? $rotulo="Cajas"; $nombre="cajas"; $tamano=5; $max_largo=5; $valor=$arr_mikey[0]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr>
                <!--     NO SE USO YA  <? $rotulo="Ejem x caja"; $nombre="ejemxcaja"; $tamano=5; $max_largo=5; $valor=$arr_mikey[0]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr> -->
                <? $rotulo="Sueltos"; $nombre="sueltos"; $tamano=5; $max_largo=5; $valor=$arr_mikey[0]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input class='fround' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr>
                <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
            </table>  </strong>
        </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div>	<? break; 
    case 6:
        if (isset($_GET["eli"])){
            if (mysql_query("delete from l_remisiondetalle where idremision=".$_SESSION["idremision"]." and idmaterial='".$_GET["clave"]."'")){
                fmessage("Clave eliminada ",2500,2,$autollamada."ex=4");
            }
        }else{    
            // ************************************************************************
            // En caso de que no se tenga el archivo de conciliacion y se tenga que empezar a capturar pases //
            // DESBLOQUEAR LO BLOQUEADO Y BLOQUEAR LO ACTUAL
            // **********************************************************************

            //$res=mysql_query("select * from l_libros where idmaterial='".$_POST["clave"]."' and idnivel=".$_SESSION["idnivel"]." and estatus!='X'");
            $sq="select f.*,g.* from (select distinct a.idmaterial,a.primcajas,b.asignacion from l_libros a,l_concilia b where a.idmaterial=b.clave and a.idmaterial='".$_POST["clave"]."' and a.idnivel=".$_SESSION["idnivel"]." and a.ciclo='".$_SESSION["vg_cicloescolar"]."' and a.estatus!='X' and  b.idalmadis=".$_SESSION["vg_idalmacen"]." and b.idnivel=".$_SESSION["idnivel"]." and b.ciclo='".$_SESSION["vg_cicloescolar"]."' and b.estatus REGEXP 'A') f LEFT JOIN (select idmaterial,sum(cantidad) as recibido from l_remisiondetalle where idalmacen=".$_SESSION["vg_idalmacen"]." and idnivel=".$_SESSION["idnivel"]." and ciclo='".$_SESSION["vg_cicloescolar"]."' and estatus REGEXP 'A' group by idmaterial) g ON f.idmaterial=g.idmaterial";
            $res=mysql_query($sq);
            //echo $sq;
            
            if (mysql_num_rows($res)>0){
                if ($_POST["cajas"]==""){$lascajas=0;}else{$lascajas=$_POST["cajas"];}
                //if ($_POST["ejemxcaja"]==""){$losejem=0;}else{$losejem=$_POST["ejemxcaja"];}

                // if (mysql_query("insert into l_remisiondetalle values ('".$_SESSION["vg_cicloescolar"]."',".$_SESSION["idremision"].",".$_SESSION["vg_idalmacen"].",".$_SESSION["idnivel"].",'".$_POST["clave"]."',".$lascajas.",".$losejem.",".$_POST["sueltos"].",".(($_POST["cajas"]*$_POST["ejemxcaja"])+$_POST["sueltos"]).",NOW(),'A')")){
                //    fmessage("Clave Registrada ",2500,2,$autollamada."ex=4");
                // }

                // --- bloquar esto en el caso de......    
                $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                if (($recset["asignacion"]-$recset["recibido"])==0){
                        fmessage("De la clave<br>".$_POST["clave"]."<br>ya se registró<br>el total de su<br>asignación<br>".number_format($recset["asignacion"],0),30000,2,$autollamada."ex=5");
                }else{
                    if ((($_POST["cajas"]*$_POST["ejemxcaja"])+$_POST["sueltos"]) > ($recset["asignacion"]-$recset["recibido"])){
                       fmessage("Sólo se puede <br>registrar<br>".number_format(($recset["asignacion"]-$recset["recibido"]),0)."<br>libros de la clave<br>".$_POST["clave"],30000,2,$autollamada."ex=5");
                    }else{
                        if (mysql_query("insert into l_remisiondetalle values ('".$_SESSION["vg_cicloescolar"]."',".$_SESSION["idremision"].",".$_SESSION["vg_idalmacen"].",".$_SESSION["idnivel"].",'".$_POST["clave"]."',".$lascajas.",".$recset["primcajas"].",".$_POST["sueltos"].",".(($_POST["cajas"]*$recset["primcajas"])+$_POST["sueltos"]).",NOW(),'A')")){
                           // echo "insert into l_remisiondetalle values ('".$_SESSION["vg_cicloescolar"]."',".$_SESSION["idremision"].",".$_SESSION["vg_idalmacen"].",".$_SESSION["idnivel"].",'".$_POST["clave"]."',".$lascajas.",".$losejem.",".$_POST["sueltos"].",".(($_POST["cajas"]*$_POST["ejemxcaja"])+$_POST["sueltos"]).",NOW(),'A')";
                           fmessage("Clave Registrada ",2500,2,$autollamada."ex=4");
                        }
                    }    
                }    
                //------
            }else{ fmessage("Clave ".$_POST["clave"]."<br>de ".$_SESSION["nivel"]."<br>No válida",8500,2,$autollamada."ex=5"); }    
        }
        break;



    case 10:
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




    case 15:
        if (isset($_GET["jef"])){
            $vl_back=$autollamada."ex=51";
        }else{
            $vl_back=$autollamada."ex=1";
        }

        
        // ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
        $TItulo="<h3 class='fbold ftext-red'>Almacen ".$_SESSION["almacen"]."</h3>"; $subtit="<h3 class='fbold'>Conciliación de ".$_SESSION["nivel"]."&emsp;( ".$_SESSION["vg_cicloescolar"]." )</h3>"; 		 
        $LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
        // -----------------------------------------------------------------------------------------------------------------------------------------------------
        echo "<br><br><br><br>";
        $_sql="select h.*,if (isnull(z.recibido)=0,z.recibido,0) as recibido from (select distinct a.idmaterial,a.titulo,a.idtipomat,b.asignacion from l_libros a,l_concilia b where CONCAT(a.idmaterial,a.idnivel)=CONCAT(b.clave,b.idnivel) and b.ciclo='".$_SESSION["vg_cicloescolar"]."' and b.idalmadis=".$_SESSION["vg_idalmacen"]." and a.estatus!='X' and a.idnivel=".$_SESSION["idnivel"]." group by a.idmaterial) h LEFT JOIN (select idmaterial,sum(cantidad) as recibido from l_remisiondetalle where idnivel=".$_SESSION["idnivel"]." and ciclo='".$_SESSION["vg_cicloescolar"]."' and idalmacen=".$_SESSION["vg_idalmacen"]." and estatus='A' group by idmaterial) z ON h.idmaterial=z.idmaterial order by (h.idtipomat*1)";
               // echo "<br><br><br>he dicho".$_sql."<br><br>"; 
        // Analista de datos : L.I. Alberto Domingo Hwrnandez Martinez
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


    case 50:
        if ($_SESSION["vg_tipousuario"]=="almacen"){
            $vl_back=$autollamada."ex=1";	
        }else{
            $vl_back="../_panel.php";	
        }
        echo "<h3 class='fpadding-small fmargin fbold'>Avance de la recepción de libros</h3>";
        $titulo="Almacen";      switch ($_GET["vl_modoact"]){case 1: default: $tit="Seleccione<br>"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2;    $arrmodif=explode("|",$_GET["arrmod"]); break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
        <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=51' onSubmit='return checa(1);' name='frmactual' method='post'>
            <? $ancho=300;   $anchorotulos=160;   $color=".$fdeg.";			$titboton1="Continuar"; $titboton2=""; ?> <strong>
            <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                <tr><td><? 
                    $radnombre="rdalmacen"; 	 			$tabla="almacen_c"; $campkey="idalmacen"; $camptex="almacen"; $cond=""; 							$vl_res=mysql_query("select ".$campkey.",".$camptex." from ".$tabla.$cond); $valores=""; $texval=""; while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ $valores=$valores.$recset[$campkey]."|"; $texval=$texval.$recset[$camptex]."|"; } $valores=substr($valores,0,strlen($valores)-1); $texval=substr($texval,0,strlen($texval)-1);										$arrval=explode("|",$valores); $arrtex=explode("|",$texval); 					for ($i=0; $i < count($arrval); $i++) { ?>						<input style='margin:7px 3px' type='radio' name='<?echo $radnombre;?>' value='<?echo $arrval[$i];?>'>&nbsp;&nbsp;<? echo $arrtex[$i].'<br>'; 							} ?>				
                    </td></tr>	
                <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
            </table>  </strong>
        </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div><?
        break;
    case 51:
        if (isset($_POST["rdalmacen"])){ 
            $_SESSION["vg_idalmacen"]=$_POST["rdalmacen"]; 
            $vl_res=mysql_query("select almacen from almacen_c where idalmacen=".$_SESSION["vg_idalmacen"]);
            $recset=mysql_fetch_array($vl_res,MYSQL_ASSOC);			
            $_SESSION["almacen"]=$recset["almacen"];
        }
        $vl_back=$autollamada."ex=50";	
        echo "<h3 class='fpadding-small fmargin fbold'>Avance de la recepción de libros</h3>";
        echo "<h3 class='fpadding-small fmargin fbold'>Almacén ".$_SESSION["vg_almacen"]."</h3>";
        $titulo="Nivel";      switch ($_GET["vl_modoact"]){case 1: default: $tit="Seleccione<br>"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2;    $arrmodif=explode("|",$_GET["arrmod"]); break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
        <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=15&jef' onSubmit='return checa(1);' name='frmactual' method='post'>
            <? $ancho=300;   $anchorotulos=160;   $color=".$fdeg.";			$titboton1="Continuar"; $titboton2=""; ?> <strong>
            <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                <tr><td><? 
                    $valores="3|4|6|7";   $texval="Preescolar|Primaria|Secundaria|Telesecundaria";
                    $radnombre="rdnivel"; 	 			$arrval=explode("|",$valores); $arrtex=explode("|",$texval); 					for ($i=0; $i < count($arrval); $i++) { ?>						&emsp;<input style='margin:7px 3px' type='radio' name='<?echo $radnombre;?>' value='<?echo $arrval[$i];?>'>&nbsp;&nbsp;<? echo $arrtex[$i].'<br>'; 							} ?>

                    </td></tr>	
                <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
            </table>  </strong>
        </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div><?
        break;



    }    


	?><br><br>
	<div class="fcenter fpadding-large fborder-top fmargin">
		<a href="<? echo $vl_back;?>" class="hidden fbutton fshad fpadding-tiny fround"><h4 class="fmargin-left fmargin-right icon-left">&nbsp;Regresar</h4></a>
	</div><?
} ?>	
</body>
</html>