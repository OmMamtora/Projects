<?php
    $conn=mysqli_connect("localhost","root","","hospital_management");

    if($conn===false){
        die("Error Occure..".mysqli_connect_error());
    }
    else{
        $query="SELECT * FROM medical";

        $result = mysqli_query($conn,$query);

$conn->close();
    }
?>

<html>
<head>
    <title>Manage Medicine</title>
    <link rel="stylesheet" href="manage_medicine.css">
</head>
<body>
    <div class="appointment">
        <h2>Manage Medicine</h2>
        
        <?php
        // Check if appointments are retrieved successfully
        if (mysqli_num_rows($result)>0) {
            echo "<table border=1>";
            echo "<tr><th>ID</th><th> Medicine Type</th><th>Medicine Name</th><th>Stoke</th><th>quantity</th><th>price</th></tr>";

            // Output data of each row
            while ($row =mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["m_id"] . "</td>";
                echo "<td>" . $row["m_type"] . "</td>";
                echo "<td>" . $row["m_name"] . "</td>";
                echo "<td>" . $row["m_stoke"] . "</td>";
                echo "<td>" . $row["m_quantity"] . "</td>";
                echo "<td>" . $row["m_price"] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No appointments found.";
        }
        ?>
    </div>
</body>
</html>
