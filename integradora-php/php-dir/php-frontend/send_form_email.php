<?php
/**
 * Created With PhpStorm.
 * User: Juan Carlos Martinez
 * Date: 7/6/2017
 * Time: 11:12 AM
 * Version 'Production' v1.2.1
 */

if(isset($_POST['correo'])) {
    //Pueden Editar esto al gusto, son para el correo
    $email_to = "hero.martinez@hotmail.com"; //tu correo electronico
    $email_headline = "Un nuevo mensaje de sirfic.com"; //Tu Línea de asunto del correo electrónico

    function died($error)
    { //Estos se lanzan al momento de que se encuentre un campo vacio.
        echo "Lo sentimos mucho, pero hubo errores encontrados con el formulario que enviaste.";
        echo "Los errores se encuentran abajo.<br/>";
        echo $error . "<br/>";
        echo "Porfavor corriege estos errores y intente de nuevo";
        die();
    }

    //validacion
    if (!isset($_POST['nombre']) ||
        !isset($_POST['correo']) ||
        !isset($_POST['subjeto'])
    ) {
        died('Lo sentimos, pero parece haber un problema con el formulario que envió.');
    }

    $name = $_POST['nombre']; //requerido
    $email_from = $_POST['correo']; //requerido
    $message = $_POST['subjeto']; //requerido

    $error_message = ""; // variable que va a contener nuestro mensage
    $email_expects = '/^[A-Za-z0-9._%]+@[A-Za-z0-9.-]+\.[A-Za-z{2-4}$/'; // validacion de elementos no prejudiciales


    if (!preg_match($email_expects, $email_from)) {
        $error_message .= 'El correo que has ingresado no es valido. <br/>';
    }
    $string_expects = "/^[A-Za-z . ' -]"; // Validacion de elementos pre aprovados para evitar injecion SQL

    if (!preg_match($string_expects, $name)) { //Checa con $expects si tiene un caracter no aprovado el -> nombre
        $error_message .= 'El nombre que has ingresado parece tener caracteres no validos. <br/>';
    }
    if (!preg_match($string_expects, $message)) { //Checa con $expects si tiene un caracter no aprovado el -> mensage
        $error_message .= 'Tu mensage parece contener caracteres no validos, favor de ingresar otro mensage. <br/>';
    }

    $email_message = "Informacion de tu formulario sirfic.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Nombre: " . clean_string($name) . "\n";
    $email_message .= "Correo " . clean_string($email_from) . "\n";
    $email_message .= "Mensaje: " . clean_string($message) . "\n";

    // Crea el correo
    $headers = 'De: ' . $email_from . "\r\n" .
        'Favor de responder a: ' . $email_from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_headline, $email_message, $headers);

}

?>





