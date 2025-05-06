<html>
<head><title>View Medications</title>
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
    <h1>All Medications</h1>
    <table border="1">
        <tr>
            <th>Medication Name</th>
            <th>Dosage</th>
            <th>Manufacturer</th>
            <th>Quantity Available</th>
        </tr>
        <?php if (empty($medicationDB)): ?>
            <tr>
                <td colspan="6">No prescriptions found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($medicationDB as $medications): 

            if ($medications['quantityAvailable'] <= 100){
            
                echo 'One or more inventories of medications has been detected to be low Or depleated </br>
                please refill them soon.';
            }
            ?>
                <tr>
                    <td><?= htmlspecialchars($medications['MedicationName']) ?></td>
                    <td><?= htmlspecialchars($medications['dosage']) ?></td>
                    <td><?= htmlspecialchars($medications['manufacturer']) ?></td>
                    <td><?= htmlspecialchars($medications['quantityAvailable']) ?></td>
                </tr>
                
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
<?php
?>

<?php if($_SESSION["loginType"] == 'patient') : ?>
        <a href="?action=patientHome">Back to Home</a>
    <?php else : ?>
        <a href="?action=home">Back to Home</a>
<?php endif; ?>
</body>
</html>