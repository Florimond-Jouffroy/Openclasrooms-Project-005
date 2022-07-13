CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL DEFAULT '0',
  `lastname` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL DEFAULT '0',
  `user_type` tinyint(4) NOT NULL DEFAULT '0',
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `chapo` tinytext NOT NULL,
  `content` text NOT NULL,
  `date_creation` date NOT NULL,
  `date_update` date NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_user` (`user_id`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(50) NOT NULL,
  `disabled` tinyint(4) NOT NULL DEFAULT '0',
  `date_creation` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_user` (`user_id`),
  KEY `FK_comment_post` (`post_id`),
  CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`),
  CONSTRAINT `FK_comment_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `password`, `user_type`, `date_creation`) VALUES
	(1, 'Florimond', 'Jouffroy', 'florimond.25@gmail.com', 'test', 1, '2019-08-23'),
	(3, 'Florimond', 'jouffroy', 'florimond.jouffroy@gmail.com', 'test', 0, '2019-10-10'),
	(4, 'test', 'test', 'test@test.com', '$2y$10$7MxeE2CcnLrMq0.2Xis4qeNtvH9n.rjLuMppgNGz8hZnpfR9VW3Y6', 1, '2019-10-17'),
	(5, 'Richard25', 'Ducret', 'ducret@top.com', '$2y$10$tTMuxge.OCG8W.1rULvBcu163aWlPB6WPfpaWuYuTLmElf6fKiey.', 0, '2019-10-29');


INSERT INTO `post` (`id`, `title`, `chapo`, `content`, `date_creation`, `date_update`, `user_id`) VALUES
	(1, 'titre 1', 'chapo 1', 'content 1', '2019-09-12', '2019-09-12', 1),
	(3, 'Config PC Gamer à 1200€ : Jouez dans la cour des grands', 'Vous avez un budget d’environ 1200€ pour un PC gamer ? Je vous propose dans cet article deux configurations AMD et Intel dans cette…', 'Vous avez un budget d’environ 1200€ pour un PC gamer ? Je vous propose dans cet article deux configurations AMD et Intel dans cette gamme de prix. Et là les amis, je peux vous dire qu’avec ce type de config, vous jouez déjà dans la cour des grands.Tous les derniers jeux du moment tourneront sans problème. Que ce soit sur Battlefield 5, PUBG, Fortnite, GTA V ou encore Black Ops 4, rien ne pourra résister à cette config PC de gamer. Vous pourrez jouer en mode ULTRA en 1080p dans de très bonnes conditions.', '2019-09-12', '2019-09-12', 1),
	(5, 'Mon deuxième article', 'Extrait du deuxième article', 'Texte du deuxième article ', '2019-11-22', '2019-11-22', 4),
	(6, 'article 3', 't', 't', '2019-11-22', '2019-12-07', 1),
	(7, 'Comment monter un PC soit même !!', 'Comment monter un PC soit même !!', 'Comment monter un PC soit même !!', '2019-11-22', '2019-11-22', 4),
	(8, 'Article de test ', 'extrait pour mon article de test', 'et le contenue', '2020-01-08', '2020-01-08', 4);



INSERT INTO `comment` (`id`, `content`, `disabled`, `date_creation`, `user_id`, `post_id`) VALUES
	(1, 'comment test', 0, '2019-09-17', 1, 1),
	(3, 'Vraiment top cet article !! ', 0, '2019-10-29', 4, 3),
	(8, 'commentaire de test pour vérifier si tout va bien', 0, '2020-01-08', 4, 1),
	(9, 'et encore un', 0, '2020-01-08', 4, 1),
	(10, 'test', 0, '2020-01-08', 4, 8);
