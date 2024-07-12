<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Detail Dashboard</title>
    <link rel="stylesheet" href="exam_facu_dash.css">
    <!-- Add any necessary CSS or external stylesheets here -->
    <style>
        /* Additional CSS styles for the messages */
        .error-message {
            color: #ff0000;
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Buttons to select data categories -->
        <button class="data-button" onclick="loadData('MSE Theory')">MSE Theory</button>
        <button class="data-button" onclick="loadData('ESE Theory')">ESE Theory</button>
        <button class="data-button" onclick="loadData('MSE Practical')">MSE Practical</button>
        <button class="data-button" onclick="loadData('ESE Practical')">ESE Practical</button>
        
        <!-- Search form -->
        <form id="searchForm" method="post">
            <label>Enter Enrollment Number: </label>
            <input type="text" id="searchInput" name="search_enrollment">
            <input type="hidden" id="categoryInput" name="category" value="">
            <input type="submit" value="Search">
        </form>
    </div>

    <!-- Container to display fetched data -->
    <div id="dataContainer">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle form submission
            $enrollmentNo = $_POST["search_enrollment"];
            $category = $_POST["category"];
            
            // Check if enrollment number is provided
            if (!empty($enrollmentNo) && !empty($category)) {
                // Establish connection to the database
                $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

                if ($conn === false) {
                    die("Error: Could not connect. " . mysqli_connect_error());
                }

                // Fetch data based on category
                switch ($category) {
                    case 'MSE Theory':
                        $sql = "SELECT * FROM mse_theory WHERE enrollment_no = '$enrollmentNo'";
                        break;
                    case 'ESE Theory':
                        $sql = "SELECT * FROM ese_theory WHERE enrollment_no = '$enrollmentNo'";
                        break;
                    case 'MSE Practical':
                        $sql = "SELECT * FROM mse_practical WHERE enrollment_no = '$enrollmentNo'";
                        break;
                    case 'ESE Practical':
                        $sql = "SELECT * FROM ese_practical WHERE enrollment_no = '$enrollmentNo'";
                        break;
                    default:
                        echo '<p class="error-message">Invalid category</p>';
                        break;
                }

                // Execute the query if $sql is not empty
                if (!empty($sql)) {
                    $result = mysqli_query($conn, $sql);

                    // Display the fetched data in a table
                    if (mysqli_num_rows($result) > 0) {
                        echo "<table border='1'>";
                        echo "<tr><th>Name</th><th>Email</th><th>Enrollment</th><th>Branch</th><th>Semester</th><th>Subject</th></tr>";
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
                        echo "<p class='error-message'>No data found..</p>";
                    }
                }

                // Close the database connection
                mysqli_close($conn);
            } else {
                echo "<p class='error-message'>Please enter both enrollment number and select a category.</p>";
            }
        }
        ?>
    </div>

    <script>
        // Function to set the category value before form submission
        function loadData(category) {
            document.getElementById("categoryInput").value = category;
        }
    </script>
</body>
</html>
