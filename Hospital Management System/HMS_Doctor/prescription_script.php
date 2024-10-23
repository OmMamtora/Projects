<?php
// Create connection
$conn = mysqli_connect("localhost", "root", "", "hospital_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['patient_id']) && isset($_POST['prescription_text'])) {
    $patient_id = $_POST['patient_id'];
    $prescription_text = $_POST['prescription_text'];

    // Update the patient table with the prescription
    $update_query = "UPDATE patient SET prescription = ? WHERE p_id = ?";
    $insert_query = "INSERT INTO prescription (patient_id, prescription_text, prescription_date) VALUES (?, ?, ?)";

    // Prepare and bind the update query
    $update_statement = mysqli_prepare($conn, $update_query);
    mysqli_stmt_bind_param($update_statement, "si", $prescription_text, $patient_id);

    // Execute the update statement
    if (mysqli_stmt_execute($update_statement)) {
        // Check if the record already exists
        $check_query = "SELECT * FROM prescription WHERE patient_id = ?";
        $check_statement = mysqli_prepare($conn, $check_query);
        mysqli_stmt_bind_param($check_statement, "i", $patient_id);
        mysqli_stmt_execute($check_statement);
        mysqli_stmt_store_result($check_statement);

        // If the record doesn't exist, insert it
        if (mysqli_stmt_num_rows($check_statement) == 0) {
            // Prepare and bind the insert query
            $insert_statement = mysqli_prepare($conn, $insert_query);
            $prescription_date = date('Y-m-d'); // Assuming today's date
            mysqli_stmt_bind_param($insert_statement, "iss", $patient_id, $prescription_text, $prescription_date);

            // Execute the insert statement
            if (mysqli_stmt_execute($insert_statement)) {
                echo "Prescription added successfully for patient with ID: $patient_id.";
            } else {
                echo "Error inserting record: " . mysqli_error($conn);
            }

            // Close the insert statement
            mysqli_stmt_close($insert_statement);
        } else {
            echo "Record already exists for patient with ID: $patient_id.";
        }

        // Close the check statement
        mysqli_stmt_close($check_statement);
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the update statement
    mysqli_stmt_close($update_statement);
} else {
    echo "Invalid request.";
}

// Close the connection
mysqli_close($conn);
?>
