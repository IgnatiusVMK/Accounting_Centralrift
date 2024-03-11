<?php

require "db_conn.php";

if(isset($_GET['id'])){
    $id=$_GET['id'];


    $sql="DELETE FROM `auth_user` WHERE id= '$id' ";
    $delete=mysqli_query($conn1, $sql);
    if($delete){
        // echo "User Deleted!";
        header('location: ../tables.php');
    } else {
        echo "Error deleting user: " . mysqli_error($conn1);
    }
} else {
    echo "No user ID provided!";
}

?>