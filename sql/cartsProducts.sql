CREATE TABLE IF NOT EXISTS cartsProducts
(
    cartId INT UNSIGNED NOT NULL,
    productId INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED,
    PRIMARY KEY(cartId, productId),
    CONSTRAINT FK_cartProducts_carts
        FOREIGN KEY (cartId)
        REFERENCES carts(id),
    CONSTRAINT FK_cartProducts_products
        FOREIGN KEY (productId)
        REFERENCES products(id)
) ENGINE=INNODB;
