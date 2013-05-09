--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `roluri`
--

CREATE TABLE `roluri` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nume_rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `roluri`
--

INSERT INTO `roluri` (`id_rol`, `nume_rol`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `roluri_permisiuni`
--

CREATE TABLE `roluri_permisiuni` (
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

CREATE TABLE `roluri_utilizatori` (
  `id_utilizator` int(10) unsigned NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  KEY `id_utilizator` (`id_utilizator`),
  KEY `id_rol` (`id_rol`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roluri_utilizatori`
--

INSERT INTO `roluri_utilizatori` (`id_utilizator`, `id_rol`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id_utilizator` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `parola` varchar(32) NOT NULL,
  `data_creare` datetime NOT NULL,
  `activ` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_utilizator`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id_utilizator`, `email`, `username`, `parola`, `data_creare`, `activ`) VALUES
(1, 'admin@site.ro', 'admin', 'fe01ce2a7fbac8fafaed7c982a04e229', '2013-05-10 00:13:04', 1);
