<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Sanitize inputs
    $name = htmlspecialchars(trim($input['name'] ?? ''));
    $email = filter_var($input['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($input['message'] ?? ''));
    
    // Validate inputs
    if (empty($name) || !$email || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required and email must be valid']);
        exit;
    }
    
    // Email configuration
    $to = 'osazedavid969@gmail.com';
    $subject = "Portfolio Contact from $name";
    $timestamp = date('Y-m-d H:i:s');
    
    // HTML email body
    $body = "
    <html>
    <head><title>Portfolio Contact Message</title></head>
    <body>
        <h2>New Contact Message</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Date:</strong> $timestamp</p>
        <hr>
        <h3>Message:</h3>
        <p>" . nl2br($message) . "</p>
    </body>
    </html>
    ";
    
    // Email headers
    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        "From: Portfolio Contact <noreply@yourdomain.com>",
        "Reply-To: $email",
        'X-Mailer: PHP/' . phpversion()
    ];
    
    // Send email
    if (mail($to, $subject, $body, implode("\r\n", $headers))) {
        // Log successful submission
        $log = date('Y-m-d H:i:s') . " - Contact from $name ($email)\n";
        file_put_contents('contact_log.txt', $log, FILE_APPEND | LOCK_EX);
        
        echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email. Please try again.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Only POST method allowed']);
}
?>
