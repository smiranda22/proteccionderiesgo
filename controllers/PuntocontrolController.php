<?php
//session_destroy();
class PuntocontrolController extends Controller
{
	public function process($params){
        switch ($params[0]) {
            case 'cargacontrol':
                $this->cargaControl($_POST);exit();
                break;
            case 'eliminacontrol':
                $this->eliminarControl($_POST);exit();
                break; 
            case 'actualizacontrol':
                $this->actualizaControl($_POST);exit(); 
            case 'listarobjetivo':
                $this->listarObjetivos($_POST);exit();    
                break;  
                default:
        }  
	   
        $this->data['title'] = "";
		$this->data['content'] = "";
        
        //Cargo la ruta de la pagina
        $this->view = 'puntocontrol/puntocontrol';

        //Obtengo los clientes para el option de Clientes
        $clientes = $this->getClientes();

        $this->data['cliente'] = $clientes;

    }

    /* ----EMPIEZAN LAS FUNCIONES----- */

    //OBTENGO LOS CLIENTES
    public function getClientes(){

        $cli = new PuntocontrolManager;

        $clientes = $cli->getClientes();
        
        return $clientes;

    }

    //LISTO LOS OBJETIVOS SEGUN EL CLIENTE
    public function listarObjetivos($data){

        $idCliente = $data['id'];

        $listarObjetivos = new PuntocontrolManager();

        $array = "hola";

        return $array;
    }



    //CARGO UN NUEVO CONTROL
    public function cargaControl($data) {
        
        $date = date("Y-m-d H:i:s");

        $idcliente = $data['id'];
        $nombre = $data['nombre'];
        $objetivo = $data['objetivo'];
        $fecha = $date;

        var_dump($fecha);

        $control = new PuntocontrolManager;
        
        $carga = $control->cargaControl($idcliente,$nombre,$objetivo,$fecha);

        if($carga){
            echo "Control cargado correctamente";
        }else{
            echo "Error al cargar el control";
        }
    }
    

    //ELIMINO UN CONTROL
    public function eliminarControl($data){

        $idcambiarEstado = array (
            'id'=> $data['id'],
        );

        $control = new PuntocontrolManager;

        $eliminaControl = $control->eliminarControl($idcambiarEstado);

        if($eliminaControl){
            return "Control eliminado correctamente";
        }else{
            return "Error al eliminar el control";
        }

    }


    //ACTUALIZO UN CONTROL
    public function actualizaControl($data){

        $actualizoControl = array (
            'nombre'=> $data['nombre'],
            'objetivo'=> $data['objetivo'],
            'id'=> $data['id']
        );

        $control = new PuntocontrolManager;

        $eliminaControl = $control->actualizarControl($actualizoControl);

        if($eliminaControl){
            return "Control actualizado correctamente";
        }else{
            return "Error al actualizado el control";
        }

    }


}