<?php
$host = 'localhost';
$port = 3306;
$socket = '/opt/lampp/var/mysql/mysql.sock';
$dbname = 'banco_clientes';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:unix_socket=$socket;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    
}
?>
