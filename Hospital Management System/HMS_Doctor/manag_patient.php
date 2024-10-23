<?php

$conn=mysqli_connect("localhost","root","","hospital_management");

if($conn===false){
   die("Error occur".mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $search_name = $_POST['search_name'];

    $query = "SELECT * FROM patient WHERE p_name = ?";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $search_name);

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);
    } 
    else {
        echo "Query Not Prepared..";
    }

    $conn->close();
}

?>

<html>
<head>
    <title>Search Patient Page </title>
    <link rel="stylesheet" href="manag_patient.css">
</head>
<body>
    <div class="patient_page">
        <h2>Patient Detail </h2>

        <form method="POST">
            <label>Search by Patient Name: </label>
            <input type="text" name="search_name" id="search_name">
            <input type="submit" name="submit" value="Search"> 
        </form>

        <?php
        if (isset($result) && mysqli_num_rows($result)>0){
                echo "<table>";
                echo "<tr><th>Patient Name</th><th>Patient Email</th><th>Mobile Number</th><th>Gender</th><th>Address</th><th>Age</th><th>Patient Dieases</th><th>Medical History</th></tr>";

            // Output data of each row
            while ($row =mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["p_name"] . "</td>";
                echo "<td>" . $row["p_email"] . "</td>";
                echo "<td>" . $row["p_mob"] . "</td>";
                echo "<td>" . $row["gender"] . "</td>";
                echo "<td>" . $row["p_add"] . "</td>";
                echo "<td>" . $row["age"] . "</td>";
                echo "<td>" . $row["p_diseases"] . "</td>";
                echo "<td>" . $row["medical_history"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No patient found.";
        }

        ?>
    </div>
</body>
</html>