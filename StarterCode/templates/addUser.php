<html>
<head><title>Add or Update User Info</title>
<header> </header>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Please add a new user</h1>

    <h4>To update an existing user, please use the same username to change information.</h4>
    
    <form method="POST" action="?action=addUser">

    <div class = "userName">
    <p>Username:</p>
    <input type ="text" name = "username" size="40" /> 
    </div>

    <div class = "contactClass">
    <p>Contact information (email or phone number):</p>
    <input type ="text" name = "contact" size="40" /> </p>
    </div>
    
    <div class = "contactClass">
    <p>Are you a patient or a Pharmacist?</p>
    <input type ="text" name = "type" size="40" /> </p>
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