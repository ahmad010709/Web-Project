<?php
/**
 * Contact Messages Viewer
 * 
 * Simple admin panel to view submitted contact messages
 * Access: http://localhost/your-project/assets/pages/view_contacts.php
 */

require_once 'config.php';

// Function to get all contacts
function getAllContacts() {
    try {
        $conn = getDatabaseConnection();
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        $result = $conn->query($sql);
        
        $contacts = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $contacts[] = $row;
            }
        }
        
        $conn->close();
        return $contacts;
        
    } catch (Exception $e) {
        throw new Exception("Error fetching contacts: " . $e->getMessage());
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - A.Owais Khan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }
        .stats {
            background: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .message-cell {
            max-width: 300px;
            word-wrap: break-word;
        }
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 50px;
        }
        .error {
            color: red;
            background: #f8d7da;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
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
            margin: 5px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .actions {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Contact Messages</h1>
        
        <div class="actions">
            <a href="contact.html" class="btn">Contact Form</a>
            <a href="setup_database.php" class="btn">Database Setup</a>
            <a href="javascript:location.reload()" class="btn">Refresh</a>
        </div>
        
        <?php
        try {
            $contacts = getAllContacts();
            $totalContacts = count($contacts);
            
            echo '<div class="stats">';
            echo '<strong>Total Messages: ' . $totalContacts . '</strong>';
            echo '</div>';
            
            if ($totalContacts > 0) {
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID</th>';
                echo '<th>Name</th>';
                echo '<th>Email</th>';
                echo '<th>Phone</th>';
                echo '<th>Message</th>';
                echo '<th>Date</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                foreach ($contacts as $contact) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($contact['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($contact['name']) . '</td>';
                    echo '<td>' . htmlspecialchars($contact['email']) . '</td>';
                    echo '<td>' . htmlspecialchars($contact['phone'] ?: 'N/A') . '</td>';
                    echo '<td class="message-cell">' . htmlspecialchars($contact['message']) . '</td>';
                    echo '<td>' . date('Y-m-d H:i:s', strtotime($contact['created_at'])) . '</td>';
                    echo '</tr>';
                }
                
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<div class="no-data">No contact messages found.</div>';
            }
            
        } catch (Exception $e) {
            echo '<div class="error">Error: ' . $e->getMessage() . '</div>';
            echo '<div class="error">Please make sure the database is set up correctly.</div>';
        }
        ?>
    </div>
</body>
</html>
