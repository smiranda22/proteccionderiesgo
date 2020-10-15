<?php
//session_destroy();
class RondaController extends Controller{

    public function process($params){
        switch ($params[0]) {
            case 'puntoscontrolCliente':
                $this->getPuntosContorlCliente($_POST);exit();
            break;
            case 'guardoronda':
                $this->guardoRonda($_POST);exit();
            break;
            default:
        break;
        } 
    


        $this->data['title'] = "";
        $this->data['content'] = "";

        $this->view = 'ronda';

        //Obtengo los clientes para el option de Clientes
        $clientes = $this->getClientes();

        $this-> data['cliente'] = $clientes;

    }

/************* COMIENZAN LOS SCRIPTS *************/

   //OBTENGO LOS CLIENTES PARA LAS RONDAS 

    public function getClientes(){

    $cli = new RondaManager;

    $clientes = $cli->getClientes();
    
    return $clientes;

    }

   //LISTO LOS PUNTOS DE CONTROL SEGUN EL CLIENTE
   
   public function getPuntosContorlCliente($data){

        $idCliente = $data['id_cliente'];

        $puntoCliente = new RondaManager;

        echo json_encode($puntoControlCliente = $puntoCliente -> getPuntosControlCliente($idCliente));


   }

   public function guardoRonda($data){
       
        $date = date("Y-m-d");

        $cargarRondas = new RondaManager;

        foreach($data as $ronda => $datos){
            foreach($datos as $indice => $valor)
            {
                    $nombre = $valor['nombreRonda'];
                    $idCliente = $valor['idCliente'];
                    $idControl = $valor['idControl'];
                    $fecha = $date;
            }
        }
        
        echo $cargaRonda = $cargarRondas -> cargaRonda($nombre,$idCliente,$idControl,$fecha);
       
   }

}


