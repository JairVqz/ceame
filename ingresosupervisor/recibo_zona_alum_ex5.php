            <? /// ESTE RECIBO SE HIZO PARA ALUMNOS PERO DE LIBROS QUE LLEGARON DESPUES ! ?>
            <br><br>
            <img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
            <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
            <div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
                        SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                        SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                        COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                        PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                        CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> 
                        <? $elnivel=str_replace("Estatal","",$elnivel);  $elnivel=str_replace("Federal","",$elnivel);     $elnivel=str_replace("Indigena","",$elnivel);   ?>
                        RECIBO DE LIBROS DE TEXTO DE ZONA <? echo strtoupper($elnivel); ?> <br><br> <?
        //------------------------------------------------------------------------------------------------------------------------------------------
                        //mysql_query("SET SQL_BIG_SELECTS=1");
                        $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,a.nommun as municipio,a.folio,b.idalmarbo,b.almarbo,a.nomloc as nombreloc,b.idnivel,b.nivel,count(b.cct) as numescuelas from supervis_c a,ctsev b where a.cuenta=b.cct_zona and b.idnivel=".$_SESSION["elidnivel"]." and b.estatus='A' and b.cct_zona='".$_SESSION["cct_zona"]."' group by b.cct_zona"; 	echo $_sql; 
                        $res_zona_alumno=mysql_query($_sql); 		 $rec_zona_alumno=mysql_fetch_array($res_zona_alumno,MYSQL_ASSOC);  

                        $_sql="select almacen,responsable from almacen_c where idalmacen=".$rec_zona_alumno["idalmarbo"]; //	echo $_sql; 
                        $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC);                          
    //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                        <table class="ftable-print-horizontal" cellpadding="5" cellspacing="0" width="100%" border=1 style="font-weight:bold">
                            <tr><td width="10%">Folio</td><td  width="20%">LTG <? echo $rec_zona_alumno["folio"]; ?></td><td width="14%">Almacen</td><td><? echo  $rec_almacen["almacen"]; ?></td></tr>
                            <tr><td>CCT</td><td><? echo $_SESSION["cct_zona"]; ?></td><td>Nombre</td><td><? echo $rec_zona_alumno["nombre"]; ?></td></tr>
                            <tr><td>Sector</td><td><? echo $rec_zona_alumno["sector"]; ?></td><td>Zona</td><td><? echo $rec_zona_alumno["zonaescola"]; ?></td></tr>
                            <tr><td>Localidad</td><td><? echo $rec_zona_alumno["nombreloc"]; ?></td><td>Municipio</td><td><? echo $rec_zona_alumno["municipio"]; ?></td></tr>
                        </table><br><br>  
                        <!-- <h4><? //echo $rec_zona_alumno["numescuelas"]." Escuelas"; ?> </h4><hr>     -->
                        <table width="100%" cellpadding=5 cellspacing=0> <!-- Tabla descriptiva, sin cantidades variables por eso no se usa programa para llenarla -->
                            <tr><td style="font-size:12px; font-weight:bold">Grado</td><td style="font-size:12px; font-weight:bold">Clave</td><td style="font-size:12px; font-weight:bold;">&emsp;&emsp;&emsp;Titulo</td><td colspan="2" style="font-size:12px; font-weight:bold">Destino</td><tr>
                            <tr><td>1</td><td>P1TPA</td><td>Multiples Lenguajes: Trazos y palabras</td><td>Alumnos de 1°</td><td>1 por Escuela *</td><tr>
                            <tr><td>1</td><td>P0SHA</td><td>Nuestros saberes: México grandeza y diversidad</td><td>Alumnos de 4°,5°,6°</td><td>1 por Escuela</td><tr>    
                        </table>
                        <br><br><br>
                        <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td style="font-weight:bold">IMPORTANTE: * Se esta entregando un libro de cada clave por escuela para uso del docente, y este deberá permanecer en el plantel escolar.</td></tr></table>
                        <br><br>
                        <p style="text-align:left"><small><? echo $liga; ?></small></p>
                        <?
    //----------------------------------------------------------------------------------------------------------------------------------------------  ?>
                        <br><br><br><br><br><br><br><br><br>
                        <?  $_sql="select * from ctsev where cct_zona='".$_SESSION["cct_zona"]."' and estatus='A' and idnivel=".$elidnivel; //	echo $_sql; 
                             $res_esc=mysql_query($_sql); 		   $r=1;  $x=1;  ?>

                        
                        <table width="100%" cellpadding=5 cellspacing=0>
                        <tr><td colspan="3"><td colspan="2" align="center">P1TPA</td><td colspan="4" align="center">P0SHA</td></tr>    
                        <tr><td width="5"></td><td style="text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                            <td style="font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">1° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">Escuela</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">4° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">5° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">6° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">escuelas</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                        </tr> <?
                                $sum1=0;    $sum4=0;    $sum5=0;    $sum6=0;
                                while ($r<=mysql_num_rows($res_esc)){
                                    $rec_esc=mysql_fetch_array($res_esc,MYSQL_ASSOC);    
                                    //if ($r==6 || $x==30){ $ban=1; $x=0;}else{$ban=0;}         
                                    if ($x==30){ $ban=1; $x=0;}else{$ban=0;}         
                                    if ($ban==1){ ?>
                                        </table>
                                        <br>
                                        <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>
                                        
                                        <br><br><br><br><br>
                                        <table width="100%" cellpadding=5 cellspacing=0>
                                            <tr><td colspan="3"><td colspan="2" align="center">P1TPA</td><td colspan="4" align="center">P0SHA</td></tr>    
                                            <tr><td width="5"></td><td style="text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                                                <td style="font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">1° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">Escuela</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">4° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">5° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">6° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">escuelas</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                                            </tr><?
                                    }
                                    if ($rec_esc["fecha_matricula"]=="0000-00-00"){
                                        $sum1=$sum1+$rec_esc["alu_1"];
                                        $sum4=$sum4+$rec_esc["alu_4"];
                                        $sum5=$sum5+$rec_esc["alu_5"];
                                        $sum6=$sum6+$rec_esc["alu_6"];                                        
                                        ?>
                                        <tr>
                                            <td><small><? echo $r; ?></small></td>
                                            <td style="text-align:center"><small><? echo $rec_esc["cct"]." ".$rec_esc["turno"]; ?></small></td>
                                            <td><small><? echo $rec_esc["nom_ct"]; ?></small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["alu_1"]; ?></small></td>
                                            <td style="text-align:center"><small>1</small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["alu_4"]; ?></small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["alu_5"]; ?></small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["alu_6"]; ?></small></td>
                                            <td style="text-align:center"><small>1</small></td>


                                            <td>________________</td>
                                        </tr>
                                        <?
                                    }else{
                                        $sum1=$sum1+$rec_esc["a1"];
                                        $sum4=$sum4+$rec_esc["a4"];
                                        $sum5=$sum5+$rec_esc["a5"];
                                        $sum6=$sum6+$rec_esc["a6"];                                        
                                        ?>
                                        <tr>
                                            <td><small><? echo $r; ?></small></td>
                                            <td style="text-align:center"><small><? echo $rec_esc["cct"]." ".$rec_esc["turno"]; ?></small></td>
                                            <td><small><? echo $rec_esc["nom_ct"]; ?></small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["a1"]; ?></small></td>
                                            <td style="text-align:center"><small>1</small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["a4"]; ?></small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["a5"]; ?></small></td>
                                            <td style="text-align:center"><small><?  echo $rec_esc["a6"]; ?></small></td>
                                            <td style="text-align:center"><small>1</small></td>


                                            <td>________________</td>
                                        </tr>
                                        <?
                                    }
                                    $r++;   $x++;
                                }?>


                                <tr>
                                <td colspan="3" style="text-align:right; height:50px">Totales&emsp;&emsp;</td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $sum1; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $rec["escuelas"]; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $sum4; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $sum5; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $sum6; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $rec["escuelas"]; ?></small></td>

                                <td></td></tr>
                        </table>
                        <!--      Aviso     --> 
                        <br><br>
                        <p class="SaltoDePagina"  style="text-align:left"><small><? echo $liga; ?></small></p>

                        <br><br><br><br><br><br>        


                        <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>Este recibo es un documento oficial y los libros que recibo son propiedad de la Nación, por lo que me comprometo a vigilar el buen uso del material y verificar la entrega a los beneficiarios</td></tr></table>
                        <br><br>


                        <!--      Firmas     -->

                        <? 
                        if ($elidnivel==31 ||  $elidnivel==32){
                            $firma_entrega="DE SECTOR";     $firma_recibe="DEL SUPERVISOR";     
                            $sello_entrega="SECTOR";         $sello_recibe="SUPERVISIÓN"; 
                            $entrego="";  
                        }else{
                            $firma_entrega="DEL ALMACÉN";     $firma_recibe="DEL SUPERVISOR";     
                            $sello_entrega="ALMACEN";         $sello_recibe="SUPERVISIÓN"; 
                            $entrego=$rec_almacen["responsable"]; 
                        }

                        
                        ?>
                        <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                        <!--      Aviso     -->
                        <br><br><br>
                        <div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
                        <br>
                        <!--      QR     -->
                        <br><br>
                        <table cellpadding="10" cellspacing="0" width="100%" border=1>
                            <tr><td width="15%" align="center"><? echo GenerarQR("LTG" . number_format( $rec_zona_docente["folio"],0), "qr_zona_".$elnivel."/"); ?> </td><td style="font-size:18px; font-weight:bold;  vertical-align:top">Observaciones</td></tr>
                            <tr><td>NOTA<br>IMPORTANTE</td><td>
                                <ol>
                                    <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                                    <li style="margin:10px">No se le har&aacute; entrega de material alguno si el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                                    <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                            </td></tr>
                        <table><br><br><br>            

                        <br><br><br><p style="text-align:left"><small><? echo $liga; ?></small></p>
            </div><?php
 