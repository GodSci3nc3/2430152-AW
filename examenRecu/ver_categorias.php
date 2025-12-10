<?php
require 'connection.php';

$stmt = $conn->query("SELECT * FROM categorias");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Categorías</title>
</head>
<body>
    <h1>Categorías</h1>
    <a href="index.php">Ver libros</a><br>
    <a href="crear_categoria.php">Nueva Categoría</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
        <?php foreach ($categorias as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['nombre'] ?></td>
            <form action="eliminar_categoria.php" method="post">
                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                <td><button type="submit">Eliminar</button></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
