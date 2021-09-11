<?php

/**
 * Esta clase manipula la informacion del alumno.
 *
 * @author Uriel Tenorio <trainee.urielat@griver.com.mx>
 * @copyright 2021 RECO By SOFTDEM. All rights reserved.
 */
class Alumno extends Conexion
{
    /**
     * Inserta los datos del alumnos.
     *
     * Este metodo recibe los datos del alumno para su posterior insercion en la    base de datos.
     *
     * @access public
     * @param string $sNombreInsertar
     * @param string $sApellidoInsertar
     * @return string
     */
    public function Insertar($sNombreInsertar, $sApellidoInsertar)
    {
        $oConexion = new Conexion;
        $db = $oConexion->Conectar();
        $consulta = $db
            ->prepare("INSERT INTO alumnos (sNombre,sApellido) VALUES (?,?)");
        $consulta->bind_param("ss", $sNombreBind, $sApellidoBind);

        $sNombreBind = $sNombreInsertar;
        $sApellidoBind = $sApellidoInsertar;

        $consulta->execute();

        $consulta->close();
        $db->close();
        return 'Dato ingresado con exito';
    }

    /**
     * Elimina los datos de un alumno.
     *
     * Este metodo recibe el id del alumno para su posterior busqueda y eliminacion * de datos.
     *
     * @access public
     * @param int $nIdSeleccionado
     * @return string
     */
    public function Eliminar($nIdSeleccionado)
    {
        $oConexion = new Conexion;
        $db = $oConexion->Conectar();
        $consulta = $db
            ->prepare("DELETE FROM alumnos WHERE nIdAlumnos = ?");
        $consulta->bind_param("i", $nIdCondicion);
        $nIdCondicion = $nIdSeleccionado;
        $consulta->execute();

        $consulta->close();
        $db->close();

        return 'Dato borrado';
    }
    /**
     * Actualiza la informacion de un alumno.
     *
     * Este metodo recibe los datos del alumno que seran actualizados, incluyendo su * id para ubicar al alumno que se actualizara.
     *
     * @access public
     * @param string $sNombreActualizar
     * @param string $sApellidoActualizar
     * @param int $nIdActualizar
     * @return string
     */
    public function Actualizar($sNombreActualizar, $sApellidoActualizar, $nIdActualizar)
    {
        $oConexion = new Conexion;
        $db = $oConexion->Conectar();
        $consulta = $db
            ->prepare("UPDATE alumnos SET sNombre = ?, sApellido=? WHERE nIdAlumno = ?");
        $consulta->bind_param("ssi", $sNombreSet, $sApellidoSet, $nIdCondicion);

        $sNombreSet = $sNombreActualizar;
        $sApellidoSet = $sApellidoActualizar;
        $nIdCondicion = $nIdActualizar;

        $consulta->execute();

        $consulta->close();
        $db->close();
        return 'Dato actualizado con exito';
    }

    /**
     * Obtiene los datos de un alumno.
     *
     * Este metodo obtiene el id, nombre y apellidos de un alumno de acuerdo a su id.
     *
     * @access public
     * @param int $nIdSeleccionado
     * @return array
     */
    public function UnRegistro($nIdSeleccionado)
    {
        $oConexion = new Conexion();
        $db = $oConexion->Conectar();
        $consulta = $db
            ->prepare("SELECT * FROM alumnos WHERE nIdAlumno = ?");

        $consulta->bind_param("i", $nIdCondicion);

        $nIdCondicion = $nIdSeleccionado;

        $consulta->execute();

        $consulta->bind_result($nIdResult, $sNombreResult, $sApellidoResult);

        $aDatosResult = [];
        while ($consulta->fetch() != null) {
            $aDatosResult[] = $nIdResult;
            $aDatosResult[] = $sNombreResult;
            $aDatosResult[] = $sApellidoResult;
        }

        return $aDatosResult;
    }

    /**
     * Obtiene todos los registros de alumnos.
     *
     * Este metodo obtiene todos los registros de la tabla de alumnos, con ayuda de * un metodo de la clase conexion.
     *
     * @access public
     * @return array
     */
    public function TodosRegistros()
    {
        $oConexion = new Conexion;
        $aDatosRegistros = $oConexion->ConsultaTodo("SELECT * FROM alumnos");
        return $aDatosRegistros;
    }
}
