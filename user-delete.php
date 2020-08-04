<?php
require './libs/users.php';
$id = isset($_POST['id']) ? (int)$_POST['id'] : '';
if ($id){
    delete_user($id);
}
header("location: index.php"); //Redirect browser
?>