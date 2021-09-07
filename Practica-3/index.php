<?php
session_start();
echo session_id();
echo '<br>___________________<br>';

include('pokemon.php');
include('agua.php');
include('ataque.php');

/* Instancias pokemon - nuevo pokemon */
$oSquirtle = new Agua(100, 80, 100, 0, 0, 1, 'Squirtle');
$oSquirtle2 = new Agua(100, 80, 100, 0, 0, 1, 'Squirtle2');
$oSquirtle3 = new Agua(100, 80, 100, 0, 0, 1, 'Squirtle3');

$aListaPokemon = [
    'sqr' => $oSquirtle,
    'sqr2' => $oSquirtle2,
    'sqr3' => $oSquirtle3,
];

/* Variables de sesion */
$_SESSION['nPelea'] = (isset($_POST['pelea']))
    ? intval($_POST['pelea']) : 0;

$_SESSION['oPokemonJugador'] = (isset($_POST['pokemon']))
    ? $aListaPokemon[$_POST['pokemon']] : '';
$nPokemonHpJugador = (isset($_POST['pelea']))
    ? $_SESSION['oPokemonJugador']->getNHp() : '';
$_SESSION['oPokemonComputadora'] = (isset($_POST['pelea']))
    ? $aListaPokemon[array_rand($aListaPokemon)] : '';
$_SESSION['nHpPokemonComputadora'] = (isset($_POST['pelea']))
    ? $_SESSION['oPokemonComputadora']->getNHp() : '';

/* Datos POST */
$nOpcion = (isset($_POST['opcion']))
    ? intval($_POST['opcion']) : '';

var_dump($_SESSION);
echo '<br>___________________<br>';
var_dump($_POST);
echo '<br>___________________<br>';

/* instancia el ataque */
$AtaqueJugador = new Atacar();
$AtaqueComputadora = new Atacar();

/* Iniciar el ataque */
//var_dump($agua->Atacar($agua2, $ataque));

/* Inicia defensa */
//var_dump($agua->Defender());

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon</title>
</head>

<body>

    <?php if ($_SESSION['nPelea'] === 0) { ?>
        <form method="POST">
            <label>
                ¿Que pokemon quieres?
                <select name="pokemon">
                    <?php
                    foreach ($aListaPokemon as $key => $value) {
                        echo "<option value='" . $key . "'>" . $value->getSNombre() . "</option>";
                    }
                    ?>
                </select>
            </label>
            <input type="hidden" name="pelea" value="1">
            <button type="submit">Escoger</button>
        </form>

    <?php } else { ?>
        <p>
            Computadora:
            <strong><?php echo $_SESSION['oPokemonComputadora']->getSNombre(); ?></strong> HP: <strong><?php echo $_SESSION['oPokemonComputadora']->getNHp(); ?></strong>
        </p>

        <p>
            Jugador:
            <strong><?php echo $_SESSION['oPokemonJugador']->getSNombre(); ?></strong> HP: <strong><?php echo $_SESSION['oPokemonJugador']->getNHp(); ?></strong>
        </p>


        <form method="POST">
            <label>
                ¿Que quieres hacer?
                <select name="opcion">
                    <option value="0">Atacar</option>
                    <option value="1">Defender</option>
                </select>
            </label>
            <input type="hidden" name="pelea" value="1">

            <button type="submit">Elegir</button>
        </form>

        <?php
        echo '<br>Pokemon de la computadora';
        echo "<br> La altura del pokemon 2 es:" . $_SESSION['oPokemonComputadora']->getNAltura();
        echo "<br> La Peso del pokemon 2 es:" . $_SESSION['oPokemonComputadora']->getNPeso();
        echo "<br> La Hp del pokemon 2 es:" . $_SESSION['oPokemonComputadora']->getNHp();
        echo "<br> La PuntosDeAtaqueRecibidos del pokemon 2 es:" . $_SESSION['oPokemonComputadora']->getNPuntosDeAtaqueRecibidos();
        echo "<br> La Tipo del pokemon 2 es:" . $_SESSION['oPokemonComputadora']->getNTipo();
        echo "<br> La Genero del pokemon 2 es:" . $_SESSION['oPokemonComputadora']->getNGenero();
        echo "<br> La Nombre del pokemon 2 es:" . $_SESSION['oPokemonComputadora']->getSNombre();
        echo '<br>';

        echo '<br>Pokemon del jugador';
        echo "<br> La altura del pokemon 1 es:" . $_SESSION['oPokemonJugador']->getNAltura();
        echo "<br> La Peso del pokemon 1 es:" . $_SESSION['oPokemonJugador']->getNPeso();
        echo "<br> La Hp del pokemon 1 es:" . $_SESSION['oPokemonJugador']->getNHp();
        echo "<br> La PuntosDeAtaqueRecibidos del pokemon 1 es:" . $_SESSION['oPokemonJugador']->getNPuntosDeAtaqueRecibidos();
        echo "<br> La Tipo del pokemon 1 es:" . $_SESSION['oPokemonJugador']->getNTipo();
        echo "<br> La Genero del pokemon 1 es:" . $_SESSION['oPokemonJugador']->getNGenero();
        echo "<br> La Nombre del pokemon 1 es:" . $_SESSION['oPokemonJugador']->getSNombre();
        echo '<br>';
        ?>
    <?php } ?>
</body>

</html>