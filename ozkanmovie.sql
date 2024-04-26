-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 26 Nis 2024, 22:20:11
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
-- Veritabanı: `ozkanmovie`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `self_link` varchar(599) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `self_link`) VALUES
(12, 'Macera', 'Macera, baştan geçen ilginç olay veya olaylar zinciri, serüven, sergüzeşt, avantür. Tehlikeli iş, risk, spekülasyon gibi anlamlara da gelebilir. Mecazi olarak da \"olmayacakmış gibi görünen iş\" anlamında kullanılmaktadır.', 'macera'),
(13, 'Aksiyon', 'Birçok alt türü bulunur; dövüş sanatları aksiyon, doğa sporları aksiyonu, araba kovalamaları, gerilim aksiyonu ve aksiyon komedisi.\r\n', 'aksiyon'),
(15, 'Drama', 'Drama, lider ve katılımcıların atölye ortamında rol oynama, doğaçlama gibi tiyatro tekniklerini kullanarak bir olayı, anıyı, kavramı, konuyu, düşünceyi canlandırması olarak ifade edilebilir.', 'drama'),
(16, 'Korku', 'Korku filmlerinin konusunu gündelik hayata sızan ve bazen doğaüstü şekillerde ortaya çıkan şeytani güçler, olaylar ya da karakterler oluşturur. Korku filmi karakterleri vampirler, zombiler, canavarlar, hayaletler, psikopatlar, seri katiller ya da korku uyandıran başka bir dizi karakteri içerir.', 'korku'),
(18, 'Gerilim', 'Gerilim filmi izleyicilerde heyecan ve gerilim uyandıran geniş bir film türüdür. Çoğu filmin olay örgüsünde bulunan gerilim öğesi, bu türde film yapımcısı tarafından özellikle kullanılır.', 'gerilim');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `self_link` varchar(599) NOT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `background_url` varchar(599) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `category_id`, `release_date`, `self_link`, `banner_url`, `background_url`) VALUES
(22, 'Red Eye', 'Özet. Miami\'ye yaptığı uçak yolculuğu Lisa Reisert\'ın hayatının en zor gecesi olacaktır. Uçakta yanında oturan Jackson bir suikastçıdır ve ondan işbirlikçisi olmasını ister. Üstelik kabul etmezse, babasını öldürtecektir.', 12, '2005-09-09', 'red-eye', 'images/movieBanner/images (1).jpg', 'images/redeye-bg.jpg'),
(24, 'Peaky Blinders', '1919 yılında İngiltere, Birmingham\'daki bir suç çetesinin başında ne pahasına olursa olsun yükselmeyi kafasına koymuş, acımasız mafya babası Tommy Shelby vardır. Binlerce seçenek, sınırsız eğlence. En İyi Drama Dizisi BAFTA ödülü, En İyi Aktör (Cillian Murphy) ve En İyi Yardımcı Aktris (Charlie Murphy) IFTA ödülleri.', 12, '2005-12-12', 'peaky-blinders', 'images/movieBanner/1714056685_images.jpg', 'images/movieBackground/1714056685_peakyblinders.jpg'),
(25, 'Dabbe 6', 'Kriminal ve adli raporlara göre anneleri Mukadder beyin kanamasıyla ölmüştür fakat annesi öldüğünde onun yanında olan Ayla, bu durumu kabul etmemektedir. Ona göre annesi, ne olduğunu anlayamadığı çok hızlı hareket eden, kapkara yüzleri olan, bilinmeyen bir dilde konuşan, devasa kara varlıklar tarafından öldürülmüştür.', 16, '2015-03-02', 'dabbe-6', 'images/movieBanner/1714057142_187127.jpg', 'images/movieBackground/1714057142_maxresdefault.jpg'),
(26, 'The Walking Dead', 'The Walking Dead, aynı adlı çizgi roman serisine dayanmaktadır. Roman, dünya çapında beklenmedik bir biçimde ortaya çıkan esrarengiz bir bulaşıcı beyinsel hastalık sonucu, modern medeniyetin sonunu getiren bir zombi salgınını konu eder.', 16, '2010-10-31', 'the-walking-dead', 'images/movieBanner/1714162346_twdafis.jpg', 'images/movieBackground/1714162346_images.jpg'),
(27, 'Who Am I?', 'Genç bir bilgisayar dehası olan Benjamin, sadece Almanya\'da değil dünya çapında tanınan biri olmak istemektedir. Yer altı bir hacker grubu, Benjamin\'i aralarına katılmaya çağırınca, Benjamin bu tehlikeli teklifi kabul eder ancak bu tehlikeli oyunlarda başına geleceklerden habersizdir.', 13, '2016-06-05', 'who-am-i', 'images/movieBanner/1714162742_485628.jpg', 'images/movieBackground/1714162742_204375.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `userhistory`
--

CREATE TABLE `userhistory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `movie_id` int(11) DEFAULT NULL,
  `watched_at` enum('0','1') NOT NULL DEFAULT '0',
  `favorite` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `userhistory`
--

INSERT INTO `userhistory` (`id`, `user_id`, `movie_id`, `watched_at`, `favorite`) VALUES
(69, 2, 24, '1', '1'),
(70, 2, 25, '1', '0'),
(71, 1, 25, '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_admin` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_admin`) VALUES
(1, 'lastuser', '6ad14ba9986e3615423dfca256d04e3f', 'lastuser@hotmail.com', '0'),
(2, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@hotmail.com', '1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Tablo için indeksler `userhistory`
--
ALTER TABLE `userhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `userhistory`
--
ALTER TABLE `userhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Tablo kısıtlamaları `userhistory`
--
ALTER TABLE `userhistory`
  ADD CONSTRAINT `userhistory_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `userhistory_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
