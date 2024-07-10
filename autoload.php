<?php #Este archivo sirve para la carga automatica de las clases que se van a utilizar en el proyecto.
    spl_autoload_register(function ($clase){
        $archivo = __DIR__."/".$clase.".php"; #Extreae la ruta absoluta del proyecto.
        $archivo =str_replace("\\","/",$archivo);
        if(is_file($archivo)){
            require_once $archivo;
        }
    });
?>