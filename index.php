<?php


include 'header.php';

// Redirect to homepage if he logging
isset($_SESSION['username']) ? header('location:homepage.php') : '';

// Handle login form data
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $usernamePost = filter_var( $_POST['username'], FILTER_SANITIZE_STRING);
    $passwordPost = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $userexist= false;
    $errorMsg='';
    // read from file to check if user exist
    $userData = file('users.txt');


    foreach ( $userData as $index => $user ) {

        if( isset( $user[5] )) {
            //split to column to extract the username and password
            $recordColumn = explode(':',$user);

            $username = trim( $recordColumn[5] );
            $password = trim( $recordColumn[6] );


            // check if login user exist in file
            if( $usernamePost == $username && $password == $passwordPost) {

                // if user exist start its session
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $index;
                $userexist = true;
                header('location:homepage.php');

            }
        }


    }
    if( $userexist == false ) {
        $errorMsg = 'sorry user not found';
    }

}


?>
<button style="top:20px; border:none; position: absolute ;right:31px; background-color:#dc3545 "><a style="color:#fff;text-decoration: none; padding:4px 13px; display:inline-block"  href="./adduser.php">Add new user</a></button>
<div style="color:red"><?= !empty($errorMsg) ? "sorry use not exist" : ''?></div>
<div class="login-form">
    <h2 class="title">Login Form</h2>
    <form method="post" action = "<?= $_SERVER['PHP_SELF'] ?> ">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" class="form-control" autocomplete="off"/>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off"/>
        </div>
        <div class="form-group">
            <input type="submit" value="login" class="btn-login"/>
        </div>

    </form>
</div>






<? include 'footer.php'; ?>

