CREATE DATABASE IF NOT EXISTS motikavibes;
USE motikavibes;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20) UNIQUE,
    password VARCHAR(255),
    otp VARCHAR(6),
    otp_expire DATETIME,
    language ENUM('en','sw') DEFAULT 'sw',
    theme ENUM('light','dark') DEFAULT 'light'
);

-- Books table
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    price DECIMAL(10,2) DEFAULT 500,
    category VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    book_id INT,
    quantity INT DEFAULT 1,
    amount DECIMAL(10,2),
    phone VARCHAR(20),
    status ENUM('pending','paid','completed') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(book_id) REFERENCES books(id)
);

-- Insert initial 30 books for homepage example
INSERT INTO books(title, description, image, price, category)
VALUES
('Jinsi ya kupika Keki', 'Kitabu cha kuonyesha jinsi ya kupika keki kwa urahisi.', 'books/ke_ki.jpg', 500, 'Cooking'),
('Siri ya Matajiri Waliyoificha', 'Kitabu cha siri za kifedha za matajiri.', 'books/siri_matajiri.jpg', 500, 'Business'),
('Suruhi ya Kufanikisha Mkp', 'Kitabu cha mafanikio kwa waendeshaji.', 'books/suruhi_mpk.jpg', 500, 'Business');
-- Tumia script ku-insert book 100 automatically
