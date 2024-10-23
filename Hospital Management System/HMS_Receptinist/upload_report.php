<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $p_id = $_POST['p_id'];
    $file_name = $_FILES['upload']['name'];
    $file_tmp = $_FILES['upload']['tmp_name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES['upload']['size'] > 52428800) { // 50 MB in bytes
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        echo "Sorry, only PDF, DOC, DOCX files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($file_tmp, $target_file)) {
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "hospital_management");

            if ($conn === false) {
                die("Error Occurred: " . mysqli_connect_error());
            }

            $file_path = $target_file; // You may modify this based on your server configuration

            // Insert file details into the patient table
            $insert_query = "INSERT INTO patient (p_id, file_name, file_path) VALUES ('$p_id', '$file_name', '$file_path')";

            if (mysqli_query($conn, $insert_query)) {
                echo "The file " . htmlspecialchars(basename($file_name)) . " has been uploaded and record added to the database.";
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
