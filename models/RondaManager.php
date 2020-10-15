<?php

class RondaManager{

    public function cargaRonda($nombre,$idCliente,$idControl,$fecha){

        $query_control = "INSERT INTO rondas (nombre,id_cliente,id_punto_control,fecha) VALUES ('".$nombre."','".$idCliente."' , '".$idControl."', '".$fecha."')";

             return Db::insert($query_control);
        }

        public function getObjetivos(){
            $query="SELECT * FROM objetivos";
                                        
            return Db::queryAll($query);
        }

        public function getClientes(){
            $query="SELECT * FROM clientes ORDER BY nombre ASC";

            return Db::queryAll($query);
        }

        public function getPuntosControlCliente($idCliente){
            $query="SELECT * FROM puntoscontrol WHERE id_cliente = $idCliente";
                                        
            return Db::queryAll($query);
        }
        
        
        public function eliminarRonda($idcambiarEstado){
            $query= "UPDATE puntoscontrol SET estado = '0' WHERE id = :id";

            return Db::update($query, $idcambiarEstado);
       }

       public function modificarRonda($arrayModificar){
           $query= "UPDATE puntoscontrol SET nombre = :nombre, objetivo = :objetivo WHERE id = :id";

           return DB::update($query, $arrayModificar);
}
}
    
?>