<?php

include 'header.php';
// check if user not logged in
!isset($_SESSION['username']) ? header('location:index.php') : '';

$fileContent = file("users.txt");
// Check if file not empty
echo "<div class='container-table'>";
    echo "<table class='table'>";

    if( !empty($fileContent) ) {
        //Loop through each line
        ?>
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Address</th>
            <th>Gender</th>
            <th>skills</th>
            <th>Controll</th>

        </tr>
        <?php
        foreach( $fileContent as $index => $line ) {
            $column = explode(':',$line);

            if( isset($column[1]) ) {


                ?>
                <tr>
                    <td><?= $column[0] ?> </td>
                    <td><?= $column[1] ?> </td>
                    <td><?= $column[2] ?> </td>
                    <td><?= $column[3] ?> </td>
                    <td><?= str_replace(',',' ',$column[4])  ?> </td>
                    <td>
                        <a class="btn btn-primary" href="./viewuser.php?id=<?= $index ?>"> View</a>
                        <a class="btn btn-success" href="./edit.php?id=<?= $index ?>">Edit</a>
                        <a class="btn btn-danger"  href="./delete.php?id=<?= $index ?>">Delete</a>
                    </td>

                </tr>

                <?php
            }



        }
        ?>
        <tr>
            <td colspan="7"><a class="btn btn-primary ms-auto mt-4 d-block" style="width:120px;" href="adduser.php">Add user</a></td>
        </tr>
        <?php
    } else {
        ?>
        <tr>
            <td colspan="2">Sorry no data to show</td>
            <td>
                <a href="./adduser.php" class="btn btn-primary">Add user</a>
            </td>
        </tr>
        <?php
    }
    echo "</table>";
echo "</div>";
include 'footer.php';
?>