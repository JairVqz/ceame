 Seleccione el municipio: 
											  
                                              <?php
											  $qMun="SELECT idmunicipio,municipio FROM municipio_c order by municipio";
											  $rqMun=mysql_query($qMun)or die('no se puede ejecutar qMun');
											  
											  ?>
                                                <select name="idmunicipio" id="idmunicipio"> 
                                                <option value="00"> [Todos los municipios] </option>
                                              <?php
											  	while($filMun=mysql_fetch_array($rqMun)){
													$idmunicipio=$filMun['idmunicipio'];
													$municipio=$filMun['municipio'];
													
													?>
                                                    <option value="<?php echo $idmunicipio; ?>"><?php echo $municipio; ?></option>
                                                    <?php
												}
												mysql_free_result($rqMun);
											  ?>
										        </select>