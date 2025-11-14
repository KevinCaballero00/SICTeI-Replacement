-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2025 a las 17:15:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sictel_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formularios`
--

CREATE TABLE `formularios` (
  `id` int(11) UNSIGNED NOT NULL,
  `email_form` varchar(255) NOT NULL,
  `modalidad` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `name_form` varchar(255) NOT NULL,
  `ponente` varchar(255) NOT NULL,
  `documento` varchar(255) NOT NULL,
  `num_doc` varchar(25) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `niv_estu` varchar(255) NOT NULL,
  `programa` varchar(255) NOT NULL,
  `grupo_inv` varchar(255) NOT NULL,
  `institu` varchar(255) NOT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `archivo_pdf` varchar(255) DEFAULT NULL,
  `eval_status` varchar(20) DEFAULT 'Pendiente',
  `revisado` tinyint(1) DEFAULT 0,
  `evaluador_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formularios`
--

INSERT INTO `formularios` (`id`, `email_form`, `modalidad`, `estado`, `name_form`, `ponente`, `documento`, `num_doc`, `telefono`, `niv_estu`, `programa`, `grupo_inv`, `institu`, `ubicacion`, `archivo_pdf`, `eval_status`, `revisado`, `evaluador_id`) VALUES
(13, 'ponenteejemplo1@gmail.com', 'Modalidad oral presencial', 'Finalizado', 'Ponencia de ejemplo numero 1', 'Ponente ', 'CC=Cédula de Ciudadanía', '1004878277', '3124893234', 'Especialización', 'Ingenieria de Sistemas', 'Grupo SICTel', 'UFPS', 'Cúcuta', 'uploads/ponencia_691754f5106658.00374936.docx', 'Pendiente', 0, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrador','Ponente','Evaluador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `email`, `password`, `role`) VALUES
(18, 'SICTeI', '2026', 'SICTeI@ufps.edu.co', '$2y$10$RPNEEtXnZv5pj/QQllQb2utvhKqppp3UclSjtfAxLY8vJwh964Wd2', 'Administrador'),
(19, 'Ponente ', 'Ejemplo 1', 'ponenteejemplo1@gmail.com', '$2y$10$wWGOwZo6wkKC7rk2rYRYPOeTrhDssY0ll0zsIK6tGoY8pt6V17e9.', 'Ponente'),
(20, 'Evaluador', 'Ejemplo 1', 'evaluadorejemplo1@gmail.com', '$2y$10$DBAXgEjwvulgb3WnXiax0.sGS05PHfoZXRtLqcT.40ERxueIOQlB6', 'Evaluador'),
(21, 'Ponente ', 'Ejemplo 2', 'ponenteejemplo2@gmail.com', '$2y$10$5xAKbqGslPNCviqjgoHYMewG9muckYYsJb7/1D5nWjaP5xBPidUOq', 'Ponente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `formularios`
--
ALTER TABLE `formularios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluador_id` (`evaluador_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `formularios`
--
ALTER TABLE `formularios`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
