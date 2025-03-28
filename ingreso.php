<?php
session_start();
session_destroy();
$ban = isset($_GET["tipousuario"]) ? "tipousuario=" . htmlspecialchars($_GET["tipousuario"], ENT_QUOTES, 'UTF-8') . "&" : "";

if (!isset($_GET['w'])) {
    echo "<script language=\"JavaScript\">window.location.href = \"" . $_SERVER['PHP_SELF'] . "?" . $ban . "w=\" + screen.width;</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Libros Veracruz - Bienvenidos</title>
    <link rel="shortcut icon" href="images/libro_titulo3.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <SCRIPT TYPE="text/javascript" src="js/bootstrap.min.js"></SCRIPT>
    <SCRIPT TYPE="text/javascript" src="js/jquery-1.12.0.min.js"></SCRIPT>
    <SCRIPT TYPE="text/javascript" src="_funciones.js"></SCRIPT>
    <SCRIPT TYPE="text/javascript">
        function checa() {
            var m = document.getElementById("error");
            if (document.FrmLogin.TxtUsuario.value.length == 0) {
                m.innerHTML = "La Cuenta es obligatoria\n";
                document.FrmLogin.TxtUsuario.focus();
                return false;
            }
            if (document.FrmLogin.TxtPassword.value.length == 0) {
                m.innerHTML = "El password es obligatorio\n";
                document.FrmLogin.TxtPassword.focus();
                return false;
            }
        }
    </SCRIPT>
</head>
<body>
    <div class="container" style="max-width:1000px; margin-left:auto; margin-right:auto">
        <div class="row">
            <div class="col-md-12" style='text-align:center'>
                <img class="img-responsive" src="images/logo_SEVGob.png" width="900">
            </div>
        </div>
        <div class="row" style="text-align:center">
            <h3>Coordinación Estatal de Apoyo para la Mejora Educativa</h3>
            <h4>Programa de Libros de Texto Gratuitos</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $vl_procede = 1;

                if (isset($_GET["tipousuario"])) {
                    switch ($_GET["tipousuario"]) {
                        case "Sector":
                        case "Supervisor":
                            break;
                    }
                }

                if ($_GET["tipousuario"] == "Supervisor") {
                    echo "<div class='roja_14'>La contraseña es la misma que usa en INPESEV (7 dígitos)<br>FAVOR DE CONSIDERAR QUE LAS CONTRASEÑAS SE ACTUALIZARON RECIENTEMENTE</div><br>";
                }

                if ($vl_procede == 1) {
                ?>
                    <div style="color:#C70039; font-size:16px; font-weight:bold; padding:7px; text-align:center">
                        <?php
                        if (isset($_GET["tipousuario"])) {
                            switch ($_GET["tipousuario"]) {
                                case "Sector":
                                    echo "Ingreso Jefe de Sector";
                                    break;
                                case "Supervisor":
                                    echo "Ingreso Supervisor";
                                    break;
                                case "Plantel":
                                    echo "Ingreso Plantel";
                                    break;
                                case "Almacen":
                                    echo "Ingreso Responsable de almacen";
                                    break;
                            }
                        } else {
                            echo "Ingreso";
                        }
                        ?>
                    </div>

                    <div id="dis_formulario">
                        <form name='FrmLogin' method='post' action='_panel.php?w=<?php echo $_GET["w"]; ?>' onsubmit='return checa();'>
                            <div class="form-group">
                                <?php
                                if (isset($_GET["tipousuario"])) {
                                    echo "<input type='hidden' name='hid_tipousuario' value='" . $_GET["tipousuario"] . "'>";
                                }
                                ?>
                                <table class="table" style="text-align:center; max-width:300px; margin-left:auto; margin-right:auto">
                                    <tr>
                                        <td align="left">Cuenta</td>
                                        <td><input name="TxtUsuario" autofocus type="text" class="dis_input" onKeyPress="return enter(document.FrmLogin.TxtPassword);" size="18" maxlength="10"></td>
                                    </tr>
                                    <tr>
                                        <td align="left">Contraseña</td>
                                        <td><input name="TxtPassword" type="password" class="dis_input" onKeyPress="return enter(document.FrmLogin.BtnSubmit);" size="18" maxlength="18"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><div align="center"><input class="fbutton ftext-white" type='submit' name='BtnSubmit' value='   Ingresar   '></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center"><div align="center" id="error" class="roja_12"></div></td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                <?php
                } else {
                    echo "<div align='center'><h2>" . $mensaje . "</h2></div>";
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <?php if (isset($vl_regreso)) { ?>
                    <a href="<?php echo $vl_regreso; ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Regresar</a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
