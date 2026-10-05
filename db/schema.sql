CREATE DATABASE IF NOT EXISTS psut_portal;
USE psut_portal;


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    school VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    login_attempts INT DEFAULT 0,
    last_login_attempt TIMESTAMP NULL,
    is_blocked TINYINT(1) DEFAULT 0,
    block_expires TIMESTAMP NULL
);


CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255) NULL,
    video_path VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO announcements (title, content) VALUES 
('Welcome to the New Semester', 'We are excited to welcome all students to the new semester. Classes will begin on Monday, September 5th.'),
('Library Hours Extended', 'The university library will now be open until 10 PM on weekdays to accommodate students during finals.'),
('Campus Wi-Fi Upgrade', 'We are pleased to announce that the campus Wi-Fi infrastructure has been upgraded to provide faster and more reliable internet access.'),
('New Computer Lab Opening', 'A new computer lab with 50 high-performance workstations will be opening next week in Building B.'); 
