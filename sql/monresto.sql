--
-- Base de donnés: monresto
--

-- -------------------------------------------------------

--
-- Structure de la table type_boisson
--

CREATE TABLE IF NOT EXISTS type_boisson (
  id INTEGER NOT NULL,
  designation VARCHAR(45) NOT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Structure de la table type_plat
--

CREATE TABLE IF NOT EXISTS type_plat (
  id INTEGER NOT NULL,
  designation VARCHAR(45) NOT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Structure de la table boisson
--

CREATE TABLE IF NOT EXISTS boisson
(
  id INTEGER NOT NULL,
  designation VARCHAR(45) NOT NULL,
  prix DECIMAL(5,2) DEFAULT 0,
	id_type_boisson INTEGER NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_type_boisson) REFERENCES type_boisson (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table plat
--

CREATE TABLE IF NOT EXISTS plat (
  id INTEGER NOT NULL,
  designation VARCHAR(45) NOT NULL,
  prix DECIMAL(5,2) DEFAULT 0,
  id_type_plat INTEGER NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_type_plat) REFERENCES type_plat (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table menu
--

CREATE TABLE IF NOT EXISTS menu (
  id INTEGER NOT NULL,
  designation VARCHAR(45) NOT NULL,
  prix double DEFAULT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Structure de la table reservation
--

CREATE TABLE IF NOT EXISTS reservation (
  id INTEGER NOT NULL,
  nb_personne smallint(6) NOT NULL,
  commentaire text,
  date date DEFAULT NULL,
  heure time DEFAULT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Structure de la table salle
--

CREATE TABLE IF NOT EXISTS salle (
  num INTEGER NOT NULL,
  designation VARCHAR(45) NOT NULL,
  description text,
  PRIMARY KEY (num)
);

-- --------------------------------------------------------

--
-- Structure de la table table
--

CREATE TABLE IF NOT EXISTS `table` (
  num INTEGER NOT NULL,
  nb_place smallint(6) DEFAULT NULL,
  description text,
  num_salle INTEGER NOT NULL,
  PRIMARY KEY (num),
  FOREIGN KEY (num_salle) REFERENCES salle (num) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table commande
--

CREATE TABLE IF NOT EXISTS commande (
  num INTEGER NOT NULL,
  num_table INTEGER NOT NULL,
  suggestion varchar(45) DEFAULT NULL,
  PRIMARY KEY (num),
  FOREIGN KEY (num_table) REFERENCES `table` (num) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table commande_boisson
--

CREATE TABLE IF NOT EXISTS commande_boisson (
  num_commande INTEGER NOT NULL,
  id_boisson INTEGER NOT NULL,
	PRIMARY KEY (num_commande, id_boisson),
  FOREIGN KEY (num_commande) REFERENCES commande (num) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (id_boisson) REFERENCES boisson (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table commande_menu
--

CREATE TABLE IF NOT EXISTS commande_menu (
  num_commande INTEGER NOT NULL,
  id_menu INTEGER NOT NULL,
	PRIMARY KEY (num_commande, id_menu),
  FOREIGN KEY (num_commande) REFERENCES commande (num) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (id_menu) REFERENCES menu (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table menu_boisson
--

CREATE TABLE IF NOT EXISTS menu_boisson (
  id_boisson INTEGER NOT NULL,
  id_menu INTEGER NOT NULL,
	PRIMARY KEY (id_boisson, id_menu),
  FOREIGN KEY (id_boisson) REFERENCES boisson (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (id_menu) REFERENCES menu (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table menu_plat
--

CREATE TABLE IF NOT EXISTS menu_plat (
  id_plat INTEGER NOT NULL,
  id_menu INTEGER NOT NULL,
	PRIMARY KEY (id_plat, id_menu),
  FOREIGN KEY (id_menu) REFERENCES menu (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (id_plat) REFERENCES plat (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table commande_plat
--

CREATE TABLE IF NOT EXISTS commande_plat (
  num_commande INTEGER NOT NULL,
  id_plat INTEGER NOT NULL,
	PRIMARY KEY (num_commande, id_plat),
  FOREIGN KEY (num_commande) REFERENCES commande (num) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (id_plat) REFERENCES plat (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

-- --------------------------------------------------------

--
-- Structure de la table table_reservation
--

CREATE TABLE IF NOT EXISTS table_reservation (
  id_reservation INTEGER NOT NULL,
  num_table INTEGER NOT NULL,
	PRIMARY KEY (id_reservation, num_table),
  FOREIGN KEY (id_reservation) REFERENCES reservation (id) ON DELETE CASCADE ON UPDATE NO ACTION,
  FOREIGN KEY (num_table) REFERENCES `table` (num) ON DELETE NO ACTION ON UPDATE NO ACTION
);