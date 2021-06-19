CREATE TABLE IF NOT EXISTS orders 
(
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    userId INT UNSIGNED NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_orders_users
    FOREIGN KEY (userId)
    REFERENCES users(id)
) ENGINE=INNODB;