-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS contact_db;
USE contact_db;

-- Create contacts table
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Optional: Insert sample data for testing
-- INSERT INTO contacts (name, email, phone, message) VALUES 
-- ('John Doe', 'john@example.com', '1234567890', 'This is a test message');
