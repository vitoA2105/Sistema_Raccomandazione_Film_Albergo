CREATE DATABASE IF NOT EXISTS movie_recommendation;

USE movie_recommendation;

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE
);

CREATE TABLE IF NOT EXISTS movies (
    movie_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) UNIQUE
);

CREATE TABLE IF NOT EXISTS ratings (
    rating_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    rating FLOAT,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
);

INSERT INTO users (username) VALUES ('Vito'), ('Giuseppe'), ('Salvatore');

INSERT INTO movies (title) VALUES ('Il padrino'), ('Il Cavaliere Oscuro'), ('Scarface'), ('Avengers');

INSERT INTO ratings (user_id, movie_id, rating) VALUES
(1, 1, 4.5), (1, 2, 3.0), (1, 3, 2.5),
(2, 1, 5.0), (2, 2, 3.5), (2, 4, 4.0),
(3, 2, 4.5), (3, 3, 4.0), (3, 4, 2.0);
