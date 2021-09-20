<?php
require_once '../models/materiaModel.php';

if (isset($_POST['accion'])) {
    $sAccion = $_POST['accion'];
    $nIdP = isset($_POST['id']) ? $_POST['id'] : '';
    $sNombreP = isset($_POST['datouno']) ? $_POST['datouno'] : '';
    $nCredito = isset($_POST['datodos']) ? $_POST['datodos'] : '';

    switch ($sAccion) {
        case 'todo':

            $oMateriaController = new MateriaController;
            $aMaterias = $oMateriaController->TodosRegistros();
            echo $aMaterias;

            break;

        case 'insertar':

            $oMateriaController = new MateriaController;
            $sMsnInsertar = $oMateriaController->Insertar($sNombreP, $nCredito);
            echo $sMsnInsertar;

            break;

        case 'actualizar':

            $oMateriaController = new MateriaController;
            $sMsnActualizar = $oMateriaController->Actualizar($sNombreP, $nCredito, $nIdP);
            echo $sMsnActualizar;

            break;

        case 'eliminar':

            $oMateriaController = new MateriaController;
            $sMsnEliminar = $oMateriaController->Eliminar($nIdP);
            echo $sMsnEliminar;

            break;

        case 'seleccionar':
            $oMateriaController = new MateriaController;
            $aDatosMateria = $oMateriaController->Seleccionar($nIdP);
            echo $aDatosMateria;
        default:
            # code...
            break;
    }
}

class MateriaController
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
            $oMateria = new Materia;
            $sInsertar = $oMateria->Insertar($sNombre, $sApellido);
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
            $oMateria = new Materia;
            $sActualizar = $oMateria->Actualizar($sNombre, $sApellido, $nId);
            $msnActualizar = ['mensaje' => $sActualizar];
            return json_encode($msnActualizar);
        } else {
            return json_encode($aErrores);
        }

    }

    public function Eliminar($nId)
    {
        $oMateria = new Materia;
        $sEliminar = $oMateria->Eliminar($nId);
        $msnEliminar = ['mensaje' => $sEliminar];
        return json_encode($msnEliminar);
    }

    public function Seleccionar($nId)
    {
        $oMateria = new Materia;
        $aDatosMateria = $oMateria->UnRegistro($nId);
        return json_encode($aDatosMateria);
    }

    public function TodosRegistros()
    {
        $oMateria = new Materia;
        $aMaterias = $oMateria->TodosRegistros();

        return json_encode($aMaterias);
    }
}
