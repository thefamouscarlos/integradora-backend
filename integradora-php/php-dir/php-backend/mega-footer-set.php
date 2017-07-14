<?php
/**
 * Created With PhpStorm.
 * User: Juan Carlos Martinez
 * Date: 7/6/2017
 * Time: 7:54 PM
 * Backend PHP for Saving Editacion de ligas to SQL
 */

$li_facebook = $_POST['face-link'];
$li_twitter = $_POST['twitter-link'];
$li_whats = $_POST['whatsapp-link'];
$li_googlep = $_POST['google-plus'];
$li_phone = $_POST['telephone'];
$li_email = $_POST['email'];
$li_geolocation = $_POST['location'];
$li_store = $_POST['direction'];

$link = mysqli_connect("localhost", "root", "", "sirfic");

if($link === false){
    die("ERROR: No Se pudo connectar al base de datos " . mysqli_connect_error());
}

$sql = "INSERT INTO links (facebook, twitter, whatsapp, googleplus, telefono, correo, mapas, ubicacion) VALUES ('$li_facebook, $li_twitter, $li_whats, $googlep, $phone, $li_email, $li_geolocation, $li_store')";
if(mysqli_query($link, $sql)){
    echo "Datos guardados y acualizados con exitos.";
} else{
    echo "ERROR: No se pudo ejecutar su actualizacion, intente mas tarde $sql. " . mysqli_error($link);
}
mysqli_close($link);

?>


