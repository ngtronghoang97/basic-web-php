<?php
$servername = "localhost";
$username = "training";
$password = "#@HZTNp370fgt";
$dbname = "training_hoangnt";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else{ echo "Connected successfully";}

$sql = "CREATE TABLE users (
    users_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    image MEDIUMBLOB,
    username varchar(15) NOT NULL,
    passwd varchar(20) NOT NULL,
    names varchar(10),
    gender varchar(3),
    phone int(11),
    dateofbirth varchar(10)
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

//add column
// $sql = "ALTER TABLE users ADD image MEDIUMBLOB";
// $query = mysqli_query($conn, $sql);
// if ($conn->query($sql) === TRUE) {
//     echo "img created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }
?>