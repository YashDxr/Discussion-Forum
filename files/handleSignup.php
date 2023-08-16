<?php
$showError = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include './dbconnect.php';
    $email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    //check if already exists
    $check = "SELECT * FROM `users` WHERE `user_email` = '$email'";
    $result = mysqli_query($connect,$check);
    $rows = mysqli_num_rows($result);
    if($rows>0){
        $showError = "Email already taken";
    }
    else{
        if($pass==$cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$email', '$hash', current_timestamp())";
            $result = mysqli_query($connect,$sql);
            if($result){
                $showAlert = true;
                header("Location: /Forum/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "Password and Confirm Password should be same";
        }
    }
    header("Location: /Forum/index.php?signupsuccess=false&error=$showError");
}

?>