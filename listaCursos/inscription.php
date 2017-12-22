<?php
    
    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
        $subject = strip_tags(trim($_POST["subject"]));
        $number = strip_tags(trim($_POST["number"]));
        $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! No ha sido posible enviar el mensaje.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "freaklab69@gmail.com";

        // Set the email subject.
        $subject = "Nuevo mensaje de:  $name";

        // Build the email content.
        $email_content = "Nombre: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Asunto: $subject\n\n";
        $email_content .= "Número: $number\n\n";
        $email_content .= "Mensaje:\n$message\n";

        // Build the email headers.
        $email_headers = "De: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "¡Gracias! Mensaje enviado con éxito.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "!Oops! Algo anda mal, intenta de nuevo más tarde.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "¡Oops! Algo anda mal.";
    }
?>