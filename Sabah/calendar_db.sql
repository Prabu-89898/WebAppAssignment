-- SQL to create the database and tables


CREATE TABLE calendarevents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_description VARCHAR(255) NOT NULL
);

CREATE TABLE suggested_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_description VARCHAR(255) NOT NULL
);


INSERT INTO calendarevents (event_date, event_description) VALUES
('2024-07-01', 'Food Distribution Drive'),
('2024-07-15', 'Volunteer Appreciation Event'),
('2024-07-20', 'Community Kitchen Opening'),
('2024-08-05', 'Monthly Board Meeting'),
('2024-08-10', 'Fundraising Gala');

INSERT INTO suggested_events (event_date, event_description) VALUES
('2024-07-02', 'Nutrition Workshop'),
('2024-07-18', 'Food Safety Training'),
('2024-07-25', 'Charity Fun Run'),
('2024-08-07', 'Cooking Class for Volunteers'),
('2024-08-12', 'School Supply Drive');
