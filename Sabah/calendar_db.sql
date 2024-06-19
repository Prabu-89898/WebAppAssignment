-- SQL to create the database and tables


CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_description VARCHAR(255) NOT NULL
);

CREATE TABLE suggested_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_date DATE NOT NULL,
    event_description VARCHAR(255) NOT NULL
);