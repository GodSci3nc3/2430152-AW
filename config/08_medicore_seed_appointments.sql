SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Citas distribuidas del 2 al 14 de diciembre 2025 (~100 citas)
-- 70 citas completadas (del 2 al 7 de diciembre)
-- 30 citas futuras (del 9 al 14 de diciembre)

-- Diciembre 2, 2025 (Lunes) - 8 citas completadas
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(1, 1, '2025-12-02 08:30:00', 'Revisión cardiológica general', 1, 'Completada', 'Paciente estable'),
(2, 1, '2025-12-02 09:00:00', 'Control presión arterial', 1, 'Completada', 'PA normalizada'),
(3, 2, '2025-12-02 14:30:00', 'Vacunación infantil', 2, 'Completada', 'Esquema completo'),
(4, 2, '2025-12-02 15:00:00', 'Control de peso y talla', 2, 'Completada', 'Desarrollo normal'),
(5, 3, '2025-12-02 09:30:00', 'Consulta dermatológica', 3, 'Completada', 'Tratamiento prescrito'),
(6, 3, '2025-12-02 10:00:00', 'Tratamiento acné', 3, 'Completada', 'Mejora visible'),
(7, 1, '2025-12-02 10:30:00', 'Electrocardiograma', 1, 'Completada', 'ECG normal'),
(8, 2, '2025-12-02 16:00:00', 'Consulta pediátrica general', 2, 'Completada', 'Sin novedad');

-- Diciembre 3, 2025 (Martes) - 10 citas completadas
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(9, 3, '2025-12-03 08:00:00', 'Consulta dermatológica', 3, 'Completada', 'Seguimiento'),
(10, 3, '2025-12-03 08:30:00', 'Revisión de lunares', 3, 'Completada', 'Sin cambios'),
(11, 1, '2025-12-03 09:00:00', 'Control cardiológico', 1, 'Completada', 'Medicación ajustada'),
(12, 1, '2025-12-03 09:30:00', 'Ecocardiograma', 1, 'Completada', 'Resultados normales'),
(13, 2, '2025-12-03 14:00:00', 'Consulta pediátrica', 2, 'Completada', 'Gripe tratada'),
(14, 2, '2025-12-03 14:30:00', 'Control niño sano', 2, 'Completada', 'Desarrollo óptimo'),
(15, 3, '2025-12-03 10:00:00', 'Tratamiento psoriasis', 3, 'Completada', 'Evolución favorable'),
(1, 2, '2025-12-03 15:00:00', 'Consulta pediátrica', 2, 'Completada', 'Vacunas al día'),
(2, 3, '2025-12-03 11:00:00', 'Dermatitis atópica', 3, 'Completada', 'Tratamiento iniciado'),
(3, 1, '2025-12-03 10:00:00', 'Chequeo cardiológico', 1, 'Completada', 'Excelente estado');

-- Diciembre 4, 2025 (Miércoles) - 11 citas completadas
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(4, 1, '2025-12-04 08:00:00', 'Control post-operatorio', 1, 'Completada', 'Recuperación normal'),
(5, 1, '2025-12-04 08:30:00', 'Arritmias cardiacas', 1, 'Completada', 'Controladas'),
(6, 2, '2025-12-04 14:00:00', 'Infección respiratoria', 2, 'Completada', 'Antibiótico prescrito'),
(7, 2, '2025-12-04 14:30:00', 'Alergia alimentaria', 2, 'Completada', 'Dieta indicada'),
(8, 3, '2025-12-04 09:00:00', 'Consulta dermatológica', 3, 'Completada', 'Biopsia programada'),
(9, 3, '2025-12-04 09:30:00', 'Eczema infantil', 3, 'Completada', 'Crema recetada'),
(10, 1, '2025-12-04 10:00:00', 'Hipertensión arterial', 1, 'Completada', 'PA controlada'),
(11, 2, '2025-12-04 15:30:00', 'Gastroenteritis', 2, 'Completada', 'Hidratación oral'),
(12, 3, '2025-12-04 10:30:00', 'Caída de cabello', 3, 'Completada', 'Análisis solicitados'),
(13, 1, '2025-12-04 11:00:00', 'Dolor torácico', 1, 'Completada', 'Descartado IAM'),
(14, 2, '2025-12-04 16:00:00', 'Control de desarrollo', 2, 'Completada', 'Dentro de parámetros');

-- Diciembre 5, 2025 (Jueves) - 10 citas completadas
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(15, 3, '2025-12-05 08:00:00', 'Vitíligo', 3, 'Completada', 'Fototerapia sugerida'),
(1, 1, '2025-12-05 09:00:00', 'Revisión anual', 1, 'Completada', 'Todo en orden'),
(2, 2, '2025-12-05 14:00:00', 'Asma infantil', 2, 'Completada', 'Inhalador ajustado'),
(3, 3, '2025-12-05 09:30:00', 'Verrugas', 3, 'Completada', 'Crioterapia aplicada'),
(4, 2, '2025-12-05 15:00:00', 'Fiebre sin foco', 2, 'Completada', 'Observación 24h'),
(5, 1, '2025-12-05 10:00:00', 'Insuficiencia cardiaca', 1, 'Completada', 'Diuréticos ajustados'),
(6, 3, '2025-12-05 10:30:00', 'Herpes zóster', 3, 'Completada', 'Antivirales prescritos'),
(7, 1, '2025-12-05 11:00:00', 'Marcapasos revisión', 1, 'Completada', 'Funcionamiento óptimo'),
(8, 2, '2025-12-05 16:00:00', 'Otitis media', 2, 'Completada', 'Antibiótico oral'),
(9, 3, '2025-12-05 11:30:00', 'Rosácea', 3, 'Completada', 'Tratamiento tópico');

-- Diciembre 6, 2025 (Viernes) - 11 citas completadas
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(10, 1, '2025-12-06 08:00:00', 'Angina de pecho', 1, 'Completada', 'Cateterismo sugerido'),
(11, 1, '2025-12-06 08:30:00', 'Colesterol alto', 1, 'Completada', 'Estatinas indicadas'),
(12, 2, '2025-12-06 14:00:00', 'Bronquiolitis', 2, 'Completada', 'Nebulizaciones'),
(13, 2, '2025-12-06 14:30:00', 'Conjuntivitis', 2, 'Completada', 'Gotas oftálmicas'),
(14, 3, '2025-12-06 09:00:00', 'Melanoma sospecha', 3, 'Completada', 'Biopsia urgente'),
(15, 3, '2025-12-06 09:30:00', 'Dermatitis seborreica', 3, 'Completada', 'Shampoo medicado'),
(1, 1, '2025-12-06 10:00:00', 'Fibrilación auricular', 1, 'Completada', 'Anticoagulación'),
(2, 2, '2025-12-06 15:00:00', 'Dentición', 2, 'Completada', 'Orientación padres'),
(3, 3, '2025-12-06 10:30:00', 'Pie de atleta', 3, 'Completada', 'Antimicótico tópico'),
(4, 1, '2025-12-06 11:00:00', 'Soplo cardiaco', 1, 'Completada', 'Eco programado'),
(5, 2, '2025-12-06 16:00:00', 'Estreñimiento', 2, 'Completada', 'Dieta fibra');

-- Diciembre 7, 2025 (Sábado) - 10 citas completadas
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(6, 3, '2025-12-07 08:00:00', 'Quiste sebáceo', 3, 'Completada', 'Extirpación menor'),
(7, 3, '2025-12-07 08:30:00', 'Urticaria', 3, 'Completada', 'Antihistamínicos'),
(8, 1, '2025-12-07 09:00:00', 'Palpitaciones', 1, 'Completada', 'Holter 24h'),
(9, 1, '2025-12-07 09:30:00', 'Hipertrigliceridemia', 1, 'Completada', 'Dieta estricta'),
(10, 2, '2025-12-07 10:00:00', 'Sarampión vacuna', 2, 'Completada', 'Triple viral'),
(11, 2, '2025-12-07 10:30:00', 'Reflujo gastroesofágico', 2, 'Completada', 'Postura elevada'),
(12, 3, '2025-12-07 11:00:00', 'Celulitis facial', 3, 'Completada', 'Antibiótico IV'),
(13, 1, '2025-12-07 11:30:00', 'Aneurisma seguimiento', 1, 'Completada', 'Estable'),
(14, 2, '2025-12-07 12:00:00', 'Varicela', 2, 'Completada', 'Aislamiento casa'),
(15, 3, '2025-12-07 12:30:00', 'Queratosis actínica', 3, 'Completada', 'Nitrógeno líquido');

-- Diciembre 9, 2025 (Lunes) - 10 citas futuras
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(1, 1, '2025-12-09 08:00:00', 'Control mensual', 1, 'Programada', ''),
(2, 1, '2025-12-09 08:30:00', 'Revisión ecocardiograma', 1, 'Programada', ''),
(3, 2, '2025-12-09 14:00:00', 'Vacunación', 2, 'Programada', ''),
(4, 2, '2025-12-09 14:30:00', 'Control crecimiento', 2, 'Programada', ''),
(5, 3, '2025-12-09 09:00:00', 'Seguimiento tratamiento', 3, 'Programada', ''),
(6, 3, '2025-12-09 09:30:00', 'Revisión biopsia', 3, 'Programada', ''),
(7, 1, '2025-12-09 10:00:00', 'Chequeo cardiológico', 1, 'Programada', ''),
(8, 2, '2025-12-09 15:00:00', 'Consulta pediátrica', 2, 'Programada', ''),
(9, 3, '2025-12-09 10:30:00', 'Tratamiento dermatológico', 3, 'Programada', ''),
(10, 1, '2025-12-09 11:00:00', 'Revisión medicación', 1, 'Programada', '');

-- Diciembre 10, 2025 (Martes) - 10 citas futuras
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(11, 2, '2025-12-10 14:00:00', 'Control niño sano', 2, 'Programada', ''),
(12, 3, '2025-12-10 08:00:00', 'Consulta dermatológica', 3, 'Programada', ''),
(13, 1, '2025-12-10 09:00:00', 'Electrocardiograma', 1, 'Programada', ''),
(14, 2, '2025-12-10 15:00:00', 'Alergia alimentaria', 2, 'Programada', ''),
(15, 3, '2025-12-10 09:30:00', 'Revisión de lunares', 3, 'Programada', ''),
(1, 1, '2025-12-10 10:00:00', 'Control presión arterial', 1, 'Programada', ''),
(2, 2, '2025-12-10 16:00:00', 'Consulta pediátrica', 2, 'Programada', ''),
(3, 3, '2025-12-10 10:30:00', 'Tratamiento acné', 3, 'Programada', ''),
(4, 1, '2025-12-10 11:00:00', 'Revisión anual', 1, 'Programada', ''),
(5, 2, '2025-12-10 16:30:00', 'Vacunación infantil', 2, 'Programada', '');

-- Diciembre 11, 2025 (Miércoles) - 10 citas futuras
INSERT INTO Citas (IdPaciente, IdMedico, FechaCita, MotivoConsulta, IdTarifa, EstadoCita, Observaciones) VALUES
(6, 3, '2025-12-11 08:00:00', 'Consulta dermatológica', 3, 'Programada', ''),
(7, 1, '2025-12-11 09:00:00', 'Control cardiológico', 1, 'Programada', ''),
(8, 2, '2025-12-11 14:00:00', 'Control de desarrollo', 2, 'Programada', ''),
(9, 3, '2025-12-11 09:30:00', 'Tratamiento psoriasis', 3, 'Programada', ''),
(10, 1, '2025-12-11 10:00:00', 'Ecocardiograma', 1, 'Programada', ''),
(11, 2, '2025-12-11 15:00:00', 'Consulta pediátrica', 2, 'Programada', ''),
(12, 3, '2025-12-11 10:30:00', 'Dermatitis atópica', 3, 'Programada', ''),
(13, 1, '2025-12-11 11:00:00', 'Arritmias cardiacas', 1, 'Programada', ''),
(14, 2, '2025-12-11 16:00:00', 'Asma infantil', 2, 'Programada', ''),
(15, 3, '2025-12-11 11:30:00', 'Eczema infantil', 3, 'Programada', '');
