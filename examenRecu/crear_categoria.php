<?php
require 'connection.php';

if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO categorias (nombre) VALUES (?)");
    $stmt->execute([$_POST['nombre']]);
    header('Location: ver_categorias.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Categoría</title>
</head>
<body>
    <h1>Crear Categoría</h1>
    <form method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <button type="submit">Guardar</button>
    </form>
    <a href="ver_categorias.php">Ver Categorías</a>
</body>
</html>
