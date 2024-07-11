<?php
    namespace app\models;
    use \PDO;
    #Confirmación del archivo server.php
    if(file_exists(__DIR__."/../../config/server.php")){
        require_once __DIR__."/../../config/server.php";
    }
    #Modelo principal para la conexión a la base de datos.
    class mainModel{ 
        private $server = DB_SERVER;
        private $db_name = DB_NAME;
        private $db_user = DB_USER;
        private $db_pass = DB_PASS;

        protected function conect(){
            $conn = new PDO("mysql:host=".$this->server.";dbname=".$this->db_name, $this->db_user, $this->db_pass);
            $conn->exec("SET CHARACTER SET utf8");
            return $conn;
        }

        protected function ejecutar($consulta){
            $sql =$this->conect()->prepare($consulta);
            $sql->execute();
            return $sql;
        }
    }
?>