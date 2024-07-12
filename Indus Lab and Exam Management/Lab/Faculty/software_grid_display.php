<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Software Complain</title>
    <link rel="stylesheet" href="software_grid.css">
</head>
<body>
    <form method="post">
    <label for="Select" style="width:150px;">Select Option</label>
        <select id="labNo" name="labNo">
            <option disabled selected>Select Lab</option>
            <option value="Lab1">Lab 1</option>
            <option value="Lab2">Lab 2</option>
            <option value="Lab3">Lab 3</option>
            <option value="Lab4">Lab 4</option>
            <option value="Lab5">Lab 5</option>
        </select>
        <div class="submit" style="padding-left: 150px">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

        if ($conn === false) {
            die("Error " . mysqli_connect_error());
        }

        $selectedNo = $_POST['labNo'];

        // Remove single quotes around '?' in the SQL query
        $sql = "SELECT * FROM software_requirement WHERE lab_no = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $selectedNo);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='software-table'>";
                    echo "<tr><th>Lab No</th><th>PC No</th><th>Problem</th><th>Status</th></tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['lab_no'] . "</td>";
                        echo "<td>" . $row['pc_no'] . "</td>";
                        echo "<td>" . $row['problem'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<div style='color: red; font-weight: bold; font-size:18px; margin-top: 20px;'>No software data found for the selected lab..</div>";
                }
            } else {
                echo "Error executing SQL query: " . mysqli_error($conn);
            }
        } else {
            echo "Error preparing SQL statement: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    ?>
</body>
</html>
