<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['name'];
    $email = $_POST['email'];
    $add=$_POST['add'];

    $usertype = "receptionist";

    // Add your database connection and insertion logic here
    // Example: Inserting the receptionist's details into the database

    // Sample code for connecting to the database
    $conn = mysqli_connect("localhost", "root", "", "hospital_management");

    if ($conn === false) {
        die("Error: Could not connect with the database. " . mysqli_connect_error());
    } else {
        $query = "INSERT INTO receptionist (re_name, re_add, re_email,username, password) VALUES (?, ?, ?, ?, ?)";
        $query_login = "INSERT INTO login (username, password, user_type) VALUES (?, ?, ?)";
       
        $stmt = mysqli_prepare($conn, $query);
        $stmt_login = mysqli_prepare($conn, $query_login);

        if ($stmt && $stmt_login) {
            mysqli_stmt_bind_param($stmt, "sssss", $fullname, $add ,$email, $username, $password);
            mysqli_stmt_bind_param($stmt_login, "sss", $username, $password, $usertype);

            $execute_stmt = mysqli_stmt_execute($stmt);
            $execute_stmt_login = mysqli_stmt_execute($stmt_login);


            if ($execute_stmt && $execute_stmt_login) {
                echo 'Registration successful! Welcome, Receptionist ' . $fullname . '.';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } 
            else {
            echo "Error: Query not prepared." . mysqli_error($conn);
            }


        mysqli_close($conn);
    }
}
?>
