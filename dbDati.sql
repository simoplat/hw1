-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.32-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database hw1
CREATE DATABASE IF NOT EXISTS `hw1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `hw1`;

-- Dump della struttura di tabella hw1.commenti
CREATE TABLE IF NOT EXISTS `commenti` (
  `id_commento` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_autore` int(11) NOT NULL,
  `testo` text NOT NULL,
  PRIMARY KEY (`id_commento`),
  KEY `id_post` (`id_post`),
  KEY `id_autore` (`id_autore`),
  CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`id_autore`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw1.commenti: ~45 rows (circa)
INSERT INTO `commenti` (`id_commento`, `id_post`, `id_autore`, `testo`) VALUES
	(1, 2, 4, 'BEL POST! Continua cosi'),
	(2, 2, 1, 'BRAVOOO'),
	(3, 2, 4, 'Mi iscrivo al tuo Canale!'),
	(4, 1, 6, 'Bellisima città Londra!'),
	(5, 1, 4, 'Funzionano i Commenti'),
	(6, 1, 6, 'EVviva, voglio andarae a Londra Presto!\r\n'),
	(7, 1, 1, 'Articolo molto interessante, grazie!'),
	(8, 1, 2, 'Non sapevo queste cose, molto utile.'),
	(9, 1, 3, 'Ottimo lavoro, continua così!'),
	(10, 2, 6, 'Aspetto il prossimo post!'),
	(11, 2, 1, 'Hai spiegato tutto benissimo.'),
	(12, 5, 2, 'Molto chiaro, complimenti.'),
	(13, 3, 3, 'Un punto di vista originale.'),
	(14, 3, 4, 'Mi hai fatto riflettere.'),
	(15, 3, 1, 'Questo argomento mi interessa molto.'),
	(17, 1, 1, 'Articolo molto interessante, grazie!'),
	(18, 1, 2, 'Non sapevo queste cose, molto utile.'),
	(19, 1, 3, 'Ottimo lavoro, continua così!'),
	(20, 2, 4, 'Aspetto il prossimo post!'),
	(21, 2, 1, 'Hai spiegato tutto benissimo.'),
	(22, 2, 2, 'Molto chiaro, complimenti.'),
	(23, 3, 3, 'Un punto di vista originale.'),
	(24, 3, 4, 'Mi hai fatto riflettere.'),
	(25, 3, 1, 'Questo argomento mi interessa molto.'),
	(26, 5, 2, 'Davvero ben scritto!'),
	(27, 4, 3, 'Ci voleva un post così!'),
	(28, 4, 4, 'Grazie per aver condiviso.'),
	(29, 1, 1, 'Molto utile anche per chi è alle prime armi.'),
	(30, 2, 2, 'Bravo, continua così.'),
	(31, 3, 3, 'Contenuto ben strutturato.'),
	(32, 4, 4, 'Una lettura piacevole.'),
	(33, 1, 2, 'Condivido pienamente quanto scritto.'),
	(34, 2, 3, 'Aspetto altri articoli del genere.'),
	(35, 3, 4, 'Hai centrato il punto perfettamente.'),
	(36, 4, 1, 'Un ottimo spunto per approfondire.'),
	(37, 1, 4, 'HAi ragione!\r\n'),
	(38, 1, 10, 'Scrivo un commento!!'),
	(39, 12, 4, 'Bella Twin Peaks!'),
	(40, 2, 4, 'ciaoooo\r\n'),
	(41, 24, 4, 'Ottimo\r\n'),
	(42, 24, 4, 'Ottimo\r\n'),
	(43, 24, 4, 'Ottimo\r\n'),
	(44, 22, 4, 'buono!'),
	(45, 24, 4, 'graziee :)\r\n'),
	(46, 15, 4, 'Mi piace tanto'),
	(47, 14, 4, 'Bellla la nuvoa 5090!'),
	(48, 25, 4, '25'),
	(49, 25, 4, '25'),
	(50, 25, 4, '25'),
	(51, 25, 4, ''),
	(52, 5, 4, 'Bel libro'),
	(53, 3, 4, 'Nuovo commento'),
	(54, 25, 4, 'Molto utile'),
	(55, 20, 4, 'Mi è piaciuto il panino con la mortadella'),
	(56, 20, 4, 'ci vorrei andare'),
	(57, 21, 4, 'AMD!');

-- Dump della struttura di tabella hw1.immaginiutente
CREATE TABLE IF NOT EXISTS `immaginiutente` (
  `id_utente` int(11) NOT NULL,
  `immagine_profilo` varchar(255) DEFAULT 'Content/profile/Portrait_Placeholder.jpg',
  `immagine_copertina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_utente`),
  CONSTRAINT `immaginiutente_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw1.immaginiutente: ~6 rows (circa)
INSERT INTO `immaginiutente` (`id_utente`, `immagine_profilo`, `immagine_copertina`) VALUES
	(1, 'Content/profile/pf1.jpg', 'Content/profile/pf1Background.jpg'),
	(2, 'Content/profile/pf2.jpg', 'Content/profile/pf1Background.jpg'),
	(3, 'Content/profile/pf3.jpg', 'Content/profile/pf1Background.jpg'),
	(4, 'Content/profile/pf1.jpg', 'Content/profile/pf1Background.jpg'),
	(5, 'Content/profile/pf2.jpg', 'Content/profile/pf1Background.jpg'),
	(8, 'Content/profile/pf1.jpg', 'Content/profile/pf1Background.jpg'),
	(10, 'Content/profile/pf3.jpg', 'Content/profile/pf1Background.jpg');

-- Dump della struttura di tabella hw1.iscrizione
CREATE TABLE IF NOT EXISTS `iscrizione` (
  `follower_id` int(11) NOT NULL,
  `seguito_id` int(11) NOT NULL,
  PRIMARY KEY (`follower_id`,`seguito_id`),
  KEY `seguito_id` (`seguito_id`),
  CONSTRAINT `iscrizione_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
  CONSTRAINT `iscrizione_ibfk_2` FOREIGN KEY (`seguito_id`) REFERENCES `users` (`id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`follower_id` <> `seguito_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw1.iscrizione: ~16 rows (circa)
INSERT INTO `iscrizione` (`follower_id`, `seguito_id`) VALUES
	(1, 2),
	(1, 3),
	(1, 4),
	(2, 3),
	(3, 1),
	(4, 1),
	(4, 2),
	(4, 3),
	(4, 5),
	(4, 6),
	(4, 7),
	(4, 8),
	(7, 1),
	(7, 2),
	(7, 4),
	(8, 4),
	(10, 1);

-- Dump della struttura di tabella hw1.post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_autore` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `contenuto` text NOT NULL,
  `percorsoMedia` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_autore` (`id_autore`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_autore`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw1.post: ~22 rows (circa)
INSERT INTO `post` (`id_post`, `id_autore`, `title`, `contenuto`, `percorsoMedia`, `categoria`) VALUES
	(1, 1, 'VIAGGIO a Londra', 'Appena tornati da Londra e siamo ancora pieni di emozioni! 🇬🇧\nTra pioggia leggera e cieli grigi, la città ha un fascino unico.\nAbbiamo camminato lungo il Tamigi,\nsalutato il Big Ben e fatto shopping a Camden.\nI pub storici, i musei gratuiti e i parchi immensi ci hanno conquistati.\nLa vista dalla London Eye è qualcosa che non si dimentica. 🎡\nOgni quartiere ha la sua anima, dal classico Notting Hill al moderno Shoreditch.\nAbbiamo assaggiato di tutto, dal fish & chips al curry più piccante.\nLondra è un mix perfetto tra storia e innovazione.\nPresto vi raccontiamo tutto per bene — stay tuned! 🖤', 'Content/background/Londra.jpg', 'Viaggi'),
	(2, 1, 'COSA Fare a New YORK?', 'Appena tornati da un\'avventura incredibile a New York! 🗽\nAbbiamo camminato tra i grattacieli di Manhattan,\nassaporato street food a Brooklyn e respirato arte al MoMA.\nCentral Park in autunno è pura magia,\nmentre le luci di Times Square tolgono il fiato ogni volta. ✨\nAbbiamo scoperto angoli meno turistici e vissuto la città come veri newyorkesi.\nOgni quartiere ha un’anima diversa e unica.\nNon vediamo l’ora di raccontarvi tutto,\ncondividere foto, consigli e qualche sorpresa.\nLa Grande Mela ci ha davvero conquistati! 🍎', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Viaggi'),
	(3, 4, 'PLATAX post 3, autore 4', 'Qui scivero un testo molto lungo in cui diro cosa si fa a new yotk', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Viaggi'),
	(4, 1, 'POst di prova', 'Non so che scrivere.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Viaggi'),
	(5, 2, 'Libri da leggere', 'Ultimamente mi sono perso tra le pagine di storie incredibili. 📚\nCi sono libri che ti tengono sveglio la notte e altri che ti restano dentro per sempre.\nHo riscoperto il piacere di leggere senza fretta, solo per il gusto di farlo.\nNarrativa, saggistica, classici e novità: c’è un mondo intero tra le righe.\nAlcune pagine sembrano scritte proprio per te, altre ti aprono gli occhi su cose nuove.\nOgni libro è un viaggio, anche se non ti muovi dal divano.\nSto preparando una selezione dei miei preferiti da consigliare.\nSpoiler: ce n’è uno che mi ha davvero cambiato il punto di vista.\nPresto ve ne parlo meglio, magari con qualche citazione memorabile.\nE voi, cosa state leggendo in questo periodo? 📖✨', 'Content/background/libri.jpg', 'Lettura'),
	(6, 1, 'Viaggio in Islanda', 'Esperienza indimenticabile tra geyser e cascate.', 'Content/background/Londra.jpg', 'Viaggi'),
	(7, 2, 'Recensione MacBook M3', 'Analisi dettagliata delle performance.', 'Content/background/Intelligenza-Artificiale.jpeg', 'Tecnologia'),
	(8, 3, 'Pasta fatta in casa', 'La mia ricetta della nonna.', 'Content/background/Londra.jpg', 'Cucina'),
	(10, 6, 'Python vs JavaScript', 'Confronto tra i due linguaggi.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Programmazione'),
	(11, 7, 'Arte digitale con Procreate', 'Tutorial base per principianti.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Design'),
	(12, 8, 'Fotografia notturna', 'Come catturare le stelle.', 'Content/background/Londra.jpg', 'Fotografia'),
	(13, 1, 'Cose da fare a Roma', 'Itinerario di 3 giorni.', 'Content/background/Londra.jpg', 'Viaggi'),
	(14, 2, 'Gadget tech 2025', 'I migliori accessori smart.', 'Content/background/videogame.jpg', 'Tecnologia'),
	(15, 3, 'Pane fatto in casa', 'Con pochi ingredienti, tanto gusto.', '', 'Cucina'),
	(17, 6, 'Come usare Git', 'Comandi base e flusso di lavoro.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Programmazione'),
	(18, 7, 'Moodboard per grafici', 'Strumenti utili per il design.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Design'),
	(19, 8, 'Scatti urbani', 'Come raccontare una città con la fotografia.', 'Content/background/Londra.jpg', 'Fotografia'),
	(20, 1, 'Weekend in Toscana', 'Vino, colline e relax.', 'Content/background/Londra.jpg', 'Viaggi'),
	(21, 2, 'Intel vs AMD', 'Qual è meglio nel 2025?', 'Content/background/videogame.jpg', 'Tecnologia'),
	(22, 3, 'Tiramisù classico', 'Dolce tradizionale italiano.', 'Content/background/Intelligenza-Artificiale.jpeg', 'Cucina'),
	(24, 6, 'API REST explained', 'Architettura e best practices.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Programmazione'),
	(25, 7, 'Creare un logo efficace', 'Cosa considerare nel design.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Design');

-- Dump della struttura di tabella hw1.preferiti
CREATE TABLE IF NOT EXISTS `preferiti` (
  `id_utente` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_utente`,`id_post`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw1.preferiti: ~8 rows (circa)
INSERT INTO `preferiti` (`id_utente`, `id_post`) VALUES
	(1, 3),
	(4, 2),
	(4, 3),
	(4, 6),
	(4, 7),
	(4, 20),
	(4, 21),
	(4, 24),
	(4, 25);

-- Dump della struttura di tabella hw1.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw1.users: ~9 rows (circa)
INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`) VALUES
	(1, 'pippo', '$2y$10$e1A7ohI6L0vohc0Ll8qwQOPZIa86nwy/WKscSVDVz5HLBSAdCytJW', 'sdadsadas@gmail.com', 'Pippo', 'Rossi'),
	(2, 'pluto', '$2y$10$tBYnG6t9CT6LeEMRbrYXD.h9h.TXR3rHnKTT4HmvCbRfAYsseCSC.', 'saddas@gmail.com', 'PLUTO', 'BIANCHI'),
	(3, 'paperino', '$2y$10$Vty5Tvzd7N/XjbdfEDfGH.0OYPTdgMZ8qH0TWibV2dyqYNCgq5zwe', 'sjdsijdsa@gmail.com', 'Paolino Giuseppino', 'Paperino'),
	(4, 'platax', '$2y$10$GinOfS5rNPgiXPvizIc2WullzbT.CD6lZY5J8l9RFy3C8AtBRrVnu', 'dasasd@studium.unict.it', 'Simone', 'Platania'),
	(5, 'alice', 'hashed_password_1', 'alice@example.com', 'Alice', 'Rossi'),
	(6, 'bob', 'hashed_password_2', 'bob@example.com', 'Bob', 'Verdi'),
	(7, 'carla', 'hashed_password_3', 'carla@example.com', 'Carla', 'Bianchi'),
	(8, 'agentCooper', 'hashed_password_4', 'dave@example.com', 'Dale', 'Cooper'),
	(10, 'platax2', '$2y$10$GinOfS5rNPgiXPvizIc2WullzbT.CD6lZY5J8l9RFy3C8AtBRrVnu', 'dsd@studium.unict.it', 'Simone', 'messina'),
	(11, 'bobbybrigs', '$2y$10$LGpKZRBo.3A8GPkA/6DgLedLz14Ao7xie69PsGYrRQqOoNry.gpoy', 'brobbdybrg@email.com', 'bobby', 'Briggs'),
	(12, 'mario88', '$2y$10$lq8PfWfb4Qm/70eeOy72muTPRqOfN6QF7MV6n73XfLhDEqbzljmM.', 'supermario@live.it', 'mario', 'mario');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
