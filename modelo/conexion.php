<?php
class conexion{
    protected $con;

    public function conexion(){
        try {
            //code...
        $this->con=new PDO('mysql:host=localhost;dbname=empresa','root','');
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->con->exec('SET CHARACTER SET utf8');
        return $this->con;
    } catch (\Throwable $th) {
        //throw $th;
    }
    }

}

?>