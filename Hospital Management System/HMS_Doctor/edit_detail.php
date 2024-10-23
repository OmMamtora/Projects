<!DOCTYPE html>
<html>
<head>
    <title>Doctor Detail</title>
    <link rel="stylesheet" href="doctordetail.css">
</head>
<body>
    <div class="doctor-detail">
        <h2>Doctor Detail</h2>

        <?php
        if (isset($result) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <div class="doctor-info">
                    <form method="POST" action="update_doctor.php">
                        <label>Name: </label>
                        <input type="text" name="d_name" value="<?php echo $row['d_name']; ?>"><br>

                        <label>Email: </label>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>

                        <label>Joining Date: </label>
                        <input type="text" name="joining_date" value="<?php echo $row['joining_date']; ?>"><br>

                        <label>Mobile No: </label>
                        <input type="text" name="mobile_no" value="<?php echo $row['mobile_no']; ?>"><br>

                        <label>Specialty: </label>
                        <input type="text" name="specialty" value="<?php echo $row['specialty']; ?>"><br>

                        <label>Username: </label>
                        <input type="text" name="username" value="<?php echo $row['username']; ?>"><br>

                        <label>Password: </label>
                        <input type="text" name="password" value="<?php echo $row['password']; ?>"><br>

                        <label>Hospital Name: </label>
                        <input type="text" name="hospital_name" value="<?php echo $row['hospital_name']; ?>"><br>

                        <!-- Add the primary key in a hidden field -->
                        <input type="hidden" name="original_d_name" value="<?php echo $row['d_name']; ?>">

                        <input type="submit" name="edit" value="Update">
                    </form>
                </div>
                <div class="edit-button">
                    <input type="submit" name="update" value="Update">
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
