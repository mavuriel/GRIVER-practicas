<?php
const HOST = 'localhost';
const USER = 'root';
const PASS = '12345';
const DB = 'escuela';

/**
 * Esta clase permite la conexion a la base de datos
 *
 * @author Uriel Tenorio <trainee.urielat@griver.com.mx>
 * @copyright 2021 RECO By SOFTDEM. All rights reserved.
 */
class Conexion
{
    /**
     * Conecta con la base de datos
     *
     * Este metodo permite realizar la conexion a la base de datos,
     * utilizando los datos de acceso y retorna el objeto de conexion
     * utilizado en las consultas.
     *
     * @access public
     */
    public function Conectar()
    {
        $mysql = new mysqli(HOST, USER, PASS, DB);
        return $mysql;
    }

    /**
     * Obtiene todos los datos
     *
     * Este metodo obtiene todos los datos de una consulta, 
     * la setencia sql es recibida por el metodo.
     *
     * @access public
     * @param string $query
     * @return array
     */
    public function ConsultaTodo($query)
    {
        $sql = $this->Conectar()->query($query);

        $aDatosResultado = $sql->fetch_all();

        return $aDatosResultado;
    }
}
