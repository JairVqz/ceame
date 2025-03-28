<? session_start(); 	 $autollamada=basename(__FILE__). "?"; ?>
<!DOCTYPE html>
<html><head>

<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Libros Veracruz - Validación</title><link rel="shortcut icon" href="../images/libro_titulo3.png">
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  
<!-- <SCRIPT TYPE="text/javascript" src="../js/_funciones14.js"></SCRIPT> -->
<SCRIPT TYPE="text/javascript" src="../js/funcfme.js"></SCRIPT>
<script type="text/javascript" src="../inc/fancy217/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<SCRIPT TYPE="text/javascript"> 
	function checa(modo,soloparaesteprog=0){var m=document.getElementById("error");    var a=document.frmescogido;
		switch (modo){
		case 51:
			if(!document.querySelector('input[name="grado[]"]:checked')) {				t="Especifique grados"; m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";				setTimeout ("x()", 2000);    return false;			}
   		break; 
		case 52:
			for (index = 0; index < soloparaesteprog; index++) {
				if(!document.querySelector('input[name="gradosmaestro'+index+'[]"]:checked')) {				t="Especifique grados del Docente "+(index+1); m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";				setTimeout ("x()", 2000);    return false;			}
			}
			break;
		}
	}
	
	</SCRIPT>

</head>
<body class="fcenter"><?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');	conectalo("zona");
if ((!isset($logeado) && !isset($TxtUsuario))){
	fmessage("Acceso No Permitido",1500,2,"../_panel.php");
}else{ 	
	if(!isset($_GET["ex"])){$_GET["ex"]=1;}
	switch ($_GET["ex"]){
	case 1:	 
		$vl_back="../_panel.php";
		if (isset($_GET["validado"]) || $_SESSION["vg_valid_nuevoreg"]>0){
			fquit($autollamada."ex=10");
		}else{	
			// ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
			$TItulo="<h3 class='fbold ftext-red'>Registro de datos de la Supervisión ".$_SESSION["vg_cct_zona"]."&emsp;&emsp;".$_GET["nivel"]."</h3>"; $subtit="Requeridos para la actualización de la información"; 		 
			$LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg=""; $imgancho=""; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
			// -----------------------------------------------------------------------------------------------------------------------------------------------------

			$modo=1;
			$ancho=1000; $anchorotulos=220; $liga=$autollamada."ex=".($_GET["ex"]+1); $titulo="Captura"; $tit_color="yellow"; $tit_size=20; $titboton1="Registrar"; $titboton2="Borrar"; ?> 
			<form enctype='multipart/form-data' action='<? echo $liga;?>' onSubmit='return checa(1);' name='frmactual' method='post' class="fshad fbold"> <input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
				<table class="ftable-all" style="max-width:<? echo $ancho; ?>px; min-width:<? $ancho; ?>px;"> <tr><th colspan="2" class="fpadding-medium fcenter" style="font-size:<? echo $tit_size; ?>px; color:<? echo $tit_color; ?>;"><strong><? echo $titulo; ?></strong></th></tr> <? 
						// ---------     seleccion de Municipio y Localidad -----------------

						// Seleccion 2 elementos CATALOGOS en tabla 
						$id1="idmunicipio"; $dato1="municipio"; $tab1="municipio_c"; $rotulo1="<small>Seleccione</small> Municipio"; 		$camporelacioncon_id1="municipio"; 	$id2="localidad"; $dato2="nombreloc"; $tab2="ctsev";	$rotulo2="<small>Seleccione</small> Localidad"; 	 $vapara=$_SERVER['REQUEST_URI']; if (isset($_GET["selone"])){ $_SESSION["selone"]=$_GET["selone"]; } ?><script>function selecciona1(x){ location.replace('<? echo $_SERVER['REQUEST_URI']."&"; ?>selone='+document.getElementById("seluno").options[document.getElementById("seluno").selectedIndex].value);	}</script> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo1; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><select autofocus name='seluno' id='seluno' onChange="selecciona1();"><option value=0></option> <? $vl_res=mysql_query("select distinct a.".$id1.",a.".$dato1." from ".$tab1." a where a.".$id1.">0 order by a.".$dato1);	while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ if ($recset[$id1]."|".trim($recset[$dato1])==$_SESSION["selone"]){$ban=" selected";}else{$ban="";} echo "<option value='".$recset[$id1]."|".$recset[$dato1]."'".$ban.">".$recset[$dato1]."</option>"; } ?> </select></td></tr> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo2; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><? if (isset($_SESSION["selone"])){ $arr_one=explode("|",$_SESSION["selone"]); $_SESSION["seltwo"]=""; ?> <script>function selecciona2(x){ location.replace('<? echo $vapara."&"; ?>seltwo='+document.getElementById("seldos").options[document.getElementById("seldos").selectedIndex].value); }</script> <select autofocus name='seldos' id='seldos' onChange="selecciona2();"><option value=0></option> <? $vl_res=mysql_query("select distinct a.".$id2.",a.".$dato2." from ".$tab2." a where a.".$camporelacioncon_id1."=".$arr_one[0]." order by a.".$dato2); while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ if ($recset[$id2]."|".trim($recset[$dato2])==$_GET["seltwo"]){$ban=" selected";}else{$ban="";} echo "<option value='".$recset[$id2]."|".$recset[$dato2]."'".$ban.">".$recset[$dato2]."</option>"; } ?></select><? }else{ ?> <select name='sinvalor'></select> <? } if (isset($_GET["seltwo"])){ $_SESSION["seltwo"]=$_GET["seltwo"]; } ?></td></tr><? 

						//--------------------------------------------------------------------------------- */
						$tamano=15; $max_largo=50; $valor_paterno="";  $valor_materno="";  $valor_nombre="";   $autofocus="NO"; //text ?> <tr><td style="vertical-align:middle" width='<? echo $anchorotulos; ?>'>Nombre del supervisor <? if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?>
						<input style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='paterno' id='paterno' placeholder="Paterno" size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor_paterno."'";} ?>>
						<input style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='materno' id='materno' placeholder="Materno" size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor_materno."'";} ?>>
						<input style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='nombre' id='nombre' placeholder="Nombre(s)" size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor_nombre."'";} ?>>

					</td></tr><?

					$rotulo="Dirección de la zona"; $nombre="direccion"; $tamano=30; $max_largo=60; $valor=$arr_mikey[0]; $autofocus="NO"; //text ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input required style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr><?
					$rotulo="Teléfono <small>(Sin espacios)</small>"; $nombre="telefono"; $tamano=12; $max_largo=10; $valor=$arr_mikey[0]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input required style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' onKeyDown='return keynum(event);' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr><?
					$rotulo="Correo"; $nombre="correo"; $tamano=30; $max_largo=60; $valor=$arr_mikey[0]; $autofocus="NO"; //text ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input required style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr><?
						?><tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr> 
					<tr><td colspan='2' class='fdark-gray fcenter fpadding-small' align='center'><input type=submit value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type=reset value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr> 
				</table> 
			</form> 
			<? 
		}
		break; 
	case 2:	 
		$vl_back=$autollamada."ex=1&validado";
		$vl_tabla="supervis_c"; 
		if (isset($_POST["hid_modoact"])){ 
			// if($_POST["hid_modoact"]=='1'){ 
			// 	$query="insert into $vl_tabla () "; 
			// 	$query .="values ()"; 	$vl_tit="Se ha registrado"; //$vl_tit=$query; 
			// 	$sehizo=mysql_query($query); 
			// }else{ 
				$arr_municipio=explode("|",$_SESSION["selone"]);
				$arr_localidad=explode("|",$_SESSION["seltwo"]);

				$query="update $vl_tabla set valid_municipio=".$arr_municipio[0].",valid_loc=".$arr_localidad[0].", valid_paterno='".$_POST["paterno"]."',valid_materno='".$_POST["materno"]."',valid_nombre='".$_POST["nombre"]."',valid_direccion='".$_POST["direccion"]."',valid_telefono='".$_POST["telefono"]."',valid_correo='".$_POST["correo"]."',valid_nuevoreg=1 where cuenta='".$_SESSION["vg_cct_zona"]."'"; 
				$vl_tit="Se ha actualizado"; //$vl_tit=$query; 
				if (mysql_query($query)){$_SESSION["vg_valid_nuevoreg"]=1;}; 
			// } 
		}else{ 
			if (!isset($answer)){ fquestion("Se eliminará",$autollamada."ex=".$_GET["ex"]."&ky=".$_GET["ky"]."&answer",2);	} 
			else{ 	 
				if (isset($_POST['respyes'])) { 
					$query="update $vl_tabla set estatus='X' where =".$_GET["ky"]; 
					if (mysql_query($query)){ $vl_tit="Se ha eliminado"; }	 
				}else{ fquit($vl_back);	}	 
			} 
		} 
		fmessage($vl_tit,1500,2,$vl_back);	 
	break;





	case 10:
		$_SESSION["back"]=$_SERVER['REQUEST_URI'];
		$vl_back="../_panel.php";
		// esto porque algunas zonas atienden a escuelas de diferentes niveles 
		if ($_SESSION["vg_idnivelunicosupervisor"]<10 && !isset($_GET["seleccionado"])){ 	
			// ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
			$TItulo="<h3 class='fbold ftext-red'>Zona Escolar ".$_SESSION["vg_cct_zona"]."</h3>"; $subtit=""; 		 
			$LGback=$vl_back; $fijoSINO="NO"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="800"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
			// -----------------------------------------------------------------------------------------------------------------------------------------------------
			if (isset($_SESSION["vg_estatusvalidaciononiveles"])){$noniveles=str_replace("|",",",$_SESSION["vg_estatusvalidaciononiveles"]); }else{$noniveles="";}
			//echo "esto es".$noniveles;
			flista_niveles($autollamada."ex=10&seleccionado","",$noniveles); 
		}else{ 
			if ($_SESSION["vg_idnivelunicosupervisor"]<10){
					$arrnivel=explode("|",$_GET["arr_nivel"]);
					$elidnivel=$arrnivel[0];
					$elnivel=$arrnivel[1];

					$bancond="&arr_nivel=".$_GET["arr_nivel"];
			}else{
					$bancond="&arr_nivel=".$_SESSION["vg_idnivelunicosupervisor"]."|".$_SESSION["vg_nivelunicosupervisor"];
					$elidnivel=$_SESSION["vg_idnivelunicosupervisor"];
					$elnivel=$_SESSION["vg_nivelunicosupervisor"];
			}	
			// ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
			$TItulo="<h3 class='fbold ftext-red'>".$_GET["nivel"]."</h3>"; $subtit="<h3 class='fbold'>Validación de centros de trabajo de la zona ".$_SESSION["vg_cct_zona"]."</h3>"; 		 
			$LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg="../images/logo_SEVGob.png"; $imgancho="600"; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
			// -----------------------------------------------------------------------------------------------------------------------------------------------------?>
			<h4 class="fpadding-medium fbold"><i>FAVOR DE LEER LAS INSTRUCCIONES </i>&emsp;&emsp;&emsp;&emsp;
				<span class="fbold ftext-red"><? echo $elnivel; ?></span>&emsp;&emsp;&emsp;&emsp;<span class="fbold">Fecha limite : 28 de junio de 2023
			</h4> 
			



			
				<?   $condicion_extra=" and estatus='' ";
				$columna1="Activa|".$autollamada."ex=13&estat=A|<small>Recibe libros</small>|#CDFFB9";	//Boton|liga|Columna|color
				$columna2="Inactiva|".$autollamada."ex=13&estat=I|<small>No recibe libros</small>|#F8DFDF";	//Boton|liga|Columna|color
				$columna3="Cambio|".$autollamada."ex=14&estat=C|<small>Cambio zona</small>|#ECF5B4";	//Boton|liga|Columna|color
				$titescuelazona="<h4 class='fbold fpadding-medium fmargin-bottom'>Para cada una de las escuelas, especifique con un click en los botones de colores, su situación</h4>";
				if (flista_escuelas_zona_nivel($_SESSION["vg_cct_zona"],$elidnivel,$condicion_extra,$columna1,$columna2,$columna3,$titescuelazona)==0){
					echo "<div class='fyellow fpadding-large'><h3 class='fpadding-large fbold'>La etapa de la validación<br>se ha completado</h3>
					<a class='fbutton flight-gray fshad fpadding-medium fround fbold' href='".$autollamada."ex=11".$bancond."<h3 class='fbold'>Ver el resultado de la validación</h3></a></div>"; 
					
					 	 
					$rescheck=mysql_query("select * FROM ctsev WHERE cct_zona='".$_SESSION["vg_cct_zona"]."' and estatus='A' and multigrado=0 and idnivel=".$elidnivel);
					if (mysql_num_rows($rescheck)>0){					?>
						<h3 class="fpadding-large fbold fmargin-top">De las escuelas que validó como Activas, especifique <span class="ftext-green"> sólo </span> las Multigrado</h3>
						<!-- <a class="fbutton flight-gray fshad fpadding-medium fround fbold ftext-red" href="<? //echo $autollamada."ex=50".$bancond; ?>"><h3 class="fbold">Validar ahora Escuelas Multigrado</h3></a>  -->
						<?   $condicion_extra=" and estatus='A' and multigrado=0 ";
						$columna1="Seleccione|".$autollamada."ex=51|Si es Multigrado|#CDFFB9";	//Boton|liga|Columna|color
						if (flista_escuelas_zona_nivel($_SESSION["vg_cct_zona"],$elidnivel,$condicion_extra,$columna1)==0){
					//   NO DEBE IR 	echo "<br><br><br><br><h3 class='fpadding-large fbold fyellow'>Se ha completado la segunda etapa de la validación</h3>";
						}
					}	 ?>
					<br><br>
						<?
						mysql_query("set sql_big_selects=1");
						$_sql="select a.* FROM ctsev_multigrado23 a,ctsev b WHERE a.cct=b.cct and a.turno=b.turno and b.cct_zona='".$_SESSION["vg_cct_zona"]."' and a.idnivel=".$elidnivel; 	//echo $_sql; 
						$res=mysql_query($_sql); 		$r=0; 
						if (mysql_num_rows($res)>0){ ?> 
								<h3 class='fbold'>Escuelas Multigrado</h3>	
								<table class="ftable-all fborder"> 
									<tr><th></th><th>Municipio</th><th>Localidad</th><th>CT</th><th>Turno</th><th>Escuela</th><th></th></tr><? 
										while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); $tot=0; 
											$nomarreglo=""; $caddatos=$recset["cct"]."|".$recset["turno"]; 	?> 
											<tr> 
												<!--<td class="fwhite" style="font-size:20px; vertical-align:middle" width="10"><a class="icon-plus" style="color:green;" href='<? echo $autollamada."ex=&".$nomarreglo."=".oculta($caddatos,0); ?>'></a></td> 
												<td class="fwhite" style="font-size:20px; vertical-align:middle" width="10"><a class="icon-pencil" style="color:#B29200;" href="<? echo $autollamada."ex=17&".$nomarreglo."=".oculta($caddatos,0); ?>"></a></td> 
												<td class="fwhite" style="font-size:20px; vertical-align:middle" width="10"><a class="icon-trash-empty" style="color:#C70039;" href="<? echo $autollamada."ex=1833535&".$nomarreglo."=".oculta($caddatos,0); ?>"></a></td> --> 
												<td class="fcenter"><? echo ($r+1); ?></td>
                                                <td><? echo $recset["municipio"]; ?></td> 
												<td><? echo $recset["localidad"]; ?></td> 
												<td><? echo $recset["cct"]; ?></td>
                                                <td class="fcenter"><? echo $recset["turno"]; ?></td>
												<td class="ftext-red"><? echo $recset["nom_ct"]; ?></td> 
                                                <td class="fcenter"><small>&emsp;<a href="<? echo $autollamada."ex=18&modo=1&arrdatos=".$caddatos; ?>" class="fbutton fround fpadding-small">Deseleccionar</a>&emsp;</small></td> 

											</tr> <? 
											$tot=$tot+0; 	$r++; 
										} ?>		 
										<!-- <tr class="fdark-gray"><td colspan='3'>Total</td><td class='fright-align'><? //echo $tot; ?></td></tr>  -->
								</table> 
							<? 
						} ?>
					<h3 class="fpadding-large fbold fmargin-top ftext-purple">SI ESTA SEGURO(A) DE SU VALIDACIÓN&emsp;<small><a href="<? echo $autollamada."ex=18&modo=2&elidnivel=".$elidnivel; ?>" class="fbutton fround fshad fpadding-medium fpale-yellow"> Confirmar </a></small>	</h3><?

					


					
				}else{ ?>
					<div class="frow">
						<div class="fthird">&nbsp;</div>
						<div class="fthird">&nbsp;</div>
						<div class="fthird fleft-align fbold"><em>Dar click en una opción</em></div>
					</div> 
					<br><br>
					<a class="fbutton flight-gray fshad fpadding-medium fround fbold" href="<? echo $autollamada."ex=11".$bancond; ?>"><h3 class="fbold">Ver el resultado de la validación</h3></a>&emsp;&emsp;
					<a class="fbutton flight-gray fshad fpadding-medium fround fbold" href="<? echo $autollamada."ex=21".$bancond; ?>"><h3 class="fbold">Registrar escuelas que no se identifican en este listado</h3></a> <?
				}
			}	
		break;
	case 11:
		$arrnivel=explode("|",$_GET["arr_nivel"]);
		$vl_back=$_SESSION["back"];		
		// ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
		$TItulo="<h2 class='fbold'>Resultado de validación de la zona ".$_SESSION["vg_cct_zona"]."&emsp;&emsp;".$arrnivel[1]."</h2>"; $subtit=""; 		 
		$LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg=""; $imgancho=""; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
		// -----------------------------------------------------------------------------------------------------------------------------------------------------?>
		<div class="fpale-yellow fpadding-large fmargin-bottom">
				<h3 class="fbold fpadding-large">Escuelas validadas con cambio de Zona</h3>
				<!-- <h5 class="fbold fpadding-small"><em>Favor de dar click en la opción de Registrar, para incorporar la información que se solicita</em></h5> -->
				<?   		  
				$condicion_extra=" and estatus='C' ";
				$columna1="Invalidar|".$autollamada."ex=13&escuelacambio&stat|<small></small>|#E3E3E3";		//Boton|liga|Columna|color
				//$columna2="Registrar|".$autollamada."ex=14|<small>Zona de cambio</small>|#ECF5B4";		//Boton|liga|Columna|color
				if (flista_escuelas_zona_nivel($_SESSION["vg_cct_zona"],$arrnivel[0],$condicion_extra,$columna1)==0){
					echo "<h5>No hay</h5>"; 
				}; 				?>	
				<br>
		</div>
		<div class="fpale-blue fpadding-large fmargin-bottom">
				<h3 class="fbold fpadding-large">Escuelas para incorporar a la zona</h3>
			<?    
					$_sql="select * from ctsev_incorporadas where cct_zona='".$_SESSION["vg_cct_zona"]."' order by nombrempio,nombreloc";
					//echo $_sql; 
					$res=mysql_query($_sql); 		$r=0; 
					if (mysql_num_rows($res)>0){ ?> 
						<!-- <div class="fix4 fshad">  -->
							<table class="ftable-all"> 
								<tr>
									<!-- <th colspan="2"> -->

								</th><th></th><th>Municipio</th><th>Localidad</th><th>CT</th><th>Turno</th><th>Escuela</th><th>Director</th><th>Teléfono</th><th>Correo</th></tr>
								<? 
									while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); $tot=0; 
										$nomarreglo="arr_escuela"; $caddatos=$recset["id"]."|".$recset["cct"]."|".$recset["turno"]; 	?> 
										<tr> 
											<!--<td class="fwhite" style="font-size:20px; vertical-align:middle" width="10"><a class="icon-plus" style="color:green;" href='<? echo $autollamada."ex=&".$nomarreglo."=".oculta($caddatos,0); ?>'></a></td> 
											<td class="fwhite" style="font-size:20px; vertical-align:middle" width="10"><a class="icon-pencil" style="color:#B29200;" href="<? //echo $autollamada."ex=17&tipoact=2&arr_nivel=".$_GET["arr_nivel"]."&".$nomarreglo."=".oculta($caddatos,0); ?>"></a></td> --> 
											<td class="fwhite" style="font-size:25px; vertical-align:middle" width="10"><a class="icon-trash-empty" style="color:#C70039;" href="<? echo $autollamada."ex=12&tipoact=3&arr_nivel=".$_GET["arr_nivel"]."&".$nomarreglo."=".oculta($caddatos,0); ?>"></a></td>  
											<td><? echo $recset["nombrempio"]; ?></td> 
											<td><? echo $recset["nombreloc"]; ?></td> 
											<td><? echo $recset["cct"]; ?></td> 
											<td><? echo $recset["turno"]; ?></td> 
											<td class="ftext-red"><? echo $recset["nom_ct"]; ?></td> 
											<td><? echo $recset["director"]; ?></td> 
											<td><? echo $recset["telefono"]; ?></td> 
											<td><? echo $recset["correo"]; ?></td> 
										</tr> <? 
										$tot=$tot+0; 	$r++; 
									} ?>		 
									<!-- <tr class="fdark-gray"><td colspan='3'>Total</td><td class='fright-align'><? //echo $tot; ?></td></tr>  -->
							</table> 
						<!-- </div>--><?  
					}else{ ?><h4 class="fpadding-large">No hay registros</h3> <? }
				?><br>
		</div>
		<div class="fpale-green fpadding-large fmargin-bottom">
					<h3 class="fbold fpadding-large">Escuelas validadas como Activas</h3><?
				$condicion_extra=" and estatus='A' ";
				$columna1="Invalidar|".$autollamada."ex=13&stat=|<small></small>|#E3E3E3";		//Boton|liga|Columna|color
				if (flista_escuelas_zona_nivel($_SESSION["vg_cct_zona"],$arrnivel[0],$condicion_extra,$columna1)==0){
					echo "<h5>No hay</h5>"; 
				}; ?><br>
		</div>
		<div class="fpale-red fpadding-large fmargin-bottom">
					<h3 class="fbold fpadding-large">Escuelas validadas como Inactivas</h3>
				<?   
				$condicion_extra=" and estatus='I' ";
				$columna1="Invalidar|".$autollamada."ex=13&stat=|<small>En caso de error</small>|#E3E3E3";		//Boton|liga|Columna|color
				if (flista_escuelas_zona_nivel($_SESSION["vg_cct_zona"],$arrnivel[0],$condicion_extra,$columna1)==0){
					echo "<h5>No hay</h5>"; 
				}; ?><br>
		</div>	
		
		<?
		break;	

	case 12: // eliminación de escuelas incorporadas
		$vl_back=$autollamada."ex=11&arr_nivel=".$_GET["arr_nivel"];
		$arrescuela=explode("|",oculta($_GET["arr_escuela"],1));
		if($_GET["tipoact"]==2){
			$query="update ctsev set estatus='".$_GET["estat"]."' where cct='".$_GET["cct"]."' and turno=".$_GET["turno"]; 
			$mensa="Se ha actualizado";
		}else{
			$query="delete from ctsev_incorporadas where id=".$arrescuela[0]; 
			$mensa="Se ha eliminado";
		}
		if (mysql_query($query)){fmessage($mensa,2500,2,$vl_back);}else{fmessage("No ".$mensa,2500,2,$vl_back);};
		break;
	case 13:
		$query="update ctsev set estatus='".$_GET["estat"]."' where cct='".$_GET["cct"]."' and turno=".$_GET["turno"]; 
		if (mysql_query($query)){ 
			switch($_GET["estat"]){
				case "A":    $vl_tit="<span class='fbold ftext-green'>".$_GET["nom_ct"]."</span><br>Se ha validado como ACTIVA";   break; 
				case "I":    $vl_tit="<span class='fbold ftext-red'>".$_GET["nom_ct"]."</span><br>Se ha validado como INACTIVA";   break; 
//				case "C":    $vl_tit="Se ha validado como CAMBIO";   break; 
				case "":    
					$vl_tit="Se ha invalidado";   
					if (isset($_GET["escuelacambio"])){
						mysql_query("delete from ctsev_zonas_cambio where cct='".$_GET["cct"]."' and turno=".$_GET["turno"]);
					}
					break; 
			}
				
		}else{ $vl_tit="error";}
		fmessage($vl_tit,2000,2,$_SESSION["back"]);	
		
		break;	
	case 14:
		if (isset($_GET["cct"])){ 
			if (isset($_GET["estat"]) && $_GET["estat"]=="C"){
				mysql_query("update ctsev set estatus='".$_GET["estat"]."' where cct='".$_GET["cct"]."' and turno=".$_GET["turno"]);
			}
			$_SESSION["cct_temp"]=$_GET["cct"];    $_SESSION["turno_temp"]=$_GET["turno"];    $_SESSION["idnivel_temp"]=$_GET["idnivel"];     $_SESSION["nivel_temp"]=$_GET["nivel"]; 
		}

		//$vl_back=$autollamada."ex=11&arr_nivel=".$_SESSION["idnivel_temp"]."|".$_SESSION["nivel_temp"]; 
		$vl_back=$_SESSION["back"]; 
		// ------------------------------------------------------------------- BANNER ENCABEZADO --------------------------------------------------------------- 
		$TItulo="<h3 class='fbold ftext-red'>".$_GET["nom_ct"]."</h3>"; $subtit=""; 		 
		$LGback=$vl_back; $fijoSINO="SI"; 		$stylecolor=""; $lgimg=""; $imgancho=""; $lgagrega=""; $lgbusca="";	fbanner($TItulo,$subtit,$LGback,$fijoSINO,$stylecolor,$lgimg."|".$imgancho,$lgagrega,$lgbusca);	 
		// -----------------------------------------------------------------------------------------------------------------------------------------------------

		unset($_SESSION["selone"]);


		$ancho=900; $anchorotulos=250; $liga=$autollamada."ex=".($_GET["ex"]+1); $titulo="Datos de la Zona a la que cambia la escuela"; $tit_color="yellow"; $tit_size=22; 	$titboton1="Registrar"; $titboton2="Borrar"; ?> 
		<form enctype='multipart/form-data' action='<? echo $liga;?>' onSubmit='return checa(1);' name='frmactual' method='post' class="fshad fbold fround"> 
			<input type="hidden" name="hid_nom_ct" value="<? echo $_GET["nom_ct"]; ?>">
			<table class="ftable-all" style="max-width:<? echo $ancho; ?>px; min-width:<? $ancho; ?>px;"> <tr><th colspan="2" class="fpadding-medium fcenter fshad" style="font-size:<? echo $tit_size; ?>px; color:<? echo $tit_color; ?>;"><strong><? echo $titulo; ?></strong></th></tr> <? 

				// ---------     seleccion de Municipio y Localidad -----------------
				
				$id1="idmunicipio"; $dato1="municipio"; $tab1="municipio_c"; $rotulo1="Municipio"; 
				$camporelacioncon_id1="municipio"; $id2="localidad"; $dato2="nombreloc"; $tab2="ctsev";	$rotulo2="Localidad"; 	 
				$vapara=$_SERVER['REQUEST_URI']; 
				if (isset($_GET["selone"])){ $_SESSION["selone"]=$_GET["selone"]; }   ?><script>function selecciona1(x){ location.replace('<? echo $_SERVER['REQUEST_URI']; ?>&selone='+document.getElementById("seluno").options[document.getElementById("seluno").selectedIndex].value); }</script> 
				<tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo1; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><select autofocus name='seluno' id='seluno' onChange="selecciona1();"><option value=0></option> <? $vl_res=mysql_query("select distinct a.".$id1.",a.".$dato1." from ".$tab1." a where a.".$id1.">0 order by a.".$dato1);	while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ if ($recset[$id1]."|".trim($recset[$dato1])==$_SESSION["selone"]){$ban=" selected";}else{$ban="";} echo "<option value='".$recset[$id1]."|".$recset[$dato1]."'".$ban.">".$recset[$dato1]."</option>"; } ?> </select></td></tr> 
				<tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo2; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><? if (isset($_SESSION["selone"])){ $arr_one=explode("|",$_SESSION["selone"]); $_SESSION["seltwo"]=""; ?> <script>function selecciona2(x){ location.replace('<? echo $vapara."&"; ?>seltwo='+document.getElementById("seldos").options[document.getElementById("seldos").selectedIndex].value); }</script> <select autofocus name='seldos' id='seldos' onChange="selecciona2();"><option value=0></option> <? $vl_res=mysql_query("select distinct a.".$id2.",a.".$dato2." from ".$tab2." a where a.".$camporelacioncon_id1."=".$arr_one[0]." order by a.".$dato2); while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ if ($recset[$id2]."|".trim($recset[$dato2])==$_GET["seltwo"]){$ban=" selected";}else{$ban="";} echo "<option value='".$recset[$id2]."|".$recset[$dato2]."'".$ban.">".$recset[$dato2]."</option>"; } ?></select><? }else{ ?> <select name='sinvalor'></select> <? } if (isset($_GET["seltwo"])){ $_SESSION["seltwo"]=$_GET["seltwo"]; } ?></td></tr><?
				//---------------------------------------------------------------------------------

				$rotulo="Número de zona <small>preferentemente la clave</small>"; $nombre="nvazona"; $tamano=10; $max_largo=10; $valor=$arr_mikey[0]; $autofocus="NO"; //text numerico ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input class="fround" <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr><?	 
				
				$valor_paterno=""; $valor_materno=""; $valor_nombre=""; $autofocus="NO"; $tamano=11; $max_largo=50; //text paterno materno nombre ?> <tr><td style="vertical-align:middle" width='<? echo $anchorotulos; ?>'>Nombre del supervisor<? if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?> 			<input placeholder="Apellido Paterno" style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='paterno' id='paterno' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor_paterno."'";} ?>>			<input placeholder="Apellido Materno" style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='materno' id='materno' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor_materno."'";} ?>>		<input placeholder="Nombres" style='margin-top:2px' <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='nombre' id='nombre' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor_nombre."'";} ?>>	</td></tr><?

				$rotulo="Dirección"; $nombre="nvadirec"; $tamano=25; $max_largo=200; $valor=$arr_mikey[0]; $autofocus="NO"; //text ?> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo '</td><td>'; } ?><input class="fround" <? if ($autofocus=='SI'){ echo 'autofocus'; } ?> type='text' name='<?echo $nombre;?>' id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' <? if ($modo==2){ echo "value='".$valor."'";} ?>></td></tr><?
					?><tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr> 
				<tr><td colspan='2' class='fdark-gray fcenter fpadding-small' align='center'><input type=submit value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type=reset value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr> 
			</table> 
		</form> 
		<? 
		break; 
	
	case 15:	 
		if(strlen($_POST["nvazona"])==10){$zonaescola=""; $zona=$_POST["nvazona"];}else{ $zonaescola=$_POST["nvazona"]; $zona=""; }
		$arr_selone=explode("|",$_SESSION["selone"]);
		$arr_seltwo=explode("|",$_SESSION["seltwo"]);

				$query="insert into ctsev_zonas_cambio "; 
				$query .="values ('".$_SESSION["cct_temp"]."',".$_SESSION["turno_temp"].",'".$_POST["hid_nom_ct"]."','".$_SESSION["vg_cct_zona"]."','".$zonaescola."','".$zona."','".$arr_selone[0]."','".$arr_selone[1]."','".$arr_seltwo[0]."','".$arr_seltwo[1]."','".$_POST["paterno"]."','".$_POST["materno"]."','".$_POST["nombre"]."','".$_POST["nvadirec"]."')"; 	$vl_tit="Se ha registrado"; //$vl_tit=$query; 
				$sehizo=mysql_query($query); 
				//$sehizo=mysql_query("update ctsev set estatus='D' where CONCAT(cct,turno)='".$_SESSION["cct_temp"].$_SESSION["turno_temp"]."'"); 
		
		fmessage("Se han registrado los datos de la zona<br>a donde cambia",3500,2,$autollamada."ex=11&arr_nivel=".$_SESSION["idnivel_temp"]."|".$_SESSION["nivel_temp"]);	 
	break;	



	case 18: 
        if ($_GET["modo"]==1){ // deseleccion de una multigrado
            $arr_datos=explode("|",$_GET["arrdatos"]);
            $vl_back=$autollamada."ex=10";
            $query="delete from ctsev_multigrado23 where cct='".$arr_datos[0]."' and turno=".$arr_datos[1];
            mysql_query($query);
            $query="update ctsev set multigrado=0 where cct='".$arr_datos[0]."' and turno=".$arr_datos[1];
            $mensa="Deseleccionada";
            if (mysql_query($query)){fmessage($mensa,2500,2,$vl_back);}else{fmessage($mensa,1500,2,$vl_back);};
        }else{  // Conclusion del proceso    
		    $vl_back="https://www.librosgratuitosveracruz.org/ingresosupervisor";
			$query="update supervis_c set estatusvalidacion=8,estatusvalid=CASE WHEN estatusvalid='' THEN '".$_GET["elidnivel"]."' WHEN estatusvalid!='' THEN CONCAT(estatusvalid,'|".$_GET["elidnivel"]."') END where valid_nuevoreg=1 and cuenta='".$_SESSION["vg_cct_zona"]."'";
			$mensa="Muchas gracias por su validación<br>Lic. Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo<br>para la Mejora Educativa<br>y responsable única de distribución";
			
		    if (mysql_query($query)){fmessage($mensa,2500,2,$vl_back);}else{fmessage($mensa,30500,2,$vl_back);};
        }    
	break;
















	case 21: 
			$vl_back=$_SESSION["back"];	
			$titulo="Escuela";      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 		 $arrescuela=explode("|",$_SESSION["escuela"]);   				switch ($_GET["vl_modoact"]){case 1: default: $tit="Agregando"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2; break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } 			if ($_SESSION['vg_w']==2){ ?> <div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div> <div id="seccionX" style="width:100%; display:none; height:100%"><? } ?>
			<form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=22' onSubmit='return checa(20,<? echo $modo; ?>);' name='frmactual' method='post'>
				<input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
				<? $ancho=300;   $anchorotulos=228.57142857143;   $color=".$fdeg.";			if($modo==1){ $titboton1="Agregar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
				<table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="fwhite">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
					<? $rotulo='CCT'; $nombre='cct';  $valor=$arrescuela[1];   $tamano=10; $max_largo=10; //   text   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?><input autofocus type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' value='30'> <? } ?></td></tr>
					<? $rotulo='Turno'; $nombre='turno';  $valor=$arrescuela[2];   //   selectquery   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';   }else{ echo '</td><td>'; }  if ($modo==9){ echo $valor; }else{ ?><select  name='<?echo $nombre;?>'  id='<?echo $nombre;?>' class='fround'><option value=''></option>			<? $vl_res=mysql_query("select turno,elturno from ctsev_turnos");			$vl_regs=mysql_num_rows($vl_res);	 $r=0;			while ($r<$vl_regs){					$recset=mysql_fetch_array($vl_res,MYSQL_ASSOC);					if ($modo==2 and $valor==$recset['turno']) { $ban=" selected";}else{ $ban="";}					echo "<option value=".$recset['turno'].$ban.">".$recset['elturno']."</option>";					$r++;	 			} ?>		</select><? } ?></td></tr>
																		<? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
				</table>  </strong>
			</form> 	<? if ($_SESSION['vg_w']==2){ ?> <script> 	$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterClose': function(){ location.replace('<? echo $vl_back; ?>'); } }); }); </script><? }else{ ?></div><? } ?>       	</div>	<? break; 

	case 22: 
		$vl_back=$autollamada."ex=21";
		if (isset($_POST["cct"])){
			$laclave=$_POST["cct"]; $elturno=$_POST["turno"]; 
			unset($_SESSION["selone"]);
		}else{
			$laclave=$_GET["clave"]; $elturno=$_GET["turn"];
		}
		$res=mysql_query("select * from ctsev where CONCAT(cct,turno)='".$laclave.$elturno."' and estatus!='R'");
		if(mysql_num_rows($res)>0){  
			fmessage("Esta clave ya esta registrada",2500,2,$vl_back);	 
		}else{
			$titulo="Escuela a la zona";      if(isset($_GET['pm_escuela'])){ $_SESSION["escuela"]=oculta($_GET["pm_escuela"],1); } 		 $arrescuela=explode("|",$_SESSION["escuela"]);   				switch ($_GET["vl_modoact"]){case 1: default: $tit="Agregando"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2; break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } 			if ($_SESSION['vg_w']==2){ ?> <div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div> <div id="seccionX" style="width:100%; display:none; height:100%"><? } ?>
			<form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=23' onSubmit='return checa(20,<? echo $modo; ?>);' name='frmactual' method='post'>
				<input type="hidden" name="hid_modoact" value=<? echo $modo; ?>>
				<input type="hidden" name="hid_cct" value=<? echo $laclave; ?>>
				<input type="hidden" name="hid_turno" value=<? echo $elturno; ?>>

				<? $ancho=800;   $anchorotulos=228.57142857143;   $color=".$fdeg.";			if($modo==1){ $titboton1="Agregar"; }else{ $titboton1="Modificar"; }   $titboton2="Borrar"; ?> <strong>
				<table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="fwhite">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } 
					echo "<tr><td colspan='2' align='center'>".$laclave."-".$elturno."</td><tr>";
					// ---------     seleccion de Municipio y Localidad -----------------
					// Seleccion 2 elementos CATALOGOS en tabla 
					$id1="idmunicipio"; $dato1="municipio"; $tab1="municipio_c"; $rotulo1="Municipio"; 		$camporelacioncon_id1="municipio"; 	$id2="localidad"; $dato2="nombreloc"; $tab2="ctsev";	$rotulo2="Localidad"; 	 $vapara=$_SERVER['REQUEST_URI']; if (isset($_GET["selone"])){ $_SESSION["selone"]=$_GET["selone"]; } ?><script>function selecciona1(x){ location.replace('<? echo $_SERVER['REQUEST_URI']."&"; ?>clave=<? echo $laclave; ?>&turn=<? echo $elturno; ?>&selone='+document.getElementById("seluno").options[document.getElementById("seluno").selectedIndex].value);	}</script> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo1; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo "</td><td align='left'>"; } ?><select autofocus name='seluno' id='seluno' onChange="selecciona1();"><option value=0></option> <? $vl_res=mysql_query("select distinct a.".$id1.",a.".$dato1." from ".$tab1." a where a.".$id1.">0 order by a.".$dato1);	while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ if ($recset[$id1]."|".trim($recset[$dato1])==$_SESSION["selone"]){$ban=" selected";}else{$ban="";} echo "<option value='".$recset[$id1]."|".$recset[$dato1]."'".$ban.">".$recset[$dato1]."</option>"; } ?> </select></td></tr> <tr><td width='<? echo $anchorotulos; ?>'><? echo $rotulo2; if ($_SESSION['vg_w']==1){ echo '<br>'; if ($tamano>25){$tamano=25;} }else{ echo "</td><td align='left'>"; } ?><? if (isset($_SESSION["selone"])){ $arr_one=explode("|",$_SESSION["selone"]); $_SESSION["seltwo"]=""; ?> <script>function selecciona2(x){ location.replace('<? echo $vapara."&"; ?>clave=<? echo $laclave; ?>&turn=<? echo $elturno; ?>&seltwo='+document.getElementById("seldos").options[document.getElementById("seldos").selectedIndex].value); }</script> <select autofocus name='seldos' id='seldos' onChange="selecciona2();"><option value=0></option> <? $vl_res=mysql_query("select distinct a.".$id2.",a.".$dato2." from ".$tab2." a where a.".$camporelacioncon_id1."=".$arr_one[0]." order by a.".$dato2); while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ if ($recset[$id2]."|".trim($recset[$dato2])==$_GET["seltwo"]){$ban=" selected";}else{$ban="";} echo "<option value='".$recset[$id2]."|".$recset[$dato2]."'".$ban.">".$recset[$dato2]."</option>"; } ?></select><? }else{ ?> <select name='sinvalor'></select> <? } if (isset($_GET["seltwo"])){ $_SESSION["seltwo"]=$_GET["seltwo"]; } ?></td></tr><? 

					//--------------------------------------------------------------------------------- */ ?>
					<? $rotulo='Nombre Escuela'; $nombre='nombre_escuela';  $valor=$arrescuela[3];   $tamano=38; $max_largo=38; //   text   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input <? if (isset($_POST["cct"])){ echo "autofocus"; }?>  type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					
					<? $rotulo='Nombre Director'; $nombre='nombre_director';  $valor=$arrescuela[3];   $tamano=38; $max_largo=38; //   text   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input <? if (isset($_POST["cct"])){ echo "autofocus"; }?>  type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Telefono'; $nombre='telefono';  $valor=$arrescuela[3];   $tamano=12; $max_largo=10; //   text-numerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input <? if (isset($_POST["cct"])){ echo "autofocus"; }?>  type='text' onKeyDown='return keynum(event);' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Correo'; $nombre='correo';  $valor=$arrescuela[3];   $tamano=38; $max_largo=38; //   text   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input <? if (isset($_POST["cct"])){ echo "autofocus"; }?>  type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>



					<? $rotulo='Alumnos 1°'; $nombre='a1';  $valor=$arrescuela[6];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Alumnos 2°'; $nombre='a2';  $valor=$arrescuela[7];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Alumnos 3°'; $nombre='a3';  $valor=$arrescuela[8];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Alumnos 4°'; $nombre='a4';  $valor=$arrescuela[9];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Alumnos 5°'; $nombre='a5';  $valor=$arrescuela[10];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Alumnos 6°'; $nombre='a6';  $valor=$arrescuela[11];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Grupos 1°'; $nombre='g1';  $valor=$arrescuela[12];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Grupos 2°'; $nombre='g2';  $valor=$arrescuela[13];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Grupos 3°'; $nombre='g3';  $valor=$arrescuela[14];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Grupos 4°'; $nombre='g4';  $valor=$arrescuela[15];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Grupos 5°'; $nombre='g5';  $valor=$arrescuela[16];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
					<? $rotulo='Grupos 6°'; $nombre='g6';  $valor=$arrescuela[17];   $tamano=3; $max_largo=2; //   textnumerico   ?>        <tr style="background-image:linear-gradient(#F5F6FD,#EDEEF4)"><td width='<? echo $anchorotulos; ?>'><? echo $rotulo;  if ($_SESSION['vg_w']==1){ echo '<br>';  if ($tamano>20){$tamano=20;} }else{ echo "</td><td class='fleft'>"; }  if ($modo==9){ echo $valor; }else{ ?><input type='text' name='<?echo $nombre;?>'  id='<?echo $nombre;?>' size='<?echo $tamano;?>' maxlength='<?echo $max_largo;?>' class='fround' onKeyDown="return keynum(event);" <? if ($modo==2){ echo "value='".$valor."'";} ?>> <? } ?></td></tr>
																		<? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
				</table>  </strong>
			</form> 	<? if ($_SESSION['vg_w']==2){ ?> <script> 	$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterClose': function(){ location.replace('<? echo $vl_back; ?>'); } }); }); </script><? }else{ ?></div><? } ?>       	</div>	<? 
		}	
		break; 


	case 23:
		
		$vl_back=$_SESSION["back"];
		if (isset($_POST["hid_modoact"])){
			$arr_one=explode("|",$_SESSION["selone"]);
			$arr_two=explode("|",$_SESSION["seltwo"]);

			if($_POST["hid_modoact"]=='1'){
							if ($a1==''){$a1=0;}						if ($a2==''){$a2=0;}						if ($a3==''){$a3=0;}						if ($a4==''){$a4=0;}						if ($a5==''){$a5=0;}						if ($a6==''){$a6=0;}						if ($g1==''){$g1=0;}						if ($g2==''){$g2=0;}						if ($g3==''){$g3=0;}						if ($g4==''){$g4=0;}						if ($g5==''){$g5=0;}						if ($g6==''){$g6=0;}						if ($ar1==''){$ar1=0;}						if ($ar2==''){$ar2=0;}						if ($ar3==''){$ar3=0;}						if ($ar4==''){$ar4=0;}						if ($ar5==''){$ar5=0;}						if ($ar6==''){$ar6=0;}						$res=mysql_query("select max(id) as ultimo from aescuela");        $recset=mysql_fetch_array($res,MYSQL_ASSOC);    $vl_ultimo=$recset["ultimo"]+1;
				$query="insert into ctsev_incorporadas (cct,turno,nom_ct,municipio,localidad,a1,a2,a3,a4,a5,a6,gpo1,gpo2,gpo3,gpo4,gpo5,gpo6,estatus,director,telefono,correo,cct_zona,nombrempio,nombreloc) ";
				$query .="values ('".$_POST["hid_cct"]."',".$_POST["hid_turno"].",'".$_POST["nombre_escuela"]."','".$arr_one[0]."','".$arr_two[0]."',".$a1.",".$a2.",".$a3.",".$a4.",".$a5.",".$a6.",".$g1.",".$g2.",".$g3.",".$g4.",".$g5.",".$g6.",'A','".$_POST["nombre_director"]."','".$_POST["telefono"]."','".$_POST["correo"]."','".$_SESSION["vg_cct_zona"]."','".$arr_one[1]."','".$arr_two[1]."')";  	$vl_tit="Se ha registrado";    $colormsg="fgreen";    $colortextmsg="ftext-green";   //$vl_tit=$query;  
			}else{
							$arrescuela=explode("|",$_SESSION["escuela"]);
						if ($a1==''){$a1=0;}					if ($a2==''){$a2=0;}					if ($a3==''){$a3=0;}					if ($a4==''){$a4=0;}					if ($a5==''){$a5=0;}					if ($a6==''){$a6=0;}					if ($g1==''){$g1=0;}					if ($g2==''){$g2=0;}					if ($g3==''){$g3=0;}					if ($g4==''){$g4=0;}					if ($g5==''){$g5=0;}					if ($g6==''){$g6=0;}					if ($ar1==''){$ar1=0;}					if ($ar2==''){$ar2=0;}					if ($ar3==''){$ar3=0;}					if ($ar4==''){$ar4=0;}					if ($ar5==''){$ar5=0;}					if ($ar6==''){$ar6=0;}			$query="update aescuela set cct='".$_POST["cct"]."',turno=".$_POST["turno"].",nombre='".$_POST["nombre"]."',municipio=".$_POST["municipio"].",localidad='".$_POST["localidad"]."',a1=".$_POST["a1"].",a2=".$_POST["a2"].",a3=".$_POST["a3"].",a4=".$_POST["a4"].",a5=".$_POST["a5"].",a6=".$_POST["a6"].",g1=".$_POST["g1"].",g2=".$_POST["g2"].",g3=".$_POST["g3"].",g4=".$_POST["g4"].",g5=".$_POST["g5"].",g6=".$_POST["g6"].",ar1=".$_POST["ar1"].",ar2=".$_POST["ar2"].",ar3=".$_POST["ar3"].",ar4=".$_POST["ar4"].",ar5=".$_POST["ar5"].",ar6=".$_POST["ar6"]."".$banupload." where id=".$arrescuela[0];  
							$vl_tit="Se ha actualizado";     $colormsg="forange";     $colortextmsg="ftext-orange";    //$vl_tit=$query;  
			}
			mysql_query($query);
		}else{
			// if (!isset($answer)){ fquestion("Se eliminará el registro?",$autollamada."ex=".$_GET["ex"]."&ky=".$_GET["ky"]."&answer",2); 
			// }else{	 
			// 	if (isset($_POST['respyes'])) {	 
			// 		$query="update aescuela set estatus='X' where id=".$_GET["ky"];	 
			// 		if (mysql_query($query)){ $vl_tit="Se ha eliminado"; }	 
			// 	}else{ fquit($vl_back);	}	 
			// }
		}
		fmessage($vl_tit,1500,2,$vl_back);  	break; 

	case 51:
		$vl_back=$autollamada."ex=10&seleccionado&arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"];  $titulo=$_GET["nom_ct"]; $color="black"; $titboton1="Continuar"; 								
		mysql_query("update ctsev set multigrado=1 where concat(cct,turno)='".$_GET["cct"].$_GET["turno"]."'");
		mysql_query("insert into ctsev_multigrado23 values ('".$_GET["cct"]."',".$_GET["turno"].",'".$_SESSION["vg_cct_zona"]."',NOW(),'".$_GET["municipio"]."','".$_GET["localidad"]."','".$_GET["nom_ct"]."',".$_GET["idnivel"].",'".$_GET["nivel"]."',0,0,0,'','')");
		fmessage("Registrada ",2500,2,$vl_back);
		break;	
	}			
	?>
	<br><br>
	<div class="fcenter fpadding-large fborder-top fmargin">
		<a id="regreso" href="<? echo $vl_back;?>" class="fbutton fshad fpadding-tiny fround"><h4 class="fmargin-left fmargin-right icon-left">&nbsp;Regresar</h4></a>
		
	</div><?
} ?>	
</body>
</html>