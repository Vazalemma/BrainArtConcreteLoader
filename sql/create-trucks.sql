CREATE TABLE trucks (
	truckID int NOT NULL AUTO_INCREMENT,
	truckName VARCHAR(255),
	maxLoad int NOT NULL,
	currentLoad int NOT NULL,
	money int NOT NULL,
	PRIMARY KEY (truckID)
);