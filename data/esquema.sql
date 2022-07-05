CREATE TABLE `mascotas_adopcion` (
  `id` bigint(11) UNSIGNED NOT NULL primary key AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `mascota` varchar(150) NOT NULL,
  `adoptado` char(10) DEFAULT NULL,
  `dueno` varchar(150)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;