SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

INSERT INTO Reportes (TipoReporte, IdPaciente, IdMedico, FechaGeneracion, RutaArchivo, Descripcion, GeneradoPor) VALUES
('Expediente Médico', 1, 1, '2025-12-02 10:00:00', '/reportes/expediente_1_20251202.pdf', 'Expediente completo paciente 1 - Cardiología', 'admin'),
('Expediente Médico', 2, 2, '2025-12-02 11:30:00', '/reportes/expediente_2_20251202.pdf', 'Expediente completo paciente 2 - Pediatría', 'admin'),
('Expediente Médico', 3, 3, '2025-12-02 12:00:00', '/reportes/expediente_3_20251202.pdf', 'Expediente completo paciente 3 - Dermatología', 'admin'),
('Expediente Médico', 4, 2, '2025-12-03 12:00:00', '/reportes/expediente_4_20251203.pdf', 'Expediente paciente 4 - Pediatría', 'admin'),
('Historial de Consultas', 1, 1, '2025-12-05 14:00:00', '/reportes/historial_1_20251205.pdf', 'Historial de consultas cardiológicas', 'admin'),
('Historial de Consultas', 5, 3, '2025-12-05 15:00:00', '/reportes/historial_5_20251205.pdf', 'Historial de consultas dermatológicas', 'admin'),
('Reporte Financiero', NULL, NULL, '2025-12-06 16:00:00', '/reportes/financiero_mensual_nov2025.pdf', 'Reporte financiero noviembre 2025', 'admin'),
('Reporte de Pacientes', NULL, NULL, '2025-12-07 10:00:00', '/reportes/pacientes_20251207.pdf', 'Reporte general de pacientes activos', 'admin');
