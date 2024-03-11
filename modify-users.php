<?php 
require "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            header("Location: tables.php?error=All fields are required&$user_data");
            exit();
        } else {
            // Prepare the SQL UPDATE statement
            $sql2 = "UPDATE `auth_user` SET
            name='$name',
            user_name='$user_name',
            email='$email',
            role='$role',
            status='$status',
            department='$department' 
            WHERE id='$id'";
            
            // Execute the query
            $result2 = mysqli_query($conn1, $sql2);
            if ($result2) {
                header("Location: tables.php?success=Your account has been updated successfully");
                exit();
            } else {
                header("Location: tables.php?error=Unknown error occurred&$user_data");
                exit();
            }
        }
    } else {
        header("Location: tables.php?error=All fields are required");
        exit();
    }
} else {
    header("Location: tables.php?error=Invalid request");
    exit();
}
?>
