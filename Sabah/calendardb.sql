CREATE DATABASE calendardb;

USE calendardb;

-- Table for events
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_description VARCHAR(255) NOT NULL
);

-- Sample data for events
INSERT INTO events (event_date, event_description) VALUES
('2023-06-01', 'Event 1'),
('2023-06-02', 'Event 2'),
('2023-06-03', 'Event 3'),
('2023-07-01', 'Event 4'),
('2023-07-02', 'Event 5'),
('2023-08-01', 'Event 6');

-- Table for users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_type VARCHAR(50) NOT NULL
);

-- Sample data for users
INSERT INTO users (user_type) VALUES
('Admin'),
('User'),
('User'),
('User'),
('Guest'),
('Guest'),
('Admin');

-- Add created_at column to users table
ALTER TABLE users ADD created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;

-- Update existing users with sample registration dates
UPDATE users SET created_at = '2023-01-15 10:00:00' WHERE id = 1;
UPDATE users SET created_at = '2023-02-20 14:30:00' WHERE id = 2;
UPDATE users SET created_at = '2023-03-25 09:15:00' WHERE id = 3;
UPDATE users SET created_at = '2023-04-10 16:45:00' WHERE id = 4;
UPDATE users SET created_at = '2023-05-05 11:20:00' WHERE id = 5;
UPDATE users SET created_at = '2023-05-15 13:50:00' WHERE id = 6;
UPDATE users SET created_at = '2023-06-01 08:30:00' WHERE id = 7;