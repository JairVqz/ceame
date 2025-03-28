<?php
	session_start(); 	
	require_once('../conecta2012.php');
        require_once('../code_php/funciones.php');
	conectalo("oficina");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"><title>Libros Gratuitos Veracruz</title>
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


<LINK REL="stylesheet"  HREF="../css/bootstrap.min.css" >
<LINK REL="stylesheet" href="../css/jquery-ui.min.css"  type="text/css"> 
<SCRIPT TYPE="text/javascript" src="../funcfme.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" src="../js/jquery-1.12.0.min.js"></SCRIPT>
<SCRIPT TYPE="text/javascript" src="../js/jquery-ui.min.js"></SCRIPT>

<SCRIPT TYPE="text/javascript">
            function cl(x) { setTimeout("window.location.replace('" + x + "')", 0);}

            function doPrint(){
                document.all.item("regresar").style.visibility='hidden' 
                document.all.item("Imprimir").style.visibility='hidden' 

                window.print()
                document.all.item("regresar").style.visibility='visible'
                document.all.item("Imprimir").style.visibility='visible'
            }
    </SCRIPT>
</head>

<body>
<?php
if ((!isset($logeado) && !isset($TxtUsuario))){
	echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
}else{
    if (isset($_GET["zona"])){ $laclave=$_GET["zona"];  $vl_back="../ingresoalmacen/zonas_recibo_sextogrado_geografia.php";}else{ $laclave=$vg_ctausr;   $vl_back="../_panel.php"; }?>
    <div class="container"><small>
            <br><br><br>
            <div align='center' style='margin-left:50px; margin-right:50px'><img name='rayas' src='../images/logo_SEVGob.png' width='860' border='0'></div>
            <div class="frow fright ftransparent ftop fmargin"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
            <div class="row" style='margin-left:50px; margin-right:50px'>
                <div class="col-md-12 text-center">
                            SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ</br>	           
                            SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         </br>   
                            <div>COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA</div>
                            <div>PROGRAMA DE LIBROS DE TEXTO GRATUITOS</div>
                            <?  
                                $sql="Select cct,turno,nom_ct,idalmacen,telefono,status,alu_6,a6 from ct_c12 where cct_zona='$laclave' and idnivel>39 and idnivel<60 and status!='B' and turno!=9"; 
                        
                                $rsql=mysql_query($sql)or die('no se puede ejecutar sql');
                                $numescuelas=mysql_num_rows($rsql);
                            ?>
                            <div>ZONA <? echo $vg_ctausr."&emsp;&emsp;".$numescuelas." Escuelas";?></div>
                            <div>RELACIÓN DE ESCUELAS DE LA ZONA PARA LA ENTREGA DEL LIBRO DE GEOGRAFÍA P6GEA</div>
                            <b>CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)</b> 		  </br><br>
                            <i><small>En el apartado total identifique la cantidad de libros a recibir que es la suma de la conciliaciòn de las escuelas con dato negativo</small></i><br><br>

                <table class="table table-hover">
                    <tr><th >CCT - Turno</th><th>Nombre CT</th><th >Almacen</th><th >Asig 6°</th><th >Real 6°</th><th ><small>Diferencia</small></th><th>Dictamen</th><th align="center">Firma Director</th></tr>
                    <?php
                    $totdif=0;
                    while($filsql=mysql_fetch_array($rsql)){
                        $cct=$filsql['cct'];
                        $nom_ct=$filsql['nom_ct'];
                        $turno=$filsql['turno'];
                        $telefono=$filsql['telefono'];
                        $idalmacen=$filsql['idalmacen'];
                        $alu_6=$filsql['alu_6'];
                        $a6=$filsql['a6'];
                        $dif=($filsql['alu_6']-$filsql['a6']);
                        if ($dif<0){$totdif=$totdif+$dif;}
                        $status=$filsql['status'];?>
                        <tr>
                            <td ><?php echo $cct." - ".$turno; ?></td>
                            <td><?php echo $nom_ct; ?></td>
                            <td ><?php echo getNomAlmacen($idalmacen); ?></td>
                            <td align="right"><?php echo $alu_6; ?></td>
                            <td align="right"><?php echo $a6; ?></td>
                            <td align="center"><?php echo $dif; ?></td>
                            <td align="center"><?
                                if($dif>0){ echo "Sobrante"; }
                                if($dif==0){ echo "Completo"; }
                                if($dif<0){  echo "FALTANTE"; }?>
                            </td>
                            <td></td>
                        </tr><?php	
                    } ?>
                    <tr style="font-size:22px"><td colspan=5 align="right">Suma de FALTANTES A RECIBIR :   </td><td align="center"><? echo number_format($totdif,0); ?></td><td></td><td></td><td></td></tr><?
                mysql_free_result($rsql);
                ?>
                </table>
                <?  echo "<H1 class='SaltoDePagina'></H1><br><br><br><br>"; ?>


                <table class="table table-bordered table-condensed small" >	  
                                <tr><td align="left">
                                    IMPORTANTE : El libro de Geografía de sexto grado de pasta dura, permanecerá por 5 ciclos escolares en el aula de acuerdo al criterio federal<br>
                                    Notas:<br>
                                    1.- Podrá identificar la asignación y matrícula real actual de sexto grado por escuela.<br>
                                    2.- En el apartado de conciliación podrá identificar libros a favor y necesidades, tomando como referencia los libros distribuidos en el ciclo escolar 2022-2023.<br>
                                    3.- La suma de lo negativo con lo positivo nos arroja libros a favor o necesidades por total de suma de la zona.<br>
                                    4.- RECIBEN LIBRO DE GEOGRAFÍA DE SEXTO GRADO, LOS PLANTELES CON DICTAMEN "FALTANTE" Y FIRMA EL DIRECTOR
                                    </td>	  
                                </tr>	
                </table>
                <table class="table table-bordered table-condensed">	  
                                                            <tr>	  <td height="37" align="center" width="40%"><br>LUGAR:	  ________________________</td>	<td rowspan="2" style="vertical-align:middle" class="text-center">SELLO</td> <td width="40%"  align="center"><br>FECHA:	    _____________________________</td></tr>	
                                                            <tr><td align="center">ENTREG&Oacute;<br>
                                                                    <br>	  _______________________________  <br>	  NOMBRE Y FIRMA DEL ALMACÉN <br></td>
                                                                <td align="center" >RECIBI&Oacute;<br>
                                                                    <br>	    ______________________________________<br>	    NOMBRE Y FIRMA DEL SUPERVISOR ESCOLAR</td>


                                                            </tr>
                </table>

            </div>
        
    </div><?php
}
mysql_close();
?>
</small>
</body>
</html>