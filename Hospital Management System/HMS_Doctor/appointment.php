<?php

$conn=mysqli_connect("localhost","root","","hospital_management");


if ($conn===false) {
    die("Connection failed: ".mysqli_connect_error());
}

$query = "SELECT * FROM appointment";

$result = mysqli_query($conn,$query);

$conn->close();

?>

<html>
<head>
    <title>Appointment History</title>
    <link rel="stylesheet" href="appointment.css">
</head>
<body>
    <div class="appointment">
        <h2>Appointment History</h2>
        
        <?php
        // Check if appointments are retrieved successfully
        if (mysqli_num_rows($result)>0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Patient Name</th><th>Email</th><th>Doctor Name</th><th>Date</th><th>Slot</th></tr>";

            // Output data of each row
            while ($row =mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["p_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["d_name"] . "</td>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["slot"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No appointments found.";
        }
        ?>
    </div>
</body>
</html>
