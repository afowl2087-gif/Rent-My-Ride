CREATE DATABASE RentMyRide;
USE RentMyRide;

CREATE TABLE users(
   Id_users INT AUTO_INCREMENT,
   nom VARCHAR(100) ,
   prenom VARCHAR(50) ,
   email VARCHAR(255) ,
   telephone CHAR(12) ,
   mot_de_passe VARCHAR(255) ,
   role BOOLEAN,
   PRIMARY KEY(Id_users)
);

CREATE TABLE categories(
   Id_categories INT AUTO_INCREMENT,
   nom_categorie VARCHAR(50) ,
   PRIMARY KEY(Id_categories)
);

CREATE TABLE vehicules(
   Id_vehicules INT AUTO_INCREMENT,
   marque VARCHAR(50) ,
   model VARCHAR(100) ,
   description VARCHAR(1000) ,
   nom VARCHAR(100) ,
   prix DECIMAL(5,2)  ,
   disponibilite BOOLEAN,
   Id_categories INT NOT NULL,
   PRIMARY KEY(Id_vehicules),
   FOREIGN KEY(Id_categories) REFERENCES categories(Id_categories)
);

CREATE TABLE reservations(
   Id_reservations INT AUTO_INCREMENT,
   date_debut DATE,
   date_fin DATE,
   statut VARCHAR(30) ,
   Id_vehicules INT NOT NULL,
   Id_users INT NOT NULL,
   PRIMARY KEY(Id_reservations),
   FOREIGN KEY(Id_vehicules) REFERENCES vehicules(Id_vehicules),
   FOREIGN KEY(Id_users) REFERENCES users(Id_users)
);

INSERT INTO categories (nom_categorie) VALUES
('SUV'),
('Berline'),
('Citadine'),
('Sport'),
('Utilitaire');

INSERT INTO vehicules (marque, model, description, nom, prix, disponibilite, Id_categories) VALUES

('BMW', 'X5', 'SUV premium puissant et confortable pour longs trajets.', 'BMW X5', 120.00, 1, 1),
('Audi', 'Q7', 'SUV spacieux avec finitions haut de gamme.', 'Audi Q7', 130.00, 1, 1),

('Mercedes', 'Classe E', 'Berline élégante et très confortable.', 'Mercedes Classe E', 95.00, 1, 2),
('Tesla', 'Model S', 'Berline électrique performante et innovante.', 'Tesla Model S', 150.00, 1, 2),

('Renault', 'Clio V', 'Citadine économique idéale pour la ville.', 'Renault Clio V', 45.00, 1, 3),
('Peugeot', '208', 'Petite voiture pratique et facile à conduire.', 'Peugeot 208', 50.00, 1, 3),

('Porsche', '911 Carrera', 'Voiture sport emblématique très performante.', 'Porsche 911', 250.00, 1, 4),
('BMW', 'M4', 'Coupé sportif puissant et précis.', 'BMW M4', 220.00, 1, 4),

('Renault', 'Kangoo', 'Utilitaire pratique pour transport et travail.', 'Renault Kangoo', 60.00, 1, 5),
('Ford', 'Transit', 'Fourgon utilitaire grand volume.', 'Ford Transit', 80.00, 1, 5); 

INSERT INTO users (nom, prenom, email, telephone, mot_de_passe, role) VALUES

('Dupont', 'Jean', 'jean.dupont@mail.com', '0612345678', 'password123', 0),
('Martin', 'Sophie', 'sophie.martin@mail.com', '0623456789', 'password123', 0),
('Bernard', 'Lucas', 'lucas.bernard@mail.com', '0634567890', 'password123', 0),
('Lefevre', 'Emma', 'emma.lefevre@mail.com', '0645678901', 'password123', 0),
('Moreau', 'Hugo', 'hugo.moreau@mail.com', '0656789012', 'password123', 0),
('Admin', 'Root', 'admin@rentmyride.com', '0600000000', 'admin123', 1);

INSERT INTO reservations (date_debut, date_fin, statut, Id_vehicules, Id_users) VALUES

('2025-06-10', '2025-06-15', 'confirmée', 1, 1),
('2025-06-12', '2025-06-18', 'en attente', 2, 2),
('2025-06-15', '2025-06-20', 'confirmée', 3, 3),
('2025-06-20', '2025-06-25', 'annulée', 4, 4),
('2025-06-22', '2025-06-28', 'confirmée', 5, 5),
('2025-06-25', '2025-06-30', 'en attente', 6, 1),
('2025-07-01', '2025-07-05', 'confirmée', 7, 2),
('2025-07-03', '2025-07-10', 'en attente', 8, 3),
('2025-07-05', '2025-07-12', 'confirmée', 9, 4),
('2025-07-08', '2025-07-15', 'confirmée', 10, 5);