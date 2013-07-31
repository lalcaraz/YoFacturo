<?php

$lbl_Login_ErrorMsg = array("Acceso Permitido",                                             // Para $Login_ErrorMsg = 0
                            "No puede omitir usuario o contraseña",                         // Para $Login_ErrorMsg = 1
                            "La combinación de usuario y contraseña no es válido",          // Para $Login_ErrorMsg = 2
                            "La nueva contraseña será enviada por correo",                  // Para $Login_ErrorMsg = 3
                            "Para recuperar la contraseña, se necesita tu correo");         // Para $Login_ErrorMsg = 4

if(isset($_POST['login_submitted'])) // Si la forma de login fué utilizada
    { 
        if (isset($_POST['InputEmail'])) $username = $_POST['InputEmail'];
        if (isset($_POST['InputPassword'])) $password = $_POST['InputPassword'];
        if ( (!empty($username)) and (!empty($password)) )                            //Validar si no vienen vacíos.
            if ($username == $password) { $isLogged = true; $Login_ErrorMsg = 0; }    // Bandera que verifica si el usuario está firmado en el sistema.
            else { $isLogged = false; $Login_ErrorMsg = 2; }                          // En caso que no sean iguales.
        else { $isLoged = false; $Login_ErrorMsg = 1; }                               // En caso que User o Pass estén vacios.
    
        if (isset($_POST['recovering_password']))                                // En caso que se haya pedido recordar password
            if (!empty($_POST['InputEmail'])) 
                {$doShowRecover = false; $Login_ErrorMsg = 3;}                // Si se introdujo un email valido
            else 
                {$doShowRecover = true; $Login_ErrorMsg = 4;}                // Si se introdujo un email incorrecto
    }
else
    { 
        $isLogged = false; // Bandera que verifica si el usuario está firmado en el sistema. 
        $Login_ErrorMsg = 0;
    }

if(isset($_GET['action'])) // En caso que se detecte una acción
    {
        if ($_GET['action'] == 'logout') header('Location: index.php'); // Destruye la sesión
        if ($_GET['action'] == 'pwrecover') $doShowRecover=true; // Destruye la sesión
    }

if (!isset($isLogged)) $isLogged = false;
if (!isset($doShowRecover)) $doShowRecover = false;
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>YoFacturo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <!-- Menu Principal -->
        <div class="navbar navbar-inverse">
            <a class="navbar-brand" href="#">YoFacturo</a>
            <ul class="nav navbar-nav pull-right">
                <?php if ($isLogged) {?> <li><a href="?action=logout">Cerrar Sesión</a></li> <?php } ?>
            </ul>
        </div>

        <?php if (!$isLogged) {?>
        <!-- Login -->
        <div class="row show-grid">
            <div class="col-lg-4">&nbsp;</div>
            <div class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Inicio de Sesión </h3>
                    </div>
                    <?php if ( $Login_ErrorMsg != 0) { ?>
                    <?php if ( $Login_ErrorMsg != 3) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> <?php echo $lbl_Login_ErrorMsg[$Login_ErrorMsg];?>
                    </div>
                    <?php }
                            else
                            {
                        ?>
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Listo!</strong> <?php echo $lbl_Login_ErrorMsg[$Login_ErrorMsg];?>
                    </div>
                        <?php
                            }
                        ?>
                    <?php } ?>
                    <form action="index.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <input type='hidden' name='login_submitted' />
                            <?php if ($doShowRecover == true) echo "<input type='hidden' name='recovering_password' />"; ?>
                            <div class="form-group">
                              <label for="InputEmail">Correo Electrónico:</label>
                              <input type="text" class="form-control" id="InputEmail" name="InputEmail" placeholder="Ingresa tu correo electrónico">
                            </div>
                            <?php if ($doShowRecover == false) {?>
                            <div class="form-group">
                              <label for="InputPassword">Contraseña:</label>
                              <input type="password" class="form-control" id="InputPassword" name="InputPassword" placeholder="Ingresa tu clave de acceso">
                            </div>
                            <?php } ?>
                            <button type="submit" class="btn btn-default">
                                <?php if ($doShowRecover == true) echo "Recuperar Contraseña"; else echo "Acceder"; ?>
                            </button>
                        </fieldset>
                    </form>

                    <?php if ($doShowRecover == false) {?>
                    <div class="panel-footer">¿Olvidaste tu contraseña? <a href="?action=pwrecover"> Haz click aqui </a></div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4">&nbsp;</div>
        </div>
        <?php }
            else
              { ?>
        
        <!-- Tabla, las 5 últimas facturas emitidas -->
        <?php } ?>
        
        <!-- Pie de Página -->
        <div class="navbar navbar-inverse navbar-fixed-bottom">
            <ul class="nav navbar-nav pull-right">
                <li><a href="#">(R) 2013. Derechos Reservados</a></li>
            </ul>
        </div>
        
        <!-- JavaScript plugins (requires jQuery) -->
        <script src="http://code.jquery.com/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Optionally enable responsive features in IE8 -->
        <script src="js/respond.js"></script>
    </body>
</html>
