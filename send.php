<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Honeypot check
    if (!empty($_POST['website'])) {
        die("Spam detected. Submission blocked.");
    }

    // Admin email and details
    $adminEmail = "formtester@overthetopexterior.com";  // Updated here
    $adminSubject = "New Contact Form Submission - Over The Top Roofing";

    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Email body for admin
    $adminBody = "New contact form submission received:\n\n";
    $adminBody .= "Name: $name\n";
    $adminBody .= "Email: $email\n";
    $adminBody .= "Phone: $phone\n";
    $adminBody .= "Message:\n$message\n";

    // Email body for user confirmation
    $userSubject = "Thank you for contacting Over The Top Roofing";
    $userBody = "Hello $name,\n\n";
    $userBody .= "Thank you for reaching out to Over The Top Roofing. We’ve received your message and will get back to you shortly.\n\n";
    $userBody .= "Here’s a copy of your submission:\n";
    $userBody .= "Phone: $phone\n";
    $userBody .= "Message:\n$message\n\n";
    $userBody .= "Best regards,\nOver The Top Roofing";

    // Set headers
    $headers = "From: formtester@overthetopexterior.com\r\n"; // Updated here too
    $headers .= "Reply-To: formtester@overthetopexterior.com\r\n";

    // Send emails
    $adminMail = mail($adminEmail, $adminSubject, $adminBody, $headers);
    $userMail = mail($email, $userSubject, $userBody, $headers);

    // Redirect with success flag
    if ($adminMail && $userMail) {
        header("Location: contact.html?success=true");
        exit;
    } else {
        echo "<script>alert('Error: Message could not be sent. Please try again later.'); window.history.back();</script>";
    }
}
?>
