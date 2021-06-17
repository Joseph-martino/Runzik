CREATE TABLE IF NOT EXISTS products 
(
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    price INT UNSIGNED NOT NULL,
    image VARCHAR(100) NOT NULL,
    colour1 VARCHAR(50) NOT NULL,
    colour2 VARCHAR(50) NOT NULL,
    brandId INT UNSIGNED NOT NULL,
    typeId INT UNSIGNED NOT NULL,
    CONSTRAINT FK_products_brands
        FOREIGN KEY (brandId)
        REFERENCES brands(id)
        ON DELETE CASCADE,
    CONSTRAINT FK_products_productTypes
        FOREIGN KEY (typeId)
        REFERENCES productTypes(id)
        ON DELETE CASCADE
) ENGINE=INNODB;