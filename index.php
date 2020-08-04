<?php
require './libs/users.php';
$users = get_all_users();
disconnect_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function on_callPhp()
            {
                var result="<?php delete_all_user(); ?>";
                alert(result);
                return false;
            }
        </script>
    </head>
    <body>
        <a href="user-add.php" id="user_add">Add user</a>
        <div id="addpage">
        <script>
        $(document).ready(function() {
            $('#user_add').click(function(e) {
                e.preventDefault();
                $('#addpage').load('user-add.php');
            });
        });
    </script>
        <h1>List users</h1> <br/> <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr>
                <td>Checkbox</td>
                <td>ID</td>
                <td>image</td>
                <td>username</td>
                <td>password</td>
                <td>Name</td>
                <td>Gender</td>
                <td>phone</td>
                <td>date of birth</td>
                <td>Options</td>
            </tr>
            <input type="button" id="btn_checkall" value="check all"/>
            <input type="button" id="btn_uncheckall" value="uncheck all"/>
            <input type="button" id="btn_deleteall" value="delete all" onclick="on_callPhp()"/>
            <script>
                document.getElementById("btn_deleteall").onclick = function (){
                   <?php 
                   global $conn;
                   connect_db();
                   $sql = "DELETE FROM users";
                   $query = mysqli_query($conn,$sql);
                    ?>
                }
            </script>
            <?php foreach ($users as $item){ ?>
            <tr>
                <td><input type='checkbox' name='name[]' id='check_all' value=''/></td>
                <td><?php echo $item['users_id']; ?></td>
                <td><img src="images/<?php echo $item['image']; ?>" width='50' height='50'/></td>
                <td><?php echo $item['username']; ?></td>
                <td><?php echo $item['passwd']; ?></td>
                <td><?php echo $item['names']; ?></td>
                <td><?php echo $item['gender']; ?></td>
                <td><?php echo $item['phone']; ?></td>
                <td><?php echo $item['dateofbirth']; ?></td>
                <td>
                    <form method="post" action="user-delete.php">
                        <!-- edit -->
                        <input onclick="window.location = 'user-edit.php?id=<?php echo $item['users_id']; ?>'" type="button" value="edit"/>
                        </script>
                        <!-- delete -->
                        <input type="hidden" name="id" value="<?php echo $item['users_id']; ?>"/>
                        <input onclick="return confirm('Are you sure you want to delete?');" type="submit" name="delete" value="delete"/>
                        </script>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>
<script src="javascript/function.js"></script>