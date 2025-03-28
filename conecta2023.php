<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title></title>
<LINK REL="stylesheet"  HREF="_estilos.css" > 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
function url_actual(){
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
	  $url = "https://"; 
	}else{
	  $url = "http://"; 
	}
	return $url . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];
}
function mimayus($cadena) {
    // salida
    $out = '';
    // obtenemos la longitud
    $len = strlen($cadena);
    // cadena en minúsculas
    $min = mb_convert_case($cadena,  MB_CASE_LOWER);
    // cadena en mayúsculas
    $mas = mb_convert_case($cadena,  MB_CASE_UPPER);

    //comparamos carácter a carácter
   	for($i = 0; $i < $len; $i++) {
        // si son iguales añadimos a la salida y continuamos
        if(mb_substr($min, $i, 1, 'UTF-8')==mb_substr($mas, $i, 1, 'UTF-8')){
            $out .= mb_substr($cadena, $i, 1, 'UTF-8');
            continue;
        }
        // si no son iguales extraemos el carácter en mayúscula
        $out .= mb_substr($mas, $i, 1, 'UTF-8');
        // extraemos el resto de la cadena
        $out .= substr($cadena,$i+1);
        // salimos del bucle
        break;
    }
    return $out;
}	
// Desarrollado por : L.I. Fernando Rodríguez Colorado 	wwww.sistemas-rc.com

date_default_timezone_set('America/Mexico_City'); 
function conectalo($usuariobd,$labd=""){
	$link= mysql_connect("SERVIDOR",$usuariobd,"CONTRASEÑA")or die('no se puede conectar en conecta2023'.$usuariobd);
	mysql_select_db("ceame23",$link);
}	



function oculta($str,$modo){  
	if ($modo==0){
					$str=str_replace(chr(39),chr(234),$str);
					$ban="";
					for ($i=0; $i<strlen($str); $i++){$vl_car=substr($str,$i,1); 	$vl_num=ord($vl_car)+1; $ban=$ban.chr($vl_num);}  
					$ban=str_replace("}",chr(223),$ban);	
					$str=strrev($ban);	
	}else{
					$str=strrev($str);
					$str=str_replace(chr(223),"}",$str);	
					$ban="";
					for ($i=0; $i<strlen($str); $i++){$vl_car=substr($str,$i,1);	$vl_num=ord($vl_car)-1;	 $ban=$ban.chr($vl_num);}
					$str=$ban;
					$str=str_replace(chr(234),chr(39),$str);
	}				
return $str; 
}

function fechalarga($fecha)  {
		if ($fecha)    {
		$midia=date("D",mktime(0, 0, 0, substr($fecha,5,2), substr($fecha,8,2), substr($fecha,0,4)));
		switch($midia){	  		case "Sun": 	$midia="Domingo"; break;    			case "Mon": 	$midia="Lunes"; break;
										case "Tue": 	$midia="Martes"; break;     			case "Wed": 	$midia="Miercoles"; break;
										case "Thu": 	$midia="Jueves"; break;   			case "Fri": 		$midia="Viernes"; break;
										case "Sat": 	$midia="S&aacute;bado"; break;	}		
		$fecha=substr($fecha,0,4)."-".substr($fecha,5,2)."-".substr($fecha,8,2);	 
		$f=split("-",$fecha); 
		$nummes=(int)$f[1]; 
		$mes1="0-Enero-Febrero-Marzo-Abril-Mayo-Junio-Julio-Agosto-Septiembre-Octubre-Noviembre-Diciembre"; 
		$mes1=split("-",$mes1); 
		$desfecha="$midia, $f[2] de $mes1[$nummes] del $f[0]"; 
		return $desfecha;    
		}  
}

function ligafer($liga,$imagen1,$imagen2,$nombreimagen){
		return "<a href='".$liga."' onmouseout=\"MM_nbGroup('out');\" onmouseover=\"MM_nbGroup('over','".$nombreimagen."','".$imagen2."','".$imagen2."',1);\" onclick=\"MM_nbGroup('down','navbar1','".$nombreimagen."','".$imagen2."',1);\"><img name=\"".$nombreimagen."\" src=\"".$imagen1."\" border=\"0\" id=\"".$nombreimagen."\" alt=\"\" /></a>";
}	  


function fmiback($actualink){
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$actualink";
	$encuentra=array_search($actual_link,$_SESSION["atras"]);
	if ($encuentra){ // elimina el elemento del arreglo encontrado y el resto de ramas del arbol 
			array_splice($_SESSION["atras"],$encuentra);
	}
	$miback=end($_SESSION["atras"]);
	array_push($_SESSION["atras"],$actual_link);
	return $miback;
}	



function fselec1($titulo,$sql,$vapara,$back){
	$vl_back=$back;		$liga=$vapara;   $encabezado=$titulo; $nombre="arr_devuelto"; 							 			?><div><a class="fancybox-frcform" id="hiddensec" href="#seccionY" style="display:none">Click</a></div><div id="seccionY" style="width:100%; display:none; height:100%"> 
	<form enctype='multipart/form-data' action='<? echo $liga;?>' name='frmfancy' method='post'> 
			<table width="100%" cellpadding="25" cellspacing="0" border="0" class="fround"><tr class="fmargin-bottom"><th colspan="2" class="fround" style="vertical-align:middle; font-size:20px; background:#5F5F5F; color:white; padding:4px 25px;"><? echo $encabezado; ?></strong></th></tr> 
			 <tr><td align="center" class="fdeg"><select name='<?echo $nombre;?>' id='<?echo $nombre;?>' class='fround' onChange="javascript:algo();"><option value=''></option>			<? $vl_res=mysql_query($sql);			$vl_regs=mysql_num_rows($vl_res);	 $r=0;			while ($r<$vl_regs){					$recset=mysql_fetch_array($vl_res,MYSQL_NUM);					echo "<option value='".$recset[0]."|".$recset[1]."'>".$recset[1]."</option>";					$r++;	 			} ?>		</select></td></tr>
			<tr style="display:none"><td colspan="2" class='fcenter fpadding-large' align='center'><input type=submit name="resp1" value=' Aceptar ' class='fpadding-small' style="font-size:20px"> </td></tr>			</table>
	</form>	</div><script>$(window).load(function(){ $('#hiddensec').trigger('click'); });$(document).ready(function() { $('.fancybox-frcform').fancybox( {'autoSize' : true, 'closeBtn': true, helpers:{overlay: { closeClick: false }}, keys:{ close: null }, 'afterClose': function(){ location.replace('<? echo $vl_back; ?>'); } }); }); </script><script>function algo(){var x = document.getElementsByName('frmfancy'); x[0].submit(); } </script><? 
}
function fnumregistros($sqlloc){
	$vl_resloc=mysql_query($sqlloc);    $vl_regsloc=mysql_num_rows($vl_resloc);
	return $vl_regsloc;
}	


function fquest($pregunta,$liga){
	$texto=$pregunta;    $color="#C1C1C1";        $titboton1=" Si ";   $titboton2=" No ";										
	if ($_SESSION["vg_w"]==1){ $h="3"; }else{ $h="1"; }   ?>    			
	<div><a class="fancybox-frcform" id="hiddensec" href="#seccionY" style="display:none">Click</a></div>     			
	<div id="seccionY" style="width:100%; display:none;  height:100%">				
			<table width="100%" height="100%" cellpadding="0" cellspacing="10" border="0" class="fcenter fborder" style="background:<? echo $color; ?>">
				<tr><td class='fpadding-medium'><h<? echo $h; ?>><strong><? echo $texto; ?></strong></h<? echo $h; ?>></td></tr>
				<tr><td class='fcenter fpadding-large' align='center'>&emsp;&emsp;<a href="<? echo $liga; ?>" style="font-size:24px;  background:#F2F2F2" class="fbutton fpadding-small ftext-red fshad fround">&emsp;<? echo $titboton1; ?>&emsp;</a>&emsp;<a href="<? echo basename($_SERVER['REQUEST_URI'])."&respno"; ?>" style="font-size:24px; background:#F2F2F2" class="fbutton fpadding-small ftext-red fshad fround">&emsp;<? echo $titboton2 ?>&emsp;</a>&emsp;&emsp;</td></tr>
			</table>
	</div>    			
	<script>    				$(window).load(function(){ $('#hiddensec').trigger('click'); });      				$(document).ready(function() { $('.fancybox-frcform').fancybox( {'autoSize' : true,  'closeBtn': false, helpers:{overlay: { closeClick: false }},  keys:{ close: null } }); }); 			</script> <? 	
}
function fquit($liga){ ?>
	<script type="text/javascript" languaje="javascript">setTimeout("window.location.replace('<? echo $liga; ?>')", 0);</script><?
}

function foption($titulo,$liga,$tam=3){?>
	<div><a class="fancybox-frcform" id="hiddensec" href="#seccionY" style="display:none">Click</a></div> 	<div id="seccionY" style="width:100%; display:none;  height:100%">				
	<form enctype='multipart/form-data' action='<? echo $liga;?>' name='frmfancy' method='post' class="fgray" style="height:100%">
		<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0" class="fcenter">
			<tr><th class="fpadding-left fpadding-right fround"><h4><? echo $titulo; ?></h4></th></tr>
			<tr><td class="fpadding-left fpadding-right"> 
					<? $val=""; $tit=""; ?>		<label><input name='escogido' required style='margin:7px 3px' type='radio' value='<? echo $val; ?>'>&nbsp;&nbsp;<? echo $tit; ?></label> 
					<? $val=""; $tit=""; ?>		<br><label><input name='escogido' style='margin:7px 3px' type='radio' value='<? echo $val; ?>'>&nbsp;&nbsp;<? echo $tit; ?></label><br> 
			</td></tr>

		</table>
	</form></div>    			
	<script>$(window).load(function(){ $('#hiddensec').trigger('click'); });     $(document).ready(function() { $('.fancybox-frcform').fancybox( {'autoSize' : true,  'closeBtn': false, helpers:{overlay: { closeClick: false }},  keys:{ close: null } }); }); 	</script><?
}

function fmessage($mensaje,$tiempo,$tam,$back){ ?>
	<div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div>		<div id="seccionX" style="width:100%; display:none; height:100%">
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="1" class="fcenter">
			<tr><td class='fpadding-large'><h<? echo $tam; ?>><? echo $mensaje; ?></h<? echo $tam; ?>></td></tr>
	</table>
	</div> 	
	<script>$(window).load(function(){ $('#hiddensec').trigger('click'); fesconde() }); 	
		<? if ($back!="") { ?>	
			$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterLoad': function(){ setTimeout( function() {$.fancybox.close(); },<? echo $tiempo; ?>); }, 'afterClose': function(){ location.replace('<? echo $back; ?>'); } }); });  	
		<?}else{ ?>	
			$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterLoad': function(){ setTimeout( function() {$.fancybox.close(); },<? echo $tiempo; ?>); } }); });  	
		<? } ?>	
	</script> <?
}




function fbanner($titulo,$subt,$back,$fijo,$color,$imagen="",$botonagrega="",$botonbuscar=""){
    if($fijo=="SI"){$banfijo="ftop"; $br="<br><br><br>"; }else{$banfijo="frow"; $br=""; }        if($color==""){$color="white";}			if($subt!=""){ $br.="<br>";}
    if ($imagen!="|"){
		$br.="<br>";
        $arrimg=explode("|",$imagen);          
        if ($_SESSION['vg_w']==1){  $banimg="<img src='".$arrimg[0]."' border='0' class='img-responsive' width='250' >";}else{  $banimg="<div align='center'><img src='".$arrimg[0]."' border='0' class='img-responsive' width='".$arrimg[1]."' ></div>";}
    }  ?>
    <div class="<? echo $banfijo; ?> fcenter fborder-bottom" style="background:<? echo $color; ?>"> 
            <table width="100%"><tr>
                <? if($_SESSION["vg_w"]==1){  $br.="<br>"; ?>    
                    <td width="10px" class="fpadding-right">
                        <div class='fleft fpadding-tiny flight-gray ftext-indigo'><h4><a href="<? echo $back; ?>" class='icon-cancel'>Cerrar</a></h4></div>
                        <? if ($botonagrega!=""){ ?>   <div class='fleft fpadding-tiny flight-gray ftext-indigo'><h4><a href="<? echo $botonagrega; ?>" class='icon-plus'></a></h4></div> <? } ?>
                        <? if ($botonbuscar!=""){ ?> <div class='fleft fpadding-tiny flight-gray ftext-indigo'><h4><a href='".$autollamada."ex=".$_GET["ex"]."&buscando' class='icon-search'></a></h4></div> <? } ?>
                    </td>
                    <td align="left"><? echo $banimg.$titulo.$subt; ?></td>
                <?}else{ // cambia la posicion de los iconos al lado derecho?>
                    <td width="125px"></td>
                    <td><? echo $banimg.$titulo.$subt; ?></td>
                    <td width="125px" class="fpadding-right">
                        <div class='fright fpadding-tiny flight-gray ftext-indigo'><h4><a href="<? echo $back; ?>" class='icon-cancel'>Cerrar</a></h4></div>
                        <? if ($botonagrega!=""){ ?>   <div class='fright fpadding-tiny flight-gray ftext-indigo'><h4><a href="<? echo $botonagrega; ?>" class='icon-plus'></a></h4></div> <? } ?>
                        <? if ($botonbuscar!=""){ ?> <div class='fright fpadding-tiny flight-gray ftext-indigo'><h4><a href='".$autollamada."ex=".$_GET["ex"]."&buscando' class='icon-search'></a></h4></div> <? } ?>
                    </td>
                <?} ?>    
            </tr></table>
    </div>     <? echo $br;
}

function fdesconecta($back,$tiempo){ 
	foreach ($_SESSION as $key=>$val){ unset($_SESSION[$key]);  }
	?>
	<div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div>		<div id="seccionX" style="width:100%; display:none; height:100%">
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="1" class="fcenter">
			<tr><td class='fpadding-large'><h2 class="icon-logout fbold ftext-red"><small class="ftext-black">Se ha cerrado la Sesión</small></h3></td></tr>
	</table>
	</div> 	
	<script>$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	
		<? if ($back!="") { ?>	
			$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterLoad': function(){ setTimeout( function() {$.fancybox.close(); },<? echo $tiempo; ?>); }, 'afterClose': function(){ location.replace('<? echo $back; ?>'); } }); });  	
		<?}else{ ?>	
			$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterLoad': function(){ setTimeout( function() {$.fancybox.close(); },<? echo $tiempo; ?>); } }); });  	
		<? } ?>	
	</script> <?
}
?>
</body>
</html>

