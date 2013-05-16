--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `cursuri`
--

CREATE TABLE IF NOT EXISTS `cursuri` (
  `id_curs` int(15) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(15) NOT NULL,
  `titlu` varchar(255) NOT NULL,
  `descriere` text NOT NULL,
  `data_inceput` datetime NOT NULL,
  `data_creare` datetime NOT NULL,
  PRIMARY KEY (`id_curs`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cursuri`
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
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cursuri_categorii`
--

INSERT INTO `cursuri_categorii` (`id_categorie`, `id_parinte`, `titlu`, `descriere`, `data_creare`) VALUES
(1, 3, 'Departamentul de Informatica', '', '2013-05-17 00:20:08'),
(2, 3, 'Departamentul  de Matematica', '', '2013-05-17 00:20:34'),
(3, 0, 'Facultatea de Matematica si Informatica', '', '2013-05-17 00:21:59');

-- --------------------------------------------------------

--
-- Table structure for table `roluri`
--

CREATE TABLE IF NOT EXISTS `roluri` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nume_rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE IF NOT EXISTS `utilizatori` (
  `id_utilizator` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `parola` varchar(32) NOT NULL,
  `data_creare` datetime NOT NULL,
  `activ` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_utilizator`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id_utilizator`, `email`, `username`, `parola`, `data_creare`, `activ`) VALUES
(1, 'admin@site.ro', 'admin', 'fe01ce2a7fbac8fafaed7c982a04e229', '2013-05-10 00:13:04', 1),
(2, 'profesor@test.ro', 'profesor', 'fe01ce2a7fbac8fafaed7c982a04e229', '2013-05-16 23:01:56', 1),
(3, 'student@test.ro', 'student', 'fe01ce2a7fbac8fafaed7c982a04e229', '2013-05-16 23:02:17', 1);
