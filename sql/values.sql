INSERT IGNORE INTO brands (id, name)
VALUES 
(1, 'Runzik'), 
(2, 'Hanuman'), 
(3, 'Beats');

INSERT IGNORE INTO watches (id, name, price, image, colour1, colour2, brandId)
VALUES
(1, 'Montre RunZik S Plus', 99, 'ressources/images/products/watch1.png', 'Crystal blue', 'Fire red', 1),
(2, 'Montre RunZik T++', 199, 'ressources/images/products/watch6.png', 'Love pink', 'Lemon yellow', 1),
(3, 'Montre Hanuman 4 Power +', 399, 'ressources/images/products/watch2.png', 'Night black', 'Diamond white', 2),
(4, 'Montre Hanuman Pro GT', 899, 'ressources/images/products/watch4.png', 'Forest green', 'Lemon yellow', 2),
(5, 'Montre Beats Cosmos 7 pro', 299, 'ressources/images/products/watch3.png', 'Love pink', 'Lemon yellow', 3),
(6, 'Montre Beats Sport SE', 479, 'ressources/images/products/watch5.png', 'Love pink', 'Lemon yellow', 3);

