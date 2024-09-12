

-- Use the database
USE csit_login_db;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    user_type ENUM('admin', 'faculty', 'student') NOT NULL
);

-- Insert predefined users
INSERT INTO users (username, password_hash, user_type) VALUES
('admin', '$2y$10$E0P9L.OJx7JYY7Jvg68p9ezd1UQ5QaBaEY9/fu68mEKP3lkmB1eOy', 'admin'), -- password: 'admin_password'
('faculty', '$2y$10$Tm9YZH2Y/39y1bhZGcRhJOPPLw1TW0BZC55qlKQZ4FhFkrVOUuL2y', 'faculty'), -- password: 'faculty_password'
('student', '$2y$10$uo9BdZyJUMDlSYpX7T1uPuxHVyIQuwH5B1kzOYib3vEFpGtQFt62W', 'student'); -- password: 'student_password'
 