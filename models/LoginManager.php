<?php

class LoginManager{


    public function getUsuario($usuario, $password){
        $query="SELECT * FROM usuarios WHERE nombre='".$usuario."' AND password='". $password ."'";
                                    
        return Db::queryOne($query);
        
        }
    
    
    }
?>  