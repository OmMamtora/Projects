<?php
session_start(); // Start the session

// Handle form submissions
if (isset($_POST['add_data'])) {
    if (isset($_POST['eseFormTheo'])) {
        handleESETheoryForm();
    } elseif (isset($_POST['mseFormPra'])) {
        handleMSEPracticalForm();
    } elseif (isset($_POST['mseFormTheo'])) {
        handleMSETheoryForm();
    } elseif (isset($_POST['eseFormPra'])) {
        handleESEPracticalForm();
    } elseif (isset($_POST['pay_now'])) { // Handle Pay Now button submission
        handlePayNow();
    } else {
        echo "No form submitted";
    }
}

// Function to handle ESE Theory form submission
function handleESETheoryForm() {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $enrollment = $_POST['enrollment'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $subject = $_POST['subject'] ?? '';

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement for ESE Theory insertion
    $sql = "INSERT INTO ese_theory (name, email, enrollment_no, branch, semester, subject) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $enrollment, $branch, $semester, $subject);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data added successfully to the database";
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return;
    }

    // Close connection
    mysqli_close($conn);

    // Redirect to display page
    header("Location: ESE_theory_data.php");
    exit;
}

// Function to handle MSE Practical form submission
function handleMSEPracticalForm() {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $enrollment = $_POST['enrollment'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $subject = $_POST['subject'] ?? '';

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement for MSE Practical insertion
    $sql = "INSERT INTO mse_practical (name, email, enrollment_no, branch, semester, subject) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $enrollment, $branch, $semester, $subject);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data added successfully to the database";
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return;
    }

    // Close connection
    mysqli_close($conn);

    // Redirect to display page
    header("Location: MSE_practical_data.php");
    exit;
}

// Function to handle MSE Theory form submission
function handleMSETheoryForm() {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $enrollment = $_POST['enrollment'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $subject = $_POST['subject'] ?? '';

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement for MSE Theory insertion
    $sql = "INSERT INTO mse_theory (name, email, enrollment_no, branch, semester, subject) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $enrollment, $branch, $semester, $subject);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data added successfully to the database";
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return;
    }

    // Close connection
    mysqli_close($conn);

    // Redirect to display page
    header("Location: MSE_theory_data.php");
    exit;
}

// Function to handle ESE Practical form submission
function handleESEPracticalForm() {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $enrollment = $_POST['enrollment'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $semester = $_POST['semester'] ?? '';
    $subject = $_POST['subject'] ?? '';

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement for ESE Practical insertion
    $sql = "INSERT INTO ese_practical (name, email, enrollment_no, branch, semester, subject) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $enrollment, $branch, $semester, $subject);

    // Execute statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data added successfully to the database";
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return;
    }

    // Close connection
    mysqli_close($conn);

    // Redirect to display page
    header("Location: ESE_practical_data.php");
    exit;
}

// Function to handle Pay Now button submission
function handlePayNow() {
    // Check if any form is submitted
    if (!isset($_POST['eseFormTheo']) && !isset($_POST['mseFormPra']) && !isset($_POST['mseFormTheo']) && !isset($_POST['eseFormPra'])) {
        echo "No form submitted";
        return; // Exit the function
    }

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Define query variable
    $query = '';

    // Determine table name based on form submitted
    if (isset($_POST['eseFormTheo'])) {
        $query = "SELECT * FROM ese_theory ORDER BY ese_theo_id";
    } elseif (isset($_POST['mseFormPra'])) {
        $query = "SELECT * FROM mse_practical ORDER BY mse_prac_id";
    } elseif (isset($_POST['mseFormTheo'])) {
        $query = "SELECT * FROM mse_theory ORDER BY mse_theo_id";
    } elseif (isset($_POST['eseFormPra'])) {
        $query = "SELECT * FROM ese_practical ORDER BY ese_prac_id";
    }

    // Execute query if not empty
    if ($query !== '') {
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Display data
                echo "<table border='1'>";
                echo "<tr><th>Name</th><th>Email</th><th>Enrollment No</th><th>Branch</th><th>Semester</th><th>Subject</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['enrollment_no'] . "</td>";
                    echo "<td>" . $row['branch'] . "</td>";
                    echo "<td>" . $row['semester'] . "</td>";
                    echo "<td>" . $row['subject'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No recent data entry found.";
            }
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>
