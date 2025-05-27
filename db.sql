CREATE DATABASE IF NOT EXISTS hw1;
USE hw1;

CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(16) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255) NOT NULL,
    surname VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS Post (
    id_post INT PRIMARY KEY AUTO_INCREMENT,
    id_autore INT NOT NULL,
    title VARCHAR(255),
    contenuto TEXT NOT NULL,
    percorsoMedia VARCHAR(255),
    categoria VARCHAR(255),
    FOREIGN KEY (id_autore) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS Iscrizione (
    follower_id INT,
    seguito_id INT,
    PRIMARY KEY (follower_id, seguito_id),
    FOREIGN KEY (follower_id) REFERENCES users(id),
    FOREIGN KEY (seguito_id) REFERENCES users(id),
    CHECK (follower_id <> seguito_id)
);


CREATE TABLE IF NOT EXISTS ImmaginiUtente (
    id_utente INT PRIMARY KEY,
    immagine_profilo VARCHAR(255),
    immagine_copertina VARCHAR(255),
    FOREIGN KEY (id_utente) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS Commenti (
    id_commento INT PRIMARY KEY AUTO_INCREMENT,
    id_post INT NOT NULL,
    id_autore INT NOT NULL,
    testo TEXT NOT NULL,
    FOREIGN KEY (id_post) REFERENCES Post(id_post),
    FOREIGN KEY (id_autore) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS Categorie (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL UNIQUE
);

