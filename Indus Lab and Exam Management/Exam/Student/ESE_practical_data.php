<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dropdown Accordion</title>
<link rel="stylesheet" href="Registration.css">
</head>
<body>

<form id="eseFormPra" method="post">
  <div class="container">
    <span class="msg">ESE Practical Registration</span>
    <label for="name">Name: </label>
    <input type="text" id="name" name="name" placeholder="Enter Full Name:">

    <label for="email">Email: </label>
    <input type="text" id="email" name="email" placeholder="Enter your Indus Email_ID..">

    <label for="enrollment">Enrollment No: </label>
    <input type="text" id="enrollment" name="enrollment" placeholder="Enter your Enrollment No..">

    <label for="branch">Branch: </label>
    <input type="text" id="branch" name="branch" placeholder="Enter your Branch:">  
  </div>

  <select id="mainDropdown" name="semester" id="semester" onchange="populateAccordionDropdown()">
    <option value="" disabled selected>Select Semester</option>
    <option value="sem 1">Sem 1</option>
    <option value="sem 2">Sem 2</option>
    <option value="sem 3">Sem 3</option>
    <option value="sem 3">Sem 4</option>
    <option value="sem 3">Sem 5</option>
    <option value="sem 3">Sem 6</option>
  </select>

  <select id="accordionDropdown" name="subject" id="subject">
    <option value="" disabled selected>Select Subject</option>
  </select>

  <div class="buttons">
    <div class="add_btn">
      <button type="submit" id="addButton" name="add_data" formaction="ESE_practical_data.php"> + Add</button>
    </div>
  
    <div class="payment_btn">
      <button type="submit" name="pay_now" id="pay_now" formaction="Payment.php">Pay Now</button>
    </div>
  
    <div class="cancel_btn">
      <button type="button" onclick="resetForm()">Cancel</button>
    </div>
  </div>
</form>

<script>
  function populateAccordionDropdown() {
    var mainDropdown = document.getElementById('mainDropdown');
    var accordionDropdown = document.getElementById('accordionDropdown');
    var selectedValue = mainDropdown.value;
    accordionDropdown.innerHTML = ''; // Clear previous options
    
    if (selectedValue === 'sem 1') {
      accordionDropdown.add(new Option('FODBMS', 'Fundament of database'));
      accordionDropdown.add(new Option('LBT', 'Logic Building'));
    } 
    else if (selectedValue === 'sem 2') {
      accordionDropdown.add(new Option('ADBMS', 'Advance Database management system'));
      accordionDropdown.add(new Option('POP', 'Principles of Programming'));
      accordionDropdown.add(new Option('PCS', 'Personal Computer Software'));
    }
    else if (selectedValue === 'sem 3') {
      accordionDropdown.add(new Option('OOP', 'Object Oriented Programming Language C++'));
      accordionDropdown.add(new Option('IWT', 'Introduction to Web Technology'));
    }
    else if (selectedValue === 'sem 4') {
      accordionDropdown.add(new Option('AOOP', 'Advance Object Oriented Programming'));
      accordionDropdown.add(new Option('SOODAM', 'SOODAM'));
      accordionDropdown.add(new Option('DS', 'Data Structure'));
    }
    else if (selectedValue === 'sem 5') {
      accordionDropdown.add(new Option('SDP-I', 'Software Project Development -I'));
      accordionDropdown.add(new Option('PHP', 'Open Source Programming Language'));
      accordionDropdown.add(new Option('SSP', 'Shell Scripting'));
    }
    else if (selectedValue === 'sem 6') {
      accordionDropdown.add(new Option('SDP-II', 'Software Project Development -II'));
      accordionDropdown.add(new Option('AAD', 'Android Application Development'));
      accordionDropdown.add(new Option('ASP.NET', 'ASP.NET'));
      accordionDropdown.add(new Option('Python', 'Python Programming'));
    }
  }

  function resetForm() {
    document.getElementById("eseFormPra").reset();
  }
</script>

<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $enrollment = $_POST['enrollment'];
    $branch = $_POST['branch'];
    $semester = $_POST['semester'];
    $subject = $_POST['subject'];

    // Store the data in a session variable
    $data = array(
        'name' => $name,
        'email' => $email,
        'enrollment' => $enrollment,
        'branch' => $branch,
        'semester' => $semester,
        'subject' => $subject
    );

    $_SESSION['submitted_data'][] = $data; // Append data to the session variable

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL statement
    $sql1 = "INSERT INTO ese_practical (name,email,enrollment_no,branch,semester,subject) VALUES (?,?,?,?,?,?)";
    
    // Prepare and bind parameters
    $stmt = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $enrollment, $branch, $semester, $subject);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Data added successfully to the database";
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ESE_practical_data.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

</body>
</html>
