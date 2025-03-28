<? 
    $totregistradas=0;
    if (isset($_GET["almacen_seleccionado"])){$bancond=" and idalmarbo='".$_GET["almacen_seleccionado"]."'";}else{$bancond="";}
    $_sql="select distinct cct,turno,nom_ct,nivel,day(fecha_matricula) as haymatricula from ctsev where cct_zona='".$lazona."' and idnivel='".$elidnivel."' and estatus='A' ".$bancond." order by haymatricula desc,cct,turno";
    // echo "flista_Escuelas_x_zona_nivel<br>".$_sql."<br>";
    $res=mysql_query($_sql);    $vl_regs=mysql_num_rows($res);
    if ($vl_regs>0){
        if ($vl_regs>17){ ?><div class="fix5"> <? } ?>
            <table class="ftable-all"> 
                <tr><th></th><th>cct</th><th>Nombre</th> <? 
                       $arr_liga1=explode("|",$liga1); echo "<th>".$arr_liga1[2]."</th>"; // titulo del boton|liga|titulo de la columna ?>
                </tr>  <?                $r=0;
                while ($r<$vl_regs){
                    $recset=mysql_fetch_array($res,MYSQL_ASSOC);
                    $parametros="cct=".$recset["cct"]."&turno=".$recset["turno"]."&idnivel=".$elidnivel."&nivel=".$recset["nivel"]."&escuela=".$recset["nom_ct"];
                    echo "<tr><td><small>".($r+1)."</small></td>
                    <td class='fcenter'>".$recset["cct"]."-".$recset["turno"]."</td>
                    <td><small>".$recset["nom_ct"]."</small></td>";
                    
                    echo "<td class='fcenter'>";
                        if ($recset["haymatricula"]>0){
                            $totregistradas=$totregistradas+1; 
                            if ($elidnivel>59 && $elidnivel<70 && $_SESSION["vg_tipousuario"]=="Supervisor"){ // secundaria
                                echo "Registrada";
                            }else{
                                echo "<a class='fbutton' style='background-color:".$arr_liga1[3]."; color:black' href='".$arr_liga1[1].$parametros."&devescuela'><small>".$arr_liga1[0]."</small></a>";
                            }
                        }else{
                            echo "<small>Sin registro</small>";
                        }
                    echo "</td>"; 
                     
                    $r++;
                }?>
            </table> <?
        if ($vl_regs>30){ ?></div> <? } 
    } ?>
    <br>
    <table class="ftable-all">
        <tr>
            <th colspan="2">Total de Escuelas de la zona = <? echo $vl_regs; ?></th>
        </tr>
        <tr>
            <td>Escuelas con registro de matrícula</td>
            <td style="text-align:right"><? echo $totregistradas; ?></td>
        </tr>
        <tr>
            <td>Escuelas sin registro de matrícula</td>
            <td style="text-align:right"><? echo ($vl_regs-$totregistradas); ?></td>
        </tr>
    </table>

