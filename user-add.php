<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
require './libs/users.php';
session_start();
mysql_connect("localhost","training","#@HZTNp370fgt","training_hoangnt");
if (!empty($_POST['add_user']))
{
    // get data
    $filepath = "images/" . $_FILES["image"]["name"];
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)) {
    echo "The file ". basename( $_FILES["image"]["name"]). " uploaded.<br>";
    echo "The File Name = " . $_FILES["image"]["name"] . "<br>";
    echo "File Type = " . $_FILES["image"]["type"] . "<br>";
    echo "File Size = " . ($_FILES["image"]["size"] / 1024) . " kB<br>"; 
    echo "Temporary File Location = " . $_FILES["image"]["tmp_name"];
    } 
    else {
    echo "Error !!";
    }
    $data['image']= isset($_POST['image']) ? $_POST['image'] : '';
    $data['username']= isset($_POST['username']) ? $_POST['username'] : '';
    $data['password'] = isset($_POST['passwd']) ? $_POST['passwd'] : '';
    $data['names'] = isset($_POST['names']) ? $_POST['names'] : '';
    $data['gender']= isset($_POST['gender']) ? $_POST['gender'] : '';
    $data['phone']= isset($_POST['phone']) ? $_POST['phone'] : '';
    $data['dateofbirth']= isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : '';
    // Validate info
    $errors = array();
    if (empty($data['username'])){
        $errors['username'] = 'Please input username';
    }
    if (empty($data['password'])){
        $errors['password'] = 'Please input password';
    }
    // if (empty($data['names'])){
    //     $errors['names'] = 'Please input name';
    // }
    // if (empty($data['gender'])){
    //     $errors['gender'] = 'Please choose gender';
    // }
    // if (empty($data['phone'])){
    //     $errors['phone'] = 'Please input username';
    // }
    // if (empty($data['dateofbirth'])){
    //     $errors['dateofbirth'] = 'Please input date of birth';
    // }
    // If there is no error then insert
    if (!$errors){
        add_user($data['image'], $data['username'], $data['password'], $data['names'], $data['gender'], $data['phone'], $data['dateofbirth']);
        header("location: index.php");
    }
}
disconnect_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    </head>
    <body>
        <h1>Add user</h1>
        <a href="index.php" id="homepage">List users</a> <br/> <br/>
        <div id="body">
        <script>
        $(document).ready(function() {
            $('#homepage').click(function(e) {
                e.preventDefault();
                $('#body').load('index.php');
            });
        });
        </script>
        <form method="post" action="user-add.php" enctype="multipart/form-data">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Select image to upload:</td>
                    <td>
                    <input type="file" name="image" value="<?php echo !empty($data['image']) ? $data['image'] : ''; ?>"/>
                        <?php if (!empty($errors['image'])) echo $errors['image']; ?>
                    </td>
                </tr>
                <tr>
                    <td>username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo !empty($data['username']) ? $data['username'] : ''; ?>"/>
                        <?php if (!empty($errors['username'])) echo $errors['username']; ?>
                    </td>
                </tr>
                <tr>
                    <td>password</td>
                    <td>
                    <input type="password" name="passwd" value="<?php echo !empty($data['password']) ? $data['password'] : ''; ?>"/>
                        <?php if (!empty($errors['password'])) echo $errors['password']; ?>
                    </td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>
                        <input type="text" name="names" value="<?php echo !empty($data['names']) ? $data['names'] : ''; ?>"/>
                        <?php if (!empty($errors['names'])) echo $errors['names']; ?>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <select name="gender">
                            <option value="male">male</option>
                            <option value="female" <?php if (!empty($data['gender']) && $data['gender'] == 'female') echo 'selected'; ?>>female</option>
                        </select>
                        <?php if (!empty($errors['gender'])) echo $errors['gender']; ?>
                    </td>
                </tr>
                <tr>
                    <td>phone</td>
                    <td>
                        <input type="text" name="phone" value="<?php echo !empty($data['phone']) ? $data['phone'] : ''; ?>"/>
                        <?php if (!empty($errors['phone'])) echo $errors['phone']; ?>
                    </td>
                </tr>
                <tr>
                    <td>date of birth</td>
                    <td>
                        <input type="text" name="dateofbirth" value="<?php echo !empty($data['dateofbirth']) ? $data['dateofbirth'] : ''; ?>"/>
                        <?php if (!empty($errors['dateofbirth'])) echo $errors['dateofbirth']; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="add_user" value="add"/>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>