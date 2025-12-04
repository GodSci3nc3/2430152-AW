<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Instituciones Bancarias</title>
</head>
<body>
    <h1>Gestión de Instituciones Bancarias</h1>
    
    <h2>Agregar Institución</h2>
    <form method="POST" action="instituciones.php">
        <label>Nombre de la Institución:</label><br>
        <input type="text" name="nombre" required><br><br>
        <button type="submit" name="agregar">Agregar</button>
    </form>
    
    <hr>
    
    <h2>Instituciones Registradas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
        <?php
        include 'config.php';
        
        if (isset($_POST['agregar'])) {
            $nombre = $_POST['nombre'];
            $sql = "INSERT INTO instituciones_bancarias (nombre) VALUES ('$nombre')";
            if ($conn->query($sql)) {
                echo "<p>Institución agregada correctamente</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        }
        
        $sql = "SELECT id, nombre FROM instituciones_bancarias WHERE activo = 1 ORDER BY nombre";
        $resultado = $conn->query($sql);
        
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No hay instituciones registradas</td></tr>";
        }
        
        $conn->close();
        ?>
    </table>
    
    <br>
    <a href="index.php">Volver a Clientes</a>
</body>
</html>
