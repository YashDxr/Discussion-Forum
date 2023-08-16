<?php
$showError = false;
if($_SERVER["REQUEST_METHOD"] = "POST"){
    include './dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` WHERE `user_email` = '$email'";
    $result = mysqli_query($connect , $sql);
    $numRow = mysqli_num_rows($result);
    if($numRow == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass , $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;
            echo "Logged in ". $email;
        }
        header("Location: /Forum/index.php");
    }
    header("Location: /Forum/index.php");
}

?>