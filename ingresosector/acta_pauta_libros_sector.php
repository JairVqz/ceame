<? session_start(); 	 $autollamada=basename(__FILE__). "?";  ?>
<html><head>
<meta charset="ISO-8859-1">      	<meta name="viewport" content="width=device-width, initial-scale=1">	
<title>Recibo</title>
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  


<style type="text/css" media="print">
         @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        } 
        p.SaltoDePagina { PAGE-BREAK-AFTER: always }  
</style>
<style type="text/css">	
        .ftable-print{ border-color:#FDFDFD; font-size:14px }
		.ftable-print-horizontal{ border-color:#FBFBFB; border-right:none; font-size:14px }
  		.ftable-print-horizontal td,th { border-left: none; border-right: none; }
</style>
<SCRIPT TYPE="text/javascript">
		function doPrint(){
			document.all.item("regresar").style.visibility='hidden' 
            document.all.item("Imprimir").style.visibility='hidden' 
            window.print();
            document.all.item("regresar").style.visibility='visible'
            document.all.item("Imprimir").style.visibility='visible'
		}
</SCRIPT>
<body style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center; font-size:14px;"><?

require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');		conectalo("zona");    
if ((!isset($logeado) && !isset($TxtUsuario))){	fmessage("Acceso No Permitido",1500,2,$vl_back);
}else{
        switch($_SESSION["vg_tipousuario"]){
            case "Almacen":
                $vl_back="../ingresoalmacen/pauta_seleccion_niveles_para_sector_zona.php";		
                $elidnivel=$_GET["idnivel"];
                $elnivel=str_replace("Estatal","",$_GET["nivel"]);  $elnivel=str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);   
                $elsector=$_GET["cct_sector"];
                break;
            case "Sector":
                $vl_back="../_panel.php";	
                $elsector=$_SESSION["vg_cct_sector"];	
                break;	
        }    
        //////////////////////////////////////   El acta solo aplica para SECTORES de preescolar !!!!!
        $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,c.municipio,a.domicilio,a.folio,b.idalmadis,b.idalmarec,b.nombreloc,b.idnivel,b.nivel,count(b.cct) as escuelas,sum(b.alu_1) as alu1,sum(b.alu_2) as alu2,sum(b.alu_3) as alu3,sum(b.alu_4) as alu4,sum(b.alu_5) as alu5,sum(b.alu_6) as alu6 from sector_c a,ctsev b,municipio_c c where a.cuenta=b.cct_sector and CAST(a.municipio as unsigned)=c.idmunicipio and b.idnivel<39 and b.estatus='A' and b.cct_sector='".$elsector."' group by b.cct_sector"; //	echo $_sql; 
        //$_sql="select a.cuenta,a.nombre,a.sector,a.nommun,a.folio,b.almadis,b.idalmarec,b.idalmadis,b.almarec,b.idnivel,b.nivel,sum(b.alu_1) as alu1,sum(b.alu_2) as alu2,sum(b.alu_3) as alu3,sum(b.alu_4) as alu4,sum(b.alu_5) as alu5,sum(b.alu_6) as alu6 from sector_c a,ctsev b where a.cuenta=b.cct_sector and b.estatus='A' and b.cct_sector='".$elsector."' group by b.cct_sector"; //	echo $_sql; 
        $res_sector_alumno=mysql_query($_sql); 		 $rec_sector_alumno=mysql_fetch_array($res_sector_alumno,MYSQL_ASSOC);  
        if ($_SESSION["vg_tipousuario"]=="Sector"){
            $elidnivel=$rec_sector_alumno["idnivel"];
            $elnivel=$rec_sector_alumno["nivel"];
            $elnivel=str_replace("Estatal","",$rec_sector_alumno["nivel"]);  $elnivel=str_replace("Federal","",$elnivel);  $elnivel=str_replace("Indigena","",$elnivel);  
        }
        if ($elidnivel<39){ $campoalmacen="idalmarec"; }else{$campoalmacen="idalmadis";}
        $_sql="select * from almacen_c where idalmacen=".$rec_sector_alumno[$campoalmacen]; //	echo $_sql; 
        $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC);  

    
        ?>
		<br><br><br>
		<img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
		<div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
		<div style='margin-left:50px; margin-right:50px;  font-weight:bold; text-align:center; font-size:18px'>
                ACTA DE ENTREGA RECEPCIÓN DE LIBROS DE TEXTO<br>
                GRATUITOS POR ASIGNACIÓN, DEL NIVEL DE EDUCACIÓN <? echo strtoupper($elnivel); ?>
        </div>
        <br><br>
		<div style='margin-left:50px; margin-right:50px;  text-align: justify; font-size:14px'>
            &emsp;&emsp;EN LA CIUDAD DE <span style='font-weight:bold'><? echo trim(strtoupper($rec_almacen["municipio"]));?></span>, VERACRUZ, SIENDO LAS _____ HORAS, DEL DIA ______  DEL MES
            DE ______________________ DEL AÑO 2023, SE REUNIERON EN EL ALMACÉN DE LIBROS DE TEXTO, UBICADO
            EN LA CALLE <span style='font-weight:bold'><? echo strtoupper($rec_almacen["direccion"]); ?></span> 
            DEL MUNICIPIO DE <span style='font-weight:bold'><? echo trim(strtoupper($rec_almacen["municipio"])); ?></span>, CÓDIGO POSTAL <span style='font-weight:bold'><? echo $rec_almacen["cp"]; ?></span>, EL C. <span style='font-weight:bold'><?echo trim(strtoupper($rec_almacen["responsable"]));?></span>,
            RESPONSABLE DEL ALMACEN DE LIBROS DE TEXTO GRATUITOS Y EL C.PROF. ______________________________________ JEFE DEL SECTOR <span style='font-weight:bold'><? echo strtoupper($rec_sector_alumno["sector"]); ?></span>
            DE EDUCACIÓN <span style='font-weight:bold'><? echo strtoupper($elnivel); ?></span> QUIENES SE IDENTIFICAN CON CREDENCIAL DE ELECTOR
            NÚMERO <? if($rec_almacen["numine"]!=""){ echo "<span style='font-weight:bold'>&emsp;".$rec_almacen["numine"]."&emsp;</span>"; }else{ ?>_______________________ <? } ?> Y _____________________ RESPECTIVAMENTE.
            <br><br>
            1.- EL RESPONSABLE DEL ALMACÉN ENTREGA AL C. PROF. _________________________________________ LOS LIBROS DE TEXTO GRATUITOS CORRESPONDIENTES A LA 
            ASIGNACIÓN INICIAL PARA EL CICLO ESCOLAR <span style='font-weight:bold'><? echo $_SESSION["vg_cicloescolar"] ?></span>, DE <span style='font-weight:bold'><? echo strtoupper($rec_sector_alumno["escuelas"]); ?></span> ESCUELAS QUE 
            PERTENECEN A LA SUPERVISIÓN ESCOLAR, CONFORME AL RECIBO CON FOLIO <span style='font-weight:bold'>LTG <? echo $rec_sector_alumno["folio"]; ?></span>.
            <br><br>
            2.- LA ENTREGA SE EFECTUA CONSIDERANDO LA ASIGNACIÓN POR GRADO: <br>
                <table width="400" style="margin:10px; font-size:14px">
                    <tr><td width="100"></td><td><li> PRIMER GRADO</li></td><td style="text-align:right"><span style='font-weight:bold;'><? echo number_format($rec_sector_alumno["alu1"],0); ?></span></td><td>&emsp;LIBROS</td></tr>
                    <tr><td width="100"></td><td><li> SEGUNDO GRADO</td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($rec_sector_alumno["alu2"],0); ?></span></td><td>&emsp;LIBROS</td></tr>
                    <tr><td width="100"></td><td><li> TERCER GRADO</td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($rec_sector_alumno["alu3"],0); ?></span></td><td>&emsp;LIBROS</td></tr>
                </table>
            3.- EL JEFE DE SECTOR RECIBE LAS CANTIDADES DE LIBROS DE TEXTO GRATUITOS, PROCEDIENDO A LA FIRMA Y SELLO DEL RECIBO RESPECTIVO, EN EL 
            CASO DE EXISTIR ALGÚN FALTANTE. DEBERÁ QUEDAR REGISTRADO EN FORMA LEGIBLE EN EL RECIBO CORRESPONDIENTE.
            <br><br>
            LA PRESENTE ACTA DE ENTREGA-RECEPCIÓN NO IMPLICA LA LIBERACIÓN DE RESPONSABILIDADES POR PARTE DE LOS SERVIDORES PÚBLICOS QUE INTERVIENEN EN 
            LA MISMA, ATENDIENDO A SU ÁMBITO DE COMPETENCIA Y TEMPORALIDAD.
            <br><br>
            PREVIA LECTURA DEL PRESENTE INSTRUMENTO Y NO HABIENDO MÁS QUE HACER CONSTAR, SE DA POR CONCLUIDA LA PRESENTE ACTA, SIENDO LAS _________
            HORAS, DEL DÍA _______________________________, FIRMANDO EN DOS EJEMPLARES, AL CALCE LOS QUE EN ELLA INTERVINIERON.
            <br><br><br>
         <?

//---------------------------------------------------------------------------------------------------------------------------------------------- ?>

					<!--      Firmas     -->
                    <? $firma_entrega="DEL ALMACÉN";     $firma_recibe="DEL JEFE DE SECTOR";     
                       $sello_entrega="ALMACEN";         $sello_recibe="SECTOR"; 
                       $entrego=$rec_almacen["responsable"];  ?>
					<table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="18%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                    



		</div><?php
}  ?></div></body></html>
