<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .delete-link {
            color: #ff0000;
            text-decoration: none;
        }

        .delete-link:hover {
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
    $conn=mysqli_connect("localhost","root","","hospital_management");

    if($conn===false){
        die("Error Occurred: " . mysqli_connect_error());
    }

    if(isset($_GET['delete'])){
        $p_id = $_GET['delete'];
        // Perform deletion operation here with the $p_id
        // After deletion, redirect to the payment page with the patient ID
        header("Location: payment.php?p_id=".$p_id);
        exit;
    }

    $query="SELECT * FROM patient";
    
    if($result=mysqli_query($conn,$query)){
        if(mysqli_num_rows($result) > 0){
            echo "<table>";
            echo "<tr>";
            // Table header
            echo "<th> Patient ID </th>";
            echo "<th> Patient Name </th>";
            echo "<th> Patient Email</th>";
            echo "<th> Patient Phone </th>";
            echo "<th> Patient Address </th>";
            echo "<th> Patient Age </th>";
            echo "<th> Patient Diseases </th>";
            echo "<th> Medical History </th>";
            echo "<th> Prescription </th>";
            echo "<th> Actions </th>";
            echo "</tr>";

            while($row=mysqli_fetch_array($result)){
                echo "<tr>";
                // Table data
                echo "<td>".$row["p_id"]."</td>";
                echo "<td>".$row["p_name"]."</td>";
                echo "<td>".$row["p_email"]."</td>";
                echo "<td>".$row["p_mob"]."</td>";
                echo "<td>".$row["p_add"]."</td>";
                echo "<td>".$row["age"]."</td>";
                echo "<td>".$row["p_diseases"]."</td>";
                echo "<td>".$row["medical_history"]."</td>";
                echo "<td>".$row["prescription"]."</td>";
                // Delete link with patient ID
                echo "<td><a class='delete-link' href='?delete=".$row["p_id"]."'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    else{
        echo "Query Not Prepared: ".mysqli_error($conn);
    }

    mysqli_close($conn);
?>
</body>
</html>
