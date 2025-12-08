<?php
require_once 'config/connectDatabase.php';

echo "=== VERIFICANDO USUARIO carlos.mendez ===\n\n";

$sql = "SELECT * FROM Usuarios WHERE Usuario = 'carlos.mendez'";
$stmt = $pdo->query($sql);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

echo "Datos del usuario:\n";
print_r($user);

echo "\n\n=== VERIFICANDO MEDICOS ===\n";
$sql2 = "SELECT * FROM Medicos";
$stmt2 = $pdo->query($sql2);
$medicos = $stmt2->fetchAll(PDO::FETCH_ASSOC);

echo "Médicos en la base de datos:\n";
print_r($medicos);

echo "\n\n=== VERIFICANDO RECEPCIONISTAS ===\n";
$sql3 = "SELECT * FROM Usuarios WHERE Rol = 'receptionist'";
$stmt3 = $pdo->query($sql3);
$recepcionistas = $stmt3->fetchAll(PDO::FETCH_ASSOC);

echo "Recepcionistas en la base de datos:\n";
print_r($recepcionistas);
?>
