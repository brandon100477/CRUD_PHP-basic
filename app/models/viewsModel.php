<?php
    namespace app\models;
    #Modelo para la redirección de las vistas.
    class viewsModel {
        protected function obtenerVistasModelo($vista){
            $lista=["dashboard", "userNew", "userList", "userSearch", "userUpdate", "logOut"];
            if(in_array($vista, $lista)){
                if(is_file("./app/views/content/".$vista."-view.php")){
                    $contenido = "./app/views/content/".$vista."-view.php";
                }else{
                    $contenido = "404";
                }
            }elseif ($vista == "login" || $vista == "index") {
                $contenido ="login";
            }elseif ($vista == "register") {
                $contenido ="register";
            }else {
                $contenido = "404";
            }
            return $contenido;
        }}
?>