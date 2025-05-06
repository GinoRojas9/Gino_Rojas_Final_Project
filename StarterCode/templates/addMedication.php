<html>
<head><title>Add a medication</title>
<header> </header>
<link rel="stylesheet" href="css/style.css">
</head>


<body>
    <h1>Add a new medication to be used for future prescriptions</h1>
    
    <form method="POST" action="?action=addMedication">

    <div class = "medicationNameClass">
    <p>Medication Name:</p>
    <input type ="text" name = "medicationName" size="10" /> 
    </div>

    <div class = "contactClass">
    <p>The recommended dosage:</p>
    <input type ="text" name = "dosage" size="40" /> </p>
    </div>
    
    <div class = "manufacturerClass">
    <p>The Manufacturer of the Medication:</p>
    <input type ="text" name = "manufacturer" size="40" /> </p>
    </div>

    <div class = "quantityAvailableClass">
    <p>Quantity Available:</p>
    <input type ="text" name = "quantityAvailable" size="40" /> </p>
    </div>

    <button type="submit">Save</button>
    </form>
    <?php if($_SESSION["loginType"] == 'patient') : ?>
        <a href="?action=patientHome">Back to Home</a>
    <?php else : ?>
        <a href="?action=home">Back to Home</a>
<?php endif; ?>


</body>
</html>