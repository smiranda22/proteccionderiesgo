<?php

class ObjetivoManager{

    public function cargaControl($array_control){

        $query_control = "INSERT INTO puntoscontrol (nombre,objetivo,fecha) VALUES (:nombre,:objetivo,:fecha)";
             Db::insert($query_control, $array_control);
        }

        public function listarControles(){
            $query="SELECT * FROM puntoscontrol WHERE estado = '1' ";
                                        
            return Db::queryAll($query);
        }  

        public function getObjetivos(){
            $query="SELECT * FROM objetivos";
                                        
            return Db::queryAll($query);
        }

        public function getClientes(){
            $query="SELECT * FROM clientes";

            return Db::queryAll($query);
        }
        
        public function eliminarControl($idcambiarEstado){
            $query= "UPDATE puntoscontrol SET estado = '0' WHERE id = :id";

            return Db::update($query, $idcambiarEstado);
       }

       public function actualizarControl($arrayModificar){
           $query= "UPDATE puntoscontrol SET nombre = :nombre, objetivo = :objetivo WHERE id = :id";

           return DB::update($query, $arrayModificar);
}
}
    
?>