<?
        function GenerarQR($contenido,$dir_enviado){
            $dir=$dir_enviado;
            if(!file_exists($dir))
            mkdir($dir);
            $filename=$dir.$contenido.'.png';
            $tamanio=4;
            $level='M';
            $framesize=1;
            QRcode::png($contenido,$filename,$level,$tamanio,$framesize);
            echo "<img src='".$filename."'/>";
            
            }



            function PieRecibo($contenido,$direnviado){
                ?>
                <table class="table table-condensed" width="100%">
                <!--<tr><td colspan="4" class="small text-center">* Libro del Docente sujeto a disponibilidad</td></tr> -->
                <tr >	
                
                <th class="text-center"><?php echo GenerarQR($contenido,$direnviado); ?></th> <th class="text-center">FECHA DE ENTREGA<br><br><br>___________________________VER. A _______ DE___________2022</th>	                                                                            </tr>
                </tr></table>
                <table class="table table-condensed" width="100%">
                <td></td><td align="center">RECIBI&Oacute;</td><td align="center">&nbsp;</td><td align="center">ENTREG&Oacute;</td></tr>	   	<tr>
                <td></td><td align="center">&nbsp;</td><td align="center"> SELLO  </td> <td align="center">&nbsp;</td></tr> 
                <tr><td></td><td align="center">______________________________</td><td align="center">&nbsp;</td><td align="center">_________________________________</td></tr>
                <tr><td></td><td align="center"> NOMBRE Y FIRMA SUPERVISOR</td><td align="center">&nbsp;</td><td align="center"> NOMBRE Y FIRMA DIRECTOR</td></tr></table>
                <?php
                }   



                
function obten_movimientos($escuela,$aplicables="NO",$ciclo){ 
        if ($aplicables=="SI"){
            $movimientos=mysql_query("select sum(c1) as g1,sum(c2) as g2,sum(c3) as g3,sum(c4) as g4,sum(c5) as g5,sum(c6) as g6 from ctsev_mov_matricula where tipo in ('Alta de alumnos sin libros','Baja de alumnos') and concat(cct,turno)='".$escuela."' and ciclo='$ciclo'" );
        }else{
            $movimientos=mysql_query("select sum(c1) as g1,sum(c2) as g2,sum(c3) as g3,sum(c4) as g4,sum(c5) as g5,sum(c6) as g6 from ctsev_mov_matricula where tipo in ('Alta de alumnos sin libros','Alta de alumnos con libros','Baja de alumnos') and concat(cct,turno)='".$escuela."' and ciclo='$ciclo'");				
        }
        $recmov=mysql_fetch_array($movimientos,MYSQL_ASSOC);	
        $arr = array ($recmov["g1"],$recmov["g2"],$recmov["g3"],$recmov["g4"],$recmov["g5"],$recmov["g6"]);
        return $arr;
}

function tablaMaterialDiferenciaPreescoPrim($lallaveescuela,$ciclo,$idgrado,$matricula,$grupos,$nivelcontrol,$n){
    $totmatricula=0;	
    switch($idgrado){
        case 1:
            $gradoletra="Primer Grado";
            break;
        case 2:
            $gradoletra="Segundo Grado";
            break;
        case 3:
            $gradoletra="Tercer Grado";
            break;
        case 4:
            $gradoletra="Cuarto Grado";
            break;
        case 5:
            $gradoletra="Quinto Grado";
            break;
        case 6:
            $gradoletra="Sexto Grado";
            break;
        case 123:
            $gradoletra="";
            break;
        
    }	
    if($nivelcontrol=="PreescoPrim"){
        $sql="select idmaterial,titulo,destino,SUBSTRING(t2.idnivel,1,1) as nivel FROM material_c t1, ctsev t2 WHERE SUBSTRING(t2.idnivel,1,1)=t1.idnivel AND t1.destino in ('Alumno') AND t1.ciclo='$ciclo' AND concat(t2.cct,t2.turno)='$lallaveescuela' and (t1.idgrado='$idgrado')  and idtipomat='100'";
    }
    if($nivelcontrol=="Tele"){
        $sql="select idmaterial,titulo,destino,SUBSTRING(t2.idnivel,1,1) as nivel FROM material_c t1, ctsev t2 WHERE SUBSTRING(t2.idnivel,1,1)+1=t1.idnivel AND t1.destino in ('Alumno') AND t1.ciclo='$ciclo' AND concat(t2.cct,t2.turno)='$lallaveescuela' and t1.idgrado='$idgrado' AND t1.tipomateria_teles='_Basica'  and idtipomat='100'";
    }
    $rsql=mysql_query($sql)or die('no se puede ejecutar sql');
    
    ?>
    <b><?php echo $gradoletra; ?></b>
    <?php 
    if($n==3){
    ?>
    <table class="table table-condensed table-bordered" >
    <tr>
    <th>Clave</th>
    <th>Titulo</th>
    <!-- <th>Destino</th> -->
    <th>Matr&iacute;cula</th>
    <th>Concepto</th>
    </tr>
    <?php
    }if($n==4 || $n==7){
    ?>
    <table class="table table-bordered table-condensed" >	                    
    <tr><th  >Clave</th><th >Titulo</th><!--<th colspan="2">Asignaci&oacute;n</th> --><th>Matr&iacute;cula</th><th>Concepto</th>
    <!--<tr><th >Alumno</th><th>Docente</th><th></th><th></th> --></tr>
    <?php  
    }
    
    if($n==3){
        while($filsql=mysql_fetch_array($rsql)){   
            $idmaterial=$filsql['idmaterial'];
            $titulo=$filsql['titulo'];
            $destino=$filsql['destino'];
    ?>
    <tr>
    <td><?php echo $idmaterial ?></td>
    <td><?php echo $titulo ?></td>
    <!--  <td><?php echo $destino ?></td> -->
    <?php
        if($destino=="Alumno"){  
            $a=$matricula;    		
        }
        if($destino=="Maestro"){  
            $a=$grupos;  
            $multi=1;
        if($idmaterial=='K1J1S' || $idmaterial=='K1J2S' || $idmaterial=='K2J2S'  || $idmaterial=='K2J3S'  || $idmaterial=='K3J1S'  || $idmaterial=='K3J2S'){
            $multi=2;	
        }
        if($idgrado==1){								 
            $a=$grupos*$multi;
        }
        if($idgrado==2){
            $a=$grupos*$multi;
        }
        if($idgrado==3){
            $a=$grupos*$multi;
        }		
        if($idgrado==123){
            $a=$grupos*$multi;
        }
    }
    ?>
    <td><?php echo $a ?></td>
    <?php if($a>0){ 
        $concepto="Devoluci&oacute;n"; 
    }
    if($a==0){ 
        $concepto="No aplica"; 
    }
    if($a<0){ 
        $concepto="Por entregar al plantel"; 
    }
    ?>
    <td><?php echo $concepto; ?></td>
    
    </tr>
    <?php
    $totmatricula=$a+$totmatricula;
    }
    ?>
    
    </table>
    
    <?php
    }
    if($n==4 || $n==7){
    $totAsigAlum=0;
    $totAsigMaes=0;
    while($filsql=mysql_fetch_array($rsql)){
    $idmaterial=$filsql['idmaterial'];
    $titulo=$filsql['titulo'];
    $destino=$filsql['destino'];
    if ($destino=="Alumno"){  
    $asig_alu=$matricula;    
    $asig_doc=0;
    
    }
    if($destino=="Maestro"){  
    $asig_doc=$grupos;  
    $asig_alu=0;
    
    }	
    /* 			if($n==7){
    if($idgrado==1){
    $asig_doc=$grupos;
    }else{
    $asig_doc=0;
    }
    }
    if($n==4){
    if($idmaterial!='P3DMA' && $idmaterial!='P4DMA' && $idmaterial!='P5DMA' && $idmaterial!='P6DMA')
    {
    $asig_doc=$grupos;
    }
    }  */
    
    $totAsigAlum=$asig_alu+$totAsigAlum;
    $totAsigMaes=$asig_doc+$totAsigMaes; 
    ?>	
    <tr >
    <td><?php echo $idmaterial ?></td>
    <td><?php echo $titulo ?></td>
    <!-- <td align="right"><?php echo number_format($asig_alu,0); ?> </td>
    <td align="right"><?php echo number_format($asig_doc,0); ?> </td>    -->
    <?php $total=$asig_alu+$asig_doc;
    if($total>0){ 
        $concepto="Devoluci&oacute;n"; 
    }
    if($total==0)
    { 
        $concepto="No aplica"; 
        
    }
    if($total<0){ 
        $concepto="Por entregar al plantel"; 
    }
    ?>
    
    <td align="right"><?php echo $total; ?> </td> 
    <td align="right"><?php echo $concepto; ?> </td> 
    
    </tr>   
    <?php  	
    
    
    //$total_cajas=$cajas+$total_cajas;
    //$total_sueltos=$sueltos+$total_sueltos;
    }	?>	
    
    
    
    
    </table>	
    <?php
    }
    }
    function GenerarQR($contenido,$dir_enviado){
    $dir=$dir_enviado;
    if(!file_exists($dir))
    mkdir($dir);
    $filename=$dir.$contenido.'.png';
    $tamanio=4;
    $level='M';
    $framesize=1;
    QRcode::png($contenido,$filename,$level,$tamanio,$framesize);
    echo "<img src='".$filename."'/>";
    
    }
    function PieRecibo($contenido,$direnviado){
    ?>
    <table class="table table-condensed" width="100%">
    <!--<tr><td colspan="4" class="small text-center">* Libro del Docente sujeto a disponibilidad</td></tr> -->
    <tr >	
    
    <th class="text-center"><?php echo GenerarQR($contenido,$direnviado); ?></th> <th class="text-center">FECHA DE ENTREGA<br><br><br>___________________________VER. A _______ DE___________2022</th>	                                                                            </tr>
    </tr></table>
    <table class="table table-condensed" width="100%">
    <td></td><td align="center">RECIBI&Oacute;</td><td align="center">&nbsp;</td><td align="center">ENTREG&Oacute;</td></tr>	   	<tr>
    <td></td><td align="center">&nbsp;</td><td align="center"> SELLO  </td> <td align="center">&nbsp;</td></tr> 
    <tr><td></td><td align="center">______________________________</td><td align="center">&nbsp;</td><td align="center">_________________________________</td></tr>
    <tr><td></td><td align="center"> NOMBRE Y FIRMA SUPERVISOR</td><td align="center">&nbsp;</td><td align="center"> NOMBRE Y FIRMA DIRECTOR</td></tr></table>
    <?php
} 



















        // funcion para calcular las bajas
        /* function obtener_mov_cct($lallaveescuela,$grado,$ciclo,$aplica){
        if($aplica=="SI"){
        $sql="SELECT SUM($grado) as baja FROM ctsev_mov_matricula WHERE concat(cct,turno)='$lallaveescuela' AND tipo in ('Alta de alumnos sin libros','Baja de alumnos') and ciclo='$ciclo'";
        }
        if($aplica=="NO"){
        $sql="SELECT SUM($grado) as baja FROM ctsev_mov_matricula WHERE concat(cct,turno)='$lallaveescuela' AND tipo in ('Alta de alumnos sin libros','Alta de alumnos con libros','Baja de alumnos') and ciclo='$ciclo'";
        }
        $rsql=mysql_query($sql)or die('no se puede ejecutar sql');
        $filsql=mysql_fetch_array($rsql);
        $baja=$filsql['baja'];
        return ($baja);
        //return $sql;
        
        } */
        //

?>