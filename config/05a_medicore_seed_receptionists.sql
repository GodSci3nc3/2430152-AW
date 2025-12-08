SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Recepcionistas asignadas a cada médico
-- Contraseña: password

INSERT INTO Usuarios (Usuario, ContrasenaHash, Rol, IdMedico, Activo) VALUES
('recep_carlos', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'receptionist', 1, 1),
('recep_maria', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'receptionist', 2, 1),
('recep_roberto', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'receptionist', 3, 1);
