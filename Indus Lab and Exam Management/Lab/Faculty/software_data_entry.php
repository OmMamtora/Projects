<?php

if(isset($_POST['submit'])){
    // Establish database connection
    $conn = mysqli_connect("localhost","root","","lab_exam_management");

    // Check if connection is successful
    if($conn === false){
        die("Error: Unable to connect to the database. " . mysqli_connect_error());
    }

    // Get form data
    $labNo = mysqli_real_escape_string($conn, $_POST['labNo']);
    $pcNo = mysqli_real_escape_string($conn, $_POST['pc_no']);
    $problem = mysqli_real_escape_string($conn, $_POST['problem']);

    $sql = "INSERT INTO software_requirement (lab_no, pc_no, problem) VALUES ('$labNo', '$pcNo', '$problem')";

    // Execute SQL query
    if (mysqli_query($conn, $sql)) {
        echo "<div style='color:#000000; font-weight: bold; font-size:35px'>New software record created successfully.</div>";
    } else {
        echo "Error: ". mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>
