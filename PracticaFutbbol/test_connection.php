<?php
try {
    $host='localhost';
    $port='3306';
    $dbname='examen';
    $user='root';
    $pass='5oo6fXkf';

    $dsn="mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
   
    $stmt = $pdo->query("SHOW TABLES LIKE 'player'");
    if ($stmt->rowCount() > 0) {
        
        $stmt = $pdo->query("DESCRIBE player");
        while ($row = $stmt->fetch()) {
            echo "- " . $row['Field'] . " (" . $row['Type'] . ")<br>";
        }
    }
    
} catch (PDOException $e) {
}
?>