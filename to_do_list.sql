-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 29 Eki 2024, 09:58:58
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `to_do_list`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `todo`
--

CREATE TABLE `todo` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Waiting',
  `title` varchar(500) NOT NULL,
  `detail` varchar(1000) NOT NULL,
  `solution` varchar(500) NOT NULL,
  `deadline` date NOT NULL,
  `create_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `todo`
--

INSERT INTO `todo` (`id`, `category`, `status`, `title`, `detail`, `solution`, `deadline`, `create_time`) VALUES
(6, 'project', 'Waiting', 'Sayısal Tasarım Ödevi', 'Sayısal Tasarım Ödevini A4 e geçir', '', '2024-10-30', '2024-10-29 00:04:42'),
(7, 'project', 'Waiting', 'Github Doldur', 'Github\'a Projeleri Çalışır hale getirip hepsini koy', '', '2024-10-29', '2024-10-29 11:50:18');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `todo`
--
ALTER TABLE `todo`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `todo`
--
ALTER TABLE `todo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
