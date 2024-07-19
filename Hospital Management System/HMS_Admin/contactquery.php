<?php

$conn=mysqli_connect("localhost","root","","hospital_management");


if ($conn===false) {
    die("Connection failed: ".mysqli_connect_error());
}

$query = "SELECT * FROM contactus";

$result = mysqli_query($conn,$query);

$conn->close();

?>

<html>
<head>
    <title>All Query</title>
    <link rel="stylesheet" href="contactquery.css">
</head>
<body>
    <div class="query">
        <h2>Contactus Queries</h2>
        
        <?php
        // Check if appointments are retrieved successfully
        if (mysqli_num_rows($result)>0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Date</th><th>Timestamp</th><th>Message</th></tr>";

            // Output data of each row
            while ($row =mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No Query found.";
        }
        ?>
    </div>
</body>
</html>
