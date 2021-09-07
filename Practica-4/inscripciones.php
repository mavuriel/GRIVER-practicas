<?php
class Inscripcion extends Conexion
{
    public function Insertar($nIdAlumnoInsertar, $nIdClaseInsertar)
    {
        $oConexion = new Conexion;
        $db = $oConexion->Conectar();
        $consulta = $db
            ->prepare("INSERT INTO inscripciones (nIdAlumno,nIdClase) VALUES (?,?)");
        $consulta->bind_param("ii", $nIdAlumnoBind, $nIdClaseBind);

        $nIdAlumnoBind = $nIdAlumnoInsertar;
        $nIdClaseBind = $nIdClaseInsertar;

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
            ->prepare("DELETE FROM inscripciones WHERE nIdInscripcion = ?");
        $consulta->bind_param("i", $nIdCondicion);
        $nIdCondicion = $nIdSeleccionado;
        $consulta->execute();

        $consulta->close();
        $db->close();

        return 'Dato borrado';
    }

    public function Actualizar($nIdNombreActualizar, $nIdClaseActualizar, $nIdActualizar)
    {
        $oConexion = new Conexion;
        $db = $oConexion->Conectar();
        $consulta = $db
            ->prepare("UPDATE inscripciones SET nIdAlumno = ?, nIdClase=? WHERE nIdInscripcion = ?");
        $consulta->bind_param("iii", $nIdNombreSet, $nIdClaseSet, $nIdCondicion);


        $nIdNombreSet = $nIdNombreActualizar;
        $nIdClaseSet = $nIdClaseActualizar;
        $nIdCondicion = trim($nIdActualizar);

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
            ->prepare("SELECT
                            a.nIdInscripcion,
                            p.sNombre nombreprofesor,
                            q.sNombre nombremateria,
                            c.sNombre nombrealumno
                    FROM
                            inscripciones a
                            INNER JOIN (clases b INNER JOIN profesores p on b.nIdProfesor = p.nIdProfesor) ON a.nIdClase = b.nIdClase
                            INNER JOIN (clases z INNER JOIN materias q on z.nIdMateria = q.nIdMateria) ON a.nIdClase = z.nIdClase
                            INNER JOIN alumnos c ON a.nIdAlumno = c.nIdAlumno
                    WHERE nIdInscripcion = ?");

        $consulta->bind_param("i", $nIdCondicion);

        $nIdCondicion = $nIdSeleccionado;

        $consulta->execute();

        $consulta->bind_result($nIdResult, $sNombreProfesorResult, $sNombreMateriaResult, $sNombreAlumnoResult);

        $aDatosResult = [];
        while ($consulta->fetch() != null) {
            $aDatosResult[] = $nIdResult;
            $aDatosResult[] = $sNombreProfesorResult;
            $aDatosResult[] = $sNombreMateriaResult;
            $aDatosResult[] = $sNombreAlumnoResult;
        }

        return $aDatosResult;
    }

    public function TodosRegistros()
    {
        $oConexion = new conexion;
        $sql = "SELECT
                        a.nIdInscripcion,
                        q.sNombre nombremateria,
                        c.sNombre nombrealumno
                FROM
                inscripciones a
                INNER JOIN (clases b INNER JOIN profesores p on b.nIdProfesor = p.nIdProfesor) ON a.nIdClase = b.nIdClase
                INNER JOIN (clases z INNER JOIN materias q on z.nIdMateria = q.nIdMateria) ON a.nIdClase = z.nIdClase
                INNER JOIN alumnos c ON a.nIdAlumno = c.nIdAlumno
                ORDER BY nIdInscripcion";
        $aDatosRegistros = $oConexion->ConsultaTodo($sql);
        return $aDatosRegistros;
    }
}
