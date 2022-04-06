<?php
include 'header.php';

// view user data
$userid = isset($_GET['id']) ? $_GET['id'] :  header('location:./users.php');

//read from file
$userdata = file('users.txt');

// Check if there is user with this id
if( isset($userdata[$userid]) ){
    $column = explode(':',$userdata[$userid]);
    ?>
    <div class="container-list">
        <h2 class="title">User Info</h2>
        <ul class="list">
            <li><span class="label-info">Firstname:</span><span class="label-data"><?= $column[0]?> </span></li>
            <li><span class="label-info">Lastname:</span><span class="label-data"><?= $column[1]?> </span></li>
            <li><span class="label-info">Address:</span><span class="label-data"><?= $column[2]?> </span></li>
            <li><span class="label-info">Gender:</span><span class="label-data"><?= $column[3]?> </span></li>
            <li><span class="label-info">Skills:</span><span class="label-data"><?= $column[4]?> </span></li>

        </ul>
        <a href="users.php" class="btn btn-primary">view users</a>
    </div>


    <?php

} else {
    header('location:users.php');
}
