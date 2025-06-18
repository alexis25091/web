<?php

class conexion{
    public static function conexionBD(){

        $host="localhost";
        $dbname="music_and_talent";
        $username="alexisbases";
        $password="alexisbases";
        $port="1433";

        try{

            $conn= new PDO("sqlsrv:server=$host,$port;Database=$dbname",$username,$password);
            $conn -> setAttribute(PDO:: ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//la linea de abajo del echo quitenle el que este comentada si lo necesitan para depurar y verificar que su vista funcione
            //echo ("se conecto a la base de datos");
        }
        catch(PDOException $pe){

            die("no se logro conectar a la base de datos".$pe -> getMessage());
        }

        return $conn;
    }
}


?>
