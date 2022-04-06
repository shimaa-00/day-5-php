<?php
include 'header.php';

$userId = isset($_GET['id']) ? intval($_GET['id']) : header('location:users.php');
$error = isset($_GET['error']) ? json_decode($_GET['error']) : '';

$userData = file('users.txt');

if( isset($userData[$userId]) ) {
    list($firstname, $lastname, $address, $gender, $skills, $username, $password) = explode(':',$userData[$userId] );
    $skill = explode(',',$skills);

  ?>
    <div class="container-form">
        <form method="post" action="validateuser.php?id=<?= $userId ?>">
            <div class="form-group">
                <label>First name</label>
                <input class="form-style" type="text" name="firstname"
                       value="<?= $firstname ?> "/>
                <span class="error"><?= isset($error->firstname) ? $error->firstname : '' ?></span>
            </div>
            <div class="form-group">
                <label>Last name</label>
                <input class="form-style" ="text" name="lastname" value="<?= $lastname ?>" />
                <span class="error"><?= isset($error->lastname) ? $error->lastname : '' ?></span>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="form-style" type="text" name="address" value="<?= $address?>"/>
                <span class="error"><?= isset($error->address) ? $error->address : '' ?></span>
            </div>

            <!-- Gender-->
            <div class="form-group">
                <label>Gender</label>
                <div class="gender-inline">

                    <input type="radio" name="gender" value="male" id="male" <?= ($gender == 'male') ? 'checked' : ''  ?> />
                    <label for="male">Male</label>
                </div>
                <div class="gender-inline">
                    <input type="radio" name="gender" value="female" id="female" <?= ($gender == 'female') ? 'checked' : ''  ?>/>
                    <label for="female">Female</label>
                </div>
            </div>
            <!-- End gender -->

            <!-- Skills-->
            <div class="form-group">
                <label>Skills</label>
                <div class="inline-checkbox">
                    <div>
                        <input type="checkbox" name="skills[]" value="php" <?= in_array('php',$skill) ? 'checked': ''  ?> />
                        <label>PHP</label>
                    </div>
                    <div>
                        <input type="checkbox" name="skills[]" value="c" <?= in_array('c',$skill) ? 'checked': ''  ?>/>
                        <label>c</label>
                    </div>
                </div>
                <div class="inline-checkbox">
                    <div>
                        <input type="checkbox" name="skills[]" value="python" <?= in_array('python',$skill) ? 'checked': ''  ?>/>
                        <label>python</label>
                    </div>
                    <div>
                        <input type="checkbox" name="skills[]" value="mysql" <?= in_array('mysql',$skill) ? 'checked': ''  ?>/>
                        <label>MYSQL</label>
                    </div>
                </div>
                <span class="error"><?= isset($error->skills) ? $error->skills : '' ?></span>
            </div>
            <!-- end skills -->

            <div class="form-group">
                <label>Username</label>
                <input class="form-style" type="text" name="username"
                       value="<?= $username ?>"/>
                <span class="error"><? echo isset($error->username) ? $error->username : '' ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-style" type="password" name="password"
                       value="<?= $password ?>"/>
                <span class="error"><? echo isset($error->password) ? $error->password : '' ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="button"/>
            </div>
        </form>
    </div>

    <?php
} else {
    echo "no found user";
}
include 'footer.php';
?>

