<?php
try {
    $host = 'localhost';
    $port = '3306';
    $dbname = 'examen';
    $user = 'root';
    $pass = '5oo6fXkf';

    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    
    $pdo = new PDO($dsn, $user, $pass);
    
} catch (e) {}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $numero_dorsal = $_POST['numero_dorsal'];
        $sexo = $_POST['sexo'];
        $numero_equipo = $_POST['numero_equipo'];
        
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
        
    } catch (Exception $e) {}
}
?>
