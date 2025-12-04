
CREATE TABLE Pacientes (
    IdPaciente INT AUTO_INCREMENT PRIMARY KEY,
    NombreCompleto VARCHAR(150),
    CURP VARCHAR(18),
    FechaNacimiento DATE,
    Sexo CHAR(1),
    Telefono VARCHAR(20),
    CorreoElectronico VARCHAR(100),
    Direccion VARCHAR(250),
    ContactoEmergencia VARCHAR(150),
    TelefonoEmergencia VARCHAR(20),
    Alergias VARCHAR(250),
    AntecedentesMedicos TEXT,
    FechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP,
    Estatus BOOLEAN DEFAULT 1
);

CREATE TABLE Especialidades (
    IdEspecialidad INT AUTO_INCREMENT PRIMARY KEY,
    NombreEspecialidad VARCHAR(100),
    Descripcion VARCHAR(250)
);

CREATE TABLE Medicos (
    IdMedico INT AUTO_INCREMENT PRIMARY KEY,
    NombreCompleto VARCHAR(150),
    CedulaProfesional VARCHAR(50),
    EspecialidadId INT,
    Telefono VARCHAR(20),
    CorreoElectronico VARCHAR(100),
    HorarioAtencion VARCHAR(100),
    FechaIngreso DATETIME DEFAULT CURRENT_TIMESTAMP,
    Estatus BOOLEAN DEFAULT 1,
    FOREIGN KEY (EspecialidadId) REFERENCES Especialidades(IdEspecialidad)
);

CREATE TABLE Tarifas (
    IdTarifa INT AUTO_INCREMENT PRIMARY KEY,
    DescripcionServicio VARCHAR(150),
    CostoBase DECIMAL(10,2),
    EspecialidadId INT NULL,
    Estatus BOOLEAN DEFAULT 1,
    FOREIGN KEY (EspecialidadId) REFERENCES Especialidades(IdEspecialidad) ON DELETE RESTRICT
);

CREATE TABLE Citas (
    IdCita INT AUTO_INCREMENT PRIMARY KEY,
    IdPaciente INT,
    IdMedico INT,
    FechaCita DATETIME,
    MotivoConsulta VARCHAR(250),
    IdTarifa INT NULL,
    EstadoCita VARCHAR(20),
    Observaciones VARCHAR(250),
    FechaRegistro DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (IdPaciente) REFERENCES Pacientes(IdPaciente) ON DELETE RESTRICT,
    FOREIGN KEY (IdMedico) REFERENCES Medicos(IdMedico) ON DELETE RESTRICT,
    FOREIGN KEY (IdTarifa) REFERENCES Tarifas(IdTarifa) ON DELETE SET NULL
);

CREATE TABLE Expedientes (
    IdExpediente INT AUTO_INCREMENT PRIMARY KEY,
    IdPaciente INT,
    IdMedico INT,
    FechaConsulta DATETIME,
    Sintomas TEXT,
    Diagnostico TEXT,
    Tratamiento TEXT,
    RecetaMedica TEXT,
    NotasAdicionales TEXT,
    ProximaCita DATETIME NULL,
    FOREIGN KEY (IdPaciente) REFERENCES Pacientes(IdPaciente) ON DELETE RESTRICT,
    FOREIGN KEY (IdMedico) REFERENCES Medicos(IdMedico) ON DELETE RESTRICT
);

CREATE TABLE Pagos (
    IdPago INT AUTO_INCREMENT PRIMARY KEY,
    IdCita INT,
    IdPaciente INT,
    IdTarifa INT NULL,
    Monto DECIMAL(10,2),
    MetodoPago VARCHAR(50),
    FechaPago DATETIME DEFAULT CURRENT_TIMESTAMP,
    Referencia VARCHAR(100),
    EstatusPago VARCHAR(20),
    FOREIGN KEY (IdCita) REFERENCES Citas(IdCita) ON DELETE RESTRICT,
    FOREIGN KEY (IdPaciente) REFERENCES Pacientes(IdPaciente) ON DELETE RESTRICT,
    FOREIGN KEY (IdTarifa) REFERENCES Tarifas(IdTarifa) ON DELETE SET NULL
);

CREATE TABLE Reportes (
    IdReporte INT AUTO_INCREMENT PRIMARY KEY,
    TipoReporte VARCHAR(50),
    IdPaciente INT NULL,
    IdMedico INT NULL,
    FechaGeneracion DATETIME DEFAULT CURRENT_TIMESTAMP,
    RutaArchivo VARCHAR(250),
    Descripcion VARCHAR(250),
    GeneradoPor VARCHAR(100),
    FOREIGN KEY (IdPaciente) REFERENCES Pacientes(IdPaciente) ON DELETE SET NULL,
    FOREIGN KEY (IdMedico) REFERENCES Medicos(IdMedico) ON DELETE SET NULL
);

CREATE TABLE Usuarios (
    IdUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Usuario VARCHAR(50),
    CorreoElectronico VARCHAR(100),
    ContrasenaHash VARCHAR(200),
    Rol VARCHAR(50),
    IdMedico INT NULL,
    Activo BOOLEAN DEFAULT 1,
    PermisoPacientes BOOLEAN DEFAULT 1,
    PermisoCitas BOOLEAN DEFAULT 1,
    PermisoExpedientes BOOLEAN DEFAULT 1,
    PermisoTarifas BOOLEAN DEFAULT 0,
    UltimoAcceso DATETIME,
    FOREIGN KEY (IdMedico) REFERENCES Medicos(IdMedico) ON DELETE CASCADE
);

CREATE TABLE Bitacora (
    IdBitacora INT AUTO_INCREMENT PRIMARY KEY,
    IdUsuario INT,
    FechaAcceso DATETIME DEFAULT CURRENT_TIMESTAMP,
    AccionRealizada VARCHAR(250),
    Modulo VARCHAR(100),
    FOREIGN KEY (IdUsuario) REFERENCES Usuarios(IdUsuario) ON DELETE RESTRICT
);