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
        #Función para conectar la base de datos.
        protected function conect(){
            $conn = new PDO("mysql:host=".$this->server.";dbname=".$this->db_name, $this->db_user, $this->db_pass);
            $conn->exec("SET CHARACTER SET utf8");
            return $conn;
        }
        #Función para hacer consultas a la base de datos.
        protected function ejecutar($consulta){
            $sql =$this->conect()->prepare($consulta);
            $sql->execute();
            return $sql;
        }
        #(1mer filtro) Función para evitar inyecciones SQL - Listando palabras que no son permitidas.
        public function cleanString($cadena){
            $palabras=["<script>","</script>", "<script src","<script type=","<style>", "</style>","<form>", "<input>", "<button>", '<meta http-equiv="refresh"',"<img src=x onerror=alert(",
                        "<iframe src=x onload=alert(", "<object type=application/x-shockwave-flash>", "<embed src=x onerror=alert(",'<img src="','<img onerror="','<link href="','onload="',
                        'onmouseover="','onfocus="','onblur="','onclick="', "SELECT * FROM", "DELETE FROM", "INSERT INTO", "DROP TABLE", "DROP DATABASE", "TRUNCATE TABLE","SHOW TABLES",
                        "SHOW DATABASES", "<?php", "?>", "==", "--", "^", ",", ".", "=", ";", "::", "<", ">"];
            $cadena=trim($cadena);
            $cadena=stripslashes($cadena);
            foreach($palabras as $pa){ 
                $cadena=str_ireplace($pa,"",$cadena);
            }
            $cadena=trim($cadena);
            $cadena=stripslashes($cadena);
            return $cadena;     
        }
        #(2do filtro) Funcion para filtrar la cadena de texto sobre una expresión regular donde se limita la entrada de datos.
        protected function verificarData($filtro, $cadena){
            if(preg_match("/^".$filtro."$/",$cadena)){
                return false;
            }else{
                return true;
            }
        }
        #Función para insertar datos a la base de datos.
        protected function saveData($tabla, $datos){
            $query="INSERT INTO $tabla(";
            $c=0;
            foreach($datos as $data){
                if($c>=1){
                    $query.=",";
                }
                $query.=$data["campo_nombre"];
                $c++;
            }
            $query .=") VALUES(";
            $c=0;
            foreach($datos as $data){
                if($c>=1){
                    $query.=",";
                }
                $query.=$data["campo_marcador"];
                $c++;
            }
            $query .="";
            $sql=$this->conect()->prepare($query);

            foreach($datos as $data){
                $sql->bindParam($data["campo_marcador"],$data["campo_valor"]);
            }
            $sql->execute();
            return $sql;
        }
        #Función para seleccionar los datos
        public function selectData($type, $tabla, $campo, $id){
            $type = $this->cleanString($type);
            $tabla = $this->cleanString($tabla);
            $campo = $this->cleanString($campo);
            $id = $this->cleanString($id);
            
            if($type =="Unico"){
                $sql =$this->conect()->prepare("SELECT * FROM $tabla WHERE $campo =:ID");
                $sql->bindParam(":ID",$id);

            }elseif($type =="Normal"){
                $sql =$this->conect()->prepare("SELECT $campo FROM $tabla");
            }
            $sql->execute();
            return $sql;
        }
        #Función para actualizar los datos.
        protected function upgradeData($tabla,$datos, $condi){
            $query="UPDATE $tabla SET";
            $c=0;
            foreach($datos as $data){
                if($c>=1){
                    $query.=",";
                }
                $query.=$data["campo_nombre"]."=".$data["campo_marcador"];
                $c++;
            }
            $query .=" WHERE ". $condi["condicion_campo"]."=".$condi["condicion_marcador"];
        
            $sql = $this->conect()->prepare($query);
            foreach($datos as $data){
                $sql->bindParam($data["campo_marcador"],$data["campo_valor"]);
            }
            $sql->bindParam($condi["condicion_marcador"],$condi["condicion_valor"]);
            $sql->execute();
            return $sql;
        }
        #Función para eliminar los datos.
        protected function deleteData($tabla,$campo,$id){
            $sql=$this->conect()->prepare("DELETE FROM $tabla WHERE $campo=:ID");
            $sql->bindParam(":ID",$id);
            $sql->execute();
            return $sql;
        }
        #Función para realizar la paginación de tablas.
        protected function paginador($page, $num, $url, $button){
            $tabla='<nav class="pagination is-rounded" role="navigation" aria-label="pagination">';
            if($page<=1){
                $tabla.='
                <a class="pagination-previous is-disabled" disabled>Anterior</a>
                <ul class="pagination-list">
                ';
            }else {
                $tabla.='
                <a href="'.$url.($page-1).'/" class="pagination-previous">Anterior</a>
                <ul class="pagination-list">
                    <li><a href="'.$url.'1/" class="pagination-link" aria-label="Goto page 1">1</a></li>
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                ';
            }
            $ci=0;
            for($i=$page;$i<=$num;$i++){
                if($ci>=$button){
                    break;
                }
                if($i==$page){
                    $tabla.='<li><a href="'.$url.$i.'/" class="pagination-link" is-current>'.$i.'</a></li>';
                } else {
                    $tabla.='<li><a href="'.$url.$i.'/" class="pagination-link">'.$i.'</a></li>';
                }
                $ci++;
            }
            if($page==$num){
                $tabla.='
                </ul>
                <a class="pagination-next is-disabled" disabled>Siguiente</a>
                ';
            }else{
                $tabla.='
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a href="'.$url.$num.'/" class="pagination-link" aria-label="Goto page 1">'.$num.'</a></li>
                </ul>

                <a href="'.$url.($page+1).'/" class="pagination-next">Siguiente</a>
                ';
            }
            $tabla.='</nav>';
            return $tabla;
        }
    }
?>