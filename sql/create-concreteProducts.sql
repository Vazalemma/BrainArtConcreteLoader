CREATE TABLE concreteProducts (
	productID int NOT NULL AUTO_INCREMENT,
	productName VARCHAR(255),
	productWeight int NOT NULL,
	transported BOOL DEFAULT FALSE,
	PRIMARY KEY (productID)
);