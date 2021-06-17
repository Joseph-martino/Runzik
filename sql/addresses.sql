CREATE TABLE IF NOT EXISTS addresses
(
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    -- userId a ajouter
    adress VARCHAR(255),
    phoneNumber VARCHAR(20)
    -- clef etrangere users a ajouter ON DELETE CASCADE
) ENGINE=INNODB;