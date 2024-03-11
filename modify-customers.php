<?php 
require "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Customer_Id']) && isset($_POST['Customer_Fname']) && isset($_POST['Contact'])
        && isset($_POST['Email']) && isset($_POST['Address'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $cust_id =validate($_POST['Customer_Id']);
        $cust_name = validate($_POST['Customer_Fname']);
        $contact = validate($_POST['Contact']);
        $email = validate($_POST['Email']);
        $address = validate($_POST['Address']);

        $user_data = 'cust_name='. urlencode($cust_name). '&email='. urlencode($email);

        if (empty($cust_name) || empty($email)|| empty($contact) || empty($address)) {
            header("Location: ../customers.php?error=All fields are required&$user_data");
            exit();
        } else {
            // Prepare the SQL UPDATE statement
            $sql2 = "UPDATE `customers` SET 
            Customer_Fname='$cust_name',
            Email='$email',
            Contact='$contact',
            Address='$address'
            WHERE Customer_Id='$cust_id'";
            
            // Execute the query
            $result2 = mysqli_query($conn1, $sql2);
            if ($result2) {
                header("Location: customers.php?success=Your account has been updated successfully");
                exit();
            } else {
                header("Location: customers.php?error=Unknown error occurred&$user_data");
                exit();
            }
        }
    } else {
        header("Location: customers.php?error=All fields are required");
        exit();
    }
} else {
    header("Location: customers.php?error=Invalid request");
    exit();
}
?>
