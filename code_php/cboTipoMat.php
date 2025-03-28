											  
                                              <?php
											  $qTipoMat="SELECT idtipomat,tipomaterial FROM tipomat_c WHERE idtipomat NOT IN (100,110,111) AND status='A' ORDER BY tipomaterial";
											  $rqTipoMat=mysql_query($qTipoMat)or die('no se puede ejecutar qTipoMat');
											  // está consulta no debe considerar libros de texto gratuitos y bibliotecas de aula
											  ?>
                                                <select name="idtipomat" id="idtipomat"> 
                                                <option value="00"> [Seleccione el tipo de material] </option>
                                              <?php
											  	while($filTipoMat=mysql_fetch_array($rqTipoMat)){
													$idtipomat=$filTipoMat['idtipomat'];
													$tipomaterial=$filTipoMat['tipomaterial'];
													
													?>
                                                    <option value="<?php echo $idtipomat; ?>"><?php echo $tipomaterial; ?></option>
                                                    <?php
												}
												mysql_free_result($rqTipoMat);
											  ?>
										        </select>