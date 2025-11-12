<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Usar 127.0.0.1 en lugar de localhost para forzar conexión TCP
    $host = '127.0.0.1';
    $port = '3306';
    $dbname = 'examen';
    $user = 'root';
    $pass = '5oo6fXkf';

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    
    // Opciones de conexión específicas
    $options = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    
} catch (PDOException $e) {
    die("<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #f8d7da;'>Error de conexión: " . $e->getMessage() . "</div>");
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        $nombre = $_POST['nombre'] ?? '';
        $apellido = $_POST['apellido'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $numero_dorsal = $_POST['numero_dorsal'] ?? '';
        $sexo = $_POST['sexo'] ?? '';
        $numero_equipo = $_POST['numero_equipo'] ?? '';
        
        $sql = "INSERT INTO player
        (nombre, apellido, correo, telefono, numero_dorsal, sexo, numero_equipo) 
        VALUES
        (:nombre, :apellido, :correo, :telefono, :numero_dorsal, :sexo, :numero_equipo)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':numero_dorsal', $numero_dorsal);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':numero_equipo', $numero_equipo);
        
        $stmt->execute();
        
    } catch (Exception $e) {
    }
}
?>
