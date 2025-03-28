<? session_start(); 	 require_once('../conecta2012.php');   require_once('../inc/funciones_libros.php'); 	conectalo("oficina");    ?>
<!DOCTYPE html>
<html><head>
<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Selección Nivel</title>
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  
<!--<LINK REL="stylesheet"  HREF="../css/bootstrap.min.css" >
<SCRIPT TYPE="text/javascript" src="../_funciones.js"></SCRIPT>-->
</head>
<body >
<div class="fcontainer fcenter"><?
	$vl_back="../_panel.php";
	// esto porque algunas zonas atienden a escuelas de diferentes niveles 
	banner_supervisor($_SESSION["vg_cct_zona"]);?>
	<table width="900" class="ftable-all"><tr><th>&nbsp;</th><th>Nivel</th><th>Almacen</th><th>Sector</th><th>Escuelas</th></tr>  <?
		$totescuelas=0; $vl_pontotales=0;
		$_sql="select idalmadis,almadis,idnivel,nivel,cct_sector,sector,COUNT(distinct cct) AS escuelas FROM ctsev_antes WHERE  cct_zona='".$_SESSION["vg_cct_zona"]."' GROUP BY idalmadis,idnivel,cct_sector";
		//echo $_sql;
		$res=mysql_query($_sql);
		$vl_regs=mysql_num_rows($res);
		$vl_pontotales=$vl_regs;				
		if ($vl_regs>0){		
			$r=0;
			while ($r<$vl_regs){
				$recset=mysql_fetch_array($res,MYSQL_ASSOC);
				$parametros="&zonaescola=".$recset["zonaescola"]."&idnivel=".$recset["idnivel"]."&nivel=".$recset["nivel"]."&idalmacen=".$recset["idalmadis"]."&almacen=".$recset["almadis"]."&cct_sector=".$recset["cct_sector"]."&sector=".$recset["sector"]."&pmescuelas=".$recset["escuelas"];
				echo "<tr>
				<td class='fcenter'><a class='fbutton findigo' href='matricula_consulta.php?ejecucion=1$parametros'>Seleccionar</a></td>
				<td>".$recset["nivel"]."</td>
				<td>".$recset["almadis"]."</td=>
				<td>".$recset["sector"]."</tdclass=>
				<td class='fright-align'>".$recset["escuelas"]."</tdlass=></tr>";
				$totescuelas=$totescuelas+$recset["escuelas"]; 
				$r++;
			}		
		}
		if ($vl_pontotales>1){
			echo "<tr><td align='center' class='negra_14' colspan='4'>Total</td>
			<td class='fright-align'>".$totescuelas."</td></tr>";														  
		}?>
	</table><br><br><?			
	if (isset($vl_cerrarventana) and $vl_cerrarventana=="SI"){
		echo "<input name='Regresar' value='Regresar' type='button' onClick='cierraventana()'>";
	}else{											
		?><br>
		<div id='nopasa2'>
		<!-- BOTON REGRESAR -->	
			<a href="<? echo $vl_back; ?>" class="fbutton"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
		</div><? 
	}	?>
</div>
</body>
</html>