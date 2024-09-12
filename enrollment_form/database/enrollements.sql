-- Step 1: Create the database
CREATE DATABASE enrollment_system;

-- Step 2: Select the database for use
USE enrollment_system;

-- Step 3: Create the `enrollments` table
CREATE TABLE enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    father_name VARCHAR(255) NOT NULL,
    registration_no VARCHAR(100) NOT NULL UNIQUE,
    phone_no VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    program VARCHAR(100) NOT NULL,
    semester INT NOT NULL,
    semester_type ENUM('Running', 'Summer') NOT NULL,
    status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Step 4: Create the `course_details` table with ON DELETE CASCADE and ON UPDATE CASCADE
CREATE TABLE course_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    enrollment_id INT NOT NULL,
    course_no VARCHAR(100) NOT NULL,
    course_title VARCHAR(255) NOT NULL,
    grade ENUM('F', 'D', 'D+', 'C') NOT NULL,
    FOREIGN KEY (enrollment_id) REFERENCES enrollments(id) 
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

