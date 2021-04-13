CREATE TABLE IF NOT EXISTS headphones
(
    id INT UNSIGNED PRIMARY KEY NOT NULL,
    name VARCHAR(30) NOT NULL,
    price INT UNSIGNED NOT NULL,
    image VARCHAR(100) NOT NULL,
    quantity INT UNSIGNED,
    colour1 VARCHAR(50) NOT NULL,
    colour2 VARCHAR(50) NOT NULL,
    brandId INT UNSIGNED NOT NULL,
    CONSTRAINT FK_headphones_brands
        FOREIGN KEY (brandId)
        REFERENCES brands(id)
) ENGINE=INNODB;