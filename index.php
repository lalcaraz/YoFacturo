<?php
session_start();

include ('helpers/error_messages.php'); // Incluye las variables tipo Array para el manejo de errores.

include('functions/login.php'); // Incluye las funciones para el login.

if(isset($_POST['login_submitted'])) // Si la forma de login fué utilizada
    { 
        if (isset($_POST['InputEmail'])) $username = $_POST['InputEmail'];
        if (isset($_POST['InputPassword'])) $password = $_POST['InputPassword'];
        if ( (!empty($username)) and (!empty($password)) )                            //Validar si no vienen vacíos.
            {
                doLogin($username,$password);
                $LoginExitoso = doCheckLoginStatus();
                if ($LoginExitoso)
                {
                    $Login_ErrorMsg = 0; // Sin mensaje de error.
                }
            else { $Login_ErrorMsg = 2; }                          // En caso que no sea exitoso el login.
            }
        else { $Login_ErrorMsg = 1; }                               // En caso que User o Pass estén vacios.
    
        if (isset($_POST['recovering_password']))                                // En caso que se haya pedido recordar password
            if (!empty($_POST['InputEmail'])) 
                {$Login_ErrorMsg = 3;}                // Si se introdujo un email valido
            else 
                {$Login_ErrorMsg = 4;}                // Si se introdujo un email incorrecto
    }
else
    { 
        $Login_ErrorMsg = 0;
    }

if(isset($_GET['action'])) // En caso que se detecte una acción
    {
        if ($_GET['action'] == 'logout') doLogout(); // Destruye la sesión
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>YoFacturo</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        
        <!-- Google Chart API -->
        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Cliente', 'Facturas Emitidas'],
              ['Diverza',     11],
              ['PepsiCo',      2],
              ['General Electric',  2],
              ['Nuga-Sys', 2],
              ['FEMSA',    7]
            ]);
    
            var options = {
              //title: 'My Daily Activities'
            };
    
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>
    </head>
    <body>
        
        <?php include_once('views/header.php'); ?>  <!-- Menu Principal -->

        <?php if (!doCheckLoginStatus()) 
        {
            if(isset($_GET['action'])) // En caso que se detecte una acción
            {
                if ($_GET['action'] == 'pwrecover') 
                    include_once('views/passwordrecover.php');   //<!-- Vista de RecoveryPassword -->
            }
            else
                include_once('views/login.php');    //<!-- Vista de Login -->
        }
        else
        { 
            if (isset($_GET['view']))
            {
                switch ($_GET['view'])
                {
                    case 'dashboard': include_once('views/dashboard.php'); break; //<!-- Dashboard Principal -->
                    case 'pwrecover': include_once('views/passwordrecover.php');  break; //<!-- Vista de RecoveryPassword -->
                    case 'invoices': include_once('views/invoices.php'); break; // Vista de Facturas
                    case 'clients': include_once('views/clients.php'); break; // Vista de Clientes
                    default: include_once('views/dashboard.php'); break;//<!-- Dashboard Principal -->
                }
            }
            else
            {
                include_once('views/dashboard.php'); //<!-- Dashboard Principal -->
            }
            
        } 
        ?>
        
        <?php include_once('views/footer.php'); ?>  <!-- Pie de Página -->
    </body>
</html>
