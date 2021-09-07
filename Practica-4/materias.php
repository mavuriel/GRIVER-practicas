<?php
class Materia extends Conexion
{
    public function Insertar($sNombreInsertar, $sCreditosInsertar)
    {
        $oConexion = new Conexion;
        $db = $oConexion->conectar();
        $consulta = $db
            ->prepare("INSERT INTO materias (sNombre,nCreditos) VALUES (?,?)");
        $consulta->bind_param("si", $sNombreBind, $nCreditosBind);


        $sNombreBind = $sNombreInsertar;
        $nCreditosBind = $sCreditosInsertar;

        $consulta->execute();

        $consulta->close();
        $db->close();
        return 'Dato ingresado con exito';
    }

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

    public function TodosRegistros()
    {
        $oConexion = new Conexion;
        $aDatosRegistros = $oConexion->consultaTodo("SELECT * FROM materias");
        return $aDatosRegistros;
    }
}
