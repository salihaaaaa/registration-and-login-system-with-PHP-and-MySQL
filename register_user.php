<?php
    session_start();
    include 'connectdb.php';

    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Receive input values from the form
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];

        // Form validation: ensure the form is correctly filled
        if (empty($_POST['username'])) {
            array_push($errors, 'Username required');
        }
        if (empty($_POST['password1'])) {
            array_push($errors, 'Password required');
        }
        if ($password1 != $password2) {
            array_push($errors, 'Password not match');
        }
        if (empty($_POST['email'])) {
            array_push($errors, 'Email required');
        }

        // Check if username or email already exist in database
        $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();

        if ($user) { // if user exist
            if ($user['username'] === $username) {
                array_push($errors, 'Username already exist');
            }
            if ($user['email'] === $email) {
                array_push($errors, 'Email already exist');
            }
        }

        // Register user if no error
        if (count($errors) == 0) {
            $passwordHash = password_hash($password1, PASSWORD_DEFAULT); //Encrypt password 
            $sql_query = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";
            $conn->query($sql_query);

            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = 'You are already logged in';
            header('location: index.php');
        }
    }
?>