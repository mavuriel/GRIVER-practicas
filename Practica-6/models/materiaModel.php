<?php
require_once '../config/conexion.php';
/**
 * Esta clase manipula los datos de las materias
 *
 * @author Uriel Tenorio <trainee.urielat@griver.com.mx>
 * @copyright 2021 RECO By SOFTDEM. All rights reserved.
 */
class Materia extends Conexion
{
    /**
     * Inserta los datos de una materia
     *
     * Este metodo obtiene los datos del nombre y creditos de la materia
     * y los inserta dentro de la tabla
     *
     * @access public
     * @param string $sNombreInsertar
     * @param int $nCreditosInsertar
     * @return string
     */
    public function Insertar($sNombreInsertar, $nCreditosInsertar)
    {
        $oConexion = new Conexion;
        $db = $oConexion->conectar();
        $consulta = $db
            ->prepare("INSERT INTO materias (sNombre,nCreditos) VALUES (?,?)");
        $consulta->bind_param("si", $sNombreBind, $nCreditosBind);

        $sNombreBind = $sNombreInsertar;
        $nCreditosBind = $nCreditosInsertar;

        $consulta->execute();

        $consulta->close();
        $db->close();
        return 'Dato ingresado con exito';
    }

    /**
     * Elimina los datos de una materia.
     *
     * Este metodo elimina de la tabla los datos de una materia
     * seleccionada por su id.
     *
     * @access public
     * @param int $nIdSeleccionado
     * @return string
     */
    public function Eliminar($nIdSeleccionado)
    {
        $oConexion = new Conexion;
        $db = $oConexion->conectar();
        $consulta = $db
            ->prepare("DELETE FROM materias WHERE nIdMateria = ?");
        $consulta->bind_param("i", $nIdCondicion);
        $nIdCondicion = $nIdSeleccionado;
        $consulta->execute();

        $consulta->close();
        $db->close();

        return 'Dato borrado';
    }

    /**
     * Actualiza los datos de una materia
     *
     * Este metodo actualiza los datos de nombre y creditos de una materia,
     * de acuerdo al id seleccionado
     *
     * @access public
     * @param string $sNombreActualizar
     * @param int $nCreditosActualizar
     * @param int $nIdActualizar
     * @return string
     */
    public function Actualizar($sNombreActualizar, $nCreditosActualizar, $nIdActualizar)
    {
        $oConexion = new Conexion;
        $db = $oConexion->conectar();
        $consulta = $db
            ->prepare("UPDATE materias SET sNombre = ?, nCreditos=? WHERE nIdMateria = ?");
        $consulta->bind_param("sii", $sNombrenSet, $nCreditosnSet, $nIdCondicion);

        $sNombrenSet = $sNombreActualizar;
        $nCreditosnSet = $nCreditosActualizar;
        $nIdCondicion = $nIdActualizar;

        $consulta->execute();

        $consulta->close();
        $db->close();
        return 'Dato actualizado con exito';
    }

    /**
     * Obtiene los datos de un registro
     *
     * Este metodo obtiene el nombre y creditos de un registro de acuerdo
     * a un id seleccionado
     *
     * @access public
     * @param int $nIdSeleccionado
     * @return array
     */
    public function UnRegistro($nIdSeleccionado)
    {
        $oConexion = new Conexion();
        $db = $oConexion->conectar();
        $consulta = $db
            ->prepare("SELECT * FROM materias WHERE nIdMateria = ?");

        $consulta->bind_param("i", $nIdCondicion);

        $nIdCondicion = $nIdSeleccionado;

        $consulta->execute();

        $consulta->bind_result($nIdResult, $sNombreResult, $nClaveResult);

        $aDatosResult = [];
        while ($consulta->fetch() != null) {
            $aDatosResult[] = $nIdResult;
            $aDatosResult[] = $sNombreResult;
            $aDatosResult[] = $nClaveResult;
        }

        return $aDatosResult;
    }

    /**
     * Obtiene todos los registros.
     *
     * Este metodo obtiene todos los datos de la tabla de materias.
     *
     * @access public
     * @return array
     */
    public function TodosRegistros()
    {
        $oConexion = new Conexion;
        $aDatosRegistros = $oConexion->consultaTodo("SELECT * FROM materias");
        return $aDatosRegistros;
    }
}
