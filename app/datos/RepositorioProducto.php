<?php
require_once 'Database.php';
require_once __DIR__ . '/../negocio/Producto.php';
require_once __DIR__ . '/../negocio/Registrado.php';
require_once __DIR__ . '/../negocio/Revisado.php';
require_once __DIR__ . '/../negocio/Guardado.php';

class RepositorioProducto {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function guardarProducto($producto) {
        $codigo = $producto->getCodigo();
        $nombre = $producto->getNombre();
        $precioCompra = $producto->getPrecioCompra();
        $precioVenta = $producto->getPrecioVenta();
        $tipoProducto = $producto->getTipoProducto();
        $estado = $producto->getEstado()->getEstado();

        $stmt = $this->conn->prepare("INSERT INTO productos (codigo, nombre, precio_compra, precio_venta, tipo_producto, estado) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddss", $codigo, $nombre, $precioCompra, $precioVenta, $tipoProducto, $estado);

        if ($stmt->execute()) {
            error_log("Producto guardado con éxito");
        } else {
            error_log("Error al guardar el producto: " . $stmt->error);
        }

        $stmt->close();
    }

    public function obtenerProducto($codigo) {
        $stmt = $this->conn->prepare("SELECT codigo, nombre, precio_compra, precio_venta, tipo_producto, estado FROM productos WHERE codigo = ?");
        $stmt->bind_param("s", $codigo);
        $stmt->execute();
        $stmt->bind_result($codigo, $nombre, $precioCompra, $precioVenta, $tipoProducto, $estado);

        if ($stmt->fetch()) {
            $producto = new Producto($codigo, $nombre, $precioCompra, $tipoProducto);
            $producto->setEstado($this->crearEstado($estado));
            $stmt->close();
            return $producto;
        } else {
            $stmt->close();
            return null;
        }
    }

    private function crearEstado($estado) {
        switch ($estado) {
            case 'Registrado':
                return new Registrado();
            case 'Revisado':
                return new Revisado();
            case 'Guardado':
                return new Guardado();
            default:
                return null;
        }
    }

    public function getAllProductos() {
        $result = $this->conn->query("SELECT codigo, nombre, precio_compra, precio_venta, tipo_producto, estado FROM productos");
        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $producto = new Producto($row['codigo'], $row['nombre'], $row['precio_compra'], $row['tipo_producto']);
            $producto->setEstado($this->crearEstado($row['estado']));
            $productos[] = $producto;
        }
        return $productos;
    }
}
