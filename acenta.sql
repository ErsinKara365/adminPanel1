-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Mar 2025, 18:24:45
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
-- Veritabanı: `acenta`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ekiplerimiz`
--

CREATE TABLE `ekiplerimiz` (
  `ekip_id` int(11) NOT NULL,
  `ekip_isim` varchar(115) DEFAULT NULL,
  `resim` varchar(150) DEFAULT NULL,
  `ekip_bolumu` varchar(150) DEFAULT NULL,
  `referans` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ekiplerimiz`
--

INSERT INTO `ekiplerimiz` (`ekip_id`, `ekip_isim`, `resim`, `ekip_bolumu`, `referans`) VALUES
(12, 'tugba güzel', 'R-67e0432ac1ed8.jpeg', NULL, 'Ersin Kara');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(10) NOT NULL,
  `hotel_isim` varchar(100) DEFAULT NULL,
  `hotel_aciklama` text DEFAULT NULL,
  `hotel_iletisim` varchar(15) DEFAULT NULL,
  `hotel_adres` varchar(250) DEFAULT NULL,
  `resim` varchar(150) DEFAULT NULL,
  `resimler` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_isim`, `hotel_aciklama`, `hotel_iletisim`, `hotel_adres`, `resim`, `resimler`) VALUES
(46, 'aaaaaaa', 'yenikapıda 5 yıldızlı hotel               ', '222222', 'İstanbul Yenikapı', 'R-67e02183b96a0.jpeg', '[\"R-67e02183b90b9.jpeg\",\"R-67e02183b92d1.jpeg\",\"R-67e02183b946b.jpeg\",\"R-67e02183b95c9.jpeg\"]');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `users_id` int(10) NOT NULL,
  `namesurname` varchar(100) DEFAULT NULL,
  `iletisim` varchar(100) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `users_pass` varchar(250) DEFAULT NULL,
  `resim` varchar(100) DEFAULT NULL,
  `users_sessions` varchar(255) DEFAULT NULL,
  `users_status` enum('askida','kullanici','admin') NOT NULL DEFAULT 'kullanici',
  `users_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`users_id`, `namesurname`, `iletisim`, `mail`, `users_pass`, `resim`, `users_sessions`, `users_status`, `users_login`) VALUES
(71, 'Ersin Kara', '212 647 97 99', 'ersinkara@gmail.com', '4297f44b13955235245b2497399d7a93', 'R-67def1ef452aa.gif', '92738208494348ca25953f93caafa058', 'admin', '2025-03-23 11:46:31'),
(104, 'leyla karaaaaa', '55555555', 'leyla@gmail.com', '794a8ba50374cb63af371c3b54a74579', 'R-67e02152ee2e8.jpg', NULL, 'kullanici', '2025-03-23 16:55:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `packets`
--

CREATE TABLE `packets` (
  `packet_id` int(15) NOT NULL,
  `packet_isim` varchar(150) DEFAULT NULL,
  `packet_aciklama` varchar(250) DEFAULT NULL,
  `resim` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `packets`
--

INSERT INTO `packets` (`packet_id`, `packet_isim`, `packet_aciklama`, `resim`) VALUES
(10, 'paket 12', 'paket 12 ', 'R-67e03dba778c4.jpeg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ekiplerimiz`
--
ALTER TABLE `ekiplerimiz`
  ADD PRIMARY KEY (`ekip_id`);

--
-- Tablo için indeksler `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`users_id`);

--
-- Tablo için indeksler `packets`
--
ALTER TABLE `packets`
  ADD PRIMARY KEY (`packet_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ekiplerimiz`
--
ALTER TABLE `ekiplerimiz`
  MODIFY `ekip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `users_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Tablo için AUTO_INCREMENT değeri `packets`
--
ALTER TABLE `packets`
  MODIFY `packet_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
