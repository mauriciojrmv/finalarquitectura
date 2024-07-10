<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'PrecioVentasStrategy.php';

class BebidaStrategy implements PrecioVentaStrategy {
    public function calcularPrecioVenta($precioCompra) {
        return $precioCompra * 1.10; // 10% markup
    }
}
