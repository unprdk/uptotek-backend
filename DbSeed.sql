SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `uptotek_users` (
  `id` int(11) NOT NULL,
  `email` varchar(256) COLLATE utf8_danish_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_danish_ci NOT NULL,
  `firstname` varchar(256) COLLATE utf8_danish_ci NOT NULL,
  `lastname` varchar(256) COLLATE utf8_danish_ci NOT NULL,
  `picture` varchar(256) COLLATE utf8_danish_ci NOT NULL,
  `age` int(11) NOT NULL,
  `isgod` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

INSERT INTO `uptotek_users` (`id`, `email`, `password`, `firstname`, `lastname`, `picture`, `age`, `isgod`) VALUES
(1, 'casper@softpart.dk', 'e48e13207341b6bffb7fb1622282247b', 'Rick', 'Astley', 'http://img1.wikia.nocookie.net/__cb20130318151721/epicrapbattlesofhistory/images/6/6d/Rick-astley.jpg', 49, 1),
(2, 'olivermunkebo@hotmail.com', 'e48e13207341b6bffb7fb1622282247b', 'Oliver', 'Stenkilde', 'https://s3-us-west-2.amazonaws.com/slack-files2/avatars/2015-06-05/6013437043_86e286a75b0ac39ce6b2_192.jpg', 3, 0);

ALTER TABLE `uptotek_users`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `uptotek_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
  
  
  
  
CREATE TABLE IF NOT EXISTS `uptotek_skills` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `skill` varchar(256) COLLATE utf8_danish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

INSERT INTO `uptotek_skills` (`id`, `userid`, `skill`) VALUES
(1, 1, 'programming'),
(2, 1, 'shitting'),
(3, 1, 'eating'),
(4, 1, 'cooking bacon'),
(5, 1, 'being pro'),
(6, 1, 'playing guitar'),
(7, 1, 'picking up chicks'),
(8, 2, 'programming'),
(9, 2, 'shitting'),
(10, 2, 'eating'),
(11, 2, 'cooking bacon'),
(12, 2, 'being pro'),
(13, 2, 'playing guitar'),
(14, 2, 'picking up chicks');

ALTER TABLE `uptotek_skills`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `uptotek_skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
  
  
  
  
CREATE TABLE IF NOT EXISTS `uptotek_accesstokens` (
  `id` int(11) NOT NULL,
  `token` varchar(1024) COLLATE utf8_danish_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

ALTER TABLE `uptotek_accesstokens`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `uptotek_accesstokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;