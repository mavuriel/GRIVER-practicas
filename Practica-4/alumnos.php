<?php
class Alumno extends Conexion
{
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

    public function TodosRegistros()
    {
        $oConexion = new Conexion;
        $aDatosRegistros = $oConexion->ConsultaTodo("SELECT * FROM alumnos");
        return $aDatosRegistros;
    }
}
