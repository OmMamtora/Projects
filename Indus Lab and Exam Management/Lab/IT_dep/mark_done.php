<?php

$conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

if ($conn === false) {
    die("Error: Unable to connect to the database. " . mysqli_connect_error());
}

if (isset($_POST['mark_done'])) {

    $software_id = $_POST['entry_id']; 
    $hardware_id = $_POST['entry_id']; 

    $sql = "UPDATE software_requirement SET status = 'Done' WHERE software_id = $software_id";
    $sql1 = "UPDATE hardware_requirement SET status = 'Done' WHERE hardware_id = $hardware_id";

    // Execute the update queries separately
    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)) {
        echo "<div style='color:#2f1cff; font-weight: bold; font-size:35px'>Data updated please check it..</div>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
