<?php
require "db_conn.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['contact']) && isset($_POST['address'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $cust_name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $contact = validate($_POST['contact']);
        $address = validate($_POST['address']);

        $user_data = 'cust_name='. urlencode($cust_name). '&email='. urlencode($email);

        if (empty($cust_name) || empty($email) || empty($contact) || empty($address)) {
            header("Location: ../customers.php?error=All fields are required&$user_data");
            exit();
        } else {
            $sql ="SELECT * FROM customers WHERE Customer_Fname='$cust_name'";
            $result = mysqli_query($conn1, $sql); 

            if (mysqli_num_rows($result) > 0) {
                header("Location: ../customers.php?error=The username is taken. Please try another&$user_data");
                exit();
            } else {
                $sql2 = " INSERT INTO `customers` (`Customer_Fname`, `Email`, `Contact`, `Address`) 
                VALUES ('$cust_name', '$email', '$contact', '$address')";
                $result2 = mysqli_query($conn1, $sql2);
                if ($result2) {
                    header("Location: ../customers.php?success=Your account has been created successfully");
                    exit();
                } else {
                    header("Location: ../customers.php?error=Unknown error occurred&$user_data");
                    exit();
                }
            }
        }

    } else {
        header("Location: ../customers.php?error=Invalid request");
        exit();
    }
 } else {
     header("Location: ../customers.php");
  exit();
}
?>
