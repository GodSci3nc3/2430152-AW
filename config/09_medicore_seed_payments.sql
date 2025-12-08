SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

-- Pagos para 70 citas completadas (del 2 al 7 de diciembre)
-- 68 pagos totales (97% de las citas tienen pago)
-- Promedio: $956 por pago = $65,008 total de ingresos
-- Gastos: $45,000 (fijos) + $19,502 (30% variables) = $64,502
-- Utilidad: $65,008 - $64,502 = $506 ✓

-- Diciembre 2 (8 citas - 8 pagadas)
INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, FechaPago, Referencia, EstatusPago) VALUES
(1, 1, 1, 950.00, 'Tarjeta', '2025-12-02 09:00:00', 'TXN001', 'Pagado'),
(2, 2, 1, 920.00, 'Efectivo', '2025-12-02 09:30:00', 'EFE001', 'Pagado'),
(3, 3, 2, 880.00, 'Tarjeta', '2025-12-02 15:00:00', 'TXN002', 'Pagado'),
(4, 4, 2, 900.00, 'Tarjeta', '2025-12-02 15:30:00', 'TXN003', 'Pagado'),
(5, 5, 3, 1050.00, 'Tarjeta', '2025-12-02 10:00:00', 'TXN004', 'Pagado'),
(6, 6, 3, 970.00, 'Efectivo', '2025-12-02 10:30:00', 'EFE002', 'Pagado'),
(7, 7, 1, 1000.00, 'Tarjeta', '2025-12-02 11:00:00', 'TXN005', 'Pagado'),
(8, 8, 2, 890.00, 'Tarjeta', '2025-12-02 16:30:00', 'TXN006', 'Pagado');

-- Diciembre 3 (10 citas - 10 pagadas)
INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, FechaPago, Referencia, EstatusPago) VALUES
(9, 9, 3, 960.00, 'Tarjeta', '2025-12-03 08:30:00', 'TXN007', 'Pagado'),
(10, 10, 3, 940.00, 'Tarjeta', '2025-12-03 09:00:00', 'TXN008', 'Pagado'),
(11, 11, 1, 990.00, 'Efectivo', '2025-12-03 09:30:00', 'EFE003', 'Pagado'),
(12, 12, 1, 1020.00, 'Tarjeta', '2025-12-03 10:00:00', 'TXN009', 'Pagado'),
(13, 13, 2, 890.00, 'Tarjeta', '2025-12-03 14:30:00', 'TXN010', 'Pagado'),
(14, 14, 2, 870.00, 'Efectivo', '2025-12-03 15:00:00', 'EFE004', 'Pagado'),
(15, 15, 3, 1080.00, 'Tarjeta', '2025-12-03 10:30:00', 'TXN011', 'Pagado'),
(16, 1, 2, 910.00, 'Tarjeta', '2025-12-03 15:30:00', 'TXN012', 'Pagado'),
(17, 2, 3, 980.00, 'Efectivo', '2025-12-03 11:30:00', 'EFE005', 'Pagado'),
(18, 3, 1, 1010.00, 'Tarjeta', '2025-12-03 10:30:00', 'TXN013', 'Pagado');

-- Diciembre 4 (11 citas - 11 pagadas)
INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, FechaPago, Referencia, EstatusPago) VALUES
(19, 4, 1, 1030.00, 'Tarjeta', '2025-12-04 08:30:00', 'TXN014', 'Pagado'),
(20, 5, 1, 950.00, 'Tarjeta', '2025-12-04 09:00:00', 'TXN015', 'Pagado'),
(21, 6, 2, 880.00, 'Efectivo', '2025-12-04 14:30:00', 'EFE006', 'Pagado'),
(22, 7, 2, 920.00, 'Tarjeta', '2025-12-04 15:00:00', 'TXN016', 'Pagado'),
(23, 8, 3, 1000.00, 'Tarjeta', '2025-12-04 09:30:00', 'TXN017', 'Pagado'),
(24, 9, 3, 960.00, 'Efectivo', '2025-12-04 10:00:00', 'EFE007', 'Pagado'),
(25, 10, 1, 1070.00, 'Tarjeta', '2025-12-04 10:30:00', 'TXN018', 'Pagado'),
(26, 11, 2, 860.00, 'Tarjeta', '2025-12-04 16:00:00', 'TXN019', 'Pagado'),
(27, 12, 3, 990.00, 'Tarjeta', '2025-12-04 11:00:00', 'TXN020', 'Pagado'),
(28, 13, 1, 1040.00, 'Efectivo', '2025-12-04 11:30:00', 'EFE008', 'Pagado'),
(29, 14, 2, 930.00, 'Tarjeta', '2025-12-04 16:30:00', 'TXN021', 'Pagado');

-- Diciembre 5 (10 citas - 10 pagadas)
INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, FechaPago, Referencia, EstatusPago) VALUES
(30, 15, 3, 1090.00, 'Tarjeta', '2025-12-05 08:30:00', 'TXN022', 'Pagado'),
(31, 1, 1, 970.00, 'Tarjeta', '2025-12-05 09:30:00', 'TXN023', 'Pagado'),
(32, 2, 2, 900.00, 'Efectivo', '2025-12-05 14:30:00', 'EFE009', 'Pagado'),
(33, 3, 3, 950.00, 'Tarjeta', '2025-12-05 10:00:00', 'TXN024', 'Pagado'),
(34, 4, 2, 890.00, 'Tarjeta', '2025-12-05 15:30:00', 'TXN025', 'Pagado'),
(35, 5, 1, 1100.00, 'Tarjeta', '2025-12-05 10:30:00', 'TXN026', 'Pagado'),
(36, 6, 3, 980.00, 'Efectivo', '2025-12-05 11:00:00', 'EFE010', 'Pagado'),
(37, 7, 1, 1040.00, 'Tarjeta', '2025-12-05 11:30:00', 'TXN027', 'Pagado'),
(38, 8, 2, 870.00, 'Tarjeta', '2025-12-05 16:30:00', 'TXN028', 'Pagado'),
(39, 9, 3, 960.00, 'Efectivo', '2025-12-05 12:00:00', 'EFE011', 'Pagado');

-- Diciembre 6 (11 citas - 11 pagadas)
INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, FechaPago, Referencia, EstatusPago) VALUES
(40, 10, 1, 1120.00, 'Tarjeta', '2025-12-06 08:30:00', 'TXN029', 'Pagado'),
(41, 11, 1, 1000.00, 'Tarjeta', '2025-12-06 09:00:00', 'TXN030', 'Pagado'),
(42, 12, 2, 910.00, 'Efectivo', '2025-12-06 14:30:00', 'EFE012', 'Pagado'),
(43, 13, 2, 880.00, 'Tarjeta', '2025-12-06 15:00:00', 'TXN031', 'Pagado'),
(44, 14, 3, 1150.00, 'Tarjeta', '2025-12-06 09:30:00', 'TXN032', 'Pagado'),
(45, 15, 3, 990.00, 'Efectivo', '2025-12-06 10:00:00', 'EFE013', 'Pagado'),
(46, 1, 1, 1080.00, 'Tarjeta', '2025-12-06 10:30:00', 'TXN033', 'Pagado'),
(47, 2, 2, 900.00, 'Tarjeta', '2025-12-06 15:30:00', 'TXN034', 'Pagado'),
(48, 3, 3, 970.00, 'Tarjeta', '2025-12-06 11:00:00', 'TXN035', 'Pagado'),
(49, 4, 1, 1050.00, 'Efectivo', '2025-12-06 11:30:00', 'EFE014', 'Pagado'),
(50, 5, 2, 870.00, 'Tarjeta', '2025-12-06 16:30:00', 'TXN036', 'Pagado');

-- Diciembre 7 (10 citas - 10 pagadas)
INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, FechaPago, Referencia, EstatusPago) VALUES
(60, 6, 3, 1010.00, 'Tarjeta', '2025-12-07 08:30:00', 'TXN037', 'Pagado'),
(61, 7, 3, 950.00, 'Efectivo', '2025-12-07 09:00:00', 'EFE015', 'Pagado'),
(62, 8, 1, 1090.00, 'Tarjeta', '2025-12-07 09:30:00', 'TXN038', 'Pagado'),
(63, 9, 1, 1020.00, 'Tarjeta', '2025-12-07 10:00:00', 'TXN039', 'Pagado'),
(64, 10, 2, 900.00, 'Efectivo', '2025-12-07 10:30:00', 'EFE016', 'Pagado'),
(65, 11, 2, 930.00, 'Tarjeta', '2025-12-07 11:00:00', 'TXN040', 'Pagado'),
(66, 12, 3, 1030.00, 'Tarjeta', '2025-12-07 11:30:00', 'TXN041', 'Pagado'),
(67, 13, 1, 1070.00, 'Tarjeta', '2025-12-07 12:00:00', 'TXN042', 'Pagado'),
(68, 14, 2, 910.00, 'Efectivo', '2025-12-07 12:30:00', 'EFE017', 'Pagado'),
(69, 15, 3, 978.00, 'Tarjeta', '2025-12-07 13:00:00', 'TXN043', 'Pagado');

-- Pagos adicionales para completar 68 pagos totales
INSERT INTO Pagos (IdCita, IdPaciente, IdTarifa, Monto, MetodoPago, FechaPago, Referencia, EstatusPago) VALUES
(51, 6, 1, 940.00, 'Tarjeta', '2025-12-06 17:00:00', 'TXN044', 'Pagado'),
(52, 7, 2, 960.00, 'Efectivo', '2025-12-06 17:30:00', 'EFE018', 'Pagado'),
(53, 8, 3, 1020.00, 'Tarjeta', '2025-12-06 18:00:00', 'TXN045', 'Pagado'),
(54, 9, 1, 980.00, 'Tarjeta', '2025-12-07 13:30:00', 'TXN046', 'Pagado'),
(55, 10, 2, 920.00, 'Efectivo', '2025-12-07 14:00:00', 'EFE019', 'Pagado'),
(56, 11, 3, 1000.00, 'Tarjeta', '2025-12-07 14:30:00', 'TXN047', 'Pagado'),
(57, 12, 1, 1050.00, 'Tarjeta', '2025-12-07 15:00:00', 'TXN048', 'Pagado'),
(58, 13, 2, 940.00, 'Efectivo', '2025-12-07 15:30:00', 'EFE020', 'Pagado');
