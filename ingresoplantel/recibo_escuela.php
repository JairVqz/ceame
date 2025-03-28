<?php
session_start();

?>
<html>
<head>
    <title> </title>
</head>
<body >		
<?php

$_SESSION["vg_idnivel"]=31;
// Desarrollado por : L.I. Fernando Rodríguez Colorado 	wwww.sistemas-rc.com
require_once('../conecta2023.php');   require_once('../inc/funciones_libros.php');	conectalo("zona");
if ( $_SESSION["vg_idnivel"]<40){
     $vl_ira="recibo_escuela_preescolar.php";
}else{
    if ( $_SESSION["vg_idnivel"]<60){     
            $vl_ira="recibo_escuela_primaria.php";
    }else{
        if ( $_SESSION["vg_idnivel"]==62 || $_SESSION["vg_idnivel"]==63 ){     
            $vl_ira="recibo_escuela_telesecundaria.php";
        }else{
            if ( $_SESSION["vg_idnivel"]==66 || $_SESSION["vg_idnivel"]==64 ){   
                   /// este nombre de archivo debe ser recibo_escuela_telesecundaria_CAM.php  OJO AQUI CON LAS ESCUELAS CAM=EML DML    
                    $vl_ira="recibo_escuela_secundaria_CAM.php";
            }else{
                $vl_ira="recibo_escuela_secundaria.php";
            }        
        }    
    }
    
     
}
// Analista de datos : L.I. Alberto Domingo Hwrnandez Martinez
//echo $_SESSION["vg_idnivel"];
//$vl_ira=$vl_ira."?n=".$_SESSION["vg_idnivel"];
?><script type="text/javascript" languaje="javascript">setTimeout("window.location.replace('<? echo $vl_ira; ?>')", 0);</script><br><br><br>  <?
?>
</body></html>