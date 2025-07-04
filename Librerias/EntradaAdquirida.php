<?php


class EntradaAdquirida
{
    private $usuario;         // Objeto Usuario
    private $tipoEntrada;     // Objeto TipoEntrada
    private $fechaAdquisicion;

    public function __construct($usuario, $tipoEntrada, $fechaAdquisicion = null)
    {
        $this->usuario = $usuario;
        $this->tipoEntrada = $tipoEntrada;
        $this->fechaAdquisicion = $fechaAdquisicion ?? date('Y-m-d H:i:s');
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getTipoEntrada()
    {
        return $this->tipoEntrada;
    }

    public function getFechaAdquisicion()
    {
        return $this->fechaAdquisicion;
    }

    public function __toString()
    {
        return "Usuario: " . $this->usuario->getNombre() . " " . $this->usuario->getApellido() .
            " | Tipo de Entrada: " . $this->tipoEntrada->getNombre() .
            " | Fecha: " . $this->fechaAdquisicion;
    }
}
?>