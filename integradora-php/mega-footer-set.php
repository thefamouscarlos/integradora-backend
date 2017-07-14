<?php
/**
 * Created With PhpStorm.
 * User: Juan Carlos Martinez
 * Date: 7/6/2017
 * Time: 7:54 PM
 * Backend PHP for Saving Editacion de ligas to SQL
 */

$connect = mysqli_connect('127.0.0.1','root','','sirfic');
if(mysqli_connect_errno($connect))
{
    echo 'Failed to connect';
}

$facebook = $_POST['face-link'];
$twitter = $_POST['twitter-link'];
$whats = $_POST['whatsapp-link'];
$googlep = $_POST['google-plus'];
$phone = $_POST['telephone'];
$email = $_POST['email'];
$geolocation = $_POST['location'];
$store = $_POST['direction'];

mysqli_query($connect, "INSERT INTO links (facebook, twitter, whatsapp, googleplus, telefono, correo, mapas, ubicacion)
VALUES ('$facebook','$twitter','$whats','$googlep','$phone', '$email', '$geolocation', '$store')");
?>




