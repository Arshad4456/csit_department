CREATE DATABASE leave_management;


-- create table

USE leave_management;

CREATE TABLE leave_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    father_name VARCHAR(100) NOT NULL,
    registration_no VARCHAR(50) NOT NULL,
    reason TEXT NOT NULL,
    email VARCHAR(100) NOT NULL,
    leave_type ENUM('halfDay', 'fullDay') NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    days_difference INT NOT NULL,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
