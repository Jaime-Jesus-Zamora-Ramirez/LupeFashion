<?php

class conexion
{
    //siempre son estas variables para la conexion ala base de datos

    private $servidor = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $db_name = "lupefashion";
    public $conexion;

    //creamos un construct para que se ejecute al inicializarse la conexion 

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->servidor;dbname=$this->db_name", $this->usuario, $this->contrasena);
            //accedemos a un atributo para permitir manejar los catch
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "conexion establecida";
            //print('conexion establecida');
        } catch (PDOException $error) {
            echo "Erro al establecer la conexion ala base de datos";
        }
    }
    public function ejecutar($sql)
    { //insertar/delete/actualizar
        $this->conexion->exec($sql); //ejecutra una instruccion sql
        return $this->conexion->lastInsertId(); //nos regresa o retorna un id insertado
    }

    public function consultar($sql)
    {
        $sentecia = $this->conexion->prepare($sql);//guardamos la informacion con prepare
        $sentecia->execute();//ejecutamos
        return $sentecia->fetchAll();//retormanos todos los registros pero tambien se puede hacer por columnas o registros
    }
}
//solo para verificar si hay conexion accediendo al conexion.php
//new conexion();
