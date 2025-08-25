<?php
/**
 * Database Setup Script
 * 
 * Run this script once to set up the database and table for the contact form
 * Access this file in your browser: http://localhost/your-project/assets/pages/setup_database.php
 */

require_once 'config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup - A.Owais Khan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .success {
            color: green;
            background: #d4edda;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .error {
            color: red;
            background: #f8d7da;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .info {
            color: blue;
            background: #d1ecf1;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Database Setup for Contact Form</h1>
        
        <?php
        if (isset($_GET['setup'])) {
            try {
                // Initialize database
                initializeDatabase();
                echo '<div class="success">✅ Database and table created successfully!</div>';
                echo '<div class="info">Database Name: ' . DB_NAME . '</div>';
                echo '<div class="info">Table: contacts</div>';
                echo '<div class="info">Your contact form is now ready to use!</div>';
                
                // Test connection
                $conn = getDatabaseConnection();
                echo '<div class="success">✅ Database connection test successful!</div>';
                $conn->close();
                
            } catch (Exception $e) {
                echo '<div class="error">❌ Error: ' . $e->getMessage() . '</div>';
                echo '<div class="info">Please check your database configuration in config.php</div>';
            }
        } else {
            ?>
            <div class="info">
                <h3>Setup Instructions:</h3>
                <ol>
                    <li>Make sure XAMPP is running (Apache and MySQL)</li>
                    <li>Verify database settings in config.php</li>
                    <li>Click the button below to create the database and table</li>
                </ol>
            </div>
            
            <div class="info">
                <h3>Current Configuration:</h3>
                <p><strong>Host:</strong> <?php echo DB_HOST; ?></p>
                <p><strong>Username:</strong> <?php echo DB_USERNAME; ?></p>
                <p><strong>Database:</strong> <?php echo DB_NAME; ?></p>
            </div>
            
            <div style="text-align: center; margin: 30px 0;">
                <a href="?setup=1" class="btn">Setup Database</a>
            </div>
            <?php
        }
        ?>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="contact.html" class="btn">Go to Contact Form</a>
        </div>
    </div>
</body>
</html>
