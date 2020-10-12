<?php

class PuntocontrolManager extends Db{

    public function cargaControl($idCliente,$nombre,$objetivo,$fecha){

        $query_control = "INSERT INTO puntoscontrol (id_cliente,nombre,objetivo,fecha) VALUES ('". $idCliente ."', '". $nombre ."', '". $objetivo ."', '". $fecha ."')";

             Db::insert($query_control);
        }

        public function listarObjetivos($idCliente){
            $query="SSELECT LTRIM(RTRIM(obj.nombre)) AS 'nombre_objetivo', obj.codigo AS 'codigo_objetivo' FROM dbo.clientes_por_objetivo AS cli
                    LEFT JOIN objetivos obj ON obj.codigo = cli.objetivo
                    INNER JOIN clientes c ON c.codigo = cli.cliente
                    WHERE cli.cliente = $idCliente";

            return Db::queryAll($query);

        }  

        public function getClientes(){
            $query="SELECT codigo, nombre FROM clientes ORDER BY nombre ASC";
 
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