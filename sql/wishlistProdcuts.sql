CREATE TABLE IF NOT EXISTS wishlistProducts
(
    wishlistId INT UNSIGNED NOT NULL,
    productId INT UNSIGNED NOT NULL,
    PRIMARY KEY(wishlistId, productId),
    CONSTRAINT FK_wishlistProducts_wishlists
        FOREIGN KEY (wishlistId)
        REFERENCES wishlists(id),
    CONSTRAINT FK_wishlistProducts_products
        FOREIGN KEY (productId)
        REFERENCES products(id)
) ENGINE=INNODB;
