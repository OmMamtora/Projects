<?php
$conn = mysqli_connect("localhost", "root", "", "hospital_management");

if ($conn===false) {
    die("Connection failed: " . mysqli_connect_error());
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
    <title>Manage History</title>
    <link rel="stylesheet" href="searchpatient.css">
</head>
<body>
    <div class="appointment">
        <h2>Patient History</h2>

        <form method="POST">
            <label>Search by Patient Name: </label>
            <input type="text" name="search_name" id="search_name">
            <input type="submit" name="submit" value="Search"> 
        </form>

        <?php
        if (isset($result) && mysqli_num_rows($result)>0){ 
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Mobile</th><th>Gender</th><th>Address</th><th>Age</th><th>Diseases</th><th>Medical History</th></tr>";

            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["p_id"] . "</td>";
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
            echo "No matching patients found.";
        }
        ?>
    </div>
</body>
</html>
