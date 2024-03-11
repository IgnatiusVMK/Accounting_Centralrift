<?php

require "db_conn.php";

if(isset($_GET['CustomerId'])){
    $id=$_GET['CustomerId'];


    $sql="DELETE FROM customers WHERE Customer_Id= '$id' ";
    $delete=mysqli_query($conn1, $sql);
    if($delete){
        // echo "User Deleted!";
        header('location: ../customers.php');
    } else {
        echo "Error deleting user: " . mysqli_error($conn1);
    }
} else {
    // echo "No user ID provided!";
    header('location: customers.php?error=No user ID provided!');
}

?>