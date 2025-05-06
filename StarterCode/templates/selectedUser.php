<html>
<head><title>Selected User</title>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }

        .no-data {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Here is the Selected User</h1>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Prescription ID</th>
            <th>Username</th>
            <th>Contact Information</th>
            <th>userType</th>
            <th>Dosage Instructions</th>
            <th>Quantity</th>
        </tr>
        <?php if (empty($userDetails)): ?>
            <tr>
                <td colspan="6">No prescriptions found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($userDetails as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['userId']) ?></td>
                    <td><?= htmlspecialchars($user['prescriptionId']) ?></td>
                    <td><?= htmlspecialchars($user['userName']) ?></td>
                    <td><?= htmlspecialchars($user['contactInfo']) ?></td>
                    <td><?= htmlspecialchars($user['userType']) ?></td>
                    <td><?= htmlspecialchars($user['dosageInstructions']) ?></td>
                    <td><?= htmlspecialchars($user['quantity']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <?php if($_SESSION["loginType"] == 'patient') : ?>
        <a href="?action=patientHome">Back to Home</a>
    <?php else : ?>
        <a href="?action=home">Back to Home</a>
<?php endif; ?>
</body>
</html>