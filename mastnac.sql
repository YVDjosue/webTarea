-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 06:45 PM
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
  `adjunto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `tareas`
--

INSERT INTO `tareas` (`id`, `codigo`, `nombre`, `descripcion`, `fecha_de_registro`, `fecha_culminacion`, `fecha_finalizacion`, `responsable`, `estado`, `eliminado`, `adjunto`) VALUES
(358, 'COD023', 'Tarea 23', 'Descripción de la tarea 23', '2024-08-17', '2024-09-15', '2024-09-27', 'JOSUE GEDEON VALDEZ RAMIREZ', 'Nuevo', 1, ''),
(359, 'COD024', 'Tarea 24', 'Descripción de la tarea 24', '2024-04-18', '2024-05-16', '2024-05-18', 'JUAN EDUARDO CELIZ LOPEZ', 'Revisado', 0, ''),
(360, 'COD025', 'Tarea 25', 'Descripción de la tarea 25', '2024-09-03', '2024-09-09', '2024-09-27', 'JUAN RAPHAEL CARDENAS VALENZUELA', 'Revisado', 1, ''),
(361, 'COD026', 'Tarea 26', 'Descripción de la tarea 26', '2024-02-20', '2024-03-15', '2024-03-24', 'JUAN EDUARDO CELIZ LOPEZ', 'Nuevo', 0, ''),
(362, 'COD027', 'Tarea 27', 'Descripción de la tarea 27', '2024-08-16', '2024-08-26', '2024-08-27', 'JUAN EDUARDO CELIZ LOPEZ', 'Culminado', 1, ''),
(363, 'COD028', 'Tarea 28', 'Descripción de la tarea 28', '2024-02-22', '2024-03-22', '2024-04-09', 'JUAN EDUARDO CELIZ LOPEZ', 'Revisado', 0, ''),
(364, 'COD029', 'Tarea 29', 'Descripción de la tarea 29', '2023-09-13', '2023-09-14', '2023-10-04', 'JOSUE GEDEON VALDEZ RAMIREZ', 'En Curso', 0, ''),
(365, 'COD030', 'Tarea 30', 'Descripción de la tarea 30', '2023-09-18', '2023-10-07', '2023-11-03', 'JUAN RAPHAEL CARDENAS VALENZUELA', 'Nuevo', 1, ''),
(366, 'COD031', 'Tarea 31', 'Descripción de la tarea 31', '2024-08-23', '2024-09-21', '2024-09-28', 'JUAN EDUARDO CELIZ LOPEZ', 'Nuevo', 0, ''),
(367, 'COD032', 'Tarea 32', 'Descripción de la tarea 32', '2024-01-07', '2024-02-05', '2024-02-12', 'JOSUE GEDEON VALDEZ RAMIREZ', 'En Curso', 1, ''),
(368, 'COD033', 'Tarea 33', 'Descripción de la tarea 33', '2024-06-30', '2024-07-10', '2024-07-15', 'JOSUE GEDEON VALDEZ RAMIREZ', 'Culminado', 0, ''),
(369, 'COD034', 'Tarea 34', 'Descripción de la tarea 34', '2024-02-28', '2024-03-16', '2024-04-07', 'JUAN EDUARDO CELIZ LOPEZ', 'Culminado', 0, ''),
(370, 'COD035', 'Tarea 35', 'Descripción de la tarea 35', '2023-12-14', '2024-01-08', '2024-01-30', 'JUAN EDUARDO CELIZ LOPEZ', 'Revisado', 0, ''),
(371, 'COD036', 'Tarea 36', 'Descripción de la tarea 36', '2024-01-24', '2024-02-09', '2024-02-14', 'JUAN RAPHAEL CARDENAS VALENZUELA', 'Culminado', 0, ''),
(372, 'COD037', 'Tarea 37', 'Descripción de la tarea 37', '2023-12-04', '2023-12-21', '2024-01-10', 'JUAN EDUARDO CELIZ LOPEZ', 'Nuevo', 0, ''),
(373, 'COD038', 'Tarea 38', 'Descripción de la tarea 38', '2024-04-21', '2024-05-09', '2024-05-28', 'JUAN EDUARDO CELIZ LOPEZ', 'En Curso', 0, ''),
(374, 'COD039', 'Tarea 39', 'Descripción de la tarea 39', '2024-07-28', '2024-07-30', '2024-08-01', 'JOSUE GEDEON VALDEZ RAMIREZ', 'En Curso', 0, ''),
(375, 'COD040', 'Tarea 40', 'Descripción de la tarea 40', '2024-02-28', '2024-03-28', '2024-04-21', 'JUAN RAPHAEL CARDENAS VALENZUELA', 'Culminado', 0, ''),
(376, 'COD041', 'Tarea 41', 'Descripción de la tarea 41', '2023-10-19', '2023-11-02', '2023-11-23', 'JUAN EDUARDO CELIZ LOPEZ', 'Culminado', 1, ''),
(377, 'COD042', 'Tarea 42', 'Descripción de la tarea 42', '2024-05-23', '2024-05-28', '2024-06-22', 'JOSUE GEDEON VALDEZ RAMIREZ', 'Nuevo', 1, ''),
(378, 'COD043', 'Tarea 43', 'Descripción de la tarea 43', '2024-03-11', '2024-03-14', '2024-04-08', 'JOSUE GEDEON VALDEZ RAMIREZ', 'Culminado', 1, ''),
(379, 'COD044', 'Tarea 44', 'Descripción de la tarea 44', '2023-09-15', '2023-09-25', '2023-10-18', 'JOSUE GEDEON VALDEZ RAMIREZ', 'En Curso', 1, ''),
(380, 'COD045', 'Tarea 45', 'Descripción de la tarea 45', '2023-12-26', '2024-01-20', '2024-02-11', 'JUAN RAPHAEL CARDENAS VALENZUELA', 'Revisado', 1, ''),
(381, 'COD046', 'Tarea 46', 'Descripción de la tarea 46', '2024-03-27', '2024-04-09', '2024-04-25', 'JOSUE GEDEON VALDEZ RAMIREZ', 'En Curso', 1, ''),
(382, 'COD047', 'Tarea 47', 'Descripción de la tarea 47', '2024-05-04', '2024-05-22', '2024-06-19', 'JUAN RAPHAEL CARDENAS VALENZUELA', 'En Curso', 0, ''),
(383, 'COD048', 'Tarea 48', 'Descripción de la tarea 48', '2024-09-03', '2024-09-15', '2024-09-17', 'JUAN EDUARDO CELIZ LOPEZ', 'Nuevo', 0, ''),
(384, 'COD049', 'Tarea 49', 'Descripción de la tarea 49', '2024-06-24', '2024-07-08', '2024-07-21', 'JUAN RAPHAEL CARDENAS VALENZUELA', 'Nuevo', 0, ''),
(385, 'COD050', 'Tarea 50', 'Descripción de la tarea 50', '2024-03-28', '2024-03-30', '2024-04-01', 'JOSUE GEDEON VALDEZ RAMIREZ', 'Revisado', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasenia`, `estado`) VALUES
(3, 'josue', '$2y$10$YZByy924HN7oOlr2Udu/huTVSQzHJrEX1njwAwZs.BXZzD6Vmvd.6', 1),
(4, 'abab', '$2y$10$q2oUDjS5Qc/EBcHGINx4lu/FfSwxDc5uSNzhRMb6T/WTfv99pEOHe', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
