<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'PrecioVentasStrategy.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'BebidaStrategy.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'AbarrotesStrategy.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'EstadoProducto.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Registrado.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Revisado.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Guardado.php';

class Producto {
    private $codigo;
    private $nombre;
    private $precioCompra;
    private $precioVenta;
    private $tipoProducto;
    private $estado;
    private $estrategiaPrecio;

    public function __construct($codigo, $nombre, $precioCompra, $tipoProducto) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->precioCompra = $precioCompra;
        $this->tipoProducto = $tipoProducto;
        $this->estado = new Registrado();
        $this->calcularPrecioVenta();
    }


    private function calcularPrecioVenta() {
        if ($this->tipoProducto == "bebida") {
            $estrategiaPrecio = new BebidaStrategy();
        } elseif ($this->tipoProducto == "abarrotes") {
            $estrategiaPrecio = new AbarrotesStrategy();
        } else {
            throw new Exception("Tipo de producto no válido");
        }
        $this->precioVenta = $estrategiaPrecio->calcularPrecioVenta($this->precioCompra);
    }

    public function revisar() {
        $this->estado->revisar($this);
    }

    public function guardar() {
        $this->estado->guardar($this);
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecioCompra() {
        return $this->precioCompra;
    }

    public function getPrecioVenta() {
        return $this->precioVenta;
    }

    public function getTipoProducto() {
        return $this->tipoProducto;
    }

    public function getEstado() {
        return $this->estado;
    }
}
