-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2023 a las 01:23:18
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mabersa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`c_id`, `t_id`, `course_name`, `course_description`, `video`, `image`, `timestamp`, `approved`) VALUES
(1, 1, 'manga', 'vida a tus historia', 'uploads/645b8db60b8cd.mp4', '', '2023-05-10 12:27:34', 1),
(8, 1, 'creacion de comics', 'vida a tus historia', 'uploads/645b8db60b8cd.mp4', '', '2023-05-10 12:27:34', 1),
(9, 1, 'creacion de comics', 'vida a tus historia', 'uploads/645b8db60b8cd.mp4', '', '2023-05-10 12:27:34', 1),
(28, 1, 'creacion de comic', 'asddadsd', 'uploads/646520e501373.mp4', '', '2023-05-17 18:45:57', 0),
(29, 4, 'capibara', 'tweewrt', 'uploads/64657b6d2e483.mp4', 'uploads/64657b6d2eac0.jpg', '2023-05-18 01:12:13', 1),
(30, 3, 'sdfdfs', 'affsd', 'uploads/6472465fd6755.mp4', 'uploads/6472465fd69b9.png', '2023-05-27 18:05:19', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollment`
--

CREATE TABLE `enrollment` (
  `e_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lesiones`
--

CREATE TABLE `lesiones` (
  `l_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `lesion_name` varchar(255) NOT NULL,
  `lesion_description` text DEFAULT NULL,
  `video` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lesiones`
--

INSERT INTO `lesiones` (`l_id`, `t_id`, `lesion_name`, `lesion_description`, `video`) VALUES
(1, 3, 'comiensi', 'werewrewrw4eewrewrewrwerewrewrwe', 'uploads/647287f63621a.mp4'),
(2, 3, 'errwerewrwer', 'werwerwrwerwre', 'uploads/6472903abbe43.mp4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('teacher','student','admin') NOT NULL DEFAULT 'student',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`u_id`, `name`, `email`, `password`, `role`, `timestamp`) VALUES
(1, 'kron', 'kronbelet@gmail.com', 'd934340eb29cd2353af5826c8126c5ea', 'admin', '2023-05-10 12:26:42'),
(2, 'estudiante', 'estudiante@gmail.com', '202cb962ac59075b964b07152d234b70', 'student', '2023-05-10 16:38:58'),
(3, 'maestro', 'maestro@gmail.com', '202cb962ac59075b964b07152d234b70', 'teacher', '2023-05-10 16:40:48'),
(4, 'juan', 'camilohenaochp@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'admin', '2023-05-18 01:09:14'),
(5, 'ff', 'ff@ff.com', '4c56ff4ce4aaf9573aa5dff913df997a', 'student', '2023-05-18 01:15:24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`);

--
-- Indices de la tabla `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indices de la tabla `lesiones`
--
ALTER TABLE `lesiones`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `lesiones_ibfk_1` (`t_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lesiones`
--
ALTER TABLE `lesiones`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `courses` (`c_id`);

--
-- Filtros para la tabla `lesiones`
--
ALTER TABLE `lesiones`
  ADD CONSTRAINT `lesiones_ibfk_1` FOREIGN KEY (`t_id`) REFERENCES `users` (`u_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
