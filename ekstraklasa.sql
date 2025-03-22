-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Mar 2025, 16:49
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ekstraklasa`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `asystenci`
--

CREATE TABLE `asystenci` (
  `IDA` int(11) NOT NULL,
  `Imie_nazwisko` varchar(255) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `klub` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `asystenci`
--

INSERT INTO `asystenci` (`IDA`, `Imie_nazwisko`, `Ilosc`, `klub`) VALUES
(1, 'Kamil Grosicki', 8, 'Pogoń Szczecin'),
(2, 'Kristoffer Hansen', 8, 'Jagiellonia Białystok'),
(3, 'Erik Janza', 8, 'Górnik Zabrze'),
(4, 'Benjamin Kallman', 7, 'Cracovia'),
(5, 'Petr Schwarz', 6, 'Śląsk Wrocław'),
(6, 'Rafał Wolski', 6, 'Radomiak Radom'),
(7, 'Bartosz Wolski', 6, 'Motor Lublin'),
(8, 'Jan Grzesik', 5, 'Radomiak Radom'),
(9, 'Ivan Lopez', 5, 'Raków Częstochowa'),
(10, 'Bartosz Nowak', 5, 'GKS Katowice');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czerwone`
--

CREATE TABLE `czerwone` (
  `IDC` int(11) NOT NULL,
  `Imie_nazwisko` varchar(255) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `klub` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `czerwone`
--

INSERT INTO `czerwone` (`IDC`, `Imie_nazwisko`, `Ilosc`, `klub`) VALUES
(1, 'Rafał Janicki', 2, 'Górnik Zabrze'),
(2, 'Michał Nalepa', 2, 'Zagłębie Lubin'),
(3, 'Piotr Wlazło', 2, 'Stal Mielec'),
(4, 'Fran Alvarez', 1, 'Widzew Łódź'),
(5, 'Gustav Berggren', 1, 'Raków Częstochowa'),
(6, 'Conrado', 1, 'Lechia Gdańsk'),
(7, 'Artur Craciun', 1, 'Puszcza'),
(8, 'Jakub Czerwiński', 1, 'Piast Gliwice'),
(9, 'Adrian Dieguez', 1, 'Jagiellonia Białystok'),
(10, 'Alex Douglas', 1, 'Lech Poznań');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kluby`
--

CREATE TABLE `kluby` (
  `IDK` int(11) NOT NULL,
  `Nazwa` varchar(255) NOT NULL,
  `Wygrane` int(11) NOT NULL,
  `Remisy` int(11) NOT NULL,
  `Przegrane` int(11) NOT NULL,
  `Bramki_zdobyte` int(11) NOT NULL,
  `Bramki_stracone` int(11) NOT NULL,
  `Bilans` int(11) NOT NULL,
  `Punkty` int(11) NOT NULL,
  `Winrate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `kluby`
--

INSERT INTO `kluby` (`IDK`, `Nazwa`, `Wygrane`, `Remisy`, `Przegrane`, `Bramki_zdobyte`, `Bramki_stracone`, `Bilans`, `Punkty`, `Winrate`) VALUES
(1, 'Raków Częstochowa', 15, 7, 3, 37, 16, 21, 52, 60),
(2, 'Jagiellonia Białystok', 15, 6, 4, 47, 30, 17, 51, 60),
(3, 'Lech Poznań', 16, 2, 7, 47, 21, 26, 50, 64),
(4, 'Pogoń Szczecin', 13, 4, 8, 41, 28, 13, 43, 52),
(5, 'Legia Warszawa', 11, 7, 7, 48, 35, 13, 40, 44),
(6, 'Górnik Zabrze', 12, 4, 9, 36, 29, 7, 40, 48),
(7, 'Cracovia', 10, 8, 7, 44, 39, 5, 38, 40),
(8, 'Motor Lublin', 10, 6, 9, 35, 44, -9, 36, 40),
(9, 'GKS Katowice', 9, 6, 10, 33, 31, 2, 33, 36),
(10, 'Piast Gliwice', 8, 9, 8, 26, 26, 0, 33, 32),
(11, 'Korona Kielce', 8, 9, 8, 24, 31, -7, 33, 32),
(12, 'Radomiak Radom', 9, 4, 12, 34, 39, -5, 31, 36),
(13, 'Widzew Łódź', 8, 6, 11, 28, 39, -11, 30, 32),
(14, 'Puszcza', 6, 7, 12, 24, 35, -11, 25, 24),
(15, 'Stal Mielec', 6, 5, 14, 26, 38, -12, 23, 24),
(16, 'Zagłębie Lubin', 6, 5, 14, 21, 38, -17, 23, 24),
(17, 'Lechia Gdańsk', 5, 6, 14, 26, 44, -18, 21, 20),
(18, 'Śląsk Wrocław', 3, 9, 13, 25, 39, -14, 18, 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `strzelcy`
--

CREATE TABLE `strzelcy` (
  `IDS` int(11) NOT NULL,
  `Imie_nazwisko` varchar(255) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `klub` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `strzelcy`
--

INSERT INTO `strzelcy` (`IDS`, `Imie_nazwisko`, `Ilosc`, `klub`) VALUES
(1, 'Efthymis Koulouris', 17, 'Pogoń Szczecin'),
(2, 'Jesus Imaz', 14, 'Jagiellonia Białystok'),
(3, 'Mikael Ishak', 14, 'Lech Poznań'),
(4, 'Benjamin Kallman', 14, 'Cracovia'),
(5, 'Samuel Mraz', 12, 'Motor Lublin'),
(6, 'Leonardo Rocha', 11, 'Raków Częstochowa'),
(7, 'Jonatan Braut Brunes', 9, 'Raków Częstochowa'),
(8, 'Adrian Dalmau', 9, 'Korona Kielce'),
(9, 'Bartosz Kapustka', 9, 'Legia Warszawa'),
(10, 'Imad Rondić', 9, 'Widzew Łódź');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zolte`
--

CREATE TABLE `zolte` (
  `IDZ` int(11) NOT NULL,
  `Imie_nazwisko` varchar(255) NOT NULL,
  `Ilosc` int(11) NOT NULL,
  `klub` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `zolte`
--

INSERT INTO `zolte` (`IDZ`, `Imie_nazwisko`, `Ilosc`, `klub`) VALUES
(1, 'Damian Dąbrowski', 9, 'Zagłębie Lubin'),
(2, 'Gustav Berggren', 8, 'Raków Częstochowa'),
(3, 'Christos Donis', 8, 'Radomiak Radom'),
(4, 'Radosław Murawski', 8, 'Lech Poznań'),
(5, 'Peter Pokorny', 8, 'Śląsk Wrocław'),
(6, 'Paulo Henrique', 8, 'Radomiak Radom'),
(7, 'Artur Craciun', 7, 'Puszcza'),
(8, 'Mariusz Fornalczyk', 7, 'Korona Kielce'),
(9, 'Otar Kakabadze', 7, 'Cracovia'),
(10, 'Bujar Pllana', 7, 'Lechia Gdańsk');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `asystenci`
--
ALTER TABLE `asystenci`
  ADD PRIMARY KEY (`IDA`);

--
-- Indeksy dla tabeli `czerwone`
--
ALTER TABLE `czerwone`
  ADD PRIMARY KEY (`IDC`);

--
-- Indeksy dla tabeli `kluby`
--
ALTER TABLE `kluby`
  ADD PRIMARY KEY (`IDK`);

--
-- Indeksy dla tabeli `strzelcy`
--
ALTER TABLE `strzelcy`
  ADD PRIMARY KEY (`IDS`);

--
-- Indeksy dla tabeli `zolte`
--
ALTER TABLE `zolte`
  ADD PRIMARY KEY (`IDZ`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `asystenci`
--
ALTER TABLE `asystenci`
  MODIFY `IDA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `czerwone`
--
ALTER TABLE `czerwone`
  MODIFY `IDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `kluby`
--
ALTER TABLE `kluby`
  MODIFY `IDK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `strzelcy`
--
ALTER TABLE `strzelcy`
  MODIFY `IDS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `zolte`
--
ALTER TABLE `zolte`
  MODIFY `IDZ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
