<html>
<head><title>find a User</title>
<header> </header>
<link rel="stylesheet" href="css/style.css">

</head>
<body>
    <h1>Please provide the ID of the user you wish to view.</h1>
    
    <form method="POST" action="?action=getUser">

    <div class = "userIdClass">
    <p>userID:</p>
    <input type ="text" name = "userId" size="40" /> 
    </div>

    <button type="submit">Search</button>
    </form>
    <?php if($_SESSION["loginType"] == 'patient') : ?>
        <a href="?action=patientHome">Back to Home</a>
    <?php else : ?>
        <a href="?action=home">Back to Home</a>
<?php endif; ?>


</body>
</html>