 Seleccione el nivel: 
											  
                                              <?php
											  $qNiv="SELECT idnivel,nivel,dependenivel FROM nivel_c where idnivel in (3,4,6,7)";
											  $rqNiv=mysql_query($qNiv)or die('no se puede ejecutar qNiv');
											  
											  ?>
                                                <select name="niveles" id="niveles"> 
                                                <option> [Seleccione el nivel] </option>
                                              <?php
											  	while($filNiv=mysql_fetch_array($rqNiv)){
													$idnivel=$filNiv['idnivel'];
													$nivel=$filNiv['nivel'];
													 if ($idnivel==3) $niveles="('30','31','32','35','36','37','38','34')"; // preescolar
													 if ($idnivel==4) $niveles="('40','41','42','46','47','48')"; // primaria
													 if ($idnivel==6) $niveles="('60','61','65','67','68')";
													 if ($idnivel==7) $niveles="('62','63')";
													
													?>
                                                    <option value="<?php echo $niveles; ?>"><?php echo $niveles; ?></option>
                                                    <?php
												}
												mysql_free_result($rqNiv);
											  ?>
										        </select>