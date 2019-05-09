<?php
$json = file_get_contents('php://input');
$obj = json_decode($json);

require ('dirigidor.php');
$ejecucion=new guardado();

if (isset($obj)){
    
    $accion=$obj->accion;
    $nombre=$obj->nombre;
    $precio=$obj->precio;
    $pais=$obj->pais;
    
    switch ($accion) {
        
        case 'guardar':
        $ejecucion->setGuardado($nombre,$precio,$pais);
        break;
        
        case 'eliminar':
        $ejecucion->deleteProductos($nombre,$pais);
        break;
        
        case 'modificar':
            $ejecucion->modifProducto($nombre,$precio,$pais);
            break;
        }
    }else{
        $ejecucion->getProductos();
        
    }
    
    ?>