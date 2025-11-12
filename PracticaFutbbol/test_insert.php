<?php
// Simular datos POST del formulario
$_POST['nombre'] = 'Juan';
$_POST['apellido'] = 'Pérez';
$_POST['correo'] = 'juan.perez@email.com';
$_POST['telefono'] = '1234567890';
$_POST['numero_dorsal'] = '10';
$_POST['sexo'] = 'Masculinio';
$_POST['numero_equipo'] = 'Tigres';

// Simular método POST
$_SERVER['REQUEST_METHOD'] = 'POST';

// Incluir el archivo database.php
echo "🔄 Ejecutando inserción de prueba...<br>";
include 'database.php';
?>