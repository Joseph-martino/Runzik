CREATE TABLE IF NOT EXISTS users 
(
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    password VARCHAR(255) NOT NULL,
    isAdmin BOOLEAN NOT NULL,
    adressId INT UNSIGNED,
    CONSTRAINT FK_users_addresses
        FOREIGN KEY (adressId)
        REFERENCES addresses(id)
) ENGINE=INNODB;