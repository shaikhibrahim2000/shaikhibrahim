<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $project = strip_tags(trim($_POST["project"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($project) || empty($message)) {
        http_response_code(400);
        echo "Please complete all fields.";
        exit;
    }

    $recipient = "ahnafmahbub@gmail.com";
    $subject = "New contact from $name";

    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Project: $project\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you for your message.";
    } else {
        http_response_code(500);
        echo "Something went wrong.";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission.";
}
?>
