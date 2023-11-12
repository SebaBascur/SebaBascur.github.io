<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $telefono = strip_tags(trim($_POST["telefono"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $tema = strip_tags(trim($_POST["tema"]));
    $mensaje = trim($_POST["mensaje"]);

    if (empty($nombre) OR empty($mensaje) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Aquí puedes manejar el error de manera adecuada
        echo "Por favor, completa el formulario y vuelve a intentarlo.";
        exit;
    }

    $recipient = "sebastianbascur@icloud.com";
    $subject = "Nuevo mensaje de $nombre";
    $email_content = "Nombre: $nombre\n";
    $email_content .= "Teléfono: $telefono\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensaje:\n$mensaje\n";

    $email_headers = "From: $nombre <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Mensaje enviado
        echo "Gracias por tu mensaje, $nombre. Te contactaremos pronto.";
    } else {
        // Error en el envío
        echo "Oops! Algo salió mal y no pudimos enviar tu mensaje.";
    }
} else {
    // No es una petición POST
    echo "Oops! Algo salió mal.";
}
?>
