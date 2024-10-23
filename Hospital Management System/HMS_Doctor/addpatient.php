<?php
if (isset($_POST['submit'])) {
    $fname = $_POST['firstname'];
    $email = $_POST['email'];
    $mob = $_POST['number'];
    $gender = $_POST['gender'];
    $add = $_POST['address'];
    $age = $_POST['age'];
    $diseases = $_POST['diseases'];
    $history = $_POST['history'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    $usertype = "patient"; // Assuming the usertype for this script is 'patient'

    // If there are no validation errors, proceed to insert data into the database
    $conn = mysqli_connect("localhost", "root", "", "hospital_management");

    if ($conn === false) {
        die("Error: Could not connect with the database. " . mysqli_connect_error());
    } else {
        $query = "INSERT INTO patient (p_name,p_email,p_mob,gender,age,p_add,p_diseases,medical_history,username, password) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $query_login = "INSERT INTO login (username, password, user_type) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conn, $query);
        $stmt_login = mysqli_prepare($conn, $query_login);

        if ($stmt && $stmt_login) {
            mysqli_stmt_bind_param($stmt, "ssisisssss", $fname, $email, $mob, $gender, $age, $add, $diseases, $history,$username,$password);
            mysqli_stmt_bind_param($stmt_login, "sss", $username, $password, $usertype);

            $execute_stmt = mysqli_stmt_execute($stmt);
            $execute_stmt_login = mysqli_stmt_execute($stmt_login);

            if ($execute_stmt && $execute_stmt_login) {
                echo "Inserted one record.";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Error: Query not prepared." . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
?>
