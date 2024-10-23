<html>
<head>
  <title>Prescription Data</title>
  <link rel="stylesheet" href="prescription.css">
</head>
<body>

<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "hospital_management"; // replace with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM prescription";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  echo "<table>
          <tr>
            <th>Patient ID</th>
            <th>Prescription Date</th>
            <th>Prescription Text</th>
          </tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>".$row["patient_id"]."</td>
            <td>".$row["prescription_date"]."</td>
            <td>".$row["prescription_text"]."</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
mysqli_close($conn);
?>

</body>
</html>
