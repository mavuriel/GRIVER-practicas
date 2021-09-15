<?php
if (isset($_GET['accion'])) {
    $sAccion = $_GET['accion'];
    $nId = isset($_POST['id']) ? $_POST['id'] : '';
    $sNombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $sApellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';

    switch ($sAccion) {
        case 'todo':

            require_once 'alumnos.php';
            $oAlumno = new Alumno;
            $aAlumnos = $oAlumno->TodosRegistros();
            echo json_encode($aAlumnos);

            break;

        case 'insertar':

            require_once 'alumnos.php';
            $oAlumno = new Alumno;
            $sInsertar = $oAlumno->Insertar($sNombre, $sApellido);
            $msnInsertar = ['mensaje' => $sInsertar];
            echo json_encode($msnInsertar);

            break;

        case 'eliminar':

            require_once 'alumnos.php';
            $oAlumno = new Alumno;
            $sEliminar = $oAlumno->Eliminar($nId);
            $msnEliminar = ['mensaje' => $sEliminar];
            echo json_encode($msnEliminar);

            break;

        case 'seleccionar':
            require_once 'alumnos.php';
            $oAlumno = new Alumno;
            $aDatosAlumno = $oAlumno->UnRegistro($nId);
            echo json_encode($aDatosAlumno);
            break;

        case 'actualizar':
            require_once 'alumnos.php';
            $oAlumno = new Alumno;
            $sActualizar = $oAlumno->Actualizar($sNombre, $sApellido, $nId);
            $msnActualizar = ['mensaje' => $sActualizar];
            echo json_encode($msnActualizar);
            break;

        default:
            # code...
            break;
    }
}
