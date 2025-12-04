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

// Crear PDF con PHP puro
class PDF {
    private $paciente;
    private $expedientes;
    
    public function __construct($pacienteData, $expedientesData) {
        $this->paciente = $pacienteData;
        $this->expedientes = $expedientesData;
    }
    
    public function output($filename) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        // PDF simple con estructura básica
        $pdf = "%PDF-1.4\n";
        $pdf .= "1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj\n";
        $pdf .= "2 0 obj<</Type/Pages/Kids[3 0 R]/Count 1>>endobj\n";
        $pdf .= "3 0 obj<</Type/Page/Parent 2 0 R/MediaBox[0 0 595 842]/Contents 4 0 R/Resources<</Font<</F1 5 0 R>>>>>>endobj\n";
        
        $content = "BT\n/F1 16 Tf\n50 800 Td\n(MEDICORE - Expediente Medico) Tj\n";
        $content .= "0 -20 Td\n/F1 10 Tf\n(Generado: " . date('d/m/Y H:i') . ") Tj\n";
        $content .= "0 -30 Td\n/F1 12 Tf\n(INFORMACION DEL PACIENTE) Tj\n";
        $content .= "0 -20 Td\n/F1 10 Tf\n(Nombre: " . $this->escapeText($this->paciente['NombreCompleto']) . ") Tj\n";
        $content .= "0 -15 Td\n(CURP: " . $this->escapeText($this->paciente['CURP']) . ") Tj\n";
        $content .= "0 -15 Td\n(Fecha Nac: " . date('d/m/Y', strtotime($this->paciente['FechaNacimiento'])) . ") Tj\n";
        $content .= "0 -15 Td\n(Telefono: " . $this->escapeText($this->paciente['Telefono']) . ") Tj\n";
        $content .= "0 -30 Td\n/F1 12 Tf\n(HISTORIAL DE CONSULTAS) Tj\n";
        
        $y = 0;
        foreach ($this->expedientes as $exp) {
            $content .= "0 -20 Td\n/F1 10 Tf\n(Fecha: " . date('d/m/Y', strtotime($exp['FechaConsulta'])) . " - Dr. " . $this->escapeText($exp['NombreMedico']) . ") Tj\n";
            $content .= "0 -15 Td\n(Diagnostico: " . substr($this->escapeText($exp['Diagnostico']), 0, 60) . ") Tj\n";
            $y -= 35;
            if ($y < -600) break; // Evitar overflow
        }
        
        $content .= "ET\n";
        
        $pdf .= "4 0 obj<</Length " . strlen($content) . ">>stream\n" . $content . "endstream\nendobj\n";
        $pdf .= "5 0 obj<</Type/Font/Subtype/Type1/BaseFont/Helvetica>>endobj\n";
        $pdf .= "xref\n0 6\n0000000000 65535 f\n0000000009 00000 n\n0000000056 00000 n\n0000000115 00000 n\n0000000241 00000 n\n";
        $pdf .= sprintf("%010d 00000 n\n", strlen($pdf));
        $pdf .= "trailer<</Size 6/Root 1 0 R>>\nstartxref\n" . strlen($pdf) . "\n%%EOF";
        
        echo $pdf;
    }
    
    private function escapeText($text) {
        if ($text === null) return '';
        return str_replace(['(', ')', '\\'], ['', '', ''], $text);
    }
}

$pdf = new PDF($paciente, $expedientes);
$fileName = 'expediente_' . $paciente['IdPaciente'] . '_' . date('YmdHis') . '.pdf';

// Guardar registro en BD
$sqlInsert = "INSERT INTO Reportes (TipoReporte, IdPaciente, RutaArchivo, Descripcion, GeneradoPor)
              VALUES (:tipo, :idPaciente, :ruta, :descripcion, :generadoPor)";
$stmtInsert = $pdo->prepare($sqlInsert);
$tipo = 'PDF';
$ruta = 'reports/' . $fileName;
$descripcion = 'Expediente de ' . $paciente['NombreCompleto'];
$generadoPor = $_SESSION['username'] ?? 'Sistema';

$stmtInsert->bindParam(':tipo', $tipo);
$stmtInsert->bindParam(':idPaciente', $idPaciente);
$stmtInsert->bindParam(':ruta', $ruta);
$stmtInsert->bindParam(':descripcion', $descripcion);
$stmtInsert->bindParam(':generadoPor', $generadoPor);
$stmtInsert->execute();

$pdf->output($fileName);
exit();
