<?php
session_start(); 
$autollamada=basename(__FILE__). "?";	
require_once('../conecta2023.php');
require_once('../inc/funciones_libros.php'); 
require_once('../phpqrcode/qrlib.php');

// ****************************************  INICIO DE LA PAGINA  *****************************
?>
<!DOCTYPE html>
<html>
<head>
    <title>Matricula</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="../css/frc.css" type="text/css" media="screen" />
    

        <link rel="stylesheet" href="../css/frcico.css" type="text/css" media="screen" />  

        <script type="text/javascript" src="../inc/fancy217/lib/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../inc/fancy217/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="../inc/fancy217/source/jquery.fancybox.css?v=2.1.5" media="screen" />
        
    <style type="text/css" media="print">
            @page 
            {
                size: auto;   /* auto is the initial value */
                margin: 0mm;  /* this affects the margin in the printer settings */
            }
            H1.SaltoDePagina { PAGE-BREAK-AFTER: always }  
        </style>
    <SCRIPT TYPE="text/javascript" src="../_funciones.js"></SCRIPT>
    <SCRIPT TYPE="text/javascript">
        function cl(x){setTimeout ("window.location.replace('"+x+"')", 0);}
        function cl2(x){setTimeout ("window.location.replace('"+x+"')", 2000);}
        function cierraventana(){window.close();} 
        function checa(modo){
                switch(modo)
                {
                        case 1:
                        m=document.getElementById("error");	
                        if (parseInt(document.frmactual.txt_primero2.value)>parseInt(document.frmactual.txt_primero.value)){
                        m.innerHTML="El total de grupos de primero, no puede ser mayor que el total de alumnos de primero\n\n"; 
                        document.frmactual.txt_primero2.focus(); 
                        return false;
                        }
                        if (parseInt(document.frmactual.txt_segundo2.value)>parseInt(document.frmactual.txt_segundo.value)){
                        m.innerHTML="El total de grupos de segundo, no puede ser mayor que el total de alumnos de segundo\n\n"; 
                        document.frmactual.txt_segundo2.focus(); 
                        return false;
                        }
                        if (parseInt(document.frmactual.txt_tercero2.value)>parseInt(document.frmactual.txt_tercero.value)){
                        m.innerHTML="El total de grupos de tercero, no puede ser mayor que el total de alumnos de tercero\n\n"; 
                        document.frmactual.txt_tercero2.focus(); 
                        return false;
                        }
                        if (parseInt(document.frmactual.txt_cuarto2.value)>parseInt(document.frmactual.txt_cuarto.value)){
                        m.innerHTML="El total de grupos de cuarto, no puede ser mayor que el total de alumnos de cuarto\n\n"; 
                        document.frmactual.txt_cuarto2.focus(); 
                        return false;
                        }
                        if (parseInt(document.frmactual.txt_quinto2.value)>parseInt(document.frmactual.txt_quinto.value)){
                        m.innerHTML="El total de grupos de quinto, no puede ser mayor que el total de alumnos de quinto\n\n"; 
                        document.frmactual.txt_quinto2.focus(); 
                        return false;
                        }

                        if (parseInt(document.frmactual.txt_sexto2.value)>parseInt(document.frmactual.txt_sexto.value)){
                        m.innerHTML="El total de grupos de sexto, no puede ser mayor que el total de alumnos de sexto\n\n"; 
                        document.frmactual.txt_sexto2.focus(); 
                        return false;
                        }

                        if ((document.frmactual.txt_primero.value.length==0) || (document.frmactual.txt_primero2.value.length==0)){
                                m.innerHTML="Los alumnos y grupos de primero no pueden quedar vacios\n\n"; 
                                document.frmactual.txt_primero.focus(); 
                                return false;
                        }
                        if ((document.frmactual.txt_segundo.value.length==0) || (document.frmactual.txt_segundo2.value.length==0)){
                                m.innerHTML="Los alumnos y grupos de segundo no pueden quedar vacios\n\n"; 
                                document.frmactual.txt_segundo.focus(); 
                                return false;
                        }	
                        if ((document.frmactual.txt_tercero.value.length==0) || (document.frmactual.txt_tercero2.value.length==0)){
                                m.innerHTML="Los alumnos y grupos de tercero no pueden quedar vacios\n\n"; 
                                document.frmactual.txt_tercero.focus(); 
                                return false;
                        }	
                        if ((document.frmactual.txt_cuarto.value.length==0) || (document.frmactual.txt_cuarto2.value.length==0)){
                        m.innerHTML="Los alumnos y grupos de cuarto no pueden quedar vacios\n\n"; 
                        document.frmactual.txt_cuarto.focus(); 
                        return false;
                        }	if ((document.frmactual.txt_quinto.value.length==0) || (document.frmactual.txt_quinto2.value.length==0)){
                        m.innerHTML="Los alumnos y grupos de quinto no pueden quedar vacios\n\n"; 
                        document.frmactual.txt_quinto.focus(); 
                        return false;
                        }	if ((document.frmactual.txt_sexto.value.length==0) || (document.frmactual.txt_sexto2.value.length==0)){
                        m.innerHTML="Los alumnos y grupos de sexto no pueden quedar vacios\n\n"; 
                        document.frmactual.txt_sexto.focus(); 
                        return false;
                        }		
                        /*

                        if ((document.frmactual.txt_primero.value.length>0) && (document.frmactual.txt_primero2.value.length==0)){
                        m.innerHTML="Los grupos de primero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_primero2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_primero2.value.length>0) && (document.frmactual.txt_primero.value.length==0)){
                        m.innerHTML="Los alumnos de primero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_primero.focus(); 
                        return false;
                        }	

                        if ((document.frmactual.txt_segundo.value.length>0) && (document.frmactual.txt_segundo2.value.length==0)){
                        m.innerHTML="Los grupos de segundo no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_segundo2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_segundo2.value.length>0) && (document.frmactual.txt_segundo.value.length==0)){
                        m.innerHTML="Los alumnos de segundo no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_segundo.focus(); 
                        return false;
                        }	

                        if ((document.frmactual.txt_tercero.value.length>0) && (document.frmactual.txt_tercero2.value.length==0)){
                        m.innerHTML="Los grupos de tercero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_tercero2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_tercero2.value.length>0) && (document.frmactual.txt_tercero.value.length==0)){
                        m.innerHTML="Los alumnos de tercero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_tercero.focus(); 
                        return false;
                        }		

                        if ((document.frmactual.txt_cuarto.value.length>0) && (document.frmactual.txt_cuarto2.value.length==0)){
                        m.innerHTML="Los grupos de cuarto no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_cuarto2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_cuarto2.value.length>0) && (document.frmactual.txt_cuarto.value.length==0)){
                        m.innerHTML="Los alumnos de cuarto no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_cuarto.focus(); 
                        return false;
                        }	
                        if ((document.frmactual.txt_quinto.value.length>0) && (document.frmactual.txt_quinto2.value.length==0)){
                        m.innerHTML="Los grupos de quinto no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_quinto2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_quinto2.value.length>0) && (document.frmactual.txt_quinto.value.length==0)){
                        m.innerHTML="Los alumnos de quinto no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_quinto.focus(); 
                        return false;
                        }	
                        if ((document.frmactual.txt_secto.value.length>0) && (document.frmactual.txt_sexto2.value.length==0)){
                        m.innerHTML="Los grupos de sexto no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_sexto2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_sexto2.value.length>0) && (document.frmactual.txt_sexto.value.length==0)){
                        m.innerHTML="Los alumnos de sexto no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_sexto.focus(); 
                        return false;
                        }	*/

                        break;

                        case 2:
                        m=document.getElementById("error2");
                        if (parseInt(document.frmactual.txt_primero2.value)>parseInt(document.frmactual.txt_primero.value)){
                        m.innerHTML="El total de grupos de primero, no puede ser mayor que el total de alumnos de primero\n\n"; 
                        document.frmactual.txt_primero2.focus(); 
                        return false;
                        }
                        if (parseInt(document.frmactual.txt_segundo2.value)>parseInt(document.frmactual.txt_segundo.value)){
                        m.innerHTML="El total de grupos de segundo, no puede ser mayor que el total de alumnos de segundo\n\n"; 
                        document.frmactual.txt_segundo2.focus(); 
                        return false;
                        }
                        if (parseInt(document.frmactual.txt_tercero2.value)>parseInt(document.frmactual.txt_tercero.value)){
                        m.innerHTML="El total de grupos de tercero, no puede ser mayor que el total de alumnos de tercero\n\n"; 
                        document.frmactual.txt_tercero2.focus(); 
                        return false;
                        }


                        if ((document.frmactual.txt_primero.value.length==0) || (document.frmactual.txt_primero2.value.length==0)){
                        m.innerHTML="Los alumnos y grupos de primero no pueden quedar vacios\n\n"; 
                        document.frmactual.txt_primero.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_segundo.value.length==0) || (document.frmactual.txt_segundo2.value.length==0)){
                        m.innerHTML="Los alumnos y grupos de segundo no pueden quedar vacios\n\n"; 
                        document.frmactual.txt_segundo.focus(); 
                        return false;
                        }	if ((document.frmactual.txt_tercero.value.length==0) || (document.frmactual.txt_tercero2.value.length==0)){
                        m.innerHTML="Los alumnos y grupos de tercero no pueden quedar vacios\n\n"; 
                        document.frmactual.txt_tercero.focus(); 
                        return false;
                        }	
                        /*

                        if ((document.frmactual.txt_primero.value.length>0) && (document.frmactual.txt_primero2.value.length==0)){
                        m.innerHTML="Los grupos de primero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_primero2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_primero2.value.length>0) && (document.frmactual.txt_primero.value.length==0)){
                        m.innerHTML="Los alumnos de primero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_primero.focus(); 
                        return false;
                        }	

                        if ((document.frmactual.txt_segundo.value.length>0) && (document.frmactual.txt_segundo2.value.length==0)){
                        m.innerHTML="Los grupos de segundo no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_segundo2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_segundo2.value.length>0) && (document.frmactual.txt_segundo.value.length==0)){
                        m.innerHTML="Los alumnos de segundo no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_segundo.focus(); 
                        return false;
                        }	

                        if ((document.frmactual.txt_tercero.value.length>0) && (document.frmactual.txt_tercero2.value.length==0)){
                        m.innerHTML="Los grupos de tercero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_tercero2.focus(); 
                        return false;
                        }
                        if ((document.frmactual.txt_tercero2.value.length>0) && (document.frmactual.txt_tercero.value.length==0)){
                        m.innerHTML="Los alumnos de tercero no pueden quedar en 0\n\n"; 
                        document.frmactual.txt_tercero.focus(); 
                        return false;
                        }	*/	
                        break;
                        case 3:
                        m=document.getElementById("error3");
                        if ((document.frmactual.rad_escoge[0].checked) || (document.frmactual.rad_escoge[1].checked)  || (document.frmactual.rad_escoge[2].checked) || (document.frmactual.rad_escoge[3].checked) || (document.frmactual.rad_escoge[4].checked)){}
                        else{m.innerHTML ="Debe escoger una tipo de registro\n\n";
                        document.frmactual.rad_escoge[0].focus();
                        return false;
                        }
                        if (document.frmactual.sel_grado.value==0){
                        m.innerHTML="Seleccione el grado\n\n";
                        document.frmactual.sel_grado.focus();
                        return false;
                        }

                        if (document.frmactual.txt_cantidad.value.length==0){
                        m.innerHTML="Escriba la cantidad\n\n";
                        document.frmactual.txt_cantidad.focus();
                        return false;
                        }
                        break;	
                        case 31:
                        m=document.getElementById("error3");
                        if ((document.frmactual.rad_escoge[0].checked) || (document.frmactual.rad_escoge[1].checked)  || (document.frmactual.rad_escoge[2].checked)){}
                        else{m.innerHTML ="Debe escoger una tipo de registro\n\n";
                        document.frmactual.rad_escoge[0].focus();
                        return false;
                        }
                        if (document.frmactual.sel_grado.value==0){
                        m.innerHTML="Seleccione el grado\n\n";
                        document.frmactual.sel_grado.focus();
                        return false;
                        }

                        if (document.frmactual.txt_cantidad.value.length==0){
                        m.innerHTML="Escriba la cantidad\n\n";
                        document.frmactual.txt_cantidad.focus();
                        return false;
                        }
                        break;	
                        case 50:
                        if (document.frmactual.txt_Clave.value.length == 0) {
                        m.innerHTML =  "Escriba una Clave\n";
                        document.frmactual.txt_Clave.focus();
                        return false;
                        }
                        if (document.frmactual.txt_turno.value.length == 0) {
                        m.innerHTML =  "Escriba el turno\n";
                        document.frmactual.txt_turno.focus();
                        return false;
                        }
                        break;	
                }
        }
        function pregunta(){ 
                if (confirm('Esta seguro que los datos son correctos ?                                                              Una vez registrados no podra modificarlos')){ 
                document.frmactual.submit() ;
                }else{ document.frmactual.reset() ; }
        }
        function doPrint(){
                        document.all.item("regresar").style.visibility='hidden' 
                        document.all.item("Imprimir").style.visibility='hidden' 

                        window.print()
                        document.all.item("regresar").style.visibility='visible'
                        document.all.item("Imprimir").style.visibility='visible'
        }
    </SCRIPT>
</head>
<body style="font-size:14px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">                <?php
                if ((!isset($logeado) && !isset($TxtUsuario))){
                    echo "<br><br><br><br><table border='0' width='500' height='200'><tr><td align='center'><h1>Acceso NO permitido</h1><br><br></td></tr></table>";
                }else{
                        // Analista de datos : L.I. Alberto Domingo Hérnandez Martinez
                    conectalo("director");
                    switch ($qwerty){
                            case 1: 
                                switch ($_SESSION["vg_tipousuario"]){
                                        case "Plantel":      $lallaveescuela=$_SESSION["vg_ctausr"]; break;
                                        case "Supervisor":   $lallaveescuela=$_GET["cct"].$_GET["turno"]; break;
                                        default:                $lallaveescuela=$_GET["cct"].$_GET["turno"]; break;
                                }
                                $resal=mysql_query("select id,idnivel,nivel,nom_ct,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6,fecha_matricula,day(fecha_matricula) as dia_fecha_matricula,upc_1,upc_2,upc_3,upc_4,upc_5,upc_6 from ctsev where CONCAT(cct,turno)='".$lallaveescuela."'"); 
                               // echo "<br><br><br><br><br><br>select id,idnivel,nivel,nom_ct,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6,fecha_matricula,day(fecha_matricula) as dia_fecha_matricula from ctsev where CONCAT(cct,turno)='".$lallaveescuela."'";
                                $recalu=mysql_fetch_array($resal,MYSQL_ASSOC);
                                $elidnivel=$recalu["idnivel"];


                                
                                switch ($_SESSION["vg_tipousuario"]){
                                        case "Plantel":         $vl_back="../_panel.php";    break;
                                        case "Supervisor":      $vl_back="../ingresosupervisor/recibo_matricula_zona.php?sel=escuela&arr_nivel=".$elidnivel."|".$elnivel; break;
                                        default:                $vl_back="../ingresosupervisor/recibo_matricula_zona.php?sel=escuela&idnivel=".$elidnivel."&nivel=".$elnivel."&cct_zona=".$_GET["cct_zona"]."&almacen_seleccionado=".$_GET["almacen_seleccionado"]."&bodega=".$_GET["bodega"]; break;
                                }

                                if (!isset($_GET["imprime"]) && $recalu["dia_fecha_matricula"]==0){   //  CAPTURA DE MATRICULA REAL (usuario Plantel) 
                        //        if (!isset($_GET["imprime"])){   //  CAPTURA DE MATRICULA REAL (usuario Plantel) 
                                          
                                        if ($_SESSION["vg_tipousuario"]=="Plantel"){     
                                                if (!isset($_GET["form"])){  
                                                        $sql_anterior="select id,idnivel,nivel,nom_ct,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6,fecha_matricula,day(fecha_matricula) as dia_fecha_matricula,upc_1,upc_2,upc_3,upc_4,upc_5,upc_6 from ctsev_2023_2024 where CONCAT(cct,turno)='".$lallaveescuela."'"; // echo  "<br><br>".$sql_anterior;                                                        
                                                        $regsanterior=mysql_num_rows($resal);  // Numero de registros del ciclo anterior
                                                        $resal=mysql_query("select id,idnivel,nivel,nom_ct,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6,fecha_matricula,day(fecha_matricula) as dia_fecha_matricula,upc_1,upc_2,upc_3,upc_4,upc_5,upc_6 from ctsev_2023_2024 where CONCAT(cct,turno)='".$lallaveescuela."'"); 
                                                        
                                                         $recalu=mysql_fetch_array($resal,MYSQL_ASSOC);
                                                         $elidnivel=$recalu["idnivel"];
                                                         $elnivel=$recalu["nivel"];
                                                         $nombre=$recalu["nom_ct"];
                                                         $fechamatriculareal=$recalu["fecha_matricula"];
                         
                                                         $alu_real1=$recalu["a1"];       $alu_real2=$recalu["a2"];       $alu_real3=$recalu["a3"];        $alu_real4=$recalu["a4"];       $alu_real5=$recalu["a5"];      $alu_real6=$recalu["a6"];
                                                         $alu_asig1=$recalu["alu_1"];    $alu_asig2=$recalu["alu_2"];    $alu_asig3=$recalu["alu_3"];     $alu_asig4=$recalu["alu_4"];    $alu_asig5=$recalu["alu_5"];   $alu_asig6=$recalu["alu_6"];
                                                                                 
                                                        
                                                        
                                                        ?>
                                                        <div class="col-md-12"><img class="img-responsive" src="../images/logo_SEVGob.png" width="1024" ></div>

                                                        &nbsp;<br>
                                                        <div style="text-align:center" class="fbold">
                                                        SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ</br>	           
                                                        SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         </br>   
                                                        <div>COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA</div>
                                                        <div>PROGRAMA DE LIBROS DE TEXTO GRATUITOS</div>

                                                        <div style="padding:20px 5px 20px 5px; text-align:center; font-weight:bold"><h3>Validación de matrículas reportadas a esta Coordinación y a UPECE por el director del plantel </h3><h4>En el Ciclo Escolar <? echo $_SESSION["vg_cicloescolaranterior"]; ?></h4></div>
                                                        <div style="text-align:center"><h4><? echo $logeado."&emsp;&emsp; (".substr($_SESSION["vg_ctausr"],0,10)." -  turno ".substr($_SESSION["vg_ctausr"],10).")"; ?></h4></div><br>
                                                        <div style="text-align:center" class="ftext-red">Favor de analizar detalladamente las matrículas que reportó para ambas áreas el ciclo anterior </div><br>

                                                        <!-- Preferentemente use el teclado n&uacute;merico que se encuentra en la parte superior del teclado alfab&eacute;tico<br><br> -->
                                                        <table class="table fbold">
                                                                <tr bgcolor="#EBEBEB">
                                                                        <td></td>
                                                                        <td width="84" height="37" align="center"><div align="center">Primero</div></td><td width="81" align="center"><div align="center">Segundo</div></td><td width="92" align="center"><div align="center">Tercero</div></td>
                                                                        <? if (($elidnivel>39 && $elidnivel<60) || $regsanterior==0){ // $regsanterior Variable con numero de registros del ciclo anterior ?>
                                                                                <td width="85" align="center"><div align="center">Cuarto</div></td><td width="83" align="center"><div align="center">Quinto</div></td><td width="87" align="center"><div align="center">Sexto</div></td>
                                                                        <? } ?>
                                                                </tr>
                                                                <tr>
                                                                        <td width="30%"><span class="negra_16">Captura de matricula real de libros de texto gratuitos</span></td>
                                                                        <td height="33" style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["a1"],0); ?></div></td>
                                                                        <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["a2"],0); ?></div></td>
                                                                        <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["a3"],0); ?></div></td>
                                                                        <? if (($elidnivel>39 && $elidnivel<60) || $regsanterior==0){ // $regsanterior Variable con numero de registros del ciclo anterior    ?>
                                                                                <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["a4"],0); ?></div></td>
                                                                                <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["a5"],0); ?></div></td>
                                                                                <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["a6"],0); ?></div></td>
                                                                        <? } ?>        
                                                                </tr>  
                                                                <tr>
                                                                        <td style="vertical-align:middle"><span class="negra_16">Matricula reportada a la Unidad de Planeación, Evaluación y Control Educativo</span></td>
                                                                        <td height="33" style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["upc_1"],0); ?></div></td>
                                                                        <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["upc_2"],0); ?></div></td>
                                                                        <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["upc_3"],0); ?></div></td>
                                                                        <? if ($elidnivel>39 && $elidnivel<60){ ?>
                                                                                <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["upc_4"],0); ?></div></td>
                                                                                <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["upc_5"],0); ?></div></td>
                                                                                <td style="vertical-align:middle; font-size:18px"><div align="center"><? echo number_format($recalu["upc_6"],0); ?></div></td>
                                                                        <? } ?>        
                                                                </tr>                                                                                                                                
                                                                <tr><td colspan="7"><div align="center"></div></td></tr>
                                                        </table>
                                                        <div class="fcenter"><a href="<? echo $autollamada."qwerty=1&form"; ?>" class="fround fbold fpadding-medium fbutton fshad fgreen">Continuar a la captura</a></div><?
                                                }else{ 
                                                        ?>
                                                        <div class="col-md-12"><img class="img-responsive" src="../images/logo_SEVGob.png" width="1024" ></div>
                                                        <br><br>        
                                                        <div style="text-align:center" class="fbold">
                                                        SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ</br>	           
                                                        SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         </br>   
                                                        <div>COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA</div>
                                                        <div>PROGRAMA DE LIBROS DE TEXTO GRATUITOS</div>
                                                        <div align="center"> RECIBO DE REDISTRIBUCIÓN DE ESCUELA <? echo  strtoupper($titnivel); ?></div>
                                                        CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)</div>

                                                        <div style="padding:20px 5px 20px 5px; text-align:center; font-weigh:bold"><h3>Registro de matrícula actual</h3><h4>Ciclo escolar <? echo $_SESSION["vg_cicloescolar"]; ?></h4></div>
                                                        <div style="text-align:center"><h4><? echo $logeado."&emsp;&emsp; (".substr($_SESSION["vg_ctausr"],0,10)." -  turno ".substr($_SESSION["vg_ctausr"],10).")"; ?></h4></div><br>
                                                        <form name="frmactual" action="<? echo $autollamada; ?>qwerty=1&imprime=1&origen=1" method="post" onSubmit="return checa(1);">
                                                                <table class="table" width="900">
                                                                        <tr bgcolor="#EBEBEB">
                                                                                <td></td>
                                                                                <td width="84" height="37" align="center"><div align="center">Primero</div></td><td width="81" align="center"><div align="center">Segundo</div></td><td width="92" align="center"><div align="center">Tercero</div></td>
                                                                                <? if ($elidnivel>39 && $elidnivel<60){ ?>
                                                                                        <td width="85" align="center"><div align="center">Cuarto</div></td><td width="83" align="center"><div align="center">Quinto</div></td><td width="87" align="center"><div align="center">Sexto</div></td>
                                                                                <? } ?>
                                                                        </tr>
                                                                        <tr height="67">
                                                                                <td width="20%"><span class="negra_16">Alumnos</span></td>
                                                                                <td height="33"><div align="center"><input autofocus name="txt_primero" onKeyDown="return keynum(event);"  type="text" class="dis_input"  size="5" maxlength="3" onKeyPress="return enter(document.frmactual.txt_segundo);"></div></td>
                                                                                <td><div align="center"><input name="txt_segundo"  onKeyDown="return keynum(event);"  type="text" class="dis_input"  size="5" maxlength="3" onKeyPress="return enter(document.frmactual.txt_tercero);"></div></td>
                                                                                <td><div align="center"><input name="txt_tercero" onKeyDown="return keynum(event);"   type="text" class="dis_input"  size="5" maxlength="3" onKeyPress="return enter(document.frmactual.txt_cuarto);"></div></td>
                                                                                <? if ($elidnivel>39 && $elidnivel<60){ ?>
                                                                                        <td><div align="center"><input name="txt_cuarto" onKeyDown="return keynum(event);"   type="text" class="dis_input"  size="5" maxlength="3" onKeyPress="return enter(document.frmactual.txt_quinto);"></div></td>
                                                                                        <td><div align="center"><input name="txt_quinto"  onKeyDown="return keynum(event);"  type="text" class="dis_input"  size="5" maxlength="3" onKeyPress="return enter(document.frmactual.txt_sexto);"></div></td>
                                                                                        <td><div align="center"><input name="txt_sexto" onKeyDown="return keynum(event);"   type="text" class="dis_input"  size="5" maxlength="3" onKeyPress="return enter(document.frmactual.txt_primero2);"></div></td>
                                                                                <? } ?>        
                                                                        </tr>
                                                                        <tr><td colspan="7" height="60" style="vertical-align:middle"><div align="center" class="fbold"><span ><i>* Favor de verificar que los datos que ingresa sean correctos antes de dar clic en Registrar</i></span></div></td></tr>
                                                                        <div align="center"><tr align="center">  <td height="90" colspan="7" ><div align="center"><input name="cmd_procede2" type="submit" value="Registrar" class="btn btn-success ftext-white fbold" >&emsp;<input name="cmd_reset" type="reset" value="borrar" class="btn fgray"></div></td></tr></div>
                                                                        <tr><td height="24" colspan="7" >  <div  id="error" align="center"></div></td></tr>
                                                                </table>
                                                        </form>
                                                        <div class="fcenter"><a href="../_panel.php" class="fround fbold fpadding-medium fbutton fshad icon-left-1">Regresar</a></div><?
                                                }
                                        }else{
                                                fmessage(" Esta escuela no ha registrado matricula real ",3000,2,"../ingresosupervisor/recibo_matricula_zona.php?sel=escuela&arr_nivel=".$_GET["idnivel"]."|".$_GET["nivel"]);
                                        }    
                                }else{ // Muestra el BALANCE DE CAPTURA DE MATRICULA REAL 
                                        $resal=mysql_query("select id,idnivel,nivel,nom_ct,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6,fecha_matricula,day(fecha_matricula) as dia_fecha_matricula,upc_1,upc_2,upc_3,upc_4,upc_5,upc_6 from ctsev where CONCAT(cct,turno)='".$lallaveescuela."'"); 
                                        // echo "<br><br><br><br><br><br>select id,idnivel,nivel,nom_ct,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,a1,a2,a3,a4,a5,a6,fecha_matricula,day(fecha_matricula) as dia_fecha_matricula from ctsev where CONCAT(cct,turno)='".$lallaveescuela."'";
                                         $recalu=mysql_fetch_array($resal,MYSQL_ASSOC);
                                         $elidnivel=$recalu["idnivel"];
                                         $elnivel=$recalu["nivel"];
                                         $nombre=$recalu["nom_ct"];
                                         $fechamatriculareal=$recalu["fecha_matricula"];
         
                                         $alu_real1=$recalu["a1"];       $alu_real2=$recalu["a2"];       $alu_real3=$recalu["a3"];        $alu_real4=$recalu["a4"];       $alu_real5=$recalu["a5"];      $alu_real6=$recalu["a6"];
                                         $alu_asig1=$recalu["alu_1"];    $alu_asig2=$recalu["alu_2"];    $alu_asig3=$recalu["alu_3"];     $alu_asig4=$recalu["alu_4"];    $alu_asig5=$recalu["alu_5"];   $alu_asig6=$recalu["alu_6"];

                                        $procede=1; ?>
                                        <!-- <div class="frow fright ftransparent ftop fmargin"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div> -->
                                        <div class="frow ftop fpadding-tiny fleft-align"> <a name="Imprimir" class="icon-print fpadding-medium fred fround fbutton" onClick='doPrint()'> Imprimir</a>&emsp;<a name="regresar" href="<? echo $vl_back; ?>" class="icon-left-big fpadding-medium fred fround fbutton"> Regresar</a></div><br>
                                        <div class="col-md-12"><img class="img-responsive" src="../images/logo_SEVGob.png" width="1024" ></div> 
                                        <div style="text-align:center; margin-left:50px; margin-right:50px">
                                        <?	
                                        switch($origen){
                                                case 1:	// UPDATE DE LA CAPTURA DE MATRICULA REAL
                                                        $fechamatriculareal=date('Y-m-d');
                                                       // if((($txt_primero*1)+($txt_segundo*2)+($txt_tercero*3)+($txt_cuarto*1)+($txt_quinto*1)+($txt_sexto*1))==0){
                                                         //       fmessage(" NO Se registró ",3000,2,$autollamada."qwerty=1");
                                                           //     $procede=0;
                                                        //}else{
                                                                $act="update ctsev set a1=".($txt_primero*1).", a2=".($txt_segundo*1).", a3=".($txt_tercero*1);
                                                                if ($elidnivel>39 && $elidnivel<60){
                                                                        $act=$act.", a4=".($txt_cuarto*1).", a5=".($txt_quinto*1).", a6=".($txt_sexto*1);
                                                                }        
                                                                mysql_query($act.", fecha_matricula=NOW() where concat(cct,turno)='".$lallaveescuela."'");
                                                                fmessage(" Se ha registrado ",3000,2,$autollamada."qwerty=1&imprime=1");
                                                        //}
                                                case 3: 
                                                        $fechamatriculareal=$_SESSION["vg_fecha_matricula"];
                                                        $alu_asig1=$tot_alumnos_gpos[12];		$alu_asig2=$tot_alumnos_gpos[13];		$alu_asig3=$tot_alumnos_gpos[14];
                                                        $alu_asig4=$tot_alumnos_gpos[15];		$alu_asig5=$tot_alumnos_gpos[16];		$alu_asig6=$tot_alumnos_gpos[17];
                                                        $vl_g21=$tot_alumnos_gpos[18];		$vl_g22=$tot_alumnos_gpos[19];		$vl_g23=$tot_alumnos_gpos[20];
                                                        $vl_g24=$tot_alumnos_gpos[21];		$vl_g25=$tot_alumnos_gpos[22];		$vl_g26=$tot_alumnos_gpos[23];
                                                        break; 	
                                                case 8:
                                                        $vl_back="../ingresosupervisor/matricula_seguimiento.php?ejecucion=11&nivel=".$_GET["n"];
                                                        $nombre=$_GET["escuela"];
                                                        $lallaveescuela=$_GET["p_cct"];                                                        
                                                        $sql="select idnivel,alu_1,alu_2,alu_3,alu_4,alu_5,alu_6,gpo1,gpo2,gpo3,gpo4,gpo5,gpo6,a1,a2,a3,a4,a5,a6,g1,g2,g3,g4,g5,g6,fecha_matricula from ctsev where concat(cct,turno)='".$lallaveescuela."'";
                                                        //echo $sql;
                                                        $res=mysql_query($sql);
                                                        $recmat=mysql_fetch_array($res);
                                                        $alu_asig1=$recmat["a1"];		$alu_asig2=$recmat["a2"];		$alu_asig3=$recmat["a3"];
                                                        $alu_asig4=$recmat["a4"];		$alu_asig5=$recmat["a5"];		$alu_asig6=$recmat["a6"];
                                                        $vl_g21=$recmat["g1"];		$vl_g22=$recmat["g2"];		$vl_g23=$recmat["g3"];
                                                        $vl_g24=$recmat["g4"];		$vl_g25=$recmat["g5"];		$vl_g26=$recmat["g6"];
                                                        $fechamatriculareal=$recmat["fecha_matricula"];
                                                        break;																
                                        }	





                                        if ($origen==8){ 
                                                $alu_real1=$recmat["alu_1"]; 
                                                $alu_real2=$recmat["alu_2"]; 
                                                $alu_real3=$recmat["alu_3"];
                                                $alu_real4=$recmat["alu_4"]; 
                                                $alu_real5=$recmat["alu_5"]; 
                                                $alu_real6=$recmat["alu_6"];
                                                $losgrupos1=$recmat["gpo1"];
                                                $losgrupos2=$recmat["gpo2"];
                                                $losgrupos3=$recmat["gpo3"];
                                                $losgrupos4=$recmat["gpo4"];
                                                $losgrupos5=$recmat["gpo5"];
                                                $losgrupos6=$recmat["gpo6"];
                                                $elnivel=$recmat["idnivel"];										
                                        }
                                        $titnivel=str_replace("Estatal","",$recalu["nivel"]);
                                        $titnivel=str_replace("Federal","",$titnivel);
                                        $titnivel=str_replace("-Estatal","",$titnivel);
                                        $titnivel=str_replace("-Federal","",$titnivel);

                                        if($procede==1){
                                            ?>&nbsp;<br>
                                            SECRETAR&Iacute;A DE EDUCACI&Oacute;N DE VERACRUZ</br>	           
                                            SUBSECRETAR&Iacute;A DE DESARROLLO EDUCATIVO	         </br>   
                                            <div>COORDINACI&Oacute;N ESTATAL DE APOYO PARA LA MEJORA EDUCATIVA</div>
                                            <div>PROGRAMA DE LIBROS DE TEXTO GRATUITOS</div>
                                            <div align="center"> RECIBO DE REDISTRIBUCIÓN DE ESCUELA <? echo  strtoupper($titnivel); ?></div>
                                            CICLO ESCOLAR (<?php echo $_SESSION["vg_cicloescolar"]; ?>)

                                            <h5><b>BALANCE DE CAPTURA DE MATRICULA REAL</b></h5>

                                            <table class="table table-bordered">
                                                    <tr><td width="60%"><? echo $nombre; ?></td>
                                                    <td><? echo substr($lallaveescuela,0,10)." - Turno ".substr($lallaveescuela,10); ?></td>
                                            </tr></table>

                                            <table class="table" >
                                                    <tr bgcolor="#EBEBEB"><td width="79"></td><td width="95" height="30" align="center"><div align="center">Primero</div></td><td width="109" align="center"><div align="center">Segundo</div></td><td width="109" align="center"><div align="center">Tercero</div></td>
                                                            <? if ($elidnivel>39 && $elidnivel<60){ ?>
                                                                    <td width="94" align="center"><div align="center">Cuarto</div></td><td width="105" align="center"><div align="center">Quinto</div></td><td width="119" align="center"><div align="center">Sexto</div></td>
                                                            <? } ?>        
                                                    </tr>


                                                    <tr>
                                                            <td style="text-align:left; height:50px; vertical-align:middle">Matricula Asignada</td>
                                                            <td style="vertical-align:middle" height="33"><div align="center"><?php echo $alu_asig1; ?></div></td>
                                                            <td style="vertical-align:middle"><div align="center"><?php echo $alu_asig2; ?></div></td>
                                                            <td style="vertical-align:middle"><div align="center"><?php echo $alu_asig3; ?></div></td>
                                                            <? if ($elidnivel>39 && $elidnivel<60){ ?>
                                                                    <td style="vertical-align:middle"><div align="center"><?php echo $alu_asig4; ?></div></td>
                                                                    <td style="vertical-align:middle"><div align="center"><?php echo $alu_asig5; ?></div></td>
                                                                    <td style="vertical-align:middle"><div align="center"><?php echo $alu_asig6; ?></div></td>
                                                            <? } ?>        
                                                    </tr>

                                                    

                                                    <tr>
                                                            <td style="text-align:left; width:27%">Matricula Real<br><small>Fecha captura<br><?php echo fechalarga($fechamatriculareal); ?></small></td>
                                                            <td height="33" style="vertical-align:middle"><div align="center"><?php echo $alu_real1; ?></div></td>
                                                            <td style="vertical-align:middle"><div align="center" ><?php echo $alu_real2; ?></div></td>
                                                            <td style="vertical-align:middle"><div align="center"><?php echo $alu_real3; ?></div></td>
                                                            <? if ($elidnivel>39 && $elidnivel<60){ ?>
                                                                    <td style="vertical-align:middle"><div align="center"><?php echo $alu_real4; ?></div></td>
                                                                    <td style="vertical-align:middle"><div align="center"><?php echo $alu_real5; ?></div></td>
                                                                    <td style="vertical-align:middle"><div align="center"><?php echo $alu_real6; ?></div></td>
                                                            <? } ?>       
                                                    </tr>															 
                                                                                                                                    


                                                    <tr height="40"><td colspan="7"><div align="center" >Conciliación entre matrícula asignada y matrícula real </div></td></tr>
                                                    <tr><td style="text-align:left">Resultado</td><td><div align="center"><?php echo ($alu_asig1-$alu_real1); ?></div></td>
                                                            <td><div align="center"><?php echo ($alu_asig2-$alu_real2); ?></div></td>
                                                            <td><div align="center"><?php echo ($alu_asig3-$alu_real3); ?></div></td>
                                                            <? if ($elidnivel>39 && $elidnivel<60){ ?>
                                                                    <td><div align="center"><?php echo ($alu_asig4-$alu_real4); ?></div></td>
                                                                    <td><div align="center"><?php echo ($alu_asig5-$alu_real5); ?></div></td>
                                                                    <td><div align="center"><?php echo ($alu_asig6-$alu_real6); ?></div></td>
                                                            <? } ?>        
                                                    </tr>	
                                            </table>
                                            <table width="100%"><tr>
                                                    <td style="width:51%; padding:10px 30px; background:#F4FDE0; text-align:left"><i><small>* Si la diferencia de matr&iacute;cula es positiva<br>la cantidad se refiere al n&uacute;mero de paquetes<br>de libros que debe devolver el Plantel.</small></i></td>
                                                    <td style="width:49%; padding:10px 30px; background:#FDE0E0; text-align:left"><i><small>* Si la diferencia de matr&iacute;cula es negativa (-)<br>la cantidad se refiere al n&uacute;mero de paquetes<br>de libros que deberá recibir el Plantel.</small></i></td>
                                            </tr></table><br>
                                            <?  echo PieRecibo("LTG".number_format($recalu["id"],0),"qr_matricula_".$elnivel."/",$elidnivel);
                                        }// fin de $procede 
                                }
                                break;
                            case 5:
                                    ?><div class="col-md-12"><img class="img-responsive" src="../images/logo_SEVGob.png" width="1024" ></div><?
                                    echo "<br><span class='negra_24'>(".substr($vg_ctausr,0,10)." - ".substr($vg_ctausr,10).") Ciclo Escolar ".$_SESSION["vg_cicloescolar"]."</span><br>";
                                    $vercols="v|v|v|v|v|v|v|v|v|v|v|v|v|v";
                                    $anchogrid="900";
                                    $_sql="select A1,A2,A3,A4,A5,A6,(a1+a2+a3+a4+a5+a6) as Alumnos,G1,G2,G3,G4,G5,G6,(g1+g2+g3+g4+g5+g6) as Grupos from ctsev where concat(cct,turno)='$vg_ctausr'";		
                                    $actual="NO";		
                                            $subtitulo1="TEXTO|Matricula registrada por el plantel al inicio de cursos";	
                                            $subtitulo2="";
                                            $subtitulo3="";
                                            $vertotregs="NO";	
                                    gridfer2012($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_verde","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3,"","otraventana");

                                    echo "<br>";	
                                    $vercols="I|V|v|V|V|V|V|V|V";
                                    $anchogrid="1050";
                                    $_sql="select fecha,Tipo as Tipo_de_movimiento,date_format(fecha,'%d - %b - %Y') as Fecha_Reg,c1 as Grado_1,c2 as Grado_2,c3 as Grado_3,c4 as Grado_4,c5 as Grado_5,c6 as Grado_6 from ctsev_mov_matricula where concat(cct,turno)='$vg_ctausr' and ciclo='".$_SESSION["vg_cicloescolar"]."'";		
                                    // echo $_sql;
                                    $actual="Eliminar|".$autollamada."origen=baja&qwerty=6";		
                                    $subtitulo1="TEXTO|Actualizaciones a la matricula";	
                                    $vertotregs="NO";	
                                    gridfer2012($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_verde","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3);
                                    $sr1=$tot_alumnos_gpos[12];		$sr2=$tot_alumnos_gpos[13];		$sr3=$tot_alumnos_gpos[14];
                                    $sr4=$tot_alumnos_gpos[15];		$sr5=$tot_alumnos_gpos[16];		$sr6=$tot_alumnos_gpos[17];
                                    //echo  "select sum(c1) as g1,sum(c2) as g2,sum(c3) as g3,sum(c4) as g4,sum(c5) as g5,sum(c6) as g6 from ctsev_mov_matricula where tipo in ('Alta de alumnos sin libros','Alta de alumnos con libros','Baja de alumnos') and concat(cct,turno)='".$vg_ctausr."'";
                                    $movimientos=mysql_query("select sum(c1) as g1,sum(c2) as g2,sum(c3) as g3,sum(c4) as g4,sum(c5) as g5,sum(c6) as g6 from ctsev_mov_matricula where tipo in ('Alta de alumnos sin libros','Alta de alumnos con libros','Baja de alumnos') and concat(cct,turno)='".$vg_ctausr."' and ciclo='".$_SESSION["vg_cicloescolar"]."'");
                                    $recmov=mysql_fetch_array($movimientos,MYSQL_ASSOC);	
                                    $sr1=$sr1+$recmov["g1"];		$sr2=$sr2+$recmov["g2"];		$sr3=$sr3+$recmov["g3"];
                                    $sr4=$sr4+$recmov["g4"];		$sr5=$sr5+$recmov["g5"];		$sr6=$sr6+$recmov["g6"];

                                    $sg1=$tot_alumnos_gpos[18];		$sg2=$tot_alumnos_gpos[19];		$sg3=$tot_alumnos_gpos[20];
                                    $sg4=$tot_alumnos_gpos[21];		$sg5=$tot_alumnos_gpos[22];		$sg6=$tot_alumnos_gpos[23];
                                    //echo "select sum(c1) as g1,sum(c2) as g2,sum(c3) as g3,sum(c4) as g4,sum(c5) as g5,sum(c6) as g6 from ctsev_mov_matricula where tipo not in ('Alta de alumnos sin libros','Alta de alumnos con libros','Baja de alumnos') and concat(cct,turno)='".$vg_ctausr."'";
                                    $movimientos=mysql_query("select sum(c1) as g1,sum(c2) as g2,sum(c3) as g3,sum(c4) as g4,sum(c5) as g5,sum(c6) as g6 from ctsev_mov_matricula where tipo not in ('Alta de alumnos sin libros','Alta de alumnos con libros','Baja de alumnos') and concat(cct,turno)='".$vg_ctausr."' and ciclo='".$_SESSION["vg_cicloescolar"]."'" );
                                    $recmov=mysql_fetch_array($movimientos,MYSQL_ASSOC);	
                                    $sg1=$sg1+$recmov["g1"];		$sg2=$sg2+$recmov["g2"];		$sg3=$sg3+$recmov["g3"];
                                    $sg4=$sg4+$recmov["g4"];		$sg5=$sg5+$recmov["g5"];		$sg6=$sg6+$recmov["g6"];
                                    ?>
                                    <br><span class='negra_20'>Matricula Real al <?php echo fechalarga(date('Y-m-d')); ?></span><br>
                                    <br>
                                    <table class="table table-condensed table-bordered">
                                            <tr><td width="33" align='center' bgcolor='#FFEAAA'>
                                                    <font><b>A1</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A2</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A3</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A4</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A5</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A6</b></font></td>
                                                    <td width="87" align='center' bgcolor='#FFEAAA'><font ><b>Alumnos</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G1</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G2</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G3</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G4</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G5</b></font></td>
                                                    <td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G6</b></font></td>
                                                    <td width="84" align='center' bgcolor='#FFEAAA'><font ><b>Grupos</b></font></td></tr>
                                            <tr><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr1; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr2; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr3; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr4; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr5; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr6; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr1+$sr2+$sr3+$sr4+$sr5+$sr6; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg1; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg2; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg3; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg4; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg5; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg6; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg1+$sg2+$sg3+$sg4+$sg5+$sg6; ?></font></td></tr>
                                    </table><br>             
                                    <div id='nopasa'><span class="verde_20">Registre &uacute;nicamente los incrementos o decrementos de la matricula real</span>
                                            <table class="table">
                                                    <tr>
                                                            <td width="479">    
                                                                    <div id="dis_formulario">
                                                                            <form name="frmactual" action="<? echo $autollamada; ?>qwerty=6" method="post" enctype="multipart/form-data"  onSubmit="return checa(3)";>
                                                                                    <input type="hidden" name="hid_sr1" value="<?php echo $sr1; ?>">
                                                                                    <input type="hidden" name="hid_sr2" value="<?php echo $sr2; ?>">
                                                                                    <input type="hidden" name="hid_sr3" value="<?php echo $sr3; ?>">
                                                                                    <input type="hidden" name="hid_sr4" value="<?php echo $sr4; ?>">
                                                                                    <input type="hidden" name="hid_sr5" value="<?php echo $sr5; ?>">
                                                                                    <input type="hidden" name="hid_sr6" value="<?php echo $sr6; ?>">

                                                                                    <input type="hidden" name="hid_sg1" value="<?php echo $sg1; ?>">
                                                                                    <input type="hidden" name="hid_sg2" value="<?php echo $sg2; ?>">
                                                                                    <input type="hidden" name="hid_sg3" value="<?php echo $sg3; ?>">
                                                                                    <input type="hidden" name="hid_sg4" value="<?php echo $sg4; ?>">
                                                                                    <input type="hidden" name="hid_sg5" value="<?php echo $sg5; ?>">
                                                                                    <input type="hidden" name="hid_sg6" value="<?php echo $sg6; ?>">
                                                                                    <table class="table">
                                                                                            <tr>
                                                                                                    <td width="187" height="98">Tipo de registro :</td>
                                                                                                    <td width="356"><input type="radio" name="rad_escoge" value="A">
                                                                                                            Alta de alumnos con libros
                                                                                                            <br><input type="radio" name="rad_escoge" value="N">
                                                                                                            Alta de alumnos sin libros
                                                                                                            <br><input type="radio" name="rad_escoge" value="B">																    
                                                                                                            Baja de alumnos
                                                                                                                    <br><!--<input type="radio" name="rad_escoge" value="G">
                                                                                                                    Alta de grupo
                                                                                                                            <br><input type="radio" name="rad_escoge" value="Q">
                                                                                                            Baja de grupo -->
                                                                                                    </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                    <td width="187" height="43" align="center">Grado<select name="sel_grado" onChange="(document.frmactual.txt_cantidad.focus());" class="dis_input">
                                                                                                            <option value='0'>[Grado]</option> 
                                                                                                            <option value='1'>Primero</option>
                                                                                                            <option value='2'>Segundo</option>
                                                                                                            <option value='3'>Tercero</option>
                                                                                                            <option value='4'>Cuarto</option>
                                                                                                            <option value='5'>Quinto</option>
                                                                                                            <option value='6'>Sexto</option>
                                                                                                            </select></td> 
                                                                                                    <td width="356" align="center">Cantidad 

                                                                                                            <select name="txt_cantidad" id="txt_cantidad">
                                                                                                            <option value='1'>1</option>
                                                                                                            <option value='2'>2</option>
                                                                                                            <option value='3'>3</option>
                                                                                                            <option value='4'>4</option>
                                                                                                            <option value='5'>5</option>

                                                                                                            </select>
                                                                                                            <!--<input type="text" onKeyDown="return keynum(event);" name="txt_cantidad"  size="10" onKeyPress="return enter(document.frmactual.cmd_procede);" > -->
                                                                                                    </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                    <td colspan=4><div align="center">
                                                                                                            <input name="cmd_procede" type="submit" value="procede" class="btn btn-success" />
                                                                                                            <input name="cmd_reset" type="reset" value="borrar" class="btn btn-danger" /></div>
                                                                                                    </td>
                                                                                            </tr> 
                                                                                            <tr><td height="20" colspan="4" align="center"><div align="center"><div  id="error3"></div></td></tr>
                                                                                    </table>
                                                                            </form>
                                                                    </div>
                                                            </td>
                                                            <td width="424"><div align="left">
                                                                    <b >Alta de alumnos con libros</b><br><em > Alumnos que llegan a su escuela, y que traen sus libros completos (generalmente son alumnos de traslado)</em><br>
                                                                    <b >Alta de alumnos sin libros</b><br><em > Alumnos que llegan a su escuela, y que NO traen sus libros  (generalmente alumnos de nuevo ingreso)</em><br></div>                                            
                                                            </td>
                                                    </tr>
                                            </table><br>
                                            <!--<input type="button" class="btn btn-default" value="   Imprimir   " name="cmdPrint" onClick="doPrint();"> -->
                                            <input type="button" class="btn btn-default" value="   Regresar   " name="cmdback" onClick="cl('../_panel.php');"> 
                                    </div> <br><br>         <?php
                                    break;
                            case 6:
                                    $vl_nopasa="";
                                    if (isset($origen)){
                                            $arr_mikey=explode("|",oculta($mikey,1));
                                            $q="delete from ctsev_mov_matricula where concat(cct,turno)='$vg_ctausr' and fecha='".$arr_mikey[0]."' and tipo='".$arr_mikey[1]."' and c1=".$arr_mikey[2]." and c2=".$arr_mikey[3]." and c3=".$arr_mikey[4]." and c4=".$arr_mikey[5]." and c5=".$arr_mikey[6]." and c6=".$arr_mikey[7]." and ciclo ='".$_SESSION["vg_cicloescolar"]."'";
                                            $quepone="Eliminado";
                                    }else{
                                            $quepone="Registrado";
                                            switch($rad_escoge){
                                                    case "A";
                                                            $escoge="Alta de alumnos con libros";
                                                            $vl_atendido="X";
                                                            break;	
                                                    case "N";
                                                            $escoge="Alta de alumnos sin libros";
                                                            $vl_atendido="N";
                                                            break;	
                                                    case "B";
                                                            $escoge="Baja de alumnos";
                                                            $vl_atendido="X";
                                                            $txt_cantidadelim=$txt_cantidad;
                                                            $txt_cantidad=$txt_cantidad * -1;
                                                            break;	
                                                    case "G";
                                                            $escoge="Alta de Grupo";
                                                            $vl_atendido="N";
                                                            break;	
                                                    case "Q";
                                                            $escoge="Baja de Grupo";
                                                            $vl_atendido="X";
                                                            $txt_cantidadelim=$txt_cantidad;
                                                            $txt_cantidad=$txt_cantidad * -1;
                                                            break;	
                                            }
                                            switch($sel_grado){
                                                    case "1":
                                                                    $datos=$txt_cantidad.",0,0,0,0,0";	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr1){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de primer grado<br>Puesto que actualmente cuenta con $hid_sr1 alumnos en ese grado"; }
                                                                    if ($rad_escoge=="Q" and $txt_cantidadelim>$hid_sg1){$vl_nopasa="No puede registrar $txt_cantidadelim grupos para dar de baja de primer grado<br>Puesto que actualmente cuenta con $hid_sg1 grupos en ese grado"; }
                                                                    break;	
                                                    case "2":
                                                                    $datos="0,".$txt_cantidad.",0,0,0,0";	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr2){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de segundo grado<br>Puesto que actualmente cuenta con $hid_sr2 alumnos en ese grado"; }
                                                                    if ($rad_escoge=="Q" and $txt_cantidadelim>$hid_sg2){$vl_nopasa="No puede registrar $txt_cantidadelim grupos para dar de baja de segundo grado<br>Puesto que actualmente cuenta con $hid_sg2 grupos en ese grado"; }
                                                                    break;	
                                                    case "3":
                                                                    $datos="0,0,".$txt_cantidad.",0,0,0";	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr3){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de tercer grado<br>Puesto que actualmente cuenta con $hid_sr3 alumnos en ese grado"; }
                                                                    if ($rad_escoge=="Q" and $txt_cantidadelim>$hid_sg3){$vl_nopasa="No puede registrar $txt_cantidadelim grupos para dar de baja de tercer grado<br>Puesto que actualmente cuenta con $hid_sg3 grupos en ese grado"; }
                                                                    break;	
                                                    case "4":
                                                                    $datos="0,0,0,".$txt_cantidad.",0,0";	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr4){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de cuarto grado<br>Puesto que actualmente cuenta con $hid_sr4 alumnos en ese grado"; }
                                                                    if ($rad_escoge=="Q" and $txt_cantidadelim>$hid_sg4){$vl_nopasa="No puede registrar $txt_cantidadelim grupos para dar de baja de cuarto grado<br>Puesto que actualmente cuenta con $hid_sg4 grupos en ese grado"; }
                                                                    break;	
                                                    case "5":
                                                                    $datos="0,0,0,0,".$txt_cantidad.",0";	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr5){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de quinto grado<br>Puesto que actualmente cuenta con $hid_sr5 alumnos en ese grado"; }
                                                                    if ($rad_escoge=="Q" and $txt_cantidadelim>$hid_sg5){$vl_nopasa="No puede registrar $txt_cantidadelim grupos para dar de baja de quinto grado<br>Puesto que actualmente cuenta con $hid_sg5 grupos en ese grado"; }
                                                                    break;	
                                                    case "6":
                                                                    $datos="0,0,0,0,0,".$txt_cantidad;	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr6){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de sexto grado<br>Puesto que actualmente cuenta con $hid_sr6 alumnos en ese grado"; }
                                                                    if ($rad_escoge=="Q" and $txt_cantidadelim>$hid_sg6){$vl_nopasa="No puede registrar $txt_cantidadelim grupos para dar de baja de sexto grado<br>Puesto que actualmente cuenta con $hid_sg6 grupos en ese grado"; }
                                                                    break;	
                                            }
                                            if ($datos!="0,0,0,0,0,0"){
                                            //$q="INSERT INTO ctsev_mov_matricula (cct,turno,c1,c2,c3,c4,c5,c6,fecha,tipo,cct_zona,atendido,ciclo) VALUES ('".substr($vg_ctausr,0,10)."','".substr($vg_ctausr,10)."',".$datos.",CURRENT_TIMESTAMP(),'$escoge','$vg_cct_zona','$vl_atendido','".$_SESSION["vg_cicloescolar"]."')";
                                            }
                                    }
                                    if ($vl_nopasa<>""){
                                            echo "<br><br><br><span class='negra_22'>$vl_nopasa</span><br><br><br><br><br><br>	";
                                            $vl_back=$autollamada."qwerty=5&imprime=1";
                                    } else {
                                            if (mysql_query($q)){
                                                    echo "<br><br><br><span class='negra_22'>$quepone</span><br><br><br><br><br><br>	";?> 
                                                    <script languaje="javascript" type="text/JavaScript"> 
                                                            cl("<? echo $autollamada; ?>qwerty=5&imprime=1"); 
                                                    </script> <?php 																	
                                            }
                                    }
                                    break;			
                            case 25:
                                    echo "<br><span class='negra_24'>(".substr($vg_ctausr,0,10)." - ".substr($vg_ctausr,10).") Ciclo Escolar ".$_SESSION["vg_cicloescolar"]."</span><br>";
                                    $vercols="v|v|v|v";
                                    $anchogrid="550";
                                    if ($vg_idnivel==60 or $vg_idnivel==61 or $vg_idnivel==65){  
                                                    $_sql="select a1,a2,a3,(a1+a2+a3) as Alumnos from ctsev_secundarias where concat(cct,turno)='$vg_ctausr'";		
                                    }else{
                                                    $_sql="select a1,a2,a3,(a1+a2+a3) as Alumnos from ctsev where concat(cct,turno)='$vg_ctausr'";		
                                    }
                                    $actual="NO";		
                                    $subtitulo1="TEXTO|Matricula registrada por el plantel al inicio de cursos";
                                    $subtitulo2="";
                                    $subtitulo3="";
                                    $vertotregs="NO";	
                                    gridfer2012($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_verde","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3,"","otraventana");
                                    echo "<br>";
                                    $vercols="I|V|v|V|V|V";
                                    $anchogrid="800";
                                    $_sql="select fecha,Tipo as Tipo_de_movimiento,date_format(fecha,'%d - %b - %Y') as Fecha_Reg,c1 as Grado_1,c2 as Grado_2,c3 as Grado_3 from ctsev_mov_matricula where concat(cct,turno)='$vg_ctausr' and ciclo='".$_SESSION["vg_cicloescolar"]."'";		
                                    $actual="Eliminar|".$autollamada."qwerty=26&origen=baja";	
                                    $subtitulo1="TEXTO|Actualizaciones a la matricula";	
                                    $vertotregs="NO";	
                                    gridfer2012($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_verde","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3);
                                    echo "<br>";
                                    $sr1=$tot_alumnos_gpos[12];		
                                    $sr2=$tot_alumnos_gpos[13];		
                                    $sr3=$tot_alumnos_gpos[14];
                                    $movimientos=obten_movimientos($vg_ctausr,$_SESSION["vg_cicloescolar"]);
                                    $sr1=$sr1+$movimientos[0];		
                                    $sr2=$sr2+$movimientos[1];		
                                    $sr3=$sr3+$movimientos[2];
                                    ?><br>
                                    <span class='negra_20'>Matricula Real al <?php echo fechalarga(date('Y-m-d')); ?></span><br><br>
                                    <table class="table">
                                            <tr>
                                            <td width="70" align='center' bgcolor='#FFEAAA'><font ><b>A1</b></font></td>
                                            <td width="70" align='center' bgcolor='#FFEAAA'><font ><b>A2</b></font></td>
                                            <td width="70" align='center' bgcolor='#FFEAAA'><font ><b>A3</b></font></td>
                                            <td width="120" align='center' bgcolor='#FFEAAA'><font ><b>Alumnos</b></font></td>
                                    </tr>
                                            <tr><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr1; ?></font></td>
                                            <td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr2; ?></font></td>
                                            <td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr3; ?></font></td>
                                            <td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr1+$sr2+$sr3; ?></font></td></tr>
                                    </table> 
                                    <br> 
                                    <div id='nopasa'>
                                            <span class="verde_20">Registre &uacute;nicamente los incrementos o decrementos de la matricula real</span><br>
                                            <table class="table">
                                                    <tr>
                                                            <td width="466">  
                                                                    <div id="dis_formulario">
                                                                            <form name="frmactual" action="<? echo $autollamada; ?>qwerty=26" method="post" enctype="multipart/form-data"  onSubmit="return checa(31)";>
                                                                                    <input type="hidden" name="hid_sr1" value="<?php echo $sr1; ?>">
                                                                                    <input type="hidden" name="hid_sr2" value="<?php echo $sr2; ?>">
                                                                                    <input type="hidden" name="hid_sr3" value="<?php echo $sr3; ?>">

                                                                                    <input type="hidden" name="hid_sg1" value="<?php echo $sg1; ?>">
                                                                                    <input type="hidden" name="hid_sg2" value="<?php echo $sg2; ?>">
                                                                                    <input type="hidden" name="hid_sg3" value="<?php echo $sg3; ?>">
                                                                                    <table class="table">
                                                                                            <tr>
                                                                                                    <td width="151" height="98">Tipo de registro :</td>
                                                                                                    <td width="327">
                                                                                                            <input type="radio" name="rad_escoge" value="A"> Alta de alumnos con libros
                                                                                                            <br><input type="radio" name="rad_escoge" value="N">Alta de alumnos sin libros
                                                                                                            <br><input type="radio" name="rad_escoge" value="B">Baja de alumnos
                                                                                                    </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                    <td width="151" height="43" align="center">Grado
                                                                                                            <select name="sel_grado" onChange="(document.frmactual.txt_cantidad.focus());" class="dis_input">
                                                                                                            <option value='0'>[Grado]</option> 
                                                                                                            <option value='1'>Primero</option>
                                                                                                            <option value='2'>Segundo</option>
                                                                                                            <option value='3'>Tercero</option>
                                                                                                            </select></td> 
                                                                                                    <td width="327" align="center">Cantidad 
                                                                                                            <select name="txt_cantidad" id="txt_cantidad">
                                                                                                            <option value='1'>1</option>
                                                                                                            <option value='2'>2</option>
                                                                                                            <option value='3'>3</option>
                                                                                                            <option value='4'>4</option>
                                                                                                            <option value='5'>5</option>
                                                                                                            </select>
                                                                                                            <!--<input type="text" onKeyDown="return keynum(event);" name="txt_cantidad"  size="10" onKeyPress="return enter(document.frmactual.cmd_procede);" > -->
                                                                                                    </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                    <td colspan=4>
                                                                                                            <div align="center">
                                                                                                                    <input name="cmd_procede" type="submit" value="procede" class="btn btn-success" />
                                                                                                                    <input name="cmd_reset" type="reset" value="borrar" class="btn btn-danger" />
                                                                                                            </div>
                                                                                                    </td>
                                                                                            </tr> 
                                                                                            <tr>
                                                                                                    <td height="20" colspan="4" align="center"><div align="center"><div  id="error3"></div></td>
                                                                                            </tr>
                                                                                    </table>
                                                                            </form>
                                                                    </div>
                                                            </td>
                                                            <td width="422">
                                                                    <div align="left">
                                                                            <b >Alta de alumnos con libros</b><br><em> Alumnos que llegan a su escuela, y que traen sus libros completos (generalmente son alumnos de traslado)</em><br>
                                                                            <b >Alta de alumnos sin libros</b><br><em > Alumnos que llegan a su escuela, y que NO traen sus libros  (generalmente alumnos de nuevo ingreso)</em><br>                                            
                                                                    </div>
                                                            </td>
                                                    </tr>        
                                            </table><br>
                                            <input type="button"  class="btn btn-default" value="   Imprimir   " name="cmdPrint" onClick="doPrint();"> 
                                            <input type="button" class="btn btn-default" value="   Regresar   " name="cmdback" onClick="cl('../_panel.php');"> 
                                    </div> <?php
                                    break;

                            case 26:
                                    $vl_nopasa="";
                                    if (isset($origen)){
                                            $arr_mikey=explode("|",oculta($mikey,1));
                                            $q="delete from ctsev_mov_matricula where concat(cct,turno)='$vg_ctausr' and fecha='".$arr_mikey[0]."' and tipo='".$arr_mikey[1]."' and c1=".$arr_mikey[2]." and c2=".$arr_mikey[3]." and c3=".$arr_mikey[4];
                                            $quepone="Eliminado";
                                    }else{
                                            $quepone="Registrado";
                                            switch($rad_escoge){
                                                    case "A";
                                                            $escoge="Alta de alumnos con libros";
                                                            $vl_atendido="X";
                                                            break;	
                                                    case "N";
                                                            $escoge="Alta de alumnos sin libros";
                                                            $vl_atendido="N";
                                                            break;	
                                                    case "B";
                                                            $escoge="Baja de alumnos";
                                                            $vl_atendido="X";
                                                            $txt_cantidadelim=$txt_cantidad;
                                                            $txt_cantidad=$txt_cantidad * -1;
                                                            break;	
                                            }
                                            switch($sel_grado){
                                                    case "1":
                                                                    $datos=$txt_cantidad.",0,0,0,0,0";	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr1){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de primer grado<br>Puesto que actualmente cuenta con $hid_sr1 alumnos en ese grado"; }
                                                                    break;	
                                                    case "2":
                                                                    $datos="0,".$txt_cantidad.",0,0,0,0";	
                                                                    if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr2){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de segundo grado<br>Puesto que actualmente cuenta con $hid_sr2 alumnos en ese grado"; }																	  
                                                                    break;	
                                                    case "3":
                                                                    $datos="0,0,".$txt_cantidad.",0,0,0";	
                                                                            if ($rad_escoge=="B" and $txt_cantidadelim>$hid_sr3){	$vl_nopasa="No puede registrar $txt_cantidadelim alumnos para dar de baja de tercer grado<br>Puesto que actualmente cuenta con $hid_sr3 alumnos en ese grado"; }																	  
                                                            break;	
                                            }
                                            if ($datos!="0,0,0,0,0,0"){
                                                  //  $q="INSERT INTO ctsev_mov_matricula (cct,turno,c1,c2,c3,c4,c5,c6,fecha,tipo,cct_zona,atendido,ciclo) VALUES ('".substr($vg_ctausr,0,10)."','".substr($vg_ctausr,10)."',".$datos.",CURRENT_TIMESTAMP(),'$escoge','$vg_cct_zona','$vl_atendido','".$_SESSION["vg_cicloescolar"]."')";
                                            }
                                    }
                                    if ($vl_nopasa<>""){
                                                    echo "<br><br><br><span class='negra_22'>$vl_nopasa</span><br><br><br><br><br><br>	";
                                                    $vl_back=$autollamada."qwerty=25&imprime=1";
                                    } else {
                                                    if (mysql_query($q)){
                                                                    echo "<br><br><br><span class='negra_22'>$quepone</span><br><br><br><br><br><br>";
                                                                    ?> 
                                                                                            <script languaje="javascript" type="text/JavaScript"> 
                                                                                                    cl("<? echo $autollamada; ?>qwerty=25&imprime=1"); 
                                                                                                            </script> 
                                                            <?php 																	
                                                    }
                                    }
                                    break;
                            case 50:   ?>
                                    <form enctype='multipart/form-data' action='<? echo $autollamada; ?>qwerty=51' onSubmit="return checa(50);" name="frmactual" method='post'>
                                            <table class="table">
                                                    <tr><td colspan="2" height="16" width="100%" bordercolor="#FFFFFF" background="../../img_formas/titulo_sub_gris.gif" align="center"> <b><font face="Verdana" size="2" color="#000000"><!- Aqui va el subencabezado--> Modificacion Matricula </font></b></td></tr>
                                                    <tr><td colspan="2" bgcolor="#CACACA" height="16" width="100%" bordercolor="#FFFFFF" align="right"><font size="1" face="Verdana"><i>Los datos marcados con (*) son obligatorios</i></font></td></tr>
                                                    <tr><td height="30" width="189" bgcolor="#EEEEEE" bordercolor="#FFFFFF"><font face="Verdana" size="2">Clave</font></td>
                                                    <td height="30" width="469" bgcolor="#EEEEEE" bordercolor="#FFFFFF">
                                                                    <script language="JavaScript">
                                                                            function PosEnd(end) {
                                                                                    var len = end.value.length;
                                                                                    
                                                                                    // Mostly for Web Browsers
                                                                                    if (end.setSelectionRange) {
                                                                                            end.focus();
                                                                                            end.setSelectionRange(len, len);
                                                                                    } else if (end.createTextRange) {
                                                                                            var t = end.createTextRange();
                                                                                            t.collapse(true);
                                                                                            t.moveEnd('character', len);
                                                                                            t.moveStart('character', len);
                                                                                            t.select();
                                                                                    }
                                                                            }
                                                                    </script>
                                                                    <font face="Verdana"><input type=text name='txt_Clave' value="30" autofocus onfocus="PosEnd(txt_Clave);" onKeyDown="quita();"></font>*
                                                    </td>
                                                    </tr>
                                                    <tr><td height="30" width="189" bgcolor="#EEEEEE" bordercolor="#FFFFFF"><font face="Verdana" size="2">Turno</font></td><td height="30" width="469" bgcolor="#EEEEEE" bordercolor="#FFFFFF"><font face="Verdana"><input type=text name='txt_turno' onKeyDown="quita();"></font>*</td></tr>
                                                    <tr><td colspan="2" bgcolor="#EEEEEE" height="10" width="737">	<font face="Verdana" size="1" color="#990000"><b><div align="center" id="error"></div></b></font></td></tr>
                                                    <tr><td colspan="2" width="737" height="35" background="../../img_formas/titulo_sub_gris.gif">	<div align="center"><input type=submit style="height:30px" class="negra_16" value='&nbsp;&nbsp;Modificar&nbsp;&nbsp;'></div></td></tr>
                                            </table>
                                    </form> <?php 
                                    break;
                            case 51:
                                    if (isset($origen)){$vl_back="../_contacto_interno_respuesta.php?ejecucion=1&usuario_atendido=Plantel&estado=P";}else{$vl_back=$autollamada."qwerty=50"; }
                                    //////////if (substr($txt_Clave,2,3)=="EES" or substr($txt_Clave,2,3)=="EST" or substr($txt_Clave,2,3)=="ESN" or substr($txt_Clave,2,3)=="DES" or substr($txt_Clave,2,3)=="DST" or substr($txt_Clave,2,3)=="DSN" ){
                                            ///$latabla="ctsev_secundarias";}else{$latabla="ctsev";}
                                        $latabla="ctsev";
                                    $query="update $latabla set a1=0,a2=0,a3=0,a4=0,a5=0,a6=0,g1=0,g2=0,g3=0,g4=0,g5=0,g6=0,fecha_matricula='0000-00-00'  where cct='".$txt_Clave."' and turno='".$txt_turno."'";
                                    if (mysql_query($query)){
                                                   // $query2="delete from  ctsev_mov_matricula where cct='".$txt_Clave."' and turno='".$txt_turno."' and ciclo='".$_SESSION["vg_cicloescolar"]."'"; 
                                                    //mysql_query($query2);
                                    }?>
                                    <br><br><br>
                                    <table width='600' border='1' bordercolor='#000000' cellspacing='0' cellpadding='3' align="center">
                                        <tr><td align="center">
                                                <table class="table-all"><tr><th align="center"><h2 class="fcenter fbold fpadding-large ftext-red fround">Se ha borrado la matricula </h2></th></tr></table>
                                        </td></tr>
                                    </table> 
                                                                                            <script languaje="javascript" type="text/JavaScript"> 
                                                                                                    cl2("<?php echo $vl_back; ?>"); 
                                                                                                            </script>  <br><br><br>
                                                            <?php 		
                                    break;	

                            case 60:  
                                    ?><div class="col-md-12"><img class="img-responsive" src="../images/logo_SEVGob.png" width="1024" ></div>
                                    Registro de matricula a la fecha
                                    <table class="table">
                                    <caption>
                                    <SPAN class="negra_16"><?php echo fechalarga(date('Y-m-d')); ?><br><br></span>
                                    </caption>
                                    <tr><th width="25"  bgcolor="#CCCCCC"  scope="col">&nbsp;</th>
                                    <th width="291"  bgcolor="#CCCCCC"  scope="col">Nivel</th>
                                    <th width="78" bgcolor="#CCCCCC"  scope="col">Escuelas</th>
                                    <th width="79" bgcolor="#CCCCCC"  scope="col">Matricula</th>
                                    <th width="68" bgcolor="#CCCCCC"  scope="col">Faltan</th>
                                    <th width="68" bgcolor="#CCCCCC"  scope="col">Avance</th> </tr>                                            
                                    <?php     
                                                                    //echo "SELECT a.idnivel,a.nivel,a.todos,b.matricula,(a.todos-b.matricula) as faltan,(b.matricula*100/a.todos) as avance FROM (SELECT x.idnivel,y.nivel,COUNT(x.cct) AS todos FROM ctsev x,nivel_c y where x.idnivel=y.idnivel group by x.idnivel) a,(SELECT idnivel,COUNT(cct) AS matricula FROM ctsev WHERE a1>0 group by idnivel) b where a.idnivel=b.idnivel UNION SELECT a.idnivel,a.nivel,a.todos,b.matricula,(a.todos-b.matricula) as faltan,(b.matricula*100/a.todos) as avance FROM (SELECT x.idnivel,y.nivel,COUNT(x.cct) AS todos FROM ctsev_secundarias x,nivel_c y where x.idnivel=y.idnivel group by x.idnivel) a,(SELECT idnivel,COUNT(cct) AS matricula FROM ctsev_secundarias WHERE a1>0 group by idnivel) b where a.idnivel=b.idnivel";
                                                                    $vl_res=mysql_query("SELECT a.idnivel,a.nivel,a.todos,b.matricula,(a.todos-b.matricula) as faltan,(b.matricula*100/a.todos) as avance FROM (SELECT x.idnivel,y.nivel,COUNT(x.cct) AS todos FROM ctsev x,nivel_c y where x.idnivel=y.idnivel group by x.idnivel) a,(SELECT idnivel,COUNT(cct) AS matricula FROM ctsev WHERE a1>0 group by idnivel) b where a.idnivel=b.idnivel UNION SELECT a.idnivel,a.nivel,a.todos,b.matricula,(a.todos-b.matricula) as faltan,(b.matricula*100/a.todos) as avance FROM (SELECT x.idnivel,y.nivel,COUNT(x.cct) AS todos FROM ctsev_secundarias x,nivel_c y where x.idnivel=y.idnivel group by x.idnivel) a,(SELECT idnivel,COUNT(cct) AS matricula FROM ctsev_secundarias WHERE a1>0 group by idnivel) b where a.idnivel=b.idnivel"); 
                                                                    $vl_regs=mysql_num_rows($vl_res);
                                                                    $r=0; $vl_escuelas=0;   $vl_matr=0;
                                                                            while($r<$vl_regs){
                                                                                            $recset=mysql_fetch_array($vl_res,MYSQL_ASSOC);
                                                                                            ?>
                                    <tr><th width="25"    scope="col"><?php echo $recset["idnivel"];?></th>
                                    <th width="291"   scope="col" align="left"><?php echo $recset["nivel"];?>  </th>
                                    <th width="78"   scope="col" align="right"> <?php echo number_format($recset["todos"],0);?></th>
                                    <th width="79"   scope="col" align="right"><?php echo  number_format($recset["matricula"],0);?> </th>
                                    <th width="68"   scope="col" align="right"><?php echo  number_format($recset["faltan"],0);?> </th>
                                    <th width="68"   scope="col" align="right"><?php echo  number_format($recset["avance"],2);?> </th> </tr>                                            

                                    <?php
                                                                                            $r++;   $vl_escuelas=$vl_escuelas+$recset["todos"];      $vl_matr=$vl_matr+$recset["matricula"];
                                                                            }
                                    ?>
                                    <tr><th width="25"  scope="col" colspan="2">Totales</th>
                                    <th width="78"  scope="col" align="right"><?php echo number_format($vl_escuelas,0);?></th>
                                    <th width="79"  scope="col" align="right"><?php echo number_format($vl_matr,0);?></th>
                                    <th width="68"  scope="col" align="right"><?php echo number_format($vl_escuelas-$vl_matr,0);?></th>
                                    <th width="68"  scope="col" align="right"><?php echo number_format($vl_matr*100/$vl_escuelas,2);?></th> </tr>                                            
                                    </table><br><br><br><?php
                                    break;
                            case 100:
                                    $vercols="v|V|V";
                                    $anchogrid="600";
                                    mysql_query("set sql_big_selects=1");
                                    //echo "SELECT distinct b.idalmacen,a.cct,a.turno FROM ctsev_mov_matricula a,ctsev b where concat(a.cct,a.turno)=concat(b.cct,b.turno) and (a.c1+a.c2+a.c3+a.c4+a.c5+a.c6>10 or a.c1+a.c2+a.c3+a.c4+a.c5+a.c6<-10) order by b.idalmacen,a.cct,a.turno";
                                    $_sql="SELECT distinct b.idalmacen,a.cct,a.turno FROM ctsev_mov_matricula a,ctsev b where concat(a.cct,a.turno)=concat(b.cct,b.turno) and (a.c1+a.c2+a.c3+a.c4+a.c5+a.c6>10 or a.c1+a.c2+a.c3+a.c4+a.c5+a.c6<-10) and ciclo='".$_SESSION["vg_cicloescolar"]."' order by b.idalmacen,a.cct,a.turno";		
                                            $actual="Consultar|".$autollamada."qwerty=101&imprime=1";				
                                            $subtitulo1="TEXTO|Escuelas con movimientos de matricula grandes";	
                                            $subtitulo2="TEXTO|aquellas que hicieron movimientos de mas de 10 alumnos";
                                            $subtitulo2="TEXTO|Esto para analizar si sus movimientos fueron correctos";	
                                            $vertotregs="SI";	
                                    gridfer2012($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_verde","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3);
                                            break;	
                            case 101:
                                    $vl_back="cierraventana();";	
                                    if (!isset($vistopor)){ 
                                            $vl_back="cl('".$autollamada."qwerty=100&imprime=1');";	
                                            $arr_mikey=explode("|",oculta($mikey,1));
                                            $lallaveescuela=$arr_mikey[0].$arr_mikey[1];
                                    }
                                    $rescuela=mysql_query("select director, lada, telefono,a1,a2,a3,a4,a5,a6, g1,g2,g3,g4,g5,g6 from ctsev where concat(cct,turno)='".$lallaveescuela."'");
                                    $recsetescu=mysql_fetch_array($rescuela);
                                    if (!isset($vistopor)){
                                            echo "Director : ".$recsetescu[0]."       Telefono : (".$recsetescu[1].") ".$recsetescu[2];
                                    }

                                    echo "<br><span class='negra_24'>(".substr($lallaveescuela,0,10)." - ".substr($lallaveescuela,10).") Ciclo Escolar ".$_SESSION["vg_cicloescolar"]."</span><br>";
                                    $vercols="v|v|v|v|v|v|v|v|v|v|v|v|v|v";
                                    $anchogrid="900";
                                    $_sql="select A1,A2,A3,A4,A5,A6,(a1+a2+a3+a4+a5+a6) as Alumnos,G1,G2,G3,G4,G5,G6,(g1+g2+g3+g4+g5+g6) as Grupos from ctsev where concat(cct,turno)='".$lallaveescuela."'";		
                                    $actual="NO";		
                                            $subtitulo1="TEXTO|Matricula registrada por el plantel al inicio de cursos";	
                                            $vertotregs="NO";	
                                    gridfer2012($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_verde","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3,"","otraventana");

                                    echo "<br>";	
                                    $vercols="I|V|v|V|V|V|V|V|V";
                                    $anchogrid="1050";
                                    $_sql="select fecha,Tipo as Tipo_de_movimiento,date_format(fecha,'%d - %b - %Y') as Fecha_Reg,c1 as Grado_1,c2 as Grado_2,c3 as Grado_3,c4 as Grado_4,c5 as Grado_5,c6 as Grado_6 from ctsev_mov_matricula where concat(cct,turno)='".$lallaveescuela."' and ciclo='".$_SESSION["vg_cicloescolar"]."'";		
                                    $actual="NO";		
                                            $subtitulo1="TEXTO|Actualizaciones a la matricula";	
                                            $vertotregs="NO";	
                                    gridfer2012($vertotregs,$actual,$_sql,$vercols,$anchogrid,"piel_verde","cad_rec",$subtitulo1,$subtitulo2,$subtitulo3);
                                    $sr1=$recsetescu[3];		$sr2=$recsetescu[4];		$sr3=$recsetescu[5];
                                    $sr4=$recsetescu[6];		$sr5=$recsetescu[7];		$sr6=$recsetescu[8];
                                    $movimientos=obten_movimientos($lallaveescuela,$_SESSION["vg_cicloescolar"]);
                                    $sr1=$sr1+$movimientos[0];		$sr2=$sr2+$movimientos[1];		$sr3=$sr3+$movimientos[2];
                                    $sr4=$sr4+$movimientos[3];		$sr5=$sr5+$movimientos[4];		$sr6=$sr6+$movimientos[5];

                                    $sg1=$recsetescu[9];		$sg2=$recsetescu[10];		$sg3=$recsetescu[11];
                                    $sg4=$recsetescu[12];		$sg5=$recsetescu[13];		$sg6=$recsetescu[14];
                                    ?><br>
                                    <span class='negra_20'>Matricula Real al <?php echo fechalarga(date('Y-m-d')); ?></span><br>
                                    <br>
                                    <table class="table"><tr><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A1</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A2</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A3</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A4</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A5</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>A6</b></font></td><td width="87" align='center' bgcolor='#FFEAAA'><font ><b>Alumnos</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G1</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G2</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G3</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G4</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G5</b></font></td><td width="33" align='center' bgcolor='#FFEAAA'><font ><b>G6</b></font></td><td width="84" align='center' bgcolor='#FFEAAA'><font ><b>Grupos</b></font></td></tr>
                                            <tr><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr1; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr2; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr3; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr4; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr5; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr6; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sr1+$sr2+$sr3+$sr4+$sr5+$sr6; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg1; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg2; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg3; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg4; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg5; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg6; ?></font></td><td bgcolor='#F7F7F7' align='right'><font class='negra_18'><?php echo $sg1+$sg2+$sg3+$sg4+$sg5+$sg6; ?></font></td></tr>
                                    </table><br>                                                   
                                    <div id='nopasa'> <input type="button" class="btn btn-default" value="   Imprimir   " name="cmdPrint" onClick="doPrint();"> 
                                            <input type="button" class="btn btn-default" value="   Regresar   " name="cmdback" onClick="<?php echo $vl_back; ?>"> 
                                    </div> <?php 
                                    break;			
                    }
                    mysql_close();
                } ?>	
            </div>	 
        </div>
    </div>
</body></html>
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
    
    
    
                function PieRecibo($contenido,$direnviado,$idnivel=0){
                    ?>
                    <table width="100%">
                        <tr>	
                                <td class="text-center"><?php echo GenerarQR($contenido,$direnviado); ?></td> 
                                <td class="text-center"><small>Fecha de devolución y/o entrega de paquetes libros</small><br><br><br>________________________ VER. A ______ DE___________________ DE <? echo substr($_SESSION["vg_cicloescolar"],0,4); ?></td></tr>
                        </tr>
                    </table>
                    <br>
                    <table cellpadding="7" cellspacing="0" width="100%" style="border-color:#FBFBFB; text-align:center; font-size:12px">
			<tr>
				<td width="30%"><span style="font-weight:bold">ENTREG&Oacute;</span><br><br>____________________________________<br><small>NOMBRE Y FIRMA DEL <? if(($_SESSION["vg_tipousuario"]=="Almacen" or $_SESSION["vg_tipousuario"]=='Plantel') && $idnivel>49 && $idnivel<69){ echo "RESPONSABLE DE ALMACÉN"; }else{ echo "SUPERVISOR"; } echo $firma_entrega; ?></small> <br></td>
				<td style="vertical-align:middle;" width="20%" >SELLO<br><? echo $sello_entrega; ?></td>                             
				<td width="30%"><span style="font-weight:bold">RECIBIÓ</span><br><br>___________________________________<br><small>NOMBRE Y FIRMA DEL DIRECTOR <? echo $firma_recibe; ?></small><br></td>
				<td style="vertical-align:middle;">SELLO<br><? echo $sello_recibe; ?></td>                                                                                
			</tr>                    
        	    </table>
                    <br><br>
		    <div style="text-align:center"><small>Rafaela Díaz Rivera<br>Coordinadora Estatal de Apoyo para la Mejora Educativa<br>Responsable único de distribución de Libros de Texto Gratuitos</small></div>
                    <br><div align="left"><span style='font-size:10px; font-weight:100'><? echo url_actual(); ?></span></div>
                    <!-- <table cellpadding="10" cellspacing="0" width="100%">
                    <td></td><td align="center">RECIBI&Oacute;</td><td align="center">&nbsp;</td><td align="center">ENTREG&Oacute;</td></tr>	   	<tr>
                    <td></td><td align="center">&nbsp;</td><td align="center"> SELLO  </td> <td align="center">&nbsp;</td></tr> 
                    <tr><td></td><td align="center">______________________________</td><td align="center">&nbsp;</td><td align="center">_________________________________</td></tr>
                    <tr><td></td><td align="center"> c	|	c	 SUPERVISOR</td><td align="center">&nbsp;</td><td align="center"> NOMBRE Y FIRMA DIRECTOR</td></tr></table> -->
                    <?php
                    }   
  
        