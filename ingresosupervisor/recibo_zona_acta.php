<?      
        //mysql_query("SET SQL_BIG_SELECTS=1");
        $_sql="select a.cuenta,a.nombre,b.sector,b.zonaescola,c.municipio,a.valid_direccion,a.folio,b.idalmarbo,b.nombreloc,b.idnivel,b.nivel,count(b.cct) as escuelas,sum(b.alu_1) as alu1,sum(b.alu_2) as alu2,sum(b.alu_3) as alu3,sum(b.alu_4) as alu4,sum(b.alu_5) as alu5,sum(b.alu_6) as alu6 from supervis_c a,ctsev b,municipio_c c where a.cuenta=b.cct_zona and a.valid_municipio=c.idmunicipio and b.idnivel=".$_SESSION["elidnivel"]." and b.estatus='A' and b.cct_zona='".$_SESSION["cct_zona"]."' group by b.cct_zona"; //	echo $_sql; 
        $res_zona_alumno=mysql_query($_sql); 		 $rec_zona_alumno=mysql_fetch_array($res_zona_alumno,MYSQL_ASSOC);  
        // if ($_SESSION["vg_tipousuario"]=="Supervisor"){
        //     $_SESSION["elidnivel"]=$rec_zona_alumno["idnivel"];
        //     $elnivel=$rec_zona_alumno["nivel"];
        //     $elnivel=str_replace("Estatal","",$rec_zona_alumno["nivel"]);  $elnivel=str_replace("Federal","",$elnivel);  $elnivel=str_replace("Indigena","",$elnivel);  
        // }
        $_sql="select * from almacen_c where idalmacen=".$rec_zona_alumno["idalmarbo"]; //	echo $_sql; 
        $res_almacen=mysql_query($_sql); 		 $rec_almacen=mysql_fetch_array($res_almacen,MYSQL_ASSOC); 
        
        if ($rec_zona_alumno["idnivel"]>70){$bantele=" and idtipomat!=10";}else{$bantele="";}    
        
        $_sql="select idgrado,count(id) as libros from l_libros where destino='A' and ciclo='".$_SESSION["vg_cicloescolar"]."' and idnivel=".substr($rec_zona_alumno["idnivel"],0,1)." and estatus='A'".$bantele." group by idgrado"; //	echo $_sql; 
        $res_libro_alumno=mysql_query($_sql);  $r=0;  
        while ($r<mysql_num_rows($res_libro_alumno)){
            $rec_libro_alumno=mysql_fetch_array($res_libro_alumno,MYSQL_ASSOC); 
            switch($rec_libro_alumno["idgrado"]){case 1: $numlibrosalumno1=$rec_libro_alumno["libros"]; break;     case 2: $numlibrosalumno2=$rec_libro_alumno["libros"]; break;   case 3: $numlibrosalumno3=$rec_libro_alumno["libros"]; break;   case 4: $numlibrosalumno4=$rec_libro_alumno["libros"]; break;   case 5: $numlibrosalumno5=$rec_libro_alumno["libros"]; break;   case 6: $numlibrosalumno6=$rec_libro_alumno["libros"]; break; } 
            $r++;
        }


        $_sql="select idgrado,count(id) as libros from l_libros where destino='M' and ciclo='".$_SESSION["vg_cicloescolar"]."' and idnivel=".substr($rec_zona_alumno["idnivel"],0,1)." and estatus='A'".$bantele." group by idgrado"; //	echo $_sql; 
        $res_libro_maestro=mysql_query($_sql);  $r=0;  
        while ($r<mysql_num_rows($res_libro_maestro)){
            $rec_libro_maestro=mysql_fetch_array($res_libro_maestro,MYSQL_ASSOC); 
            switch($rec_libro_maestro["idgrado"]){case 1: $numlibrosmaestro1=$rec_libro_maestro["libros"]; break;     case 2: $numlibrosmaestro2=$rec_libro_maestro["libros"]; break;   case 3: $numlibrosmaestro3=$rec_libro_maestro["libros"]; break;   case 4: $numlibrosmaestro4=$rec_libro_maestro["libros"]; break;   case 5: $numlibrosmaestro5=$rec_libro_maestro["libros"]; break;   case 6: $numlibrosmaestro6=$rec_libro_maestro["libros"]; break; } 
            $r++;
        }?>

        
		<br><br><br>
		<img src='../../images/logo_SEVGob.png' width='700' border='0' style="margin-left: auto; margin-right: auto; display:block;">
		<div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
		<div style='margin-left:50px; margin-right:50px;  font-weight:bold; text-align:center; font-size:18px'>
                ACTA DE ENTREGA RECEPCIÓN DE LIBROS DE TEXTO<br>
                GRATUITOS POR ASIGNACIÓN, DEL NIVEL DE EDUCACIÓN <? echo strtoupper($elnivel); ?>
        </div>
        <br><br>
		<div style='margin-left:50px; margin-right:50px;  text-align: justify; font-size:14px'>
            &emsp;&emsp;EN LA CIUDAD DE <span style='font-weight:bold'><? echo trim(strtoupper($rec_almacen["municipio"]));?></span>, VERACRUZ, SIENDO LAS _____ HORAS, DEL DIA ______  DEL MES
            DE ______________________ DEL AÑO 2023, SE REUNIERON EN EL ALMACÉN DE LIBROS DE TEXTO, UBICADO
            EN LA CALLE <span style='font-weight:bold'><? echo strtoupper($rec_almacen["direccion"]); ?></span> 
            DEL MUNICIPIO DE <span style='font-weight:bold'><? echo trim(strtoupper($rec_almacen["municipio"])); ?></span>, CÓDIGO POSTAL <span style='font-weight:bold'><? echo $rec_almacen["cp"]; ?></span>, EL C. <span style='font-weight:bold'><?echo trim(strtoupper($rec_almacen["responsable"]));?></span>,
            RESPONSABLE DEL ALMACEN DE LIBROS DE TEXTO GRATUITOS Y EL C.PROF. ______________________________________ SUPERVISOR ESCOLAR DE LA ZONA <span style='font-weight:bold'><? echo strtoupper($rec_zona_alumno["zonaescola"]); ?></span>
            <? if($rec_zona_alumno["sector"]!="0"){ ?> DEL SECTOR <span style='font-weight:bold'><? echo strtoupper($rec_zona_alumno["sector"]); ?></span> <?} ?>
            DE EDUCACIÓN <span style='font-weight:bold'><? echo strtoupper($elnivel); ?></span> QUIENES SE IDENTIFICAN CON CREDENCIAL DE ELECTOR
            NÚMERO <? if($rec_almacen["numine"]!=""){ echo "<span style='font-weight:bold'>&emsp;".$rec_almacen["numine"]."&emsp;</span>"; }else{ ?>_______________________ <? } ?> Y _____________________ RESPECTIVAMENTE.
            <br><br>
            1.- EL RESPONSABLE DEL ALMACÉN ENTREGA AL C. PROF. _________________________________________ LOS LIBROS DE TEXTO GRATUITOS CORRESPONDIENTES A LA 
            ASIGNACIÓN INICIAL PARA EL CICLO ESCOLAR <span style='font-weight:bold'><? echo $_SESSION["vg_cicloescolar"] ?></span>, DE <span style='font-weight:bold'><? echo strtoupper($rec_zona_alumno["escuelas"]); ?></span> ESCUELAS QUE 
            PERTENECEN A LA SUPERVISIÓN ESCOLAR, CONFORME A LOS RECIBOS CON FOLIO <span style='font-weight:bold'>LTG <? echo $rec_zona_alumno["folio"]; ?></span>.
            <br><br>
            2.- LA ENTREGA SE EFECTUA CONSIDERANDO LA ASIGNACIÓN POR GRADO Y PLANTEL ESCOLAR: <br>
                <table width="400" style="margin:10px; font-size:14px">
                    <?  
                        if ($_SESSION["elidnivel"]>70){ 
                            $val1=($rec_zona_alumno["alu1"]*$numlibrosalumno1)+($rec_zona_alumno["escuelas"]*$numlibrosmaestro1);
                            $val2=($rec_zona_alumno["alu2"]*$numlibrosalumno2);
                            $val3=($rec_zona_alumno["alu3"]*$numlibrosalumno3);
                            for ($l=1; $l <= 2; $l++) {
                                if ($l==1){$dest="A";}else{$dest="M";}    
                                $_sql="select a.idgrado,sum(a.matricula) as matricula FROM ctsev_telesecundarias_ingles a,l_libros b WHERE a.clave=b.idmaterial and a.estatus='A' and b.estatus='A' and a.cct_zona='".$_SESSION["cct_zona"]."' and a.idnivel=".$_SESSION["elidnivel"]." and b.idnivel=7 and a.destino regexp '".$dest."' and a.ciclo='".$_SESSION["vg_cicloescolar"]."' group by a.idgrado"; 	// echo $_sql; 
                                $res_teles=mysql_query($_sql);    $r=0;
                                while ($r<mysql_num_rows($res_teles)){ 		$recteles=mysql_fetch_array($res_teles,MYSQL_ASSOC); 
                                    switch($recteles["idgrado"]){case 1: $val1=$val1+$recteles["matricula"]; break;         case 2: $val2=$val2+$recteles["matricula"]; break;         case 3: $val3=$val3+$recteles["matricula"]; break;}
                                    $r++;
                                }        
                            }        
                        }else{
                            if ($_SESSION["elidnivel"]==40 || $_SESSION["elidnivel"]==41 || $_SESSION["elidnivel"]==42){
//                                $val1=(($rec_zona_alumno["alu1"]*$numlibrosalumno1)+($rec_zona_alumno["escuelas"]*$numlibrosmaestro1))+$rec_zona_alumno["escuelas"]; // CORRECTO
  //                              $val3=(($rec_zona_alumno["alu3"]*$numlibrosalumno3)+($rec_zona_alumno["escuelas"]*$numlibrosmaestro3))+$rec_zona_alumno["escuelas"]; // CORRECTO

                                $val1=(($rec_zona_alumno["alu1"]*$numlibrosalumno1)+($rec_zona_alumno["escuelas"]*5))+$rec_zona_alumno["escuelas"]; // CORRECTO
                                $val2=($rec_zona_alumno["alu2"]*$numlibrosalumno2)+($rec_zona_alumno["escuelas"]*5);
                                $val3=(($rec_zona_alumno["alu3"]*$numlibrosalumno3)+($rec_zona_alumno["escuelas"]*5))+$rec_zona_alumno["escuelas"]; // CORRECTO

                                $val4=(($rec_zona_alumno["alu4"]*$numlibrosalumno4)+($rec_zona_alumno["escuelas"]*5))+$rec_zona_alumno["escuelas"];
                                $val5=(($rec_zona_alumno["alu5"]*$numlibrosalumno5)+($rec_zona_alumno["escuelas"]*5))+$rec_zona_alumno["escuelas"];
                                $val6=($rec_zona_alumno["alu6"]*$numlibrosalumno6)+($rec_zona_alumno["escuelas"]*5);
        

                               // echo "Suma de segundo ".$rec_zona_alumno["alu2"]."<br>";
                               // echo "libros alumnos segundo ".$numlibrosalumno2."<br>";
                               // echo "libros maestros segundo ".$numlibrosmaestro2."<br>";
                               // echo "Escuelas ".$rec_zona_alumno["escuelas"]."<br>";
                            }else{
                                $val1=($rec_zona_alumno["alu1"]*$numlibrosalumno1); 
                                $val2=($rec_zona_alumno["alu2"]*$numlibrosalumno2);   
                                $val3=($rec_zona_alumno["alu3"]*$numlibrosalumno3);
                            }
                           
                        }    
                    ?>
                    <tr><td width="100"></td><td><li> PRIMER GRADO</li></td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($val1,0); ?></span></td><td>&emsp;LIBROS</td></tr>
                    <tr><td width="100"></td><td><li> SEGUNDO GRADO</td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($val2,0); ?></span></td><td>&emsp;LIBROS</td></tr>
                    <tr><td width="100"></td><td><li> TERCER GRADO</td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($val3,0); ?></span></td><td>&emsp;LIBROS</td></tr>
                    <? if ($_SESSION["elidnivel"]==40 || $_SESSION["elidnivel"]==41 || $_SESSION["elidnivel"]==42){  ?>
                        <tr><td width="100"></td><td><li> CUARTO GRADO</li></td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($val4,0); ?></span></td><td>&emsp;LIBROS</td></tr>
                        <tr><td width="100"></td><td><li> QUINTO GRADO</td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($val5,0); ?></span></td><td>&emsp;LIBROS</td></tr>
                        <tr><td width="100"></td><td><li> SEXTO GRADO</td><td style="text-align:right"><span style='font-weight:bold'><? echo number_format($val6,0); ?></span></td><td>&emsp;LIBROS</td></tr>
                    <? } ?>
                </table>
            3.- EL SUPERVISOR ESCOLAR RECIBE LAS CANTIDADES DE LIBROS DE TEXTO GRATUITOS, PROCEDIENDO A LA FIRMA Y SELLO DEL RECIBO RESPECTIVO, EN EL 
            CASO DE EXISTIR ALGÚN FALTANTE. DEBERÁ QUEDAR REGISTRADO EN FORMA LEGIBLE EN EL RECIBO CORRESPONDIENTE.
            <br><br>
            LA PRESENTE ACTA DE ENTREGA-RECEPCIÓN NO IMPLICA LA LIBERACIÓN DE RESPONSABILIDADES POR PARTE DE LOS SERVIDORES PÚBLICOS QUE INTERVIENEN EN 
            LA MISMA, ATENDIENDO A SU ÁMBITO DE COMPETENCIA Y TEMPORALIDAD.
            <br><br>
            PREVIA LECTURA DEL PRESENTE INSTRUMENTO Y NO HABIENDO MÁS QUE HACER CONSTAR, SE DA POR CONCLUIDA LA PRESENTE ACTA, SIENDO LAS _________
            HORAS, DEL DÍA _______________________________, FIRMANDO EN DOS EJEMPLARES, AL CALCE LOS QUE EN ELLA INTERVINIERON.
            <br><br><br>
         <?

//---------------------------------------------------------------------------------------------------------------------------------------------- ?>

					<!--      Firmas     -->
                    <? $firma_entrega="DEL ALMACÉN";     $firma_recibe="DEL SUPERVISOR";     
                       $sello_entrega="ALMACEN";         $sello_recibe="SUPERVISIÓN"; 
                       $entrego=$rec_almacen["responsable"];  ?>
					<table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px"><tr><td width="30%"><br><span style="font-weight:bold">LUGAR</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">ENTREG&Oacute;</span><br><br><? echo $entrego; ?><br>	                                                                                  ____________________________________<br>	                                                                                  <small>NOMBRE Y FIRMA <? echo $firma_entrega; ?></small> <br>                                                            </td>                            <td style="vertical-align:middle;" width="18%" >SELLO<br><? echo $sello_entrega; ?></td>                             <td width="30%"><br><span style="font-weight:bold">FECHA</span><br><br>________________________________<br><br><br>                                                                                <span style="font-weight:bold">RECIBIÓ</span><br><br><br>                                                                                ___________________________________<br>	                                                                                    <small>NOMBRE Y FIRMA <? echo $firma_recibe; ?></small><br>                                                            </td>                                                                                        <td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                </tr>                    </table>
                    



		</div><?php
