<?php


if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $firstName    = trim( $_POST['firstname']);
    $lastName     = trim( $_POST['lastname']);
    $address      = trim( $_POST['address']);
    $skills       = @($_POST['skills']);
    $gender       = $_POST['gender'];
    $username     = trim($_POST['username']);
    $password     = trim($_POST['password']);
    $record       = "";
    $error        = [];
    $oldData      = [];
    $allowedImg   = ['jpg','jpeg','png','svg'];
    $userImg      = $_FILES['userimg'];
    $imgPath      = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'img' .DIRECTORY_SEPARATOR;



    // handle array of skills
    foreach ( $_POST as $data ) {
        if( is_array($data) ) {
            $record .= implode(',', $data) . ':';
        } else {

            $record .= "$data:";

        }
    }


    // check if user send img to handle it
    if( !empty( $userImg['name'] ) ) {

        $extenstion = explode('.',$userImg['name'])[1];
        // Check img extenstion
        if( !in_array( $extenstion, $allowedImg ) ) {
            $error['badimg'] = 'sorry file format not allowd';
        } else {
            $img = $imgPath.$userImg["name"];
            move_uploaded_file( $userImg['tmp_name'], $img );
            $record.= $userImg['name'];

        }

    }



    // Check if firstname is empty or contain digit
    if( empty($firstName) || preg_match('/\d/', $firstName)  ) {
        $error['firstname'] = "first name is required and only character";
    }
    // Check if lastname is empty or contain digit
    if( empty($lastName) || preg_match('/\d/', $lastName)  ) {
        $error['lastname'] = "last name is required and only character";
    }
    // Check if address is empty or less than five character
    if( empty($address) || strlen($address) < 5  ) {
        $error['address'] = "address must not be empty and greater than 5 charater";
    }

    // check if skill empty
    if( empty($skills) ) {
        $error['skills'] = 'Skills must not be empty';
    }

    // Check if address is empty or less than five character
    if( empty($username) || strlen($username) < 5  ) {
        $error['username'] = "username must not be empty and greater than 5 charater";
    }

    if( empty( $password ) || strlen($password) < 5) {
        $error['password'] = "password must not be empty and greater than 5 charater";
    }


    // Send error back to user form if error array not empty

    if( count($error) > 0 ) {

        $errorString = json_encode( $error );
        $oldData = json_encode( $_POST );

        if( isset($_GET['id']) ) {
            header("location:./edit.php?id={$_GET['id']}&error=".$errorString);

        } else {
            header("location:./adduser.php?error=".$errorString."&olddata=".$oldData);
        }


    } else {
        // insert or update data into file
        try{

            // the action is to edit user
            if( isset($_GET['id']) ) {
                $userId = $_GET['id'];

                // read users from file
                $userData = file( 'users.txt' );

                // get specific user with id
                $data = $userData[$userId];

                // Append end of line in each record to start new line
                $data = trim($record,':') . "\n";

                // Append user data into array to append users in file
                $userData[$userId] = $data;
                file_put_contents('users.txt',implode('',$userData));

                header("location:users.php");

            } else {

                // insert new record
                $userfile = fopen("users.txt", "a");
                fwrite($userfile, trim($record,":").PHP_EOL);
                fclose($userfile);
                header("location:users.php");
            }

        }catch (Exception $e){
            echo $e->getMessage();
        }

    }

} else {
    header('location:users.php');
}
?>

