<?php
session_start();
require_once '../../../config/connectDatabase.php';

if (!isset($_GET['id'])) {
    header('Location: ../../views/pages/doctor/patients.php');
    exit();
}

$idPaciente = $_GET['id'];

// Obtener información del paciente
$sqlPaciente = "SELECT * FROM Pacientes WHERE IdPaciente = :idPaciente";
$stmtPaciente = $pdo->prepare($sqlPaciente);
$stmtPaciente->bindParam(':idPaciente', $idPaciente);
$stmtPaciente->execute();
$paciente = $stmtPaciente->fetch(PDO::FETCH_ASSOC);

if (!$paciente) {
    header('Location: ../../views/pages/doctor/patients.php');
    exit();
}

// Obtener expedientes del paciente
$sqlExpedientes = "SELECT e.*, m.NombreCompleto as NombreMedico 
                   FROM Expedientes e
                   LEFT JOIN Medicos m ON e.IdMedico = m.IdMedico
                   WHERE e.IdPaciente = :idPaciente
                   ORDER BY e.FechaConsulta DESC";
$stmtExpedientes = $pdo->prepare($sqlExpedientes);
$stmtExpedientes->bindParam(':idPaciente', $idPaciente);
$stmtExpedientes->execute();
$expedientes = $stmtExpedientes->fetchAll(PDO::FETCH_ASSOC);

// Crear archivo Excel simple con XML
$fileName = 'expediente_' . $paciente['IdPaciente'] . '_' . date('YmdHis') . '.xls';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Cache-Control: max-age=0");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">';
echo '<Worksheet ss:Name="Expediente"><Table>';

// Encabezado
echo '<Row><Cell><Data ss:Type="String">MEDICORE - Expediente Médico</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">Generado: ' . date('d/m/Y H:i') . '</Data></Cell></Row>';
echo '<Row></Row>';

// Información del paciente
echo '<Row><Cell><Data ss:Type="String">INFORMACIÓN DEL PACIENTE</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">Nombre:</Data></Cell><Cell><Data ss:Type="String">' . htmlspecialchars($paciente['NombreCompleto']) . '</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">CURP:</Data></Cell><Cell><Data ss:Type="String">' . htmlspecialchars($paciente['CURP']) . '</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">Fecha de Nacimiento:</Data></Cell><Cell><Data ss:Type="String">' . date('d/m/Y', strtotime($paciente['FechaNacimiento'])) . '</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">Sexo:</Data></Cell><Cell><Data ss:Type="String">' . ($paciente['Sexo'] == 'M' ? 'Masculino' : 'Femenino') . '</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">Teléfono:</Data></Cell><Cell><Data ss:Type="String">' . htmlspecialchars($paciente['Telefono']) . '</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">Correo:</Data></Cell><Cell><Data ss:Type="String">' . htmlspecialchars($paciente['CorreoElectronico']) . '</Data></Cell></Row>';
echo '<Row><Cell><Data ss:Type="String">Dirección:</Data></Cell><Cell><Data ss:Type="String">' . htmlspecialchars($paciente['Direccion']) . '</Data></Cell></Row>';
echo '<Row></Row>';

// Historial de consultas
echo '<Row><Cell><Data ss:Type="String">HISTORIAL DE CONSULTAS</Data></Cell></Row>';
echo '<Row>';
echo '<Cell><Data ss:Type="String">Fecha</Data></Cell>';
echo '<Cell><Data ss:Type="String">Médico</Data></Cell>';
echo '<Cell><Data ss:Type="String">Síntomas</Data></Cell>';
echo '<Cell><Data ss:Type="String">Diagnóstico</Data></Cell>';
echo '<Cell><Data ss:Type="String">Tratamiento</Data></Cell>';
echo '<Cell><Data ss:Type="String">Receta</Data></Cell>';
echo '</Row>';

foreach ($expedientes as $exp) {
    echo '<Row>';
    echo '<Cell><Data ss:Type="String">' . date('d/m/Y H:i', strtotime($exp['FechaConsulta'])) . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">' . htmlspecialchars($exp['NombreMedico']) . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">' . htmlspecialchars($exp['Sintomas'] ?? 'N/A') . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">' . htmlspecialchars($exp['Diagnostico']) . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">' . htmlspecialchars($exp['Tratamiento']) . '</Data></Cell>';
    echo '<Cell><Data ss:Type="String">' . htmlspecialchars($exp['RecetaMedica'] ?? 'N/A') . '</Data></Cell>';
    echo '</Row>';
}

echo '</Table></Worksheet></Workbook>';

// Guardar registro en BD
$sqlInsert = "INSERT INTO Reportes (TipoReporte, IdPaciente, RutaArchivo, Descripcion, GeneradoPor)
              VALUES (:tipo, :idPaciente, :ruta, :descripcion, :generadoPor)";
$stmtInsert = $pdo->prepare($sqlInsert);
$tipo = 'Excel';
$ruta = 'reports/' . $fileName;
$descripcion = 'Expediente de ' . $paciente['NombreCompleto'];
$generadoPor = $_SESSION['username'] ?? 'Sistema';

$stmtInsert->bindParam(':tipo', $tipo);
$stmtInsert->bindParam(':idPaciente', $idPaciente);
$stmtInsert->bindParam(':ruta', $ruta);
$stmtInsert->bindParam(':descripcion', $descripcion);
$stmtInsert->bindParam(':generadoPor', $generadoPor);
$stmtInsert->execute();

exit();
