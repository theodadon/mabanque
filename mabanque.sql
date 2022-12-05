-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : dim. 04 déc. 2022 à 22:19
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mabanque`
--

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

CREATE TABLE `banque` (
  `id_banque` int(11) NOT NULL,
  `nom_banque` varchar(50) NOT NULL,
  `adresse_banque` varchar(100) NOT NULL,
  `code_postal_banque` varchar(10) NOT NULL,
  `ville_banque` varchar(50) NOT NULL,
  `telephone_banque` varchar(20) NOT NULL,
  `email_banque` varchar(50) NOT NULL,
  `id_inter_banque` int(11) NOT NULL,
  `guichet_banque` int(11) NOT NULL,
  `bic_banque` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`id_banque`, `nom_banque`, `adresse_banque`, `code_postal_banque`, `ville_banque`, `telephone_banque`, `email_banque`, `id_inter_banque`, `guichet_banque`, `bic_banque`) VALUES
(1, 'BNP Paribas', '3 rue de la paix', '59560', 'Comines', '0320202020', 'fakebanque@gmail.com', 10280, 3727, 'CMCCFR2Z');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_client` varchar(255) NOT NULL,
  `prenom_client` varchar(255) NOT NULL,
  `adresse_client` varchar(255) NOT NULL,
  `code_postal_client` varchar(255) NOT NULL,
  `ville_client` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_client`, `prenom_client`, `adresse_client`, `code_postal_client`, `ville_client`) VALUES
(1, 'DADON', 'Théo', '1 rue de la paix', '59560', 'Comines'),
(2, 'DUVIVIER', 'Sacha', '2 rue de la paix', '59560', 'Comines'),
(3, 'PNB', 'PARIBAS', 'La banque', '0', 'Elle meme');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_compte` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_banque` int(11) NOT NULL,
  `email_compte` varchar(255) DEFAULT NULL UNIQUE,
  `telephone_compte` varchar(255) DEFAULT NULL,
  `numero_compte` varchar(255) DEFAULT NULL,
  `solde_compte` decimal(10,2) DEFAULT NULL,
  `date_ouverture_compte` date NOT NULL,
  `date_fermeture_compte` date DEFAULT NULL,
  `mot_de_passe_compte` varchar(255) NOT NULL,
  `cle_compte` int(11) DEFAULT NULL,
  `iban_compte` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id_compte`, `id_client`, `id_banque`, `email_compte`, `telephone_compte`, `numero_compte`, `solde_compte`, `date_ouverture_compte`, `date_fermeture_compte`, `mot_de_passe_compte`, `cle_compte`, `iban_compte`) VALUES
(1, 1, 1, '[email]', '0320202020', '54004714751', '1000.00', '2020-01-01', NULL, 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 32, 'FR1028037275400471475132'),
(2, 2, 1, '[email]', '0320202020', '55411054064', '1000.00', '2020-01-01', NULL, 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 34, 'FR1028037275541105406434'),
(3, 3, 1, 'fakebanque@fake.com', NULL, NULL, '80900.00', '2000-01-01', NULL, 'd404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db', NULL, 'FR76 0101 0101');

-- --------------------------------------------------------

--
-- Structure de la table `mouvement`
--

CREATE TABLE `mouvement` (
  `id_mouvement` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `ancien_solde` int(11) DEFAULT NULL,
  `nouveau_solde` int(11) DEFAULT NULL,
  `date_mouvement` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `mouvement`
--

INSERT INTO `mouvement` (`id_mouvement`, `id_client`, `ancien_solde`, `nouveau_solde`, `date_mouvement`) VALUES
(1, 2, 1000, 700, '2022-12-04 20:04:18'),
(2, 1, 1000, 1300, '2022-12-04 20:04:18'),
(3, 1, 1300, 1000, '2022-12-04 20:04:52'),
(4, 2, 700, 1000, '2022-12-04 20:04:52');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `id_compte_emetteur` int(11) NOT NULL,
  `id_compte_recepteur` int(11) NOT NULL,
  `montant_transaction` decimal(10,2) NOT NULL,
  `date_transaction` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_compte_emetteur`, `id_compte_recepteur`, `montant_transaction`, `date_transaction`) VALUES
(1, 2, 1, '300.00', '2022-12-04 20:04:18'),
(2, 1, 2, '300.00', '2022-12-04 20:04:52');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `banque`
--
ALTER TABLE `banque`
  ADD PRIMARY KEY (`id_banque`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_banque` (`id_banque`);

--
-- Index pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD PRIMARY KEY (`id_mouvement`),
  ADD KEY `id_client` (`id_client`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_compte_emetteur` (`id_compte_emetteur`),
  ADD KEY `id_compte_recepteur` (`id_compte_recepteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `banque`
--
ALTER TABLE `banque`
  MODIFY `id_banque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `mouvement`
--
ALTER TABLE `mouvement`
  MODIFY `id_mouvement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `compte`
  ADD CONSTRAINT `compte_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `compte_ibfk_2` FOREIGN KEY (`id_banque`) REFERENCES `banque` (`id_banque`);

--
-- Contraintes pour la table `mouvement`
--
ALTER TABLE `mouvement`
  ADD CONSTRAINT `mouvement_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_compte_emetteur`) REFERENCES `compte` (`id_compte`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_compte_recepteur`) REFERENCES `compte` (`id_compte`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
