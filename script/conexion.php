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
            echo ("se conecto a la base de datos");
        }
        catch(PDOException $pe){

            die("no se logro conectar a la base de datos".$pe -> getMessage());
        }

        return $conn;
    }
}


?>
