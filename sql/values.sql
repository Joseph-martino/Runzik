INSERT IGNORE INTO brands (id, name)
VALUES 
(1, 'Runzik'), 
(2, 'Hanuman'), 
(3, 'Beats');

INSERT IGNORE INTO watches (id, name, price, image, quantity, colour1, colour2, brandId)
VALUES
(1, 'Montre RunZik S Plus', 99, 'ressources/images/products/watch1.png', 50,'Crystal blue', 'Fire red', 1),
(2, 'Montre RunZik T++', 199, 'ressources/images/products/watch2.png', 50,'Love pink', 'Lemon yellow', 1),
(3, 'Montre Hanuman 4 Power +', 399, 'ressources/images/products/watch3.png', 40, 'Night black', 'Diamond white', 2),
(4, 'Montre Hanuman Pro GT', 899, 'ressources/images/products/watch4.png', 35,'Forest green', 'Lemon yellow', 2),
(5, 'Montre Beats Cosmos 7 pro', 299, 'ressources/images/products/watch5.png', 30, 'Love pink', 'Lemon yellow', 3),
(6, 'Montre Beats Sport SE', 479, 'ressources/images/products/watch6.png', 20,'Love pink', 'Lemon yellow', 3);

INSERT IGNORE INTO armbands (id, name, price, image, quantity, colour1, colour2, brandId)
VALUES
(1, 'Brassard RunZik Z', 20, 'ressources/images/products/armband1.png', 100,'Crystal blue', 'Fire red', 1),
(2, 'Brassard RunZik Sweatproof', 35, 'ressources/images/products/armband2.png', 75,'Love pink', 'Lemon yellow', 1),
(3, 'Brassard Hanuman Dynamix', 40, 'ressources/images/products/armband3.png', 60, 'Night black', 'Diamond white', 2),
(4, 'Brassard Hanuman Xtrem', 55, 'ressources/images/products/armband4.png', 50,'Forest green', 'Lemon yellow', 2),
(5, 'Brassard Beats Sport Pro', 30, 'ressources/images/products/armband5.png', 50, 'Love pink', 'Lemon yellow', 3),
(6, 'Brassard Beats Ultra', 33, 'ressources/images/products/armband6.png', 40,'Love pink', 'Lemon yellow', 3);

INSERT IGNORE INTO headphones (id, name, price, image, quantity, colour1, colour2, brandId)
VALUES
(1, 'Casque RunZik X', 250, 'ressources/images/products/headphone1.png', 80,'Crystal blue', 'Fire red', 1),
(2, 'Casque RunZik Orion', 350, 'ressources/images/products/headphone2.png', 70,'Love pink', 'Lemon yellow', 1),
(3, 'Casque Hanuman DG1991', 499, 'ressources/images/products/headphone3.png', 50, 'Night black', 'Diamond white', 2),
(4, 'Casque Hanuman Proxima', 599, 'ressources/images/products/headphone4.png', 45,'Forest green', 'Lemon yellow', 2),
(5, 'Casque Beats Warrior 41WH', 299, 'ressources/images/products/headphone5.png', 30, 'Love pink', 'Lemon yellow', 3),
(6, 'Casque Beats Ultra V', 399, 'ressources/images/products/headphone6.png', 20,'Love pink', 'Lemon yellow', 3);

INSERT IGNORE INTO productTypes (id, name, displayName, displayNamePlural)
VALUES
(1, 'watch', 'montre', 'montres'),
(2, 'headphone', 'casque', 'casques'),
(3, 'armband', 'brassard', 'brassards');



