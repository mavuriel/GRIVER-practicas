<?php
require_once '../models/alumnoModel.php';

if (isset($_POST['accion'])) {
    $sAccion = $_POST['accion'];
    $nIdP = isset($_POST['id']) ? $_POST['id'] : '';
    $sNombreP = isset($_POST['datouno']) ? $_POST['datouno'] : '';
    $sApellidoP = isset($_POST['datodos']) ? $_POST['datodos'] : '';

    switch ($sAccion) {
        case 'todo':

            $oAlumnoController = new AlumnoController;
            $aAlumnos = $oAlumnoController->TodosRegistros();
            echo $aAlumnos;

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
        require_once '../validacion.php';
        $aValidaciones = ValidaDatos([$sNombre, $sApellido]);
        $aErrores = [];
        foreach ($aValidaciones as $error) {
            $aErrores[] = $error;
        }
        if (empty($aErrores)) {
            $oAlumno = new Alumno;
            $sInsertar = $oAlumno->Insertar($sNombre, $sApellido);
            $msnInsertar = ['mensaje' => $sInsertar];
            return json_encode($msnInsertar);
        } else {
            return json_encode($aErrores);
        }
    }

    public function Actualizar($sNombre, $sApellido, $nId)
    {
        require_once '../validacion.php';
        $aValidaciones = ValidaDatos([$sNombre, $sApellido]);
        $aErrores = [];
        foreach ($aValidaciones as $error) {
            $aErrores[] = $error;
        }
        if (empty($aErrores)) {
            $oAlumno = new Alumno;
            $sActualizar = $oAlumno->Actualizar($sNombre, $sApellido, $nId);
            $msnActualizar = ['mensaje' => $sActualizar];
            return json_encode($msnActualizar);
        } else {
            return json_encode($aErrores);
        }

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

    public function TodosRegistros()
    {
        $oAlumno = new Alumno;
        $aAlumnos = $oAlumno->TodosRegistros();

        return json_encode($aAlumnos);
    }
}
