<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Cliente</title>
</head>
<body>
    <h1>Eliminar Cliente</h1>
    
    <?php
    require_once __DIR__ . '/models/getCliente.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $cliente = getCliente($id);
        
        if ($cliente) {
    ?>
    
    <p>Esta seguro de eliminar al cliente?</p>
    <p><strong><?php echo $cliente['nombre']; ?></strong></p>
    <p>RFC: <?php echo $cliente['rfc']; ?></p>
    
    <form method="POST" action="models/deleteCliente.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit">Eliminar</button>
        <a href="index.php">Cancelar</a>
    </form>
    
    <?php
        } else {
            echo "<p>Cliente no encontrado</p>";
        }
    } else {
        header("Location: index.php");
        exit();
    }
    ?>
</body>
</html>
