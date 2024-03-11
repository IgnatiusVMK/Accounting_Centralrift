<?php
require "db_conn.php";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['name'])
        && isset($_POST['user_name']) && isset($_POST['email']) && isset($_POST['role']) && isset($_POST['status']) && isset($_POST['department'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id = validate($_POST['id']);
        $name = validate($_POST['name']);
        $user_name = validate($_POST['user_name']);
        $email = validate($_POST['email']);
        $role = validate($_POST['role']);
        $status = validate($_POST['status']);
        $department = validate($_POST['department']);

        $user_data = 'user_name='. urlencode($user_name). '&name='. urlencode($name);

        if (empty($id) || empty($name) || empty($user_name) || empty($email) || empty($role) || empty($status) || empty($department)) {
            header("Location: ../tables.php?error=All fields are required&$user_data");
            exit();
        } else {
            $sql ="SELECT * FROM auth_user WHERE user_name='$user_name'";
            $result = mysqli_query($conn1, $sql); 

            if (mysqli_num_rows($result) > 0) {
                header("Location: ../tables.php?error=The username is taken. Please try another&$user_data");
                exit();
            } else {
                $sql2 = " INSERT INTO `auth_user` (`id`, `name`, `user_name`, `email`, `role`, `status`, `department`) 
                VALUES ('$id', '$name', '$user_name', '$email', '$role', '$status', '$department')";
                $result2 = mysqli_query($conn1, $sql2);
                if ($result2) {
                    header("Location: ../tables.php?success=Your account has been created successfully");
                    exit();
                } else {
                    header("Location: ../tables.php?error=Unknown error occurred&$user_data");
                    exit();
                }
            }
        }

    } else {
        header("Location: ../tables.php?error=Invalid request");
        exit();
    }
// } else {
//     header("Location: tables.php");
//     exit();
// }
?>
