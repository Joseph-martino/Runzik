CREATE TABLE IF NOT EXISTS orderProducts
(
    orderId INT UNSIGNED NOT NULL,
    productId INT UNSIGNED NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    PRIMARY KEY(orderId, productId),
    CONSTRAINT FK_orderProducts_orders
        FOREIGN KEY (orderId)
        REFERENCES orders(id)
        ON DELETE CASCADE,
    CONSTRAINT FK_orderProducts_products
        FOREIGN KEY (productId)
        REFERENCES products(id)
) ENGINE=INNODB;