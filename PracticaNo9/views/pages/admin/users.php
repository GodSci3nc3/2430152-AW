<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios en Medicore</title>


    <link rel="icon" href="../../../resources/Medicore Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../styles/globalStyles.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://kit.fontawesome.com/aad8366bcb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

</head>
<body>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 d-md-block ">

            <?php require '../../components/sidebar.php';?>

            </div>

            <div class="col-md-9">


    <div class="container-fluid p-5">
        <h1 class="text-primary-title mb-4">Usuarios en Medicore</h1>

        <table id="users" class="table table-striped table-hover">
            <thead>
                <tr>
            <th>Nombre de usuario</th>
            <th>Correo electrónico</th>
            <th>Rol de usuario</th>
            <th>Estado</th>
            <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php
            require_once '../../../app/models/User/getUsers.php';

            $users = getUsers();

            foreach($users as $user): ?>
                <tr data-user-id = "<?= $user['IdUsuario'] ?>">
                <td data-field = 'Usuario' contenteditable = 'true'><?= $user['Usuario'] ?></td>
                <td data-field = 'CorreoElectronico' contenteditable = 'true'><?= $user['CorreoElectronico']?></td>
                <td data-field = 'Rol' contenteditable = 'true'><?= $user['Rol']?></td>
                <td><? if($user['Activo'] == 1){ ?><span class="fa-solid fa-circle"></span><? }else {?><span class="fa-regular fa-circle"></span><?}?></td>
                <td>
                    <button class="fa-solid fa-trash btn-secondary deleteBtn"></button>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
   

        <a href = "registerUser.php" ><button class = "btn-primary"><i class="fa-solid fa-plus"></i>Crear usuario</button></a>


    </div>

    </div>

    </div>
    </div>
    

    <script src="../../js/user.js"></script>
    <script src="../../../app/controllers/authController.js"></script>
</body>
</html>