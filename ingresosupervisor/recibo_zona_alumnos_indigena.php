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
                        RECIBO DE LIBROS DE TEXTO EN LENGUA ÍNDIGENA DEL NIVEL DE <? echo strtoupper($elnivel); ?> <br><br> <?
                        //------------------------------------------------------------------------------------------------------------------------------------------
                        //mysql_query("SET SQL_BIG_SELECTS=1");
                        if ($_SESSION["elidnivel"]>39 && $_SESSION["vg_tipousuario"]=="Almacen"){ $condalmacen=" and b.idalmarbo=".$_SESSION["vg_idalmacen"]; }else{ $condalmacen=""; }

                        // solo por requerimientos de esta zona
                        if ($_SESSION["elidnivel"]>39 && $_SESSION["vg_tipousuario"]=="Supervisor" && $_SESSION["vg_cct_zona"]=="30FTV5605L"){ $condalmacen=" and b.idalmarbo=8"; }else{ $condalmacen=""; }

                        $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,a.nommun as municipio,a.folio,b.idalmarbo,b.almarbo,a.nomloc as nombreloc,b.idnivel,b.nivel,count(b.cct) as numescuelas,sum(b.alu_1) as alu1,sum(b.alu_2) as alu2,sum(b.alu_3) as alu3,sum(b.alu_4) as alu4,sum(b.alu_5) as alu5,sum(b.alu_6) as alu6 from supervis_c a,ctsev b where a.cuenta=b.cct_zona and b.idnivel=".$_SESSION["elidnivel"].$condalmacen." and b.estatus='A' and b.cct_zona='".$_SESSION["cct_zona"]."' group by b.cct_zona"; 
                        $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,a.nommun as municipio,a.folio,b.idalmarbo,b.almarbo,a.nomloc as nombreloc,b.idnivel,b.nivel,count(b.cct) as numescuelas from supervis_c a,ctsev_indigena b where a.cuenta=b.cct_zona and b.idnivel=".$_SESSION["elidnivel"].$condalmacen." and b.estatus='A' and b.cct_zona='".$_SESSION["cct_zona"]."' group by b.cct_zona"; 
                       // 	echo "1. Datos generales---- ".$_sql; 
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
                        <?php
                        if ($_SESSION["elidnivel"]>39 && $_SESSION["elidnivel"]<59 ){$tope=6;}else{$tope=3;}
                        for ($i=1; $i <= $tope; $i++) { 
                            switch($i){ case 1: $tit="Primer"; break;   case 2: $tit="Segundo"; break;      case 3: $tit="Tercer";  break;  case 4: $tit="Cuarto";   break;   case 5: $tit="Quinto";  break;    case 6: $tit="Sexto";  break;      }
                            if ($_SESSION["elidnivel"]>59){$bantele=" and idtipomat!=10";}else{$bantele="";}

                            
                            $_sql="select b.lengua,a.idmaterial as clave,a.titulo,a.idgrado,a.primcajas,a.idnivel,b.alu_".$i."_23,SUM(b.alu_".$i."_24) as alumnos,COUNT(b.id) as escuelas FROM l_libros_indigena a,ctsev_indigena b WHERE a.idmaterial=b.cvelibro".$i." and b.cct_zona='".$_SESSION["cct_zona"]."' and a.idgrado=".$i." and a.destino regexp 'A' and a.ciclo='".$_SESSION["vg_cicloescolar"]."' and a.idnivel=".substr($_SESSION["elidnivel"],0,1)." and a.idtipomat!=10 and a.estatus='A' ".$bantele." group by b.lengua order by a.idnivel"; 
                            //echo "2.- libros de alumnos---- ".$_sql; 
                            $res_libros=mysql_query($_sql); 		$r=0;    
                            if (mysql_num_rows($res_libros)>0){  ?>
                                <div style='font-size:18px; font-weight:bold; margin:10px'><? echo $tit; ?> Grado</div>
                                <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                                    <tr><td colspan=2 style="border:none;"></td><td style="text-align:center; font-weight:bold" colspan=3>Ciclo escolar<br><?php echo $_SESSION["vg_cicloescolaranterior"]; ?></td><td style="text-align:center; font-weight:bold;">Ciclo escolar<br><?php echo $_SESSION["vg_cicloescolar"]; ?></td><td style="text-align:center; font-weight:bold" colspan=4>Total a recibir</td></tr>
                                    <tr><td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td><td style="text-align:center; font-weight:bold">Entrega<br>Escuela</td><td style="text-align:center; font-weight:bold">Total<br>Escuelas</td><td style="text-align:center; font-weight:bold">Total</td><td style="text-align:center; font-weight:bold">Entrega<br>Alumnos</td><td style="text-align:center; font-weight:bold">Total<br>    General</td><td style="text-align:center; font-weight:bold">Ejemplares<br>por caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td></tr><?


                                    $tot_cajas=0;   $tot_sueltos=0; 
                                    while ($r<mysql_num_rows($res_libros)){ 		$reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                                        $alu=$reclibros["alumnos"];     $ej=$reclibros["primcajas"];    $cajas=floor((($reclibros["alu_".$i."_23"]*$reclibros["escuelas"])+$alu)/$ej);      $sueltos=(($reclibros["alu_".$i."_23"]*$reclibros["escuelas"])+$alu)-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;?>
                                        <tr><td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><td style="text-align:right;"><? echo $reclibros["alu_".$i."_23"]; ?></td><td style="text-align:right;"><? echo $reclibros["escuelas"]; ?></td><td style="text-align:right;"><? echo ($reclibros["alu_".$i."_23"]*$reclibros["escuelas"]); ?></td><td style="text-align:right;"><? echo $alu; ?></td><td style="text-align:right;"><? echo (($reclibros["alu_".$i."_23"]*$reclibros["escuelas"])+$alu); ?></td><td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td></tr><?
                                        $r++;        
                                    }?>                            
                                    <tr><td colspan="8" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                                </table><br><br>                      <?  
                            }  
                            
                            
                            /***************************************   INGLES SOLO PARA SECUNDARISA Y TELESECUNDARIAS ********************************************************** */
                            if ($_SESSION["elidnivel"]>59 ){   
                                for ($l=1; $l <= 2; $l++) {
                                    if ($l==1){$enc="Alumno";}else{$enc="Maestro";}
                                    if ($_SESSION["vg_tipousuario"]=="Almacen"){ $condalmacen=" and a.idalmacen=".$_SESSION["vg_idalmacen"]; }else{ $condalmacen=""; }
                                    // solo por requerimientos de esta zona
                                    if ($_SESSION["vg_tipousuario"]=="Supervisor" && $_SESSION["vg_cct_zona"]=="30FTV5605L"){ $condalmacen=" and a.idalmacen=8"; }else{ $condalmacen=""; }



                                    $_sql="select a.clave,b.titulo,b.primcajas,sum(a.matricula) as matricula,b.destino FROM ctsev_telesecundarias_ingles a,l_libros b WHERE CONCAT(a.clave,a.destino)=CONCAT(b.idmaterial,b.destino) and a.cct_zona='".$_SESSION["cct_zona"]."' ".$condalmacen." and a.idgrado=".$i." and a.idnivel=".$_SESSION["elidnivel"]." and b.idnivel=".substr($_SESSION["elidnivel"],0,1)." and b.estatus='A' and a.destino regexp '".substr($enc,0,1)."' and a.ciclo REGEXP '".$_SESSION["vg_cicloescolar"]."' group by CONCAT(a.clave,a.destino) order by b.titulo"; 
                                    	// echo "3.- Material de ingles -------".$_sql; 
                                    /////////////////////////////  $_sql="select a.clave,b.titulo,b.primcajas,sum(a.matricula) as matricula FROM ctsev_telesecundarias_ingles a,l_libros b WHERE a.clave=b.idmaterial and a.cct_zona='".$_SESSION["cct_zona"]."' and a.idgrado=".$i." and a.idnivel=".$_SESSION["elidnivel"]." and b.idnivel=7 and b.estatus='A' and a.ciclo='".$_SESSION["vg_cicloescolar"]."' group by a.clave"; 	// echo $_sql; 
                                    $res_teles=mysql_query("SET SQL_BIG_SELECTS=1");
                                    $res_teles=mysql_query($_sql); 	                            $r=0;    $tot_cajas=0;   $tot_sueltos=0; 
                                    if (mysql_num_rows($res_teles)>0){ ?>
                                        <div style='font-size:16px; font-weight:bold; margin:10px'><? echo $tit; ?> Grado - Claves de Inglés (<? echo $enc; ?>)</div>
                                        <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                                            <tr><td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td><td style="text-align:center; font-weight:bold">Asignación</td><td style="text-align:center; font-weight:bold">Ejem_caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td></tr><?
                                            while ($r<mysql_num_rows($res_teles)){ 		$recteles=mysql_fetch_array($res_teles,MYSQL_ASSOC);   
                                                $ej=$recteles["primcajas"];    $cajas=floor($recteles["matricula"]/$ej);      $sueltos=$recteles["matricula"]-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;?>
                                                <tr><td><? echo $recteles["clave"]; ?></td><td><? echo $recteles["titulo"]; ?></td><td style="text-align:right;"><? echo number_format($recteles["matricula"],0); ?></td><td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td></tr><?
                                                $r++;        
                                            }?>                            
                                            <tr><td colspan="4" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                                        </table><br><br>                       <?      
                                    }  echo "<br><br>";
                                } // fin del for 
                            }    
                            // ***********************************************************************
                        }   // fin del for de GRADOS
    //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                        <!--      Aviso     --> <?

                        if ($_SESSION["elidnivel"]>70){ ?>
                            <div style="text-align:left; margin:10px">INFORMACIÓN RELEVANTE</div>
                            <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>Recibe <? echo $rec_zona_alumno["numescuelas"]; ?> paquetes adicionales, uno por escuela, que incluye un juego de libros del alumno de primer grado (T1LEA, T1SAA, T1HUA, T1ETA, T1LP1, T1LP2, T1LP3, T1MLA) y un ejemplar del Libro sin recetas para la Maestra y el Maestro. Fase 6 (T1LPM); para su uso y resguardo en el plantel escolar</td></tr></table><?
                        } ?>
                        <br><br><br><p class='SaltoDePagina' style="text-align:left"><small><? echo $liga; ?></small></p><br><br><br><br><br>
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
                            <tr><td width="15%" align="center"><? echo GenerarQR("LTG" . number_format( $rec_zona_alumno["folio"],0), "qr_zona_".$elnivel."/"); ?> </td><td style="font-size:18px; font-weight:bold;  vertical-align:top">Observaciones</td></tr>
                            <tr><td>NOTA<br>IMPORTANTE</td><td>
                                <ol>
                                    <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                                    <li style="margin:10px">No se le har&aacute; entrega de material alguno, sí el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                                    <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                            </td></tr>
                        <table><br><br><br>            

                        <br><br><br><p style="text-align:left"><small><? echo $liga; ?></small></p>
            </div><?php
 