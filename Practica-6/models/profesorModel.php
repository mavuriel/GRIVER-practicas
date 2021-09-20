<?php
require_once '../config/conexion.php';
/**
 * Esta clase manipula los datos de los profesores.
 *
 * @author Uriel Tenorio <trainee.urielat@griver.com.mx>
 * @copyright 2021 RECO By SOFTDEM. All rights reserved.
 */
class Profesor extends Conexion
{

    /**
     * Inserta los datos del profesor.
     *
     * Este metodo obtiene el nombre y apellido del profesor para
     * insertarlos dentro de la tabla.
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
            ->prepare("INSERT INTO profesores (sNombre,sApellido) VALUES (?,?)");
        $consulta->bind_param("ss", $sNombreBind, $sApellidoBind);

        $sNombreBind = $sNombreInsertar;
        $sApellidoBind = $sApellidoInsertar;

        $consulta->execute();

        $consulta->close();
        $db->close();
        return 'Dato ingresado con exito';
    }

    /**
     * Elimina un profesor.
     *
     * Este metodo elimina todos los datos de un profesor
     * de acuerdo al id seleccionado.
     *
     * @access public
     * @param [type] $nIdSeleccionado
     * @return void
     */
    public function Eliminar($nIdSeleccionado)
    {
        $oConexion = new Conexion;
        $db = $oConexion->Conectar();
        $consulta = $db
            ->prepare("DELETE FROM profesores WHERE nIdProfesor = ?");
        $consulta->bind_param("i", $nIdCondicion);
        $nIdCondicion = $nIdSeleccionado;
        $consulta->execute();

        $consulta->close();
        $db->close();

        return 'Dato borrado';
    }

    /**
     * Actualiza los datos del profesor.
     *
     * Este metodo actualiza el nombre y apellido del profesor
     * de acuerdo al id seleccionado.
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
            ->prepare("UPDATE profesores SET sNombre = ?, sApellido=? WHERE nIdProfesor = ?");
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
     * Obtiene los datos de un registro.
     *
     * Este metodo obtiene los datos de un profesor
     * de acuerdo al id seleccionado.
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
            ->prepare("SELECT * FROM profesores WHERE nIdProfesor = ?");

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
     * Obtiene todos los registros de profesores.
     *
     * Este metodo obtiene todos los datos de profesores
     * de toda la tabla.
     *
     * @access public
     * @return array
     */
    public function TodosRegistros()
    {
        $oConexion = new Conexion;
        $aDatosRegistros = $oConexion->ConsultaTodo("SELECT * FROM profesores");
        return $aDatosRegistros;
    }
}
