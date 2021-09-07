<?php

class Pokemon
{
    protected $nAltura;
    protected $nPeso;
    protected $nHp;
    protected $nPuntosDeAtaqueRecibidos;
    protected $nTipo;
    protected $nGenero;
    protected $sNombre;

    public function __construct($nAltura, $nPeso, $nHp, $nPuntosDeAtaqueRecibidos, $nTipo, $nGenero, $sNombre)
    {
        $this->nAltura = $nAltura;
        $this->nPeso = $nPeso;
        $this->nHp = $nHp;
        $this->nPuntosDeAtaqueRecibidos = $nPuntosDeAtaqueRecibidos;
        $this->nTipo = $nTipo;
        $this->nGenero = $nGenero;
        $this->sNombre = $sNombre;
    }

    public function setNAltura($nAltura)
    {
        $this->nAltura = $nAltura;
    }
    public function setNPeso($nPeso)
    {
        $this->nPeso = $nPeso;
    }
    public function setNHp($nHp)
    {
        $this->nHp = $nHp;
    }
    public function setNPuntosDeAtaqueRecibidos($nPuntosDeAtaqueRecibidos)
    {
        $this->nPuntosDeAtaqueRecibidos = $nPuntosDeAtaqueRecibidos;
    }
    public function setNTipo($nTipo)
    {
        $this->nTipo = $nTipo;
    }
    public function setNGenero($nGenero)
    {
        $this->nGenero = $nGenero;
    }
    public function setNNombre($nNombre)
    {
        $this->nNombre = $nNombre;
    }
    public function getNAltura()
    {
        return $this->nAltura;
    }
    public function getNPeso()
    {
        return $this->nPeso;
    }
    public function getNHp()
    {
        return $this->nHp;
    }
    public function getNPuntosDeAtaqueRecibidos()
    {
        return $this->nPuntosDeAtaqueRecibidos;
    }
    public function getNTipo()
    {
        return $this->nTipo;
    }
    public function getNGenero()
    {
        return $this->nGenero;
    }
    public function getSNombre()
    {
        return $this->sNombre;
    }
}
