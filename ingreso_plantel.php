<?PHP session_start();
session_destroy();
if (isset($_GET["tipousuario"])) {
	$ban = "tipousuario=" . $_GET["tipousuario"] . "&";
} else {
	$ban = "";
}
if (!isset($_GET['w'])) {
	echo "<script language=\"JavaScript\">document.location=\"$PHP_SELF?" . $ban . "w=\"+screen.width;</script>";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<title>Libros Gratuitos Veracruz</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<SCRIPT TYPE="text/javascript" src="js/bootstrap.min.js"></SCRIPT>
	<SCRIPT TYPE="text/javascript" src="js/jquery-1.12.0.min.js"></SCRIPT>

	<SCRIPT TYPE="text/javascript" src="_funciones.js"></SCRIPT>
	<SCRIPT TYPE="text/javascript">
		function checa() {
			var m = document.getElementById("error");
			if (document.FrmLogin.TxtUsuario.value.length == 0) {
				m.innerHTML = "La Cuenta es obligatoria\n";
				document.FrmLogin.TxtUsuario.focus();
				return false;
			}
			if (document.FrmLogin.TxtTurno.value.length == 0) {
				m.innerHTML = "El turno es obligatori0\n";
				document.FrmLogin.TxtTurno.focus();
				return false;
			}
			if (document.FrmLogin.TxtPassword.value.length == 0) {
				m.innerHTML = "El password es obligatorio\n";
				document.FrmLogin.TxtPassword.focus();
				return false;
			}
		}
	</SCRIPT>
</head>

<body>
	<?php
	$formu_activo = 1;
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<img class="img-responsive" src="images/logo_SEVGob.png" width="1024">

			</div>
		</div>
		<div class="row">
			<div class="row" style="text-align:center">
				<h4>Coordinaci&oacute;n Estatal de Apoyo para la Mejora Educativa</h4>

				<b>Ingreso <? echo $_GET["tipousuario"]; ?></b><br>



			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				<p class="alert alert-warning">

					<span class="glyphicon glyphicon-alert" aria-hidden="true"></span> El ingreso es exclusivo para personal autorizado !
				</p>
			</div>
			<div class="col-md-6">
				<?php if ($_GET["tipousuario"] == "Plantel") {  /*?>
      <p class="alert alert-info">
  
  <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span> <b>AVISO IMPORTANTE</b><br>
  Estimado(a) Director(a) de Preescolar, Primaria, Secundaria y Telesecundaria: <b> <!--Primaria, Preescolar, Secundaria y Telesecundaria--></b> 
  </br>
  Le informarmos que ya puede descargar su recibo de asignaci&oacute;n

<!--  En el caso de nivel primaria, puede ya registrar su matr&iacute;cula de inicio de cursos.  
    </br>

Videotutorial de apoyo en el siguiente enlace:   </br>
<a href="https://www.youtube.com/watch?v=jbNrdBDatsA" target="_blank">https://www.youtube.com/watch?v=jbNrdBDatsA</a>
  </br>-->
  <strong><!--Seleccion de libros de Historia y Educación Cívica y Ética de 1er y 2do grado, del 25 al 27 junio de 2019 --></strong>
  <!--<b> SITIO EN ACTUALIZACI&Oacute;N. FAVOR DE INGRESAR MAS TARDE</b> -->
<!--  </p><p><a  href="ingresoplantel/manual_director_secu_2021.pdf" target="_blank">Tutorial de apoyo para el Director (PDF)</a></p>-->
<!--  <p><a  href="https://youtu.be/3hnntHxhGZI" target="_blank">Tutorial de apoyo para el Director (Videotutorial)</a></p>-->
	<? */
				} ?>
				<?php if ($_GET["tipousuario"] == "Maestro") { ?>
					<p class="alert alert-info">

						<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span><b> Aviso</b><br>
						Estimado Maestro: Le informamos que la selecci&oacute;n de libros del Ciclo 2021-2022 se llevar&aacute; a cabo del 17 al 29 de marzo.</b> de 2020. Recuerde debe poner su CURP como contraseña (solo la primera vez). </br> Recuerde que la elección del libro de su preferencia pedag&oacute;gica es su decisi&oacute;n y responsabilidad.
					</p>


				<? } ?>

			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<?php if ($_GET["tipousuario"] == "Maestro") { ?>
					<!--<div align="center"><iframe width="510" height="265" src="https://www.youtube.com/embed/dSh21pn4asI" frameborder="0" allowfullscreen></iframe></div>
                                  <br> -->
					<!--     <span class='verde_16'><a href="ingresoplantel/manual_maestro_secundaria_2016.pdf" target="_blank">Manual de usuario</a></span> -->
				<?php } ?>


				<?php if ($_GET["tipousuario"] != "Maestro") { ?>
					<table class="table table-bordered">
						<tr>
							<td colspan="2">Turnos</td>
						</tr>
						<tr>
							<td class="negra_12">1<br>2<br>3<br>4<br>5<br>6</td>
							<td class="negra_12">Matutino<br>Vespertino<br>Nocturno<br>Discontinuo<br>Continuo<br>
								Complementario</td>
						</tr>
					</table>
				<? } ?>

			</div>

			<div class="col-md-6">
				<table class="table">
					<div id="dis_formulario">
						<!--<div align="center"><h2>No disponible a&uacute;n</h2><br><br><br></div>-->
						<form name='FrmLogin' method='post' action='_panel.php?w=<? echo $_GET["w"]; ?>' onSubmit='return checa();'>
							<input type='hidden' name='hid_tipousuario' value='Plantel'>


							<tr>
								<td>Clave Escuela</td>
								<td>
									<input name="TxtUsuario" autofocus type="text" class="dis_input" onKeyPress="return enter(document.FrmLogin.TxtTurno);" size="12" maxlength="10" <?php if ($formu_activo == 0) {
																																															echo "disabled=disabled";
																																														} ?>>
								</td>
							</tr>
							<? if ($_GET["tipousuario"] != "Maestro") { ?>
								<tr>
									<td>Turno</td>
									<td>



										<input name="TxtTurno" type="text" class="dis_input" onKeyPress="return enter(document.FrmLogin.TxtPassword);" size="4" maxlength="4" <?php if ($formu_activo == 0) {
																																													echo "disabled=disabled";
																																												} ?>>
									</td>
								</tr>
							<?php } ?>
							<tr>
								<td>Contrase&ntilde;a</td>
								<td><input name="TxtPassword" type="password" class="dis_input" onKeyPress="return enter(document.FrmLogin.BtnSubmit);" size="22" maxlength="18" <?php if ($formu_activo == 0) {
																																														echo "disabled=disabled";
																																													} ?>></td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<div align="center">
										<input class="btn btn-default" type='submit' name='BtnSubmit' value='   Aceptar   ' <?php if ($formu_activo == 0) {
																																echo "disabled=disabled";
																															} ?>>
									</div>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center">
									<div align="center" id="error" class="roja_12"></div>
								</td>
							</tr>

				</table>
				</form>
			</div>




			<?php if ($_GET["tipousuario"] == "Plantel") {
				//echo "<span class='roja_16'>Estimado(a) Director(a) se ha enviado un comunicado a su correo, favor de revisarlo antes de ingresar. (05/03/2016)<br></span><br>"; 
				$vl_regreso = "ingresoprevio.php";
			}
			if ($_GET["tipousuario"] == "Maestro") {
				echo "<span class='roja_16'>Solo la primera vez que ingrese, escriba en la contrase&ntilde;a <br>su CURP (18 caracteres). Posteriormente si ya cambi&oacute su contrase&ntilde;a, <br>
												  &Eacute;sta s&oacute;lo permite un m&aacute;ximo de 8 caracteres<br> </span><br>";
			}
			if (isset($vl_regreso)) {   ?>
				<div align="center"><a href="<? echo $vl_regreso; ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a></div>
			<?php } ?>
			<!--<p>
											  En caso de tener problemas de ingreso, <a href="_contacto_problema_ingreso.php?tipousuario=<? echo $_GET["tipousuario"]; ?>">
											  cont&aacute;ctenos</a></p> -->




		</div>
	</div>

	</div>
</body>

</html>