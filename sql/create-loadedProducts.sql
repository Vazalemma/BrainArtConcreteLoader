CREATE TABLE loadedProducts (
	truckID int NOT NULL,
	productID int NOT NULL,
	FOREIGN KEY (truckID) REFERENCES trucks(truckID),
	FOREIGN KEY (productID) REFERENCES concreteProducts(productID)
);