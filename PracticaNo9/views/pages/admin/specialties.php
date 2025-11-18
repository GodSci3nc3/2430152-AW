<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especialidades en Medicore</title>


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

        <div class="col-md-3 d-md-block">

        <?php require '../../components/sidebar.php';?>

        </div>

        <div class="col-md-9">
            
    <div class="container-fluid p-5">
        <h1 class="text-primary-title mb-4">Especialidades en Medicore</h1>

        <table id="specialties" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>

                </tr>
            </thead>    
            <tbody>

            <?php
                require_once '../../../app/models/Specialties/getSpecialties.php';

                $specialties = getSpecialties();

                foreach($specialties as $specialty): ?>
                    <tr data-specialty-id = "<?= $specialty['IdEspecialidad'] ?>">
                    <td data-field = 'NombreEspecialidad' contenteditable = 'true'><?= $specialty['NombreEspecialidad'] ?></td>
                    <td data-field = 'Descripcion' contenteditable = 'true'><?= $specialty['Descripcion']?></td>
                    <td>
                        <button class="fa-solid fa-trash btn-secondary deleteBtn"></button>
                    </td>
                    </tr>
                    <?php endforeach; ?>

            </tbody>
        </table>

            <form action="../../../app/models/Specialties/createSpecialty.php" method="post">
            <button type="submit" id = "createSpecialty" class = "btn-primary"><i class="fa-solid fa-plus"></i>Crear especialidad</button>


    </div>

    </div>

        </div>

    </div>


    <script src="../../js/specialties.js"></script>
    <script src="../../../app/controllers/specialtyController.js"></script>
</body>
</html>