<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Clientes Bancarios</h1>
    
    <a href="create.php">Agregar Cliente</a>
    
    <br><br>
    
    <table>
        <tr>
            <th>ID</th>
            <th>RFC</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>CLABE</th>
            <th>Banco</th>
            <th>Saldo</th>
            <th>Acciones</th>
        </tr>
        
        <?php
        require_once __DIR__ . '/models/getClientes.php';
        
        $clientes = getClientes();
        
        foreach ($clientes as $cliente) {
        ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['rfc']; ?></td>
                    <td><?php echo $cliente['nombre']; ?></td>
                    <td><?php echo $cliente['direccion']; ?></td>
                    <td><?php echo $cliente['clabe']; ?></td>
                    <td><?php echo $cliente['institucion']; ?></td>
                    <td>$<?php echo number_format($cliente['saldo_bancario'], 2); ?></td>
                    <td>
                        <a href='update.php?id=<?php echo $cliente['id']; ?>'>Editar</a> | 
                        <a href='delete.php?id=<?php echo $cliente['id']; ?>'>Eliminar</a>
                    </td>
                </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>


        

    </div>

            <script src="index.js"></script>
    
</body>
</html>