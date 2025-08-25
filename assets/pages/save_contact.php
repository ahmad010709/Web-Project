<?php
// Include database configuration
require_once 'config.php';

// Set content type to JSON for AJAX responses
header('Content-Type: application/json');

// Enable CORS if needed
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Initialize database and table if they don't exist
try {
    initializeDatabase();
} catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => 'Database setup error. Please contact the administrator.'
    ];
    echo json_encode($response);
    exit;
}

// Function to sanitize input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Create database connection
        $conn = getDatabaseConnection();
        
        // Get and sanitize form data
        $name = sanitize_input($_POST['name'] ?? '');
        $email = sanitize_input($_POST['email'] ?? '');
        $phone = sanitize_input($_POST['number'] ?? '');
        $message = sanitize_input($_POST['message'] ?? '');
        
        // Validate required fields
        if (empty($name) || empty($email) || empty($message)) {
            throw new Exception("Please fill in all required fields (Name, Email, and Message).");
        }
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }
        
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        
        // Execute the statement
        if ($stmt->execute()) {
            $response = [
                'success' => true,
                'message' => 'Message sent successfully! Thank you ' . $name . '!'
            ];
        } else {
            throw new Exception("Error saving message: " . $stmt->error);
        }
        
        // Close statement
        $stmt->close();
        
    } catch (Exception $e) {
        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    } finally {
        // Close connection if it exists
        if (isset($conn)) {
            $conn->close();
        }
    }
    
    // Return JSON response
    echo json_encode($response);
    
} else {
    // If not POST request
    $response = [
        'success' => false,
        'message' => 'Invalid request method. Only POST requests are allowed.'
    ];
    echo json_encode($response);
}
?>
