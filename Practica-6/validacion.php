<?php

/**
 * Valida los datos.
 *
 * Este metodo valida los datos provenientes de una solicitud
 * POST, evalua campos vacios y formato de una cadena, devuelve
 * un arreglo con todos los errores.
 *
 * @access public
 * @param array $aCamposEvaluar
 * @return array
 */
function ValidaDatos($aCamposEvaluar)
{
    $aMensajes = [];
    foreach ($aCamposEvaluar as $key => $value) {
        $sVariableEvaluada = trim($aCamposEvaluar["$key"]);
        if (empty($sVariableEvaluada)) {
            $aMensajes[] = "Campo<strong> $key vacio</strong>, es requerido.";
        }
    }
    if (array_key_exists('nombre', $aCamposEvaluar)) {
        foreach ($aCamposEvaluar as $key2 => $value) {
            if (array_key_exists('creditos', $aCamposEvaluar)) {
                continue;
            } else if (!preg_match('/[A-Z][a-z]+/', $aCamposEvaluar["$key2"])) {
                $aMensajes[] = "Revisa el <strong>formato</strong> e ingresa <strong>unicamente letras</strong> para $key2.";
            }
        }
    }
    return $aMensajes;
}

/*
Validar correo electronico

if (!filter_var($_POST['sEmail'], FILTER_VALIDATE_EMAIL)) {
$aMensajes[] = "No es un <strong>formato valido</strong> de correo electronico, modificalo.";
}

Verificar si el servidor recibio una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
echo '<br>';
$aMensajesError = ValidaDatos();
foreach ($aMensajesError as $error) {
$aErrores[] = $error;
}
}
 */
