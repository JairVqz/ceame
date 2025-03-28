<? session_start(); 	 $autollamada=basename(__FILE__). "?"; ?>
<!DOCTYPE html>
<html><head>



</head>
<body class="fcenter">
	<?
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');	conectalo("zona");

        //create table borra_supervis as select distinct cct_zona,idnivel from ctsev where estatus!='R' and cct_zona!='' order by cct_zona,idnivel
		//create table borra_supervis_after as select a.cct_zona,count(a.cct_zona) as cuantos from borra_supervis a group by a.cct_zona


        mysql_query("update supervis_c set fer_niveles=''"); 
		$res = mysql_query("select distinct cct_zona,idnivel from ctsev where estatus!='R' and cct_zona!='' order by cct_zona,idnivel"); 
		$cadniv="";  $r=0;    
		
		while ($r<mysql_num_rows($res)){
			if ($r==0){
				$recset=mysql_fetch_array($res,MYSQL_ASSOC);
				$cadniv=$recset["idnivel"]."|"; 		
				$zona=$recset["cct_zona"];
				$r++;
			}
            $recset=mysql_fetch_array($res,MYSQL_ASSOC);
            if ($zona==$recset["cct_zona"]){
				$cadniv=$cadniv.$recset["idnivel"]."|";
			}else{
                $cadniv=substr($cadniv,0,strlen($cadniv)-1);  
                mysql_query("update supervis_c set fer_niveles='".$cadniv."' where cuenta='".$zona."'");  
				$cadniv=$recset["idnivel"]."|"; 		
				$zona=$recset["cct_zona"];
            }   
			$r++;
		}  


		
?>	
</body>
</html>