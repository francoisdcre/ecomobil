DROP DATABASE IF EXISTS ecoMobil;
CREATE DATABASE ecoMobil;
use ecoMobil;


SET default_storage_engine=INNODB;
SET autocommit = 1;
SET SQL_SAFE_UPDATES = 0;

/* CREATION DE TABLE */

CREATE TABLE tarification (
	idTarif INT PRIMARY KEY AUTO_INCREMENT,
    tarifHoraire DECIMAL(4.2) NOT NULL,
    tarifDemieJournee DECIMAL(4.2) NOT NULL,
    tarifJournee DECIMAL(4.2) NOT NULL
);

CREATE TABLE typeVehicule (
	idTypeVehicule INT PRIMARY KEY AUTO_INCREMENT,
    typeVehicule VARCHAR(50),
	typeVehiculeImage CHAR(50),
    fkIdTarif INT,
    FOREIGN KEY (fkIdTarif) REFERENCES tarification(idTarif)
);

CREATE TABLE entrepot (
	idEntrepot INT PRIMARY KEY AUTO_INCREMENT,
    rue VARCHAR(100),
    codePostal CHAR(5),
    ville VARCHAR(50),
    region VARCHAR(50),
    pays VARCHAR(50)
);

CREATE TABLE agences (
	idAgence INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
	rue VARCHAR(100),
    codePostal CHAR(5),
    ville VARCHAR(50),
    region VARCHAR(50),
    pays VARCHAR(50),
    telephone CHAR(10),
    fkIdEntrepot INT,
    FOREIGN KEY (fkIdEntrepot) REFERENCES entrepot(idEntrepot)
);

CREATE TABLE vehicule (
	idVehicule INT PRIMARY KEY AUTO_INCREMENT,
    statut ENUM('Disponible', 'Réservé', 'En réparation'),
    fkIdTypeVehicule INT,
    fkIdAgence INT,
    FOREIGN KEY (fkIdTypeVehicule) REFERENCES typeVehicule(idTypeVehicule),
    FOREIGN KEY (fkIdAgence) REFERENCES agences(idAgence)
);

CREATE TABLE utilisateur(
	idUtilisateur INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(320) UNIQUE,
    motDePasse VARCHAR(255),
    nom VARCHAR(50),
    prenom VARCHAR(50),
    telephone CHAR(10),
	rue VARCHAR(100),
    codePostal CHAR(5),
    ville VARCHAR(50),
    region VARCHAR(50),
    pays VARCHAR(50),
    role ENUM('user', 'admin')
);

CREATE TABLE reservation (
	idReservation INT PRIMARY KEY AUTO_INCREMENT,
    dateDebut TIMESTAMP,
    dateFin TIMESTAMP,
	statut ENUM('En cours', 'Terminée', 'Annulée'),
    montant DECIMAL(4.2) NOT NULL,
    demandeSpeciale VARCHAR(255),
    moyenPaiement ENUM ('Carte Bancaire', 'PayPal', 'Espèce', 'Chèque Vacances'),
    fkIdUtilisateur INT,
    FOREIGN KEY (fkIdUtilisateur) REFERENCES utilisateur(idUtilisateur)
);

CREATE TABLE participant (
	idParticipant INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(320),
    fkIdVehicule INT,
    fkIdReservation INT,
    FOREIGN KEY (fkIdVehicule) REFERENCES vehicule(idVehicule),
    FOREIGN KEY (fkIdReservation) REFERENCES reservation(idReservation)
);

CREATE TABLE incident (
	idIncident INT PRIMARY KEY AUTO_INCREMENT,
    incident ENUM('panne', 'vol', 'sinistre'),
    fkIdVehicule INT,
    fkIdReservation INT,
    FOREIGN KEY (fkIdVehicule) REFERENCES vehicule(idVehicule),
    FOREIGN KEY (fkIdReservation) REFERENCES reservation(idReservation)
);

/* FIN CREATION TABLE */