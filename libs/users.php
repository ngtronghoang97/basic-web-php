<?php
// Global connection variable
global $conn;
function connect_db()
{
    global $conn;
    if (!$conn){
        $conn = mysqli_connect('localhost', 'training', '#@HZTNp370fgt', 'training_hoangnt') or die ('Can\'t not connect to database');
        // Set the font to connect
        //mysqli_set_charset($conn, 'utf8');
    }
}
function disconnect_db()
{
    global $conn;
    if ($conn){
        mysqli_close($conn);
    }
}
function get_all_users()
{
    global $conn;
    connect_db();
    $sql = "select * from users";
    $query = mysqli_query($conn, $sql);
    $result = array();
    // Loop each record and put in the resulting variable
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }
    return $result;
}
function get_user($users_id)
{
    global $conn;
    connect_db();
    // get all users
    $sql = "select * from users where users_id = {$users_id}";
    $query = mysqli_query($conn, $sql);
    $result = array();
    // If there are results, it returns $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    return $result;
}
function add_user($image, $username, $password, $names, $gender, $phone, $dateofbirth)
{
    global $conn;
    connect_db();
    // anti SQL Injection
    // $image_name = addslashes($_FILES['image']['name']);
    $image = addslashes($_FILES['image']['name']);

    $username = addslashes($username);
    $password = addslashes($password);
    $names = addslashes($names);
    $gender = addslashes($gender);
    $phone = addslashes($phone);
    $dateofbirth = addslashes($dateofbirth);
    $sql = "
            INSERT INTO users(image, username, passwd, names, gender, phone, dateofbirth) VALUES
            ('$image', '$username','$password','$names', '$gender', '$phone', '$dateofbirth')
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}
function edit_user($users_id, $username, $password, $names, $gender, $phone, $dateofbirth)
{
    global $conn;
    connect_db();
    // anti SQL Injection
    $username = addslashes($username);
    $password = addslashes($password);
    $names = addslashes($names);
    $gender = addslashes($gender);
    $phone = addslashes($phone);
    $dateofbirth = addslashes($dateofbirth);
    $sql = "
            UPDATE users SET
            username = '$username',
            passwd = '$password',
            names = '$names',
            gender = '$gender',
            phone = '$phone',
            dateofbirth = '$dateofbirth'
            WHERE users_id = $users_id
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}
function delete_user($users_id)
{
    global $conn;
    connect_db();
    $sql = "
            DELETE FROM users
            WHERE users_id = $users_id
    ";
    $query = mysqli_query($conn, $sql);
    return $query;
}
function delete_all_user()
{
    global $conn;
    connect_db();
    $sql = "DELETE FROM users";
    $query = mysqli_query($conn,$sql);
    return $query;
}