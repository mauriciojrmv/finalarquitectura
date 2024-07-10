<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PrecioVentasStrategy.php';

class AbarrotesStrategy implements PrecioVentaStrategy {
    public function calcularPrecioVenta($precioCompra) {
        return $precioCompra * 1.15; // 15% markup
    }
}
