START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`address` (`idAddress`, `street`, `houseNumber`, `post`, `code`) VALUES (1, 'Slovenska cesta', 1, 'Ljubljana', '1000');

COMMIT;


-- -----------------------------------------------------
-- Data for table `bookstore`.`book`
-- -----------------------------------------------------
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`book` (`id`, `author`, `title`, `price`, `year`, `activeBook`) VALUES (DEFAULT, 'Vladimir Bartol', 'Alamut', 20, 1937, 1);
INSERT INTO `bookstore`.`book` (`id`, `author`, `title`, `price`, `year`, `activeBook`) VALUES (DEFAULT, 'E. L. James','Fifty Shades of Grey', 30, 2011, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `bookstore`.`customer`  Geslo za Jože Gorišek je 'geslo123'
-- -----------------------------------------------------
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`customer` (`idCustomer`, `name`, `surname`, `address_idAddress`, `email`, `password`, `active`) VALUES (DEFAULT, 'Jože', 'Gorišek', 1, 'joze.gorisek@gmail.com', '$2y$10$6hKyUYGo3ZhgFBibARrgeuZcG13p8eTlqcrc9WIrTX2ONKiuMRCLW', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `bookstore`.`finalorder`
-- -----------------------------------------------------
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`finalorder` (`orderID`, `status`, `total`, `customer_idCustomer`) VALUES (1, 0, 15.0, 3);
INSERT INTO `bookstore`.`finalorder` (`orderID`, `status`, `total`, `customer_idCustomer`) VALUES (2, 1, 20.0, 3);


COMMIT;

-- -----------------------------------------------------
-- Data for table `bookstore`.`orders`
-- -----------------------------------------------------
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`orders` (`idOrder`, `book_id`, `quantity`, `finalorder_orderID`) VALUES (1, 7, 2, 1);
INSERT INTO `bookstore`.`orders` (`idOrder`, `book_id`, `quantity`, `finalorder_orderID`) VALUES (2, 8, 5, 1);
INSERT INTO `bookstore`.`orders` (`idOrder`, `book_id`, `quantity`, `finalorder_orderID`) VALUES (3, 7, 3, 2);
INSERT INTO `bookstore`.`orders` (`idOrder`, `book_id`, `quantity`, `finalorder_orderID`) VALUES (4, 8, 1, 2);

COMMIT;

-- GESLO ZA ADMINA JE admin 'geslo'
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`admin` (`name`, `surname`, `email`, `password`) VALUES ('Janez', 'Admin', 'admin@knjigarko.si', '$2y$10$JBNDKDKiwUpODPFNPVDAoOfbrbOmB7jPiiTNX3ifSYJTbvkgix0Om');


COMMIT;

-- geslo  za Miha Tržec je 'geslo123', geslo za Anton Bukva je 'mojegeslo'
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`seller` (`name`, `surname`, `email`, `password`, `active`) VALUES ('Miha', 'Tržec', 'miha@mk.si', '$2y$10$2Z13VHaAniOrEjGY2gx7Net6m8l.84lPV/ADCxHGlbYWxCJ/3vt2i', 1);
INSERT INTO `bookstore`.`seller` (`name`, `surname`, `email`, `password`, `active`) VALUES ('Anton', 'Bukva', 'anton@modrijan.si', '$2y$10$aXkLOi6uv.iPqB0Dx/W3GOsU12etypLXwVMd4OYpOpL9X8Wz23Nze', 0);

COMMIT;