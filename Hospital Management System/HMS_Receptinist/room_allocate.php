<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $patient_name = $_POST['patient_name'];
        $patient_id = $_POST['patient_id'];
        $room_type = $_POST['room_type'];
        $room_floor = $_POST['room_floor'];

        $conn = mysqli_connect("localhost", "root", "", "hospital_management");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        
        $insert_query = "INSERT INTO room (ro_id, ro_type ,room_floor,p_id,ro_entry,patient_name) VALUES (?, ?, ?, ?, ?,?)";

        if($stmt=mysqli_prepare($conn, $insert_query)) {
            mysqli_stmt_bind_param($stmt,"siis", $room_type,$room_floor,$patient_id, $patient_name );
            
            if(mysqli_execute($stmt)) {
                echo "Room Allocated to patient ".$patient_name;
        }
        else{
            echo "Room Not Allocated..".mysqli_error($conn);
        }

    }
    else{
        echo "Query Not Prepared..".mysqli_error($conn);
    }
        mysqli_close($conn);
    }
?>
