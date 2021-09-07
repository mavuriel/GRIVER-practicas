<?php
const HOST = 'localhost';
const USER = 'root';
const PASS = '12345';
const DB = 'escuela';

class Conexion
{
    public function Conectar()
    {
        $mysql = new mysqli(HOST, USER, PASS, DB);
        return $mysql;
    }

    public function ConsultaTodo($query)
    {
        $sql = $this->Conectar()->query($query);

        $aDatosResultado = $sql->fetch_all();

        return $aDatosResultado;
    }
}
