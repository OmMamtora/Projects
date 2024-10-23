<?php
$conn = mysqli_connect("localhost", "root", "", "hospital_management");

if ($conn === false) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $search_name = $_POST['search_name'];

    $query = "SELECT * FROM doctor WHERE d_name = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $search_name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Query Not Prepared..";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Detail</title>
    <link rel="stylesheet" href="doctordetail.css">
</head>
<body>
    <div class="doctor-detail">
        <h2>Doctor Detail</h2>

        <form method="POST">
            <label>Search by Doctor Name: </label>
            <input type="text" name="search_name" id="search_name">
            <input type="submit" name="submit" value="Search"> 
        </form>

        <?php
        if (isset($result) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="doctor-info">
                    <label>Name: </label>
                    <input type="text" name="d_name" value="<?php echo $row['d_name']; ?>" disabled><br>

                    <label>Email: </label>
                    <input type="text" name="email" value="<?php echo $row['email']; ?>" disabled><br>

                    <label>Joining Date: </label>
                    <input type="text" name="joining_date" value="<?php echo $row['joining_date']; ?>" disabled><br>

                    <label>Mobile No: </label>
                    <input type="text" name="mobile_no" value="<?php echo $row['mobile_no']; ?>" disabled><br>

                    <label>Specialty: </label>
                    <input type="text" name="specialty" value="<?php echo $row['specialty']; ?>" disabled><br>

                    <label>Username: </label>
                    <input type="text" name="username" value="<?php echo $row['username']; ?>" disabled><br>

                    <label>Password: </label>
                    <input type="text" name="password" value="<?php echo $row['password']; ?>" disabled><br>

                    <label>Hospital Name: </label>
                    <input type="text" name="hospital_name" value="<?php echo $row['hospital_name']; ?>" disabled><br>

                </div>
                <div class="edit-button">
                    <form action="edit_detail.php">
                        <input type="submit" name="submit" value="Edit">
                    </form>
                </div>
        <?php
            }
        } else {
            echo "No matching doctors found.";
        }
        ?>
    </div>
</body>
</html>
