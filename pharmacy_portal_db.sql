Create Database pharmacy_portal_db;
Use pharmacy_portal_db;
Create table Users (
userId INT NOT NULL UNIQUE AUTO_INCREMENT,
userName VARCHAR(45) NOT NULL UNIQUE,
contactInfo VARCHAR(200),
userType ENUM('pharmacist','patient') NOT NULL,
primary key (userId));

insert into Users (userName, contactInfo, userType)
Values ('Maria Lopez', '646-298-0592', 'patient'),
('Robert martinez', 'RobertMartinez23@gmail.com', 'pharmacist'),
('Luther Williams', 'LutherWilliams@gmail.com','patient');

Create table Medications (
medicationId INT NOT NULL UNIQUE AUTO_INCREMENT,
medicationName VARCHAR(45) NOT NULL,
dosage varchar(45) not null,
manufacturer VARCHAR(100),
primary Key (medicationId));

insert into Medications (medicationName, dosage, manufacturer)
Values ('Gabapentin', '600 mg', 'Leonardo DiCaprio'),
('Atorvastatin', '80 mg', 'Johnny Depp'),
('Tramadol', '100mg', 'Bruce Willis');

Create table Prescriptions (
prescriptionId INT NOT NULL UNIQUE AUTO_INCREMENT,
userId int NOT NULL,
medicationId int NOT NULL,
prescribedDate datetime NOT NULL,
dosageInstructions varchar(200),
quantity int not null,
refillCount int default 0,
primary Key (prescriptionId),
foreign key (userId) references Users(userId),
foreign key (medicationId) references Medications(medicationId));

insert into Prescriptions (userId, medicationId, dosageInstructions, prescribedDate, quantity, refillCount)
Values (1, 1, 'take orally twice a day', '2025-03-25 12:09:35', 10, 5),
(2, 2, 'take once per day', '2025-04-16 4:15:20', 20, 10),
(3, 3, 'take every 4-6 hours', '2025-05-05 1:12:45', 15, 5);

Create table Inventory (
InventoryId INT NOT NULL UNIQUE AUTO_INCREMENT,
medicationId int NOT NULL,
quantityAvailable int not null,
lastUpdated datetime not null,
primary Key (inventoryId),
foreign key (medicationId) references Medications (medicationId));

insert into Inventory (medicationId, quantityAvailable, lastUpdated)
Values (1, 300, '2025-03-25 12:09:35'),
(2, 500, '2025-04-16 4:15:20'),
(3, 250, '2025-05-05 1:12:45');

Create table Sales (
saleId INT NOT NULL UNIQUE AUTO_INCREMENT,
prescriptionId int NOT NULL,
saleDate datetime not null,
quantitySold int not null,
saleAmount Decimal(10,2) not null,
primary Key (saleId),
foreign key (prescriptionId) references Prescriptions (prescriptionId));

insert into Sales (prescriptionId, saleDate, quantitySold, saleAmount)
Values (1,'2025-03-25 12:09:35', 5,  25),
(2, '2025-04-16 4:15:20', 10,  50),
(3,'2025-05-05 1:12:45', 5, 25);

CREATE VIEW medicationInventoryView AS
SELECT  Medications.MedicationName,  Medications.dosage, Medications.manufacturer, Inventory.quantityAvailable
FROM Medications, Inventory
WHERE medications.MedicationId = Inventory.InventoryId;

DELIMITER //
CREATE PROCEDURE AddOrUpdateUser(userNameInput varchar(45), contactInfoInput VARCHAR(200), userTypeInput ENUM('pharmacist','patient'))
BEGIN
IF EXISTS (Select * From Users Where userName = userNameInput) THEN
	UPDATE Users
	SET userName = userNameInput, contactInfo = contactInfoInput, userType = userTypeInput
    WHERE userName = userNameInput;
ELSE
	INSERT INTO Users (userName, contactInfo, userType) VALUES (userNameInput, contactInfoInput, userTypeInput);
END IF;
END
//
DELIMITER;

DELIMITER //
CREATE PROCEDURE ProcessSale(prescriptionIdInput INT, quantitySoldInput INT)
BEGIN
Declare saleAmountInput int;
SET saleAmountInput = quantitySoldInput * 5;
INSERT INTO Sales(prescriptionId, saleDate, quantitySold, saleAmount) VALUES (prescriptionIdInput, CURRENT_TIMESTAMP, quantitySoldInput, saleAmountInput);
END
//
DELIMITER;

DELIMITER //
CREATE TRIGGER AfterPrescriptionInsert
AFTER INSERT ON Prescriptions
FOR EACH ROW
BEGIN
    UPDATE Inventory 
    SET quantityAvailable = quantityAvailable - NEW.quantity 
    WHERE medicationId = NEW.medicationId;
END;
//
DELIMITER ;
