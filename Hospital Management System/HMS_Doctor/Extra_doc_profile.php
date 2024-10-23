<?php

$conn = mysqli_connect("localhost", "root", "", "hospital_management");

if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {

    $query = "SELECT * FROM doctor WHERE username = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $search_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Query Not Prepared..";
    }

    $conn->close();
}


?>