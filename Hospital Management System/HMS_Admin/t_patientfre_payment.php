<!DOCTYPE html>
<html>
<head>
    <style>
        form {
            margin: 20px;
        }
    </style>
</head>
<body>

<?php
    if(isset($_POST['delete'])) {
        $p_id = $_POST['delete'];
        // Prompt the user for payment
        echo "<form action='t_patientfre.php' method='post'>
                <input type='hidden' name='p_id' value='".$p_id."'>
                <label for='amount'>Enter amount:</label><br>
                <input type='text' id='amount' name='amount'><br><br>
                <input type='submit' value='Pay'>
            </form>";
    } else {
        echo "Invalid request";
    }
?>

</body>
</html>
