CREATE TABLE utilisateurs(
   id_utilisateur INT NOT NULL AUTO_INCREMENT,
   adresse_mail_ VARCHAR(50)  NOT NULL,
   login VARCHAR(50) ,
   mdp_ VARCHAR(128)  NOT NULL,
   genre VARCHAR(50) ,
   age INT,
   niveau VARCHAR(50) ,
   is_Admin BOOLEAN,
   is_Ban BOOLEAN,
   PRIMARY KEY(id_utilisateur),
   UNIQUE(adresse_mail_)
);

CREATE TABLE fiche_recette(
   id_recette INT NOT NULL AUTO_INCREMENT ,
   titre_ VARCHAR(50)  NOT NULL,
   difficulte VARCHAR(50) ,
   temps VARCHAR(50),
   type_de_plat_ VARCHAR(50)  NOT NULL,
   url_image VARCHAR(200) ,
   description VARCHAR(50) ,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_recette),
   UNIQUE(titre_),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

CREATE TABLE ingredients(
   id_ingredient INT NOT NULL AUTO_INCREMENT,
   nom_ VARCHAR(50)  NOT NULL,
   lipides_ decimal(6,2),
   glucides decimal(6,2),
   fibres decimal(6,2),
   proteines decimal(6,2),
   calories_ decimal(6,2),
   PRIMARY KEY(id_ingredient),
   UNIQUE(nom_)
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
('huile dolive', 100.00, 0.00, 0.00, 0.00, 884.00),
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

CREATE TABLE commentaires(
   id_commentaire INT NOT NULL AUTO_INCREMENT ,
   contenu VARCHAR(500) ,
   id_recette INT NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_commentaire),
   FOREIGN KEY(id_recette) REFERENCES fiche_recette(id_recette),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

CREATE TABLE etapes(
   id_etape INT NOT NULL AUTO_INCREMENT ,
   description VARCHAR(1000) ,
   id_recette INT NOT NULL,
   PRIMARY KEY(id_etape),
   FOREIGN KEY(id_recette) REFERENCES fiche_recette(id_recette)
);

CREATE TABLE composer(
   id_recette INT NOT NULL ,
   id_ingredient INT NOT NULL ,
   PRIMARY KEY(id_recette, id_ingredient),
   FOREIGN KEY(id_recette) REFERENCES fiche_recette(id_recette),
   FOREIGN KEY(id_ingredient) REFERENCES ingredients(id_ingredient)
);
