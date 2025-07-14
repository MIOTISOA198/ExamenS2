USE final_project;

-- Insertion des membres
INSERT INTO membre (nom, date_de_naissance, genre, email, ville, mdp, image_profil) VALUES
('Jean Dupont', '1990-05-15', 'M', 'jean.dupont@example.com', 'Paris', '$2y$10$examplehash1', 'jean.jpg'),
('Marie Curie', '1985-11-07', 'F', 'marie.curie@example.com', 'Lyon', '$2y$10$examplehash2', 'marie.jpg'),
('Alex Martin', '1995-03-22', 'Autre', 'alex.martin@example.com', 'Marseille', '$2y$10$examplehash3', 'alex.jpg'),
('Sophie Lefèvre', '1992-08-30', 'F', 'sophie.lefevre@example.com', 'Toulouse', '$2y$10$examplehash4', 'sophie.jpg');

-- Insertion des catégories
INSERT INTO categorie_objet (nom_categorie) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

-- Insertion des objets (10 par membre, répartis sur les catégories)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
-- Jean Dupont
('Miroir décoratif', 1, 1), ('Parfum', 1, 1), ('Pinceau maquillage', 1, 1),
('Perceuse', 2, 1), ('Marteau', 2, 1), ('Tournevis', 2, 1),
('Clé à molette', 3, 1), ('Pistolet à colle', 3, 1),
('Mixeur', 4, 1), ('Poêle', 4, 1),
-- Marie Curie
('Lisseur cheveux', 1, 2), ('Sèche-cheveux', 1, 2), ('Palette maquillage', 1, 2),
('Scie', 2, 2), ('Niveau à bulle', 2, 2), ('Pince', 2, 2),
('Pompe à vélo', 3, 2), ('Clé dynamométrique', 3, 2),
('Robot cuiseur', 4, 2), ('Moule à gâteau', 4, 2),
-- Alex Martin
('Vernis à ongles', 1, 3), ('Crème hydratante', 1, 3), ('Masque facial', 1, 3),
('Boîte à outils', 2, 3), ('Visseuse', 2, 3), ('Mètre ruban', 2, 3),
('Cric', 3, 3), ('Clé à pipe', 3, 3),
('Blender', 4, 3), ('Couteau de chef', 4, 3),
-- Sophie Lefèvre
('Bijoux fantaisie', 1, 4), ('Épilateur', 1, 4), ('Lotion corporelle', 1, 4),
('Perceuse sans fil', 2, 4), ('Échelle', 2, 4), ('Cutter', 2, 4),
('Compresseur', 3, 4), ('Meuleuse', 3, 4),
('Grille-pain', 4, 4), ('Cocotte-minute', 4, 4);

-- Insertion des images (1 par objet pour simplifier)
INSERT INTO images_objet (id_objet, nom_image) VALUES
(1, 'miroir.jpg'), (2, 'parfum.jpg'), (3, 'pinceau.jpg'), (4, 'perceuse.jpg'), (5, 'marteau.jpg'),
(6, 'tournevis.jpg'), (7, 'cle_molette.jpg'), (8, 'pistolet_colle.jpg'), (9, 'mixeur.jpg'), (10, 'poele.jpg'),
(11, 'lisseur.jpg'), (12, 'seche_cheveux.jpg'), (13, 'palette.jpg'), (14, 'scie.jpg'), (15, 'niveau.jpg'),
(16, 'pince.jpg'), (17, 'pompe.jpg'), (18, 'cle_dynamo.jpg'), (19, 'robot.jpg'), (20, 'moule.jpg'),
(21, 'vernis.jpg'), (22, 'creme.jpg'), (23, 'masque.jpg'), (24, 'boite_outils.jpg'), (25, 'visseuse.jpg'),
(26, 'metre.jpg'), (27, 'cric.jpg'), (28, 'cle_pipe.jpg'), (29, 'blender.jpg'), (30, 'couteau.jpg'),
(31, 'bijoux.jpg'), (32, 'epilateur.jpg'), (33, 'lotion.jpg'), (34, 'perceuse_sans_fil.jpg'), (35, 'echelle.jpg'),
(36, 'cutter.jpg'), (37, 'compresseur.jpg'), (38, 'meuleuse.jpg'), (39, 'grille_pain.jpg'), (40, 'cocotte.jpg');

-- Insertion des emprunts (10 emprunts)
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01 10:00:00', '2025-07-15 10:00:00'),
(4, 3, '2025-07-02 14:00:00', '2025-07-16 14:00:00'),
(7, 4, '2025-07-03 09:00:00', '2025-07-17 09:00:00'),
(11, 1, '2025-07-04 11:00:00', '2025-07-18 11:00:00'),
(14, 3, '2025-07-05 15:00:00', '2025-07-19 15:00:00'),
(17, 2, '2025-07-06 08:00:00', '2025-07-20 08:00:00'),
(21, 4, '2025-07-07 12:00:00', '2025-07-21 12:00:00'),
(24, 1, '2025-07-08 16:00:00', '2025-07-22 16:00:00'),
(27, 2, '2025-07-09 10:00:00', '2025-07-23 10:00:00'),
(31, 3, '2025-07-10 13:00:00', '2025-07-24 13:00:00');