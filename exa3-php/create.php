<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Cliente</title>
</head>
<body>
    <h1>Agregar Nuevo Cliente</h1>
    
    <form method="POST" action="models/createCliente.php">
        <label>RFC:</label><br>
        <input type="text" name="rfc" maxlength="13" required><br><br>
        
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>
        
        <label>Direccion:</label><br>
        <input type="text" name="direccion" required><br><br>
        
        <label>CLABE:</label><br>
        <input type="text" name="clabe" maxlength="18" required><br><br>
        
        <label>Banco:</label><br>
        <select name="id_institucion" required>
            <option value="">Seleccione banco</option>
            <?php
            require_once __DIR__ . '/models/getInstituciones.php';
            
            $instituciones = getInstituciones();
            
            foreach ($instituciones as $inst) {
            ?>
                <option value="<?php echo $inst['id']; ?>"><?php echo $inst['nombre']; ?></option>
            <?php
            }
            ?>
        </select><br><br>
        
        <label>Saldo:</label><br>
        <input type="number" step="0.01" name="saldo_bancario" value="0" required><br><br>
        
        <button type="submit">Guardar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
