# This file is a work in progress, I am not going to use mysql for now. Maybe later if needed.

# Creating this file based on mysql database.

# Create the database
CREATE DATABASE IF NOT EXISTS passwordStore;

# Create the user
CREATE USER 'passwordStore'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON passwordStore.* TO 'passwordStore'@'localhost';
FLUSH PRIVILEGES;

# Create users table
CREATE TABLE IF NOT EXISTS passwords (
    id INT,
    type ENUM('system', 'application', 'other'),

);

