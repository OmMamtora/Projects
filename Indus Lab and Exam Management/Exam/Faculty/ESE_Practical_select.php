<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MSE Theory Data</title>
<link rel="stylesheet" href="exam_facu_dash.css">
</head>
<body>

<h2>ESE Practical Data</h2>

<?php
$conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

if ($conn === false) {
    die("Error: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT * FROM ese_practical";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table class='mse_theory-table' border='1'>";
    echo "<tr><th>Name</th><th>Email</th><th>Enrollment</th><th>Branch</th><th>Semester</th><th>Subject</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['enrollment_no'] . "</td>";
        echo "<td>" . $row['branch'] . "</td>";
        echo "<td>" . $row['semester'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

</body>
</html>
