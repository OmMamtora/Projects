<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Requirement</title>
    <link rel="stylesheet" href="software_complain.css">
</head>
<body>
</body>
</html>


<?php
    // Establish database connection
    $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

    // Check if connection is successful
    if ($conn === false) {
        die("Error: Unable to connect to the database. " . mysqli_connect_error());
    }

    // Fetch data from software_requirement table
    $sql = "SELECT * FROM software_requirement";
    $result = mysqli_query($conn, $sql);

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Output table headers
        echo "<table class='software-table'>";
        echo "<tr><th>Lab No</th><th>PC No</th><th>Problem</th><th>Status</th></tr>";

        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            // Output table row for entry details
            echo "<tr>";
            echo "<td>" . $row['lab_no'] . "</td>";
            echo "<td>" . $row['pc_no'] . "</td>";
            echo "<td>" . $row['problem'] . "</td>";
            echo "<td>";
                echo "<class='done-option'>";
                echo "<form action='mark_done.php' method='post'>";
                echo "<input type='hidden' name='entry_id' value='" . $row['software_id'] . "'>";
                echo "<input type='submit' name='mark_done' value='Mark as Done'>";
            echo "</td>";

            echo "</tr>";

        }
        echo "</table>";
    } else {
        echo "No data found in the table.";
    }

    // Close database connection
    mysqli_close($conn);
?>