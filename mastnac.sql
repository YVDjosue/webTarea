-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2024 at 07:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mastnac`
--

-- --------------------------------------------------------

--
-- Table structure for table `colaborador`
--

CREATE TABLE `colaborador` (
  `id` int(11) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `dni` char(8) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `fecha_nac` date NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `colaborador`
--

INSERT INTO `colaborador` (`id`, `nombres`, `apellidos`, `dni`, `telefono`, `fecha_nac`, `direccion`, `estado`) VALUES
(1, 'JOSUE GEDEON', 'VALDEZ RAMIREZ', '44410888', '345346543', '1986-12-17', 'MI CASA 4325', 1),
(2, 'JUAN RAPHAEL', 'CARDENAS VALENZUELA', '23458978', '98734556', '1987-01-17', 'CUSCO POR AHÍ', 1),
(3, 'JUAN EDUARDO', 'CELIZ LOPEZ', '72727272', '999993434', '1985-09-14', '200 CASAS A-5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_de_registro` date NOT NULL,
  `fecha_culminacion` date NOT NULL,
  `fecha_finalizacion` date NOT NULL,
  `responsable` varchar(150) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `eliminado` tinyint(1) NOT NULL,
  `adjunto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `tareas`
--

INSERT INTO `tareas` (`id`, `codigo`, `nombre`, `descripcion`, `fecha_de_registro`, `fecha_culminacion`, `fecha_finalizacion`, `responsable`, `estado`, `eliminado`, `adjunto`) VALUES
(1, 'TASK-0001', 'ANALISIS DE REQUISITOS', 'ES LA ETAPA EN DONDE SE ENTREVISTA AL CLIENTE Y SE RECABA INFORMACION DE LSO REQUISITOS QUE SE PIDEN', '2024-08-14', '2024-08-31', '2024-09-02', 'JOSUE VALDEZ', 'EN ESPERA', 0, ''),
(2, 'TASK-0002', 'DISEÑO DE BASE DE DATOS', 'UNA VEZ RECABADO LOS REQUISITOS, LOS PROFESIONALES A CARGO DISEÑAN UNA BASE DE DATOS ACORDE A LO REQUERIDO', '2024-08-29', '2024-08-31', '2024-08-31', 'JUAN CARDENAS', 'EN ESPERA', 0, ''),
(3, 'TASK-0003', 'PLANIFICACIÓN DEL PROYECTO', 'Definir el alcance y los objetivos del proyecto.', '2024-08-01', '2024-08-05', '2024-08-06', 'Ana Pérez', 'COMPLETADO', 0, ''),
(4, 'TASK-0004', 'DISEÑO DE INTERFAZ', 'Crear los wireframes y el diseño visual de la aplicación.', '2024-08-02', '2024-08-10', '2024-08-11', 'Carlos López', 'EN PROGRESO', 0, ''),
(5, 'TASK-0005', 'DESARROLLO BACKEND', 'Implementar la lógica del servidor y la base de datos.', '2024-08-03', '2024-08-20', '2024-08-21', 'María García', 'EN PROGRESO', 0, ''),
(6, 'TASK-0006', 'PRUEBAS UNITARIAS', 'Escribir y ejecutar pruebas unitarias para el código.', '2024-08-04', '2024-08-15', '2024-08-16', 'Luis Martínez', 'EN ESPERA', 0, ''),
(7, 'TASK-0007', 'DOCUMENTACIÓN', 'Redactar la documentación del proyecto.', '2024-08-05', '2024-08-25', '2024-08-26', 'Laura Fernández', 'EN ESPERA', 0, ''),
(8, 'TASK-0008', 'REVISIÓN DE CÓDIGO', 'Revisar el código escrito por otros desarrolladores.', '2024-08-06', '2024-08-18', '2024-08-19', 'Jorge Sánchez', 'EN PROGRESO', 0, ''),
(9, 'TASK-0009', 'DEPURACIÓN', 'Identificar y corregir errores en el código.', '2024-08-07', '2024-08-22', '2024-08-23', 'Sofía Ramírez', 'EN ESPERA', 0, ''),
(10, 'TASK-0010', 'OPTIMIZACIÓN', 'Mejorar el rendimiento del sistema.', '2024-08-08', '2024-08-28', '2024-08-29', 'Miguel Torres', 'EN ESPERA', 0, ''),
(11, 'TASK-0011', 'IMPLEMENTACIÓN DE SEGURIDAD', 'Añadir medidas de seguridad al sistema.', '2024-08-09', '2024-08-30', '2024-08-31', 'Isabel Ruiz', 'EN PROGRESO', 0, ''),
(12, 'TASK-0012', 'PRUEBAS DE INTEGRACIÓN', 'Probar la integración de diferentes módulos del sistema.', '2024-08-10', '2024-09-01', '2024-09-02', 'Pedro Gómez', 'EN ESPERA', 0, ''),
(13, 'TASK-0013', 'DESPLIEGUE', 'Desplegar la aplicación en el entorno de producción.', '2024-08-11', '2024-09-03', '2024-09-04', 'Elena Díaz', 'EN ESPERA', 0, ''),
(14, 'TASK-0014', 'MANTENIMIENTO', 'Realizar mantenimiento preventivo y correctivo.', '2024-08-12', '2024-09-05', '2024-09-06', 'Raúl Hernández', 'EN ESPERA', 0, ''),
(15, 'TASK-0015', 'ACTUALIZACIONES', 'Implementar actualizaciones y mejoras.', '2024-08-13', '2024-09-07', '2024-09-08', 'Patricia Jiménez', 'EN ESPERA', 0, ''),
(16, 'TASK-0016', 'CAPACITACIÓN', 'Capacitar a los usuarios finales.', '2024-08-14', '2024-09-09', '2024-09-10', 'Fernando Moreno', 'EN ESPERA', 0, ''),
(17, 'TASK-0017', 'ANÁLISIS DE RIESGOS', 'Identificar y evaluar riesgos potenciales.', '2024-08-15', '2024-09-11', '2024-09-12', 'Gabriela Ortiz', 'EN ESPERA', 0, ''),
(18, 'TASK-0018', 'GESTIÓN DE CAMBIOS', 'Gestionar solicitudes de cambio en el proyecto.', '2024-08-16', '2024-09-13', '2024-09-14', 'Ricardo Castro', 'EN ESPERA', 0, ''),
(19, 'TASK-0019', 'CONTROL DE CALIDAD', 'Asegurar la calidad del producto final.', '2024-08-17', '2024-09-15', '2024-09-16', 'Marta Vega', 'EN ESPERA', 0, ''),
(20, 'TASK-0020', 'PRUEBAS DE USABILIDAD', 'Evaluar la usabilidad del sistema.', '2024-08-18', '2024-09-17', '2024-09-18', 'Alberto Navarro', 'EN ESPERA', 0, ''),
(21, 'TASK-0021', 'MONITORIZACIÓN', 'Monitorizar el rendimiento del sistema en producción.', '2024-08-19', '2024-09-19', '2024-09-20', 'Cristina Rojas', 'EN ESPERA', 0, ''),
(22, 'TASK-0022', 'ANÁLISIS DE DATOS', 'Analizar datos para obtener insights.', '2024-08-20', '2024-09-21', '2024-09-22', 'Daniela Molina', 'EN ESPERA', 0, ''),
(23, 'TASK-0023', 'GESTIÓN DE INCIDENTES', 'Gestionar y resolver incidentes reportados.', '2024-08-21', '2024-09-23', '2024-09-24', 'Andrés Gil', 'EN ESPERA', 0, ''),
(24, 'TASK-0024', 'PRUEBAS DE REGRESIÓN', 'Asegurar que nuevas actualizaciones no rompan funcionalidades existentes.', '2024-08-22', '2024-09-25', '2024-09-26', 'Natalia Peña', 'EN ESPERA', 0, ''),
(25, 'TASK-0025', 'AUDITORÍA', 'Realizar auditorías de seguridad y cumplimiento.', '2024-08-23', '2024-09-27', '2024-09-28', 'Hugo Castillo', 'EN ESPERA', 0, ''),
(26, 'TASK-0026', 'GESTIÓN DE CONFIGURACIÓN', 'Gestionar la configuración del sistema.', '2024-08-24', '2024-09-29', '2024-09-30', 'Sara Delgado', 'EN ESPERA', 0, ''),
(27, 'TASK-0027', 'PRUEBAS DE CARGA', 'Evaluar el rendimiento bajo carga del sistema.', '2024-08-25', '2024-10-01', '2024-10-02', 'Javier Romero', 'EN ESPERA', 0, ''),
(28, 'TASK-0028', 'PRUEBAS DE STRESS', 'Evaluar el comportamiento del sistema bajo condiciones extremas.', '2024-08-26', '2024-10-03', '2024-10-04', 'Claudia Vargas', 'EN ESPERA', 0, ''),
(29, 'TASK-0029', 'PRUEBAS DE SEGURIDAD', 'Evaluar la seguridad del sistema.', '2024-08-27', '2024-10-05', '2024-10-06', 'Francisco Méndez', 'EN ESPERA', 0, ''),
(30, 'TASK-0030', 'PRUEBAS DE COMPATIBILIDAD', 'Asegurar la compatibilidad con diferentes plataformas.', '2024-08-28', '2024-10-07', '2024-10-08', 'Rosa Guerrero', 'EN ESPERA', 0, ''),
(31, 'TASK-0031', 'PRUEBAS DE ACEPTACIÓN', 'Validar que el sistema cumple con los requisitos del cliente.', '2024-08-29', '2024-10-09', '2024-10-10', 'Manuel Soto', 'EN ESPERA', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `colaborador_id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `colaborador_id`, `usuario`, `contrasenia`, `estado`) VALUES
(1, 0, 'josue', '1234', 1),
(2, 0, 'rafa', '2222', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
