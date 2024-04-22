-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2024. Már 08. 08:54
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `auto`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `jarmuvek`
--

CREATE TABLE `jarmuvek` (
  `id` int(10) UNSIGNED NOT NULL,
  `marka` varchar(100) NOT NULL,
  `modell` varchar(100) NOT NULL,
  `motor` varchar(100) NOT NULL,
  `uzemanyag` varchar(100) NOT NULL,
  `km` int(100) NOT NULL,
  `kaukcio` int(100) NOT NULL,
  `berletidij` int(100) NOT NULL,
  `szszam` int(100) NOT NULL,
  `fogyasztas` int(100) NOT NULL,
  `foglalas` int(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `jarmuvek`
--

INSERT INTO `jarmuvek` (`id`, `marka`, `modell`, `motor`, `uzemanyag`, `km`, `kaukcio`, `berletidij`, `szszam`, `fogyasztas`, `foglalas`) VALUES
(2, 'Audi', 'A4', '2.0 PDTDI', 'Dízel', 230354, 80000, 15000, 5, 7, 1),
(3, 'Audi', 'A6', '3.0 v6 TDI quattro', 'Dízel', 220432, 100000, 17000, 5, 9, 1),
(5, 'BMW', '520D', '2.0', 'Dízel', 290431, 70000, 13000, 5, 7, 1),
(6, 'BMW', '530D', '3.0', 'Dízel', 230223, 80000, 15000, 5, 8, 1),
(7, 'BMW', '318D', '1.8', 'Dízel', 430201, 70000, 13000, 5, 9, 1),
(9, 'Dacia', 'Duster', '1.5', 'Benzin', 180340, 80000, 15000, 5, 6, 1),
(10, 'MERCEDES-AMG', 'Cla180', '1.6', 'Benzin', 86543, 200000, 30000, 5, 9, 1),
(13, 'MERCEDES-BENZ', 'ML 500', '5.0', 'Benzin', 310321, 100000, 18000, 5, 10, 1),
(14, 'Volkswagen', 'Passat B5', '1.9', 'Dízel', 280432, 80000, 15000, 5, 6, 1),
(15, 'Volkswagen', 'Golf 7 R', '2.0', 'Dízel', 266341, 70000, 18000, 5, 10, 1),
(16, 'Volkswagen', 'Passat B7', '2.0 PDTDI', 'Dízel', 176976, 130000, 18000, 5, 9, 1),
(17, 'Volkswagen', 'Arteon', '2.0', 'Dízel', 167035, 150000, 20000, 5, 8, 0),
(18, 'Opel', 'Mokka', '1.6', 'Dízel', 300000, 30000, 10000, 5, 8, 0),
(19, 'Opel', 'Astra H', '1.6', 'Benzin', 280321, 60000, 12000, 5, 7, 0),
(20, 'Opel', 'Astra Caravan', '1.8', 'Benzin', 230322, 50000, 13000, 5, 8, 0),
(21, 'Ford', 'Focus', '1.8', 'Benzin', 380341, 80000, 15000, 5, 8, 0),
(22, 'Subaru', 'Impreza', '2.5', 'Benzin', 230454, 200000, 30000, 5, 12, 0),
(23, 'Seat', 'Ibiza', '1.6', 'Dízel', 190201, 70000, 16000, 5, 7, 0),
(24, 'Seat', 'Leon', '1.8', 'Benzin', 210202, 80000, 15000, 5, 7, 0),
(25, 'Mazda', '3', '1.6', 'Dízel', 140300, 30000, 10000, 5, 6, 0),
(26, 'Alfa Romeo', '159', '1.8', 'Benzin', 201312, 50000, 14000, 5, 8, 1),
(27, 'Audi', 'A7', '3.0 V6', 'Dízel', 153200, 130000, 25000, 5, 13, 0),
(28, 'Maserati', 'C8', '4.7', 'Benzin', 97654, 250000, 40000, 4, 15, 1),
(29, 'Aston Martin', 'cygnet', '1.0', 'Benzin', 54003, 20000, 5000, 4, 5, 0),
(30, 'Skoda ', 'Octavia RS', '1.8 TFSI', 'Dízel', 143020, 100000, 20000, 5, 11, 0),
(31, 'Volkswagen', 'E-Golf', 'Elektromos', 'Elektromos', 130302, 100000, 18000, 5, 0, 0),
(33, 'Honda', 'Civic', '1.5 T', 'Benzin', 180400, 70000, 15000, 5, 8, 0),
(34, 'Toyota ', 'Avensis', '1.8', 'Benzin', 230220, 60000, 15000, 5, 8, 0),
(35, 'Ford', 'Ranger', '2.2', 'Dízel', 250322, 80000, 17000, 5, 9, 0),
(36, 'Ford', 'Smax', '2.0 TDCI', 'Dízel', 220210, 65000, 15000, 7, 8, 0),
(37, 'Volkswagen', 'Sharan', '1.9 PDTDI', 'Dízel', 310454, 65000, 15000, 7, 7, 0),
(38, 'Volkswagen', 'Transporter', '2.5 TDI', 'Dízel', 274543, 50000, 14000, 9, 9, 0),
(39, 'Iveco', 'Daily', '3.0 HPI', 'Dízel', 375430, 60000, 15000, 3, 10, 1),
(40, 'Seat', 'cargo', '1.6crtdi', 'Dízel', 83200, 50000, 17000, 5, 8, 0),
(41, 'Honda', 'Civic coupe', '1.6i', 'Dízel', 1965430, 20000, 8000, 5, 7, 0),
(42, 'Iveco', 'Daily kisteherautó', '2.5tdi', 'Dízel', 296430, 30000, 13000, 3, 11, 0),
(43, 'Alfa Romeo', 'Giulia Veloce Ti', '2.0 TFSI', 'Benzin', 120210, 50000, 15000, 4, 9, 0),
(44, 'Opel', 'zafira', '1.9 pdtdi', 'Dízel', 195303, 30000, 10000, 7, 8, 0),
(45, 'BMW', 'xDrive40', 'Elektromos', 'Elektromos', 56300, 70000, 20000, 5, 0, 0),
(46, 'MERCEDES-BENZ', 'Sprinter', '2.7 CDI', 'Dízel', 72000, 60000, 18000, 3, 10, 0),
(47, 'Dacia', 'sandero', '1.2', 'Benzin', 130202, 30000, 8000, 5, 8, 0),
(48, 'MERCEDES-AMG', 's400D', '3.0', 'Dízel', 185430, 100000, 23000, 5, 9, 0),
(49, 'Toyota', 'rav4', '2.0 pdtdi', 'Dízel', 210302, 50000, 15000, 5, 8, 0),
(50, 'Skoda', 'octavia', '1.9tdi', 'Dízel', 265300, 30000, 10000, 5, 6, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sziszam` varchar(30) NOT NULL,
  `lakcim` varchar(100) NOT NULL,
  `jogossz` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `sziszam`, `lakcim`, `jogossz`) VALUES
(1, '1', '$2y$10$g7AGkHf96tyeeOlTqJRqq.dICialLE24dWofjZ/GBWhQd2hShQQk2', '1@mail.com', '1', '1', '1'),
(2, '2', '$2y$10$mqV7yB8RlA0cjfiEaHTm7eHLsMc87SigWYE3ENh44X2DYvZozSbNW', '2@gmail.com', '2', '2', '2'),
(3, '2', '$2y$10$fZgytTa4UFyxEI/AIfXR1ehCrgBfajcLybGPgvZbT3rzy.b8fxdKW', '2@gmail.com', '2', '2', '2'),
(4, '3', '$2y$10$eXBwKbmIMbEk1oFrZ4bDJOIIZug3qmwsEpb2IDqeToCsDvpK3y4Ui', '3@gmail.com', '3', '3', '3'),
(5, '4', '$2y$10$OHOQtnh3tGcqyNMOBjXklecIXy4dSnjbgimGusQxiZouQSr899gKq', '4@gmail.com', '4', '4', '4'),
(6, '5', '$2y$10$6tfLOzLV2alJLsNQ5dvrXOvfY.nw3zL4OWcZhsnDcfU.asM78LjZS', '5@gmail.com', '5', '5', '5'),
(7, '6', '$2y$10$0vGF8E8VaWTtweLb6lyBtOUWBLpLPF94khkWPhf6XsyfG6Bj2c0UG', '6@gmail.com', '6', '6', '6'),
(8, 'JANCSI', '$2y$10$7LsFFhQB3ceiSblXstBgd.gV6yhGB43JYU/DnxmyU4RB..mniYkHC', 'losonczika@gmail.com', 'ke4414', 'IGEN', '555555'),
(9, 'NEM', '$2y$10$cmPQ6WQll7bTb3J/32EDb.pzpLKJf.44s76t7YT1EIn3DIwVxD3ie', 'skadkgdakgd@gmail.com', '20', '02', '402');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `jarmuvek`
--
ALTER TABLE `jarmuvek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `jarmuvek`
--
ALTER TABLE `jarmuvek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
