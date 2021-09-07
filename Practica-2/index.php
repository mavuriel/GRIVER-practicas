<?php
session_start();
$_SESSION['sNombre'] = (isset($_POST['sNombre'])) ? $_POST['sNombre'] : '';
$_SESSION['sApellidoMaterno'] = (isset($_POST['sApellidoMaterno'])) ? $_POST['sApellidoMaterno'] : '';
$_SESSION['sApellidoPaterno'] = (isset($_POST['sApellidoPaterno'])) ? $_POST['sApellidoPaterno'] : '';
$_SESSION['sEmail'] = (isset($_POST['sEmail'])) ? $_POST['sEmail'] : '';
$aErrores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<br>';
    $aMensajesError = ValidaDatos();
    foreach ($aMensajesError as $error) {
        $aErrores[] = $error;
    }
}

function ValidaDatos()
{
    $aMensajes = [];
    foreach ($_POST as $key => $value) {
        $sVariableEvaluada = trim($_POST["$key"]);
        $sCampo = ltrim($key, "s");
        if (empty($sVariableEvaluada)) {
            $aMensajes[] = "Campo<strong> $sCampo vacio</strong>, es requerido.";
        }
    }
    if (array_key_exists('sEmail', $_POST)) {
        $busca = array_slice($_POST, 0, 3);
        foreach ($busca as $key2 => $value) {
            $sCampo2 = ltrim($key2, "s");
            if (!preg_match('/[A-Z][a-z]+/', $_POST["$key2"])) {
                $aMensajes[] = "Revisa el <strong>formato<strong> e ingresa <strong>unicamente letras</strong> para $sCampo2.";
            }
        }
    }
    if (!filter_var($_POST['sEmail'], FILTER_VALIDATE_EMAIL)) {
        $aMensajes[] = "No es un <strong>formato valido</strong> de correo electronico, modificalo.";
    }
    return $aMensajes;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <title>Formulario</title>
</head>

<body>
    <main class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="card mb-3 px-0">
                <h3 class="card-header text-center">Formulario</h3>
                <div class="card-body d-flex align-items-center justify-content-center pb-0">
                    <!-- validaciones -->
                    <?php
                    if (count($aErrores) > 0) {
                        echo '<div class="alert alert-dismissible alert-danger d-flex justify-content-center align-items-center w-75 mb-0">
                            <ul class="mb-0">';
                        foreach ($aErrores as $sError) {
                            echo "<li>
                                <small>$sError</small>
                            </li>";
                        }
                        echo '</div>';
                    } else if (isset($_POST['sNombre']) && count($aErrores) === 0) {
                        echo '<div class="alert alert-dismissible alert-success d-flex justify-content-center align-items-center w-75 mb-0">';
                        echo '<p class="mb-0">Datos <strong>correctos</strong></p>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <div class="form-group mb-1">
                                <label class="col-form-label mt-1" for="inputDefault">Nombre</label>
                                <input type="text" class="form-control" placeholder="p. ej. Marco" id="inputDefault" name="sNombre" value="<?php echo $_SESSION['sNombre'] ?>">
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label mt-1" for="inputDefault">Apellido materno</label>
                                <input type="text" class="form-control" placeholder="p. ej. Perez" id="inputDefault" name="sApellidoMaterno" value="<?php echo $_SESSION['sApellidoMaterno'] ?>">
                            </div>
                            <div class="form-group mb-1">
                                <label class="col-form-label mt-1" for="inputDefault">Apellido paterno</label>
                                <input type="text" class="form-control" placeholder="p. ej. Ortega" id="inputDefault" name="sApellidoPaterno" value="<?php echo $_SESSION['sApellidoPaterno'] ?>">
                            </div>
                            <div class="form-group mb-1"> <label class="col-form-label mt-1" for="inputDefault">Email</label>
                                <input type="text" class="form-control" placeholder="p. ej. ejemplo@email.com" id="inputDefault" name="sEmail" value="<?php echo $_SESSION['sEmail'] ?>">
                            </div>
                        </div>
                </div>
                <div class="card-footer text-muted d-flex justify-content-center">
                    <input class="btn btn-success w-100" type="submit" value="Enviar">
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>