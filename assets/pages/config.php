<?php
/**
 * Database Configuration File
 * 
 * This file contains database connection settings for the contact form
 * Modify these settings according to your database setup
 */

// Database configuration constants
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');        // Default XAMPP username
define('DB_PASSWORD', '');            // Default XAMPP password (empty)
define('DB_NAME', 'contact_db');

// Function to create database connection
function getDatabaseConnection() {
    try {
        $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        // Set charset to utf8
        $conn->set_charset("utf8");
        
        return $conn;
        
    } catch (Exception $e) {
        error_log("Database connection error: " . $e->getMessage());
        throw new Exception("Database connection failed. Please try again later.");
    }
}

// Function to create database and table if they don't exist
function initializeDatabase() {
    try {
        // First connect without specifying database
        $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
        
        // Create database if it doesn't exist
        $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
        if (!$conn->query($sql)) {
            throw new Exception("Error creating database: " . $conn->error);
        }
        
        // Select the database
        $conn->select_db(DB_NAME);
        
        // Create contacts table if it doesn't exist
        $sql = "CREATE TABLE IF NOT EXISTS contacts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL,
            phone VARCHAR(20),
            message TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if (!$conn->query($sql)) {
            throw new Exception("Error creating table: " . $conn->error);
        }
        
        $conn->close();
        return true;
        
    } catch (Exception $e) {
        error_log("Database initialization error: " . $e->getMessage());
        throw new Exception("Database initialization failed: " . $e->getMessage());
    }
}
?>
