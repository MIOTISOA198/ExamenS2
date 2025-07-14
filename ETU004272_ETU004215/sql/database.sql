CREATE DATABASE IF NOT EXISTS final_project;
USE final_project;

CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    date_de_naissance DATE NOT NULL,
    genre ENUM('M', 'F', 'Autre') NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    ville VARCHAR(255) NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(255) NOT NULL
);

CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(255) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet)
);

CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT NOT NULL,
    id_membre INT NOT NULL,
    date_emprunt DATETIME NOT NULL,
    date_retour DATETIME,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);