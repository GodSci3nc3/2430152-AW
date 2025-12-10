<?php
require 'connection.php';

if ($_POST) {
    $stmt = $conn->prepare("INSERT INTO libros (nombre, categoria_id, paginas, editorial) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['nombre'], $_POST['categoria_id'], $_POST['paginas'], $_POST['editorial']]);
    header('Location: index.php');
    exit;
}

$categorias = $conn->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Crear Libro</title>
</head>
<body>
    <h1>Crear Libro</h1>
    <form method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>Categoría:</label>
        <select name="categoria_id" required>
            <?php foreach ($categorias as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Páginas:</label>
        <input type="number" name="paginas" required><br>
        <label>Editorial:</label>
        <input type="text" name="editorial" required><br>
        <button type="submit">Guardar</button>
    </form>
    <a href="index.php">Ver Libros</a>
</body>
</html>
