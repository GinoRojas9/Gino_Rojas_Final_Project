<?php
session_start();
require_once 'PharmacyDatabase.php';


class PharmacyPortal {
    private $db;

    public function __construct() {
        $this->db = new PharmacyDatabase();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'login';

        switch ($action) {
            case 'addPrescription':
                $this->addPrescription();
                break;
            case 'viewPrescriptions':
                $this->viewPrescriptions();
                break;
            case 'viewInventory':
                $this->viewInventory();
                break;
            case 'addUser':
                 $this->addUser();
                  break;
            case 'home':
                $this->home();
                break;
            case 'patientHome':
                $this->patientHome();
                break;
            case 'addMedication':
                 $this->addMedication();
                   break;
            case 'viewMedications':
                $this->viewMedications();
                 break;
            case 'getUser':
                $this->getUser();
                break;
            case 'processSale':
                $this->processSales();
                break;
            case 'saleList':
                $this->saleList();
                break;
            default:
                $this->login();
        }
    }

    private function home() {
        include 'templates/home.php';
    }

    private function patientHome() {
        include 'templates/patientHome.php';
    }

    private function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userName = $_POST['username'];
            $password = $_POST['password'];
            $contactInfo = $_POST['contact'];
            $userType = $_POST['type'];
            $_SESSION["loginType"] = $userType;

            if ( $userName == "" || $password == "" || $contactInfo == ""|| $userType == ""){

                echo '<p>You have not entered all of the required details, please try again.</p>';
                exit;
             }
             else if (!(strlen($password) >= 10)){

                echo '<p>The minimum password length requirement was not reached, please try again</p>';
                exit;
             }
            
        if ($userType == 'pharmacist') {
            $this->db->addUser($userName, $contactInfo, $userType);
            header("Location:?action=home");
        } else if ($userType =='patient'){
            $this->db->addUser($userName, $contactInfo, $userType);
            header("Location:?action=patientHome");
        }
        }
        include 'templates/login.php';
    }

    private function addPrescription() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $patientUserName = $_POST['patient_username'];
            $medicationId= $_POST['medication_id'];
            $dosageInstructions = $_POST['dosage_instructions'];
            $quantity = $_POST['quantity'];
            $refillCount = $_POST['refillCount'];

            $this->db->addPrescription($patientUserName, $medicationId, $dosageInstructions, $quantity, $refillCount);
            header("Location:?action=viewPrescriptions&message=Prescription Added");
        } else {
            include 'templates/addPrescription.php';
        }
    }

    private function viewPrescriptions() {
        $prescriptions = $this->db->getAllPrescriptions();
        include 'templates/viewPrescriptions.php';
    }

    private function addUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userName = $_POST['username'];
            $contactInfo = $_POST['contact'];
            $userType = $_POST['type'];

            $this->db->addUser($userName, $contactInfo, $userType);
            header("Location:?action=addUser&message=You have logged in!");
        } else {
            include 'templates/addUser.php';
        }
    }
    private function addMedication() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $medicationName = $_POST['medicationName'];
            $dosage = $_POST['dosage'];
            $manufacturer = $_POST['manufacturer'];
            $quantityAvailable = $_POST['quantityAvailable'];
    
            $this->db->addMedication($medicationName, $dosage, $manufacturer, $quantityAvailable);
            header("Location:?action=addMedication&message=medication has been added.");
        } else {
            include 'templates/addMedication.php';
        }
    
    }

    private function viewMedications() {
        $medicationDB = $this->db->medicationInventory();
        include 'templates/viewMedications.php';
    }

    private function getUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['userId'];

            $userDetails = $this->db->getUserDetails($userId);
            include 'templates/selectedUser.php';
            } else {
            include 'templates/getUser.php';
            }
    }

    private function processSales() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prescriptionId = $_POST['prescriptionId'];
            $quantitySold = $_POST['quantitySold'];

            $this->db->processSale($prescriptionId, $quantitySold);
            header("Location:?action=saleList&message=Sale has been confirmed");
            } else {
            include 'templates/processSales.php';
            }
    }

    private function saleList() {
        $sales = $this->db->getAllSales();
        include 'templates/saleList.php';
}

}

$portal = new PharmacyPortal();
$portal->handleRequest();
?>