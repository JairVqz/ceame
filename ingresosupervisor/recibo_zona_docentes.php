            <br><br>
            <img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
            <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
            <div style='margin-left:50px; margin-right:50px;  font-weight:bold'>
                        SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ<br>	           
                        SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         <br>   
                        COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA<br>
                        PROGRAMA DE LIBROS DE TEXTO GRATUITOS<br>
                        CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br> 
                        RECIBO DE LIBROS DE TEXTO DE ZONA DE <? echo strtoupper($elnivel); ?> <br><br> <?
                        //------------------------------------------------------------------------------------------------------------------------------------------
                        $_sql="select COUNT(*) as escuelas from ctsev where cct_zona='".$_SESSION["cct_zona"]."' and estatus='A' and idnivel=".$_SESSION["elidnivel"]; //	echo $_sql; 
                        $res=mysql_query($_sql); 		 $rec=mysql_fetch_array($res,MYSQL_ASSOC);  

                        $_sql="select folio from supervis_c where cuenta='".$_SESSION["cct_zona"]."'"; //	echo $_sql; 
                        $reszona=mysql_query($_sql); 		 $rec_super=mysql_fetch_array($reszona,MYSQL_ASSOC);                         
    //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                        <h3><? echo "Folio: ".$rec_super["folio"]."&emsp;&emsp;&emsp;".$elnivel."&emsp;&emsp;&emsp;Zona ".$_SESSION["cct_zona"]."&emsp;&emsp;&emsp;".$rec["escuelas"]." Escuelas"; ?> </h3><hr>    
                        <table width="100%" xellpadding=5 cellspacing=0><tr><?
                        $s1=0;  $s2=0;  $s3=0;  $s4=0;  $s5=0;  $s6=0;
                            for ($i=1; $i <= 3; $i++) { 
                                switch($i){case 1: $ban="1,2";  $ancho="30"; break;       case 2: $ban="3,4"; $ancho="32"; break;      case 3: $ban="5,6"; $ancho=""; break; } ?>
                                <td style="vertical-align:top" width="<? echo $ancho; ?>%">
                                    <table width="100%" cellpadding=5 cellspacing=0>
                                        <tr><td style="font-size:12px; font-weight:bold">Grado</td><td style="font-size:12px; font-weight:bold;">&emsp;&emsp;&emsp;Titulo</td><tr>
                                        <?  $_sql="select idgrado,titulo,destino from l_libros where idnivel=4 and idgrado in (".$ban.") and ciclo='2023-2024' and estatus='A' and idmaterial NOT REGEXP 'lpm|p0cma' order by idgrado,destino"; //	echo $_sql; 
                                            $res_libro=mysql_query($_sql); 		   $r=0;  
                                            while ($r<mysql_num_rows($res_libro)){
                                                $rec_libro=mysql_fetch_array($res_libro,MYSQL_ASSOC); 
                                                switch($rec_libro["idgrado"]){case 1: $s1=$s1+1; break;     case 2: $s2=$s2+1; break;   case 3: $s3=$s3+1; break;   case 4: $s4=$s4+1; break;   case 5: $s5=$s5+1; break;   case 6: $s6=$s6+1; break; } 
                                                ?>
                                                <tr><td style="text-align:center"><small><? echo $rec_libro["idgrado"]; ?></small></td><td><small><? echo $rec_libro["titulo"]; ?></small></td></tr><?
                                                $r++;
                                            }?>
                                    </table>
                                        </td><?
                            } ?>
                        </tr></table><br><br><br>
                        <table width="100%" xellpadding=5 cellspacing=0><tr>
                                <td style="vertical-align:top" width="30%">
                                    <table width="100%" cellpadding=5 cellspacing=0>
                                        <tr><td style="font-size:12px; font-weight:bold">Grado</td><td style="font-size:12px; font-weight:bold;">&emsp;&emsp;&emsp;Titulo</td><tr>
                                                <tr><td style="text-align:center"><small>1 y 2</small></td><td><small>Un libro sin recetas para la maestra y el maestro. Fase 3. Primero y Segundo grado.</small></td></tr>
                                    </table>
                                </td>
                                <td style="vertical-align:top" width="32%">
                                    <table width="100%" cellpadding=5 cellspacing=0>
                                        <tr><td style="font-size:12px; font-weight:bold" width="20%">Grado</td><td style="font-size:12px; font-weight:bold;">&emsp;&emsp;&emsp;Titulo</td><tr>
                                                <tr><td style="text-align:center"><small>3 y 4</small></td><td><small>Un libro sin recetas para la maestra y el maestro. Fase 4. Tercero y Cuarto grado.</small></td></tr>
                                                <tr><td style="text-align:center"><small>4,5 y 6</small></td><td><small>Cartografía de México y el mundo. Cuarto, Quinto y Sexto grado.</small></td></tr>
                                    </table>
                                </td>
                                <td style="vertical-align:top">
                                    <table width="100%" cellpadding=5 cellspacing=0>
                                        <tr><td style="font-size:12px; font-weight:bold">Grado</td><td style="font-size:12px; font-weight:bold;">&emsp;&emsp;&emsp;Titulo</td><tr>
                                                <tr><td style="text-align:center"><small>5 y 6</small></td><td><small>Un libro sin recetas para la maestra y el maestro. Fase 5. Quinto y Sexto grado.</small></td></tr>
                                    </table>
                                </td>
                        </tr></table><br><br><br>                        
                        <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td style="font-weight:bold">IMPORTANTE: Se esta entregando un juego completo de primero a sexto grado por escuela para uso del docente, y este deberá permanecer en el plantel escolar.</td></tr></table>
                        <br><br>
                        <p style="text-align:left"><small><? echo $liga; ?></small></p>
                        <?
    //----------------------------------------------------------------------------------------------------------------------------------------------  ?>
                        <br><br><br><br><br><br><br><br><br>
                        <?  $_sql="select * from ctsev where cct_zona='".$_SESSION["cct_zona"]."' and estatus='A' and idnivel=".$_SESSION["elidnivel"]; //	echo $_sql; 
                             $res_esc=mysql_query($_sql); 		   $r=1;  $x=1;  ?>

                        
                        <table width="100%" cellpadding=5 cellspacing=0>
                        <tr><td width="5"></td><td style="text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                            <td style="font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">1° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">2° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">3° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">4° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">5° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">6° g</td>
                            <td style="text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                        </tr> <?
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
                                            <tr><td width="3"></td><td style="text-align:center; font-size:14px; font-weight:bold">cct-turno</td>
                                                <td style="font-size:12px; font-weight:bold;">&emsp;&emsp;Nombre CT</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">1° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">2° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">3° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">4° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">5° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">6° g</td>
                                                <td style="text-align:center; font-size:12px; font-weight:bold;">Firma director</td>
                                            </tr><?
                                    }?>
                                    <tr>
                                        <td><small><? echo $r; ?></small></td>
                                        <td style="text-align:center"><small><? echo $rec_esc["cct"]." ".$rec_esc["turno"]; ?></small></td>
                                        <td><small><? echo $rec_esc["nom_ct"]; ?></small></td>
                                        <!-- <td style="text-align:center"><small><? // echo $s1; ?></small></td>
                                        <td style="text-align:center"><small><? // echo $s2; ?></small></td>
                                        <td style="text-align:center"><small><? // echo $s3; ?></small></td>
                                        <td style="text-align:center"><small><? // echo $s4; ?></small></td>
                                        <td style="text-align:center"><small><? // echo $s5; ?></small></td>
                                        <td style="text-align:center"><small><? // echo $s6; ?></small></td> -->

                                        <td style="text-align:center"><small>1</small></td>
                                        <td style="text-align:center"><small>1</small></td>
                                        <td style="text-align:center"><small>1</small></td>
                                        <td style="text-align:center"><small>1</small></td>
                                        <td style="text-align:center"><small>1</small></td>
                                        <td style="text-align:center"><small>1</small></td>
                                        <td>________________</td>
                                    </tr>
                                        <?

                                    $r++;   $x++;
                                }?>


                                <tr>
                                <td colspan="3" style="text-align:right; height:50px">Totales&emsp;&emsp;</td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $rec["escuelas"]; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $rec["escuelas"]; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $rec["escuelas"]; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $rec["escuelas"]; ?></small></td>
                                <td style="text-align:center; font-weight:bold"><small><? echo $rec["escuelas"]; ?></small></td>
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
                        if ($_SESSION["elidnivel"]==31 ||  $_SESSION["elidnivel"]==32){
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
 