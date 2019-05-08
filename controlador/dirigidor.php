<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// la ruta esta así porque accede es desde el index que esta en la raiz
require ('../modelo/conexion.php' ); 
class guardado extends conexion{
    public function guardado(){
        parent::__construct();
        
    }
    
    public function setGuardado($nombre,$precio,$pais){
        try {
            $query="INSERT INTO productos (NOMBRE,PRECIO,PAISORIGEN) 
            VALUES(:nombre,:precio,:pais)";
            $rs=$this->con->prepare($query);
            $rs->execute(array(':nombre'=>$nombre,':precio'=>$precio,'pais'=>$pais));
            // echo "funciono el primer guardado";
        } catch (\Throwable $e) {
            echo $e;
        }finally{
            $this->con=null;
        }
    }
    
    public function getProductos(){
        try {
            $query="SELECT * FROM productos";
            $query=$this->con->prepare($query);
            $query->execute(array());
            $rs=$query->fetchAll(PDO::FETCH_ASSOC);
            $query->closeCursor();
            $outp = "";
            
            
            foreach ($rs as $i ) {
                if ($outp != "") {$outp .= ",";}
                $outp .= '{"Nombre":"'  . $rs["NOMBRE"] . '",';
                    $outp .= '"Precio":"'   . $rs["PRECIO"]        . '",';
                    $outp .= '"pais":"'. $rs["PAISORIGEN"]     . '"}';
                }
                
                $outp ='{"records":['.$outp.']}';
                echo $outp;
                
                return $outp;
            } catch (\Throwable $th) {
                echo $th;
            }finally{
                $this->con=null;
            }
        }
        
        public function deleteProductos($nombre,$pais){
            try {
                
                $query="DELETE FROM PRODUCTOS WHERE NOMBRE= :nombre AND PAISORIGEN= :pais";
                $rs=$this->con->prepare($query);
                $rs->execute(array('nombre'=>$nombre,'pais'=>$pais));
            } catch (\Throwable $th) {
                echo $th;
            }finally{
                $this->con=null;
            }
            
        }
        
        public function modifProducto($nombre,$precio,$pais){
            try {
                $query="UPDATE PRODUCTOS set NOMBRE= :nombre, PRECIO= :precio, PAISORIGEN= :pais 
                WHERE ID_ARTICULO='AR02'";
                $rs=$this->con->prepare($query);
                $rs->execute(array('nombre'=>$nombre,'precio'=>$precio,'pais'=>$pais));
            } catch (\Throwable $th) {
                echo $th;
            }finally{
                $this->con=null;
            }
            
        }
    }
    ?>