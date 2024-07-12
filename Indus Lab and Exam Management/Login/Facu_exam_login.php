<?php
if(isset($_POST['submit'])){
    $conn = mysqli_connect("localhost","root","","lab_exam_management");
    if($conn === false){
        die("Error Occurs..".mysqli_connect_error());
    }
    else{
        $username = $_POST['username'];
        $password = $_POST['password'];
       
        $sql =  "SELECT * FROM faculty_login WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            if($row){
                header ("Location: http://localhost/Om%20sem-6/SDP-II/Exam/Faculty/dashboard.html");
                exit;
            }
            else {
                echo "<p style='color: red; font-weight: bold;'>Username And Password check it again..</p>";
            }
            mysqli_free_result($result);
        }
        mysqli_close($conn);
    }
}
?>
