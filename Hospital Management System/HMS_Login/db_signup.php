<?php

if(isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $mob_no=$_POST['number'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $m_status=$_POST['m_status'];
    $address=$_POST['address'];
    $type_of_user=$_POST['type_of_registration'];
    $emgfirstname=$_POST['emgfirstname'];
    $emglastname=$_POST['emglastname'];
    $emgemail=$_POST['emgemail'];
    $emgnumber=$_POST['emgnumber'];

    $conn=mysqli_connect("localhost","root","","hospital_management");

    if($conn===false){
        die("Error : Could not connect with database..".mysqli_connect_error());
    }
    else{
        $query="INSERT INTO signup (firstname,lastname,email,mob_no,dob,gender,m_status, addres,t_of_user,emgfname,emglname,emgemail,emg_mob_no) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";
       
        $stmt=mysqli_prepare($conn,$query);
    
        if($stmt){
            mysqli_stmt_bind_param($stmt,"sssissssssssi",$firstname, $lastname, $email, $mob_no, $dob, $gender, $m_status, $address, $type_of_user, $emgfirstname, $emglastname, $emgemail, $emgnumber);

            if(mysqli_stmt_execute($stmt)){
                echo " Insert One record..";
            }
            else{
                echo "Error : You record not inserted ".mysqli_error($conn);
            }
        }
        else{
            echo "Query no prepared..";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}

    

?>


