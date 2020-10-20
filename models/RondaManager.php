<?php

class RondaManager{

        public function cargaRonda($data){
            
            $id_cliente = $data['cliente'];
            $nombre_ronda = $data['nombre'];
            $fecha=date("Y-m-d");

            $query_ronda = "INSERT INTO rondas (nombre,id_cliente,fecha) 
                            VALUES ('".$nombre_ronda."','".$id_cliente."', '".$fecha."')";
            $id_ronda = Db::insert($query_ronda);

            foreach($data['itemsronda'] as $fila){
            $i[]=$fila;
            }
            $itemsronda= array_combine($i, $data['itemsronda']);
            $itemstiempo= array_combine($i, $data['itemstiempo']);
            $itemscontrol= array_combine($i, $data['itemscontrol']);
            $qr= array_combine($i, $data['qrCheck']);
            $nfc= array_combine($i, $data['nfcCheck']);
            $llegue= array_combine($i, $data['llegueCheck']);

            foreach ($itemsronda as $fila =>$valor) { 
                $query = "INSERT INTO item_ronda (id_ronda, id_puntocontrol, orden,tiempo,qr,nfc,llegue) 
                        VALUES ('".$id_ronda."','".$itemscontrol[$fila]."' , '".$valor."', '".$itemstiempo[$fila]."','".$qr[$fila]."','".$nfc[$fila]."','".$llegue[$fila]."')";

                Db::insert($query);
            }
        }

        public function getObjetivos(){
            $query="SELECT * FROM objetivos";
                                        
            return Db::queryAll($query);
        }

        public function getClientes(){
            $query="SELECT * FROM clientes ORDER BY nombre ASC";

            return Db::queryAll($query);
        }

        public function getPuntosControlCliente($idCliente,$objetivoCliente){
            $query="SELECT * FROM puntoscontrol WHERE id_cliente = $idCliente AND id_objetivo = $objetivoCliente";
                                        
            return Db::queryAll($query);
        }
        
        
        public function eliminarRonda($idcambiarEstado){
            $query= "UPDATE puntoscontrol SET estado = '0' WHERE id = :id";

            return Db::update($query, $idcambiarEstado);
       }

       public function modificarRonda($arrayModificar){
           $query= "UPDATE puntoscontrol SET nombre = :nombre, objetivo = :objetivo WHERE id = :id";

           return Db::update($query, $arrayModificar);
        }

       public function getRondas($id){
           $query = "SELECT * FROM rondas WHERE id_cliente = $id AND activo = 1";

           return Db::queryAll($query);
       }
       
       public function updateRonda($idRonda, $nombreRonda, $estadoRonda){
           $query = "UPDATE rondas SET nombre = '".$nombreRonda."', estado = $estadoRonda WHERE id = $idRonda";

           return Db::update($query);
       }

       public function deleteRonda($idRonda){
           $query = "UPDATE rondas SET activo = '0' WHERE id = $idRonda";

           return Db::update($query);
       }

       public function listarItemsRonda($idRonda){
           $query = "SELECT puntoscontrol.nombre, item_ronda.orden, item_ronda.tiempo, item_ronda.qr, item_ronda.nfc, item_ronda.llegue, puntoscontrol.objetivo 
                     FROM item_ronda 
                     INNER JOIN puntoscontrol ON item_ronda.id_puntocontrol = puntoscontrol.id WHERE id_ronda = '".$idRonda."'";

            return Db::queryAll($query);
       }

       public function listarObjetivosCliente($idCliente){
        $query = "SELECT LTRIM(RTRIM(obj.nombre)) AS 'nombre_objetivo', obj.codigo AS 'codigo_objetivo' FROM dbo.clientes_por_objetivo AS cli
        LEFT JOIN objetivos obj ON obj.codigo = cli.objetivo
        INNER JOIN clientes c ON c.codigo = cli.cliente
        WHERE cli.cliente = $idCliente";

        return Db::queryAll($query);

    }  
}
    
?>