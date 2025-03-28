<?php	

function sinmayusculas($cadenaconmayusculas){ if(todasmayusculas($cadenaconmayusculas)){$cadenaconmayusculas=ucfirst(strtolower($cadenaconmayusculas));}return $cadenaconmayusculas;}		function todasmayusculas($xcad){return($xcad === strtoupper($xcad) ? true : false);}


function conectalo($usuariobd,$labd=""){
//    mysql
	$servidor="SERVIDOR";
	$link= mysql_connect($servidor,$usuariobd,"XXXXXXXX");  
	mysql_select_db($labd,$link);	  
}	



function oculta($str,$modo){  // modificado el 30 sept 2014
	if ($modo==0){
					$str=str_replace(chr(39),chr(234),$str); //  cambia  ' = 39  por 234
					$ban="";
					for ($i=0; $i<strlen($str); $i++){$vl_car=substr($str,$i,1); 	$vl_num=ord($vl_car)+1; $ban=$ban.chr($vl_num);}  
					$ban=str_replace("}",chr(223),$ban);	
					$ban=str_replace("{",chr(224),$ban);	
					$str=strrev($ban);	
	}else{
					$str=strrev($str);
					$str=str_replace(chr(224),"{",$str);	
					$str=str_replace(chr(223),"}",$str);	
					$ban="";
					for ($i=0; $i<strlen($str); $i++){$vl_car=substr($str,$i,1);	$vl_num=ord($vl_car)-1;	 $ban=$ban.chr($vl_num);}
					$str=$ban;
					$str=str_replace(chr(234),chr(39),$str); //  cambia  " = 34  por 235
	}				
return $str; 
}





 



function fechacorta($fecha,$modo="")    
{     if ($fecha)    { 	  return "mejor use fecha20('actual','C','Ndia','Nhr','Npdf')";    }  } 

function ligafer($liga,$imagen1,$imagen2,$nombreimagen,$otraventana="No"){
		if ($otraventana=="No"){$vl_cad="_self"; }else{$vl_cad="_blank";}
		return "<a href='".$liga."' target=\"$vl_cad\" onmouseout=\"MM_nbGroup('out');\" onmouseover=\"MM_nbGroup('over','".$nombreimagen."','".$imagen2."','".$imagen2."',1);\" onclick=\"MM_nbGroup('down','navbar1','".$nombreimagen."','".$imagen2."',1);\"><img name=\"".$nombreimagen."\" src=\"".$imagen1."\" border=\"0\" id=\"".$nombreimagen."\" alt=\"\" /></a>";
}	 

function parteruta($queparte,$pm_ruta){
		$arr=explode("/",$pm_ruta);
	  if ($queparte=="anterior"){ return substr($pm_ruta,0,strlen($pm_ruta)-(strlen($arr[count($arr)-1]))); } else { return $arr[count($arr)-1];} 		
}














function subfijo($xx)
{ // esta funci�n regresa un subfijo para la cifra
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
        $xsub = "";
    //
    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
        $xsub = "MIL";
    //
    return $xsub;
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

function fmessage($mensaje,$tiempo,$tam,$liga){ ?>
	<div><a class="fancybox-frcquick-frcreplace" id="hiddensec" href="#seccionX" style="display:none">Click</a></div>		<div id="seccionX" style="width:100%; display:none; height:100%">
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="1" class="fcenter">
			<tr><td class='fpadding-large'><h<? echo $tam; ?>><strong><? echo $mensaje; ?></strong></h<? echo $tam; ?>></td></tr>
	</table>
	</div> 	
	<script>$(window).load(function(){ $('#hiddensec').trigger('click'); }); 	
		<? if ($liga!="") { ?>	
			$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterLoad': function(){ setTimeout( function() {$.fancybox.close(); },<? echo $tiempo; ?>); }, 'afterClose': function(){ location.replace('<? echo $liga; ?>'); } }); });  	
		<?}else{ ?>	
			$(document).ready(function() { $('.fancybox-frcquick-frcreplace').fancybox( {'autoSize' : true, 'afterLoad': function(){ setTimeout( function() {$.fancybox.close(); },<? echo $tiempo; ?>); } }); });  	
		<? } ?>	
	</script> <?
} 

?>