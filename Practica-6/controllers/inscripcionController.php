<?php
require_once '../models/inscripcionModel.php';

if (isset($_POST['accion'])) {
    $sAccion = $_POST['accion'];
    $nIdP = isset($_POST['id']) ? $_POST['id'] : '';
    $nIdAlumnoP = isset($_POST['datouno']) ? $_POST['datouno'] : '';
    $nIdClaseP = isset($_POST['datodos']) ? $_POST['datodos'] : '';

    switch ($sAccion) {
        case 'todo':

            $oInscripcionController = new InscripcionController;
            $aInscripcions = $oInscripcionController->TodosRegistros();
            echo $aInscripcions;

            break;

        case 'insertar':

            $oInscripcionController = new InscripcionController;
            $sMsnInsertar = $oInscripcionController->Insertar($nIdAlumnoP, $nIdClaseP);
            echo $sMsnInsertar;

            break;

        case 'actualizar':

            $oInscripcionController = new InscripcionController;
            $sMsnActualizar = $oInscripcionController->Actualizar($nIdAlumnoP, $nIdClaseP, $nIdP);
            echo $sMsnActualizar;

            break;

        case 'eliminar':

            $oInscripcionController = new InscripcionController;
            $sMsnEliminar = $oInscripcionController->Eliminar($nIdP);
            echo $sMsnEliminar;

            break;

        case 'seleccionar':
            $oInscripcionController = new InscripcionController;
            $aDatosInscripcion = $oInscripcionController->Seleccionar($nIdP);
            echo $aDatosInscripcion;
            break;

        default:
            # code...
            break;
    }
}

class InscripcionController
{

    public function Insertar($nIdAlumno, $nIdClase)
    {
        require_once '../validacion.php';
        $aErrores = [];

        $aValidaciones = ValidaNumeros([$nIdAlumno, $nIdClase]);
        foreach ($aValidaciones as $error) {
            $aErrores[] = $error;
        }

        if (empty($aErrores)) {
            $oInscripcion = new Inscripcion;
            $sInsertar = $oInscripcion->Insertar($nIdAlumno, $nIdClase);
            $msnInsertar = ['mensaje' => $sInsertar];
            return json_encode($msnInsertar);
        } else {
            return json_encode($aErrores);
        }
    }

    public function Actualizar($nIdProfesor, $nIdInscripcion, $nId)
    {
        require_once '../validacion.php';
        $aErrores = [];

        $aValidaciones = ValidaNumeros([$nIdProfesor, $nIdInscripcion]);
        foreach ($aValidaciones as $error) {
            $aErrores[] = $error;
        }
        if (empty($aErrores)) {
            $oInscripcion = new Inscripcion;
            $sActualizar = $oInscripcion->Actualizar($nIdProfesor, $nIdInscripcion, $nId);
            $msnActualizar = ['mensaje' => $sActualizar];
            return json_encode($msnActualizar);
        } else {
            return json_encode($aErrores);
        }

    }

    public function Eliminar($nId)
    {
        $oInscripcion = new Inscripcion;
        $sEliminar = $oInscripcion->Eliminar($nId);
        $msnEliminar = ['mensaje' => $sEliminar];
        return json_encode($msnEliminar);
    }

    public function Seleccionar($nId)
    {
        $oInscripcion = new Inscripcion;
        $aDatosInscripcion = $oInscripcion->UnRegistro($nId);
        return json_encode($aDatosInscripcion);
    }

    public function TodosRegistros()
    {
        $oInscripcion = new Inscripcion;
        $aInscripcions = $oInscripcion->TodosRegistros();

        return json_encode($aInscripcions);
    }
}
