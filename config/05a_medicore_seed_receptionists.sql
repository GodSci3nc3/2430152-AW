SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Recepcionista para Dr. Carlos Méndez (IdMedico=1)
INSERT INTO Usuarios (Usuario, ContrasenaHash, CorreoElectronico, Rol, IdMedicoAsignado, PermisoPacientes, PermisoCitas, PermisoExpedientes, PermisoTarifas, Activo) VALUES
('recep_carlos', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'recep.carlos@medicore.com', 'Recepcionista', 1, 1, 1, 0, 1, 1);

-- Recepcionista para Dra. María Fernanda (IdMedico=2)
INSERT INTO Usuarios (Usuario, ContrasenaHash, CorreoElectronico, Rol, IdMedicoAsignado, PermisoPacientes, PermisoCitas, PermisoExpedientes, PermisoTarifas, Activo) VALUES
('recep_maria', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'recep.maria@medicore.com', 'Recepcionista', 2, 1, 1, 0, 1, 1);

-- Recepcionista para Dr. Roberto Sánchez (IdMedico=3)
INSERT INTO Usuarios (Usuario, ContrasenaHash, CorreoElectronico, Rol, IdMedicoAsignado, PermisoPacientes, PermisoCitas, PermisoExpedientes, PermisoTarifas, Activo) VALUES
('recep_roberto', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'recep.roberto@medicore.com', 'Recepcionista', 3, 1, 1, 0, 1, 1);
