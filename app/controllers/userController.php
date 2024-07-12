<?php
    namespace app\controllers;
    use app\models\mainModel;


    class userController extends mainModel {
        #Controlador para el registro de usuario
        public function registrarUsuarioController(){
            $user = $this->cleanString($_POST['user']);
            $email = $this->cleanString($_POST['email']);
            $pass = $this->cleanString($_POST['pass']);
            $clave=password_hash($pass, PASSWORD_BCRYPT,["cost"=>10]);
            #Aplicación del primer filtro...donde se revisa que todos los datos requeridos seán llenados.
            if($user==""|| $email==""|| $pass==""){
                $alerta =[
                    "tipo"=>"simple",
                    "title"=>"Error",
                    "text"=>"Todos los campos son obligatorios",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            };
            #Se va a verificar la integridad de los datos.
            if($this->verificarData("[ A-Za-z0-9áéíóúÁÉÍÓÚñÑ ]{3,40}",$user)){
                $alerta =[
                    "tipo"=>"simple",
                    "title"=>"Error",
                    "text"=>"El usuario tiene caracteres no permitidos.",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }
            if($this->verificarData("[ A-Za-z0-9áéíóúÁÉÍÓÚñÑ$@ ]{8,}",$pass)){
                $alerta =[
                    "tipo"=>"simple",
                    "title"=>"Error en la contraseña",
                    "text"=>" Revisa que sea mayor a 8 carácteres y/o solo tenga carácteres especiales '$' '@'.",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }
            #verificación que el email registrado sea correcto.
            if($email !=''){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                }else {
                    $alerta =[
                        "tipo"=>"simple",
                        "title"=>"Error inesperado",
                        "text"=>"Correo electronico no valido.",
                        "icono"=>"error"
                    ];
                    return json_encode($alerta);
                    exit();
                }
            }
            #Verifica si el usuario ya existe en la base de datos para que no repita.
            $check_user =$this->ejecutar("SELECT user FROM users WHERE user='$user'");
            if($check_user->rowCount()>0){
                $alerta =[
                    "tipo"=>"simple",
                    "title"=>"Error inesperado",
                    "text"=>"El usuario ingresado ya existe, por favor intentelo otra vez.",
                    "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();
            }
            
        }
    }
?>