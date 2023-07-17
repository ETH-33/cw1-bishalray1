<?php

include('include/functions.php');

if (isset($_POST['user_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $select_user = "SELECT * FROM users_details WHERE Email='$email'";
    $result = mysqli_query($con, $select_user) or die('Failed to query');
    $row = mysqli_fetch_array($result);

    if ($row) {
        $hashedPassword = $row['Password'];

        // Verify the password using password_verify()
        if (password_verify($password, $hashedPassword)) {
            if ($row['Email'] == "admin@gmail.com") {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: index.php");
            }

            $_SESSION['loggedUserName'] = $row['FirstName'];
            $_SESSION['loggedUserId'] = $row['UserId'];
        } else {
            $error = "Invalid Username and Password!";
            error('login.php', $error);
        }
    } else {
        $error = "Invalid Username and Password!";
        error('login.php', $error);
    }
}
?>
