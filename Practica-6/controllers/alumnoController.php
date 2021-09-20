<?php
require_once '../models/alumnoModel.php';

if (isset($_POST['accion'])) {
    $sAccion = $_POST['accion'];
    $nIdP = isset($_POST['id']) ? $_POST['id'] : '';
    $sNombreP = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $sApellidoP = isset($_POST['apellido']) ? $_POST['apellido'] : '';

    /* TODO: validar php */

    switch ($sAccion) {
        case 'todo':

            $oAlumno = new Alumno;
            $aAlumnos = $oAlumno->TodosRegistros();
            echo json_encode($aAlumnos);

            break;

        case 'insertar':

            $oAlumnoController = new AlumnoController;
            $sMsnInsertar = $oAlumnoController->Insertar($sNombreP, $sApellidoP);
            echo $sMsnInsertar;

            break;

        case 'actualizar':

            $oAlumnoController = new AlumnoController;
            $sMsnActualizar = $oAlumnoController->Actualizar($sNombreP, $sApellidoP, $nIdP);
            echo $sMsnActualizar;

            break;

        case 'eliminar':

            $oAlumnoController = new AlumnoController;
            $sMsnEliminar = $oAlumnoController->Eliminar($nIdP);
            echo $sMsnEliminar;

            break;

        case 'seleccionar':
            $oAlumnoController = new AlumnoController;
            $aDatosAlumno = $oAlumnoController->Seleccionar($nIdP);
            echo $aDatosAlumno;
            break;

        default:
            # code...
            break;
    }
}

class AlumnoController
{

    public function Insertar($sNombre, $sApellido)
    {
        $oAlumno = new Alumno;
        $sInsertar = $oAlumno->Insertar($sNombre, $sApellido);
        $msnInsertar = ['mensaje' => $sInsertar];
        return json_encode($msnInsertar);
    }

    public function Actualizar($sNombre, $sApellido, $nId)
    {
        $oAlumno = new Alumno;
        $sActualizar = $oAlumno->Actualizar($sNombre, $sApellido, $nId);
        $msnActualizar = ['mensaje' => $sActualizar];
        return json_encode($msnActualizar);
    }

    public function Eliminar($nId)
    {
        $oAlumno = new Alumno;
        $sEliminar = $oAlumno->Eliminar($nId);
        $msnEliminar = ['mensaje' => $sEliminar];
        return json_encode($msnEliminar);
    }

    public function Seleccionar($nId)
    {
        $oAlumno = new Alumno;
        $aDatosAlumno = $oAlumno->UnRegistro($nId);
        return json_encode($aDatosAlumno);
    }
}
