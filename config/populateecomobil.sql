USE ecomobil;
/* DELETE DES DONNEES DES TABLES */
DELETE FROM agences;
DELETE FROM entrepot;
DELETE FROM incident;
DELETE FROM participant;
DELETE FROM reservation;
DELETE FROM tarification;
DELETE FROM typevehicule;
DELETE FROM utilisateur;
DELETE FROM vehicule;

ALTER TABLE vehicule AUTO_INCREMENT = 1;
/* INSERTION DES TABLES */

INSERT INTO entrepot (rue, codePostal, ville, region, pays) VALUES
('Rue de Meylan 1', '38240', 'Meylan', 'Auvergne-Rhône-Alpes', 'France');

INSERT INTO agences (nom, rue, codePostal, ville, region, pays, telephone, fkIdEntrepot) VALUES
('Agence Lyon', 'Rue de Lyon 1', '69000', 'Lyon', 'Auvergne-Rhône-Alpes', 'France', '0101010101', 1),
('Agence Grenoble', 'Rue de Grenoble 1', '38000', 'Grenoble', 'Auvergne-Rhône-Alpes', 'France', '0101010101', 1),
('Agence Annecy', 'Rue d\'Annecy 1', '74000', 'Annecy', 'Auvergne-Rhône-Alpes', 'France', '0101010101', 1),
('Agence Valence', 'Rue de Valence 1', '26000', 'Valence', 'Auvergne-Rhône-Alpes', 'France', '0101010101', 1);

INSERT INTO tarification (tarifHoraire, tarifDemieJournee, tarifJournee) VALUES
(8.00, 30.00, 40.00),   -- Tarif pour Vélo électrique
(9.00, 32.00, 45.00),   -- Tarif pour VTT électrique
(7.00, 25.00, 35.00),   -- Tarif pour Hoverboard
(7.00, 25.00, 35.00),    -- Tarif pour Trottinette électrique
(10.00, 40.00, 60.00),   -- Tarif pour Gyropode
(8.00, 25.00, 35.00);    -- Tarif pour Skateboard électrique

INSERT INTO typeVehicule (typeVehicule, typeVehiculeImage, fkIdTarif) VALUES
('Vélo électrique urbain', 'image/Velo.jpg', 1),
('VTT électrique', 'image/VTT.jpg', 2),
('Hoverboard', 'image/Hoverboard.jpg', 3),
('Trottinette électrique', 'image/Trottinette.jpg', 4),
('Segway', 'image/Segway.jpg', 5),
('Skateboard électrique', 'image/Skateboard.jpg', 6);

/*
INSERT INTO reservation (dateDebut, dateFin, statut, moyenPaiement, montant, demandeSpeciale, fkIdUtilisateur) VALUES
('2024-09-01 08:00:00', '2024-09-01 18:00:00', 'confirmée', 'Carte Bancaire', 30.00, 'Pas de demande', 1),
('2024-09-02 09:00:00', '2024-09-02 19:00:00', 'en attente', 'Paypal', 25.00, 'Prolongation possible', 2);
*/

/* Ajout de véhicules pour l'Agence Lyon */


/* Ajout de véhicules pour l'Agence Lyon */
/* Ajout de véhicules pour l'Agence Lyon */
INSERT INTO vehicule (statut, fkIdTypeVehicule, fkIdAgence) VALUES
('Disponible', 1, 1), ('Disponible', 1, 1), ('Disponible', 1, 1), ('Disponible', 1, 1), ('Disponible', 1, 1),
('Disponible', 1, 1), ('Disponible', 1, 1), ('Disponible', 1, 1), ('Disponible', 1, 1), ('Disponible', 1, 1),
('Disponible', 2, 1), ('Disponible', 2, 1), ('Disponible', 2, 1), ('Disponible', 2, 1), ('Disponible', 2, 1),
('Disponible', 2, 1), ('Disponible', 2, 1), ('Disponible', 2, 1), ('Disponible', 2, 1), ('Disponible', 2, 1),
('Disponible', 3, 1), ('Disponible', 3, 1), ('Disponible', 3, 1), ('Disponible', 3, 1), ('Disponible', 3, 1),
('Disponible', 3, 1), ('Disponible', 3, 1), ('Disponible', 3, 1), ('Disponible', 3, 1), ('Disponible', 3, 1),
('Disponible', 4, 1), ('Disponible', 4, 1), ('Disponible', 4, 1), ('Disponible', 4, 1), ('Disponible', 4, 1),
('Disponible', 4, 1), ('Disponible', 4, 1), ('Disponible', 4, 1), ('Disponible', 4, 1), ('Disponible', 4, 1),
('Disponible', 5, 1), ('Disponible', 5, 1), ('Disponible', 5, 1), ('Disponible', 5, 1), ('Disponible', 5, 1),
('Disponible', 5, 1), ('Disponible', 5, 1), ('Disponible', 5, 1), ('Disponible', 5, 1), ('Disponible', 5, 1),
('Disponible', 6, 1), ('Disponible', 6, 1), ('Disponible', 6, 1), ('Disponible', 6, 1), ('Disponible', 6, 1),
('Disponible', 6, 1), ('Disponible', 6, 1), ('Disponible', 6, 1), ('Disponible', 6, 1), ('Disponible', 6, 1);

/* Ajout de véhicules pour l'Agence Grenoble */
INSERT INTO vehicule (statut, fkIdTypeVehicule, fkIdAgence) VALUES
('Disponible', 1, 2), ('Disponible', 1, 2), ('Disponible', 1, 2), ('Disponible', 1, 2), ('Disponible', 1, 2),
('Disponible', 1, 2), ('Disponible', 1, 2), ('Disponible', 1, 2), ('Disponible', 1, 2), ('Disponible', 1, 2),
('Disponible', 2, 2), ('Disponible', 2, 2), ('Disponible', 2, 2), ('Disponible', 2, 2), ('Disponible', 2, 2),
('Disponible', 2, 2), ('Disponible', 2, 2), ('Disponible', 2, 2), ('Disponible', 2, 2), ('Disponible', 2, 2),
('Disponible', 3, 2), ('Disponible', 3, 2), ('Disponible', 3, 2), ('Disponible', 3, 2), ('Disponible', 3, 2),
('Disponible', 3, 2), ('Disponible', 3, 2), ('Disponible', 3, 2), ('Disponible', 3, 2), ('Disponible', 3, 2),
('Disponible', 4, 2), ('Disponible', 4, 2), ('Disponible', 4, 2), ('Disponible', 4, 2), ('Disponible', 4, 2),
('Disponible', 4, 2), ('Disponible', 4, 2), ('Disponible', 4, 2), ('Disponible', 4, 2), ('Disponible', 4, 2),
('Disponible', 5, 2), ('Disponible', 5, 2), ('Disponible', 5, 2), ('Disponible', 5, 2), ('Disponible', 5, 2),
('Disponible', 5, 2), ('Disponible', 5, 2), ('Disponible', 5, 2), ('Disponible', 5, 2), ('Disponible', 5, 2),
('Disponible', 6, 2), ('Disponible', 6, 2), ('Disponible', 6, 2), ('Disponible', 6, 2), ('Disponible', 6, 2),
('Disponible', 6, 2), ('Disponible', 6, 2), ('Disponible', 6, 2), ('Disponible', 6, 2), ('Disponible', 6, 2);

/* Ajout de véhicules pour l'Agence Annecy */
INSERT INTO vehicule (statut, fkIdTypeVehicule, fkIdAgence) VALUES
('Disponible', 1, 3), ('Disponible', 1, 3), ('Disponible', 1, 3), ('Disponible', 1, 3), ('Disponible', 1, 3),
('Disponible', 1, 3), ('Disponible', 1, 3), ('Disponible', 1, 3), ('Disponible', 1, 3), ('Disponible', 1, 3),
('Disponible', 2, 3), ('Disponible', 2, 3), ('Disponible', 2, 3), ('Disponible', 2, 3), ('Disponible', 2, 3),
('Disponible', 2, 3), ('Disponible', 2, 3), ('Disponible', 2, 3), ('Disponible', 2, 3), ('Disponible', 2, 3),
('Disponible', 3, 3), ('Disponible', 3, 3), ('Disponible', 3, 3), ('Disponible', 3, 3), ('Disponible', 3, 3),
('Disponible', 3, 3), ('Disponible', 3, 3), ('Disponible', 3, 3), ('Disponible', 3, 3), ('Disponible', 3, 3),
('Disponible', 4, 3), ('Disponible', 4, 3), ('Disponible', 4, 3), ('Disponible', 4, 3), ('Disponible', 4, 3),
('Disponible', 4, 3), ('Disponible', 4, 3), ('Disponible', 4, 3), ('Disponible', 4, 3), ('Disponible', 4, 3),
('Disponible', 5, 3), ('Disponible', 5, 3), ('Disponible', 5, 3), ('Disponible', 5, 3), ('Disponible', 5, 3),
('Disponible', 5, 3), ('Disponible', 5, 3), ('Disponible', 5, 3), ('Disponible', 5, 3), ('Disponible', 5, 3),
('Disponible', 6, 3), ('Disponible', 6, 3), ('Disponible', 6, 3), ('Disponible', 6, 3), ('Disponible', 6, 3),
('Disponible', 6, 3), ('Disponible', 6, 3), ('Disponible', 6, 3), ('Disponible', 6, 3), ('Disponible', 6, 3);

/* Ajout de véhicules pour l'Agence Valence */
INSERT INTO vehicule (statut, fkIdTypeVehicule, fkIdAgence) VALUES
('Disponible', 1, 4), ('Disponible', 1, 4), ('Disponible', 1, 4), ('Disponible', 1, 4), ('Disponible', 1, 4),
('Disponible', 1, 4), ('Disponible', 1, 4), ('Disponible', 1, 4), ('Disponible', 1, 4), ('Disponible', 1, 4),
('Disponible', 2, 4), ('Disponible', 2, 4), ('Disponible', 2, 4), ('Disponible', 2, 4), ('Disponible', 2, 4),
('Disponible', 2, 4), ('Disponible', 2, 4), ('Disponible', 2, 4), ('Disponible', 2, 4), ('Disponible', 2, 4),
('Disponible', 3, 4), ('Disponible', 3, 4), ('Disponible', 3, 4), ('Disponible', 3, 4), ('Disponible', 3, 4),
('Disponible', 3, 4), ('Disponible', 3, 4), ('Disponible', 3, 4), ('Disponible', 3, 4), ('Disponible', 3, 4),
('Disponible', 4, 4), ('Disponible', 4, 4), ('Disponible', 4, 4), ('Disponible', 4, 4), ('Disponible', 4, 4),
('Disponible', 4, 4), ('Disponible', 4, 4), ('Disponible', 4, 4), ('Disponible', 4, 4), ('Disponible', 4, 4),
('Disponible', 5, 4), ('Disponible', 5, 4), ('Disponible', 5, 4), ('Disponible', 5, 4), ('Disponible', 5, 4),
('Disponible', 5, 4), ('Disponible', 5, 4), ('Disponible', 5, 4), ('Disponible', 5, 4), ('Disponible', 5, 4),
('Disponible', 6, 4), ('Disponible', 6, 4), ('Disponible', 6, 4), ('Disponible', 6, 4), ('Disponible', 6, 4),
('Disponible', 6, 4), ('Disponible', 6, 4), ('Disponible', 6, 4), ('Disponible', 6, 4), ('Disponible', 6, 4);




SELECT * FROM agences;
SELECT * FROM entrepot;
SELECT * FROM incident;
SELECT * FROM participant;
SELECT * FROM reservation;
SELECT * FROM tarification;
SELECT * FROM typevehicule;
SELECT * FROM utilisateur;
SELECT * FROM vehicule;

SELECT * FROM vehicule where statut != "Disponible";

UPDATE utilisateur
SET role = 'admin'
WHERE idUtilisateur = 1;

SELECT 
    r.*,
    a.nom AS nomAgence
FROM 
    reservation r
JOIN 
    participant p ON r.idReservation = p.fkIdReservation
JOIN 
    vehicule v ON p.fkIdVehicule = v.idVehicule
JOIN 
    agences a ON v.fkIdAgence = a.idAgence
GROUP BY 
    r.idReservation;


