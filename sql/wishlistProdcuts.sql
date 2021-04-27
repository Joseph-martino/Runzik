CREATE TABLE IF NOT EXISTS wishlistProducts
(
    wishlistId INT UNSIGNED NOT NULL,
    productId INT UNSIGNED NOT NULL,
    CONSTRAINT FK_wishlistProducts_wishlists
        FOREIGN KEY (wishlistId)
        REFERENCES wishlists(id),
    CONSTRAINT FK_wishlistProducts_products
        FOREIGN KEY (productId)
        REFERENCES products(id)
) ENGINE=INNODB;
