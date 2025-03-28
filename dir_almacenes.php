<!doctype html>
<html>
<head>
<title>Directorio Almacenes</title>
<meta charset="ISO-8859-1" />
<meta http-equiv="Content-type" content="text/html; charset=ISO-8859-1" />
<meta name="viewport" content="width=device-witdh,initial-scale=1">

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
require_once('conecta2023.php');
conectalo("zona");
require_once("code_php/Almacenes.php");
?>
<div class="container" >
<div class="row">
	<div class="col-md-12">
  	<img class="img-responsive" src="images/logo_SEVGob.png" width="1024" >
    
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h4>Coordinaci&oacute;n Estatal de Apoyo para la Mejora Educativa</h4>  
        <nav class="navbar navbar-default">

<ul class="nav navbar-nav">
 <li ><a href="index.htm">Inicio</a></li>
<!--<li><a href="contacto_general.php?ejecucion=1">Contacto</a></li> -->
<li><a href="ingresoprevio.php">Acceso Usuarios</a></li>
<li><a href="dir_ceac.html">Directorio</a></li>
<li class="active"><a href="dir_almacenes.php">Dir almacenes</a></li>
<li><a href="Gac2015-321Jueves13.pdf" target="_blank">Lineamientos generales</a></li>

</ul>

</nav>      
	</div>
	

	</div>
<div class="row">
<div class="col-md-12">
<h4>Directorio Almacenes</h4> 
<?php
echo tablaAlmacenes("pub");
?>
</div>
</div>
    
</div>
<div class="row">
						<div class="col-md-12 text-center">
								
											<a href="index.htm" class="btn btn-default" ><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar </a>
								
						</div>
				</div>
</div><br>
</body>
</html>