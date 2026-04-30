
<?php

$con = mysqli_connect('localhost','root','','db_name');

if (!$con) {
    die('Connection Error' . mysqli_connect_error());
    exit();
}

?>
