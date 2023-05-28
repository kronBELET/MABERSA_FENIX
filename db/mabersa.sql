-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-05-2023 a las 05:32:47
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`c_id`, `t_id`, `course_name`, `course_description`, `video`, `image`, `timestamp`, `approved`) VALUES
(1, 1, 'manga', 'vida a tus historia', 'uploads/645b8db60b8cd.mp4', 'uploads/646fe9d57e4eb.png', '2023-05-10 12:27:34', 1),
(8, 1, 'El café y sus variedades ', 'Conoce el fascinante mundo del café y sus derivados', 'uploads/64729ee5a568d.mp4', 'uploads/64729f3622a70.jpg', '2023-05-10 12:27:34', 1),
(9, 1, 'creacion de comics', 'Aprende de un experto ', 'uploads/6472a098d56bb.mp4', 'uploads/6472a0ad4278b.jpg', '2023-05-10 12:27:34', 1),
(29, 4, 'Principios de programación', 'Programación desde cero ', 'uploads/6472a0262ba84.mp4', 'uploads/6472a0262acc3.png', '2023-05-18 01:12:13', 1),
(30, 3, 'Creación de video juegos ', 'Crea tus propios videos', 'uploads/6472a206bd318.mp4', 'uploads/6468074371f45.png', '2023-05-19 23:33:23', 1),
(31, 4, 'Clases de conquista', 'Aprende a conquistar', 'uploads/646940706b025.mp4', 'uploads/646940706cc43.gif', '2023-05-20 21:49:36', 1),
(32, 4, 'Desarrollo web', 'Aprende a crear tu propio contenido web', 'uploads/6472a125b2cb2.mp4', 'uploads/646fe9b45966d.jpg', '2023-05-24 22:27:05', 1),
(33, 4, 'Cursos de cocina ', 'Aprende cocina con profesionales ', 'uploads/6472a337b0c05.mp4', 'uploads/6472a337b1006.jpg', '2023-05-28 00:41:27', 1),
(34, 4, 'Como estar en contacto con Dios', 'Aprende el como acercarte a dios e ir por el buen camino ', 'uploads/6472a3e518e38.mp4', 'uploads/6472a3e519189.jpg', '2023-05-28 00:44:21', 1),
(35, 4, 'Como mejorar tu auto estima ', 'consejos para sentirte mejor contigo mismo ', 'uploads/6472a65f4db34.mp4', 'uploads/6472a65f4de18.jpg', '2023-05-28 00:54:55', 1),
(36, 4, 'Aprende a tejer', 'todo lo que necesitas para iniciar en el maravilloso mundo del tejido ', 'uploads/6472aa6223c73.mp4', 'uploads/6472aa6224164.jpg', '2023-05-28 01:12:02', 1),
(37, 4, 'Cocina oriental ', 'aprende sobre la cocina oriental', 'uploads/6472ad782ee11.mp4', 'uploads/6472ad782f15a.jpg', '2023-05-28 01:25:12', 1),
(38, 4, 'Como lograr tus metas ', 'Un corto curso que te ayudara en tu vida personal ', 'uploads/6472b928d8eff.mp4', 'uploads/6472b928d928a.jpg', '2023-05-28 02:15:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enrollment`
--

CREATE TABLE `enrollment` (
  `e_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
