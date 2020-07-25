-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 25, 2020 at 05:57 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iapk`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` bigint(50) NOT NULL,
  `title` varchar(124) NOT NULL,
  `description` text DEFAULT NULL,
  `descriptionTiny` text DEFAULT NULL,
  `recentChanges` text DEFAULT NULL,
  `packageName` varchar(65) NOT NULL,
  `authorName` varchar(52) DEFAULT NULL,
  `categoryID` bigint(10) NOT NULL,
  `versionName` varchar(20) DEFAULT NULL,
  `installs` bigint(50) NOT NULL DEFAULT 0,
  `rate` float NOT NULL DEFAULT 0,
  `lastUpdated` varchar(50) DEFAULT NULL,
  `minimumSDKVersion` varchar(40) NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  `icon` varchar(212) DEFAULT NULL,
  `source` int(2) NOT NULL,
  `view` bigint(50) NOT NULL DEFAULT 0,
  `lang` varchar(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bot`
--

CREATE TABLE `bot` (
  `id` bigint(50) NOT NULL,
  `userID` bigint(50) NOT NULL,
  `fname` varchar(256) NOT NULL,
  `lname` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `step` int(2) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(50) NOT NULL,
  `slug` varchar(52) NOT NULL,
  `nameFA` varchar(52) NOT NULL,
  `nameAR` varchar(52) NOT NULL,
  `nameEN` varchar(52) NOT NULL,
  `namePT` varchar(52) NOT NULL,
  `nameSW` varchar(52) NOT NULL,
  `nameDE` varchar(52) NOT NULL,
  `nameFR` varchar(52) NOT NULL,
  `isGame` int(1) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `slug`, `nameFA`, `nameAR`, `nameEN`, `namePT`, `nameSW`, `nameDE`, `nameFR`, `isGame`, `datetime`) VALUES
(1, 'music-audio', 'موسیقی و صدا', '', '', '', '', '', '', 0, '2020-04-14 00:26:06'),
(2, 'racing', 'مسابقه', 'سباق', 'Racing', 'Corrida', 'Mashindano', 'Rennsport', 'Jeux de courses', 1, '2020-05-17 11:57:55'),
(3, 'entertainment', 'سرگرمی', 'ترفيه', 'Entertainment', 'Entretenimento', 'Burudani', 'Unterhaltung', 'Divertissement', 0, '2020-04-14 00:26:15'),
(4, 'simulation', 'شبیه‌سازی', 'المحاكاة', 'Simulation', 'Simulação', 'Uigaji', 'Simulation', 'Simulation', 1, '2020-04-14 00:26:17'),
(5, 'productivity', 'بهره وری', 'الإنتاجية', 'Productivity', 'Produtividade', 'Za kuongeza tija', 'Effizienz', 'Productivité', 0, '2020-05-17 11:52:01'),
(6, 'arcade', 'آرکید', 'ألعاب كلاسيكية', 'Arcade', 'Arcade', 'Ukumbi', 'Arcade', 'Arcade', 1, '2020-05-17 11:49:11'),
(7, 'personalization', 'شخصی سازی', 'تخصيص', 'Personalization', 'Personalização', 'Badilisha upendavyo', 'Personalisierung', 'Personnalisation', 0, '2020-05-17 12:54:34'),
(8, 'educational', 'آموزشی', 'تعليمية', 'Educational', 'Educativo', 'Kielimu', 'Lernspiele', 'Éducatif', 1, '2020-04-14 00:26:15'),
(9, 'action', 'پرتحرک', 'ألعاب حركة', 'Action', 'Ação', 'Mapigano', 'Action', 'Action', 1, '2020-05-17 11:53:03'),
(10, 'tools', 'ابزارها', 'الأدوات', 'Tools', 'Ferramentas', 'Zana', 'Tools', 'Outils', 0, '2020-04-14 00:26:15'),
(11, 'sports-game', 'ورزشی', '', '', '', '', '', '', 1, '2020-04-14 00:26:06'),
(12, 'casual', 'معمولی', 'خفيفة', 'Casual', 'Casual', 'Ya kawaida', 'Gelegenheitsspiele', 'Jeux grand public', 1, '2020-05-17 11:49:40'),
(13, 'photography', 'عکاسی', 'الصور الفوتوغرافية', 'Photography', 'Fotografia', 'Upigaji picha', 'Fotografie', 'Photographie', 0, '2020-04-14 00:26:17'),
(14, 'education', 'آموزش', 'التعليم', 'Education', 'Educação', 'Elimu', 'Lernen', 'Enseignement', 0, '2020-04-14 00:26:15'),
(15, 'adventure', 'ماجراجویی', 'مغامرات', 'Adventure', 'Aventura', 'Vituko', 'Abenteuer', 'Aventure', 1, '2020-05-17 11:49:00'),
(16, 'books-reference', 'کتاب‌ها و منابع', '', '', '', '', '', '', 0, '2020-04-14 00:26:06'),
(17, 'word-trivia', 'کلمات و دانستنی‌ها', '', '', '', '', '', '', 1, '2020-04-14 00:26:06'),
(18, 'shopping', 'خرید', 'تسوّق', 'Shopping', 'Compras', 'Ununuzi', 'Shopping', 'Shopping', 0, '2020-04-14 00:26:15'),
(19, 'religious', 'مذهبی', '', '', '', '', '', '', 0, '2020-04-14 00:26:06'),
(20, 'travel-local', 'سیر و سفر', '', '', '', '', '', '', 0, '2020-04-14 00:26:06'),
(21, 'puzzle', 'معمایی', 'الألغاز', 'Puzzle', 'Quebra-cabeça', 'Chemsha Bongo', 'Geduldsspiele', 'Réflexion', 1, '2020-04-14 00:26:17'),
(22, 'sports', 'ورزشی', 'رياضة', 'Sports', 'Esportes', 'Spoti', 'Sportspiele', 'Sport', 0, '2020-04-14 01:13:23'),
(23, 'business', 'کسب و کار', 'أعمال', 'Business', 'Corporativo', 'Biashara', 'Büro', 'Professionnel', 0, '2020-04-14 00:26:18'),
(24, 'strategy', 'استراتژی', 'الإستراتيجية', 'Strategy', 'Estratégia', 'Mikakati', 'Strategie', 'Stratégie', 1, '2020-04-14 00:26:16'),
(25, 'communication', 'ارتباطات', 'الاتصال', 'Communication', 'Comunicação', 'Mawasiliano', 'Kommunikation', 'Communication', 0, '2020-05-17 11:58:09'),
(26, 'medical', 'پزشکی', 'طبي', 'Medical', 'Medicina', 'Matibabu', 'Medizin', 'Médecine', 0, '2020-05-17 13:15:18'),
(27, 'social', 'اجتماعی', 'اجتماعي', 'Social', 'Social', 'Mitandao jamii', 'Soziale Netzwerke', 'Réseaux sociaux', 0, '2020-05-17 11:48:36'),
(28, 'media-video', 'ویدئو و رسانه', '', '', '', '', '', '', 0, '2020-04-14 00:26:06'),
(29, 'family', 'خانوادگی', '', '', '', '', '', '', 1, '2020-04-14 00:26:07'),
(30, 'finance', 'امور مالی', 'شؤون مالية', 'Finance', 'Finanças', 'Fedha', 'Finanzen', 'Finance', 0, '2020-04-14 00:26:17'),
(31, 'health-fitness', 'ورزش و تغذیه سالم', '', '', '', '', '', '', 0, '2020-04-14 00:26:07'),
(32, 'lifestyle', 'روش زندگی', 'نمط حياة', 'Lifestyle', 'Estilo de vida', 'Mtindo wa maisha', 'Lifestyle', 'Lifestyle', 0, '2020-05-17 11:55:41'),
(33, 'weather', 'آب و هوا', 'الطقس', 'Weather', 'Clima', 'Hali ya hewa', 'Wetter', 'Météo', 0, '2020-05-17 12:01:02'),
(34, 'news', 'خبرها و نشریات', '', '', '', '', '', '', 0, '2020-04-14 00:26:07'),
(35, 'maps-navigation', 'رفت و آمد', '', '', '', '', '', '', 0, '2020-04-14 00:26:07'),
(36, 'food-drink', 'آشپزی و رستوران', '', '', '', '', '', '', 0, '2020-04-14 00:26:07'),
(37, 'booksreference', 'کتاب‌ها و منابع', 'الكتب والمراجع', 'Books & Reference', 'Livros e referências', 'Vitabu na Marejeo', 'Bücher & Nachschlagewerke', 'Livres et références', 0, '2020-04-14 00:26:15'),
(38, 'newsmagazines', 'اخبار و مجلات', 'الأخبار والمجلات', 'News & Magazines', 'Notícias e revistas', 'Habari na Magazeti', 'Nachrichten & Zeitschriften', 'Actualités et magazines', 0, '2020-04-14 00:26:15'),
(39, 'video-players', '‏ابزار بازی‌های ویدویی', 'أدوات الفيديو', 'Video Players &amp; Editors', 'Reproduzir e editar vídeos', 'Vihariri na Vicheza Video', 'Videoplayer &amp; Editors', 'Lecteurs et éditeurs vidéo', 0, '2020-05-17 12:17:45'),
(40, 'trivia', 'اطلاعات عمومی', 'معلومات عامة', 'Trivia', 'Curiosidades', 'Trivia', 'Quizspiele', 'Culture générale', 1, '2020-04-14 00:26:15'),
(41, 'healthfitness', 'بهداشت و تناسب اندام', 'الصحة واللياقة البدنية', 'Health & Fitness', 'Saúde e fitness', 'Afya na Siha', 'Gesundheit & Fitness', 'Santé et remise en forme', 0, '2020-04-14 00:26:15'),
(42, 'musicaudio', 'موسیقی و صدا', 'موسيقى وأغانٍ', 'Music & Audio', 'Música e áudio', 'Muziki na Sauti', 'Musik & Audio', 'Musique et audio', 0, '2020-04-14 00:26:15'),
(43, 'travellocal', 'سفر و محلی', 'السفر ومعلومات محلية', 'Travel & Local', 'Turismo e local', 'Usafiri + Yaliyo Karibu', 'Reisen & Lokales', 'Voyages et infos locales', 0, '2020-04-14 00:26:16'),
(44, 'artdesign', 'هنر و طراحی', 'فن وتصميم', 'Art & Design', 'Arte e design', 'Sanaa na Uchoraji', 'Kunst & Design', 'Art et design', 0, '2020-04-14 00:26:16'),
(45, 'word', 'کلمه‌یابی', 'كلمات', 'Word', 'Palavras', 'Maneno', 'Worträtsel', 'Jeux littéraires', 1, '2020-04-14 00:26:16'),
(46, 'music', 'موسیقی', 'موسيقى', 'Music', 'Música', 'Muziki', 'Musik', 'Musique', 1, '2020-04-14 00:26:17'),
(47, 'card', 'کارت', 'الورق', 'Card', 'Cartas', 'Kadi', 'Kartenspiele', 'Cartes', 1, '2020-04-14 00:26:17'),
(48, 'role-playing', 'ایفای نقش', 'تقمص الأدوار', 'Role Playing', 'RPG', 'Kuigiza', 'Rollenspiele', 'Jeux de rôles', 1, '2020-04-14 00:26:18'),
(49, 'casino', '', '', 'Casino', '', '', '', '', 1, '2020-04-14 01:14:30'),
(50, 'board', 'تخته‌ای', 'لوحة', 'Board', 'Tabuleiro', 'Bao', 'Brettspiele', 'Jeux de société', 1, '2020-05-17 11:57:39'),
(51, 'comics', '', '', 'Comics', '', '', '', '', 0, '2020-04-14 01:14:31'),
(52, 'parenting', '', '', 'Parenting', '', '', '', '', 0, '2020-04-14 01:14:32'),
(53, 'dating', 'دوستیابی', 'تعارف', 'Dating', 'Encontros', 'Kuchumbiana', 'Dating', 'Rencontres', 0, '2020-05-17 12:53:22'),
(54, 'mapsnavigation', '', '', 'Maps & Navigation', '', '', '', '', 0, '2020-04-14 01:14:32'),
(55, 'beauty', '', '', 'Beauty', '', '', '', '', 0, '2020-04-14 01:14:32'),
(56, 'autovehicles', '', '', 'Auto & Vehicles', '', '', '', '', 0, '2020-04-14 01:14:33'),
(57, 'househome', '', '', 'House & Home', '', '', '', '', 0, '2020-04-14 01:14:34'),
(58, 'events', '', '', 'Events', '', '', '', '', 0, '2020-04-14 01:14:35'),
(59, 'fooddrink', '', '', 'Food & Drink', '', '', '', '', 0, '2020-04-14 01:14:36'),
(60, 'librariesdemo', '', '', 'Libraries & Demo', '', '', '', '', 0, '2020-04-14 01:15:00'),
(61, 'art-and-design', 'هنر و طراحی', 'فن وتصميم', 'Art &amp; Design', 'Arte e design', 'Sanaa na Uchoraji', 'Kunst &amp; Design', 'Art et design', 0, '2020-05-17 11:50:59'),
(62, 'music-and-audio', 'موسیقی و صدا', 'موسيقى وأغانٍ', 'Music &amp; Audio', 'Música e áudio', 'Muziki na Sauti', 'Musik &amp; Audio', 'Musique et audio', 0, '2020-05-17 11:51:58'),
(63, 'books-and-reference', 'کتاب‌ها و منابع', 'الكتب والمراجع', 'Books &amp; Reference', 'Livros e referências', 'Vitabu na Marejeo', 'Bücher &amp; Nachschlagewerke', 'Livres et références', 0, '2020-05-17 11:53:32'),
(64, 'travel-and-local', 'سفر و محلی', 'السفر ومعلومات محلية', 'Travel &amp; Local', 'Turismo e local', 'Usafiri + Yaliyo Karibu', 'Reisen &amp; Lokales', 'Voyages et infos locales', 0, '2020-05-17 11:56:10'),
(65, 'health-and-fitness', 'بهداشت و تناسب اندام', 'الصحة واللياقة البدنية', 'Health &amp; Fitness', 'Saúde e fitness', 'Afya na Siha', 'Gesundheit &amp; Fitness', 'Santé et remise en forme', 0, '2020-05-17 12:12:56'),
(66, 'maps-and-navigation', '‏نقشه و راهبری', 'الخرائط والتنقل', 'Maps &amp; Navigation', 'Mapas e navegação', 'Ramani na Maelekezo', 'Karten &amp; Navigation', 'Plans et navigation', 0, '2020-05-17 12:14:00'),
(67, 'food-and-drink', 'غذا و نوشیدنی', 'طعام ومشروب', 'Food &amp; Drink', 'Comer e beber', 'Vyakula na Vinywaji', 'Essen &amp; Trinken', 'Cuisine et boissons', 0, '2020-05-17 12:14:36'),
(68, 'auto-and-vehicles', '‏وسایل نقلیه و خودرو', 'سيارات ومركبات', 'Auto &amp; Vehicles', 'Veículos', 'Motokaa', 'Autos &amp; Fahrzeuge', 'Auto et véhicules', 0, '2020-05-17 12:19:09'),
(69, 'news-and-magazines', 'اخبار و مجلات', 'الأخبار والمجلات', 'News &amp; Magazines', 'Notícias e revistas', 'Habari na Magazeti', 'Nachrichten &amp; Zeitschriften', 'Actualités et magazines', 0, '2020-05-17 13:06:40'),
(70, 'house-and-home', '‏خانه و مسکن', 'المنزل', 'House &amp; Home', 'Casa e decoração', 'Mapambo ya Nyumba', 'Haus &amp; Garten', 'Habitat et décoration', 0, '2020-05-17 13:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `download`
--

CREATE TABLE `download` (
  `id` bigint(50) NOT NULL,
  `appID` bigint(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `screenshot`
--

CREATE TABLE `screenshot` (
  `id` bigint(50) NOT NULL,
  `appID` bigint(50) NOT NULL,
  `image` text NOT NULL,
  `thumbnail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` bigint(50) NOT NULL,
  `name` text NOT NULL,
  `nameEn` text NOT NULL,
  `website` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` bigint(50) NOT NULL,
  `appID` bigint(50) NOT NULL,
  `value` text NOT NULL,
  `slug` text NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `id` bigint(124) NOT NULL,
  `date` varchar(8) NOT NULL,
  `time` varchar(8) DEFAULT NULL,
  `ip` varchar(25) NOT NULL,
  `link` varchar(250) NOT NULL,
  `reffer` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `packageName` (`packageName`),
  ADD KEY `source` (`source`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screenshot`
--
ALTER TABLE `screenshot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bot`
--
ALTER TABLE `bot`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `download`
--
ALTER TABLE `download`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screenshot`
--
ALTER TABLE `screenshot`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `id` bigint(124) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
