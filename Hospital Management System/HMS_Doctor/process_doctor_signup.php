<?php
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $joiningDate = $_POST["date"];
    $mobileNo = $_POST["tel"];
    $specialty = $_POST["specialty"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hospital = $_POST["hospital"];

    $usertype = "Doctor";

    $conn = mysqli_connect("localhost", "root", "", "hospital_management");

    if ($conn === false) {
        die("Error Occurred: " . mysqli_connect_error());
    }

    $query = "INSERT INTO doctor (d_name, email, joining_date, mobile_no, specialty, username, password, hospital_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $query2 = "INSERT INTO login (username, password, user_type) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    $stmt2 = mysqli_prepare($conn, $query2);

    if ($stmt && $stmt2) {
        mysqli_stmt_bind_param($stmt, "ssssssss", $name, $email, $joiningDate, $mobileNo, $specialty, $username, $password, $hospital);
        mysqli_stmt_bind_param($stmt2, "sss", $username, $password, $usertype);

        $exec = mysqli_stmt_execute($stmt);
        $exec1 = mysqli_stmt_execute($stmt2);
        if ($exec && $exec1) {
            echo "Registration successful! Welcome, Doctor ' . $name . '.'";
        } else {
            echo "Record Not Inserted: " . mysqli_error($conn);
        }
    } else {
        echo "Query Not Prepared.";
    }
    mysqli_close($conn);
}
?>
