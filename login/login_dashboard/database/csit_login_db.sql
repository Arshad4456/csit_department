

-- Use the database
USE csit_login_db;

-- Add table and columns for storing additional details
ADD TABLE users

ADD COLUMN user_type VARCHAR(255),
ADD COLUMN honorific VARCHAR(255),
ADD COLUMN name VARCHAR(255),
ADD COLUMN father_name VARCHAR(255),
ADD COLUMN gender VARCHAR(255),
ADD COLUMN password_hash VARCHAR(255) NOT NULL,
ADD COLUMN cnic VARCHAR(20) UNIQUE,
ADD COLUMN employee_number VARCHAR(20) UNIQUE,
ADD COLUMN designation VARCHAR(255),
ADD COLUMN contact_number VARCHAR(15),
ADD COLUMN address TEXT,
ADD COLUMN qualification VARCHAR(255),
ADD COLUMN email VARCHAR(255) UNIQUE;  

