<?php
    namespace app\controllers;
    use app\models\viewsModel;
#Controlador para redirección entre vistas principales como "login" "register" "error"
    class viewsController extends viewsModel {
        public function obtenerVistasController($vista){
            if($vista !=""){
                $respuesta = $this->obtenerVistasModelo($vista);
            }else {
                $respuesta = "login";
            }
            return $respuesta;
        }
    }
?>