                    <?
                    
                    switch($elidnivel){
                        case 60: case 61: case 65:  case 72: case 73: 
                            echo "MATERIAL DE LA ESTRATEGIA EN EL AULA: PREVENCIÓN DE ADICCIONES 'SI TE DROGAS, TE DAÑAS'<br>";    
                            echo "PARA EL NIVEL DE SECUNDARIA<br>";
                            echo "RELACIÓN DE LAS ESCUELAS DE LA ZONA PARA LA ENTREGA DE GUIAS, CARTELES Y CARTILLA <br>";
                            break;
                    } 
                    
                    ?>
                    <br>
                   
                    <table class="ftable-horizontal" align="center" border="1" cellpadding="3" cellspacing="0" style="font-size:12px;">  
                        <tr><th>&emsp;Clave&emsp;</th><th align="center">TITULO DEL MATERIAL</th></tr>
                        <tr><td align="center">Z7847</td><td>Guía para el docente - 'Si te drogas, te dañas'</td></tr>
                        
                        <?
                        $_sql="select a.idmaterial,b.material,a.cantidad,b.abrevia,b.clave from d_material_criterio a,d_material b where a.idmaterial=b.idmaterial and a.iddistribucion=3 and a.idnivel=".$elidnivel." and a.idbeneficiario=1";
                        //echo $_sql;
                        $res=mysql_query($_sql); 		$r=0;   $titcols="";    $cantcols="";  $totcols=0;
                        if (mysql_num_rows($res)>0){ 
                                        while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC);  ?> 
                                            <tr><td align="center"><? echo $recset["clave"]; ?></td>
                                            <td><? echo $recset["material"]; ?></td></tr> <? 
                                            $titcols=$titcols."<th>".$recset["abrevia"]."</th>";
                                            $cantcols=$cantcols."<td align='center'>".$recset["cantidad"]."</td>";
                                            $arrcols[]=$recset["cantidad"];
                                            $r++; 
                                        }   
                        }?>
                    </table>
                    <br>




                    <?  $_sql="select * from ctmex_distribucion3 where fer_cct_zona='".$lazona."' and fer_idnivel in (".$elidnivel.",6) order by fer_nom_ct";
					//echo $_sql; 
					$res=mysql_query($_sql); 
             		$r=0; 
					if (mysql_num_rows($res)>0){ ?> 
                            
                            <h3><? echo $elnivel."&emsp;&emsp;&emsp;Zona ".$lazona."&emsp;&emsp;&emsp;".mysql_num_rows($res)." Escuelas"; ?> </h3>


							<table class="ftable-horizontal" width="100%" border="1" cellpadding="5" cellspacing="0" style="font-size:10px;"> 
								<tr><th width="80">CT</th><th width="150">Escuela</th><th>Z7847</th><?  echo $titcols; ?><th>Almacán</th><th width="100">Firma</th></tr> 
                                <?
                                    $foll=0;
									while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC);  $foll=$foll+$recset["folletos"]; ?> 
										<tr> 
											<td><? echo $recset["clavecct"]." - ".$recset["turno"]; ?></td> 
											<td class="ftext-red" style="border-left:none"><? echo trim($recset["fer_nom_ct"]); ?></td> 
                                            <td align="center"><? echo $recset["folletos"]; ?></td> 
                                            <?  echo $cantcols; ?>
                                            <td align="center"><? echo $recset["fer_almadis"]; ?></td> 
                                            <td></td>
										</tr> <?  	$r++; //if ($r==5){ echo "<p class='SaltoDePagina'></p>"; }
									} 
                                    $totcols="";  
                                    foreach ($arrcols as $valor) {
                                        $totcols=$totcols."<td align='center'>".$valor*(mysql_num_rows($res))."</td>";
                                    }
                                    
                                    ?>	
                                <tr><td colspan="2" align="center">Totales</td><td align="center"><?  echo $foll; ?></td><?  echo $totcols; ?><td></td><td></td></tr>    	 
							</table> <?  
					}else{ ?><h4 class="fpadding-large">No hay registros</h3> <? } ?></small><br><br>

                    <?  echo "<p class='SaltoDePagina'></p><br><br><br><br>"; ?>
                    <table border="1" cellpadding="20" cellspacing="0" style="border-color:#FBFBFB; font-weight:bold"><tr><td><div style="text-align:center; font-size:16px; padding-bottom:10px">Importante</div> 
                        <div style="font-size:14px">Deberá permanecer en el plantel escolar un ejemplar de los siguientes materiales: Guía para el docente- "Si te drogas, te dañas", Cartel 1, "El cristal mata(metanfetamina)". Programa si te drogas, te dañas, Cartel 2, "Vapeadores y tabaco". Programa si te drogas, te dañas, Cartel 3, "El fentanilo te mata". Programa si te drogas, te dañas y Cartilla moral.</div></td></tr>	
                    </table><br><br> 
