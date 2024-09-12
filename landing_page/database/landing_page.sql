-- Create the database
CREATE DATABASE IF NOT EXISTS landing_page;
USE landing_page;

-- Create the carousel table
CREATE TABLE IF NOT EXISTS carousel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    image_url VARCHAR(255) NOT NULL,
    caption_title VARCHAR(255) NOT NULL,
    caption_text TEXT NOT NULL,
    button_text VARCHAR(50),
    button_link VARCHAR(255)
);

-- Create the about table
CREATE TABLE IF NOT EXISTS about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL
);

-- Create the services table
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    icon_class VARCHAR(50) NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    button_text VARCHAR(50),
    button_link VARCHAR(255)
);

-- Create the programs table
CREATE TABLE IF NOT EXISTS programs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    program_name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL
);

-- Create the faculty table
CREATE TABLE IF NOT EXISTS faculty (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    bio TEXT NOT NULL,
    image_url VARCHAR(255)
);

-- Create the contact table
CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL
);

-- Insert initial data into carousel table
INSERT INTO carousel (image_url, caption_title, caption_text, button_text, button_link) VALUES
('img/carousal1.jpg', 'Welcome to the CS/IT Department', 'A comprehensive SUIT CS/IT Department website', 'Learn More', '#'),
('img/carousal2.jpg', 'Discover Our Programs', 'Explore our diverse range of programs and courses', 'Learn More', '#'),
('img/carousal3.jpg', 'Join Us Today', 'Become a part of our thriving community', 'Apply Now', '#');

-- Insert initial data into about table
INSERT INTO about (title, content) VALUES
(' Deans Message', 'It is my immense pleasure to welcome the prospective students of Sarhad University of Science & Information Technology, Peshawar, especially those who are about to join my Faculty in the year 2022-2023. I believe that higher education is one of the key elements for economic and social development of a country. It is also a proven fact that no country has been developed without investing its capital in human resource development in the form of higher education. Institutions of higher education are responsible to play a key role in achieving it. The Universities equip individuals with advance knowledge and skills required for professional leadership in Government, Business and Industry. It is also important to develop new technology but it is equally important to apply technology to our industry to improve quality of productivity and quality of the lives of common people. Sarhad University of Science and Information Technology, Peshawar among its aims and objectives have provision for skills based education. In the Faculty of Sciences, Computer Science and Information Technology, besides basic Sciences, we have programs which are of applied nature related to Information Technologies. These Programs are of Electronics, Telecommunication, Computer Science, Software Engineering, Computer Engineering Technology and Chemistry where we offer BS, MSc, MS and Ph.D degree programs. The rapid development in the means of communication and digital revolution has changed the world into a global village in a real sense. The economies are globalized and internationalized, irrespective of the I.T.O rules. Even the cultural exchanges are taking places without the exchange of people through international boundaries. In this era of internationalization, the importance of institutions of the higher education related to High Tech has increased to a wider range. At Sarhad University, we are very conscious of this fact. The globalization on one hand requires the professionalism of international standard in Technology use and on the other hand multicultural personality growth. At SUIT we care for all the above aspects and we designed our courses which provide opportunity for skill development futuristic to build upon and social grooming to care for humanity. I am sure that your choice of Faculty of Science in SUIT will be a success story of your future because knowledge and information are power. At Sarhad University of Science and Information Technology we will empower you with knowledge and keep you informed. I am confident that choice of your joining this Institution will make you a beacon of light to those interested in seeking quality technical education.');

-- Insert initial data into services table
INSERT INTO services (icon_class, title, description, button_text, button_link) VALUES
('bi bi-laptop', 'Enrollment', 'Through Enrollment Form, Students can enroll in their fail or lower grade subjects', 'Apply', '../Enrollement_Form/Enrollement_Form.html'),
('bi bi-journal', 'Leave Application', 'The students and faculty can submit their application for leave/leaves.', 'Application Form', '../Leave_Application/Leave_application.html'),
('bi bi-intersect', 'GPA Calculation', 'The students can calculate their GPA for improving their total GPA.', 'Calculate Your GPA Here', '../GPA_Predictions/GPA_Predictions.html');

-- Insert initial data into programs table
INSERT INTO programs (program_name, description) VALUES
('Computer Science', 'Program focused on software and hardware aspects of computing.'),
('Software Engineering', 'Program that covers the engineering aspects of software development.'),
('Computer Engineering Technology', 'Program combining computer science and electrical engineering principles.');

-- Insert initial data into faculty table
INSERT INTO faculty (name, position, bio, image_url) VALUES
('Dr. John Doe', 'Professor', 'Expert in software engineering with over 20 years of experience.', 'img/faculty1.jpg'),
('Dr. Jane Smith', 'Associate Professor', 'Specializes in artificial intelligence and machine learning.', 'img/faculty2.jpg'),
('Dr. Alan Brown', 'Lecturer', 'Focuses on cybersecurity and network security.', 'img/faculty3.jpg');

-- Insert initial data into contact table
INSERT INTO contact (email) VALUES
('mdarshadkhan344@gmail.com');
