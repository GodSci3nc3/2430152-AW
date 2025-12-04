<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

$idUser = $_POST['idUser'];
$column = $_POST['column'];
$change = $_POST['change'];

if ($column == 'Contrasena') {
    $change = password_hash($change, PASSWORD_DEFAULT);
}

$sql = "UPDATE Usuarios SET $column = :change WHERE IdUsuario = :idUser";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':change', $change);
$stmt->bindParam(':idUser', $idUser);
$stmt->execute();
