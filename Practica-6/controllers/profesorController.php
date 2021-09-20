<?php
require_once '../models/profesorModel.php';

if (isset($_POST['accion'])) {
    $sAccion = $_POST['accion'];
    $nIdP = isset($_POST['id']) ? $_POST['id'] : '';
    $sNombreP = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $sApellidoP = isset($_POST['apellido']) ? $_POST['apellido'] : '';

    switch ($sAccion) {
        case 'todo':

            $oProfesorController = new ProfesorController;
            $aProfesor = $oProfesorController->TodosRegistros();
            echo $aProfesor;

            break;

        case 'insertar':

            $oProfesorController = new ProfesorController;
            $sMsnInsertar = $oProfesorController->Insertar($sNombreP, $sApellidoP);
            echo $sMsnInsertar;

            break;

        case 'actualizar':

            $oProfesorController = new ProfesorController;
            $sMsnActualizar = $oProfesorController->Actualizar($sNombreP, $sApellidoP, $nIdP);
            echo $sMsnActualizar;

            break;

        case 'eliminar':

            $oProfesorController = new ProfesorController;
            $sMsnEliminar = $oProfesorController->Eliminar($nIdP);
            echo $sMsnEliminar;

            break;

        case 'seleccionar':
            $oProfesorController = new ProfesorController;
            $aDatosProfesor = $oProfesorController->Seleccionar($nIdP);
            echo $aDatosProfesor;
            break;

        default:
            # code...
            break;
    }
}

class ProfesorController
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
            $oProfesor = new Profesor;
            $sInsertar = $oProfesor->Insertar($sNombre, $sApellido);
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
            $oProfesor = new Profesor;
            $sActualizar = $oProfesor->Actualizar($sNombre, $sApellido, $nId);
            $msnActualizar = ['mensaje' => $sActualizar];
            return json_encode($msnActualizar);
        } else {
            return json_encode($aErrores);
        }

    }

    public function Eliminar($nId)
    {
        $oProfesor = new Profesor;
        $sEliminar = $oProfesor->Eliminar($nId);
        $msnEliminar = ['mensaje' => $sEliminar];
        return json_encode($msnEliminar);
    }

    public function Seleccionar($nId)
    {
        $oProfesor = new Profesor;
        $aDatosProfesor = $oProfesor->UnRegistro($nId);
        return json_encode($aDatosProfesor);
    }

    public function TodosRegistros()
    {
        $oProfesor = new Profesor;
        $aProfesor = $oProfesor->TodosRegistros();

        return json_encode($aProfesor);
    }
}
