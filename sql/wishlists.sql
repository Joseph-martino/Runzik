CREATE TABLE IF NOT EXISTS wishlists
(
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    userId INT UNSIGNED NOT NULL,
    CONSTRAINT FK_wishlists_users
        FOREIGN KEY (userId)
        REFERENCES users(id)
        ON DELETE CASCADE
) ENGINE=INNODB;
