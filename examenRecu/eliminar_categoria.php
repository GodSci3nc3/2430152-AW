<?php
require 'connection.php';

if ($_POST) {
    $stmt = $conn->prepare("DELETE FROM categorias WHERE id = ?");
    $stmt->execute([$_POST['id']]);
    header('Location: index.php');
    exit;
}
?>