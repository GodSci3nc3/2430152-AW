SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Pacientes con expedientes completos
INSERT INTO Pacientes (NombreCompleto, CURP, FechaNacimiento, Sexo, Telefono, CorreoElectronico, Direccion, ContactoEmergencia, TelefonoEmergencia, Alergias, AntecedentesMedicos, FechaRegistro) VALUES
('Juan Pérez Martínez', 'PEMJ850315HNLRXN01', '1985-03-15', 'M', '8341234567', 'juan.perez@email.com', 'Calle Principal 123, Col. Centro', 'María Pérez', '8349876543', 'Penicilina', 'Hipertensión', '2025-11-20 09:30:00'),
('Ana García López', 'GALA900521MDFRNNA1', '1990-05-21', 'F', '8342345678', 'ana.garcia@email.com', 'Av. Juárez 456, Col. Moderna', 'Pedro García', '8348765432', 'Ninguna', 'Diabetes tipo 2', '2025-11-21 10:15:00'),
('Carlos Rodríguez Sánchez', 'ROSC781109HPLNDR05', '1978-11-09', 'M', '8343456789', 'carlos.rodriguez@email.com', 'Blvd. Constitución 789, Col. Jardines', 'Laura Rodríguez', '8347654321', 'Lactosa', 'Ninguno', '2025-11-22 11:00:00'),
('María Fernanda Hernández', 'HEFM920814MDFRRL03', '1992-08-14', 'F', '8344567890', 'mf.hernandez@email.com', 'Calle Morelos 321, Col. Insurgentes', 'José Hernández', '8346543210', 'Polen', 'Asma', '2025-11-23 14:20:00'),
('Roberto Martínez Cruz', 'MACR870228HPLRRB08', '1987-02-28', 'M', '8345678901', 'roberto.martinez@email.com', 'Av. Reforma 654, Col. Lomas', 'Sofía Martínez', '8345432109', 'Ninguna', 'Ninguno', '2025-11-24 15:45:00'),

-- Pacientes con expedientes básicos
('Laura González Ramírez', 'GORL950612MDFNMR02', '1995-06-12', 'F', '8346789012', 'laura.gonzalez@email.com', 'Calle Hidalgo 147, Col. Guadalupe', 'Miguel González', '8344321098', NULL, NULL, '2025-11-25 16:30:00'),
('Pedro López Torres', 'LOTP881025HPLPRDR1', '1988-10-25', 'M', '8347890123', 'pedro.lopez@email.com', 'Av. México 258, Col. Obrera', 'Carmen López', '8343210987', NULL, NULL, '2025-11-26 09:00:00'),
('Sofía Ramírez Flores', 'RAFS930317MDFMLF04', '1993-03-17', 'F', '8348901234', 'sofia.ramirez@email.com', 'Calle Zaragoza 369, Col. Centro', 'Luis Ramírez', '8342109876', NULL, NULL, '2025-11-27 10:30:00'),
('Jorge Flores Morales', 'FLMJ860730HPLRRG06', '1986-07-30', 'M', '8349012345', 'jorge.flores@email.com', 'Blvd. Independencia 741, Col. Del Valle', 'Ana Flores', '8341098765', NULL, NULL, '2025-11-28 11:15:00'),
('Elena Morales Sánchez', 'MOSE910204MDFRNL09', '1991-02-04', 'F', '8340123456', 'elena.morales@email.com', 'Av. Revolución 852, Col. Azteca', 'Carlos Morales', '8340987654', NULL, NULL, '2025-11-29 13:45:00'),

-- Más pacientes para variedad
('Ricardo Torres Vega', 'TOVR840918HPLTGC03', '1984-09-18', 'M', '8341234568', 'ricardo.torres@email.com', 'Calle Allende 963, Col. Reforma', 'Patricia Torres', '8349876544', 'Aspirina', 'Migraña crónica', '2025-11-30 14:00:00'),
('Patricia Vega Ruiz', 'VERP891122MDFRGT07', '1989-11-22', 'F', '8342345679', 'patricia.vega@email.com', 'Av. Madero 159, Col. Lindavista', 'Ricardo Vega', '8348765433', NULL, NULL, '2025-12-01 15:20:00'),
('Miguel Ruiz Castro', 'RUCM940606HPLZSGL2', '1994-06-06', 'M', '8343456780', 'miguel.ruiz@email.com', 'Calle Victoria 357, Col. América', 'Diana Ruiz', '8347654322', 'Ninguna', 'Ninguno', '2025-12-02 09:30:00'),
('Diana Castro Vargas', 'CAVD970815MDFRSN05', '1997-08-15', 'F', '8344567891', 'diana.castro@email.com', 'Blvd. López Mateos 753, Col. San José', 'Miguel Castro', '8346543211', NULL, NULL, '2025-12-03 10:45:00'),
('Fernando Vargas Núñez', 'VANF821203HPLRRR08', '1982-12-03', 'M', '8345678902', 'fernando.vargas@email.com', 'Av. Universidad 951, Col. Universitaria', 'Lucía Vargas', '8345432100', 'Polen, Polvo', 'Rinitis alérgica', '2025-12-04 11:30:00');
