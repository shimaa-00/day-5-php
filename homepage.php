<?php
include 'header.php';
!isset( $_SESSION['username']) ? header('location:index.php') : '';
?>
<div class="container">
    <h1>Welcome <?= $_SESSION['username'] ?></h1>
</div class="container">

<? include 'footer.php' ?>;