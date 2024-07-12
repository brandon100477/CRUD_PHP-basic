<?php
    require_once "../../config/app.php";
    require_once "../../app/views/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controllers\userController;
    # condición Ajax para la redirección de datos de un formulario (Formualiro de registro)
    if(isset($_POST['modulo_user'])){
        $insUser = new userController();
        if($_POST['modulo_user'] == 'registrar'){
            $respuestaJson = $insUser->registrarUsuarioController();
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($respuestaJson);
            exit();
        }
    }else{
        session_destroy();
        header("Location: ". APP_URL."login/");
    }
?>