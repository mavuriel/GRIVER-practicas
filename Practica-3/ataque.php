<?php


class Atacar
{
    public $nTipo;
    public $nDanio;

    public function setNTipo($nTipo)
    {
        $this->nTipo = $nTipo;
    }
    public function setNDanio($nDanio)
    {
        $this->nDanio = $nDanio;
    }
    public function getNTipo()
    {
        return $this->nTipo;
    }
    public function getNDanio()
    {
        return $this->nDanio;
    }
}
