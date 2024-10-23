<?php
    session_start();

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "hospital_management";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if($result) {
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $user_id = $row['id'];

                $patient_query = "SELECT * FROM patient WHERE user_id = $user_id";
                $patient_result = mysqli_query($conn, $patient_query);

                if($patient_result) {
                    if(mysqli_num_rows($patient_result) > 0) {
                        echo "<h2>Patient Information:</h2>";
                        while($patient_row = mysqli_fetch_assoc($patient_result)) {
                            echo "<p>Patient ID: ".$patient_row['p_id']."</p>";
                            echo "<p>Patient Name: ".$patient_row['p_name']."</p>";
                            // Display other patient information here
                        }
                    } else {
                        echo "No patient information found for this user.";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Invalid username or password. Please try again.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>

<form method="post" action="">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>
