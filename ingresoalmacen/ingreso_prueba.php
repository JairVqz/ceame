<?php session_start();   	 session_destroy(); 	
if (isset($_GET["tipousuario"])){$ban="tipousuario=".$_GET["tipousuario"]."&";}else{$ban="";}
if(!isset($_GET['w'])){ echo "<script language=\"JavaScript\">document.location=\"$PHP_SELF?".$ban."w=\"+screen.width;</script>"; } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
			<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>Libros Gratuitos Veracruz2</title>
			<link rel="stylesheet" href="css/bootstrap.min.css">

			<!--<link rel="stylesheet" href="css/frc.css" type="text/css" media="screen" />  No se debe usar aqui-->
			
			<SCRIPT TYPE="text/javascript" src="js/bootstrap.min.js"></SCRIPT>
			<SCRIPT TYPE="text/javascript" src="js/jquery-1.12.0.min.js"></SCRIPT>
			
			
			<SCRIPT TYPE="text/javascript" src="_funciones.js"></SCRIPT>
			<SCRIPT TYPE="text/javascript">
			function checa(){var m=document.getElementById("error");
			if (document.FrmLogin.TxtUsuario.value.length == 0) {
				m.innerHTML =  "La Cuenta es obligatoria\n";
				document.FrmLogin.TxtUsuario.focus();
				return false;	   
			}
			if (document.FrmLogin.TxtPassword.value.length == 0) {
				m.innerHTML= "El password es obligatorio\n";
				document.FrmLogin.TxtPassword.focus();
				return false;	   
				}   
			}
			</SCRIPT>
</head>
<body>
		<div class="container" style="max-width:1000px; margin-left:auto; margin-right:auto">
				<div class="row">
						<div class="col-md-12" style='text-align:center'>	<img class="img-responsive" src="images/logo_SEVGob.png" width="900" >	</div>
				</div>
				<div class="row" style="text-align:center">
						
							<h3>Coordinaci&oacute;n Estatal de Apoyo para la Mejora Educativa</h3>  
							<h4>Programa de Libros de Texto Gratuitos </h4>
							<!--<img src='transporte2.jpg' width="<? if ($_GET["w"]<400){ echo "100%"; }else{ echo "600"; }  ?>">--> 
						
				</div>
				<? if ($_GET["w"]>400){ echo "<br>"; }  ?>

				

				<div class="row">
					<div class="col-md-6" style="padding:10px">
									<p class="alert alert-warning text-justify"> <span class="glyphicon glyphicon-alert" aria-hidden="true"></span> El ingreso es exclusivo para personal autorizado. Por lo que al ingresar, 
										se inicia una sesi&oacute;n de trabajo, la cual por razones de SEGURIDAD debe CERRAR al finalizar.
										<br>
										Es por eso que en cada p&aacute;gina del panel de control aparecer&aacute; un bot&oacute;n, 
										mediante el cual usted podr&aacute; cerrar su actual sesi&oacute;n de trabajo.										
									</p>
					</div>
					<div class="col-md-6">
							<? 	
							$vl_procede=1;
							
							if (isset($_GET["tipousuario"])){
									//$mensaje="No disponible aún";
									switch ($_GET["tipousuario"]){
											case "Sector":
											case "Supervisor":
									//			   $vl_procede=0;
												   break;
									}
													
							}
							if ($_GET["tipousuario"]=="Supervisor"){ echo "<div class=roja_14>La contrase&ntilde;a es la misma que usa en INPESEV (7 d&iacute;gitos)<br>FAVOR DE CONSIDERAR QUE LAS CONTRASE&Ntilde;AS SE ACTUALIZARON RECIENTEMENTE</div><br>"; } 
							if ($vl_procede==1){   ?>
										<div  style="color:#C70039; font-size:16px; font-weight:bold; padding:7px; text-align:center">
										<h2>PRUEBA</h2>
										<?
										//if ($_GET["w"]>350){ echo "&emsp;&emsp;&emsp;"; } 
										if (isset($_GET["tipousuario"])){
											switch ($_GET["tipousuario"]){
												case "Sector":  		    echo "Ingreso Jefe de Sector";  		$vl_regreso="ingresoprevio.php";  		 break;	
												case "Supervisor":		 echo "Ingreso Supervisor";				$vl_regreso="ingresoprevio.php";		break;	
												case "Plantel":				echo "Ingreso Plantel"; 				$vl_regreso="ingresoprevio.php"; 		break;																
												case "Almacen":          echo "Ingreso Responsable de almacen";      break;
												//case "Almacenteles":  echo "Ingreso Responsable de almacen de Telesecundaria"; 			break;																			
											}											
										}else{
											echo "Ingreso";
										}
										?></div>							  
										<div id="dis_formulario">
												<form name='FrmLogin' method='post' action='_panel.php?w=<? echo $_GET["w"]; ?>' onSubmit='return checa();'>
															<? if (isset($_GET["exc"])){?><input type="hidden" name="hid_prueba" value="x">     <?} ?>
															<div class="form-group">
																	<? if (isset($_GET["tipousuario"])){  echo "<input type='hidden' name='hid_tipousuario' value='".$_GET["tipousuario"]."'>";  	}	?>
																	<table class="table" style="text-align:center; max-width:300px; margin-left:auto; margin-right:auto" > 
																			<tr><td align="left">Cuenta</td><td ><input name="TxtUsuario" autofocus type="text" <? if (isset($_GET["clagty"])){ echo "value='".$_GET["clagty"]."'"; }?> class="dis_input" onKeyPress="return enter(document.FrmLogin.TxtPassword);"  size="18" maxlength="10"></td></tr>
																			<tr><td align="left">Contrase&ntilde;a</td><td><input name="TxtPassword"  type="password"  <? if (isset($_GET["contyu"])){ echo "value='".$_GET["contyu"]."'"; }?> class="dis_input" onKeyPress="return enter(document.FrmLogin.BtnSubmit);"  size="18" maxlength="18"></td></tr>
																			<tr><td colspan="2" align="center"><div align="center"><input class="fbutton ftext-white" type='submit' name='BtnSubmit' value='   Ingresar   '></div></td></tr>
																			<tr><td colspan="2" align="center"><div align="center" id="error" class="roja_12"></div></td></tr>													
																	</table>
															</div>
												</form>
										</div>		
							<? }else{

									echo "<div align='center'><h2>".$mensaje."</h2></div>";
							} ?>
					</div>
				</div>
				<div class="row">
						<div class="col-md-12 text-center">
								<? if (isset($vl_regreso)){   ?>
											<a href="<? echo $vl_regreso; ?>" class="btn btn-default" ><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar </a>
								<? } ?>
								<div class="negra_12">
											<!--	En caso de tener problemas de ingreso, <a href="_contacto_problema_ingreso.php 		<?// if (isset($_GET["tipousuario"])){	echo "?tipousuario=".$_GET["tipousuario"];	}?> 												">cont&aacute;ctenos</a></div>-->
										<br>
								</div>	
						</div>
				</div>
				<div class="row">
					<div class="col-md-12">
										<!--<div class="btn-group-vertical" role="group" aria-label="...">
											<a class="btn btn-default" href="_contacto_problema_ingreso.php
											<? if (isset($_GET["tipousuario"])){
												echo "?tipousuario=".$_GET["tipousuario"];
											}?>
											">cont&aacute;ctenos</a>
											<a  class="btn btn-default" href="_contacto_problema_ingreso.php
											<? if (isset($_GET["tipousuario"])){
												echo "?tipousuario=".$_GET["tipousuario"];
											}?>
											">cont&aacute;ctenosfffffff</a>
						</div> -->
					</div>
				</div>
		</div>
</body>
</html>