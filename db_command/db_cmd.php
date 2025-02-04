<!-- Create the database -->
CREATE DATABASE user_auth;

<!-- use user_auth; -->
USE user_auth;

<!-- Create the users table -->
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Store hashed password
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

<!-- Insert a user into the users table -->
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    phone VARCHAR(15) NOT NULL,
    profile_pic VARCHAR(255) DEFAULT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);


<!-- Create the tuition_posts table -->
CREATE TABLE tuition_posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    class INT NOT NULL,
    time VARCHAR(50) NOT NULL,
    preferred_gender ENUM('Male', 'Female', 'Any') NOT NULL,
    tuition_fee DECIMAL(10, 2) NOT NULL
);
