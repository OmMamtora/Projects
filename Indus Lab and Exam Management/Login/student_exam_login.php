<?php
if(isset($_POST['submit'])){
    $conn = mysqli_connect("localhost","root","","lab_exam_management");
    if($conn === false){
        die("Error Occurs..".mysqli_connect_error());
    }
    else{
        $username = mysqli_real_escape_string($conn, $_POST['username']); // Prevent SQL injection
        $password = mysqli_real_escape_string($conn, $_POST['password']); // Prevent SQL injection
        $sql =  "SELECT * FROM student WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if($result){
            if(mysqli_num_rows($result) > 0) {
                header ("Location: http://localhost/Om%20sem-6/SDP-II/Exam/exam_dashboard.html");
                exit;
            }
            else {
                echo "Username And Password check it again..";
            }
            mysqli_free_result($result);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>
s