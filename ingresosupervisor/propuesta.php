<?php
session_start(); 	
$autollamada=basename(__FILE__). "?";	
require_once('../conecta2023.php');
require_once('../inc/funciones_libros.php');
require_once('../phpqrcode/qrlib.php');
conectalo("director"); ?>

<html><head><title> </title>
<LINK REL="stylesheet"  HREF="../css/bootstrap.min.css" >
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  
<style type="text/css" media="print">
        @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
        H1.SaltoDePagina { PAGE-BREAK-AFTER: always }  
    </style>

<SCRIPT TYPE="text/javascript" src="../_funciones.js"></SCRIPT>
<SCRIPT TYPE="text/javascript">
	function cl(x){setTimeout ("window.location.replace('"+x+"')", 0);}
	function cierraventana(){window.close();} 
	function show_hide_column( col_no, do_show ){
		const table  = document.getElementById( 'tabla_imprime' )
		const column = table.getElementsByTagName( 'col' )[col_no]
		
		if ( column ){
			column.style.visibility = do_show?"":"collapse";
		}
	}
	function doPrint(){
					document.all.item("Imprimir").style.visibility='hidden' 
					document.all.item("regresar").style.visibility='hidden' 
					window.print()
					document.all.item("Imprimir").style.visibility='visible'
					document.all.item("regresar").style.visibility='visible' 
	}
	function doPrint_zona(numcols){
					document.all.item("Imprimir").style.visibility='hidden' 
					document.all.item("regresar").style.visibility='hidden' 
					show_hide_column( numcols, false )
					window.print()
					document.all.item("Imprimir").style.visibility='visible'
					document.all.item("regresar").style.visibility='visible' 
					show_hide_column( numcols, true )
	}

</SCRIPT>
</head>
<body>
	<div class="container">	
		<div class="row">
			<div class="col-md-12">
				<?php
				if ((!isset($logeado) && !isset($TxtUsuario))){
					echo "<br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
				}else{
					switch ($vg_tipousuario){
						case "Supervisor":
							$vl_back="../_panel.php"; 	
							break;
						case "Sector":	
							$vl_back="seleccion_sector_niveles.php?ejecucion=1";
							break;
						case "Almacen":
							if ($_GET["ejecucion"]==1){$vl_back=$autollamada."ejecucion=2&basenivel=".$_GET["pmbasenivel"]; }else{$vl_back="../_panel.php?papa=9"; }
							break;
						default:
							if ($_GET["ejecucion"]==1){$vl_back=$autollamada."ejecucion=2&basenivel=".$_GET["pmbasenivel"]."&almacen_seleccionado=".$_GET["almacen_seleccionado"]."&bodega=".$_GET["bodega"]; }else{ if (isset($_GET["almacen_seleccionado"])){$vl_back=$autollamada."ejecucion=2&basenivel=".$_GET["basenivel"]; }else{$vl_back="../_panel.php?papa=9"; }}
							break;
					}		
					if ($ejecucion==2){ 
						if ($_SESSION["vg_tipousuario"]=="Almacen"){$fun="doPrint_zona(7)";}else{$fun="doPrint_zona(6)";}
					}else{
						$fun="doPrint()"; 
					}				?>
					<div class="frow fright ftransparent ftop fmargin"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='<? echo $fun; ?>'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div>
					<br><br><div class="col-md-12"><img class="img-responsive" src="../images/logo_SEVGob.png" width="1024" ></div> 
					<div style="text-align:center; margin-left:50px; margin-right:50px"><?
						$cat_escuelas="ctsev";			$cat_almacenes="almacen_c";
						if (!isset($ejecucion)){$ejecucion=1;}
						switch ($ejecucion){
							case 1:   // 	Consulta y recibo general de la zona (muestra escuelas pendientes y escuelas con matricula)
								switch ($vg_tipousuario){
									case "Supervisor":
									case "Sector":
										$arrnivel=explode("|",$_GET["arr_nivel"]);
										$vl_losniveles=$arrnivel[0];
										if($vg_tipousuario=="Supervisor"){
											$cvesector=$_SESSION["vg_cct_sector"];
											$cvezona=$_SESSION["vg_cct_zona"];
											$numzona=$vg_zonaescola;
											$numsector=$_SESSION["vg_sector"];
										}else{
											$cvezona=$cct_zona;
											$numzona=$zonaescola;
											$numsector=$vg_ctausr;
											
										}
										// requiero  $vl_losniveles, $almacen$vl_cerrarventana="SI";   
										$idalmadis=123456890;
										//$cct_sector=
										//$almacen=
										switch($arrnivel[0]){
											case 30: case 31: case 32: case 34: case 35:  $basenivel=3;	$vl_tit="PREESCOLAR"; break;
											case 40: case 41: case 42: case 46: $basenivel=4;     $vl_tit="PRIMARIA"; break;
											case 60: case 61: case 65:  $basenivel=6;  $cat_escuelas="ctsev";	$vl_tit="SECUNDARIA";  break;
											case 72: case 73: case 74: case 76:  $basenivel=3;  $cat_almacenes="almacenteles_c";  $vl_tit="TELESECUNDARIA"; break; 
										}
										$vl_cerrarventana="NO";
										break;
									default:
										$basenivel=$_GET["pmbasenivel"];
										$cvesector=$_GET["cct_sector"];
										$cvezona=$_GET["cct_zona"];
										$numzona=$_GET["zonaescola"];
										$numsector=$_GET["sector"];
										switch($basenivel){
											case 3:	
												switch($_SESSION["tipousuario"]){
													case "NivelPreesEstatal": $vl_losniveles="30"; $vl_tit="PREESCOLAR ESTATAL"; break;
													default: $vl_losniveles="30,31,32,34,35,36"; $vl_tit="PREESCOLAR";	break;
												}	
												break;
											case 4:	
												switch($_SESSION["tipousuario"]){
													case "NivelPrimariaEstatal": $vl_losniveles="40"; $vl_tit="PRIMARIA ESTATAL";	break;
													case "NivelPrimariaIndigen": $vl_losniveles="42"; $vl_tit="PRIMARIA INDÍGENA"; break;
													case "NivelPrimFederal": $vl_losniveles="41"; $vl_tit="PRIMARIA FEDERAL";	break;
													default: $vl_losniveles="40,41,42,45,46"; $vl_tit="PRIMARIA";	break;
												}	
												break;
											case 6:	
												$latabla="ctsev";
												switch($_SESSION["tipousuario"]){
													case "NivelSecundEstatal": $vl_losniveles="60"; $vl_tit="SECUNDARIA ESTATAL";	break;
													case "NivelSecund": $vl_losniveles="61,65"; $vl_tit="SECUNDARIA";	break;
													default: $vl_losniveles="60,61,65"; $vl_tit="SECUNDARIA";	break;
												}												
												break;
											case 7:	
												switch($_SESSION["tipousuario"]){
													default: $vl_losniveles="72,73,74,76";  $vl_tit="TELESECUNDARIA"; break;
												}												
												break; 
										}
										break;
								}												
								?>
								SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ</br>	           
								SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         </br>   
								<div>COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA</div>
								<div>PROGRAMA DE LIBROS DE TEXTO GRATUITOS</div>
								<div align="center"> RECIBO DE REDISTRIBUCIÓN DE ZONA DE <? echo $vl_tit; ?></div>
								CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)&nbsp;<br>&nbsp;

								<h5><b>BALANCE DE CAPTURA DE MATRICULA REAL</b></h5><br>

								<table class="table table-bordered">
									<tr><td width="30%"><? echo $cvezona; ?></td>
										<td><? echo "Sector ".$numsector."&emsp;&emsp;&emsp; Zona ".$numzona; ?></td>
										<td width="30%"><small><?php echo fechalarga(date('Y-m-d')); ?></small></td>
									</tr>
								</table>
								<?
								if ($basenivel==4){	
									$vl_muestra_asig="a.alu_1 as a1,a.alu_2 as a2,a.alu_3 as a3,a.alu_4 as a4,a.alu_5 as a5,a.alu_6 as a6,(a.alu_1+a.alu_2+a.alu_3+a.alu_4+a.alu_5+a.alu_6) as Alumnos,a.gpo1 as g1,a.gpo2 as g2,a.gpo3 as g3,a.gpo4 as g4,a.gpo5 as g5,a.gpo6 as g6,(a.gpo1+a.gpo2+a.gpo3+a.gpo4+a.gpo5+a.gpo6) as Grupos";
									$vl_muestra_capt="a.a1,a.a2,a.a3,a.a4,a.a5,a.a6,(a.a1+a.a2+a.a3+a.a4+a.a5+a.a6) as alumnos,a.g1,a.g2,a.g3,a.g4,a.g5,a.g6,(a.g1+a.g2+a.g3+a.g4+a.g5+a.g6) as grupos";
									$vl_quemuestra1="day(a.fecha_matricula)=0";	
									$vl_quemuestra2="day(a.fecha_matricula)>0";
									$ancho=550;	
								}else{
									if ($basenivel==6){	
											$vl_muestra_asig="(a.alu_1-a.remanente1) as a1,(a.alu_2-a.remanente2) as a2,(a.alu_3-a.remanente3) as a3,(a.alu_1+a.alu_2+a.alu_3)-(a.remanente1+a.remanente2+a.remanente3) as Alumnos,a.gpo1 as g1,a.gpo2 as g2,a.gpo3 as g3,(a.gpo1+a.gpo2+a.gpo3) as Grupos";													
											$ancho=550;
									}else{
											$vl_muestra_asig="a.alu_1 as a1,a.alu_2 as a2,a.alu_3 as a3,(a.alu_1+a.alu_2+a.alu_3) as Alumnos,a.gpo1 as g1,a.gpo2 as g2,a.gpo3 as g3,(a.gpo1+a.gpo2+a.gpo3) as Grupos";
											$ancho=550;
									}
									$vl_muestra_capt="a.a1,a.a2,a.a3,(a.a1+a.a2+a.a3) as alumnos,a.g1,a.g2,a.g3,(a.g1+a.g2+a.g3) as grupos";
								}
								//$laconsulta="select a.nom_ct,a.cct as Escuela,a.turno,a.idnivel,".$vl_muestra_asig." from $cat_escuelas a where a.idalmadis=$idalmadis and a.cct_sector='$cvesector' and a.cct_zona='$cvezona' and a.estatus='A' and a.idnivel in ($vl_losniveles) and day(a.fecha_matricula)=0 group by a.cct_zona,a.cct,a.turno order by a.idalmadis,a.cct";
								$laconsulta="select a.nom_ct,a.cct as Escuela,a.turno,a.idnivel,".$vl_muestra_asig." from $cat_escuelas a where a.cct_sector='$cvesector' and a.cct_zona='$cvezona' and a.estatus='A' and a.idnivel in ($vl_losniveles) and day(a.fecha_matricula)=0 group by a.cct_zona,a.cct,a.turno order by a.idalmadis,a.cct";
								//	echo $laconsulta;
								$vl_res=mysql_query($laconsulta);    $vl_regs=mysql_num_rows($vl_res);  
								if ($vl_regs>0){
									if($_SESSION['vg_w']==1){ echo "<br>"; } 
									$tcolor="background:#000000;";	$rcolor1="background:#FFFFFF;"; $rcolor2="background:#F2F2F2;";     ?> 
									<div><style>th{ background-image:linear-gradient(#373736, #202020,#484848); border-radius: 4px; text-align:center}</style>
										<h5><b><? echo $vl_regs; ?> Escuelas que no han capturado su matrícula real</b></h5><br>	
										<table border='1' style='border:red; border-color:#C4C4C4;' width='<? echo $ancho; ?>' cellpadding='8' cellspacing='0' align='center'> 
											<tr style="<? echo $tcolor; ?> color:white; height:35px; font-size:16px">
												<!--<th colspan="3">-->
												<? if ($basenivel==4){ ?>
															<th>Escuela</th><th>Turno</th><th>a1</th><th>a2</th><th>a3</th><th>a4</th><th>a5</th><th>a6</th><th>Alumnos</th>
												<? }else{ ?>
													<th>Escuela</th><th>Turno</th><th>a1</th><th>a2</th><th>a3</th><th>Alumnos</th>

												<? } ?>
											</tr> <? $x=0;  $r=0;  
										while ($recset=mysql_fetch_array($vl_res,MYSQL_ASSOC)){ 
																			$x++; if ($x==2){$rcolor=$rcolor2; $x=0;}else{$rcolor=$rcolor1;} 
											$cad_datos=$recset["idcorreccion"]."|".$recset["ejemplares"]."|".$recset["clave"]."|".$recset["materia"]."|".$recset["titulo"]."|".$recset["ejemplares2"]."|".$recset["editorial"]; ?>
											<tr style="<? echo $rcolor; ?>">
												<td align='center'><? echo $recset["Escuela"]; ?></td>
												<td align='center'><? echo $recset["turno"]; ?></td>
												<td align='right'>&nbsp;&nbsp;<? echo number_format($recset["a1"],0); ?>&nbsp;&nbsp;</td>
												<td align='right'>&nbsp;&nbsp;<? echo number_format($recset["a2"],0); ?>&nbsp;&nbsp;</td>
												<td align='right'>&nbsp;&nbsp;<? echo number_format($recset["a3"],0); ?>&nbsp;&nbsp;</td>
												<? if ($basenivel==4){ ?>
														<td align='right'>&nbsp;&nbsp;<? echo number_format($recset["a4"],0); ?>&nbsp;&nbsp;</td>
														<td align='right'>&nbsp;&nbsp;<? echo number_format($recset["a5"],0); ?>&nbsp;&nbsp;</td>
														<td align='right'>&nbsp;&nbsp;<? echo number_format($recset["a6"],0); ?>&nbsp;&nbsp;</td>
												<?} ?>
												<td align='right'><? echo number_format($recset["Alumnos"],0); ?></td>
											</tr><?    $r++;   if ($r==100){break;}   
										} ?>  </table>  
									</div>   <?  
								}else{ $tit="Todas las escuelas de la zona, han concluido el proceso de captura de matrícula real"; ?><div class="fcontainer"><div class="fthird">&nbsp;</div><div class="fthird"><h4 class="fcenter fpadding-large fmargin fdeg fshad fround fborder"><? echo $tit; ?></h4></div></div><? if(isset($_POST['buscado'])){ ?> <script type="text/javascript" languaje="javascript">setTimeout("window.location.replace('<? if(isset($_POST['buscado'])){$x=explode(".php?",$_SERVER["REQUEST_URI"]); $vl_back=$autollamada.$x[1]; } echo $vl_back;  ?>')", 1500);</script><br><br><br>  <? } } 
								/*******************************************************************  */
								//$_sql_asig="select a.zonaescola,a.sector,a.idalmadis,a.cct as Escuela,a.turno,".$vl_muestra_asig.",a.nom_ct,a.idnivel from $cat_escuelas a where a.idalmadis=$idalmadis and a.cct_sector='$cveector' and a.cct_zona='$cvezona' and a.estatus='A' and a.idnivel in ($vl_losniveles) and day(a.fecha_matricula)>0 group by a.cct_zona,a.cct,a.turno order by a.cct";
								$_sql_asig="select a.zonaescola,a.sector,a.idalmadis,a.cct as Escuela,a.turno,".$vl_muestra_asig.",a.nom_ct,a.idnivel from $cat_escuelas a where a.cct_sector='$cvesector' and a.cct_zona='$cvezona' and a.estatus='A' and a.idnivel in ($vl_losniveles) and day(a.fecha_matricula)>0 group by a.cct_zona,a.cct,a.turno order by a.cct";
								//$_sql_capt="select a.idalmadis,a.cct as Escuela,a.turno,".$vl_muestra_capt." from $cat_escuelas a where a.idalmadis=$idalmadis and a.cct_sector='$cvesector' and a.cct_zona='$cvezona' and a.estatus='A' and a.idnivel in ($vl_losniveles) and day(a.fecha_matricula)>0 group by a.cct_zona,a.cct,a.turno order by a.cct";
								$_sql_capt="select a.idalmadis,a.cct as Escuela,a.turno,".$vl_muestra_capt." from $cat_escuelas a where a.cct_sector='$cvesector' and a.cct_zona='$cvezona' and a.estatus='A' and a.idnivel in ($vl_losniveles) and day(a.fecha_matricula)>0 group by a.cct_zona,a.cct,a.turno order by a.cct";
								
								/*echo $_sql_asig;
								echo "<hr>";
								echo $_sql_capt;
								
								echo "yayayayayayayayaokokokok<hr>";  */
								$res1=mysql_query($_sql_asig);		
								$res2=mysql_query($_sql_capt);
								$vl_regs1=mysql_num_rows($res1);	
								$vl_regs2=mysql_num_rows($res2);
								if ($vl_regs1>0){ 
									
									if ($vl_regs>0){ ?><p class="SaltoDePagina"></p><hr><? }
									//echo "<br><span class='roja_20'>Lista de $vl_regs1 escuelas que ya han registrado su matr&iacute;cula real</span><br><span class='verde_14'>Matrícula asignada - (Matrícula real + movimientos) = Diferencias</span><br><span >En cada grado, si la diferencia es negativa  , a la escuela le faltan libros. Si es positiva, a la escuela le sobran libros.</span>";
									echo "<br><h5><b>$vl_regs1 escuelas que ya han registrado su matr&iacute;cula real<br><br><small><i>Matrícula asignada - Matrícula real = Diferencias<br><br><i>En cada grado, si la diferencia es negativa, a la escuela le faltan libros. Si es positiva, a la escuela le sobran libros</i></small></f5><br><br>";
									//echo "<br>En el caso de las altas de alumnos, solo se consideran las de los alumnos que ingresan a la escuela sin libros de texto<br>";
									?>
									<style>th{ text-align:center}</style>
									<table class="table table-bordered table-condensed"><?
										if ($basenivel==4){?>
											<tr   bgcolor="#CCCCCC" style="color:white"> <th  >Escuela - Turno</th><th  ></th><th >a1</th><th  >a2</th><th  >a3</th><th  >a4</th><th  >a5</th><th  >a6</th><th  >Alumnos</th></tr> <?
										}else{?>
											<tr   bgcolor="#CCCCCC" style="color:white"> <th  >Escuela - Turno</th><th  ></th><th  >a1</th><th  >a2</th><th  >a3</th><th  >Alumnos</th></tr> <?
										} 	
										$r=0; $ban=0;		$sa1=0;	$sa2=0; $sa3=0; $sa4=0; $sa5=0; $sa6=0;        $sg1=0; $sg2=0; $sg3=0; $sg4=0; $sg5=0; $sg6=0;
										while ($r<$vl_regs1){
											if ($ban==0){	
												$elcolor="#EEFFCA"; 
												++$ban; 
											}else{ 
												$ban=0; 
												$elcolor="#FFFFFF";
											}   
											$recset1=mysql_fetch_array($res1,MYSQL_ASSOC);
											$recset2=mysql_fetch_array($res2,MYSQL_ASSOC);
											if ($basenivel==4){	
												$liga="../ingresoplantel/matricula.php?qwerty=2&imprime=1&n=4&origen=8&lallaveescuela=".$recset1["Escuela"].$recset1["turno"]."&escuela=".$recset1["nom_ct"];
												echo "<tr bgcolor='#FFFFFF'>
													<td rowspan='3' bgcolor='#FFFFFF' align='center' width='20%'><span >".$recset1["Escuela"]." - ".$recset1["turno"]."</span><br>
												<br><b>Fecha de actualizaci&oacute;n</b> ".getFechaMovimientoMatricula($recset1["Escuela"],$recset1["turno"])."<br>
												</td><td align='center'><div align='left'>Matrícula asignada</div></td>	
												<td align='right'>".$recset1["a1"]."</td><td align='right'>".$recset1["a2"]."</td><td align='right'>".$recset1["a3"]."</td><td align='right'>".$recset1["a4"]."</td><td align='right'>".$recset1["a5"]."</td> <td align='right'>".$recset1["a6"]."</td>
												<td align='right'>".$recset1["Alumnos"]."</td>";
												
												
												echo "</tr>";											


												$a1b=$recset2['a1'];
												$a2b=$recset2['a2'];
												$a3b=$recset2['a3'];
												$a4b=$recset2['a4'];
												$a5b=$recset2['a5'];
												$a6b=$recset2['a6'];

												echo "<tr  bgcolor='#FFFFFF'><td align='center'><div align='left'>Matrícula real</div></td>";
												echo "<td align='right'>".$a1b."</td>";
												echo "<td align='right'>".$a2b."</td>";
												echo "<td align='right'>".$a3b."</td>";
												echo "<td align='right'>".$a4b."</td>";
												echo "<td align='right'>".$a5b."</td>"; 
												echo "<td align='right'>".$a6b."</td>";
												echo "<td align='right'>".$recset2["alumnos"]."</td>";
																
												echo "</tr>";	
											
												echo "<tr  class='bg-primary'><td align='center'><b><div align='left'>Diferencias</div></b></td>";
												if (($a1b+$al1)>$recset1["a1"]){
													echo "<td   align='right'>".($recset1["a1"]-($a1b+$al1))."</td>"; 
												}else{ 
													echo "<td  align='right'>".($recset1["a1"]-($a1b+$al1))."</td>"; 
												}
												if (($a2b+$al2)>$recset1["a2"]){
													echo "<td   align='right'>".($recset1["a2"]-($a2b+$al2))."</td>";  
												}else { 
													echo "<td  align='right'>".($recset1["a2"]-($a2b+$al2))."</td>"; 
												}
												if (($a3b+$al3)>$recset1["a3"]){
													echo "<td   align='right'>".($recset1["a3"]-($a3b+$al3))."</td>";  
												} else { 
													echo "<td  align='right'>".($recset1["a3"]-($a3b+$al3))."</td>"; 
												}
												if(($a4b+$al4)>$recset1["a4"]){
													echo "<td   align='right'>".($recset1["a4"]-($a4b+$al4))."</td>";  
												} else { 
													echo "<td  align='right'>".($recset1["a4"]-($a4b+$al4))."</td>"; 
												}
												if(($a5b+$al5)>$recset1["a5"]){
													echo "<td   align='right'>".($recset1["a5"]-($a5b+$al5))."</td>";  
												} else { 
													echo "<td  align='right'>".($recset1["a5"]-($a5b+$al5))."</td>"; 
												}
																																				
												if (($a6b+$al6)>$recset1["a6"]){
													echo "<td   align='right'>".($recset1["a6"]+-($a6b+$al6))."</td>";  
												} else { 
													echo "<td  align='right'>".($recset1["a6"]-($a6b+$al6))."</td>"; 
												}
												if(($recset2["alumnos"]+$al1+$al2+$al3+$al4+$al5+$al6)>$recset1["Alumnos"])
												{
													echo "<td   align='right'>".($recset1["Alumnos"]-($recset2["alumnos"]+$al1+$al2+$al3+$al4+$al5+$al6))."</td>";  
												} else { 
													echo "<td  align='right'>".($recset1["Alumnos"]-($recset2["alumnos"]+$al1+$al2+$al3+$al4+$al5+$al6))."</td>"; 
												}
												$sa1=$sa1+($recset1["a1"]-($recset2["a1"]+$al1));
												$sa2=$sa2+($recset1["a2"]-($recset2["a2"]+$al2));
												$sa3=$sa3+($recset1["a3"]-($recset2["a3"]+$al3));
												$sa4=$sa4+($recset1["a4"]-($recset2["a4"]+$al4));
												$sa5=$sa5+($recset1["a5"]-($recset2["a5"]+$al5));
												$sa6=$sa6+($recset1["a6"]-($recset2["a6"]+$al6));
											}else{// cuando $basenivel no es 4
												$liga="../ingresoplantel/matricula.php?qwerty=21&imprime=1&n=$basenivel&origen=8&lallaveescuela=".$recset1["Escuela"].$recset1["turno"]."&escuela=".$recset1["nom_ct"];	
												echo "<tr  bgcolor='#FFFFFF'><td rowspan='3' bgcolor='#FFFFFF' align='center' width='20%'><span class='negra_18'>".$recset1["Escuela"]." - ".$recset1["turno"]."</span><br>
												<br><b>Fecha de actualizaci&oacute;n</b> ".getFechaMovimientoMatricula($recset1["Escuela"],$recset1["turno"])."<br>
												
												</td><td align='center'><div align='left'>Matrícula asignada </div></td>	
												<td align='right'>".$recset1["a1"]."</td><td align='right'>".$recset1["a2"]."</td><td align='right'>".$recset1["a3"]."</td>
												<td align='right'>".$recset1["Alumnos"]."</td>";

												//echo "<td align='right'>".$recset1["g1"]."</td> <td align='right'>".$recset1["g2"]."</td><td align='right'>".$recset1["g3"]."</td> <td align='right'>".$recset1["Grupos"]."</td>
												echo "</tr>	";											
												echo "<tr  bgcolor='#FFFFFF'><td align='center'><div align='left'>Matrícula real</div></td>
												<td align='right'>".$recset2["a1"]."</td><td align='right'>".$recset2["a2"]."</td><td align='right'>".$recset2["a3"]."</td>
												<td align='right'>".$recset2["alumnos"]."</td>";
												//echo "<td align='right'>".$recset2["g1"]."</td> <td align='right'>".$recset2["g2"]."</td><td align='right'>".$recset2["g3"]."</td> <td align='right'>".$recset2["grupos"]."</td>";
												echo "</tr>	";											
												echo "<tr  class='bg-primary'><td align='center'><b><div align='left'>Diferencias</div></b></td>";
												if (($recset2["a1"]+$al1)>$recset1["a1"]){echo "<td   align='right'>".($recset1["a1"]-($recset2["a1"]+$al1))."</td>";  
												} else { echo "<td  align='right'>".($recset1["a1"]-($recset2["a1"]+$al1))."</td>"; }
												if (($recset2["a2"]+$al2)>$recset1["a2"]){echo "<td   align='right'>".($recset1["a2"]-($recset2["a2"]+$al2))."</td>";  
												} else { echo "<td  align='right'>".($recset1["a2"]-($recset2["a2"]+$al2))."</td>"; }
												if (($recset2["a3"]+$al3)>$recset1["a3"]){echo "<td   align='right'>".($recset1["a3"]-($recset2["a3"]+$al3))."</td>";  
												} else { echo "<td  align='right'>".($recset1["a3"]-($recset2["a3"]+$al3))."</td>"; }

												if (($recset2["alumnos"]+$al1+$al2+$al3)>$recset1["Alumnos"]){echo "<td   align='right'>".($recset1["Alumnos"]-($recset2["alumnos"]+$al1+$al2+$al3))."</td>";  
												} else { echo "<td  align='right'>".($recset1["Alumnos"]-($recset2["alumnos"]+$al1+$al2+$al3))."</td>"; }

												$sa1=$sa1+($recset1["a1"]-($recset2["a1"]+$al1));
												$sa2=$sa2+($recset1["a2"]-($recset2["a2"]+$al2));
												$sa3=$sa3+($recset1["a3"]-($recset2["a3"]+$al3));
											} // fin de condicion $basenivel=4
											$r++;
											?><tr><td colspan="9"><hr></td></tr><?
										}	
										// Para el renglon de los totales DE LA ZONA !!!!!
										if ($basenivel==4){		
													echo "<tr bgcolor='#FFFFFF'><td colspan='2' class='negra_16'>Totales de la zona</td>";	
													if ($sa1<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
													echo $sa1."</td>";
													if ($sa2<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
													echo $sa2."</td>";
													if ($sa3<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
													echo $sa3."</td>";
													if ($sa4<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
													echo $sa4."</td>";
													if ($sa5<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
													echo $sa5."</td>";
													if ($sa6<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
													echo $sa6."</td>";
													if (($sa1+$sa2+$sa3+$sa4+$sa5+$sa6)<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
													echo ($sa1+$sa2+$sa3+$sa4+$sa5+$sa6)."</td>";
										}else{  // si la condicion $basenivel NO ES 4 
												echo "<tr bgcolor='#FFFFFF'><td colspan='2' class='negra_16'>Totales de la zona</td>";	
												if ($sa1<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
												echo $sa1."</td>";
												if ($sa2<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
												echo $sa2."</td>";
												if ($sa3<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
												echo $sa3."</td>";
												if (($sa1+$sa2+$sa3)<0) { echo "<td class='roja_16' align='right'>"; } else {echo "<td class='negra_16' align='right'>";} 
												echo ($sa1+$sa2+$sa3)."</td>";
										}// fin de $basenivel=4
										?> 
									</table><br><br><br> <?	
								}else{ ?>
									<div class="fcenter fround">
										<p class="SaltoDePagina"></p><br><br><br><br>
										<h5 class="fbold fpadding-small"><i>Ninguna escuela de esta zona, ha registrado su matricula real, por lo que no hay conciliación aún</i></h5>
										<br><br><hr><br>
									</div>

								<? }
								if ($generadodesde==3){	echo "<span class='negra_22'><a href='$vl_back'>Regresar</a></span><br><br><br>";}
								break;	
							case 2: //       Avance POR ALMACEN de la captura de matricula (visto por jefes,almacenes y responsables de nivel ) se ven las zonas no concluidas se genera desde la ejecucion 102 solo para jefes
								$latabla="ctsev";
								$basenivel=$_GET["basenivel"];
								switch($basenivel){
									case 3:	
										switch($_SESSION["tipousuario"]){
											case "NivelPreesEstatal": $vl_losniveles="30"; $vl_tit="PREESCOLAR ESTATAL"; break;
											default: $vl_losniveles="30,31,32,34,35,36"; $vl_tit="PREESCOLAR";	break;
										}	
										break;
									case 4:	
										switch($_SESSION["tipousuario"]){
											case "NivelPrimariaEstatal": $vl_losniveles="40"; $vl_tit="PRIMARIA ESTATAL";	break;
											case "NivelPrimariaIndigen": $vl_losniveles="42"; $vl_tit="PRIMARIA INDÍGENA"; break;
											case "NivelPrimFederal": $vl_losniveles="41"; $vl_tit="PRIMARIA FEDERAL";	break;
											default: $vl_losniveles="40,41,42,45,46"; $vl_tit="PRIMARIA";	break;
										}	
                                        $vl_tit=$_SESSION["vg_tipousuario"]."JAJAJAJAJA";
										break;
									case 6:	
										$latabla="ctsev";
										switch($_SESSION["tipousuario"]){
											case "NivelSecundEstatal": $vl_losniveles="60"; $vl_tit="SECUNDARIA ESTATAL";	break;
											case "NivelSecund": $vl_losniveles="61,65"; $vl_tit="SECUNDARIA";	break;
											default: $vl_losniveles="60,61,65"; $vl_tit="SECUNDARIA";	break;
										}												
										break;
									case 7:	
										switch($_SESSION["tipousuario"]){
											default: $vl_losniveles="72,73,74,76";  $vl_tit="TELESECUNDARIA"; break;
										}												
										break; 
								}
							



								if ($_SESSION["vg_tipousuario"]=="Almacen"){
									$elalmacen=$_SESSION["vg_idalmacen"];
									$ladescalmacen=$logeado;		
									echo "<br><span class='negra_20'>Almacen Num. ".$elalmacen." - ".$ladescalmacen."</span><br>";											
								}else{
									if (!isset($_GET["almacen_seleccionado"])){
										$_sql="select idalmadis,almadis,count(cct) as Escuelas,nivel,SUM(if(day(fecha_matricula)>0,1,0)) as registradas,SUM(if(day(fecha_matricula)=0,1,0)) as porregistrar FROM ctsev where idnivel in (".$vl_losniveles.") and estatus='A' group by idalmadis order by idalmadis*1";
										//echo $_sql;
										$res=mysql_query($_sql); 		$r=0; 
										if (mysql_num_rows($res)>0){ 
												echo "<h3 class='fbold'>Balance de registro de matricula de Almacenes, nivel de $vl_tit</h3><br>";  ?> 
												<table id="tabla_imprime" width="750" border=1 align="center" style="border-color:#CCCCCC"> 
													<col class="col1"/><col class="col2"/><col class="col3"/><col class="col4"/><col class="col5"/><col class="col6"/><col class="col7"/>
													<tr><td colspan="7"><table><tr><td></td></tr></table></td></tr>

													<tr><td style="background:#F8F8F8; height:30px;"><b>Num</b></td><td style="background:#F8F8F8;"><b>Almacen</b></td><td style="background:#F8F8F8;"><b>Escuelas</b></td><td style="background:#F8F8F8;"><b>Registradas</b></td><td style="background:#F8F8F8;"><b>Por registrar</b></td><td style="background:#F8F8F8;">&emsp;<b>Estatus</b>&emsp;</td><td style="background:#F8F8F8;"></td></tr><? 
														while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); $tot=0; 
															$nomarreglo=""; $caddatos=$recset["idalmadis"]."|".$recset["almadis"]; 	?> 
															<tr> 
																<td><? echo $recset["idalmadis"]; ?></td> 
																<td align="left"><b><small><? echo $recset["almadis"]; ?></small></b></td> 
																<td align="right"><? echo $recset["Escuelas"]; ?></td> 
																<td align="right"><? echo $recset["registradas"]; ?></td> 
																<td align="right"><? echo $recset["porregistrar"]; ?></td> 
																<td><? if ($recset["porregistrar"]==0){ echo "<span style='color:green; font-weight:bold'>Concluida</span>"; }else{ echo "<small style='color:red'>Pendiente</small>"; } ?></td> 
																<td><a href="<? echo $autollamada."ejecucion=2&basenivel=".$basenivel."&almacen_seleccionado=".$recset["idalmadis"]."&bodega=".$recset["almadis"]; ?> " class="fbutton fround fpale-yellow fbold fpadding-small"><small>Ver detalle</small></a></td>
															</tr> <? 
															$tot1=$tot1+$recset["Escuelas"];	$tot2=$tot2+$recset["registradas"];	$tot3=$tot3+$recset["porregistrar"]; 	$r++; 
														} ?>		 
														<tr class="fdark-gray"><td colspan='2'>Total</td><td class='fright-align'><? echo number_format($tot1,0); ?></td><td class='fright-align'><? echo number_format($tot2,0); ?></td><td class='fright-align'><? echo number_format($tot3,0); ?></td><td class='fright-align'></td><td class='fright-align'></td></tr> 
												</table> 
											<? 
										}else{ ?>
												<? 
										}
									}else{
										$elalmacen=$_GET["almacen_seleccionado"];
										$ladescalmacen=$logeado;
									}	
								}
								
								$_sql="select (sector*1) as sector,(zonaescola*1) as zonaescola,cct_sector,cct_zona,nivel,count(cct) as Escuelas,SUM(if(day(fecha_matricula)>0,1,0)) as registradas,SUM(if(day(fecha_matricula)=0,1,0)) as porregistrar FROM ".$latabla." where estatus='A' and idnivel in (".$vl_losniveles.") and idalmadis=".$elalmacen."  group by cct_sector,cct_zona order by sector,zonaescola";
								// echo $_sql;
								$res=mysql_query($_sql); 		$r=0; 
								if (mysql_num_rows($res)>0){ 
										if (isset($_GET["bodega"])){ echo "<h3 class='fbold'>Almacen ".$_GET["bodega"]."</h3>"; }
										echo "<h4>Balance de registro de matricula de ".mysql_num_rows($res)." Zonas de $vl_tit</h4><br>";  ?> 
										<table id="tabla_imprime" width="750" border=1 align="center" style="border-color:#CCCCCC"> 

											<col class="col1"/><col class="col2"/><col class="col3"/><col class="col4"/><col class="col5"/><col class="col6"/><col class="col7"/><col class="col8"/>
											<tr><td colspan="8"><table><tr><td></td></tr></table></td></tr>

											<tr><td style="background:#F8F8F8; height:30px;"><b>Sector</b></td><td style="background:#F8F8F8;"><b>Zona</b></td><td style="background:#F8F8F8;"><b>Cct_zona</b></td><td style="background:#F8F8F8;"><b>Escuelas</b></td><td style="background:#F8F8F8;"><b>Registradas</b></td><td style="background:#F8F8F8;"><b>Por registrar</b></td><td style="background:#F8F8F8;">&emsp;<b>Estatus</b>&emsp;</td><td style="background:#F8F8F8;"></td></tr><? 
												while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); $tot=0; 
													$nomarreglo=""; $caddatos=$recset["sector"]."|".$recset["zona"]; 	?> 
													<tr> 
														<td><? echo $recset["sector"]; ?></td> 
														<td><? echo $recset["zonaescola"]; ?></td> 
														<td><b><small><? echo $recset["cct_zona"]; ?></small></b></td> 
														<td align="right"><? echo $recset["Escuelas"]; ?></td> 
														<td align="right"><? echo $recset["registradas"]; ?></td> 
														<td align="right"><? echo $recset["porregistrar"]; ?></td> 
														<td><? if ($recset["porregistrar"]==0){ echo "<span style='color:green; font-weight:bold'>Concluida</span>"; }else{ echo "<small style='color:red'>Pendiente</small>"; } ?></td> 
														<? 
														$enlace=$autollamada."ejecucion=1&cct_sector=".$recset["cct_sector"]."&cct_zona=".$recset["cct_zona"]."&zonaescola=".$recset["zonaescola"]."&sector=".$recset["sector"]."&pmbasenivel=".$basenivel."&pmnivel=".$recset["nivel"];
														if (isset($_GET["bodega"])){ $enlace=$enlace."&almacen_seleccionado=".$_GET["almacen_seleccionado"]."&bodega=".$_GET["bodega"]; } ?>
														
														<td><a href="<? echo $enlace; ?>" class="fbutton fround fpale-yellow fbold fpadding-small"><small>Recibo zona</small></a></td>
													</tr> <? 
													$tot1=$tot1+$recset["Escuelas"];	$tot2=$tot2+$recset["registradas"];	$tot3=$tot3+$recset["porregistrar"]; 	$r++; 
												} ?>		 
												<tr class="fdark-gray"><td colspan='3'>Total</td><td class='fright-align'><? echo $tot1; ?></td><td class='fright-align'><? echo $tot2; ?></td><td class='fright-align'><? echo $tot3; ?></td><td class='fright-align'></td><td class='fright-align'></td></tr> 
										</table> 
									<? 
								}else{ ?>
										<? 
								}

								break;
						} ?>
					</div><br><br><?		
				}   // FIN DE ACCESO NO PERMITIDO?></span>
			</div>
		</div>
	</div>
</body>
</html>






<?php

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

function PieRecibo($contenido,$direnviado){
	?>
	<table width="100%">
		<tr>	
				<td class="text-center"><?php echo GenerarQR($contenido,$direnviado); ?></td> 
				<td class="text-center"><small>Fecha de devolución y/o entrega de paquetes libros</small><br><br><br><small>________________________ VER. A ______ DE___________________ DE 2023</small></td></tr>
		</tr>
	</table>
	<br>
	<table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px">
		<tr>
			<td width="30%"><span style="font-weight:bold">ENTREG&Oacute;</span><br><br>____________________________________<br><small>NOMBRE Y FIRMA DEL ALMACEN <? echo $firma_entrega; ?></small> <br></td>
			<td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             
			<td width="30%"><span style="font-weight:bold">RECIBIÓ</span><br><br>___________________________________<br><small>NOMBRE Y FIRMA DEL SUPERVISOR <? echo $firma_recibe; ?></small><br></td>
			<td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                
		</tr>                    
	</table>
	<br><br>
	<div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
	<br><div align="left"><span style='font-size:10px; text-align:left; font-weight:100'><? echo url_actual(); ?></span></div>
	<?php
}   


function getFechaMovimientoMatricula($cct,$turno){
	//$essecundaria=esSecundaria($cct);
	//if($essecundaria==1){
		$tabla="ctsev";	
	//}else{
	//	$tabla="ctsev";
	//}
	
	$sql="select date_format(fecha_matricula,'%d/%m/%Y') as fecha_matricula from $tabla where cct='$cct' and turno='$turno'";
	$rsql=mysql_query($sql)or die('no se puede ejecutar sql');
	$filsql=mysql_fetch_array($rsql);
	$fecha_matricula=$filsql['fecha_matricula'];
	mysql_free_result($rsql);
	return $fecha_matricula;
	//return $sql;
	
	
}

function PieReciboBORRALO(){
	?>
	<table class="table table-condensed">
	<!--<tr><td colspan="4" class="small text-center">* Libro del Docente sujeto a disponibilidad</td></tr> -->
	<tr >	

	<td class="text-center">FECHA DE ENTREGA____________________________VER. A _______ DE___________2022</td>	 
	</tr></table>
	<table class="table table-condensed">                                                                         </tr>
	<tr><td align="center">RECIBI&Oacute;</td><td align="center">&nbsp;</td><td align="center">ENTREG&Oacute;</td></tr>	   	
	<tr><td align="center">&nbsp;</td><td align="center"> SELLO  </td> <td align="center">&nbsp;</td></tr> 
	<tr><td align="center">_____________________________________</td><td align="center">&nbsp;</td><td align="center">____________________________________</td></tr>
	<tr><td align="center">NOMBRE Y FIRMA RESPONSABLE DE ALMACEN</td><td align="center">&nbsp;</td><td align="center">NOMBRE Y FIRMA SUPERVISOR ESCOLAR</td></tr></table>
	<?php
}
?>
