<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .payment-form {
            max-width: 300px;
            margin: 50px auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
    $conn=mysqli_connect("localhost","root","","hospital_management");

    if($conn===false){
        die("Error Occurred: " . mysqli_connect_error());
    }

    if(isset($_POST['submit'])){
        // Process payment data here

        if(isset($_POST['patient_id'])){
            $p_id = $_POST['patient_id'];
            // Perform deletion operation here with the $p_id
            $delete_query = "DELETE FROM patient WHERE p_id='$p_id'";
            if (mysqli_query($conn, $delete_query)) {
                echo "<p>Record deleted successfully.</p>";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }

    if(isset($_GET['p_id'])){
        $p_id = $_GET['p_id'];
        echo "<p>Processing payment for Patient ID: $p_id</p>";
    } else {
        echo "<p>No patient ID found for payment processing.</p>";
    }
?>

<div class="payment-form">
    <form action="" method="post">
        <div class="form-group">
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>
        </div>
        <div class="form-group">
            <label for="expiry_date">Expiry Date:</label>
            <input type="text" id="expiry_date" name="expiry_date" required>
        </div>
        <div class="form-group">
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>
        </div>
        <?php if(isset($p_id)): ?>
            <input type="hidden" name="patient_id" value="<?php echo $p_id; ?>">
        <?php endif; ?>
        <input type="submit" name="submit" value="Submit Payment" class="submit-btn">
    </form>
</div>

<?php
    mysqli_close($conn);
?>
</body>
</html>
