SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Expedientes médicos para pacientes con historial
INSERT INTO Expedientes (IdPaciente, IdMedico, FechaConsulta, Sintomas, Diagnostico, Tratamiento, RecetaMedica, NotasAdicionales, ProximaCita) VALUES
-- Paciente 1 - Consultas cardiológicas con Dr. Carlos (IdMedico=1)
(1, 1, '2025-12-02 08:30:00', 'Presión arterial elevada, mareos ocasionales', 'Hipertensión arterial grado 1', 'Control dietético, ejercicio regular, medicación antihipertensiva', 'Losartán 50mg - 1 tableta cada 24 horas', 'Paciente responde bien al tratamiento. Control mensual', '2026-01-02 08:30:00'),
(1, 1, '2025-12-05 09:00:00', 'Seguimiento de presión arterial', 'Hipertensión controlada', 'Continuar con mismo tratamiento', 'Losartán 50mg - 1 tableta cada 24 horas', 'Presión arterial dentro de rangos normales', '2026-02-05 09:00:00'),

-- Paciente 2 - Consultas pediátricas con Dra. María (IdMedico=2)
(2, 2, '2025-12-02 14:30:00', 'Control de crecimiento infantil', 'Desarrollo normal para la edad', 'Continuar con alimentación balanceada', 'Complejo vitamínico infantil', 'Peso y talla dentro del percentil esperado', '2026-01-02 14:30:00'),
(2, 2, '2025-12-05 14:00:00', 'Tos y congestión nasal leve', 'Resfriado común', 'Reposo, hidratación abundante', 'Paracetamol infantil según peso', 'Evolución favorable esperada en 5-7 días', NULL),

-- Paciente 3 - Consultas dermatológicas con Dr. Roberto (IdMedico=3)
(3, 3, '2025-12-02 09:30:00', 'Erupción cutánea en brazos con picazón', 'Dermatitis de contacto', 'Evitar alérgenos, antihistamínicos tópicos', 'Hidrocortisona crema 1% - aplicar 2 veces al día. Loratadina 10mg', 'Mejoría esperada en 7-10 días', '2025-12-17 09:30:00'),
(3, 3, '2025-12-05 09:30:00', 'Acné facial moderado', 'Acné vulgar', 'Limpieza facial, tratamiento tópico', 'Peróxido de benzoilo gel 5% - aplicar por la noche', 'Control en 1 mes', '2026-01-05 09:30:00'),

-- Paciente 4 - Consultas pediátricas con Dra. María (IdMedico=2)
(4, 2, '2025-12-02 15:00:00', 'Vacunación de rutina', 'Esquema de vacunación actualizado', 'Continuar esquema según edad', 'Ninguna', 'Reacciones adversas no esperadas', '2026-03-02 15:00:00'),

-- Paciente 5 - Consulta dermatológica con Dr. Roberto (IdMedico=3)
(5, 3, '2025-12-02 10:00:00', 'Evaluación de lunares en espalda', 'Nevos benignos', 'Observación y protección solar', 'Protector solar FPS 50+', 'Autoexamen mensual recomendado', '2026-06-02 10:00:00'),

-- Paciente 6 - Consulta cardiológica con Dr. Carlos (IdMedico=1)
(6, 1, '2025-12-04 08:00:00', 'Dolor torácico intermitente', 'Reflujo gastroesofágico', 'Dieta baja en grasas, antiácidos', 'Omeprazol 20mg - 1 tableta antes del desayuno', 'Descartar origen cardiaco mediante ECG', NULL),

-- Paciente 7 - Consulta cardiológica con Dr. Carlos (IdMedico=1)
(7, 1, '2025-12-05 11:00:00', 'Chequeo cardiovascular anual', 'Estado cardiovascular normal', 'Mantener actividad física regular', 'Ninguna', 'Sin hallazgos patológicos', '2026-12-05 11:00:00'),

-- Paciente 10 - Consulta pediátrica con Dra. María (IdMedico=2)
(10, 2, '2025-12-05 16:00:00', 'Fiebre y dolor de garganta', 'Faringitis viral', 'Reposo, analgésicos, líquidos', 'Paracetamol infantil cada 6 horas', 'Evolución favorable en 3-5 días', NULL),

-- Paciente 11 - Consulta cardiológica con Dr. Carlos (IdMedico=1)
(11, 1, '2025-12-06 08:30:00', 'Palpitaciones ocasionales', 'Arritmia sinusal benigna', 'Reducir cafeína y estrés', 'Ninguna por el momento', 'Monitoreo ambulatorio si persiste', '2026-03-06 08:30:00'),

-- Paciente 15 - Consulta dermatológica con Dr. Roberto (IdMedico=3)
(15, 3, '2025-12-05 08:00:00', 'Manchas blancas en piel', 'Vitíligo inicial', 'Fototerapia, protección solar', 'Protector solar FPS 50+ y crema de tacrolimus', 'Evolución lenta esperada', '2026-02-05 08:00:00');
