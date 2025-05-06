<html>
<head><title>Patient or Pharmacist</title>
<header> </header>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Hello! To access the website, please first login as a patient or a pharmacist.</h1>
    
    <form method="POST" action="?action=login">

    <div class = "userName">
    <p>Username:</p>
    <input type ="text" name = "username" size="40" /> 
    </div>

    <div class = "passwordClass">
    <p>Password: (minimum length:10) </p>
    <input type ="password" name = "password" size="40" /> </p>
    </div>

    <div class = "contactClass">
    <p>Contact information (email or phone number):</p>
    <input type ="text" name = "contact" size="40" /> </p>
    </div>
    
    <div class = "typeClass">
    <p>Are you a patient or a Pharmacist?</p>
    <input type ="text" name = "type" size="40" /> </p>
    </div>

    <button type="submit">Save</button>
    </form>

</body>
</html>