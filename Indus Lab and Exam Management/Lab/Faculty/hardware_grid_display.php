<?php
    if (isset($_POST['submit'])) {
        $conn = mysqli_connect("localhost", "root", "", "lab_exam_management");

        if ($conn === false) {
            die("Error " . mysqli_connect_error());
        }

        $selectedNo = $_POST['labNo'];

        // Remove single quotes around '?' in the SQL query
        $sql = "SELECT * FROM hardware_requirement WHERE lab_no = ?";

        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $selectedNo);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    echo "<table class='hardware-table'>";
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
                    echo "<div style='color: red; font-weight: bold; font-size:18px; margin-top: 20px;'>No hardware data found for the selected lab..</div>";
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
