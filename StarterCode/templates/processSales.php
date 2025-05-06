<html>
<head><title>Process a Sale</title>
<header> </header>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Please confirm the sale of the most recent prescription.</h1>
    
    <form method="POST" action="?action=processSale">

    <div class = "prescriptionIdClass">
    <p>Prescription ID:</p>
    <input type ="text" name = "prescriptionId" size="40" /> 
    </div>

    <div class = "quantitySoldClass">
    <p>The quantity amount sold:</p>
    <input type ="text" name = "quantitySold" size="40" /> 
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