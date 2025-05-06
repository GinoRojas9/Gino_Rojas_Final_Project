<html>
<head><title>Add Prescription</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Add Reservation</h1>
    <form method="POST" action="?action=addPrescription">
        Patient Username: <input type="text" name="patient_username" /><br>
        Medication ID : <input type="number" name="medication_id"/><br>
        Dossage Instructions: <textarea name="dosage_instructions"></textarea><br>
        Quantity: <input type="number" name="quantity" /><br>
        Refill Count: <input type="number" name="refillCount" /><br>
        <button type="submit">Save</button>
    </form>
    <?php if($_SESSION["loginType"] == 'patient') : ?>
        <a href="?action=patientHome">Back to Home</a>
    <?php else : ?>
        <a href="?action=home">Back to Home</a>
<?php endif; ?>
</body>
</html>
