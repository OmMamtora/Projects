<?php

if(isset($_POST['submit'])){ 
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    $conn=mysqli_connect("localhost","root","","hospital_management");

    if($conn===false){
        die("Error Occur ".mysqli_connect_error());
    }
    else{
        $query="INSERT INTO contactus (name,email,message) VALUES (?,?,?)";

        $stmt=mysqli_prepare($conn,$query);

        if($stmt){
            mysqli_stmt_bind_param($stmt,"sss",$name,$email,$message);

            if(mysqli_stmt_execute($stmt)){
                echo "Record Insert";
            }
            else{
                echo "Error: Your record not inserted..".mysqli_error($conn);
            }
        }
        else{
            echo "Query Not Prepared..";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    }
}
?>
