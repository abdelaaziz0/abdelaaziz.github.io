<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['hp'])) {
        http_response_code(400);
        echo "Spam détecté.";
        exit;
    }

    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Veuillez remplir le formulaire correctement.";
        exit;
    }

    $recipient = "abelkhair002@bordeaux-inp.fr";
    $subject   = "Nouveau message de $name";
    $email_content = "Nom: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Merci! Votre message a été envoyé.";
    } else {
        http_response_code(500);
        echo "Oups! Une erreur s'est produite et votre message n'a pas pu être envoyé.";
    }
} else {
    http_response_code(403);
    echo "Il y a eu un problème avec votre soumission, réessayez.";
}
?>
