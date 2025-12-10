<?php
require 'connection.php';

$stmt = $conn->query("SELECT l.*, c.nombre as categoria FROM libros l JOIN categorias c ON l.categoria_id = c.id");
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Libros</title>
</head>
<body>
    <h1>Libros</h1>
    <a href="crear_libro.php">Crear libro</a><br>
    <a href="crear_categoria.php">Crear categoría</a><br>
    <a href="ver_categorias.php">Ver Categorías</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Páginas</th>
            <th>Editorial</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($libros as $l): ?>
        <tr>
            <td><?= $l['id'] ?></td>
            <td><?= $l['nombre'] ?></td>
            <td><?= $l['categoria'] ?></td>
            <td><?= $l['paginas'] ?></td>
            <td><?= $l['editorial'] ?></td>
            <form action="eliminar_libro.php" method="post">
                <input type="hidden" name="id" value="<?= $l['id'] ?>">
                <td><button type="submit">Eliminar</button></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
