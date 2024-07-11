<?php
    #Se cargan los archivos de configuración, autocarga y de inicio de sesión
    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/views/inc/session_start.php";
    #Si no existe nada en la URL, redireccionará a la vista de Login.
    if(isset($_GET['views'])){
        $url = explode("/", $_GET['views']);
    }else{
        $url = ["login"];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Carga del archivo de head...donde se encuentran las etiquetas metas y demás. -->
    <?php require_once "./app/views/inc/head.php";?>
</head>
<body>
    
    <?php
    #Configuracion y redirección de vistas dependen de si existe o no en la URL.
        use app\controllers\viewsController;
        $viewsController = new viewsController();
        $vista=$viewsController->obtenerVistasController($url[0]);
        if ($vista == "login" || $vista == "404" || $vista == "register"){
            require_once "./app/views/content/".$vista."-view.php";
        }else {
            require_once "./app/views/inc/navbar.php";
            require_once $vista;
        }
        #Se implementan los scripts del archivo.
        require_once "./app/views/inc/script.php";
    ?>
</body>
</html>