<?php
require './libs/users.php';
// Get up display information for user
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id){
    $data = get_user($id);
}
if (!$data){
   header("location: index.php");
}
// If submit form
if (!empty($_POST['edit_user']))
{
    // get data
    // $old_pass = "
    //         SELECT passwd FROM users
    //         WHERE users_id = $id
    // ";
    // $query = mysqli_query($conn, $old_pass);
    $data['users_id'] = isset($_POST['users_id']) ? $_POST['users_id'] : '';
    $data['passwd'] = isset($_POST['passwd']) ? $_POST['passwd'] : '';
    $data['names'] = isset($_POST['names']) ? $_POST['names'] : '';
    $data['gender']= isset($_POST['gender']) ? $_POST['gender'] : '';
    $data['phone']= isset($_POST['phone']) ? $_POST['phone'] : '';
    $data['dateofbirth']= isset($_POST['dateofbirth']) ? $_POST['dateofbirth'] : '';
    // Validate information
    $errors = array();
    if (empty($data['passwd'])){
        $errors['passwd'] = 'Please input password';
    }
    // If there is no error then insert
    if (!$errors){
        edit_user($data['users_id'], $data['username'], $data['passwd'], $data['names'], $data['gender'], $data['phone'], $data['dateofbirth']);
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
        <h1>Edit user </h1>
        <a href="index.php">List users</a> <br/> <br/>
        <form method="post" action="user-edit.php?id=<?php echo $data['users_id']; ?>">
            <table width="50%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Current Password</td>
                <td><input type="password" name="passwd" value="<?php echo $data['passwd']; ?>"/>
                    <?php if (!empty($errors['passwd'])) echo $errors['passwd']; ?></td>
            </tr>
            <tr>
                <td>name</td>
                <td>
                    <input type="text" name="names" value="<?php echo $data['names']; ?>"/>
                    <?php if (!empty($errors['names'])) echo $errors['names']; ?>
                </td>
            </tr>
            <tr>
                <td>gender</td>
                <td>
                    <select name="gender">
                        <option value="male">male</option>
                        <option value="female" <?php if ($data['gender'] == 'female') echo 'selected'; ?>>female</option>
                    </select>
                    <?php if (!empty($errors['gender'])) echo $errors['gender']; ?>
                </td>
            </tr>
            <tr>
                <td>phone</td>
                <td>
                    <input type="text" name="phone" value="<?php echo $data['phone']; ?>"/>
                    <?php if (!empty($errors['phone'])) echo $errors['phone']; ?>
                </td>
            </tr>
            <tr>
                <td>date of birth</td>
                <td>
                    <input type="text" name="dateofbirth" value="<?php echo $data['dateofbirth']; ?>"/>
                    <?php if (!empty($errors['dateofbirth'])) echo $errors['dateofbirth']; ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="users_id" value="<?php echo $data['users_id']; ?>"/>
                    <input type="submit" name="edit_user" value="edit"/>
                </td>
            </tr>
            </table>
        </form>
    </body>
</html>