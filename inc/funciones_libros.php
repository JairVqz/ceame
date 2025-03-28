<?php	
function flista_niveles_x_almacen($pmalmacen,$nivel_sinpermiso="",$liga1="",$liga2="",$liga3=""){    
    //INGRESAN almacenes
    $tot=0;     $colinks=""; 
    
    // LA COLUMNA BAN SE USO PARA SABER QUE NIVELES TENIAN SECTORES
    $_sql="select distinct id".$pmalmacen.",".$pmalmacen.",idnivel,nivel,SUM(if(cct_sector!='',1,0)) AS ban,COUNT(distinct cct_sector) AS sectores,COUNT(distinct cct_zona) AS zonas FROM ctsev WHERE id".$pmalmacen."='".$_SESSION["vg_idalmacen"]."'".$condpermiso." and estatus='A' GROUP BY id".$pmalmacen.",idnivel";                            
    //echo "flista_niveles_x_almacen<br>".$_sql;
    $res=mysql_query($_sql);    $vl_regs=mysql_num_rows($res);       			
    if ($vl_regs>0){ ?>		
        <table class="ftable-all"><tr>
            <th>Nivel</th><th>Sectores</th> <th></th><th>Zonas</th><th></th><? $r=0;    $totcol1=0;    $totcol2=0;
            while ($r<$vl_regs){
                $link1="";  $link2="";
                $recset=mysql_fetch_array($res,MYSQL_ASSOC); 
                if (!fencuentra($recset["idnivel"],$nivel_sinpermiso)){
                        if ($recset["idnivel"]>69){ $color="#FEECEC";}else{if ($recset["idnivel"]>59){ $color="#FFFCE1"; }else{if ($recset["idnivel"]>39){  $color="#ECF4FF"; }else{$color="#F5FFE1"; }        }         }
                        
                        $parametros="arr_nivel=".$recset["idnivel"]."|".$recset["nivel"]."&pmsectores=".$recset["sectores"]."&pmzonas=".$recset["zonas"];
                        if ($recset["ban"]>0){  
                            $valcol1=$recset["sectores"];                        $totcol1=$totcol1+$recset["sectores"]; 
                            $link1=$liga1.$parametros."&sel=Sectores";
                            $texto="Seleccionar";
                            $valcol2="";
                        }else{
                            $valcol1="";
                            $valcol2=$recset["zonas"];                        $totcol2=$totcol2+$recset["zonas"];  
                            $link2=$liga1.$parametros."&sel=Zonas";
                        }
                        $texto="Zonas escolares";
                        ?>
                        <tr style="background:<? echo $color; ?>">
                            <td><? echo $recset["nivel"]; ?></td>
                            <td class='fcenter'><? echo $valcol1; ?></td>
                            <td class='fcenter'>
                                <? if ($recset["ban"]>0){  ?>
                                    <a class='fbutton fwhite fmargin-left fmargin-right' href='<? echo $link1; ?>'><small>Seleccionar</small></a>
                                <? } ?>    
                            </td>    
                            <td class='fcenter'><? echo $valcol2; ?></td>
                            <td class='fcenter'>
                                <? if ($recset["ban"]==0){  ?>
                                    <a class='fbutton fwhite fmargin-left fmargin-right' href='<? echo $link2; ?>'><small>Seleccionar</small></a>
                                <? } ?>    
                            </td>    
                        </tr><?
                }                          
                $r++;
            }	
            // talta lo de abajo de esta funcion	
            if ($vl_regs>1){
                echo "<tr><td align='center' class='negra_14'>Totales</td>
                <td class='fright-align'>".$totcol1."</td><td></td><td class='fright-align'>".$totcol2."</td><td></td></tr>";														  
            }?>
        </table> <?
        // Desarrollado por : L.I. Fernando Rodríguez Colorado 	wwww.sistemas-rc.com
    }    

}

function flista_niveles_x_sector($nivel_sinpermiso="",$liga1="",$liga2="",$liga3=""){    
    $totcol1=0;    $colinks="";
    if ($nivel_sinpermiso!=""){ // arreglo de niveles sin permiso
        $arrnopermiso=explode("|",$nivel_sinpermiso);
        $cad1=""; $cad2=""; foreach ($arrnopermiso as $valor) {if ($valor<10){ $cad1=$cad1.$valor.","; }else{ $cad2=$cad2.$valor."|"; } } 
        $cad1=substr($cad1,0,strlen($cad1)-1); if ($cad2!=""){$cad2=substr($cad2,0,strlen($cad2)-1);  $x=" and idnivel not regexp '".$cad2."'";  }  
        $condpermiso=" and SUBSTR(idnivel,1,1) not in (".$cad1.")".$x;  
    }else{ $condpermiso=""; }            
    // Los Sectores solo pueden ver PREESCOLAR !!!!
    $_sql="select distinct idnivel,nivel,COUNT(distinct cct_zona) AS zonas,COUNT(distinct concat(cct,turno)) AS escuelas FROM ctsev WHERE  idnivel<70 and cct_sector='".$_SESSION["vg_cct_sector"]."'".$condpermiso." and idnivel<39 and estatus='A' GROUP BY idnivel";                            
    //echo "flista_niveles_x_sector<br>".$_sql;
    $res=mysql_query($_sql);    $vl_regs=mysql_num_rows($res);       				
    if ($vl_regs>0){ ?>		
        <table class="ftable-all"><tr>
            <th>Nivel</th><th>Zonas</th><? 
                        if($liga1!=""){ $arr_liga1=explode("|",$liga1); echo "<th>".$arr_liga1[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga2!=""){ $arr_liga2=explode("|",$liga2); echo "<th>".$arr_liga2[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga3!=""){ $arr_liga3=explode("|",$liga3); echo "<th>".$arr_liga3[2]."</th>";} // titulo del boton|liga|titulo de la columna 
            $r=0;
            while ($r<$vl_regs){
                $recset=mysql_fetch_array($res,MYSQL_ASSOC); 
                if ($recset["idnivel"]>69){ $color="#FEECEC";}else{if ($recset["idnivel"]>59){ $color="#FFFCE1"; }else{if ($recset["idnivel"]>39){  $color="#ECF4FF"; }else{$color="#F5FFE1"; }        }         }
                $parametros="arr_nivel=".$recset["idnivel"]."|".$recset["nivel"]."&pmsectores=".$recset["sectores"]."&pmzonas=".$recset["zonas"];
                    $liga1=$liga1.$parametros."&sel=Sector";
                    $liga2=$liga1.$parametros."&sel=Zonas";
                
                $texto="Zonas escolares";
                $totcol1=$totcol1+$recset["zonas"];
                 ?>
                <tr style="background:<? echo $color; ?>">
                    <td><? echo $recset["nivel"]; ?></td>
                    <td style="text-align:right"><? echo $recset["zonas"]; ?></td><?
                     if($liga1!=""){ $colinks=$colinks="<td></td>";  echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga1[3]."; color:black' href='".$arr_liga1[1].$parametros."'><small>".$arr_liga1[0]."</small></a></td>"; }
                     if($liga2!=""){ $colinks=$colinks="<td></td>";    echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga2[3]."; color:black' href='".$arr_liga2[1].$parametros."'><small>".$arr_liga2[0]."</small></a></td>"; }
                     if($liga3!=""){ $colinks=$colinks="<td></td>";    echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga3[3]."; color:black' href='".$arr_liga3[1].$parametros."'><small>".$arr_liga3[0]."</small></a></td>"; }    ?>
                </tr><?                          
                $r++;
            }	
            if ($vl_regs>1){
                echo "<tr><td align='center' class='negra_14' colspan='".$colspan."'>Total</td>
                <td class='fright-align'>".$totcol1."</td>".$colinks."</tr>";														  
            }?>
        </table> <?
    }    

}

function flista_niveles_x_zona($nivel_sinpermiso="",$liga1="",$liga2="",$liga3="",$liga4="",$liga5=""){    
    $totcol1=0; $colinks="";
    if ($nivel_sinpermiso!=""){ // arreglo de niveles sin permiso
         $arrnopermiso=explode("|",$nivel_sinpermiso);
         $cad1=""; $cad2=""; foreach ($arrnopermiso as $valor) {if ($valor<10){ $cad1=$cad1.$valor.","; }else{ $cad2=$cad2.$valor."|"; } } 
         $cad1=substr($cad1,0,strlen($cad1)-1); if ($cad2!=""){$cad2=substr($cad2,0,strlen($cad2)-1);  $x=" and idnivel not regexp '".$cad2."'";  }  
         $condpermiso=" and SUBSTR(idnivel,1,1) not in (".$cad1.")".$x;  
     }else{ $condpermiso=""; }            
    
    $_sql="select distinct idnivel,nivel,COUNT(distinct concat(cct,turno)) AS escuelas FROM ctsev WHERE cct_zona='".$_SESSION["vg_cct_zona"]."'".$condpermiso." and estatus='A' GROUP BY idnivel";                            
    //echo "flista_niveles_x_zona<br>".$_sql;
    $res=mysql_query($_sql);    $vl_regs=mysql_num_rows($res);        				
    if ($vl_regs>0){ ?>		
        <table class="ftable-all"><tr>
                    <!-- <th>Nivel</th><th>Escuelas</th> -->
                    <th>Nivel</th>
                <? 
                        if($liga1!=""){ $arr_liga1=explode("|",$liga1); echo "<th>".$arr_liga1[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga2!=""){ $arr_liga2=explode("|",$liga2); echo "<th>".$arr_liga2[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga3!=""){ $arr_liga3=explode("|",$liga3); echo "<th>".$arr_liga3[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga4!=""){ $arr_liga4=explode("|",$liga4); echo "<th>".$arr_liga4[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga5!=""){ $arr_liga5=explode("|",$liga5); echo "<th>".$arr_liga5[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
            $r=0;
            while ($r<$vl_regs){
                $recset=mysql_fetch_array($res,MYSQL_ASSOC); 
                if ($recset["idnivel"]>69){ $color="#FEECEC";}else{if ($recset["idnivel"]>59){ $color="#FFFCE1"; }else{if ($recset["idnivel"]>39){  $color="#ECF4FF"; }else{$color="#F5FFE1"; }        }         }
                $parametros="arr_nivel=".$recset["idnivel"]."|".$recset["nivel"]."&pmescuelas=".$recset["escuelas"];
                    $liga1=$liga1.$parametros."&sel=Escuela";
                
                $texto="Zonas escolares";
                $totcol1=$totcol1+$recset["escuelas"];
                 ?>
                <tr style="background:<? echo $color; ?>">
                    <td><? echo $recset["nivel"]; ?></td>
                    <!--             <td style='text-align:right'>           --><? // echo $recset["escuelas"]; ?>    <!--   </td>  --><? 
                    if($liga1!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga1[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga1[3]."; color:black' href='".$arr_liga1[1].$parametros."'><small>".$arr_liga1[0]."</small></a>"; } ?> </td><? }
                    if($liga2!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga2[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga2[3]."; color:black' href='".$arr_liga2[1].$parametros."'><small>".$arr_liga2[0]."</small></a>"; } ?> </td><? }
                    if($liga3!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga3[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga3[3]."; color:black' href='".$arr_liga3[1].$parametros."'><small>".$arr_liga3[0]."</small></a>"; } ?> </td><? }
                    if($liga4!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga4[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga4[3]."; color:black' href='".$arr_liga4[1].$parametros."'><small>".$arr_liga4[0]."</small></a>"; } ?> </td><? }
                    if($liga5!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga5[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga5[3]."; color:black' href='".$arr_liga5[1].$parametros."'><small>".$arr_liga5[0]."</small></a>"; } ?> </td><? } ?>
                </tr><?                          
                $r++;
            }	
            if ($vl_regs>1){
                echo "<tr><td align='center' class='negra_14' colspan='".$colspan."'>Total</td>
                <td class='fright-align'>".$totcol1."</td>".$colinks."</tr>";														  
            }?>
        </table> <?
    }    

}

function flista_SECTORES_x_almacen_nivel($pmidnivel,$nivel_sinpermiso="",$condicion_particular="",$liga1="",$liga2="",$liga3=""){ 
    // Solo usada por ALMACEN
    if ($condicion_particular!=""){ $condicion_particular="and ".$condicion_particular; }
    $totcol1=0;         $colinks="";
    
    $_sql="select distinct a.cct_sector,a.sector,b.nombre,a.idnivel,a.nivel,COUNT(distinct a.cct_zona) as zonas,b.fer_idniveles,b.folio from ctsev a,sector_c b where a.cct_sector=b.cuenta and a.idnivel='".$pmidnivel."' ".$condicion_particular." and a.cct_sector!='' and a.estatus='A' group by a.cct_sector order by a.cct_sector";
    echo "<br><br><br><br>";  
    //echo "flista_SECTORES_x_almacen_nivel<br>".$_sql."<br>";
    mysql_query("SET SQL_BIG_SELECTS=1");
    $res=mysql_query($_sql);        $vl_regs=mysql_num_rows($res);      				
    if ($vl_regs>0){
        if ($vl_regs>30){ ?><div class="fix5"> <? } ?>
            <table class="ftable-all"> 
                <tr><th></th><th>Sector</th><th>cct_sector</th><th>Nombre</th><th>Zonas</th> <? 
                
                        if($liga1!=""){ $colinks=$colinks."<td></td>"; $arr_liga1=explode("|",$liga1); echo "<th>".$arr_liga1[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga2!=""){ $colinks=$colinks."<td></td>"; $arr_liga2=explode("|",$liga2); echo "<th>".$arr_liga2[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga3!=""){ $colinks=$colinks."<td></td>"; $arr_liga3=explode("|",$liga3); echo "<th>".$arr_liga3[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga4!=""){ $colinks=$colinks."<td></td>"; $arr_liga4=explode("|",$liga4); echo "<th>".$arr_liga4[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        ?>
                </tr>  <?                 $r=0;
                while ($r<$vl_regs){
                    $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                    $parametros="cct_sector=".$recset["cct_sector"]."&idnivel=".$pmidnivel."&nivel=".$recset["nivel"]."&arr_nivel=".$pmidnivel."|".$recset["nivel"]."&nombre=".$recset["nombre"]."&folio=".$recset["folio"]; ?>
                    <tr><?
                        echo "<td><small>".($r+1)."</small></td>
                        <td class='fcenter'>".$recset["sector"]."</td>
                        <td>".$recset["cct_sector"]."</td>
                        <td><small>".$recset["nombre"]."</small></td>
                        <td class='fcenter'>".$recset["zonas"]."</td>";
                        $totcol1=$totcol1+$recset["zonas"];
                        if($liga1!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga1[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga1[3]."; color:black' href='".$arr_liga1[1].$parametros."'><small>".$arr_liga1[0]."</small></a>"; } ?> </td><? }
                        if($liga2!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga2[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga2[3]."; color:black' href='".$arr_liga2[1].$parametros."'><small>".$arr_liga2[0]."</small></a>"; } ?> </td><? }
                        if($liga3!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga3[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga3[3]."; color:black' href='".$arr_liga3[1].$parametros."'><small>".$arr_liga3[0]."</small></a>"; } ?> </td><? }
                        if($liga4!=""){ ?>  <td class='fcenter'><? if (!fencuentra($recset["idnivel"],$arr_liga4[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga4[3]."; color:black' href='".$arr_liga4[1].$parametros."'><small>".$arr_liga4[0]."</small></a>"; } ?> </td>
                    </tr><? } 
                    // $totescuelas=$totescuelas+$recset["escuelas"]; 
                    $r++;
                }
                if ($vl_regs>1){
                    echo "<tr><td align='center' class='negra_14' colspan='4'>Total</td>
                    <td class='fright-align'>".$totcol1."</td>".$colinks."</tr>";														  
                }?>
            </table> <?
        if ($vl_regs>30){ ?></div> <? } 
    }
    return $vl_regs;
}


function flista_ZONAS_x_almacen_nivel($pmidnivel,$condicion_particular="",$liga1="",$liga2="",$liga3="",$liga4="",$liga5=""){ // pendiente
    // Solo usada por ALMACEN 
    if ($condicion_particular!=""){ $condicion_particular="and ".$condicion_particular; }
    $totcol1=0; $colinks="";
    $_sql="select distinct a.cct_zona,a.zonaescola,b.nombre,b.fer_idniveles,count(a.cct) as escuelas,a.nivel from ctsev a,supervis_c b where a.cct_zona=b.cuenta and a.idnivel='".$pmidnivel."' ".$condicion_particular." and a.estatus='A' group by a.cct_zona order by a.cct_zona";
    echo "<br><br><br><br>";
     //  echo "<br><br><br><br><br>flista_ZONAS_x_almacen_nivel<br>".$_sql."<br>";
    //mysql_query("SET SQL_BIG_SELECTS=1");
    $res=mysql_query($_sql);    $vl_regs=mysql_num_rows($res);
    if ($vl_regs>0){
        if ($vl_regs>17){ ?><div class="fix5"> <? } ?>
            <table class="ftable-all"> 
                <tr><th></th><th>Zona</th><th>cct_zona</th><th>Nombre</th><th>Escuelas</th> <? 
                        if($liga1!=""){ $arr_liga1=explode("|",$liga1); echo "<th>".$arr_liga1[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga2!=""){ $arr_liga2=explode("|",$liga2); echo "<th>".$arr_liga2[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga3!=""){ $arr_liga3=explode("|",$liga3); echo "<th>".$arr_liga3[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga4!=""){ $arr_liga4=explode("|",$liga4); echo "<th>".$arr_liga4[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION 
                        if($liga5!=""){ $arr_liga5=explode("|",$liga5); echo "<th>".$arr_liga5[2]."</th>"; $colinks=$colinks."<td></td>";} // titulo del boton|liga|titulo de la columna|color|RESTRICCION ?>
                </tr>  <?                $r=0;
                while ($r<$vl_regs){
                    $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                    $parametros="cct_zona=".$recset["cct_zona"]."&idnivel=".$pmidnivel."&nivel=".$recset["nivel"]."&arrniveles=".$recset["fer_idniveles"]."&nombre=".$recset["nombre"];
                    echo "<tr><td><small>".($r+1)."</small></td>
                    <td class='fcenter'>".$recset["zonaescola"]."</td>
                    <td>".$recset["cct_zona"]."</td>
                    <td><small>".$recset["nombre"]."</small></td>
                    <td class='fcenter'>".$recset["escuelas"]."</td>";
                    $totcol1=$totcol1+$recset["escuelas"];

                    if($liga1!=""){ ?>  <td class='fcenter'><? if (!fencuentra($pmidnivel,$arr_liga1[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga1[3]."; color:black' href='".$arr_liga1[1].$parametros."'><small>".$arr_liga1[0]."</small></a>"; } ?> </td><? }
                    if($liga2!=""){ ?>  <td class='fcenter'><? if (!fencuentra($pmidnivel,$arr_liga2[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga2[3]."; color:black' href='".$arr_liga2[1].$parametros."'><small>".$arr_liga2[0]."</small></a>"; } ?> </td><? }
                    if($liga3!=""){ ?>  <td class='fcenter'><? if (!fencuentra($pmidnivel,$arr_liga3[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga3[3]."; color:black' href='".$arr_liga3[1].$parametros."'><small>".$arr_liga3[0]."</small></a>"; } ?> </td><? }
                    if($liga4!=""){ ?>  <td class='fcenter'><? if (!fencuentra($pmidnivel,$arr_liga4[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga4[3]."; color:black' href='".$arr_liga4[1].$parametros."'><small>".$arr_liga4[0]."</small></a>"; } ?> </td><? } 
                    if($liga5!=""){ ?>  <td class='fcenter'><? if (!fencuentra($pmidnivel,$arr_liga5[4])){ echo "<a class='fbutton' style='background-color:".$arr_liga5[3]."; color:black' href='".$arr_liga5[1].$parametros."'><small>".$arr_liga5[0]."</small></a>"; } ?> </td><? } 
                    $r++;
                }
                if ($vl_regs>1){
                    echo "<tr><td align='center' class='negra_14' colspan='4'>Total</td>
                    <td class='fright-align'>".$totcol1."</td>".$colinks."</tr>";													  
                }?>
            </table> <?
        if ($vl_regs>30){ ?></div> <? } 
    }
    return $vl_regs;
}


function flista_ZONAS_x_sector_nivel($pmcct_sector,$pmidnivel,$condicion_particular="",$liga1="",$liga2="",$liga3=""){ // pendiente
    // Solo usada por Almacen y Sector 
    if ($condicion_particular!=""){ $condicion_particular="and ".$condicion_particular; }
    $totescuelas=0;
    // if ($_SESSION["vg_tipousuario"]=="Almacen"){ 
    //     if ($pmidnivel<39){
    //         $alma="almarec";
    //     }else{
    //         $alma="almadis";
    //     } 
    //     $condalmacen=" and a.id".$alma."=".$_SESSION["vg_idalmacen"];
    // }else{
    //     $condalmacen="";
    // }
    $condalmacen="";
    $_sql="select distinct a.cct_zona,a.zonaescola,b.nombre,b.fer_idniveles,count(a.cct) as escuelas,a.nivel from ctsev a,supervis_c b where a.cct_zona=b.cuenta and a.cct_sector='".$pmcct_sector."'".$condalmacen." and a.idnivel='".$pmidnivel."' ".$condicion_particular." and a.estatus='A' group by a.cct_zona order by a.cct_zona";
    echo "<br><br><br><br>";
    //echo "flista_ZONAS_x_sector_nivel<br>".$_sql."<br>";
    $res=mysql_query($_sql);    $vl_regs=mysql_num_rows($res);
    if ($vl_regs>0){
        if ($vl_regs>17){ ?><div class="fix5"> <? } ?>
            <table class="ftable-all"> 
                <tr><th></th><th>Zona</th><th>cct_zona</th><th>Nombre</th><th>Escuelas</th> <? 
                        if($liga1!=""){ $arr_liga1=explode("|",$liga1); echo "<th>".$arr_liga1[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga2!=""){ $arr_liga2=explode("|",$liga2); echo "<th>".$arr_liga2[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga3!=""){ $arr_liga3=explode("|",$liga3); echo "<th>".$arr_liga3[2]."</th>";} // titulo del boton|liga|titulo de la columna ?>
                </tr>  <?                $r=0;
                while ($r<$vl_regs){
                    $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                    $parametros="cct_zona=".$recset["cct_zona"]."&idnivel=".$pmidnivel."&nivel=".$recset["nivel"]."&arrniveles=".$recset["fer_idniveles"]."&nombre=".$recset["nombre"]."&sel=reciboalumnos";
                    echo "<tr><td><small>".($r+1)."</small></td>
                    <td class='fcenter'>".$recset["zonaescola"]."</td>
                    <td>".$recset["cct_zona"]."</td>
                    <td><small>".$recset["nombre"]."</small></td>
                    <td class='fcenter'>".$recset["escuelas"]."</td>";
                    if($liga1!=""){ echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga1[3]."; color:black' href='".$arr_liga1[1].$parametros."'><small>".$arr_liga1[0]."</small></a></td>"; }
                    if($liga2!=""){ echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga2[3]."; color:black' href='".$arr_liga2[1].$parametros."'><small>".$arr_liga2[0]."</small></a></td>"; }
                    if($liga3!=""){ echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga3[3]."; color:black' href='".$arr_liga3[1].$parametros."'><small>".$arr_liga3[0]."</small></a></td>"; }    
                    // $totescuelas=$totescuelas+$recset["escuelas"]; 
                    $r++;
                }
                if ($vl_regsAAAAAAAA>1){
                    echo "<tr><td align='center' class='negra_14' colspan='4'>Total</td>
                    <td class='fright-align'>".$totescuelas."</td></tr>";														  
                }?>
            </table> <?
        if ($vl_regs>30){ ?></div> <? } 
    }
    return $vl_regs;
}

function flista_Escuelas_x_zona_nivel($pmcct_zona,$pmidnivel,$condicion_particular="",$liga1="",$liga2="",$liga3=""){ // pendiente
    // usada por Almacen  Sector  y Zona
    if ($condicion_particular!=""){ $condicion_particular="and ".$condicion_particular; }
    $totescuelas=0;
    $_sql="select distinct cct,turno,nom_ct,nivel from ctsev where cct_zona='".$pmcct_zona."' and idnivel='".$pmidnivel."' ".$condicion_particular." and estatus='A' order by cct,turno";
    // echo "flista_Escuelas_x_zona_nivel<br>".$_sql."<br>";
    $res=mysql_query($_sql);    $vl_regs=mysql_num_rows($res);
    if ($vl_regs>0){
        if ($vl_regs>17){ ?><div class="fix5"> <? } ?>
            <table class="ftable-all"> 
                <tr><th></th><th>cct</th><th>Nombre</th> <? 
                        if($liga1!=""){ $arr_liga1=explode("|",$liga1); echo "<th>".$arr_liga1[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga2!=""){ $arr_liga2=explode("|",$liga2); echo "<th>".$arr_liga2[2]."</th>";} // titulo del boton|liga|titulo de la columna 
                        if($liga3!=""){ $arr_liga3=explode("|",$liga3); echo "<th>".$arr_liga3[2]."</th>";} // titulo del boton|liga|titulo de la columna ?>
                </tr>  <?                $r=0;
                while ($r<$vl_regs){
                    $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                    $parametros="cct=".$recset["cct"]."&turno=".$recset["turno"]."&idnivel=".$pmidnivel."&nivel=".$recset["nivel"]."&escuela=".$recset["nom_ct"];
                    echo "<tr><td><small>".($r+1)."</small></td>
                    <td class='fcenter'>".$recset["cct"]."-".$recset["turno"]."</td>
                    <td><small>".$recset["nom_ct"]."</small></td>";
                    
                    if($liga1!=""){ echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga1[3]."; color:black' href='".$arr_liga1[1].$parametros."&devescuela'><small>".$arr_liga1[0]."</small></a></td>"; }
                    if($liga2!=""){ echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga2[3]."; color:black' href='".$arr_liga2[1].$parametros."&devescuela'><small>".$arr_liga2[0]."</small></a></td>"; }
                    if($liga3!=""){ echo "<td class='fcenter'><a class='fbutton' style='background-color:".$arr_liga3[3]."; color:black' href='".$arr_liga3[1].$parametros."&devescuela'><small>".$arr_liga3[0]."</small></a></td>"; }    
                    // $totescuelas=$totescuelas+$recset["escuelas"]; 
                    $r++;
                }
                if ($vl_regsAAAAAAAA>1){
                    echo "<tr><td align='center' class='negra_14' colspan='4'>Total</td>
                    <td class='fright-align'>".$totescuelas."</td></tr>";														  
                }?>
            </table> <?
        if ($vl_regs>30){ ?></div> <? } 
    }
    return $vl_regs;
}

function fencuentra($buscar,$enestacadena){ // terminada
    if ($enestacadena!=""){
        $arr_cadena=explode(",",$enestacadena);                             // echo "CADENA PRINCIPAL ".$enestacadena."<br>";
        $cad1=""; $cad2=""; 
        foreach ($arr_cadena as $valor) {
            if ($valor<10){ 
                $cad1=$cad1.$valor."|"; 
            }else{ 
                $cad2=$cad2.$valor."|"; 
            } 
        }
        if ($cad1!=""){          // echo "Buscando nivel ".$buscar." en cadena 1 (".$cad1.")<br>";
            if (strpos(" ".$cad1,substr($buscar,0,1))){     // echo "Y SI ENCONTRO en cad1";
                return true;
            }    
            // $cad1=substr($cad1,0,strlen($cad1)-1); 
            // $resultado=$resultado." and SUBSTR(".$campo.",1,1) not in (".$cad1.")";
        }
        if ($cad2!=""){          //echo "Buscando nivel ".$buscar." en cadena 2 (".$cad2.")<br>";
            if (strpos(" ".$cad2,$buscar)){     //  echo "Y SI ENCONTRO en cad2";
                return true;
            }          
            // $cad2=substr($cad2,0,strlen($cad2)-1);  
            // $resultado=$resultado." and ".$campo." not regexp '".$cad2."'";  
        }
    }  
    return false; 
}    

//============================================================= YA NO SE DEBEN USAR 








?>