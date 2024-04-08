CREATE TABLE utilisateurs(
   id_utilisateur INT,
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
   id_recette VARCHAR(50) ,
   titre_ VARCHAR(50)  NOT NULL,
   difficulte VARCHAR(50) ,
   temps INT,
   type_de_plat_ VARCHAR(50)  NOT NULL,
   url_image VARCHAR(50) ,
   description VARCHAR(50) ,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_recette),
   UNIQUE(titre_),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

CREATE TABLE ingredients(
   id_ingredient VARCHAR(50) ,
   nom_ VARCHAR(50)  NOT NULL,
   lipides_ INT,
   glucides INT,
   fibres INT,
   proteines INT,
   calories_ INT,
   PRIMARY KEY(id_ingredient),
   UNIQUE(nom_)
);

CREATE TABLE commentaires(
   id_commentaire VARCHAR(50) ,
   contenu VARCHAR(500) ,
   id_recette VARCHAR(50)  NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_commentaire),
   FOREIGN KEY(id_recette) REFERENCES fiche_recette(id_recette),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

CREATE TABLE etapes(
   id_etape VARCHAR(50) ,
   description VARCHAR(1000) ,
   id_recette VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id_etape),
   FOREIGN KEY(id_recette) REFERENCES fiche_recette(id_recette)
);

CREATE TABLE composer(
   id_recette VARCHAR(50) ,
   id_ingredient VARCHAR(50) ,
   PRIMARY KEY(id_recette, id_ingredient),
   FOREIGN KEY(id_recette) REFERENCES fiche_recette(id_recette),
   FOREIGN KEY(id_ingredient) REFERENCES ingredients(id_ingredient)
);
