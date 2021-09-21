<?php
require_once '../models/claseModel.php';

if (isset($_POST['accion'])) {
    $sAccion = $_POST['accion'];
    $nIdP = isset($_POST['id']) ? $_POST['id'] : '';
    $nIdProfesorP = isset($_POST['datouno']) ? $_POST['datouno'] : '';
    $nIdClaseP = isset($_POST['datodos']) ? $_POST['datodos'] : '';
    $sHorarioP = isset($_POST['horario']) ? $_POST['horario'] : '';

    switch ($sAccion) {
        case 'todo':

            $oClaseController = new ClaseController;
            $aClases = $oClaseController->TodosRegistros();
            echo $aClases;

            break;

        case 'insertar':

            $oClaseController = new ClaseController;
            $sMsnInsertar = $oClaseController->Insertar($nIdProfesorP, $nIdClaseP, $sHorarioP);
            echo $sMsnInsertar;

            break;

        case 'actualizar':

            $oClaseController = new ClaseController;
            $sMsnActualizar = $oClaseController->Actualizar($nIdProfesorP, $nIdClaseP, $sHorarioP, $nIdP);
            echo $sMsnActualizar;

            break;

        case 'eliminar':

            $oClaseController = new ClaseController;
            $sMsnEliminar = $oClaseController->Eliminar($nIdP);
            echo $sMsnEliminar;

            break;

        case 'seleccionar':
            $oClaseController = new ClaseController;
            $aDatosClase = $oClaseController->Seleccionar($nIdP);
            echo $aDatosClase;
            break;

        default:
            # code...
            break;
    }
}

class ClaseController
{

    public function Insertar($nIdProfesor, $nIdClase, $sHorario)
    {
        require_once '../validacion.php';
        $aErrores = [];

        $aValidaciones = ValidaNumeros([$nIdProfesor, $nIdClase]);
        foreach ($aValidaciones as $error) {
            $aErrores[] = $error;
        }

        $aValidaTexto = ValidaDatos([$sHorario]);
        foreach ($aValidaTexto as $error) {
            $aErrores[] = $error;
        }

        if (empty($aErrores)) {
            $oClase = new Clase;
            $sInsertar = $oClase->Insertar($nIdProfesor, $nIdClase, $sHorario);
            $msnInsertar = ['mensaje' => $sInsertar];
            return json_encode($msnInsertar);
        } else {
            return json_encode($aErrores);
        }
    }

    public function Actualizar($nIdProfesor, $nIdClase, $sHorario, $nId)
    {
        require_once '../validacion.php';
        $aErrores = [];

        $aValidaciones = ValidaNumeros([$nIdProfesor, $nIdClase]);
        foreach ($aValidaciones as $error) {
            $aErrores[] = $error;
        }

        $aValidaTexto = ValidaDatos([$sHorario]);
        foreach ($aValidaTexto as $error) {
            $aErrores[] = $error;
        }
        if (empty($aErrores)) {
            $oClase = new Clase;
            $sActualizar = $oClase->Actualizar($nIdProfesor, $nIdClase, $sHorario, $nId);
            $msnActualizar = ['mensaje' => $sActualizar];
            return json_encode($msnActualizar);
        } else {
            return json_encode($aErrores);
        }

    }

    public function Eliminar($nId)
    {
        $oClase = new Clase;
        $sEliminar = $oClase->Eliminar($nId);
        $msnEliminar = ['mensaje' => $sEliminar];
        return json_encode($msnEliminar);
    }

    public function Seleccionar($nId)
    {
        $oClase = new Clase;
        $aDatosClase = $oClase->UnRegistro($nId);
        return json_encode($aDatosClase);
    }

    public function TodosRegistros()
    {
        $oClase = new Clase;
        $aClases = $oClase->TodosRegistros();

        return json_encode($aClases);
    }
}
