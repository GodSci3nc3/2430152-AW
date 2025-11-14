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
    // Crear conexión PDO con puerto y charset UTF-8
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $pass);

    // Configurar manejo de errores mediante excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nombreespecialidad = "Especialidad sin nombre";
    $descripcion = "Especialidad sin descripción"; 



    // Preparar sentencia SQL parametrizada
    $sql = "INSERT INTO Especialidades 
        (NombreEspecialidad, Descripcion)
        VALUES 
        (::nombreespecialidad, :descripcion)";

    $stmt = $pdo->prepare($sql);


    $stmt->bindParam(':nombreespecialidad', $nombreespecialidad);
    $stmt->bindParam(':descripcion', $descripcion);



    /* Asignar valores del formulario a los parámetros
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

    */

    // Ejecutar la sentencia
    $stmt->execute();

    header('Location: ../views/pages/doctor/patients.html?success=1');
    echo "<h3 style='color:green;'>✅ Paciente guardado correctamente.</h3>";

} catch (PDOException $e) {
    // Capturar y mostrar error de conexión o ejecución
    echo "<h3 style='color:red;'>❌ Error al guardar: " . $e->getMessage() . "</h3>";
}
?>