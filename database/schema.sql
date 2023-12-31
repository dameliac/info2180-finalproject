DROP DATABASE IF EXISTS dolphin_crm;
CREATE DATABASE dolphin_crm;
USE dolphin_crm;
CREATE TABLE IF NOT EXISTS Users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    password VARCHAR(255),
    email VARCHAR(255),
    role VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Contacts (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    email VARCHAR(255),
    telephone VARCHAR(255),
    company VARCHAR(255),
    type VARCHAR(255), -- 'type' indicates whether Sales Lead or Support
    assigned_to INTEGER, -- Foreign Key to Users table
    created_by INTEGER, -- Foreign Key to Users table
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES Users(id),
    FOREIGN KEY (created_by) REFERENCES Users(id)
);

CREATE TABLE IF NOT EXISTS Notes (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    contact_id INTEGER,
    comment TEXT,
    created_by INTEGER, -- Foreign Key to Users table
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (contact_id) REFERENCES Contacts(id),
    FOREIGN KEY (created_by) REFERENCES Users(id)
);


INSERT INTO Users (firstname, lastname, password, email, role, created_at)
VALUES ('Admin', 'User', '$2y$10$OM5emM7Q8sn3jm42Tsg3i.4yHo4zaJiwLc3X5nIB8ViopajOsTyLy', 'admin@project2.com', 'Administrator', CURRENT_TIMESTAMP);
INSERT INTO Notes (id, contact_id, comment, created_by, created_at)
VALUES(1,1,'This is a test note.', 1,CURRENT_TIMESTAMP);
INSERT INTO Notes (id, contact_id, comment, created_by, created_at)
VALUES(2,1,'This is test note 2.', 1,CURRENT_TIMESTAMP);