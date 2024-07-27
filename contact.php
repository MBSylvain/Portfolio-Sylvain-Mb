<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Vérifiez les données du formulaire
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Veuillez remplir le formulaire correctement.";
        exit;
    }

    // Définir l'adresse de destination et le sujet
    $recipient = "www.20syls@yahoo.fr"; // Remplacez par votre adresse email
    $subject = "Nouveau message de $name";

    // Construire le contenu de l'email
    $email_content = "Nom: $name\n";
    $email_content = "Email: $email\n\n";
    $email_content = "Message:\n$message\n";

    // En-têtes de l'email
    $email_headers = "From: $name <$email>";

    // Envoyer l'email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Merci! Votre message a été envoyé.";
    } else {
        http_response_code(500);
        echo "Une erreur s'est produite lors de l'envoi de votre message.";
    }
} else {
    http_response_code(403);
    echo "Il y a un problème avec votre soumission. Veuillez réessayer.";
}
?>
