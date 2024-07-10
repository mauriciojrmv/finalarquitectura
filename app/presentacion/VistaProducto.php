<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'negocio' . DIRECTORY_SEPARATOR . 'ControladorProducto.php';

class VistaProducto {
    private $controlador;

    public function __construct($controlador) {
        $this->controlador = $controlador;
    }

   

    public function mostrarDetalles($producto) {
        echo "Código: " . $producto->getCodigo() . "\n";
        echo "Nombre: " . $producto->getNombre() . "\n";
        echo "Precio de Compra: " . $producto->getPrecioCompra() . "\n";
        echo "Precio de Venta: " . $producto->getPrecioVenta() . "\n";
        echo "Tipo de Producto: " . $producto->getTipoProducto() . "\n";
        echo "Estado: " . get_class($producto->getEstado()) . "\n";
    }
}
