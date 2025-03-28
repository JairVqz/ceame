<? session_start(); 	 $autollamada=basename(__FILE__). "?"; ?>
<!DOCTYPE html>
<html><head>



</head>
<body class="fcenter">
	<?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');	conectalo("zona");

        //create table borra_supervis as select distinct cct_zona,idnivel from ctsev where estatus!='R' and cct_zona!='' order by cct_zona,idnivel
		//create table borra_supervis_after as select a.cct_zona,count(a.cct_zona) as cuantos from borra_supervis a group by a.cct_zona


        //mysql_query("update supervis_c set fer_niveles=''"); 
		mysql_query("update supervis_c set fer_numniveles=0,fer_idniveles='',fer_descniveles=''");    // Desarrollado por L.I. Fernando Rodríguez Colorado  www.sistemas-rc.com   -----    Analista de datos : L.I. Alberto Domingo Hwrnandez Martinez
		// es muy importante la condicion nivel!='' 	porque HAY QUE ASEGURAR QUE EFECTIVAMENTE SE MUESTREN SOLO LOS NIVELES DIFERENTES DE CADA ZONA
		// SI NO ESTA checar que hay errores y entonces se pueden generar 2 idniveles iguales. Ejemplo 40|40      Esto no debe pasar !
		// lamentablemente hay escuelas que no tienen el campo nivel porque son particulares que se dieron de alta posteriormente
		$res = mysql_query("select distinct cct_zona,idnivel,nivel from ctsev where estatus='A' and nivel!='' order by cct_zona,idnivel"); 
		$cadniv="";  $r=0;    $id=0;
		
		while ($r<mysql_num_rows($res)){
			if ($r==0){
				$recset=mysql_fetch_array($res,MYSQL_ASSOC);
				$cadniv=$recset["idnivel"]."|"; 
				$nomniv=$recset["nivel"]."|";		
				$zona=$recset["cct_zona"];
				$r++;
			}
			$id++;
            $recset=mysql_fetch_array($res,MYSQL_ASSOC);
            if ($zona==$recset["cct_zona"]){
				$cadniv=$cadniv.$recset["idnivel"]."|";
				$nomniv=$nomniv.$recset["nivel"]."|";
			}else{
                $cadniv=substr($cadniv,0,strlen($cadniv)-1);  
				$nomniv=substr($nomniv,0,strlen($nomniv)-1);
                //mysql_query("update supervis_c set fer_niveles='".$cadniv."',fer_numniveles=".$id.",fer_descniveles='".$nomniv."' where cuenta='".$zona."'");  
				mysql_query("update supervis_c set fer_numniveles=".$id.",fer_idniveles='".$cadniv."',fer_descniveles='".$nomniv."' where cuenta='".$zona."'");  
				$cadniv=$recset["idnivel"]."|"; 		
				$nomniv=$recset["nivel"]."|";
				$zona=$recset["cct_zona"];
				$id=0;
            }   
			$r++;
		}  


		
?>	
</body>
</html>