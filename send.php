<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Admin email address
    $to = "thewebguyskelowna@gmail.com";
    $subject = "New Contact Form Submission - Over The Top Roofing";

    // Sanitize and retrieve form data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Compose the message
    $body = "You received a new message from Over The Top Roofing contact form:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Attempt to send email
    if (mail($to, $subject, $body, $headers)) {
        // Return to contact page with alert
        echo "<script>
            alert('Message sent successfully!');
            window.history.back();
        </script>";
    } else {
        echo "<script>
            alert('There was an error sending your message. Please try again later.');
            window.history.back();
        </script>";
    }
}
?>
