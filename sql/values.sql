INSERT IGNORE INTO users (id, username, email, password, isAdmin)
VALUES
(1, 'Bully', 'bullymaguire@gmail.com', 'test', true),
(2, 'Nikos', 'nico.s@gmail.com', 'test2', false);

INSERT IGNORE INTO wishlists (id, userId)
VALUES
(1, 1),
(2,2);

INSERT IGNORE INTO carts (id, userId)
VALUES
(1, 1),
(2,2);

INSERT IGNORE INTO brands (id, name)
VALUES 
(1, 'Runzik'), 
(2, 'Hanuman'), 
(3, 'Beats');

INSERT IGNORE INTO productTypes (id, name, displayName, displayNamePlural)
VALUES
(1, 'watch', 'montre', 'montres'),
(2, 'headphone', 'casque', 'casques'),
(3, 'armband', 'brassard', 'brassards');

INSERT IGNORE INTO products (id, name, price, image, colour1, colour2, brandId, typeId)
VALUES
(1, 'Montre RunZik S Plus', 99, 'ressources/images/products/watch1.png', 'Crystal blue', 'Fire red', 1, 1),
(2, 'Montre RunZik T++', 199, 'ressources/images/products/watch2.png', 'Cloud White', 'Purple Lavender', 1, 1),
(3, 'Montre Hanuman 4 Power +', 399, 'ressources/images/products/watch3.png', 'Night black', 'Forest Green', 2, 1),
(4, 'Montre Hanuman Pro GT', 899, 'ressources/images/products/watch4.png', 'Love Pink', 'Metal Grey', 2, 1),
(5, 'Montre Beats Cosmos 7 pro', 299, 'ressources/images/products/watch5.png', 'Turquoise Sea', 'Lemon yellow', 3, 1),
(6, 'Montre Beats Sport SE', 479, 'ressources/images/products/watch6.png','Passion red', 'Ocean Blue', 3, 1),
(7, 'Brassard RunZik Z', 20, 'ressources/images/products/armband1.png', 'Crystal blue', 'Fire red', 1, 3),
(8, 'Brassard RunZik Sweatproof', 35, 'ressources/images/products/armband2.png', 'Coal Black', 'Stone Grey', 1, 3),
(9, 'Brassard Hanuman Dynamix', 40, 'ressources/images/products/armband3.png', 'Night black', 'Diamond white', 2, 3),
(10, 'Brassard Hanuman Xtrem', 55, 'ressources/images/products/armband4.png', 'Coal Black', 'Silver Grey', 2, 3),
(11, 'Brassard Beats Sport Pro', 30, 'ressources/images/products/armband5.png', 'Ink Black', 'Sunlight Orange', 3, 3),
(12, 'Brassard Beats Ultra', 33, 'ressources/images/products/armband6.png', 'Dark Black', 'Green Leaf', 3, 3),
(13, 'Casque RunZik X', 250, 'ressources/images/products/headphone1.png' ,'Space Black', 'Sky Blue', 1, 2),
(14, 'Casque RunZik Orion', 350, 'ressources/images/products/headphone2.png', 'Deep Black', 'Jade Green', 1, 2),
(15, 'Casque Hanuman DG1991', 499, 'ressources/images/products/headphone3.png', 'Night black', 'Diamond white', 2, 2),
(16, 'Casque Hanuman Proxima', 599, 'ressources/images/products/headphone4.png', 'Cender Black', 'Volcano Red', 2, 2),
(17, 'Casque Beats Warrior 41WH', 299, 'ressources/images/products/headphone5.png', 'Love pink', 'Lemon yellow', 3, 2),
(18, 'Casque Beats Ultra V', 399, 'ressources/images/products/headphone6.png', 'Chrome Grey', 'Violet Purple', 3, 2);







