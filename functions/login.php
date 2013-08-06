<?php
function doLogin($username, $password)                 // Ejecuta el procedimiento de inicio de sesión.
{
    if ($username == "luis@localhost")
    {
        $_SESSION['isUserLogged']=1;                     // configura variable de sesión con un VERDADERO para usuario logueado
        $Usuario_Apodo="lalcaraz";
        $_SESSION['LoggedUser']=$Usuario_Apodo;              // configura variable de sesión con el nombre del usuaro
        setcookie('UserLogged',$Usuario_Apodo, time()+3600); //cookie con el usuario logueado, expira en una hora.
    }
}

function doLogout()                // Ejecuta el procedimiento de cierre de sesión.
{
    if (isset($_SESSION['isUserLogged'])) unset($_SESSION['isUserLogged']);     //Desregistra la variable
    if (isset($_SESSION['LoggedUser'])) unset($_SESSION['LoggedUser']);         //Desregistra la variable
    if (isset($_COOKIE['UserLogged'])) setcookie('UserLogged','lalcaraz', time()-3600);  // Pone el cookie con validez -1 hora.
                       
    session_destroy();  // Destruye la sesión actual
    
    header('Location: index.php');
}
                       
function doCheckLoginStatus()      // funcion que verifica su la sesión está correcta. Regresa TRUE o FALSE.
{
    if (isset($_SESSION['isUserLogged']))
    {
        return true;
    }
    else
    {
        return false;
    }
}
                       
?>