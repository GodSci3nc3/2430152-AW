# Análisis del Sistema Medicore

## Descripción del sistema

Medicore es un sistema de gestión médica completo que permite administrar consultorios médicos, clínicas o pequeños hospitales de manera eficiente. Está construido con tecnologías web modernas como PHP para el backend, MySQL como base de datos, y JavaScript con Bootstrap para la interfaz de usuario. 

El sistema está diseñado pensando en tres perfiles de usuario distintos, cada uno con responsabilidades específicas que cubren todas las operaciones de un centro médico, desde la recepción de pacientes hasta la gestión administrativa y financiera.

## Arquitectura Técnica

| Componente | Tecnología | Propósito |
|------------|------------|-----------|
| Backend | PHP con PDO | Procesamiento de datos y lógica de negocio |
| Base de datos | MySQL | Almacenamiento de información |
| Frontend | HTML, CSS, JavaScript | Interfaz de usuario interactiva |
| Framework CSS | Bootstrap | Diseño responsivo y componentes |
| Librerías | DataTables, Chart.js, FullCalendar | Funcionalidades especializadas |
| Gestión de dependencias | Composer | Manejo de paquetes PHP |

## Roles de Usuario

El sistema opera con tres tipos de usuarios, cada uno con acceso a funcionalidades específicas según sus responsabilidades en el centro médico.

### Administrador
El administrador es quien tiene el control completo del sistema y se encarga principalmente de la gestión empresarial. Su trabajo se centra en mantener la operación general del negocio, supervisando los aspectos financieros y administrativos. Tiene acceso a herramientas para gestionar el personal médico, configurar tarifas de servicios, y generar reportes que le permitan tomar decisiones estratégicas sobre el consultorio.

### Doctor
Los médicos utilizan el sistema para todo lo relacionado con la atención directa a pacientes. Su interfaz está diseñada para facilitar el trabajo clínico diario, permitiéndoles revisar su agenda de citas, acceder rápidamente a los expedientes de sus pacientes, y documentar las consultas realizadas. El sistema les proporciona una visión completa del historial médico de cada paciente, lo que mejora la calidad de la atención.

### Recepcionista
La recepcionista maneja la operación diaria del consultorio, siendo el primer punto de contacto con los pacientes. Su trabajo incluye programar citas médicas, registrar nuevos pacientes, procesar pagos, y mantener actualizada la información de contacto. El sistema le permite coordinar eficientemente entre pacientes y médicos, asegurando que la agenda funcione sin problemas.

## Entidades del Sistema

El sistema maneja varias entidades principales que se relacionan entre sí para formar un ecosistema completo de gestión médica.

| Entidad | Información Principal | Relaciones |
|---------|----------------------|------------|
| **Pacientes** | Datos personales, contacto, información médica, contacto de emergencia | Se relaciona con Citas, Expedientes y Pagos |
| **Médicos** | Información profesional, cédula, especialidad, horarios | Vinculado con Especialidades, Citas, Expedientes y Usuarios |
| **Especialidades** | Nombre y descripción de áreas médicas | Conecta con Médicos y Tarifas |
| **Citas** | Programación, motivo, estado, observaciones | Une Pacientes con Médicos |
| **Expedientes** | Historial clínico, diagnósticos, tratamientos, recetas | Documenta la relación Paciente-Médico |
| **Tarifas** | Costos de servicios, descripción | Puede vincularse a Especialidades específicas |
| **Pagos** | Montos, métodos, referencias, estados | Se relaciona con Citas y Pacientes |

### Los Pacientes
Los pacientes representan la razón de ser del sistema. Cada registro incluye información completa que abarca desde datos básicos como nombre y CURP, hasta información médica crítica como alergias y antecedentes. El sistema también almacena datos de contacto de emergencia, lo que es fundamental en situaciones críticas. Cada paciente tiene un estado que indica si está activo en el sistema, permitiendo mantener un control sobre la base de datos.

### Médicos y Especialidades
Los médicos son los profesionales que brindan atención, y el sistema almacena su información profesional incluyendo cédula profesional y especialidad médica. Cada médico puede tener horarios de atención específicos, lo que permite al sistema programar citas de manera inteligente. La relación con especialidades permite organizar a los médicos por área de expertise, facilitando la asignación de pacientes al especialista correcto.

### Citas
Las citas representan el corazón operativo del sistema, ya que conectan pacientes con médicos en momentos específicos. Cada cita incluye información sobre el motivo de la consulta, su estado actual (programada, realizada, cancelada), y observaciones adicionales. Esta entidad es crucial porque coordina toda la operación diaria del consultorio.

### Expedientes Clínicos
Los expedientes mantienen el historial médico detallado de cada paciente. Aquí se registran síntomas, diagnósticos, tratamientos prescritos y recetas médicas. También incluye notas adicionales y puede programar próximas citas de seguimiento. Cada entrada del expediente está vinculada al médico que realizó la consulta, manteniendo trazabilidad completa.

## Funcionalidad del sistema

### Sistema de Tarifas
El sistema de tarifas es fundamental para el control financiero del consultorio. Funciona como un catálogo de precios que define cuánto cuesta cada servicio médico. Puedes configurar tarifas generales para consultas básicas, y tarifas especializadas que se vinculan a especialidades específicas. 

Por ejemplo, una consulta general puede costar $500 pesos, mientras que una consulta de cardiología puede costar $800 pesos. Esta flexibilidad permite adaptar los precios según el nivel de especialización requerido. El sistema utiliza estas tarifas para calcular automáticamente el costo de cada cita, asegurando consistencia en los precios.

### Sistema de Pagos
Cada vez que un paciente paga por una consulta, el sistema registra toda la información financiera. Esto incluye el monto pagado, el método de pago (efectivo, tarjeta, transferencia), y un número de referencia para seguimiento. Cada pago se vincula directamente a la cita correspondiente, creando un rastro completo de ingresos.

El sistema maneja diferentes estados de pago: pendiente (cuando el paciente aún no ha pagado), completado (pago recibido), o cancelado (si la cita se cancela). Esto permite tener control total sobre las finanzas del consultorio y generar reportes de ingresos precisos.

### Reportes
Los reportes transforman los datos del sistema en información útil para tomar decisiones. Puedes generar reportes de pacientes para ver tendencias de atención, reportes de médicos para evaluar productividad, y reportes financieros para analizar ingresos por período. Todos los reportes se guardan como archivos, permitiendo revisarlos posteriormente o compartirlos con otras personas.

### Control de Usuarios y Seguridad
El sistema implementa un control de acceso robusto donde cada usuario tiene credenciales únicas con contraseñas encriptadas. Dependiendo del rol asignado (admin, doctor, recepcionista), el sistema muestra diferentes funcionalidades. Los médicos pueden tener un usuario del sistema vinculado a su perfil profesional, lo que permite rastrear qué médico realizó cada acción.

### Bitácora
Todas las acciones realizadas en el sistema quedan registradas en la bitácora. Esto incluye quién hizo qué, cuándo lo hizo, y en qué módulo del sistema. Esta funcionalidad es crucial para detectar actividad sospechosa, resolver problemas, y mantener un registro completo de la operación del consultorio.

## Flujos de Trabajo en la Práctica
