SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
INSERT INTO Usuarios (Usuario, CorreoElectronico, ContrasenaHash, Rol, IdMedico, Activo, PermisoPacientes, PermisoCitas, PermisoExpedientes, PermisoTarifas) VALUES
('admin', 'admin@admin.com', '$2y$10$jfAadoDIJYMZBmfT.y9Tze4A9PMqUJ5.irDy6ZcI/37EOr9gZd2r.', 'admin', NULL, 1, 1, 1, 1, 1),
('carlos.mendez', 'carlos.mendez@medicore.com', '$2y$10$jfAadoDIJYMZBmfT.y9Tze4A9PMqUJ5.irDy6ZcI/37EOr9gZd2r.', 'doctor', 1, 1, 1, 1, 1, 0),
('maria.lopez', 'maria.lopez@medicore.com', '$2y$10$jfAadoDIJYMZBmfT.y9Tze4A9PMqUJ5.irDy6ZcI/37EOr9gZd2r.', 'doctor', 2, 1, 1, 1, 1, 0),
('roberto.sanchez', 'roberto.sanchez@medicore.com', '$2y$10$jfAadoDIJYMZBmfT.y9Tze4A9PMqUJ5.irDy6ZcI/37EOr9gZd2r.', 'doctor', 3, 1, 1, 1, 1, 0),
('recepcion', 'recepcion@medicore.com', '$2y$10$jfAadoDIJYMZBmfT.y9Tze4A9PMqUJ5.irDy6ZcI/37EOr9gZd2r.', 'receptionist', NULL, 1, 1, 1, 0, 1);