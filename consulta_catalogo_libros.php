<? session_start(); 	 $autollamada=basename(__FILE__). "?"; ?>
<!doctype html><html lang="es"> 
<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />      	<meta name="viewport" content="width=device-width, initial-scale=1"> 	
<title>Libros Veracruz</title><link rel="shortcut icon" href="images/libro_titulo3.png">
<link rel="stylesheet" href="css/frc.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/frcico.css" type="text/css" media="screen" />  
<SCRIPT TYPE="text/javascript" src="js/_funciones14.js"></SCRIPT> 


<script type="text/javascript" src="inc/fancy217/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />

<SCRIPT TYPE="text/javascript"> 
	function checa(modo,soloparaesteprog=0){var m=document.getElementById("error");    var a=document.frmactual;
		switch (modo){
        case 1:
            if (a.rdnivel.value=="") {
                t="Seleccione";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
                a.rdnivel.focus();                     setTimeout ("x()", 2000);  return false;
            }
            break;
        case 2:
            if (a.rdgrado.value=="") {
                t="Seleccione";      m.innerHTML =  "<div style='padding:5px;'>"+t+"</div>";
                a.rdgrado.focus();                     setTimeout ("x()", 2000);  return false;
            }
            break;
        } 

	}
    function doHide(){
                var j = document.getElementsByClassName("exhibe");
                for (var i = 0; i < j.length; i++){j[i].style.visibility = "hidden";}
    }
    function doPrint(){
                var k = document.getElementsByClassName("saca");
                var j = document.getElementsByClassName("exhibe");
                for (var i = 0; i < k.length; i++){k[i].style.visibility = "hidden";}
                for (var i = 0; i < j.length; i++){j[i].style.visibility = "visible";}
                window.print()
                for (var i = 0; i < k.length; i++){k[i].style.visibility = "visible";}
                for (var i = 0; i < j.length; i++){j[i].style.visibility = "hidden";}
    }
</SCRIPT>

<style type="text/css" media="print">
         @page 
        {
            size: auto;   /* auto is the initial value */
            margin: 0mm;  /* this affects the margin in the printer settings */
        } 
        p.SaltoDePagina { PAGE-BREAK-AFTER: always }  
</style>

</head>
<body class="fcenter" onLoad='doHide()'>
    
    <?
require_once('conecta2023.php');   require_once('inc/funciones_libros.php');	conectalo("zona");





if ((!isset($logeado) && !isset($TxtUsuario))){
	fmessage("Acceso No Permitido",1500,2,"_panel.php");
}else{ 	
	if(!isset($_GET["ex"])){$_GET["ex"]=1;}
	switch ($_GET["ex"]){
    case 1:
        if (isset($_GET["catgo"])){ $_SESSION["catgo"]=$_GET["catgo"]; }
        $vl_back="_panel.php";	
        $titulo="Nivel";       		  				switch ($_GET["vl_modoact"]){case 1: default: $tit="Seleccione<br>"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2;    $arrmodif=explode("|",$_GET["arrmod"]); break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
        <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=2' onSubmit='return checa(1);' name='frmactual' method='post'>
            <? $ancho=240;   $anchorotulos=160;   $color=".$fdeg.";			$titboton1="Continuar"; $titboton2=""; ?> <strong>
            <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                <tr><td><? 

                    $radnombre="rdnivel";   
                    if ($_SESSION["catgo"]=="i"){ $valores="4--Primaria|6--Secundaria"; }else{ $valores="3--Preescolar|4--Primaria|6--Secundaria|7--Telesecundaria"; }    	 			                    $arrval=explode("|",$valores);	
                    for ($i=0; $i < count($arrval); $i++) { $arrx=explode('--',$arrval[$i]); ?>						&emsp;<input style='margin:7px 3px' type='radio' name='<?echo $radnombre;?>' value='<?echo $arrval[$i];?>'>&nbsp;&nbsp;<? echo $arrx[1].'<br>'; 							} ?>
                </td></tr>	
                <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
            </table>  </strong>
        </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div><?	
        break;         
    case 2:
        $vl_back=$autollamada."ex=1";
        if (isset($_POST["rdnivel"])){	
            $arrnivel=explode('--',$_POST["rdnivel"]);
            $_SESSION["idnivel"]=$arrnivel[0];
            $_SESSION["nivel"]=$arrnivel[1];
        }
        echo "<h3 class='fpadding-small fmargin fbold'>Nivel ".$_SESSION["nivel"]."</h3>";
        $titulo="Grado";          				    switch ($_GET["vl_modoact"]){case 1: default: $tit="Seleccione<br>"; $modo=1; break; case 2: case 22: $tit="Modificando"; $modo=2;    $arrmodif=explode("|",$_GET["arrmod"]); break; case 9: case 29: $tit="Consultando"; $modo=9; break;}			if ($_SESSION['vg_w']==1){?> <div class="fwhite"><div class="fnavbar fblack fcenter ftop fpadding-tiny"><div class="fright fpadding-small"><a href="<? echo $vl_back; ?>" class="icon-cancel" style="font-size:20px"></a></div><div style="padding-top:3px; font-size:22px; color:yellow; font-weight:bold"><? echo $tit." ".$titulo; ?></div></div><br><br> <? } ?> 			
        <form enctype='multipart/form-data' action='<? echo $autollamada;?>ex=3' onSubmit='return checa(2);' name='frmactual' method='post'>
            <? $ancho=200;   $anchorotulos=160;   $color=".$fdeg.";			$titboton1="Continuar"; $titboton2=""; ?> <strong>
            <table width="<?if ($_SESSION["vg_w"]==1){echo "100%";}else{ echo $ancho; } ?>" cellpadding="3" cellspacing="5" class="ftable-all">   <? if ($_SESSION['vg_w']==2){ echo "<tr><th colspan='2' class='fblack fround'	><h3>".$tit." ".$titulo."</h3></td></tr>"; } ?>
                <tr><td><? 
                    if ($_SESSION["idnivel"]==4){
                        $valores="1|2|3|4|5|6";   $texval="Primero|Segundo|Tercero|Cuarto|Quinto|Sexto";
                    }else{
                        $valores="1|2|3";   $texval="Primero|Segundo|Tercero";
                    }
                    $radnombre="rdgrado";   if ($_SESSION["idnivel"]==4){ $valores="1--Primero|2--Segundo|3--Tercero|4--Cuarto|5--Quinto|6--Sexto";   }else{  $valores="1--Primero|2--Segundo|3--Tercero"; 	 }			                    $arrval=explode("|",$valores);	for ($i=0; $i < count($arrval); $i++) { $arrx=explode('--',$arrval[$i]); ?>						&emsp;<input style='margin:7px 3px' type='radio' name='<?echo $radnombre;?>' value='<?echo $arrval[$i];?>'>&nbsp;&nbsp;<? echo $arrx[1].'<br>'; 							} ?>
                </td></tr>	
                <? if($modo!=9){ ?>			  															<tr><td colspan='2'><div class='alert-danger fpadding-small ftext-pink' id='error' align='center'></div></td></tr>			  															<tr><td colspan='2' class='fdark-gray fcenter fpadding-small fround' align='center'><input type='submit' value=' <? echo $titboton1; ?> ' class='fpadding-tiny'><? if($titboton2!=''){ ?>&emsp;<input type='reset' value=' <? echo $titboton2; ?> ' class='fpadding-tiny'> <? } ?></td></tr>			  														<? } ?>
            </table>  </strong>
        </form> 	<? if ($_SESSION['vg_w']==1){ ?></div><? } ?>       	</div><?	
        break;         
    case 3:
            $vl_back=$autollamada."ex=2";
            $arrgrado=explode('--',$_POST["rdgrado"]);
            if ($arrgrado[0]==1){ $vl_grado="PRIMER"; }else{  if ($arrgrado[0]==3){ $vl_grado="TERCER"; }else{ $vl_grado=strtoupper($arrgrado[1]);}     }
            if ($_SESSION["catgo"]=="i"){$ban="id>115 and "; $bantit=" (ÍNDIGENA)"; }else{$ban="id<116 and ";; $bantit="";}
            $_sql="select * from l_libros where ".$ban."idnivel=".$_SESSION["idnivel"]." and idgrado=".$arrgrado[0]." and estatus!='X' order by idmaterial"; 
            	//echo "<br><br><br><br><br><br><br><br<br><br<br><br><br><br>".$_sql; 
            $res=mysql_query($_sql);?>
                <div class="saca frow ftop fpadding-large fleft-align"> <a class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a></div><br>
                <div align="center"><img src="images/logo_SEVGob.png" weight="800"></div> 
                <div style="text-align:center; font-weigth:bold">  
                        <br>
                        CATALOGO DE LIBROS DE TEXTO GRATUITOS<br>
                        CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)<br><br>  
                        NIVEL : <? echo strtoupper($_SESSION["nivel"]).$bantit; ?>&emsp;&emsp;<? echo $vl_grado; ?> GRADO
                        <br>
                </div>         
                <br>
            
                <table class="ftable-all fborder" align="center" style="font-weight:bold" cellpadding="10" cellspacing=0 border=1> 
                    
                    <tr><th></th><th>Clave</th><th>Titulo</th><th>Ejem x caja</th><th>Observaciones</th></tr><? 
                        $r=0; 
                        if (mysql_num_rows($res)>0){ 
                            while ($r<mysql_num_rows($res)){ 		$recset=mysql_fetch_array($res,MYSQL_ASSOC); ?>
                                <tr> 
                                    <!-- <td class="fwhite"> -->
                                        <!-- <small><a class="fbutton fround fpale-yellow fpadding-small" href="<? // echo $autollamada."ex=4&".$nomarreglo."=".oculta($caddatos,0); ?>">Detalle</a></small> -->
                                        <!-- <small><a class="fbutton fround fpale-red fpadding-small icon-cancel" href="<?// echo $autollamada."ex=3&eli&clave=".$recset["idmaterial"]; ?>"></a></small> -->
                                    <!-- </td>  -->
                                    <td class="fcenter"><small><?
                                        echo ($r+1); ?></small> 

                                    </td> 
                                    <td class="ftext-indigo" style="vertical-align:middle"><? echo strtoupper($recset["idmaterial"]); ?></td> 
                                    <td style="vertical-align:middle"><? echo $recset["titulo"]; ?></td> 
                                    <td style="text-align:center; vertical-align:middle"><? echo $recset["primcajas"]; ?></td> 
                                    <td style="text-align:center; vertical-align:middle"><small><? echo $recset["observa"]; ?></small></td> 
                                </tr> <? 
                                $r++; 
                            } 	
                        }else{ echo "<tr><td colspan='11' class='fcenter fpadding-large'>No hay registros</td></tr>"; }        ?>    
                </table> 
            <? 
            break;        
    }    
	?><br><br>
	<div class="fcenter fpadding-large fborder-top fmargin saca">
		<a href="<? echo $vl_back;?>" class="fbutton fshad fpadding-tiny fround"><h4 class="fmargin-left fmargin-right icon-left">&nbsp;Regresar</h4></a>
	</div><?
} ?>	
</body>
</html>