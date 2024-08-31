-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 04:34 AM
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
(32, 'COD001', 'Tarea 1', 'Descripción de la tarea 1', '2024-03-01', '2024-03-27', '2024-04-26', 'Responsable 1', 'Culminado', 1, 'adjunto1.pdf'),
(33, 'COD002', 'Tarea 2', 'Descripción de la tarea 2', '2024-06-23', '2024-07-20', '2024-07-26', 'Responsable 2', 'Revisado', 0, 'adjunto2.pdf'),
(34, 'COD003', 'Tarea 3', 'Descripción de la tarea 3', '2024-03-03', '2024-03-04', '2024-03-14', 'Responsable 3', 'En Curso', 0, 'adjunto3.pdf'),
(35, 'COD004', 'Tarea 4', 'Descripción de la tarea 4', '2023-09-17', '2023-10-06', '2023-10-07', 'Responsable 4', 'Culminado', 1, 'adjunto4.pdf'),
(36, 'COD005', 'Tarea 5', 'Descripción de la tarea 5', '2024-02-16', '2024-03-05', '2024-03-11', 'Responsable 5', 'Culminado', 0, 'adjunto5.pdf'),
(37, 'COD006', 'Tarea 6', 'Descripción de la tarea 6', '2024-02-16', '2024-03-14', '2024-04-04', 'Responsable 6', 'Revisado', 1, 'adjunto6.pdf'),
(38, 'COD007', 'Tarea 7', 'Descripción de la tarea 7', '2024-05-27', '2024-06-02', '2024-06-04', 'Responsable 7', 'Nuevo', 1, 'adjunto7.pdf'),
(39, 'COD008', 'Tarea 8', 'Descripción de la tarea 8', '2023-10-24', '2023-11-17', '2023-12-05', 'Responsable 8', 'Revisado', 0, 'adjunto8.pdf'),
(40, 'COD009', 'Tarea 9', 'Descripción de la tarea 9', '2024-08-25', '2024-08-28', '2024-08-31', 'Responsable 9', 'Culminado', 1, 'adjunto9.pdf'),
(41, 'COD010', 'Tarea 10', 'Descripción de la tarea 10', '2023-10-07', '2023-10-29', '2023-11-23', 'Responsable 10', 'Nuevo', 1, 'adjunto10.pdf'),
(42, 'COD011', 'Tarea 11', 'Descripción de la tarea 11', '2024-03-18', '2024-04-04', '2024-04-28', 'Responsable 11', 'Revisado', 0, 'adjunto11.pdf'),
(43, 'COD012', 'Tarea 12', 'Descripción de la tarea 12', '2024-02-04', '2024-02-09', '2024-02-10', 'Responsable 12', 'Nuevo', 1, 'adjunto12.pdf'),
(44, 'COD013', 'Tarea 13', 'Descripción de la tarea 13', '2024-08-22', '2024-09-21', '2024-10-06', 'Responsable 13', 'En Curso', 1, 'adjunto13.pdf'),
(45, 'COD014', 'Tarea 14', 'Descripción de la tarea 14', '2023-11-16', '2023-11-29', '2023-12-25', 'Responsable 14', 'Nuevo', 0, 'adjunto14.pdf'),
(46, 'COD015', 'Tarea 15', 'Descripción de la tarea 15', '2024-05-28', '2024-06-21', '2024-07-10', 'Responsable 15', 'Culminado', 0, 'adjunto15.pdf'),
(47, 'COD016', 'Tarea 16', 'Descripción de la tarea 16', '2024-07-30', '2024-08-17', '2024-08-29', 'Responsable 16', 'Revisado', 0, 'adjunto16.pdf'),
(48, 'COD017', 'Tarea 17', 'Descripción de la tarea 17', '2023-12-16', '2024-01-11', '2024-01-12', 'Responsable 17', 'Revisado', 0, 'adjunto17.pdf'),
(49, 'COD018', 'Tarea 18', 'Descripción de la tarea 18', '2024-03-30', '2024-04-15', '2024-05-11', 'Responsable 18', 'Culminado', 0, 'adjunto18.pdf'),
(50, 'COD019', 'Tarea 19', 'Descripción de la tarea 19', '2024-04-04', '2024-04-21', '2024-05-14', 'Responsable 19', 'Culminado', 0, 'adjunto19.pdf'),
(51, 'COD020', 'Tarea 20', 'Descripción de la tarea 20', '2023-12-05', '2023-12-16', '2023-12-31', 'Responsable 20', 'Revisado', 1, 'adjunto20.pdf'),
(52, 'COD021', 'Tarea 21', 'Descripción de la tarea 21', '2024-05-31', '2024-06-27', '2024-07-10', 'Responsable 21', 'Culminado', 0, 'adjunto21.pdf'),
(53, 'COD022', 'Tarea 22', 'Descripción de la tarea 22', '2023-09-07', '2023-09-12', '2023-10-05', 'Responsable 22', 'Culminado', 1, 'adjunto22.pdf'),
(54, 'COD023', 'Tarea 23', 'Descripción de la tarea 23', '2024-01-30', '2024-02-29', '2024-03-04', 'Responsable 23', 'Nuevo', 0, 'adjunto23.pdf'),
(55, 'COD024', 'Tarea 24', 'Descripción de la tarea 24', '2023-12-31', '2024-01-12', '2024-01-27', 'Responsable 24', 'Nuevo', 1, 'adjunto24.pdf'),
(56, 'COD025', 'Tarea 25', 'Descripción de la tarea 25', '2024-06-29', '2024-07-04', '2024-07-19', 'Responsable 25', 'En Curso', 1, 'adjunto25.pdf'),
(57, 'COD026', 'Tarea 26', 'Descripción de la tarea 26', '2024-03-15', '2024-04-03', '2024-04-24', 'Responsable 26', 'En Curso', 0, 'adjunto26.pdf'),
(58, 'COD027', 'Tarea 27', 'Descripción de la tarea 27', '2024-03-04', '2024-03-25', '2024-04-13', 'Responsable 27', 'Culminado', 1, 'adjunto27.pdf'),
(59, 'COD028', 'Tarea 28', 'Descripción de la tarea 28', '2023-12-09', '2023-12-27', '2024-01-24', 'Responsable 28', 'Revisado', 0, 'adjunto28.pdf'),
(60, 'COD029', 'Tarea 29', 'Descripción de la tarea 29', '2024-02-25', '2024-03-07', '2024-03-15', 'Responsable 29', 'En Curso', 0, 'adjunto29.pdf'),
(61, 'COD030', 'Tarea 30', 'Descripción de la tarea 30', '2024-02-20', '2024-03-17', '2024-04-05', 'Responsable 30', 'Nuevo', 1, 'adjunto30.pdf'),
(62, 'COD031', 'Tarea 31', 'Descripción de la tarea 31', '2023-11-07', '2023-11-24', '2023-12-11', 'Responsable 31', 'En Curso', 0, 'adjunto31.pdf'),
(63, 'COD032', 'Tarea 32', 'Descripción de la tarea 32', '2024-08-15', '2024-09-12', '2024-10-04', 'Responsable 32', 'Nuevo', 1, 'adjunto32.pdf'),
(64, 'COD033', 'Tarea 33', 'Descripción de la tarea 33', '2024-07-31', '2024-08-22', '2024-08-30', 'Responsable 33', 'Revisado', 1, 'adjunto33.pdf'),
(65, 'COD034', 'Tarea 34', 'Descripción de la tarea 34', '2023-09-09', '2023-09-29', '2023-10-01', 'Responsable 34', 'Nuevo', 1, 'adjunto34.pdf'),
(66, 'COD035', 'Tarea 35', 'Descripción de la tarea 35', '2024-08-11', '2024-08-15', '2024-08-25', 'Responsable 35', 'Nuevo', 1, 'adjunto35.pdf'),
(67, 'COD036', 'Tarea 36', 'Descripción de la tarea 36', '2024-07-24', '2024-08-03', '2024-08-15', 'Responsable 36', 'En Curso', 1, 'adjunto36.pdf'),
(68, 'COD037', 'Tarea 37', 'Descripción de la tarea 37', '2024-05-20', '2024-06-19', '2024-07-09', 'Responsable 37', 'En Curso', 1, 'adjunto37.pdf'),
(69, 'COD038', 'Tarea 38', 'Descripción de la tarea 38', '2023-12-11', '2024-01-10', '2024-01-30', 'Responsable 38', 'Revisado', 0, 'adjunto38.pdf'),
(70, 'COD039', 'Tarea 39', 'Descripción de la tarea 39', '2024-07-23', '2024-08-11', '2024-08-14', 'Responsable 39', 'Nuevo', 1, 'adjunto39.pdf'),
(71, 'COD040', 'Tarea 40', 'Descripción de la tarea 40', '2024-01-02', '2024-01-26', '2024-02-06', 'Responsable 40', 'Revisado', 0, 'adjunto40.pdf'),
(72, 'COD041', 'Tarea 41', 'Descripción de la tarea 41', '2023-12-30', '2024-01-03', '2024-01-08', 'Responsable 41', 'Culminado', 1, 'adjunto41.pdf'),
(73, 'COD042', 'Tarea 42', 'Descripción de la tarea 42', '2024-06-26', '2024-07-19', '2024-08-18', 'Responsable 42', 'Revisado', 0, 'adjunto42.pdf'),
(74, 'COD043', 'Tarea 43', 'Descripción de la tarea 43', '2024-02-26', '2024-03-13', '2024-04-07', 'Responsable 43', 'Nuevo', 0, 'adjunto43.pdf'),
(75, 'COD044', 'Tarea 44', 'Descripción de la tarea 44', '2023-11-24', '2023-12-08', '2023-12-19', 'Responsable 44', 'Culminado', 0, 'adjunto44.pdf'),
(76, 'COD045', 'Tarea 45', 'Descripción de la tarea 45', '2023-10-18', '2023-11-10', '2023-11-18', 'Responsable 45', 'Revisado', 0, 'adjunto45.pdf'),
(77, 'COD046', 'Tarea 46', 'Descripción de la tarea 46', '2023-09-03', '2023-09-22', '2023-09-29', 'Responsable 46', 'Culminado', 0, 'adjunto46.pdf'),
(78, 'COD047', 'Tarea 47', 'Descripción de la tarea 47', '2023-12-16', '2023-12-18', '2024-01-11', 'Responsable 47', 'Nuevo', 0, 'adjunto47.pdf'),
(79, 'COD048', 'Tarea 48', 'Descripción de la tarea 48', '2023-09-17', '2023-10-07', '2023-10-23', 'Responsable 48', 'Nuevo', 1, 'adjunto48.pdf'),
(80, 'COD049', 'Tarea 49', 'Descripción de la tarea 49', '2023-10-18', '2023-11-01', '2023-11-19', 'Responsable 49', 'Culminado', 1, 'adjunto49.pdf'),
(81, 'COD050', 'Tarea 50', 'Descripción de la tarea 50', '2024-04-02', '2024-04-21', '2024-04-27', 'Responsable 50', 'En Curso', 0, 'adjunto50.pdf'),
(82, '345345', 'una nueva tarea', 'npsoertjvosdgifvwertbgfd', '2024-08-30', '2024-08-31', '2024-09-04', 'josue', 'Nuevo', 0, ''),
(83, 'TASK-11111', 'TEST', 'TESTEO PSSS', '2024-08-30', '2024-08-31', '2024-09-01', 'josue', 'Nuevo', 0, '66d2805e34861-20240831043054.jpg');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
