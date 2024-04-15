CREATE TABLE utilisateurs(
   identifiant INT,
   adresse_mail_ VARCHAR(50)  NOT NULL,
   login VARCHAR(50) ,
   mdp_ VARCHAR(128)  NOT NULL,
   genre VARCHAR(50) ,
   age INT,
   niveau VARCHAR(50) ,
   is_Admin BOOLEAN,
   PRIMARY KEY(identifiant),
   UNIQUE(adresse_mail_),
   UNIQUE(mdp_)
);

CREATE TABLE fiche_recette(
   titre_ VARCHAR(50) ,
   difficulte VARCHAR(50) ,
   temps INT,
   type_de_plat_ VARCHAR(50)  NOT NULL,
   src_images VARCHAR(50) ,
   etapes VARCHAR(50) ,
   ingrédients VARCHAR(50) ,
   description VARCHAR(50) ,
   PRIMARY KEY(titre_),
   UNIQUE(type_de_plat_)
);

CREATE TABLE messages(
   contenu VARCHAR(50) ,
   utilisateur VARCHAR(50) ,
   la_date DATE,
   PRIMARY KEY(contenu)
);

CREATE TABLE sujet(
   question VARCHAR(50) ,
   reponse VARCHAR(50) ,
   PRIMARY KEY(question)
);

CREATE TABLE `ingredients` (
  `nom` varchar(30) NOT NULL,
  `lipides` decimal(6,2) NOT NULL,
  `glucides` decimal(6,2) NOT NULL,
  `fibres` decimal(6,2) NOT NULL,
  `proteines` decimal(6,2) NOT NULL,
  `calories` decimal(6,2) NOT NULL
);

INSERT INTO `ingredients` (`nom_`, `lipides_`, `glucides`, `fibres`, `proteines`, `calories_`) VALUES
('ail', 0.50, 33.00, 2.10, 6.40, 149.00),
('beurre', 81.00, 0.10, 0.00, 0.60, 717.00),
('cannelle moulue', 1.20, 80.00, 53.00, 4.00, 247.00),
('carottes', 41.00, 0.20, 9.60, 2.80, 0.90),
('citron', 0.30, 9.30, 2.80, 1.10, 29.00),
('concombre', 0.10, 3.60, 0.50, 0.70, 16.00),
('courgettes', 0.30, 3.10, 1.00, 1.20, 17.00),
('crème fraîche', 35.00, 2.00, 0.00, 2.00, 350.00),
('emmental', 28.00, 0.40, 0.00, 27.00, 392.00),
('farine', 1.00, 76.00, 2.70, 10.00, 364.00),
('filet de porc', 3.00, 0.00, 0.00, 0.00, 143.00),
('huile olive', 100.00, 0.00, 0.00, 0.00, 884.00),
('knackis', 25.00, 4.00, 0.00, 13.00, 290.00),
('lait', 3.90, 4.80, 0.00, 3.30, 61.00),
('morue', 0.70, 0.00, 0.00, 20.00, 90.00),
('oeuf', 4.50, 0.40, 0.00, 6.30, 68.00),
('oignon', 0.10, 9.30, 1.70, 1.10, 40.00),
('olives noires', 14.00, 4.00, 3.50, 1.50, 135.00),
('pain', 2.50, 47.00, 7.00, 9.00, 275.00),
('pâte feuilletée', 28.00, 48.00, 2.00, 6.00, 460.00),
('persil', 0.80, 3.70, 3.30, 3.00, 36.00),
('poivre', 3.30, 64.00, 26.00, 10.00, 296.00),
('poivrons', 31.00, 0.30, 6.00, 2.10, 1.30),
('pomme de terre', 0.10, 17.00, 2.00, 2.00, 77.00),
('riz', 0.30, 28.20, 0.40, 2.70, 130.00),
('salade', 0.20, 2.90, 1.30, 1.40, 15.00),
('sardines', 10.00, 0.00, 0.00, 21.00, 177.00),
('sucre', 0.00, 99.90, 0.00, 0.00, 387.00),
('tomates', 18.00, 0.20, 3.90, 1.20, 0.90),
('tranche de pain de mie', 0.70, 12.00, 1.00, 2.50, 65.00),
('vin blanc sec', 0.00, 0.70, 0.00, 0.00, 83.00),
('vin de porto', 0.00, 14.00, 0.00, 0.10, 141.00);

CREATE TABLE envoyer(
   identifiant INT,
   contenu VARCHAR(50) ,
   PRIMARY KEY(identifiant, contenu),
   FOREIGN KEY(identifiant) REFERENCES utilisateurs(identifiant),
   FOREIGN KEY(contenu) REFERENCES messages(contenu)
);

CREATE TABLE repondre(
   contenu VARCHAR(50) ,
   contenu_1 VARCHAR(50) ,
   PRIMARY KEY(contenu, contenu_1),
   FOREIGN KEY(contenu) REFERENCES messages(contenu),
   FOREIGN KEY(contenu_1) REFERENCES messages(contenu)
);

CREATE TABLE commenter(
   identifiant INT,
   titre_ VARCHAR(50) ,
   PRIMARY KEY(identifiant, titre_),
   FOREIGN KEY(identifiant) REFERENCES utilisateurs(identifiant),
   FOREIGN KEY(titre_) REFERENCES fiche_recette(titre_)
);

CREATE TABLE valider(
   identifiant INT,
   titre_ VARCHAR(50) ,
   PRIMARY KEY(identifiant, titre_),
   FOREIGN KEY(identifiant) REFERENCES utilisateurs(identifiant),
   FOREIGN KEY(titre_) REFERENCES fiche_recette(titre_)
);

CREATE TABLE créer_(
   identifiant INT,
   titre_ VARCHAR(50) ,
   PRIMARY KEY(identifiant, titre_),
   FOREIGN KEY(identifiant) REFERENCES utilisateurs(identifiant),
   FOREIGN KEY(titre_) REFERENCES fiche_recette(titre_)
);

CREATE TABLE bannir(
   identifiant INT,
   identifiant_1 INT,
   PRIMARY KEY(identifiant, identifiant_1),
   FOREIGN KEY(identifiant) REFERENCES utilisateurs(identifiant),
   FOREIGN KEY(identifiant_1) REFERENCES utilisateurs(identifiant)
);

CREATE TABLE contenir(
   contenu VARCHAR(50) ,
   question VARCHAR(50) ,
   PRIMARY KEY(contenu, question),
   FOREIGN KEY(contenu) REFERENCES messages(contenu),
   FOREIGN KEY(question) REFERENCES sujet(question)
);

CREATE TABLE publier(
   identifiant INT,
   question VARCHAR(50) ,
   PRIMARY KEY(identifiant, question),
   FOREIGN KEY(identifiant) REFERENCES utilisateurs(identifiant),
   FOREIGN KEY(question) REFERENCES sujet(question)
);

CREATE TABLE composer(
   titre_ VARCHAR(50) ,
   nom_ VARCHAR(50) ,
   PRIMARY KEY(titre_, nom_),
   FOREIGN KEY(titre_) REFERENCES fiche_recette(titre_),
   FOREIGN KEY(nom_) REFERENCES ingredients(nom_)
);
