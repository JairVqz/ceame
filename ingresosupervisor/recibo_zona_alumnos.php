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
                RECIBO DE LIBROS DE TEXTO POR ZONA DEL NIVEL <? echo strtoupper($elnivel);  ?> <br><br> <?
                //------------------------------------------------------------------------------------------------------------------------------------------
                if ($_SESSION["vg_tipousuario"]=="Supervisor"){
                    $arrniv=explode("|",$_GET["arr_nivel"]);
                    $elidnivel=$arrniv[0];
                }else{
                    $elidnivel=$_GET["idnivel"];
                }
                //mysql_query("SET SQL_BIG_SELECTS=1");
                $campo="almarbo"; // Para distribucion generalmente
                if ($_SESSION["elidnivel"]<39 && $_SESSION["vg_tipousuario"]=="Almacen"){ 
                    // Para PREESCOLAR, en la distribucion se usa el campo     almarec 
                    // pero para la redistribucion se usa almarbo, por eso basta con bloquear la linea de abajo. Checar esto mismo en el programa  ingresoalmacen/pauta_seleccion_niveles_para_sector.php
                    $campo="almarec";   
                    $condalmacen=" and b.id".$campo."=".$_SESSION["vg_idalmacen"];
                }else{
                    $condalmacen="";
                }
                
                // CASO ESPECIAL cuando una ZONA tenga escuelas de 2 o mas almacenes
                if ($_SESSION["vg_cct_zona"]=="30FTV5605L"){ $condalmacen=" and b.idalmarbo=8"; }
                // ----------------------------------------------------------------------------------------------------------
                
                //K1LDG,K2LDG,K3LDG,K0CFA,K0LPM,K0MTM,K0TAM         Estos campos se agregaron para el ciclo 24-25 y solo para preescolar
                $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,a.nommun as municipio,a.folio,b.id".$campo.",b.".$campo.",a.nomloc as nombreloc,b.idnivel,b.nivel,count(b.cct) as numescuelas,sum(b.alu_1) as alu1,sum(b.alu_2) as alu2,sum(b.alu_3) as alu3,sum(b.alu_4) as alu4,sum(b.alu_5) as alu5,sum(b.alu_6) as alu6,sum(d1) as sumd1,sum(d2) as sumd2,sum(d3) as sumd3,sum(dmgdo) as sumdmgdo, sum(b.K1LDG) as sK1LDG,sum(b.K2LDG) as sK2LDG,sum(b.K3LDG) as sK3LDG,sum(b.K0CFA) as sK0CFA,sum(b.K0LPM) as sK0LPM,sum(b.K0MTM) as sK0MTM,sum(b.K0TAM) as sK0TAM from supervis_c a,ctsev b where a.cuenta=b.cct_zona and b.idnivel=".$_SESSION["elidnivel"].$condalmacen." and b.estatus='A' and b.cct_zona='".$_SESSION["cct_zona"]."' group by b.cct_zona"; 
                	//echo "1. Datos generales---- ".$_sql."<hr>".$_SESSION["elidnivel"]; 




                $res_zona_alumno=mysql_query($_sql); 		 $rec_zona_alumno=mysql_fetch_array($res_zona_alumno,MYSQL_ASSOC); 
                $numescuelas=$rec_zona_alumno["numescuelas"];
                $_sql="select almacen,responsable from almacen_c where idalmacen=".$rec_zona_alumno["id".$campo]; //	echo $_sql; 
                $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC);  
                //---------------------------------------------------------------------------------------------------------------------------------------------- ?>
                <table class="ftable-print-horizontal" cellpadding="5" cellspacing="0" width="100%" border=1 style="font-weight:bold">
                    <tr><td width="10%">Folio</td><td  width="20%">LTG <? echo $rec_zona_alumno["folio"]; ?></td><td width="14%">Almacen</td><td><? echo  $rec_almacen["almacen"]; ?></td></tr>
                    <tr><td>CCT</td><td><? echo $_SESSION["cct_zona"]; ?></td><td>Nombre</td><td><? echo $rec_zona_alumno["nombre"]; ?></td></tr>
                    <tr><td>Sector</td><td><? echo $rec_zona_alumno["sector"]; ?></td><td>Zona</td><td><? echo $rec_zona_alumno["zonaescola"]; ?></td></tr>
                    <tr><td>Localidad</td><td><? echo $rec_zona_alumno["nombreloc"]; ?></td><td>Municipio</td><td><? echo $rec_zona_alumno["municipio"]; ?></td></tr>
                </table><br><br> 
                <section><?php  // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  LIBROS PARA ALUMNOS DE LOS RESPECTIVOS GRADOS ESCOLARES  %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  
                    if ($_SESSION["elidnivel"]>39 && $_SESSION["elidnivel"]<59 ){$tope=6;}else{$tope=3;}
                    $tot_alum=0;
                    for ($i=1; $i <= $tope; $i++) { 
                        switch($i){ case 1: $tit="Primer"; break;   case 2: $tit="Segundo"; break;      case 3: $tit="Tercer";  break;  case 4: $tit="Cuarto";   break;   case 5: $tit="Quinto";  break;    case 6: $tit="Sexto";  break;      }
                        if ($_SESSION["elidnivel"]>59){$bantele=" and idtipomat!=10";}else{$bantele="";}

                        $_sql="select idmaterial as clave,titulo,idgrado,primcajas,idnivel,destino FROM l_libros WHERE idgrado=".$i." and destino='A' and ciclo='".$_SESSION["vg_cicloescolar"]."' and idnivel=".substr($_SESSION["elidnivel"],0,1).$bantele." and estatus='A' and visible!='N' order by idnivel"; 
                        //   echo "2.- libros de alumnos---- ".$_sql; 
                        $res_libros=mysql_query($_sql); 		$r=0;    
                        if (mysql_num_rows($res_libros)>0){  ?>
                            <div style='font-size:18px; font-weight:bold; margin:10px'><? echo $tit; ?> Grado</div>
                            <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                                <tr><td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td>
                                    <td style="text-align:center; font-weight:bold">1 Ejemplar<br>por Escuela</td>
                                    <td style="text-align:center; font-weight:bold">Alumnos</td>
                                    <td style="text-align:center; font-weight:bold">Total a recibir</td>
                                    <td style="text-align:center; font-weight:bold">Ejem_caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td></tr><?
                                $tot_cajas=0;   $tot_sueltos=0; 
                                while ($r<mysql_num_rows($res_libros)){ 		$reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                                    if (intval($reclibros["primcajas"])>0){
                                            $alu=$rec_zona_alumno["alu".$i];     $ej=$reclibros["primcajas"];    $cajas=floor(($alu+$numescuelas)/$ej);    $sueltos=($alu+$numescuelas)-($ej*$cajas);        $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;
                                    }     
                                            ?>
                                    <tr><td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><?
                                        if (intval($reclibros["primcajas"])==0){ ?> <td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td><td style="text-align:right;">0</td> <? 
                                        }else{ ?><td style="text-align:right;"><? echo $numescuelas; ?></td>
                                            <td style="text-align:right;"><? echo $alu; ?></td>
                                            <td style="text-align:right;"><? echo $alu+$numescuelas; ?></td>
                                            <td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td></tr><?
                                        }
                                    $r++;        
                                }?>                            
                                <tr><td colspan="6" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                            </table><br><br>                      <?  
                        }  
                        
                        
                        /***************************************   INGLES SOLO PARA SECUNDARISA Y TELESECUNDARIAS ********************************************************** */
                        if ($_SESSION["elidnivel"]>59 ){   
                            for ($l=1; $l <= 2; $l++) {
                                if ($l==1){$enc="Alumno";}else{$enc="Maestro";}
                                if ($_SESSION["vg_tipousuario"]=="Almacen"){ $condinglesalmacen=" and a.idalmacen=".$_SESSION["vg_idalmacen"]; }else{ $condinglesalmacen=""; }
                                // solo por requerimientos de esta zona
                                if ($_SESSION["vg_tipousuario"]=="Supervisor" && $_SESSION["vg_cct_zona"]=="30FTV5605L"){ $condinglesalmacen=" and a.idalmacen=8"; }else{ $condinglesalmacen=""; }



                                $_sql="select a.clave,b.titulo,b.primcajas,sum(a.matricula) as matricula,b.destino FROM ctsev_telesecundarias_ingles a,l_libros b WHERE CONCAT(a.clave,a.destino)=CONCAT(b.idmaterial,b.destino) and a.cct_zona='".$_SESSION["cct_zona"]."' ".$condinglesalmacen." and a.idgrado=".$i." and a.idnivel=".$_SESSION["elidnivel"]." and b.idnivel=".substr($_SESSION["elidnivel"],0,1)." and b.estatus='A' and a.destino regexp '".substr($enc,0,1)."' and a.ciclo REGEXP '".$_SESSION["vg_cicloescolar"]."' group by CONCAT(a.clave,a.destino) order by b.titulo"; 
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
                    }   // fin del for de GRADOS ?>
                </section>
                <br><br><br><p class='SaltoDePagina' style="text-align:left"><small><? echo $liga; ?></small></p><br><br><br><br><br>
                <section><? //    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    LIBROS PARA ESCUELA (MAESTROS) Y LIBROS PARA ALUMNOS Y ESCUELA    %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
                    if ($elidnivel<40){   //   ----------------    PREESCOLAR
                                            
                        // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  CLAVES PARA ESCUELA      No se muestran claves con (destino=A) ni tampoco (destino=AM)
                        $_sql="select distinct a.idmaterial as clave,a.titulo,a.primcajas,a.destino FROM l_libros a WHERE a.ciclo='".$_SESSION["vg_cicloescolar"]."' and a.idnivel=3 and a.destino!='A' and a.destino!='AM'  and a.estatus='A' and a.visible!='N' order by a.destino desc";   // echo $_sql; 
                        $res_libros=mysql_query($_sql); 		$r=0;   ?>  
                        
                        <div style='font-size:16px; font-weight:bold; margin:10px'> Claves para Escuela </div>
                        <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                        <tr><td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td><td style="text-align:center; font-weight:bold">Escuela</td><td style="text-align:center; font-weight:bold">Ejem_caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td></tr><?
                        $tot_cajas=0;   $tot_sueltos=0; 
                        while ($r<mysql_num_rows($res_libros)){ 		$reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                            $ej=$reclibros["primcajas"];
                            if (intval($ej)>0){
                                $libescuela=$rec_zona_alumno["s".$reclibros["clave"]]; // Para la columna Escuela
                                $cajas=floor($libescuela/$ej);      $sueltos=$libescuela-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;
                            }else{ $libescuela=0; $cajas=0;  $sueltos=0;  } ?>
                            <tr><td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><td style="text-align:right;"><? echo $libescuela; ?></td><td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td></tr><?
                            $r++;        
                        }?>                            
                        <tr><td colspan="4" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                        </table><br><br>
                        <div><small>NOTA: De las claves de libro K0LPM, K0MTM y K0TAM se entregan 2 ejemplares por plantel escolar.<br>
                        Se entrega material de las claves K1LDG, K2LDG y K3LDG a las esuelas que tengan matrícula asignada en los grados 1°, 2° y 3°. </small>
                    </div><br><br>
                         <?
                    } 
                    if ($elidnivel<40){    //   ----------------    PREESCOLAR
                        
                        // %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  CLAVES PARA ALUMNO Y ESCUELA      se muestran claves con (destino='AM') unicamente
                        $_sql="select distinct a.idmaterial as clave,a.titulo,a.primcajas,a.destino FROM l_libros a WHERE a.ciclo='".$_SESSION["vg_cicloescolar"]."' and a.idnivel=3 and a.destino='AM' and a.estatus='A' and a.visible!='N' order by a.destino desc";   // echo $_sql; 
                        $res_libros=mysql_query($_sql); 		$r=0;   ?>  
                        
                        <div style='font-size:16px; font-weight:bold; margin:10px'> Claves para alumno y escuela </div>
                        <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                        <tr><td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold" width="42%">Titulo</td><td style="text-align:center; font-weight:bold">Alumnos de<br>1°, 2° y 3°</td><td style="text-align:center; font-weight:bold">Escuela</td><td style="text-align:center; font-weight:bold">Total a<br>recibir</td><td style="text-align:center; font-weight:bold">Ejem_caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td></tr><?
                        $tot_cajas=0;   $tot_sueltos=0; 
                        while ($r<mysql_num_rows($res_libros)){ 		$reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                            $ej=$reclibros["primcajas"];
                            if (intval($ej)>0){
                                $libalumno=($rec_zona_alumno["alu1"]+$rec_zona_alumno["alu2"]+$rec_zona_alumno["alu3"]); // Para la columna Escuela
                                $libescuela=$rec_zona_alumno["s".$reclibros["clave"]]; // Para la columna Escuela
                                $cajas=floor(($libalumno+$libescuela)/$ej);      $sueltos=($libalumno+$libescuela)-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;
                            }else{$libalumno=0; $libescuela=0; $cajas=0;  $sueltos=0; } ?>
                            <tr><td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><td style="text-align:right;"><? echo $libalumno; ?></td><td style="text-align:right;"><? echo $libescuela; ?></td><td style="text-align:right;"><? echo ($libalumno+$libescuela); ?></td><td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td></tr><?
                            $r++;        
                        }?>                            
                        <tr><td colspan="6" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                        </table><br><br> 
                        <div><small>NOTA: De la clave K0CFA se entregan 2 ejemplares por plantel escolar.<br></small>
                    </div><br><br>
                        <?
                    }  
                    
                    if ($elidnivel>69){    //   ----------------    TELESECUNDARIA   (Porque en secundarias NO ENTRAN SUPERVISORES)
                        // ================================  CLAVES PARA MAESTRO      se muestran claves con (destino='M') 
                        $_sql="select distinct a.idmaterial as clave,a.titulo,a.primcajas,a.destino FROM l_libros a WHERE a.ciclo='".$_SESSION["vg_cicloescolar"]."' and a.idnivel=".substr($elidnivel,0,1)." and a.destino='M' and a.estatus='A' and a.visible!='N' order by a.destino desc";    //echo $_sql; 
                        $res_libros=mysql_query($_sql); 		$r=0;   ?>  
                        
                        <div style='font-size:16px; font-weight:bold; margin:10px'> Claves para Maestro </div>
                        <table class="ftable-print" cellpadding="5" cellspacing="0" width="100%" border=1>
                        <tr><td style="text-align:center; font-weight:bold">Clave</td><td style="text-align:center; font-weight:bold">Título</td><td style="text-align:center; font-weight:bold">Maestros de<br>1°, 2° y 3°</td><td style="text-align:center; font-weight:bold">Ejem_caja</td><td style="text-align:center; font-weight:bold">Cajas</td><td style="text-align:center; font-weight:bold">Sueltos</td></tr><?
                        $tot_cajas=0;   $tot_sueltos=0; $i=0;
                        while ($r<mysql_num_rows($res_libros)){ 	$i++;	$reclibros=mysql_fetch_array($res_libros,MYSQL_ASSOC);
                            $ej=$reclibros["primcajas"];    
                            if (intval($ej)>0){
                                $libdocente=($rec_zona_alumno["sumd1"]+$rec_zona_alumno["sumd2"]+$rec_zona_alumno["sumd3"]+$rec_zona_alumno["sumdmgdo"]); // Para la columna Docente
                                $cajas=floor($libdocente/$ej);      $sueltos=$libdocente-($ej*$cajas);             $tot_cajas=$tot_cajas+$cajas;         $tot_sueltos=$tot_sueltos+$sueltos;
                            }else{$libdocente=0; $cajas=0; $sueltos=0;}?>
                            <tr><td><? echo $reclibros["clave"]; ?></td><td><? echo $reclibros["titulo"]; ?></td><td style="text-align:right;"><? echo $libdocente; ?></td><td style="text-align:right;"><? echo $ej; ?></td><td style="text-align:right;"><? echo $cajas; ?></td><td style="text-align:right;"><? echo $sueltos; ?></td></tr><?
                            $r++;        
                        }?>                            
                        <tr><td colspan="4" style="text-align:right; font-weight:bold">Total&emsp;<td style="text-align:right; font-weight:bold"><? echo $tot_cajas; ?></td><td style="text-align:right; font-weight:bold"><? echo $tot_sueltos; ?></td></tr>
                        </table><br><br><br> <?
                    }                    
                    ?>  
                </section>                 
                <table cellpadding="7" cellspacing="0" width="100%" border=1><tr><td>Este recibo es un documento oficial y los libros que recibo son propiedad de la Nación, por lo que me comprometo a vigilar el buen uso del material y verificar la entrega a los beneficiarios</td></tr></table>  <br><br>
                 <!--      Firmas     --><? 
                        $firma_entrega="DEL ALMACÉN";     $firma_recibe="DEL SUPERVISOR";     
                        $sello_entrega="ALMACEN";         $sello_recibe="SUPERVISIÓN"; 
                        $entrego=$rec_almacen["responsable"]; 
                    ?>
                    <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                    <!--      Aviso     -->                        <br><br><br>
                        <div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div><br>
                    <!--      QR     --><br><br>
                        <table cellpadding="10" cellspacing="0" width="100%" border=1>
                            <tr><td width="15%" align="center"><? echo GenerarQR("LTG" . number_format( $rec_zona_alumno["folio"],0), "qr_zona_".$elnivel."/"); ?> </td><td style="font-size:18px; font-weight:bold;  vertical-align:top">Observaciones</td></tr>
                            <tr><td>NOTA<br>IMPORTANTE</td><td>
                                <ol>
                                    <li style="margin:10px"> Deber&aacute; contar debidamente el material que se le entrega y hacer las anotaciones de las cantidades que no haya recibido, ya que no podr&aacute; hacer reclamaci&oacute;n alguna si no ha quedado constancia en este recibo.</li>
                                    <li style="margin:10px">No se le har&aacute; entrega de material alguno, sí el presente recibo no cuenta con las firmas y sellos correspondientes.</li>
                                    <li style="margin:10px">En caso de decremento de matr&iacute;cula, me comprometo a devolver los paquetes de los libros sobrantes.</li>
                                    <li style="margin:10px">Si requiere hacer alguna anotaci&oacute;n, deber&aacute; hacer en el apartado de <b>OBSERVACIONES</b>. Favor de <b>NO</b> hacer anotaciones sobres las cantidades o t&iacute;tulos de los libros.</li></ol>
                            </td></tr>
                        <table><br><br><br>            
                    <br><br><br><p style="text-align:left"><small><? echo $liga; ?></small></p>
            </div><?php
 