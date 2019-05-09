<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$json = file_get_contents('php://input');
$obj = json_decode($json);

// $accion=$obj->accion;
// $nombre=$obj->nombre;
// $precio=$obj->precio;
// $pais=$obj->pais;

try{
$con=new PDO("mysql:host=localhost; dbname=empresa","root","");
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query="SELECT * FROM productos";
$query=$con->prepare($query);
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
?>
