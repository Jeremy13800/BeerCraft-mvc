CREATE DATABASE IF NOT EXISTS `BeerCraft`;
USE BeerCraft;

CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM("member", "admin") NOT NULL DEFAULT "member",
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Beer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    origin VARCHAR(100),
    alcohol FLOAT NOT NULL,
    description TEXT,
    image VARCHAR(255),
    average_price DECIMAL(5,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    rating INT CHECK(rating BETWEEN 1 AND 5),
    user_id INT NOT NULL,
    beer_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (beer_id) REFERENCES Beer(id) ON DELETE CASCADE
);

CREATE TABLE Category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Beer_Category (
    beer_id INT NOT NULL,
    category_id INT NOT NULL,
    PRIMARY KEY (beer_id, category_id),
    FOREIGN KEY (beer_id) REFERENCES Beer(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES Category(id) ON DELETE CASCADE
);


INSERT INTO User (first_name, last_name, email, password, role, created_at) VALUES
('Alice', 'Dupont', 'alice.dupont@example.com', 'hashed_password_1', 'member', NOW()),
('Bob', 'Martin', 'bob.martin@example.com', 'hashed_password_2', 'member', NOW()),
('Charlie', 'Admin', 'charlie.admin@example.com', 'hashed_password_3', 'admin', NOW());


INSERT INTO Beer (name, origin, alcohol, description, image, average_price, created_at) VALUES
('IPA Blonde', 'Belgique', 6.5, 'Une IPA aux notes fruitées et houblonnées.', NULL, 4.50, NOW()),
('Stout Noire', 'Irlande', 8.0, 'Un stout noir intense avec des arômes de café.', NULL, 5.00, NOW()),
('Lager Légère', 'Allemagne', 4.5, 'Une lager douce et rafraîchissante.', NULL, 3.50, NOW());

INSERT INTO beer (name, origin,alcohol, description, image, average_price, created_at) VALUES
('Porter', 'États-Unis', 5.0, 'Un porter légère et agréable.', NULL, 4.00, NOW()),
('Pale Ale', 'États-Unis', 4.5, 'Une bière pale et agréable.', NULL, 3.75, NOW()),
('Brown Ale', 'États-Unis', 4.0, 'Une bière brune légère et agréable.', NULL, 3.5,NOW()),
('Imperial Stout', 'États-Unis', 8.0, 'Un stout intense avec des arômes de café et de carame',NULL, 4.5, NOW()),
('La Chouffe','Belgique', 8.0, 'Blonde belge légèrement épicée avec des notes fruitées.',NULL, 3.80, NOW() ),
('Saison', 'Belgique', 5.0, 'Une bière saisonnelle avec des notes de fruit et de houblon.',NULL, 3.60, NOW()),
('Weihenstephaner Hefeweissbier', 'Allemagne', 5.4,'Bière blanche aux saveurs de banane et clou de girofle.',NULL, 3.6, NOW());

UPDATE beer
SET image = NULL
WHERE name = 'Porter';

UPDATE beer 
SET image = NULL
WHERE name = 'La Chouffe';

INSERT INTO beer_category (beer_id, category_id) VALUES
(1, 1),
INSERT INTO Category (name, created_at) VALUES
('IPA', NOW()),
('Stout', NOW()),
 ('Lager', NOW());

UPDATE beer
SET description = 'Une bière noire emblématique aux arômes de café et de caramel'
WHERE name = 'Stout Noire';

DELETE FROM Beer WHERE name = 'lager Légère';

SELECT * FROM Beer;

RENAME TABLE User TO user;

RENAME TABLE user TO users;
RENAME TABLE Beer TO beer;
RENAME TABLE Comment TO comment;
RENAME TABLE Category TO category;
RENAME TABLE Beer_Category TO beer_category;


INSERT INTO comment (content, rating, user_id, beer_id, created_at) VALUES
('Une bière parfaite pour les amateurs de saveurs complexes.', 5, 1, 1, NOW()),
('J’adore cette Porter, très douce et agréable !', 4, 2, 2, NOW());






