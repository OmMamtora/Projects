<?php

if(isset($_POST['submit'])){
    $conn = mysqli_connect("localhost","root","","lab_exam_management");

    if($conn === false){
        die("Error: Unable to connect to the database. " . mysqli_connect_error());
    }

    $labNo = mysqli_real_escape_string($conn, $_POST['labNo']);
    $pcNo = mysqli_real_escape_string($conn, $_POST['pc_no']);
    $problem = mysqli_real_escape_string($conn, $_POST['problem']);

    $sql = "INSERT INTO hardware_requirement (lab_no, pc_no, problem) VALUES ('$labNo', '$pcNo', '$problem')";

    if (mysqli_query($conn, $sql)) {
        echo "<div style='color:#000000; font-weight: bold; font-size:35px'>New hardware record created successfully.</div>";
    } else {
        echo "Error: ". mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
