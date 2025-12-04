<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/home.css">
</head>
<body>

    <div class="container-fluid p-5">
    <h1 class="text-primary-title">Clientes Bancarios</h1>

    <br><br>
    
    <a class="btn-primary" href="create.php">Agregar Cliente</a>
    
    <br><br>
    
    <table class="table">
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
                        <a class="btn-secondary" href='update.php?id=<?php echo $cliente['id']; ?>'>Editar</a> | 
                        <a class="btn-secondary" href='delete.php?id=<?php echo $cliente['id']; ?>'>Eliminar</a>
                    </td>
                </tr>
        <?php
        }
        ?>
    </table>

        

    </div>

    </div>

            <script src="index.js"></script>
    
</body>
</html>