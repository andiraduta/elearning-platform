
-- --------------------------------------------------------

--
-- Table structure for table `cursuri`
--

CREATE TABLE IF NOT EXISTS `cursuri` (
  `id_curs` int(15) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(15) NOT NULL,
  `id_responsabil` int(15) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `descriere` text NOT NULL,
  `data_inceput` datetime NOT NULL,
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_curs`),
  KEY `id_responsabil` (`id_responsabil`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cursuri`
--

INSERT INTO `cursuri` (`id_curs`, `id_categorie`, `id_responsabil`, `titlu`, `descriere`, `data_inceput`, `data_creare`) VALUES
(1, 1, 2, 'Arhitectura calculatoarelor', '', '2013-05-01 00:00:00', '2013-06-16 22:38:55'),
(2, 2, 4, 'Analiza Matematica', '', '2013-04-01 00:00:00', '2013-06-16 22:47:38'),
(3, 1, 6, 'Algoritmica grafurilor', '', '2013-04-01 00:00:00', '2013-06-16 22:48:40'),
(4, 1, 8, 'Programare orientata pe obiecte', '', '2013-04-01 00:00:00', '2013-06-16 23:14:56'),
(5, 1, 7, 'Limbaje formale si automate', '', '2013-05-01 00:00:00', '2013-06-16 23:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `cursuri_activitati`
--

CREATE TABLE IF NOT EXISTS `cursuri_activitati` (
  `id_activitate` int(10) NOT NULL AUTO_INCREMENT,
  `id_tip_activitate` int(10) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_activitate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cursuri_activitati`
--


-- --------------------------------------------------------

--
-- Table structure for table `cursuri_categorii`
--

CREATE TABLE IF NOT EXISTS `cursuri_categorii` (
  `id_categorie` int(15) NOT NULL AUTO_INCREMENT,
  `id_parinte` int(15) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `descriere` text NOT NULL,
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_categorie`),
  KEY `id_parinte` (`id_parinte`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cursuri_categorii`
--

INSERT INTO `cursuri_categorii` (`id_categorie`, `id_parinte`, `titlu`, `descriere`, `data_creare`) VALUES
(1, 3, 'Departamentul de Informatica', '', '2013-05-17 00:20:08'),
(2, 3, 'Departamentul  de Matematica', '', '2013-05-17 00:20:34'),
(3, 0, 'Facultatea de Matematica si Informatica', '', '2013-05-17 00:21:59'),
(7, 0, 'Facultatea de Geografie', '', '2013-06-16 22:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `cursuri_tipuri_activitati`
--

CREATE TABLE IF NOT EXISTS `cursuri_tipuri_activitati` (
  `id_tip_activitate` int(10) NOT NULL AUTO_INCREMENT,
  `tip_activitate` varchar(150) NOT NULL,
  PRIMARY KEY (`id_tip_activitate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cursuri_tipuri_activitati`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id_forum` int(15) NOT NULL AUTO_INCREMENT,
  `id_curs` int(15) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `descriere` varchar(255) NOT NULL,
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_forum`),
  KEY `id_curs` (`id_curs`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id_forum`, `id_curs`, `nume`, `descriere`, `data_creare`) VALUES
(1, 1, 'Forum discutii', '', '2013-06-16 23:42:11'),
(2, 2, 'Forum discutii', '', '2013-06-16 22:47:38'),
(3, 3, 'Forum discutii', '', '2013-06-16 22:48:40'),
(4, 4, 'Forum discutii', '', '2013-06-16 23:14:56'),
(5, 5, 'Forum discutii', '', '2013-06-16 23:15:23');

-- --------------------------------------------------------

--
-- Table structure for table `forum_discutii`
--

CREATE TABLE IF NOT EXISTS `forum_discutii` (
  `id_discutie` int(15) NOT NULL AUTO_INCREMENT,
  `id_forum` int(15) NOT NULL,
  `id_utilizator` int(15) NOT NULL,
  `titlu` int(11) NOT NULL,
  `data_creare` int(11) NOT NULL,
  PRIMARY KEY (`id_discutie`),
  KEY `id_forum` (`id_forum`),
  KEY `id_utilizator` (`id_utilizator`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_discutii`
--


-- --------------------------------------------------------

--
-- Table structure for table `forum_postari`
--

CREATE TABLE IF NOT EXISTS `forum_postari` (
  `id_postare` int(15) NOT NULL AUTO_INCREMENT,
  `id_discutie` int(15) NOT NULL,
  `id_utilizator` int(15) NOT NULL,
  `mesaj` text NOT NULL,
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_postare`),
  KEY `id_discutie` (`id_discutie`),
  KEY `id_utilizator` (`id_utilizator`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forum_postari`
--


-- --------------------------------------------------------

--
-- Table structure for table `mesaje`
--

CREATE TABLE IF NOT EXISTS `mesaje` (
  `id_mesaj` bigint(15) NOT NULL AUTO_INCREMENT,
  `de_la_utilizator` int(10) NOT NULL,
  `catre_utilizator` int(10) NOT NULL,
  `subiect` varchar(255) NOT NULL,
  `mesaj` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_mesaj`),
  KEY `de_la_utilizator` (`de_la_utilizator`),
  KEY `catre_utilizator` (`catre_utilizator`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mesaje`
--

INSERT INTO `mesaje` (`id_mesaj`, `de_la_utilizator`, `catre_utilizator`, `subiect`, `mesaj`, `status`, `data_creare`) VALUES
(1, 1, 3, 'Raspuns privind data examen', 'Examenul va avea loc pe data de 12 iunie. Va rog sa-i anuntati si pe colegii din grupa dumneavoastra.<br><br>O zi buna,<br>Mihai Constantin<br>', 0, '2013-06-10 23:37:35'),
(2, 5, 1, 'Materiale curs', 'Buna ziua,<br><br>Am pregatit materialele pentru curs. Va rog sa ma anuntati cand este totul gata.<br><br>Cu stima,<br>Ciprian', 0, '2013-06-11 22:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `noutati`
--

CREATE TABLE IF NOT EXISTS `noutati` (
  `id_noutate` int(15) NOT NULL AUTO_INCREMENT,
  `id_utilizator` int(15) NOT NULL,
  `titlu` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_noutate`),
  KEY `id_utilizator` (`id_utilizator`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `noutati`
--

INSERT INTO `noutati` (`id_noutate`, `id_utilizator`, `titlu`, `text`, `data_creare`) VALUES
(1, 1, 'Conferinta "Romanian Cryptology Days"', 'Serviciul de Informatii Externe, organizeaza in parteneriat cu Academia \r\nRomana cea de-a doua editie a conferintei internationale <b>"Romanian \r\nCryptology Days"</b>, RCD-2013, in perioada <u>16-17 septembrie 2013</u> la \r\nBucuresti. Manifestarea este inscrisa in calendarul de evenimente \r\ncriptologice de pe site-ul IACR. Lucrarile sustinute vor fi publicate \r\nintr-un volum cotat ISI.<br>', '2013-06-10 20:59:44'),
(2, 1, 'Evaluare institutionala I', 'Potrivit unui studiu intern realizat in luna ianuarie 2011, absolventii \r\nFacultatii de Matematica si Informatica, specializarea Informatica, la \r\n6-18 luni de la absolvire, lucreaza in domeniu, cu program complet si \r\nurmeaza in paralel un program de Master.<br>', '2013-06-10 21:01:25'),
(3, 1, 'Evaluare institutionala II', 'Domeniile de studiu Matematica si Informatica din FMI au fost \r\nclasificate in categoria A, printre primele la nivel national \r\n(Matematica pe locul 3, Informatica pe locul 1), conform unui raport \r\npublicat de MECTS la inceputul noului an universitar 2011-2012.<br>', '2013-06-10 21:01:45');

-- --------------------------------------------------------

--
-- Table structure for table `permisiuni`
--

CREATE TABLE IF NOT EXISTS `permisiuni` (
  `id_permisiune` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `descriere_permisiune` varchar(50) NOT NULL,
  PRIMARY KEY (`id_permisiune`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `permisiuni`
--

INSERT INTO `permisiuni` (`id_permisiune`, `descriere_permisiune`) VALUES
(1, 'adaugaUtilizator'),
(2, 'stergeUtilizator'),
(3, 'vedeListaUtilizatori'),
(4, 'modificaRoluriPermisiuni'),
(5, 'adaugaNoutati'),
(6, 'adaugaEvenimente'),
(7, 'adaugaCursuri'),
(8, 'trimiteMesaje');

-- --------------------------------------------------------

--
-- Table structure for table `roluri`
--

CREATE TABLE IF NOT EXISTS `roluri` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nume_rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roluri`
--

INSERT INTO `roluri` (`id_rol`, `nume_rol`) VALUES
(1, 'Administrator'),
(2, 'Profesor'),
(3, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `roluri_permisiuni`
--

CREATE TABLE IF NOT EXISTS `roluri_permisiuni` (
  `id_rol` int(10) unsigned NOT NULL,
  `id_permisiune` int(10) unsigned NOT NULL,
  KEY `id_rol` (`id_rol`),
  KEY `id_permisiune` (`id_permisiune`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roluri_permisiuni`
--

INSERT INTO `roluri_permisiuni` (`id_rol`, `id_permisiune`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(3, 8),
(2, 6),
(2, 7),
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `roluri_utilizatori`
--

CREATE TABLE IF NOT EXISTS `roluri_utilizatori` (
  `id_utilizator` int(10) unsigned NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  KEY `id_utilizator` (`id_utilizator`),
  KEY `id_rol` (`id_rol`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roluri_utilizatori`
--

INSERT INTO `roluri_utilizatori` (`id_utilizator`, `id_rol`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE IF NOT EXISTS `utilizatori` (
  `id_utilizator` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `parola` varchar(32) NOT NULL,
  `nume` varchar(300) NOT NULL,
  `telefon` varchar(100) NOT NULL,
  `localitate` varchar(200) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `data_creare` datetime NOT NULL,
  `ultima_activitate` datetime NOT NULL,
  `activ` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_utilizator`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id_utilizator`, `email`, `username`, `parola`, `nume`, `telefon`, `localitate`, `adresa`, `data_creare`, `ultima_activitate`, `activ`) VALUES
(1, 'admin@site.ro', 'admin', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Iulian Burcea', '', 'Bucuresti', '', '2013-05-10 00:13:04', '2013-06-15 17:04:23', 1),
(2, 'profesor@test.ro', 'profesor', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Emil Popescu', '', '', '', '2013-05-16 23:01:56', '0000-00-00 00:00:00', 1),
(3, 'student@test.ro', 'student', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Mihai Constantin', '', '', '', '2013-05-16 23:02:17', '2013-06-17 01:25:42', 1),
(4, 'constantin@universitate.ro', 'constantin', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Constantin Enache', '', 'Bucuresti', '', '2013-06-11 22:04:36', '0000-00-00 00:00:00', 1),
(5, 'ciprian@universitate.ro', 'ciprian', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Ciprian Enescu', '', 'Bucuresti', '', '2013-06-11 22:05:41', '0000-00-00 00:00:00', 1),
(6, 'laurentiu@universitate.ro', 'laurentiu', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Laurentiu Constantin', '', '', '', '2013-06-11 22:06:39', '0000-00-00 00:00:00', 1),
(7, 'maria@universitate.ro', 'maria', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Maria Georgescu', '', 'Bucuresti', '', '2013-06-11 22:07:06', '0000-00-00 00:00:00', 1),
(8, 'emilian@universitate.ro', 'emilian', 'fe01ce2a7fbac8fafaed7c982a04e229', 'Emilian Vaduva', '', '', '', '2013-06-11 22:07:33', '0000-00-00 00:00:00', 1);
