<? session_start(); 	
require_once("inc/__conectaBD.php");    $fp = fopen("inc/__conectaBD.txt", "r");    $arr_conex=explode("|",fread($fp,filesize ("inc/__conectaBD.txt")));      fclose($fp);   	conectalo($arr_conex[1],$arr_conex[0],7);   

// ***************************************************************************************

if(!isset($_SESSION["mv"])){ 
	if(!isset($_GET['mywid'])) {
		if (isset($_GET["ky"])){ $banparaky="&ky=".$_GET["ky"]."&selcity=".$_GET["selcity"];}else {$banparaky="";}
		$ban=0;    if(isset($_GET['ya'])){ $ban=1; }   echo "<script language=\"JavaScript\">document.location=\"$PHP_SELF?&ya=$ban".$banparaky."&mywid=\"+screen.width; </script>";
	}else{
		if ($_GET['mywid']<500){ $_SESSION["mv"]=1; }else{ $_SESSION["mv"]=2; }
		if($_GET['ya']==0){    //echo "<br><br><br>CONTANDO";
			$vl_res=mysqli_query($link,"select * from y_acceso where fecha='".date("Y/m/d")."'");     			$vl_regs=mysqli_num_rows($vl_res);	 
            if ($vl_regs==0){
				if ($_SESSION["mv"]==1){ mysqli_query($link,"insert into y_acceso values ('".date("Y/m/d")."',0,1,0,0)");}else{mysqli_query($link,"insert into y_acceso values ('".date("Y/m/d")."',1,0,0,0)");}
            }else{
                if ($_SESSION["mv"]==1){ mysqli_query($link,"update y_acceso set chico=chico+1 where fecha='".date("Y/m/d")."'");}else{mysqli_query($link,"update y_acceso set grande=grande+1 where fecha='".date("Y/m/d")."'");}
			}
		}	
	}
}
// ***************************************************************************************
$arr=explode("/",$_SERVER["PHP_SELF"]);
$autollamada=$arr[count($arr)-1]."?";

if (isset($_GET["otr"])){unset($_SESSION["selstate"]); unset($_SESSION["selcity"]);}
if (isset($_GET["close"])){unset($_SESSION["vg_idusuario"]); }

if(isset($_GET["selcity"])){
	$_SESSION["selcity"]=$_GET["selcity"];
}

if(isset($_SESSION["selcity"])){
	$arr_ciudad=explode("|",$_SESSION["selcity"]);
}	

ob_start("comprimir_pagina"); ?>

<!DOCTYPE html>
<html lang="es">
<head>
<title>Ya vendo online !</title>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Keywords" content="restaurant, comida, pizza, hamburguesa, taqueria, tacos,comida para llevar,comida rapida,pasteleria">
		<link rel="stylesheet" href="css/frc2.css" /> 
		<link rel="stylesheet" type="text/css" href="css/frcico.css" />  
		<script type="text/javascript" src="inc/fancy217/lib/jquery-1.10.2.min.js"></script>	<script type="text/javascript" src="inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>	<link rel="stylesheet" type="text/css" href="inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />
		<script type="text/javascript" languaje="javascript">var message = "";function rtclickcheck(keyp){ if (navigator.appName == "Netscape" && keyp.which == 3){ alert(message); return false; }if (navigator.appVersion.indexOf("MSIE") != -1 && event.button == 2) { alert(message); return false; } }document.onmousedown = rtclickcheck;</script>
</head>
<body class="fblack fcenter" style="max-width:1400px; margin-left:auto; margin-right:auto">
<? if (!isset($_GET["ky"])){ ?>
	<div class="frow fmargin-top  fleft-align ftransparent ftop">
            <div class="fdropdown fdropdown-hover icon-menu fpadding-tiny fred">
                <div class="fdropdown-content fshad" style="width:230px">
						<?  if (isset($_SESSION["selcity"])){ 
									if (isset($_GET["cat"])){$bancategoria1=" and a.idcategoria!=".$_GET["cat"]." "; 			$bancategoria2=" and a.idcategoria=".$_GET["cat"]." ";}else{$bancategoria1="";      $bancategoria2="";   }
									$vl_res=mysqli_query($link,"select a.idcategoria,b.categoria,count(a.idempresa) from y_empresas a,ycat_categoria b where a.idcategoria=b.idcategoria and a.idciudad=".$arr_ciudad[1].$bancategoria1." and a.estatus='A' group by a.idcategoria order by count(a.idempresa) desc"); 
									while ($recset=mysqli_fetch_array($vl_res,MYSQLI_ASSOC)){ 
										?> <div class="fborder-bottom ftext-red"><a href="<? echo $autollamada."&cat=".$recset["idcategoria"]; ?>"><? echo $recset["categoria"]; ?></a></div><?
									}	 
									?> <div class="fborder-bottom ftext-indigo"><a href="<? echo $autollamada."&ya=1&otr"; ?>">Otra Ciudad</a></div>
						 <? } ?>
						<div class="fborder-bottom ftext-indigo"><a href="panel/op/empresa?ex=2">Registrar Negocio</a></div>
						<div class="fborder-bottom ftext-indigo"><a href="panel/login">Ingreso negocio registrado</a></div>
						<div class="fborder-bottom ftext-indigo"><a href="contacto.php">Contacto</a></div>
						<? if($_SESSION["mv"]==1){ ?>
							<div class="fborder-bottom"><a href="<? echo $autollamada; ?>">Cerrar <span class="icon-left-dir"></span></a></div>
						<? } ?>	


                </div>    
            </div>
    </div>
    <? if (!isset($_SESSION["selcity"])){ ?>
    
      <header class="fshad">
	  <div class="frow fcenter fmargin-bottom fgray fshad">
	  			<? if($_SESSION["mv"]==2){  ?>
						<h2 class="fround fpadding-medium fblack"><strong>Directorio de Negocios Comerciales</strong></h2>
				  <? }else{ ?>
					<h3 class="fround fpadding-medium fblack"><strong>Directorio de Negocios Comerciales</strong></h3>
				  <? } ?>		
			</div>
        <div class="fcontainer fcenter" style="background: linear-gradient(to bottom right, #00729A 0%, #003C67 100%);"> 
            <div class="frow fpadding-large">
												<img src="logo_yavendo_circular.png" width="<? if($_SESSION["mv"]==2){ echo "310"; }else{ echo "230"; } ?>">
											
	    	</div>	
                   <script>function selecciona(x){ setTimeout("window.location.replace('<? echo $autollamada; ?>ya=1&selstate="+document.getElementById("selestado").options[document.getElementById("selestado").selectedIndex].value+"')", 0);  }</script> 
												<span style="color:yellow; font-size:22px; font-bold:weight;">Seleccione Estado</span> &emsp;
												<select autofocus name='selestado' placeholder="OKOK" id='selestado' onChange="selecciona();" class="fpadding-tiny"><option value=0></option> 
														<? $consulta="select distinct a.cve_edo,a.estado from ycat_municipios a,y_empresas b where a.cve_edo=b.idestado and b.idempresa!=12 order by a.estado";
														$vl_res=mysqli_query($link,$consulta);  $vl_regs=mysqli_num_rows($vl_res);  $r=0;
														while ($r<$vl_regs){  
															$recset=mysqli_fetch_array($vl_res,MYSQLI_ASSOC); $ban="";
															if ($recset["cve_edo"]==$_GET["selstate"]){$ban=" selected";}
															echo "<option value='".$recset["cve_edo"]."'".$ban.">".$recset["estado"]."</option>";
															$r++;
														}  ?>
												</select>
												<? if (isset($_GET["selstate"])){ ?>
													<script>function selecciona(x){ setTimeout("window.location.replace('<? echo $autollamada; ?>selcity="+document.getElementById("selciudad").options[document.getElementById("selciudad").selectedIndex].value+"#banner')", 0);  }</script> 
													<br><br>
													<span style="color:yellow; font-size:22px; font-bold:weight;">Seleccione Ciudad</span> &emsp;		
													<select autofocus name='selciudad' id='selciudad' onChange="selecciona();"  class="fpadding-tiny"><option value=0></option> 
															<? $consulta="select distinct a.cve_edo, a.cve_mpio,a.estado,a.mpio from ycat_municipios a,y_empresas b where a.cve_edo=b.idestado and a.cve_mpio=b.idciudad and a.cve_edo=".$_GET["selstate"]." and b.idempresa!=12 order by a.estado,a.mpio";
															$vl_res=mysqli_query($link,$consulta);  $vl_regs=mysqli_num_rows($vl_res);  $r=0;
															while ($r<$vl_regs){  
																$recset=mysqli_fetch_array($vl_res,MYSQLI_ASSOC); $ban="";
																
																echo "<option value='".$recset["cve_edo"]."|".$recset["cve_mpio"]."|".$recset["estado"]."|".$recset["mpio"]."'>".$recset["mpio"]."</option>";
																$r++;
															}  ?>
													</select><?
												} ?>
		<br><br><br><br>
        </div>
      </header>

			<div class="frow" style="max-width:1200px; margin-left:auto; margin-right:auto">
				<div class="fthird">
					<section class="fround fround fshad  fpadding-tiny fmargin fwhite">		
										<h2>La mejor opción</h2>
									<ul class="check-list">
										<li>Contacto directo con clientes</li>
										<li>Geolocalización</li>
										<li>Actualización de ofertas</li>
										<li>Actualización de imagen</li>
										<li>Botón Compartir
											<small><br>Los visitantes podrán compartir tu negocio en sus redes sociales</small>
										</li>


									</ul>								
					</section>				
				</div>
				<div class="fthird">
								<a href="panel/op/empresa?ex=2" class="fhover-sepia">
									<section class="fround fcenter fround fshad  fpadding-tiny fmargin fwhite">
										
											<? if($_SESSION["mv"]==2){echo "<h2>Cobertura Nacional<br><span style='color:red; font-weight:bold;'>Registra ya tu Negocio !</span></h2>"; }else{ echo "<h3>Cobertura Nacional<br><span style='color:red; font-weight:bold;'>Registra ya tu Negocio</span></h3>"; } ?>
											<img src="img/add-directory3.png" width="120">
											<!--<br><small><i>Gratís los primeros 50 negocios <br class="fhide-large">en cada ciudad !</i></small>-->
										
										<!--<video src="videos/TlapacoyanFaby.mp4" width="<? if($_SESSION["mv"]==2){echo "60";}else{ echo "70";}?>%" controls></video>-->
									</section>
								</a>
								<a href="panel/op/empresa?ex=2" class="fhover-sepia">
								<section class="fround fcenter fround fshad  fpadding-tiny fmargin fwhite">
									<img src="publicidad_x.png" width="100%">
											<!--<img src="logo_yavendo_circular.png" width="<? if($_SESSION["mv"]==2){ echo "280"; }else{ echo "230"; } ?>">-->
								</section>	
								</a>
											

				</div>
				<div class="fthird">
						<a href="panel/login" class="fhover-sepia">
								<section class="fround fcenter fshad fround fpadding-tiny fmargin fwhite">
										
											<h4>Ingreso Negocio Registrado</h4>
											<img src="img/login-blue.jpg" width="100">
											<br><small><i>Para actualización de ofertas <br class="fhide-large">y datos del negocio</i></small>
									
								</section>
						</a>
				</div>

			</div>									


    <?}else{  // si ya existe $_SESSION["selcity"] ?>

      <section class="fblack">
	  		<div class="frow fcenter fmargin-bottom fgray ">
			  	<? if($_SESSION["mv"]==2){ ?>
						<h2 class="fround fpadding-medium ftext-white" style='background: linear-gradient(to bottom right, #336699 0%, #000066 100%);'><strong><? echo $arr_ciudad[3].", ".$arr_ciudad[2]; ?></strong></h2>
				  <? }else{ ?>		
					<h3 class="fround fpadding-medium ftext-white" style='background: linear-gradient(to bottom right, #336699 0%, #000066 100%);'><strong><? if (strlen($arr_ciudad[3].", ".$arr_ciudad[2])>16){echo $arr_ciudad[3]; }else{ echo $arr_ciudad[3].", ".$arr_ciudad[2]; }?></strong></h3>
				  <? } ?>	
			</div>
            <div class="frow">
							<?
						

							//$vl_res=mysqli_query($link,"select e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where  a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1]." and a.abierto!='X' group by a.idempresa) e, y_empresas_ofertas f where e.idempresa=f.idempresa and e.pedidos<7 ".$catcond." group by e.idempresa order by e.pedidos");
										/*  SOLO CAMBIE A LEFT JOIN LA RELACION ENTRE E Y F Y  QUITE LA CONDICION DE PEDIDOS MENOR QUE 7 */
										/*  PARA MOSTRAR A TODOS, INCLUYENDO A LOS QUE NO TIENEN OFERTAS */
										/* por ultimo agregue random a la seleccion */
								       if (isset($_GET["ky"])){ $banky="a.idempresa!=".$_GET["ky"]." and ";   $banky2="a.idempresa=".$_GET["ky"]." and "; }else{$banky=""; $banky2="";}
                                       if ($condcombos!=""){ 
											// Estos eran cuando limite la categoria a 1 (coomida)
//											$consul="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1]." and a.".$condcombos." and a.abierto!='X' and a.idcategoria=1 group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  
//											$conky="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky2."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1]." and a.".$condcombos." and a.abierto!='X' and a.idcategoria=1 group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  

											$consul="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1].$bancategoria2." and a.".$condcombos." and a.abierto!='X' group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  
											$conky="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky2."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1]." and a.".$condcombos." and a.abierto!='X' group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  

									   }else{
											// Estos eran cuando limite la categoria a 1 (coomida)
//											$consul="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1]." and a.abierto!='X' and a.idcategoria=1 group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  	   
//											$conky="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky2."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1]." and a.abierto!='X' and a.idcategoria=1 group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  	   

											$consul="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1].$bancategoria2." and a.abierto!='X' group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  	   
											$conky="select  (sin(e.idempresa * rand())) as Rd,e.*,count(f.idempresa) as ofertas FROM (SELECT a.*,count(b.idempresa) as pedidos FROM y_empresas a LEFT JOIN y_empresas_pedidos b ON a.idempresa=b.idempresa and b.status='P' where ".$banky2."a.estatus!='X' and a.idestado=".$arr_ciudad[0]." and a.idciudad=".$arr_ciudad[1]." and a.abierto!='X' group by a.idempresa) e LEFT JOIN y_empresas_ofertas f ON e.idempresa=f.idempresa ".$catcond." group by e.idempresa order by e.pedidos,count(f.idempresa) desc,Rd";  	   
									   }	
										$vl_res=mysqli_query($link,$consul);
										//echo $consul;
										$vl_regs=mysqli_num_rows($vl_res);
										if($vl_regs>0){ $r=0; $col=0;
													while ($r<$vl_regs){
                                                        $col=$col+1;
                                                        if ($col==1){ 
															if($_SESSION["mv"]==2){
																echo "<div class='frow fcenter' style='background:linear-gradient(to bottom, #3E3E3E  1%, #5A5A5A  15%, #262626  88%)'>"; 
															}
														}
                                                        if ($_SESSION["mv"]==1){
																echo "<div class='frow fcenter' style='background:linear-gradient(to bottom, #3E3E3E  1%, #5A5A5A  15%, #262626  88%)'"; 
                                                        }
														
														if ($r==0 && isset($_GET["ky"])){
															$vl_resky=mysqli_query($link,$conky);
															$recset=mysqli_fetch_array($vl_resky,MYSQLI_ASSOC); 
														}else{
															$recset=mysqli_fetch_array($vl_res,MYSQLI_ASSOC); 	
														}
														$kyempresa=$recset['idempresa']; 
														//if ($_SESSION["mv"]==2){ $banlinea="<hr style='background:cyan' id='".$kyempresa."'>"; $banidchico=""; $marcar=""; $banletped=16;  $banletit=28;  $banletdesc=16;  $banfoth=70; }else{$banlinea=""; $banidchico=" id='".$kyempresa."'"; $marcar="<br><span style='font-size:12px'>M&aacute;rquenos</span>"; $banletped=14; $banletit=18; $banletdesc=16; $banfoth=100;} 

														//echo $banlinea; 

														
														?>
														<div class="fquarter fpadding-small fcenter">
															<br>
																<? if($_SESSION["mv"]==2){ 
																		$liga=$autollamada."ky=".$recset['idempresa']."&cat=".$recset['idcategoria'];
																	}else{
																		$liga="negociodet.php?ky=".$recset['idempresa']."&cat=".$recset['idcategoria']; 
																	} ?>
																<a href="<?  echo $liga; ?>" class="bordered-feature-image">
																	<?	$estafoto=""; 
																	if (file_exists("panel/op/fotos/".$kyempresa.".jpg")){	$estafoto="panel/op/fotos/".$kyempresa.".jpg"; }
																	if (file_exists("panel/op/fotos/".$kyempresa.".jpeg")){	$estafoto="panel/op/fotos/".$kyempresa.".jpeg"; }
																	if (file_exists("panel/op/fotos/".$kyempresa.".png")){	$estafoto="panel/op/fotos/".$kyempresa.".png"; }															
                                                                    $arrfo=getimagesize($estafoto);     if($arrfo[0]>=$arrfo[1]){ $banfoth="100"; } else { $banfoth=80; }
																	if ($estafoto!=""){
																		echo "<img class='fround fshad fpadding-medium fwhite' src='".$estafoto."' width='".$banfoth."%'>";
																	}else{ 
																		if ($recset['idcategoria']==1){
																						echo "<img class='fround fshad fpadding-medium fwhite' src='generic.jpg' width='60%'>";
																		}else{
																						echo "<img class='fround fshad fpadding-medium fwhite' src='generico.jpg' width='60%'>";
																		}
																	}  ?>	
																</a>
																	<h3 style="text-align:center; color:cyan"><strong><? echo $recset['nombre']; ?></strong></h3>
																	<strong><?  echo $recset['descripcion']; ?></strong>
																	<br><br><br><br>
																	
														</div><?
                                                        if ($col==4){ echo "</div>"; $col=0; }
														$r++;
														
													}   ?>
												
										<?}else{
											if (isset($_SESSION["selcity"])){?>
												<div class="fcontainer fpadding-large fcenter" style="color:yellow">
											<? if($_SESSION["mv"]==2){ ?><h1>Que su negocio sea el primero<br>en registrarse en esta ciudad</h1> <? }else{ ?> <h2>Que su negocio sea el primero<br>en registrarse en esta ciudad</h2> <? } ?>
													<br><br>
													
													<div class="fbutton fpadding-medium" style="background:#C70039; font-size:24px; font-weight:bold"><a href="panel/op/empresa?ex=2">Registrar</a></div>
												</div><?
											}
										}?>
			</div>


      </section>
    <? } ?>  
      <footer class="ffooter">
      </footer>
<? }else{
	$vl_back=$autollamada."ya=1";
	$color="fwhite";   ?> <div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div> <div id="seccionX" style="width:100%; display:none; height:100%"><table width="100%" height="100%" cellpadding="0" cellspacing="0" border="1" class="<? echo $color; ?> fcenter"><tr><td>
			<? include("negociodet.php"); ?>		
			</td></tr></table></div> <script> 	$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterClose': function(){ location.replace('<? echo $vl_back; ?>'); } }); }); </script><?
	
}	?> 
</body>
</html>
<script type="text/javascript">
let targetScroll = window.innerHeight - pageHeader.offsetHeight;

window.addEventListener("scroll", () => {
const scrollY = this.pageYOffset;

if (scrollY > targetScroll) {
animatedUl.classList.add(showBtn);
} else {
animatedUl.classList.remove(showBtn);
}
});

window.addEventListener("resize", () => {
targetScroll = window.innerHeight - pageHeader.offsetHeight;
});
</script>