-- Seed para recepcionistas
-- Contraseña para todas: password

DELETE FROM Usuarios WHERE Rol = 'receptionist';

INSERT INTO Usuarios (Usuario, ContrasenaHash, Rol, IdMedico, Activo) VALUES
('ana.lopez', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'receptionist', 1, 1),
('maria.gonzalez', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'receptionist', 2, 1),
('laura.martinez', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'receptionist', 3, 1);
