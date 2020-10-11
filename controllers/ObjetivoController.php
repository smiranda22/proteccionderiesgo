<?php
//session_destroy();
class objetivoController extends Controller
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
                break;  
            case 'cargaritem':
                $this->actualizaControl($_POST);exit(); 
                break;      
            case 'cargaRonda':
                $this->cargaRonda($_POST);exit();
            default:
        }  
	   
        $this->data['title'] = "";
		$this->data['content'] = "";
        
        //Cargo la ruta de la pagina
        $this->view = '/objetivo';
        
        //Obtengo los objetivos para el option de Objetivos
        $objetivos=$this->getObjetivos();

        $this->data['objetivos']=$objetivos;

        //Obtengo los clientes para el option de Clientes
        $clientes=$this->getClientes();

        $this->data['clientes']=$clientes;

        //Obtengo los puntos de control de la BD para mostrarlos option Punto Control
        $controles=$this->listarControles();

        $this->data['controles']=$controles;
    }
        
    public function listarControles(){

        $control=new PuntocontrolManager();

        $controles=$control->listarControles();

        return $controles;
    }

    public function listarControl($data){

        $idlistarControl = array (
            'id'=> $data['id'],
        );

        $listarControl = new PuntocontrolManager();

        $controlListado=$listarControl->listarControl($idlistarControl);

        return $controlListado;
    }

    public function getObjetivos(){

        $obj=new PuntocontrolManager;

        $objetivos=$obj->getObjetivos();
        
        return $objetivos;

    }

    public function getClientes(){
        $cli=new ObjetivoManager;

        $clientes=$cli->getClientes();
        
        return $clientes;
    }

    public function getpControl(){
        $ctrl= new ObjetivoManager;

        $pControl = $ctrl->getPcontrol();

        return $pControl;
    }


    public function cargaControl($data) {
        
        $date = date("Y-m-d H:i:s");

        $array_control=array(
            'nombre'=> $data['nombre'],
            'objetivo'=>$data['objetivo'],
            'fecha'=>$date
        );

        $control= new PuntocontrolManager;
        
        $carga=$control->cargaControl($array_control);

        if($carga){
            echo "Control cargado correctamente";
        }else{
            echo "Error al cargar el control";
        }
    }
    
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

    public function actualizaControl($data){

        $actualizoControl = array (
            'nombre'=>$data['nombre'],
            'objetivo'=>$data['objetivo'],
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

    public function itemsRonda($data){

        $itemsRonda=array(
            'orden'=>$data['orden'],
            'nombre'=>$data['nombre'],
            'descripcion'=>$data['descripcion'],
            'cliente'=>$data['cliente']
        );

        return $itemsRonda;

    }

    public function cargaRonda($data){

        $date = date("Y-m-d H:i:s");

        $cargaRonda=array(
            'nombre'=>$data['nombre'],
            'controlRonda'=>$data['pcRonda'],
            'fecha'=>$date
        );

        return $cargaRonda;

    }


}