<?php
require_once 'Producto.php';
require_once __DIR__ . '/../datos/RepositorioProducto.php';

class ControladorProducto {
    private $repositorio;

    public function __construct($repositorio) {
        $this->repositorio = $repositorio;
    }

    public function registrarProducto($codigo, $nombre, $precioCompra, $tipoProducto) {
        $producto = new Producto($codigo, $nombre, $precioCompra, $tipoProducto);
        $this->repositorio->guardarProducto($producto);
    }

    public function revisarProducto($codigo) {
        $producto = $this->repositorio->obtenerProducto($codigo);
        if ($producto) {
            $producto->revisar();
            $this->repositorio->guardarProducto($producto);
        }
    }

    public function guardarProducto($codigo) {
        $producto = $this->repositorio->obtenerProducto($codigo);
        if ($producto) {
            $producto->guardar();
            $this->repositorio->guardarProducto($producto);
        }
    }
}
