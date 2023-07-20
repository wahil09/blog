-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 juil. 2023 à 20:36
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `Id` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`Id`, `categoryName`, `userId`) VALUES
(1, 'Bloger', 2),
(2, 'informatique', 2),
(3, 'FootBall', 2),
(4, 'Game', 2);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `postTitle` varchar(255) NOT NULL,
  `postContent` text NOT NULL,
  `postCat` varchar(50) NOT NULL,
  `postImage` varchar(255) NOT NULL,
  `postAuthor` varchar(255) NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoryId` int(11) NOT NULL,
  `published` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `userId`, `postTitle`, `postContent`, `postCat`, `postImage`, `postAuthor`, `postDate`, `categoryId`, `published`) VALUES
(5, 2, 'cristiano-ronaldo -> le millieur joueur du monde', 'Cristiano Ronaldo dos Santos Aveiro, couramment appelé Cristiano Ronaldo ou Ronaldo et surnommé CR7, né le 5 février 1985 à Funchal, est un footballeur international portugais qui évolue au poste d\'attaquant à Al-Nassr.\r\n\r\nConsidéré comme l\'un des meilleurs footballeurs de l\'histoire, il est avec Lionel Messi (avec qui il entretient une rivalité sportive) l’un des deux seuls à avoir remporté le Ballon d\'or au moins cinq fois. Auteur de plus de 800 buts en plus de 1 100 matchs en carrière, Ronaldo est le meilleur buteur de l\'histoire du football selon la FIFA. Il est également le meilleur buteur de la Ligue des champions de l\'UEFA, des coupes d\'Europe, du Real Madrid, du derby madrilène, de la Coupe du monde des clubs de la FIFA et de la sélection portugaise, dont il est le capitaine officiel depuis 2008. Premier joueur à avoir remporté le Soulier d\'or européen à quatre reprises, il est également le meilleur buteur de l\'histoire du championnat d\'Europe des nations devant Michel Platini et détient le record de buts en équipe nationale, avec 122 réalisations.\r\n\r\nÉlevé sur l\'île de Madère, il intègre le centre de formation du Sporting Clube de Portugal à l\'âge de onze ans et signe son premier contrat professionnel en 2002. Recruté par Manchester United durant l\'été suivant, il révèle son talent lors de l\'Euro 2004 à seulement 19 ans avec le Portugal. Il réalise une excellente saison 2007-2008 avec Manchester United en remportant la Premier League et la Ligue des champions. En 2009, il est alors l\'objet du transfert le plus élevé de l\'histoire du football (94 millions d\'euros), quand il quitte les Red Devils pour le Real Madrid. Il remporte avec le club madrilène de nombreux trophées dont le Championnat espagnol et quatre fois la Ligue des champions entre 2014 et 2018. À l\'issue de ce dernier succès, il quitte le Real Madrid après neuf saisons au club pour la Juventus Turin. Son aventure italienne est ponctuée par deux titres de champions d\'Italie, mais trois éliminations successives en Ligue des Champions. En 2021, il revient à Manchester United où il termine meilleur buteur de l\'équipe lors de sa première saison avant d\'être licencié en décembre 2022 après avoir critiqué le club publiquement. Il signe ensuite dans le club saoudien Al-Nassr FC pour un contrat record.\r\n\r\nEn sélection, il est le joueur le plus capé, le meilleur buteur et un des acteurs décisifs du Portugal qui remporte son tout premier titre international en battant la France en finale de l\'Euro 2016 puis la Ligue des nations en 2019 contre les Pays-Bas. Depuis 2003, il a participé à cinq Championnats d\'Europe et cinq Coupes du monde, dont il est le premier joueur à avoir marqué un but dans cinq éditions différentes de la compétition planétaire. En juin 2023, il devient le premier joueur de l\'histoire du football, à franchir le cap des 200 sélections en équipe nationale.\r\n\r\nJoueur complet et polyvalent, il cumule les trophées et les records individuels au terme d\'une carrière étendue sur plus de vingt ans. Son talent et sa longévité en font l\'un des joueurs les plus respectés par les observateurs malgré sa personnalité clivante. Faisant partie des athlètes les plus célèbres, il est désigné sportif le mieux rémunéré au monde à plusieurs reprises par le magazine Forbes, notamment grâce à ses contrats publicitaires et établissements commerciaux à son nom. En 2014, le magazine Time l’inclut sur sa liste des cent personnes les plus influentes au monde. Il est également la personnalité la plus suivie sur le réseau social Instagram, comptant 513 millions d\'abonnés.\r\n\r\nBiographie\r\nIssu d\'une famille pauvre madéroise, Cristiano Ronaldo dos Santos Aveiro2 est le fils de Maria Dolores dos Santos et José Dinis Aveiro. Il est né le 5 février 1985 à Santo António, municipalité de Funchal sur l\'île de Madère3. C\'était une naissance prématurée, mais le bébé se portait bien. Son prénom Cristiano a été choisi par sa tante, et son second prénom, Ronaldo, lui a été donné par ses parents en référence au président des États-Unis de l\'époque, Ronald Reagan, que son père admirait en tant qu\'acteur4.\r\n\r\nIl a un grand frère (Hugo) et deux grandes sœurs (Elma et Cátia Lilian, candidate de Dança com as Estrelas 20155). Son arrière-grand-mère, Isabel da Piedade, est capverdienne6. Son père fut touché par le chômage ainsi que l\'alcoolisme. Quant à son grand frère Hugo, il a été durement dépendant à la drogue. Dès que Cristiano eut les moyens financiers d\'aider sa famille, il le fit : il a notamment aidé son frère à sortir de la drogue, a acheté une maison située à Madère pour sa mère. Néanmoins, son père refusa toujours son aide ce qui avait le don d\'énerver Cristiano, qui répondait souvent : « À quoi cela me sert-il d\'avoir autant d\'argent ? ». Son père étant un homme fier et orgueilleux, il ne désirait pas qu\'on l\'aide et encore moins qu\'on le prenne en pitié. C\'est de son père que Cristiano tient cet acharnement envers le travail[réf. nécessaire].\r\n\r\nSon père, José Dinis Aveiro, décède le 7 septembre 2005 à Londres à la suite d\'une tumeur du foie provoquée par l\'alcool. Ce serait pour cette raison que Cristiano Ronaldo ne boit pas d\'alcool7.\r\n\r\nEn octobre 2005, Cristiano Ronaldo est arrêté et entendu par la police, car lui et un complice sont accusés de viol par deux jeunes filles. L\'affaire sera classée peu après puisqu\'une des deux filles retirera sa plainte8.\r\n\r\nAvec l\'aide d\'une de ses sœurs, il a ouvert une boutique de vêtements appelée CR7, son surnom (formé de ses initiales et du numéro de son maillot)9. Il en existe deux : une à Lisbonne et l\'autre à Madère.', 'FootBall', '20-07-2023-07-54-04-Kylian-Mbappe-et-Cristiano-Ronaldo.jpg', 'admin', '2023-07-20 17:54:04', 3, '1'),
(6, 2, 'Python', 'Python (prononcé /pi.tɔ̃/) est un langage de programmation interprété, multiparadigme et multiplateformes. Il favorise la programmation impérative structurée, fonctionnelle et orientée objet. Il est doté d\'un typage dynamique fort, d\'une gestion automatique de la mémoire par ramasse-miettes et d\'un système de gestion d\'exceptions ; il est ainsi similaire à Perl, Ruby, Scheme, Smalltalk et Tcl.\r\n\r\nLe langage Python est placé sous une licence libre proche de la licence BSD4 et fonctionne sur la plupart des plateformes informatiques, des smartphones aux ordinateurs centraux5, de Windows à Unix avec notamment GNU/Linux en passant par macOS, ou encore Android, iOS, et peut aussi être traduit en Java ou .NET. Il est conçu pour optimiser la productivité des programmeurs en offrant des outils de haut niveau et une syntaxe simple à utiliser.\r\n\r\nIl est également apprécié par certains pédagogues qui y trouvent un langage où la syntaxe, clairement séparée des mécanismes de bas niveau, permet une initiation aisée aux concepts de base de la programmation6.', 'informatique', '20-07-2023-07-56-48-python-image.png', 'admin', '2023-07-20 17:56:48', 2, '1'),
(7, 2, 'Counter-Strike', 'Counter-Strike (du mot anglais counterstrike, que l\'on pourrait traduire par « contre-attaque »), ou l\'abréviation CS, est un jeu de tir à la première personne multijoueur en ligne basé sur le principe du jeu en équipe. C\'est une modification complète du jeu Half-Life de Valve, réalisée par Minh Le et Jess Cliffe, dont la première version est sortie le 18 juin 1999. Le jeu fait s\'affronter une équipe de terroristes et d\'antiterroristes au cours de plusieurs manches. Les joueurs marquent des points en accomplissant les objectifs de la carte de jeu et en éliminant leurs adversaires, dans le but de faire gagner leur équipe.\r\n\r\nLe jeu, en version 1.6 depuis septembre 2003, a connu depuis sa sortie officielle le 8 novembre 2000 un important succès. Début 2010, Counter-Strike était encore le jeu de tir à la première personne le plus joué en ligne, devant des jeux plus récents tels que son évolution Counter-Strike: Source. La fréquentation du jeu finira néanmoins par baisser progressivement avec l\'avènement de Counter-Strike: Global Offensive qui est aujourd\'hui le jeu le plus joué de cette série.\r\n\r\nSystème de jeu\r\nPrincipes de base\r\nL\'action des joueurs de Counter-Strike se déroule en plusieurs manches, ou rounds, d\'une durée par défaut de deux minutes2, sur une carte de jeu, ou map. Une équipe de terroristes affronte une équipe d\'antiterroristes2. L\'équipe victorieuse est celle qui a rempli ses objectifs de victoire – ils varient selon la carte, on parle aussi de scénario – ou qui a éliminé tous les joueurs de l\'autre équipe. À la fin du temps réglementaire, s\'il n\'y a pas eu victoire directe d\'une des deux équipes, en fonction du scénario de la carte, l\'équipe qui n\'a pas accompli ses objectifs perd par élimination.\r\n\r\nDans la plupart des scénarios, tous les joueurs commencent avec la même quantité de points de vie2 et la quantité de points d\'armure qu\'ils ont réussi à conserver durant la manche précédente. Lorsque des dommages sont causés, par les tirs de ses adversaires ou de ses coéquipiers, ainsi que par une chute violente, les points de vie du joueur diminuent. Les tirs sont localisés (bras droit, gauche, jambe droite, gauche, torse, et tête), et causent donc plus ou moins de dommages selon l\'endroit touché, en sachant qu\'un tir dans la tête, ou headshot, est souvent mortel3. Lorsque la totalité des points de vie est consommée, le joueur est mort2.\r\n\r\nContrairement à la plupart des jeux de tir multijoueurs, basés sur le deathmatch, lorsqu\'un joueur se fait tuer, il ne revient dans le jeu (respawn) qu\'au début de la manche suivante, et non immédiatement après2 ; il devient entre-temps observateur, capable, selon la configuration du serveur, de suivre la suite de la manche à travers les yeux de ses coéquipiers, des joueurs adverses, ou encore en se déplaçant librement sur toute la carte, en faisant abstraction de tous les obstacles (murs, sols, plafonds)4. Un joueur tué n\'a plus de contact avec les personnages vivants et n\'a donc plus aucune incidence directe sur la poursuite de la manche.\r\n\r\nDans les cartes officielles, le joueur est équipé de base d\'un pistolet et d\'un couteau5. Il peut, pendant une période limitée et dans les zones prévues à cet effet, acheter du matériel : armes à feu, gilets de protection, grenades et autres équipements utiles dans certaines conditions de jeu (kit de désamorçage, lunettes de vision nocturne, etc.2).\r\n\r\nChaque joueur commence la partie avec 800 dollars ($), somme par défaut qui n\'est pas assez élevée pour acheter directement un matériel puissant. Puis au cours des manches, le joueur gagne de l\'argent s\'il tue un ennemi, s\'il remplit une condition de victoire, si son équipe gagne la manche, s\'il pose la bombe et que celle-ci explose, s\'il libère un otage ou lui ordonne de le suivre2. Au contraire, il peut perdre de l\'argent s\'il tue l\'un de ses coéquipiers ou un otage2. La somme d\'argent maximale est de 16 000 $6.\r\n\r\nEn plus du score par équipe, chaque joueur se voit attribuer un score individuel. Celui-ci prend en compte le nombre de frags et le nombre de morts, que l\'on appelle le ratio. Les frags dans Counter-Strike sont légèrement différents de ceux de nombreux jeux de tir à la première personne : ils augmentent dans le jeu de deux manières, en tuant ses adversaires et en complétant les objectifs de victoire. Ainsi, par exemple, un tué donne un frag, une explosion ou un désamorçage de bombe donnent trois frags. Le nombre de morts correspond quant à lui au nombre de fois qu\'un joueur a été tué. Un joueur au niveau de jeu élevé a en fin de partie plus de frags que de morts.', 'Game', '20-07-2023-08-16-08-Counter-Strike-2.jpg', 'admin', '2023-07-20 18:16:08', 4, '1');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL,
  `presentation` text NOT NULL,
  `inscriptionDate` datetime NOT NULL DEFAULT current_timestamp(),
  `job` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `presentation`, `inscriptionDate`, `job`) VALUES
(1, 'Wahil Chettouf', 'wahilchettouf@gmail.com', 'Waihl@123', 'user', 'Je suis wahil chettouf développeur web et web mobile, en formation chez La-plateforme...', '2023-07-20 19:26:03', 'Développeur Web'),
(2, 'admin', 'admin@admin.com', 'admin@123', 'admin', '', '2023-07-20 19:29:23', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
