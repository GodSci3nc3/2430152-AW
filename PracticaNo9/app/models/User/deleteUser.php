<?php
require_once __DIR__ . '/../../../config/connectDatabase.php';

$idUser = $_POST['IdUser'];

$sql = "UPDATE Usuarios SET Activo = 0 WHERE IdUsuario = :idUser";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idUser', $idUser);
$stmt->execute();
