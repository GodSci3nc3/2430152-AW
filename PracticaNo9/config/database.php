<?php
require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Parámetros de conexión
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASSWORD'];

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $sql = "INSERT INTO Pacientes 
            (NombreCompleto, CURP, FechaNacimiento, Sexo, Telefono, CorreoElectronico, Direccion, 
             ContactoEmergencia, TelefonoEmergencia, Alergias, AntecedentesMedicos)
            VALUES 
            (:nombre, :curp, :fecha_nacimiento, :sexo, :telefono, :correo, :direccion,
             :contacto_emergencia, :telefono_emergencia, :alergias, :antecedentes)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':curp', $_POST['curp']);
        $stmt->bindParam(':fecha_nacimiento', $_POST['fecha_nacimiento']);
        $stmt->bindParam(':sexo', $_POST['sexo']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':correo', $_POST['correo']);
        $stmt->bindParam(':direccion', $_POST['direccion']);
        $stmt->bindParam(':contacto_emergencia', $_POST['contacto_emergencia']);
        $stmt->bindParam(':telefono_emergencia', $_POST['telefono_emergencia']);
        $stmt->bindParam(':alergias', $_POST['alergias']);
        $stmt->bindParam(':antecedentes', $_POST['antecedentes']);

        $stmt->execute();
        header('Location: ../views/pages/doctor/patients.html?success=1');
        exit();
    }

} catch (PDOException $e) {
    echo "<h3 style='color:red;'>❌ Error: " . $e->getMessage() . "</h3>";
}
?>rror al guardar: " . $e->getMessage() . "</h3>";
}
?>