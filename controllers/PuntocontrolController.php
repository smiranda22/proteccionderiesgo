<?php
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
            case 'tablacontrolCliente':
                $this->tablaControlCliente($_POST);exit();    
                break;          
            default:
        }  
	   
        $this->data['title'] = "";
		$this->data['content'] = "";
        
        //Cargo la ruta de la pagina
        $this->view = 'puntocontrol/puntocontrol';


        if ($_SESSION['idCliente']){
            $idCliente = $_SESSION['idCliente'];
            $this->listarObjetivos($idCliente);
        }
            //Obtengo los clientes para el option de Clientes
            $clientes = $this->getClientes();

            $this->data['cliente'] = $clientes;


    }

/***** ----------EMPIEZAN LAS FUNCIONES---------- *****/

    //OBTENGO LOS CLIENTES
    public function getClientes(){

        $cli = new PuntocontrolManager;

        $clientes = $cli->getClientes();
        
        return $clientes;

    }

    //LISTO LOS OBJETIVOS SEGUN EL CLIENTE
    public function listarObjetivos($data){

        $idCliente = $data['idCliente'];

        $listarObjetivos = new PuntocontrolManager();

        echo json_encode($listarObjetivos->listarObjetivos($idCliente));
    }



    //CARGAMOS LA TABLA DE CONTROLES SEGUN EL CLIENTE SELECCIONADO
    public function tablaControlCliente($data){

        $idCliente = $data['id_cliente'];
        $idobjetivoCliente = $data['id_objetivo'];

        $tablaControlCliente = new PuntocontrolManager();

        $result = $tablaControlCliente->getControlCliente($idCliente,$idobjetivoCliente);

        echo json_encode($result);

    }



    //CARGO UN NUEVO CONTROL
    public function cargaControl($data) {
        
        $date = date("Y-m-d");

        $idcliente = $data['id'];
        $nombre = $data['nombre'];
        $id_objetivo = $data['id_objetivo'];
        $objetivo = $data['objetivo'];
        $fecha = $date;

        $control = new PuntocontrolManager;
            
        $carga = $control->cargaControl($idcliente,$nombre,$id_objetivo,$objetivo,$fecha);
        
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

        $consultaControl = $control->issetControl($idcambiarEstado);

        if ($consultaControl==0){
            $eliminaControl = $control->eliminarControl($idcambiarEstado);

            if($eliminaControl){
                echo "Control eliminado correctamente";
            }else{
                echo "Error al eliminar el control";
            }
        }else{ 
           
            $controlAsignado = true;

        }
    }


    //ACTUALIZO UN CONTROL
    public function actualizaControl($data){

        $actualizoControl = array (
            'id'=> $data['id'],
            'nombre'=> $data['nombre'],
            'id_objetivo'=> $data['id_objetivo'],
            'objetivo'=>$data['objetivo']
            
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