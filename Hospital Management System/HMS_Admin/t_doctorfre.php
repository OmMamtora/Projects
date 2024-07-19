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

        a.delete-link {
            color: #ff0000;
            text-decoration: none;
        }

        a.delete-link:hover {
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
        $id = $_GET['delete'];
        $query = "DELETE FROM doctor WHERE d_id=$id";
        $result = mysqli_query($conn, $query);
        if($result){
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }

    $query="SELECT * FROM doctor";
    
    if($result=mysqli_query($conn,$query)){
        if(mysqli_num_rows($result) > 0){
            echo "<table>";
            echo "<tr>";
            echo "<th>Doctor Id</th>";
            echo "<th>Doctor Name</th>";
            echo "<th>Doctor Email</th>";
            echo "<th>Doctor Joining Date</th>";
            echo "<th>Doctor Mobile No</th>";
            echo "<th>Doctor Specialty</th>";
            echo "<th>Doctor Hospital Name</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            while($row=mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>".$row["d_id"]."</td>";
                echo "<td>".$row["d_name"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["joining_date"]."</td>";
                echo "<td>".$row["mobile_no"]."</td>";
                echo "<td>".$row["specialty"]."</td>";
                echo "<td>".$row["hospital_name"]."</td>";
                echo "<td><a class='delete-link' href='?delete=".$row["d_id"]."'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
    else{
        echo "Query Not Prepared: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>

</body>
</html>