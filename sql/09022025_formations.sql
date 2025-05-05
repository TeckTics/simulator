CREATE TABLE fonctions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    libelle_fonction VARCHAR(255) NOT NULL,
    code VARCHAR(255) NULL,
    niveau INT NULL,
    description_fonction TEXT,
    fonction_requise BOOLEAN DEFAULT false,
    published BOOLEAN DEFAULT false,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
ALTER TABLE `fonctions` ADD `deleted` TIMESTAMP NULL AFTER `updated_at`;
ALTER TABLE `fonctions` CHANGE `deleted` `deleted_at` TIMESTAMP NULL DEFAULT NULL;
-- ALTER TABLE `fonctions` ADD `niveau` INT NULL AFTER `code`;

-- ALTER TABLE `fonctions` ADD `code` VARCHAR(255) NULL AFTER `libelle_fonction`;

INSERT INTO fonctions (libelle_fonction, code) VALUES ('Stagiaire', 'STAGIAIRE');
INSERT INTO fonctions (libelle_fonction, code) VALUES ('Infirmier', 'INFIRMIER');
INSERT INTO fonctions (libelle_fonction, code) VALUES ('Ambulancier', 'AMBULANCIER');
INSERT INTO fonctions (libelle_fonction, code) VALUES ('Médecin', 'MEDECIN');
INSERT INTO fonctions (libelle_fonction, code) VALUES ('Généraliste', 'GENERALISTE');
INSERT INTO fonctions (libelle_fonction, code) VALUES ('Docteur', 'DOCTEUR');

-- titre_personnel
ALTER TABLE `personnels` ADD `fonction_code` INT NULL AFTER `published`;
ALTER TABLE `personnels` ADD `niveau` INT NULL AFTER `fonction_code`;

ALTER TABLE `formations` ADD `fonction_code` INT NULL AFTER `description_formation`;

-- remove all add insert in personnel table 
INSERT INTO `personnels` (`id`, `description_personnel`, `prix_personnel`, `image`, `published`, `fonction_code`, `niveau`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Conduit une ambulance', 10000, 'assets/icons/AMBULANCIER.png', 1, 'AMBULANCIER', 1, '2024-09-27 10:57:40', '2024-10-27 15:32:37', NULL),
(2, 'Conduit une ambulance', 15000, 'assets/icons/INFIRMIER.png', 1, 'INFIRMIER', 2, '2024-10-22 04:09:53', '2024-10-22 04:09:53', NULL),
(3, 'Une description', 20000, 'assets/icons/DOCTEUR.png', 1, 'DOCTEUR', 9, '2024-10-27 15:24:11', '2024-10-27 15:24:11', NULL),
(4, 'Stagiaire en observation', 5000, 'assets/icons/STAGIAIRE.png', 1, 'STAGIAIRE', 0, '2024-11-15 08:00:00', '2024-11-15 08:00:00', NULL),
(5, 'Médecin urgentiste', 25000, 'assets/icons/MEDECIN.png', 1, 'MEDECIN', 4, '2024-11-15 09:00:00', '2024-11-15 09:00:00', NULL),
(6, 'Médecin généraliste de garde', 18000, 'assets/icons/GENERALISTE.png', 1, 'GENERALISTE', 6, '2024-11-15 10:00:00', '2024-11-15 10:00:00', NULL);


-- formation
-- Step 1: Drop the foreign key constraint
ALTER TABLE formations DROP FOREIGN KEY FK_formations_personnels;

-- Step 2: Drop the column
ALTER TABLE formations DROP COLUMN personnel_id;

-- Step 3: (Optional) Recreate the foreign key constraint if needed
-- ALTER TABLE formations ADD CONSTRAINT FK_formations_personnels FOREIGN KEY (new_column) REFERENCES personnels(id);

