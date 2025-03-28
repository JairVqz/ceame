<? session_start(); date_default_timezone_set("America/Mexico_City"); require_once("_inc/__conectaBD.php");    $fp = fopen("_inc/__conectaBD.txt", "r");    $arr_conex=explode("|",fread($fp,filesize ("_inc/__conectaBD.txt")));      fclose($fp);   	conectalo($arr_conex[1],$arr_conex[0]);    $autollamada=basename(__FILE__). "?";    $vl_back=fmiback($_SERVER['REQUEST_URI']);  ?>
<!doctype html>    <html lang="es">
<head>
	<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>asfasfasfas</title>
	<link rel="stylesheet" href="_css/frc.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="_css/frcico.css" type="text/css" media="screen" />
	<script type="text/javascript" src="_inc/fancy217/lib/jquery-1.10.2.min.js"></script>	<script type="text/javascript" src="_inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>	<link rel="stylesheet" type="text/css" href="_inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<script type="text/javascript" src="_js/funcfme.js"></script>
	<SCRIPT TYPE="text/javascript"> 
	function checa(modo,actual){var m=document.getElementById("error");    var a=document.frmactual;
		switch (modo){
		case 1:
			if(!document.querySelector('input[name="sexo"]:checked')) {				t="Marque por lo menos una opci&oacute;n"; m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";				setTimeout ("x()", 2000);    return false;			}
			if(!document.querySelector('input[name="color[]"]:checked')) {				t="Marque por lo menos una opci&oacute;n"; m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";				setTimeout ("x()", 2000);    return false;			}
		break; 
		}
	}
	var loadFile = function(event,id) {		var output = document.getElementById(id);		output.src = URL.createObjectURL(event.target.files[0]);	}
	</SCRIPT>
</head>
<body class='fcenter'>
<?  $logeado=1; // esto funciona solo para pruebas ok 
if (isset($_GET["pap"])){$_SESSION["pap"]=$_GET["pap"];}      $arr_papa=explode("|",$_SESSION["pap"]);		$banfan=1;
 if ((!isset($logeado) && !isset($TxtUsuario))){ fmessage("No autorizado",2500,2,$vl_back); }else{ 
if (!isset($ex)){ $ex=1; }
switch ($ex){ 
case 1: 
	if (isset($buscando)){ 	?><div><a class="fancybox-frcform" id="hiddensec" href="#seccionY" style="display:none">Click</a></div> 	<div id="seccionY" style="width:100%; display:none; height:100%"> <form enctype='multipart/form-data' action='<? echo $autollamada."ex=1";?>' name='frmfancy' method='post' style="height:100%"> <table width="100%" cellpadding="15" cellspacing="0" border="0" class="fborder fround"><tr class="fmargin-bottom"><th colspan="2" style="vertical-align:middle; font-size:26px; background:#5F5F5F; color:white; padding:4px 25px;"><? echo $_GET["buscando"]; ?></strong></th></tr> <tr><td colspan="2" align="center"><input type='text' name='buscado' autofocus required size='15'></td></tr> 	<tr><td colspan="2" class='fcenter fpadding-large' align='center'><input type=submit name="resp1" value=' Aceptar ' class='fpadding-small' style="font-size:20px"> </td></tr>			</table></form></div><script>$(window).load(function(){ $('#hiddensec').trigger('click'); });$(document).ready(function() { $('.fancybox-frcform').fancybox( {'autoSize' : true, 'closeBtn': true, helpers:{overlay: { closeClick: false }}, keys:{ close: null }, 'afterClose': function(){ location.replace('<? echo $autollamada."ex=1"; ?>'); } }); }); </script> <? 
	}else{ 
		$laconsulta="select a.idborra,a.sexo,a.color from borra a where a.estatus='A'"; // agregar lo necesario 
			if(isset($_POST['buscado'])){  $campobusqueda="color"; 	$laconsulta.=" and a.".$campobusqueda." regexp '".$_POST['buscado']."'"; } 
		//  echo "<br>".$laconsulta;  //---------------------------   BANNER ENCABEZADO ------------------------------------------------------------------------------  
		$TItulo="<h3 class='fbold ftext-red'>asfasfasfas</h3>"; $subtit="<h4></h4>"; 
		$LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg=""; $imgancho=""; $lgagrega=$autollamada."ex=2&vl_modoact=1"; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca); 
		// ------------------------------------------------------------------------------------------------------
		$vl_res=mysql_query($laconsulta);    $vl_regs=mysql_num_rows($vl_res);     if(!isset($_POST['buscado'])){$_SESSION["totalregistros"]=$vl_regs; } 
		if ($vl_regs>0){
			if($_SESSION['vg_w']==1){ echo "<br>"; } ?>
			<div class="fix7 fshad fdeg">
				<table class='ftable-all fborder'> 
					<tr>
						<th colspan="2"><th>Sexo</th><th>Color</th>
					</tr> <?  $r=0;  
				while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ 
					$pm_=$recset["idborra"]."|".$recset["sexo"]."|".$recset["color"]; ?>
					<tr style="<? echo $rcolor; ?>">
						<!--<td class="fwhite" style="font-size:20px; vertical-align:middle" width="10"><a class="icon-plus" style="color:#B29200;" href="<? echo $autollamada; ?>ex=2&vl_modoact=9&pm_=<? echo oculta($pm_,0); ?>"></a></td>-->
						<td class="fwhite" style="font-size:20px; padding:3px; vertical-align:middle" width="10"><a class="icon-pencil" style="color:#B29200;" href="<? echo $autollamada; ?>ex=2&vl_modoact=2&pm_=<? echo oculta($pm_,0); ?>"></a></td>
						<td class="fwhite" style="font-size:20px; padding:3px; vertical-align:middle" width="10"><a class="icon-trash-empty" style="color:#A11C00;" href="<? echo $autollamada; ?>ex=3&ky=<? echo $recset["idborra"]; ?>"></a></td>
						<td><? echo $recset["sexo"]; ?></td>
						<td><? echo $recset["color"]; ?></td>
					</tr><?    $r++;   if ($r==100){break;}   
				} ?>  </table>  
			</div>   <?  
		}else{ ?><br> <h4 class="fcenter fbold fpadding-large ftext-purple fborder fround fmargin"><i>No existen registros</i></h4><br><a class="fbutton icon-plus" href="<? echo $lgagrega; ?>">Agregar</a><? }
	}
	break;
case 2: 
		$quitare = array_pop($_SESSION["atras"]);
		$titulo="asfasfasfas";      if(isset($_GET['pm_'])){ $_SESSION[""]=oculta($_GET["pm_"],1); } 		 $arr=explode("|",$_SESSION[""]);   				switch ($_GET["vl_modoact"]){case 1: default: $tit="Agregando"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2; break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } 			if ($_SESSION['vg_w']==2){ ?> <div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div> <div id="seccionX" style="width:100%; display:none; height:100%"><? } ?>
		<form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=3' onSubmit='return checa(1,<? echo $modo; ?>);' name='frmactual' method='post' align='left'>
			<input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
			<? $ancho=800;   $anchorotulos=228.57142857143;   $color=".$fdeg.";			if($modo==1){ $titboton1="Agregar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
			<table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="fwhite">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround fcenter'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
				<? $rotulo='Sexo'; $nombre='sexo';  $valor=$arr[1];   //   radio   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';   }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?> &emsp;<input type='radio' class="fradio" name='<?echo $nombre;?>'  id='<?echo $nombre;?>' value='masculino'<? if ($valor=="masculino"){echo " checked";}?>> masculino<br>&emsp;<input type='radio' class="fradio" name='<?echo $nombre;?>'  id='<?echo $nombre;?>' value='femenino'<? if ($valor=="femenino"){echo " checked";}?>> femenino<br>&emsp;<input type='radio' class="fradio" name='<?echo $nombre;?>'  id='<?echo $nombre;?>' value='gay'<? if ($valor=="gay"){echo " checked";}?>> gay		<? } ?></td></tr>
				<? $rotulo='Color'; $nombre='color';  $valor=$arr[2];   //   checkbox   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';   }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?><small><em style="color:#E36401">Se puede seleccionar m&aacute;s de una opci&oacute;n</em></small><br>&emsp;<input type='checkbox' name='<?echo $nombre;?>[]'  id='<?echo $nombre;?>[]' class='fround' value='rojo'> rojo<br>&emsp;<input type='checkbox' name='<?echo $nombre;?>[]'  id='<?echo $nombre;?>[]' class='fround' value='verde'> verde<br>&emsp;<input type='checkbox' name='<?echo $nombre;?>[]'  id='<?echo $nombre;?>[]' class='fround' value='azul'> azul<br>&emsp;<input type='checkbox' name='<?echo $nombre;?>[]'  id='<?echo $nombre;?>[]' class='fround' value='gris'> gris		<? } ?></td></tr>
			  														<? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
			</table>  </strong>
		</form> 	<? if ($_SESSION['vg_w']==2){ ?> <script> 	$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterClose': function(){ location.replace('<? echo $vl_back; ?>'); } }); }); </script><? }else{ ?></div><? } ?>       	</div>	<? break; 
case 3:       
	$quitare = array_pop($_SESSION["atras"]);
	if (isset($_POST["hid_modoact"])){
		if($_POST["hid_modoact"]=='1'){
			
$ban_checkbox="";		foreach($_POST['color'] as $selected){ $ban_checkbox.=$selected.","; }   $ban_checkbox=substr($ban_checkbox, 0, -1); 
						$res=mysql_query("select max(idborra) as ultimo from borra");        $recset=mysql_fetch_array($res,MYSQL_ASSOC);    $vl_ultimo=$recset["ultimo"]+1;
			$query="insert into borra (idborra,sexo,color,estatus) ";
			$query .="values ($vl_ultimo,'".$_POST["sexo"]."','".$ban_checkbox."','A')";  	$vl_tit="Se ha registrado";    $colormsg="fgreen";    $colortextmsg="ftext-green";   //$vl_tit=$query;  
		}else{
						$arr=explode("|",$_SESSION[""]);
			$query="update borra set sexo='".$_POST["sexo"]."',color='".$_POST["color"]."'".$banupload." where idborra=".$arr[0];  
						$vl_tit="Se ha actualizado";     $colormsg="forange";     $colortextmsg="ftext-orange";    //$vl_tit=$query;  
		}
		mysql_query($query);
	}else{
		if (!isset($answer)){ fquestion("Se eliminará el registro?",$autollamada."ex=".$_GET["ex"]."&ky=".$_GET["ky"]."&answer",2); 
		}else{	 
			if (isset($_POST['respyes'])) {	 
				$query="update borra set estatus='X' where idborra=".$_GET["ky"];	 
				if (mysql_query($query)){ $vl_tit="Se ha eliminado"; }	 
			}else{ fquit($vl_back);	}	 
		}
	}
	fmessage($vl_tit,1500,2,$vl_back);  	break; 
} // fin del Case de ejecucion <br>
if ($banfan==0){?> <div class="fcontainer fcenter fgray"><div class="fbutton fshad fmargin"><a href="<? echo $vl_back; ?>">Regresar</a></div></div>  <?}
}   // FIN DE ACCESO NO PERMITIDO ?> 
</body></html>
