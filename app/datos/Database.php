<?php

class Database
{
    const DATABASE_NOMBRE = "gestion_productos"; // Nombre de la base de datos
    const TABLE_PRODUCTOS = "productos";

    public function __construct()
    {
    }

    public function getConnection() : mysqli
    {
        $dbConfig = [
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => self::DATABASE_NOMBRE,
        ];

        $conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password']);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        $this->createDatabase($conn, $dbConfig['database']);
        $conn->select_db($dbConfig['database']);

        if (!$this->tableExists($conn, self::TABLE_PRODUCTOS)) {
            $this->createTables($conn);
        }

        return $conn;
    }

    private function createDatabase(mysqli $conn, string $databaseName) : void
    {
        $checkDatabaseQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'";
        $result = $conn->query($checkDatabaseQuery);

        if ($result->num_rows === 0) {
            $createDatabaseQuery = "CREATE DATABASE $databaseName";

            if ($conn->query($createDatabaseQuery) === TRUE) {
                error_log("Base de datos '$databaseName' creada con éxito");
            } else {
                error_log("Error al crear la base de datos: " . $conn->error);
            }
        } else {
            error_log("La base de datos '$databaseName' ya existe, no se creó nuevamente.");
        }
    }

    private function createTables(mysqli $conn) : void
    {
        $createTableQuery = "CREATE TABLE IF NOT EXISTS " . self::TABLE_PRODUCTOS . " (
            codigo VARCHAR(50) PRIMARY KEY,
            nombre VARCHAR(255),
            precio_compra DECIMAL(10, 2),
            precio_venta DECIMAL(10, 2),
            tipo_producto VARCHAR(50),
            estado VARCHAR(50)
        )";

        if ($conn->query($createTableQuery) === TRUE) {
            error_log("Tabla '" . self::TABLE_PRODUCTOS . "' creada con éxito");
        } else {
            error_log("Error al crear la tabla: " . $conn->error);
        }
    }

    private function tableExists(mysqli $conn, string $tableName) : bool
    {
        $result = $conn->query("SHOW TABLES LIKE '$tableName'");
        return $result->num_rows > 0;
    }
}
