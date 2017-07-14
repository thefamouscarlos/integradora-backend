<?php
$connect = mysqli_connect('127.0.0.1','root','','sirfic');
if(mysqli_connect_errno($connect))
{
    echo 'Failed to connect';
}

include_once './php-dir/php-backend/logic.php';
$x = new logic();

$name = $_POST['name'];
$lastname = $_POST['apellidos'];
$username = $_POST['username'];
$email = $_POST['email'];
$position = $_POST['occupation'];
$password = $_POST['password'];
$phone = $_POST['phone'];

$y = $x->hashPwd($username, $password);

mysqli_query($connect, "INSERT INTO userbase (name, lastname, username, email, password, position, phone)
VALUES ('$name','$lastname','$username','$email','$y','$position','$phone')");
?>

<html>
<body>
    <h4><?php echo $y?></h4>
</body>
</html>