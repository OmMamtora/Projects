<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Connect to the database
    $conn =mysqli_connect("localhost","root","","hospital_management");

    if ($conn===false) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $userType = $_POST["type"];

    // Validate username and password (you should perform secure validation and authentication)

    // Execute a SELECT query to retrieve user information
    $sql = "SELECT user_type FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $dbUserType = $row['user_type'];

            // Ensure that the user type matches and is "admin"
            if ($dbUserType === "admin" && $userType === "admin") {
                // Redirect to the admin page
                header("Location: http://localhost/PROJECT/html/HMS_Admin/admin.html");
                exit;
            } 
            elseif ($dbUserType === "doctor" && $userType === "doctor") {
                header("Location: http://localhost/PROJECT/html/HMS_Doctor/t_doctor.html");
                exit;
            } 
            elseif($dbUserType === "patient" && $userType === "patient") {
                header("Location: http://localhost/PROJECT/html/HMS_Patient/t_patient.html");
                exit;
            }
            elseif($dbUserType === "receptionist" && $userType === "receptionist") {
                header("Location: http://localhost/PROJECT/html/HMS_Receptinist/t_receptinist.html");
                exit;
            }
        } 
        else {
           echo "Username And Password check it again..";
        }

        mysqli_free_result($result);
    }

    // Close the database connection
    mysqli_close($conn);
}
?> 