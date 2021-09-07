<?php
/* Agua = 0
fuego = 1
planta = 2 */

class Agua extends Pokemon
{
    protected $aListaDeAtaques;

    public function setAtaques(/* obj ataque */)
    {
        $this->aListaDeAtaques = [
            'puñetazo' => 10,
            'cabezaso' => 5,
            'patada' => 10,
            'cuerpo' => 15,
        ];
    }

    public function getAtaques($NombreAtaque)
    {
        return $this->aListaDeAtaques["$NombreAtaque"];
    }

    /* obj de tipo pokemon atacado, obj de tipo ataque  */
    public function Atacar($oPokemon, $oAtaque)
    {
        /* obtiene hp del pokemon atacado */
        $nAtacadoHp = $oPokemon->getNHp();
        /* obtiene el tipo de pokemon atacado */
        $nAtacadoTipo = $oPokemon->getNTipo();
        /* calcula el daño segun el tipo de ataque y tipo de pokemon */
        $nCalcDanio = ($nAtacadoTipo === 1)
            ? $oAtaque->getNDanio() * 2 : ($nAtacadoTipo === 2
                ? $oAtaque->getNDanio() * 0.5 : $oAtaque->getNDanio() * 1);
        /* modificar el hp del pokemon atacado */
        $nAtacadoNuevoHp = $nAtacadoHp - $nCalcDanio;
        /* devuelve el hp actualizado del pokemon atacado */
        $oPokemon->setNHp($nAtacadoNuevoHp);
        /* devuelve la cantidad de daño a recibir */
        $oPokemon->setNPuntosDeAtaqueRecibidos($nCalcDanio);

        return 'Nuevo hp seteado correctamente';
    }
    public function Defender()
    {
        /* obtiene el hp de este pokemon */
        $nHpActual = $this->getNHp();
        /* obtiene puntos de ataque recibidos y los sumas al hp del pokemon */
        $nCalcHp = $this->getNPuntosDeAtaqueRecibidos() + $nHpActual;
        /* setea el hp del pokemon */
        $this->setNHp($nCalcHp);
        /* devuelve el hp del pokemon */
        return $nCalcHp;
    }
}
