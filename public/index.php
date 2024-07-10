<?php
session_start();

require_once '../app/autoload.php';
require_once '../app/datos/RepositorioProducto.php';

$repositorio = new RepositorioProducto();
$controlador = new ControladorProducto($repositorio);
$vista = new VistaProducto($controlador);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar'])) {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $precioCompra = $_POST['precioCompra'];
        $tipoProducto = $_POST['tipoProducto'];
        $controlador->registrarProducto($codigo, $nombre, $precioCompra, $tipoProducto);
        echo "Producto registrado.\n";
    }

    if (isset($_POST['revisar'])) {
        $codigo = $_POST['codigo'];
        $controlador->revisarProducto($codigo);
        echo "Producto revisado.\n";
    }

    if (isset($_POST['guardar'])) {
        $codigo = $_POST['codigo'];
        $controlador->guardarProducto($codigo);
        echo "Producto guardado.\n";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['mostrar'])) {
    $codigo = $_GET['codigo'];
    $producto = $repositorio->obtenerProducto($codigo);
    if ($producto) {
        $vista->mostrarDetalles($producto);
    } else {
        echo "Producto no encontrado.\n";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
</head>
<body>
    <h1>Gestión de Productos</h1>

    <h2>Registrar Producto</h2>
    <form method="POST" action="">
        <label for="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" required><br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="precioCompra">Precio de Compra:</label>
        <input type="number" id="precioCompra" name="precioCompra" step="0.01" required><br>
        <label for="tipoProducto">Tipo de Producto:</label>
        <select id="tipoProducto" name="tipoProducto" required>
            <option value="bebida">Bebida</option>
            <option value="abarrotes">Abarrotes</option>
        </select><br>
        <button type="submit" name="registrar">Registrar</button>
    </form>

    <h2>Revisar Producto</h2>
    <form method="POST" action="">
        <label for="codigoRevisar">Código:</label>
        <input type="text" id="codigoRevisar" name="codigo" required><br>
        <button type="submit" name="revisar">Revisar</button>
    </form>

    <h2>Guardar Producto</h2>
    <form method="POST" action="">
        <label for="codigoGuardar">Código:</label>
        <input type="text" id="codigoGuardar" name="codigo" required><br>
        <button type="submit" name="guardar">Guardar</button>
    </form>

    <h2>Mostrar Detalles del Producto</h2>
    <form method="GET" action="">
        <label for="codigoMostrar">Código:</label>
        <input type="text" id="codigoMostrar" name="codigo" required><br>
        <button type="submit" name="mostrar">Mostrar Detalles</button>
    </form>
</body>
</html>
