<?php
    session_start();
    include 'connectdb.php';

    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($_POST['username'])) {
            array_push($errors, 'Username required');
        }
        if (empty($_POST['password'])) {
            array_push($errors, 'Password required');
        }

        // User sign in if no error
        if (count($errors) == 0) {
            $sql = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($sql);
    
            if ($result->num_rows == 1) { // Username exist
                $sql_query = "SELECT password FROM users WHERE username='$username'";
                $result_query = $conn->query($sql_query);
                $row = mysqli_fetch_array($result_query, MYSQLI_ASSOC);
                $passwordHash = $row['password'];

                if (password_verify($password, $passwordHash)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['logged_in'] = 'You are already logged in';
                    header('location: index.php');
                } else {
                    array_push($errors, 'Wrong combination of username/password');
                }

            } else {
                array_push($errors, 'Username not exist');
            }
        }
    }
?>
