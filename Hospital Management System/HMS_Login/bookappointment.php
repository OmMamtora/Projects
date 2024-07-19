<?php
    if(isset($_POST['submit'])){
       $p_name=$_POST['patientName'];
       $p_email=$_POST['patient_email'];
       $doctor=$_POST['doctor'];
       $app_date=$_POST['appointment_date'];
       $app_slot=$_POST['slot_time'];


       $conn=mysqli_connect("localhost","root","","hospital_management");

       if($conn===false){
        die("Error Occur: please check it".mysqli_connect_error());
       }
       else{
        $query="INSERT INTO appointment (p_name,email,d_name,date,slot) VALUES(?,?,?,?,?)";

        $stmt=mysqli_prepare($conn,$query);

        if($stmt){
            mysqli_stmt_bind_param($stmt,"sssss",$p_name,$p_email,$doctor,$app_date,$app_slot);

            if(mysqli_stmt_execute($stmt)){
                echo "Appointment  successful booked ! Welcome,. $p_name . '.'";
            }
            else{
                echo "Error : Record Not Inserted..".mysqli_error($conn);
            }
        }
        else{
            echo "Query Not Prepared..".mysqli_error($conn);
        }
        mysqli_close($conn);
       }
    }

?>
