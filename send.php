<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Admin email
    $adminEmail = "thewebguyskelowna@gmail.com";
    $adminSubject = "New Contact Form Submission - Over The Top Roofing";

    // Retrieve and sanitize form inputs
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Admin notification email body
    $adminBody = "New contact form submission received:\n\n";
    $adminBody .= "Name: $name\n";
    $adminBody .= "Email: $email\n";
    $adminBody .= "Phone: $phone\n";
    $adminBody .= "Message:\n$message\n";

    // Confirmation email to user
    $userSubject = "Thank you for contacting Over The Top Roofing";
    $userBody = "Hello $name,\n\n";
    $userBody .= "Thank you for reaching out to Over The Top Roofing. We’ve received your message and will get back to you shortly.\n\n";
    $userBody .= "Here’s a copy of your submission:\n";
    $userBody .= "Phone: $phone\n";
    $userBody .= "Message:\n$message\n\n";
    $userBody .= "Best regards,\nOver The Top Roofing";

    // Email headers
    $headers = "From: formtester@overthetopexterior.com\r\n";
    $headers .= "Reply-To: formtester@overthetopexterior.com\r\n";

    // Send email to admin
    $adminMail = mail($adminEmail, $adminSubject, $adminBody, $headers);

    // Send confirmation email to user
    $userMail = mail($email, $userSubject, $userBody, $headers);

    // Check both emails were sent
    if ($adminMail && $userMail) {
        echo "<script>
          alert('Thank you! Your message has been sent and a confirmation email has been delivered.');
          window.history.back();
        </script>";
    } else {
        echo "<script>
          alert('Error: Message could not be sent.');
          window.history.back();
        </script>";
    }
}
?>
