                    <?
                    switch($elidnivel){
                        case 30: case 31: case 32: case 34: case 35: case 36: case 37: case 38:
                            echo "MATERIAL DE LA SUBSECRETARIA DE EDUCACION BASICA PARA EL NIVEL DE PREESCOLAR<br>";    
                            echo "RELACION DE LAS ESCUELAS DE LA ZONA PARA LA ENTREGA DE LIBROS Y CUADERNILLO<br>";
                            break;
                        case 40: case 41: case 42: case 44: case 46: 
                            echo "MATERIAL DE LA SUBSECRETARIA DE EDUCACION BASICA PARA EL NIVEL DE PRIMARIA<br>";    
                            echo "RELACION DE LAS ESCUELAS DE LA ZONA PARA LA ENTREGA DE LIBROS Y GUIAS<br>";
                            break;
                        case 60: case 61: case 62: case 65:  
                            echo "MATERIAL DE LA SUBSECRETARIA DE EDUCACION BASICA PARA EL NIVEL DE SECUNDARIA<br>";    
                            echo "RELACION DE LAS ESCUELAS DE LA ZONA PARA LA ENTREGA DE GUIA Y CUADERNILLOS<br>";
                            break;
                        case 72: case 73: case 74: case 76:  
                            echo "MATERIAL DE LA SUBSECRETARIA DE EDUCACION BASICA PARA EL NIVEL DE TELESECUNDARIA<br>";    
                            echo "RELACION DE LAS ESCUELAS DE LA ZONA PARA LA ENTREGA DE GUIA Y CUADERNILLOS<br>";
                            break;
                    } 
                    
                    ?>
                    <small><br>
                    <h3>Zona escolar : <? echo $_SESSION["vg_cct_zona"]; ?></h3>
                    <table class="ftable-all">  
                        <tr><th align="left">TITULO DEL MATERIAL :</th></tr><?
                        $_sql="select a.idmaterial,b.material,a.cantidad,b.abrevia from d_material_criterio a,d_material b where a.idmaterial=b.idmaterial and a.iddistribucion=2 and a.idnivel=".$elidnivel." and a.idbeneficiario=1";
                        //echo $_sql;
                        $res=mysql_query($_sql); 		$r=0;   $titcols="";    $cantcols="";  $totcols=0;
                        if (mysql_num_rows($res)>0){ 
                                        while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC);  ?> 
                                            <tr><td><? echo $recset["material"]; ?></td></tr> <? 
                                            $titcols=$titcols."<th style='border-bottom: solid 1px'>".$recset["abrevia"]."</th>";
                                            $cantcols=$cantcols."<td align='center'>".$recset["cantidad"]."</td>";
                                            $arrcols[]=$recset["cantidad"];
                                            $r++; 
                                        }   
                        }?>
                    </table><br><br><?




                    $_sql="select * from ctsev where cct_zona='".$_SESSION["vg_cct_zona"]."' and idnivel=".$elidnivel." order by nombrempio,nombreloc";
					//echo $_sql; 
					$res=mysql_query($_sql); 		$r=0; 
					if (mysql_num_rows($res)>0){ ?> 
							<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border: 1px solid #F7F7F7; font-size:10px;"> 
								<tr><th style="border-bottom: solid 1px">CT</th><th style="border-bottom: solid 1px">Escuela</th><?  echo $titcols; ?><th style='border-bottom: solid 1px'>Firma</th></tr> <?
									while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC);  ?> 
										<tr> 
											<td><? echo $recset["cct"]." - ".$recset["turno"]; ?></td> 
											<td class="ftext-red"><? echo $recset["nom_ct"]; ?></td> 
                                            <?  echo $cantcols; ?>
                                            <td></td>
										</tr> <?  	$r++; 
									} 
                                    $totcols="";  $x=0;
                                    foreach ($arrcols as $valor) {
                                        $x++;
                                        $totcols=$totcols."<td align='center'>".$valor*(mysql_num_rows($res))."</td>";
                                    }
                                    
                                    ?>	
                                <tr><th colspan="2">Totales</th><?  echo $totcols; ?><th></th></tr>    	 
							</table> <?  
					}else{ ?><h4 class="fpadding-large">No hay registros</h3> <? } ?></small><br><br>
