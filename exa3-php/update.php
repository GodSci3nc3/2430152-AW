<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    
    <?php
    require_once __DIR__ . '/models/getCliente.php';
    require_once __DIR__ . '/models/getInstituciones.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $cliente = getCliente($id);
        
        if ($cliente) {
    ?>
    
    <form method="POST" action="models/updateCliente.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        
        <label>RFC:</label><br>
        <input type="text" name="rfc" value="<?php echo $cliente['rfc']; ?>" maxlength="13" required><br><br>
        
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?php echo $cliente['nombre']; ?>" required><br><br>
        
        <label>Direccion:</label><br>
        <input type="text" name="direccion" value="<?php echo $cliente['direccion']; ?>" required><br><br>
        
        <label>CLABE:</label><br>
        <input type="text" name="clabe" value="<?php echo $cliente['clabe']; ?>" maxlength="18" required><br><br>
        
        <label>Banco:</label><br>
        <select name="id_institucion" required>
            <?php
            $instituciones = getInstituciones();
            
            foreach ($instituciones as $inst) {
                if ($inst['id'] == $cliente['id_institucion']) {
            ?>
                    <option value="<?php echo $inst['id']; ?>" selected><?php echo $inst['nombre']; ?></option>
            <?php
                } else {
            ?>
                    <option value="<?php echo $inst['id']; ?>"><?php echo $inst['nombre']; ?></option>
            <?php
                }
            }
            ?>
        </select><br><br>
        
        <label>Saldo:</label><br>
        <input type="number" step="0.01" name="saldo_bancario" value="<?php echo $cliente['saldo_bancario']; ?>" required><br><br>
        
        <button type="submit">Actualizar</button>
        <a href="index.php">Cancelar</a>
    </form>
    
    <?php
        } else {
            echo "<p>Cliente no encontrado</p>";
        }
    }
    ?>
</body>
</html>
