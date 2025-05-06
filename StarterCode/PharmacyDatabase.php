<?php
class PharmacyDatabase {
    private $host = "localhost";
    private $port = "3306";
    private $database = "pharmacy_portal_db";
    private $user = "root";
    private $password = "";
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
        echo "Successfully connected to the database";
    }

    public function addPrescription($patientUserName, $medicationId, $dosageInstructions, $quantity, $refillCount)  {
        $stmt = $this->connection->prepare(
            "SELECT userId FROM Users WHERE userName = ? AND userType = 'patient'"
        );
        $stmt->bind_param("s", $patientUserName);
        $stmt->execute();
        $stmt->bind_result($patientId);
        $stmt->fetch();
        $stmt->close();
        
        if ($patientId){
            $stmt = $this->connection->prepare(
                "INSERT INTO Prescriptions (userId, medicationId, prescribedDate, dosageInstructions, quantity, refillCount) 
                VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?, ?)"
            );
            $stmt->bind_param("iisii", $patientId, $medicationId, $dosageInstructions, $quantity, $refillCount);
            $stmt->execute();
            $stmt->close();
            echo "Prescription added successfully";
        }else{
            echo "failed to add prescription";
        }
    }

    public function getAllPrescriptions() {
        $result = $this->connection->query("SELECT * FROM  prescriptions join medications on prescriptions.medicationId= medications.medicationId");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function MedicationInventory() {
        $result = $this->connection->query("SELECT * FROM medicationInventoryView");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addUser($userName, $contactInfo, $userType) {
        $stmt = $this->connection->prepare(
           "CALL AddOrUpdateUser(?, ?, ?)"
        );
        $stmt->bind_param("sss", $userName, $contactInfo, $userType);
        $stmt->execute();
        $stmt->close();
        
    }

    public function addMedication($medicationName, $dosage, $manufacturer, $quantityAvailable) {
        $stmt = $this->connection->prepare(
           "INSERT INTO Medications VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isss", $medicationId, $medicationName, $dosage, $manufacturer);
        $stmt->execute();
        $stmt->close();

        $stmt = $this->connection->prepare(
            "SELECT medicationId FROM Medications WHERE medicationName = ?"
        );
        $stmt->bind_param("s", $medicationName);
        $stmt->execute();
        $stmt->bind_result($inventoryMedId);
        $stmt->fetch();
        $stmt->close();

        $stmt = $this->connection->prepare(
            "INSERT INTO Inventory VALUES (?, ?, ?, CURRENT_TIMESTAMP)"
         );
         $stmt->bind_param("iii",  $inventoryId, $inventoryMedId, $quantityAvailable);
         $stmt->execute();
         $stmt->close();
    }

    public function getUserDetails($userId) {
        $result = $this->connection->query("SELECT * FROM 
        Users join prescriptions on Users.userId = prescriptions.prescriptionId 
        WHERE Users.userId = $userId and prescriptionId = $userId");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function processSale($prescriptionId, $quantitySold){

        $stmt = $this->connection->prepare(
            "CALL processSale(?, ?)"
         );
         $stmt->bind_param("ii", $prescriptionId, $quantitySold);
         $stmt->execute();
         $stmt->close();
    }

    public function getAllSales() {
        $result = $this->connection->query("SELECT * FROM Sales");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
