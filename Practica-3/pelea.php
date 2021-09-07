<?php

class Pelea
{
    public $oJugador;
    public $oComputadora;

    public function setOJugador($oJugador)
    {
        $this->oJugador = $oJugador;
    }

    public function setOComputadora($oComputadora)
    {
        $this->oComputadora = $oComputadora;
    }

    public function getOJugador()
    {
        return $this->oJugador;
    }

    public function getOComputadora()
    {
        return $this->oComputadora;
    }

    public function datosAtaque($sNombreAtaque, $oPokemonAtacante)
    {
        include('index.php');
        /* recupera del form el ataque seleccionado */
        $SelectAtaque = $sNombreAtaque;
        /* setea los ataques del pokemon */
        $oPokemonAtacante->setAtaques();
        /* obtiene el valor del ataque elegido */
        $ValorAtaqueElegido = $oPokemonAtacante->getAtaques($SelectAtaque);
        /* setea el tipo del pokemon atacante */
        $AtaqueJugador->setNTipo($oPokemonAtacante->getNTipo());
        /* setea el daño del ataque elegido  */
        $AtaqueJugador->setNDanio($ValorAtaqueElegido);
    }
    /* accion jugador, accion maquina */
    public function batallar($nAccionJugador, $nAccionComputadora)
    {
        /* 0 = atacar
        1 = defender */
        /* ejecuta las acciones de ataque del obj correspondiente */


        if ($nAccionJugador === 0) {
        }
        /* despues ejecuta las acciones de defensa del obj correspondiente  */
    }

    public function resultadoBatalla()
    {
        /* devuelve el hp de cada jugador */
    }
}
