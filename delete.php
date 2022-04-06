<?php

$userId = isset($_GET['id'])  ? intval($_GET['id']) : '' ;

$userFile = file("users.txt");


if( isset($userFile[$userId]) ) {

    unset($userFile[$userId]);
    file_put_contents('users.txt',implode("",$userFile));
    header("location:users.php");

} else {
    header("location:users.php");
}


