<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />

    <title>Discussss!</title>
</head>

<body>
    <?php include 'files/header.php'; ?>
    <?php include 'files/dbconnect.php'; ?>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        $sql = "SELECT `user_email` FROM `users` WHERE `sno` = $thread_user_id";
        $result2 = mysqli_query($connect,$sql);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'POST') {
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt",$comment);
        $comment = str_replace(">","&gt",$comment);
        $sno = $_POST['sno'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
        $result = mysqli_query($connect, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Comment added! </strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    }
    ?>

    <!-- Cards Here -->

    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">
                <?php echo $title ?>
            </h1>
            <p class="lead">
                <?php echo $desc ?>
            </p>
            <hr class="my-4" />
            <p>This is peer to peer forum for sharing knowledge with each other. Warn About Adult Content. Do not spam.
                Do Not Bump Posts. Do Not Offer to Pay for Help. Do Not Offer to Work For Hire. Do Not Post About
                Commercial Products.</p>
            <p>Posted by:<b> <?php echo $posted_by; ?></b></p>
        </div>
    </div>


    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '<div class="container">
        <h2 class="py-2">Post a comment!</h2>
        <form action=" '.$_SERVER['REQUEST_URI'].' " method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type here!</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION['sno'].'">
            </div>
            <button type="submit" class="btn btn-success">Post</button>
        </form>
    </div>';
    } else {
        echo '<div class="container">
        <div class="jumbotron">
        <h1 class="display-4">Post a comment!</h1>
        <p class="lead">You are currently not logged in.</p>
        <hr class="my-4">
        <p>To comment you have to login first. Login or Signup via button below.</p>
        <button class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal">Login</button>
  <button class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>
      </div></div>';
    }
    ?>
    


    <div class="container">
        <h1 class="py-2">Discussions</h1>
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id";
        $result = mysqli_query($connect, $sql);
        $rowLen = mysqli_num_rows($result);
        if ($rowLen > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['comment_id'];
                $content = $row['comment_content'];
                $time = $row['comment_time'];
                $thread = $row['comment_by'];
                $sql = "SELECT `user_email` FROM `users` WHERE `sno` = $thread";
                $result2 = mysqli_query($connect,$sql);
                $row2 = mysqli_fetch_assoc($result2);

                echo '<div class="media my-3">
            <img src="./img/user.jpeg" width="34px" class="mr-3" alt="..." />
            <div class="media-body">
                <p class="font-weight-bold my-0">'.$row2['user_email'].'</p>
                <p>'.$time.'</p>
                    -' . $content . '
                
            </div>
        </div>';
            }
        } else {
            echo '
            <div class="jumbotron jumbotron-fluid" id="jumbo">
              <div class="container">
                <h3 class="display-4">No Comments yet!</h3>
                // <p class="lead">Be the first one to reply to this discussion.</p>
              </div>
            </div>
            ';
        }


        ?>
    </div>

    <?php include 'files/footer.php'; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
</body>

</html>