<?php
session_start(); 	$autollamada=basename(__FILE__). "?";
?>
<!doctype html><html lang="es"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />      	<meta name="viewport" content="width=device-width, initial-scale=1"> 	
<title>Documento sin tí­tulo</title>
<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />
<style type="text/css" media="print">
        @page 
        {
            size: landscape;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        }
       
        H1.SaltoDePagina { PAGE-BREAK-AFTER: always }  
    </style>
<script language="javascript">


function doPrint(){
                document.all.item("regresar").style.visibility='hidden' 
                document.all.item("Imprimir").style.visibility='hidden' 

                window.print()
                document.all.item("regresar").style.visibility='visible'
                document.all.item("Imprimir").style.visibility='visible'
            }
</script>
</head>

<body style="margin-left:auto; margin-right:auto; max-width:1200px; text-align:center; font-size:14px;">
<?php
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');	conectalo("zona");
if ((!isset($logeado) && !isset($TxtUsuario))){
	echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
}else{

		$vl_back="../_panel.php";?>
		<div class="fcontainer fshad" style="max-width:1400px; margin-left:auto; margin-right:auto">	
			<div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
			<div align='center' style='margin:10px 30px;'>
				<div><img name='rayas' src='../images/logo_SEVGob.png' width='860' border='0'></div>
				SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ</br>	           
                SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         </br>   
                COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
            	PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
				<? echo fechalarga(date('Y-m-d')); ?>
				<br>
				<h3>Conciliación de Matrícula Real</h3>

				<? 	
                    if ($_SESSION["vg_tipousuario"]=="Almacen"){
                        $condalmacen="a.idalmarbo=".$_SESSION["vg_idalmacen"]." and ";
                    }else{
                        $condalmacen="";
                    }

					$bdconsulta="select z.* from (
                    select b.almacen,'Preescol' nivelado,sum(a.alu_1) al1,sum(a.a1) r1,(sum(a.alu_1)-sum(a.a1)) d1,CASE WHEN (sum(a.alu_1)-sum(a.a1))<0 THEN 'Faltante' WHEN (sum(a.alu_1)-sum(a.a1))=0 THEN 'Completo' WHEN (sum(a.alu_1)-sum(a.a1))>0 THEN 'Sobrante' END dictamen1,sum(a.alu_2) al2,sum(a.a2) r2,(sum(a.alu_2)-sum(a.a2)) d2,CASE WHEN (sum(a.alu_2)-sum(a.a2))<0 THEN 'Faltante' WHEN (sum(a.alu_2)-sum(a.a2))=0 THEN 'Completo' WHEN (sum(a.alu_2)-sum(a.a2))>0 THEN 'Sobrante' END dictamen2, sum(a.alu_3) al3,sum(a.a3) r3,(sum(a.alu_3)-sum(a.a3)) d3,CASE WHEN (sum(a.alu_3)-sum(a.a3))<0 THEN 'Faltante' WHEN (sum(a.alu_3)-sum(a.a3))=0 THEN 'Completo' WHEN (sum(a.alu_3)-sum(a.a3))>0 THEN 'Sobrante' END dictamen3,sum(a.alu_4) al4,sum(a.a4) r4,(sum(a.alu_4)-sum(a.a4)) d4,CASE WHEN (sum(a.alu_4)-sum(a.a4))<0 THEN 'Faltante' WHEN (sum(a.alu_4)-sum(a.a4))=0 THEN 'Completo' WHEN (sum(a.alu_4)-sum(a.a4))>0 THEN 'Sobrante' END dictamen4, sum(a.alu_5) al5,sum(a.a5) r5,(sum(a.alu_5)-sum(a.a5)) d5,CASE WHEN (sum(a.alu_5)-sum(a.a5))<0 THEN 'Faltante' WHEN (sum(a.alu_5)-sum(a.a5))=0 THEN 'Completo' WHEN (sum(a.alu_5)-sum(a.a5))>0 THEN 'Sobrante' END dictamen5, sum(a.alu_6) al6,sum(a.a6) r6,(sum(a.alu_6)-sum(a.a6)) d6,CASE WHEN (sum(a.alu_6)-sum(a.a6))<0 THEN 'Faltante' WHEN (sum(a.alu_6)-sum(a.a6))=0 THEN 'Completo' WHEN (sum(a.alu_6)-sum(a.a6))>0 THEN 'Sobrante' END dictamen6 from ctsev a,almacen_c b where ".$condalmacen." trim(a.estatus)!='B' and a.fecha_matricula!='0000-00-00' and a.idnivel<40 and a.idalmarbo=b.idalmacen group by a.idalmarbo
                    UNION
                    select b.almacen,'Primaria' nivelado,sum(a.alu_1) al1,sum(a.a1) r1,(sum(a.alu_1)-sum(a.a1)) d1,CASE WHEN (sum(a.alu_1)-sum(a.a1))<0 THEN 'Faltante' WHEN (sum(a.alu_1)-sum(a.a1))=0 THEN 'Completo' WHEN (sum(a.alu_1)-sum(a.a1))>0 THEN 'Sobrante' END dictamen1,sum(a.alu_2) al2,sum(a.a2) r2,(sum(a.alu_2)-sum(a.a2)) d2,CASE WHEN (sum(a.alu_2)-sum(a.a2))<0 THEN 'Faltante' WHEN (sum(a.alu_2)-sum(a.a2))=0 THEN 'Completo' WHEN (sum(a.alu_2)-sum(a.a2))>0 THEN 'Sobrante' END dictamen2, sum(a.alu_3) al3,sum(a.a3) r3,(sum(a.alu_3)-sum(a.a3)) d3,CASE WHEN (sum(a.alu_3)-sum(a.a3))<0 THEN 'Faltante' WHEN (sum(a.alu_3)-sum(a.a3))=0 THEN 'Completo' WHEN (sum(a.alu_3)-sum(a.a3))>0 THEN 'Sobrante' END dictamen3,sum(a.alu_4) al4,sum(a.a4) r4,(sum(a.alu_4)-sum(a.a4)) d4,CASE WHEN (sum(a.alu_4)-sum(a.a4))<0 THEN 'Faltante' WHEN (sum(a.alu_4)-sum(a.a4))=0 THEN 'Completo' WHEN (sum(a.alu_4)-sum(a.a4))>0 THEN 'Sobrante' END dictamen4, sum(a.alu_5) al5,sum(a.a5) r5,(sum(a.alu_5)-sum(a.a5)) d5,CASE WHEN (sum(a.alu_5)-sum(a.a5))<0 THEN 'Faltante' WHEN (sum(a.alu_5)-sum(a.a5))=0 THEN 'Completo' WHEN (sum(a.alu_5)-sum(a.a5))>0 THEN 'Sobrante' END dictamen5, sum(a.alu_6) al6,sum(a.a6) r6,(sum(a.alu_6)-sum(a.a6)) d6,CASE WHEN (sum(a.alu_6)-sum(a.a6))<0 THEN 'Faltante' WHEN (sum(a.alu_6)-sum(a.a6))=0 THEN 'Completo' WHEN (sum(a.alu_6)-sum(a.a6))>0 THEN 'Sobrante' END dictamen6 from ctsev a,almacen_c b where ".$condalmacen." trim(a.estatus)!='B' and a.fecha_matricula!='0000-00-00' and a.idnivel>39 and a.idnivel<50 and a.idalmarbo=b.idalmacen group by a.idalmarbo
                    UNION
                    select b.almacen,'Secundar' nivelado,sum(a.alu_1) al1,sum(a.a1) r1,(sum(a.alu_1)-sum(a.a1)) d1,CASE WHEN (sum(a.alu_1)-sum(a.a1))<0 THEN 'Faltante' WHEN (sum(a.alu_1)-sum(a.a1))=0 THEN 'Completo' WHEN (sum(a.alu_1)-sum(a.a1))>0 THEN 'Sobrante' END dictamen1,sum(a.alu_2) al2,sum(a.a2) r2,(sum(a.alu_2)-sum(a.a2)) d2,CASE WHEN (sum(a.alu_2)-SUM(a.a2))<0 THEN 'Faltante' WHEN (sum(a.alu_2)-sum(a.a2))=0 THEN 'Completo' WHEN (sum(a.alu_2)-sum(a.a2))>0 THEN 'Sobrante' END dictamen2, sum(a.alu_3) al3,sum(a.a3) r3,(sum(a.alu_3)-sum(a.a3)) d3,CASE WHEN (sum(a.alu_3)-sum(a.a3))<0 THEN 'Faltante' WHEN (sum(a.alu_3)-sum(a.a3))=0 THEN 'Completo' WHEN (sum(a.alu_3)-sum(a.a3))>0 THEN 'Sobrante' END dictamen3,sum(a.alu_4) al4,sum(a.a4) r4,(sum(a.alu_4)-sum(a.a4)) d4,CASE WHEN (sum(a.alu_4)-sum(a.a4))<0 THEN 'Faltante' WHEN (sum(a.alu_4)-sum(a.a4))=0 THEN 'Completo' WHEN (sum(a.alu_4)-sum(a.a4))>0 THEN 'Sobrante' END dictamen4, sum(a.alu_5) al5,sum(a.a5) r5,(sum(a.alu_5)-sum(a.a5)) d5,CASE WHEN (sum(a.alu_5)-sum(a.a5))<0 THEN 'Faltante' WHEN (sum(a.alu_5)-sum(a.a5))=0 THEN 'Completo' WHEN (sum(a.alu_5)-sum(a.a5))>0 THEN 'Sobrante' END dictamen5, sum(a.alu_6) al6,sum(a.a6) r6,(sum(a.alu_6)-sum(a.a6)) d6,CASE WHEN (sum(a.alu_6)-sum(a.a6))<0 THEN 'Faltante' WHEN (sum(a.alu_6)-sum(a.a6))=0 THEN 'Completo' WHEN (sum(a.alu_6)-sum(a.a6))>0 THEN 'Sobrante' END dictamen6 from ctsev a,almacen_c b where ".$condalmacen." trim(a.estatus)!='B' and a.fecha_matricula!='0000-00-00' and a.idnivel>59 and a.idnivel<70 and a.idalmarbo=b.idalmacen group by a.idalmarbo
                    UNION
                    select b.almacen,'Telesecu' nivelado,sum(a.alu_1) al1,sum(a.a1) r1,(sum(a.alu_1)-sum(a.a1)) d1,CASE WHEN (sum(a.alu_1)-sum(a.a1))<0 THEN 'Faltante' WHEN (sum(a.alu_1)-sum(a.a1))=0 THEN 'Completo' WHEN (sum(a.alu_1)-sum(a.a1))>0 THEN 'Sobrante' END dictamen1,sum(a.alu_2) al2,sum(a.a2) r2,(sum(a.alu_2)-sum(a.a2)) d2,CASE WHEN (sum(a.alu_2)-sum(a.a2))<0 THEN 'Faltante' WHEN (sum(a.alu_2)-sum(a.a2))=0 THEN 'Completo' WHEN (sum(a.alu_2)-sum(a.a2))>0 THEN 'Sobrante' END dictamen2, sum(a.alu_3) al3,sum(a.a3) r3,(sum(a.alu_3)-sum(a.a3)) d3,CASE WHEN (sum(a.alu_3)-sum(a.a3))<0 THEN 'Faltante' WHEN (sum(a.alu_3)-sum(a.a3))=0 THEN 'Completo' WHEN (sum(a.alu_3)-sum(a.a3))>0 THEN 'Sobrante' END dictamen3,sum(a.alu_4) al4,sum(a.a4) r4,(sum(a.alu_4)-sum(a.a4)) d4,CASE WHEN (sum(a.alu_4)-sum(a.a4))<0 THEN 'Faltante' WHEN (sum(a.alu_4)-sum(a.a4))=0 THEN 'Completo' WHEN (sum(a.alu_4)-sum(a.a4))>0 THEN 'Sobrante' END dictamen4, sum(a.alu_5) al5,sum(a.a5) r5,(sum(a.alu_5)-sum(a.a5)) d5,CASE WHEN (sum(a.alu_5)-sum(a.a5))<0 THEN 'Faltante' WHEN (sum(a.alu_5)-sum(a.a5))=0 THEN 'Completo' WHEN (sum(a.alu_5)-sum(a.a5))>0 THEN 'Sobrante' END dictamen5, sum(a.alu_6) al6,sum(a.a6) r6,(sum(a.alu_6)-sum(a.a6)) d6,CASE WHEN (sum(a.alu_6)-sum(a.a6))<0 THEN 'Faltante' WHEN (sum(a.alu_6)-sum(a.a6))=0 THEN 'Completo' WHEN (sum(a.alu_6)-sum(a.a6))>0 THEN 'Sobrante' END dictamen6 from ctsev a,almacen_c b where ".$condalmacen." trim(a.estatus)!='B' and a.fecha_matricula!='0000-00-00' and a.idnivel>70 and a.idalmarbo=b.idalmacen group by a.idalmarbo
                    ) z  order by z.almacen,z.nivelado"; 


                    //echo $bdconsulta;
                    $vl_res=mysql_query($bdconsulta); 		$rcolor1="background:#F4F4F4;"; $rcolor2="background:white;"; 
					if (mysql_num_rows($vl_res)>0){ ?> 
						<style>th{ background:#757575; text-align:center; border-color:#C9C9C9; } td{ padding:3px 5px; border-color:#F1F1F1;}</style> 
							<? //echo $laconsulta;       
							// ************************************AQUI HAY ESCUELAS QUE CAPTURARON SU MATRICULA EN 0 PORQUE ESTAN DADAS DE BAJA, PERO NO LAS HEMOS MARCADO EN EL STATUS PORQUE NO TENEMOS SUSTENTO ?>
							<table border='1' style='border:thin solid #FCFCFC;' width='100%'> 
								<? $r=0;	 
                                $pret1=0;   $pret2=0;   $pret3=0;
                                $prit1=0;   $prit2=0;   $prit3=0;
                                $sect1=0;   $sect2=0;   $sect3=0;
                                $telt1=0;   $telt2=0;   $telt3=0;
                                
                                $prit4=0;   $prit5=0;    $prit6=0;    

                                $prea1=0;   $prea2=0;   $prea3=0;
                                $pria1=0;   $pria2=0;   $pria3=0;
                                $seca1=0;   $seca2=0;   $seca3=0;
                                $tela1=0;   $tela2=0;   $tela3=0;
                                
                                $pria4=0;   $pria5=0;    $pria6=0;   
                                $k=0; 
                                while ($r<mysql_num_rows($vl_res)){ 
                                        if($r==0){ $recset=mysql_fetch_array($vl_res,MYSQL_ASSOC);  }
                                        $almacen=$recset['almacen']; ?>
                                        <tr><td colspan="25" align="center" height="50"><? echo $recset['almacen']; ?></td></tr>
                                        <tr style="font-size:14px; color:white"> 
                                                <th align="center">Nivel</th>
                                                <th colspan="4" align="center" height="25">Primer grado</th>
                                                <th colspan="4" align="center" height="25">Segundo grado</th>
                                                <th colspan="4" align="center" height="25">Tercer grado</th>
                                                <th colspan="4" align="center" height="25">Cuarto grado</th>
                                                <th colspan="4" align="center" height="25">Quinto grado</th>
                                                <th colspan="4" align="center" height="25">Sexto grado</th>
                                        </tr>                                        

                                        <tr style="font-size:14px; color:white"><th></th>
                                            <!--<th><small>Asig</small></th><th><small>Real</small></th><th><small>Dif</small></th><th><small>Dic</small></th>
                                            <th><small>Asig</small></th><th><small>Real</small></th><th><small>Dif</small></th><th><small>Dic</small></th>
                                            <th><small>Asig</small></th><th><small>Real</small></th><th><small>Dif</small></th><th><small>Dic</small></th>
                                            <th><small>Asig</small></th><th><small>Real</small></th><th><small>Dif</small></th><th><small>Dic</small></th>
                                            <th><small>Asig</small></th><th><small>Real</small></th><th><small>Dif</small></th><th><small>Dic</small></th>
                                            <th><small>Asig</small></th><th><small>Real</small></th><th><small>Dif</small></th><th><small>Dic</small></th>

                                            <th><small>A</small></th><th><small>R</small></th><th style="color:yellow"><small>Dif</small></th><th style="color:yellow"><small>Dic</small></th>
                                            <th><small>A</small></th><th><small>R</small></th><th style="color:yellow"><small>Dif</small></th><th style="color:yellow"><small>Dic</small></th>
                                            <th><small>A</small></th><th><small>R</small></th><th style="color:yellow"><small>Dif</small></th><th style="color:yellow"><small>Dic</small></th>
                                            <th><small>A</small></th><th><small>R</small></th><th style="color:yellow"><small>Dif</small></th><th style="color:yellow"><small>Dic</small></th>
                                            <th><small>A</small></th><th><small>R</small></th><th style="color:yellow"><small>Dif</small></th><th style="color:yellow"><small>Dic</small></th>
                                            <th><small>A</small></th><th><small>R</small></th><th style="color:yellow"><small>Dif</small></th><th style="color:yellow"><small>Dic</small></th> -->

                                            <th><small>A</small></th><th><small>R</small></th><th><small>Dif</small></th><th><small>Dic</small></thstyle=>
                                            <th><small>A</small></th><th><small>R</small></th><th><small>Dif</small></th><th><small>Dic</small></thstyle=>
                                            <th><small>A</small></th><th><small>R</small></th><th><small>Dif</small></th><th><small>Dic</small></th=>
                                            <th><small>A</small></th><th><small>R</small></th><th><small>Dif</small></th><th><small>Dic</small></thstyle=>
                                            <th><small>A</small></th><th><small>R</small></th><th><small>Dif</small></th><th><small>Dic</small></th=>
                                            <th><small>A</small></th><th><small>R</small></th><th><small>Dif</small></th><th><small>Dic</small></thstyle=>

                                        </tr> <?
                                        while ($almacen==$recset['almacen']){
											$x++; if ($x==2){$rcolor=$rcolor2; $x=0;}else{$rcolor=$rcolor1;} ?> 
											<tr style="<? echo $rcolor; ?> font-size:12px;"> 
												<td><?  echo substr($recset['nivelado'],0,3); ?></td>

												<td align="right"><?  echo number_format($recset['al1'],0); ?></td>
												<td align="right"><?  echo number_format($recset['r1'],0);  ?></td> 
												<td align="right" style="background:<? if ($recset['d1']<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format($recset['d1'],0);  ?></td> 
                                                <td align="center" style="background:<? if ($recset['d1']<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><?  echo substr($recset['dictamen1'],0,1);  ?></td> 
                                                
												<td align="right"><?  echo number_format($recset['al2'],0); ?></td>
												<td align="right"><?  echo number_format($recset['r2'],0);  ?></td> 
												<td align="right" style="background:<? if ($recset['d2']<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format($recset['d2'],0);  ?></td> 
                                                <td align="center" style="background:<? if ($recset['d2']<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><?  echo substr($recset['dictamen2'],0,1);  ?></td> 

                                                <td align="right"><?  echo number_format($recset['al3'],0); ?></td>
												<td align="right"><?  echo number_format($recset['r3'],0);  ?></td> 
												<td align="right"  style="background:<? if ($recset['d3']<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format($recset['d3'],0);  ?></td> 
                                                <td align="center" style="background:<? if ($recset['d3']<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><?  echo substr($recset['dictamen3'],0,1);  ?></td> <?
                                                if ($recset['nivelado']=="Primaria"){ ?>
                                                        <td align="right"><?  echo number_format($recset['al4'],0); ?></td>
                                                        <td align="right"><?  echo number_format($recset['r4'],0);  ?></td> 
                                                        <td align="right" style="background:<? if ($recset['d4']<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format($recset['d4'],0);  ?></td> 
                                                        <td align="center" style="background:<? if ($recset['d4']<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><?  echo substr($recset['dictamen4'],0,1);  ?></td> 

                                                        <td align="right"><?  echo number_format($recset['al5'],0); ?></td>
                                                        <td align="right"><?  echo number_format($recset['r5'],0);  ?></td> 
                                                        <td align="right"  style="background:<? if ($recset['d5']<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format($recset['d5'],0);  ?></td> 
                                                        <td align="center" style="background:<? if ($recset['d5']<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><?  echo substr($recset['dictamen5'],0,1);  ?></td> 

                                                        <td align="right"><?  echo number_format($recset['al6'],0); ?></td>
                                                        <td align="right"><?  echo number_format($recset['r6'],0);  ?></td> 
                                                        <td align="right" style="background:<? if ($recset['d6']<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format($recset['d6'],0);  ?></td> 
                                                        <td align="center" style="background:<? if ($recset['d6']<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><?  echo substr($recset['dictamen6'],0,1);  ?></td> <?
                                                }else{?>
                                                    <td align="right"></td>
                                                        <td align="right"></td> 
                                                        <td align="right"></td> 
                                                        <td align="center"></td> 

                                                        <td align="right"></td>
                                                        <td align="right"></td> 
                                                        <td align="right"></td> 
                                                        <td align="center"></td> 

                                                        <td align="right"></td>
                                                        <td align="right"></td> 
                                                        <td align="right"></td> 
                                                        <td align="center"></td> <?
                                                } ?>        



											</tr>
                                            <? 
                                            switch(substr($recset['nivelado'],0,3)){
                                                case "Pre": 
                                                    $pret1=$pret1+$recset['al1'];   $pret2=$pret2+$recset['al2'];   $pret3=$pret3+$recset['al3']; 
                                                    $prea1=$prea1+$recset['r1'];    $prea2=$prea2+$recset['r2'];    $prea3=$prea3+$recset['r3'];
                                                    break;
                                                case "Pri": 
                                                    $prit1=$prit1+$recset['al1'];   $prit2=$prit2+$recset['al2'];   $prit3=$prit3+$recset['al3']; $prit4=$prit4+$recset['al4'];   $prit5=$prit5+$recset['al5'];   $prit6=$prit6+$recset['al6']; 
                                                    $pria1=$pria1+$recset['r1'];    $pria2=$pria2+$recset['r2'];    $pria3=$pria3+$recset['r3'];  $pria4=$pria4+$recset['r4'];    $pria5=$pria5+$recset['r5'];    $pria6=$pria6+$recset['r6'];
                                                    break;
                                                case "Sec": 
                                                    $sect1=$sect1+$recset['al1'];   $sect2=$sect2+$recset['al2'];   $sect3=$sect3+$recset['al3']; 
                                                    $seca1=$seca1+$recset['r1'];    $seca2=$seca2+$recset['r2'];    $seca3=$seca3+$recset['r3'];
                                                    break;
                                                case "Tel": 
                                                    $telt1=$telt1+$recset['al1'];   $telt2=$telt2+$recset['al2'];   $telt3=$telt3+$recset['al3'];       
                                                    $tela1=$tela1+$recset['r1'];    $tela2=$tela2+$recset['r2'];    $tela3=$tela3+$recset['r3'];
                                                    break; 
                                            }
                                           
                                            

                                            
                                           


                                            
                                            

                                            

											$r++;
											$recset=mysql_fetch_array($vl_res,MYSQL_ASSOC);
                                        }  
                                        /*switch(trim($almacen)){
                                            case "CD. CUAUHTEMOC":    
                                                echo "<br>probando".$almacen."<H1 class='SaltoDePagina'></H1><br><br>";
                                               break;
                                        } */

                                        
								} 
                                if ($condalmacen==""){ ?> 
                                    <tr><td colspan="25" align="center" height="65" style="color:red"><strong>TOTALES GENERALES</strong></td></tr>
                                    <tr style="font-size:14px; color:yellow; background:black"> 
                                            <td align="center">Nivel</td>
                                            <td colspan="4" align="center" height="25">Primer grado</td>
                                            <td colspan="4" align="center" height="25">Segundo grado</td>
                                            <td colspan="4" align="center" height="25">Tercer grado</td>
                                            <td colspan="4" align="center" height="25">Cuarto grado</td>
                                            <td colspan="4" align="center" height="25">Quinto grado</td>
                                            <td colspan="4" align="center" height="25">Sexto grado</td>
                                    </tr>                                        

                                    <tr style="font-size:14px; color:yellow; background:black"><td></td>
                                        <td><small>A</small></td><td><small>R</small></td><td><small>Dif</small></td><td><small>Dic</small></td>
                                        <td><small>A</small></td><td><small>R</small></td><td><small>Dif</small></td><td><small>Dic</small></td>
                                        <td><small>A</small></td><td><small>R</small></td><td><small>Dif</small></td><td><small>Dic</small></td>
                                        <td><small>A</small></td><td><small>R</small></td><td><small>Dif</small></td><td><small>Dic</small></td>
                                        <td><small>A</small></td><td><small>R</small></td><td><small>Dif</small></td><td><small>Dic</small></td>
                                        <td><small>A</small></td><td><small>R</small></td><td><small>Dif</small></td><td><small>Dic</small></td>
                                    </tr>
                                    <? if (($prea1+$prea2+$prea3)>0){ ?>
                                        <tr style="<? echo $rcolor; ?> font-size:12px;"> 
                                            <td>Pre</td>
                                            <td align="right"><?  echo number_format($pret1,0); ?></td>
                                            <td align="right"><?  echo number_format($prea1,0);  ?></td> 
                                            <td align="right" style="background:<? if (($pret1-$prea1)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($pret1-$prea1),0);  ?></td> 
                                            <td align="center" style="background:<? if (($pret1-$prea1)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($pret1>$prea1){echo "S";}else{ if (($pret1-$prea1)==0){echo "C";}else{echo "F";}}  ?></td> 
                                            
                                            <td align="right"><?  echo number_format($pret2,0); ?></td>
                                            <td align="right"><?  echo number_format($prea2,0);  ?></td> 
                                            <td align="right" style="background:<? if (($pret2-$prea2)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($pret2-$prea2),0);  ?></td> 
                                            <td align="center" style="background:<? if (($pret2-$prea2)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($pret2>$prea2){echo "S";}else{ if (($pret2-$prea2)==0){echo "C";}else{echo "F";}}  ?></td> 

                                            <td align="right"><?  echo number_format($pret3,0); ?></td>
                                            <td align="right"><?  echo number_format($prea3,0);  ?></td> 
                                            <td align="right" style="background:<? if (($pret3-$prea3)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($pret3-$prea3),0);  ?></td> 
                                            <td align="center" style="background:<? if (($pret3-$prea3)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($pret3>$prea3){echo "S";}else{if (($pret3-$prea3)==0){echo "C";}else{echo "F";}}  ?></td> 

                                                <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 

                                                    <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 

                                                    <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 
                                        </tr><?
                                    }
                                    if (($pria1+$pria2+$pria3)>0){ ?>
                                        <tr style="<? echo $rcolor; ?> font-size:12px;"> 
                                            <td>Pri</td>
                                            <td align="right"><?  echo number_format($prit1,0); ?></td>
                                            <td align="right"><?  echo number_format($pria1,0);  ?></td> 
                                            <td align="right" style="background:<? if (($prit1-$pria1)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($prit1-$pria1),0);  ?></td> 
                                            <td align="center" style="background:<? if (($prit1-$pria1)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($prit1>$pria1){echo "S";}else{ if (($prit1-$pria1)==0){echo "C";}else{echo "F";}}  ?></td> 
                                            
                                            <td align="right"><?  echo number_format($prit2,0); ?></td>
                                            <td align="right"><?  echo number_format($pria2,0);  ?></td> 
                                            <td align="right" style="background:<? if (($prit2-$pria2)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($prit2-$pria2),0);  ?></td> 
                                            <td align="center" style="background:<? if (($prit2-$pria2)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($prit2>$pria2){echo "S";}else{ if (($prit2-$pria2)==0){echo "C";}else{echo "F";}}  ?></td> 

                                            <td align="right"><?  echo number_format($prit3,0); ?></td>
                                            <td align="right"><?  echo number_format($pria3,0);  ?></td> 
                                            <td align="right" style="background:<? if (($prit3-$pria3)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($prit3-$pria3),0);  ?></td> 
                                            <td align="center" style="background:<? if (($prit3-$pria3)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($prit3>$pria3){echo "S";}else{ if (($prit3-$pria3)==0){echo "C";}else{echo "F";}}  ?></td> 

                                            <td align="right"><?  echo number_format($prit4,0); ?></td>
                                            <td align="right"><?  echo number_format($pria4,0);  ?></td> 
                                            <td align="right" style="background:<? if (($prit4-$pria4)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($prit4-$pria4),0);  ?></td> 
                                            <td align="center" style="background:<? if (($prit4-$pria4)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($prit4>$pria4){echo "S";}else{ if (($prit4-$pria4)==0){echo "C";}else{echo "F";}}  ?></td> 
                                            
                                            <td align="right"><?  echo number_format($prit5,0); ?></td>
                                            <td align="right"><?  echo number_format($pria5,0);  ?></td> 
                                            <td align="right" style="background:<? if (($prit5-$pria5)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($prit5-$pria5),0);  ?></td> 
                                            <td align="center" style="background:<? if (($prit5-$pria5)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($prit5>$pria5){echo "S";}else{ if (($prit5-$pria5)==0){echo "C";}else{echo "F";}}  ?></td> 

                                            <td align="right"><?  echo number_format($prit6,0); ?></td>
                                            <td align="right"><?  echo number_format($pria6,0);  ?></td> 
                                            <td align="right" style="background:<? if (($prit6-$pria6)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($prit6-$pria6),0);  ?></td> 
                                            <td align="center" style="background:<? if (($prit6-$pria6)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($prit6>$pria6){echo "S";}else{ if (($prit6-$pria6)==0){echo "C";}else{echo "F";}}  ?></td> 
                                        </tr><? 
                                    }
                                    if (($seca1+$seca2+$seca3)>0){ ?>
                                        <tr style="<? echo $rcolor; ?> font-size:12px;"> 
                                            <td>Sec</td>
                                            <td align="right"><?  echo number_format($sect1,0); ?></td>
                                            <td align="right"><?  echo number_format($seca1,0);  ?></td> 
                                            <td align="right" style="background:<? if (($sect1-$seca1)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($sect1-$seca1),0);  ?></td> 
                                            <td align="center" style="background:<? if (($sect1-$seca1)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($sect1>$seca1){echo "S";}else{ if (($sect1-$seca1)==0){echo "C";}else{echo "F";}}  ?></td> 
                                            
                                            <td align="right"><?  echo number_format($sect2,0); ?></td>
                                            <td align="right"><?  echo number_format($seca2,0);  ?></td> 
                                            <td align="right" style="background:<? if (($sect2-$seca2)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($sect2-$seca2),0);  ?></td> 
                                            <td align="center" style="background:<? if (($sect2-$seca2)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($sect2>$seca2){echo "S";}else{ if (($sect2-$seca2)==0){echo "C";}else{echo "F";}}  ?></td> 

                                            <td align="right"><?  echo number_format($sect3,0); ?></td>
                                            <td align="right"><?  echo number_format($seca3,0);  ?></td> 
                                            <td align="right" style="background:<? if (($sect3-$seca3)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($sect3-$seca3),0);  ?></td> 
                                            <td align="center" style="background:<? if (($sect3-$seca3)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($sect3>$seca3){echo "S";}else{ if (($sect3-$seca3)==0){echo "C";}else{echo "F";}}  ?></td> 

                                                <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 

                                                    <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 

                                                    <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 
                                        </tr><? 
                                    }
                                    if (($tela1+$tela2+$tela3)>0){ ?>
                                        <tr style="<? echo $rcolor; ?> font-size:12px;"> 
                                            <td>Tel</td>
                                            <td align="right"><?  echo number_format($telt1,0); ?></td>
                                            <td align="right"><?  echo number_format($tela1,0);  ?></td> 
                                            <td align="right" style="background:<? if (($telt1-$tela1)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($telt1-$tela1),0);  ?></td> 
                                            <td align="center" style="background:<? if (($telt1-$tela1)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($telt1>$tela1){echo "S";}else{ if (($telt1-$tela1)==0){echo "C";}else{echo "F";}}  ?></td> 
                                            
                                            <td align="right"><?  echo number_format($telt2,0); ?></td>
                                            <td align="right"><?  echo number_format($tela2,0);  ?></td> 
                                            <td align="right" style="background:<? if (($telt2-$tela2)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($telt2-$tela2),0);  ?></td> 
                                            <td align="center" style="background:<? if (($telt2-$tela2)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($telt2>$tela2){echo "S";}else{ if (($telt2-$tela2)==0){echo "C";}else{echo "F";}}  ?></td> 

                                            <td align="right"><?  echo number_format($telt3,0); ?></td>
                                            <td align="right"><?  echo number_format($tela3,0);  ?></td> 
                                            <td align="right" style="background:<? if (($telt3-$tela3)<0){echo "#FFDED7";}else{ echo "#F3FFD7"; }; ?>"><?  echo number_format(($telt3-$tela3),0);  ?></td> 
                                            <td align="center" style="background:<? if (($telt3-$tela3)<0){echo "#FFC2C2";}else{ echo "#E1FE9B"; }; ?>; font-weight:bold"><? if ($telt3>$tela3){echo "S";}else{ if (($telt3-$tela3)==0){echo "C";}else{echo "F";}}  ?></td> 

                                                <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 

                                                    <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 

                                                    <td align="right"></td>
                                                    <td align="right"></td> 
                                                    <td align="right"></td> 
                                                    <td align="center"></td> 
                                        </tr><?
                                    }
                                } ?>





							</table> 
                            <br><br><br>
						 <? 
					}else{ $tit="Sin registros!"; ?><div class="fcontainer"><h2 class="fcenter fpadding-large fmargin fdeg fshad fround fborder"><? echo $tit; ?></h2></div><? if(isset($_POST['buscado'])){ ?> <script type="text/javascript" languaje="javascript">setTimeout("window.location.replace('<? if(isset($_POST['buscado'])){$x=explode(".php?",$_SERVER["REQUEST_URI"]); $vl_back=$autollamada.$x[1]; } echo $vl_back; ?>')", 1500);</script><br><br><br> <? } } ?>	
				
								
				
			</div>
		</div>
		
	<?
}
?>
</body>
</html>