CREATE DATABASE IF NOT EXISTS `travel-agency`;

USE `travel-agency`;

START TRANSACTION;

-- Create policy_holder table
CREATE TABLE IF NOT EXISTS `policy_holder` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `type` VARCHAR(13),
    `phone_number` TEXT NOT NULL,
    `journey_start` DATE NOT NULL,
    `journey_end` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data into policy_holder table
INSERT INTO `policy_holder` (`name`, `last_name`, `type`, `phone_number`, `journey_start`, `journey_end`)
VALUES
    ('John', 'Doe', 'group', '1234567890', '2023-01-01', '2023-01-10'),
    ('Jane', 'Smith', 'group', '9876543210', '2023-02-05', '2023-02-12'),
    ('Michael', 'Johnson', 'group', '5555555555', '2023-03-10', '2023-03-20'),
    ('Emily', 'Brown', 'individual', '9999999999', '2023-04-15', '2023-04-25'),
    ('David', 'Lee', 'individual', '1111111111', '2023-05-20', '2023-05-30'),
    ('Sarah', 'Wilson', 'individual', '2222222222', '2023-06-25', '2023-07-05'),
    ('James', 'Anderson', 'individual', '3333333333', '2023-07-30', '2023-08-08'),
    ('Olivia', 'Taylor', 'individual', '4444444444', '2023-08-15', '2023-08-25'),
    ('Ethan', 'Martinez', 'individual', '5555555555', '2023-09-20', '2023-09-30'),
    ('Ava', 'Thomas', 'individual', '6666666666', '2023-10-25', '2023-11-04');

-- Create dependents table
CREATE TABLE IF NOT EXISTS `dependents` (
    `id` INT UNSIGNED NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `phone_number` TEXT NOT NULL,
    FOREIGN KEY (`id`) REFERENCES `policy_holder`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data into dependents table
INSERT INTO `dependents` (`id`, `name`, `last_name`, `phone_number`)
VALUES
    (1, 'John', 'Doe', '1234567890'),
    (1, 'Jane', 'Smith', '9876543210'),
    (1, 'Michael', 'Johnson', '5555555555'),
    (2, 'Emily', 'Brown', '9999999999'),
    (2, 'David', 'Lee', '1111111111'),
    (2, 'Sarah', 'Wilson', '2222222222'),
    (2, 'James', 'Anderson', '3333333333'),
    (3, 'Olivia', 'Taylor', '4444444444'),
    (3, 'Ethan', 'Martinez', '5555555555'),
    (3, 'Ava', 'Thomas', '6666666666');

-- Create posts table
CREATE TABLE IF NOT EXISTS `posts` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `author` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `published_at` TIMESTAMP NULL,
    `archived_at` TIMESTAMP NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `bodyText` TEXT NOT NULL,
    `image` TEXT NOT NULL,
    `type` ENUM('news', 'post') NOT NULL,
    `status` ENUM('published', 'archived', 'in_preparation') NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data into posts table
INSERT INTO `posts` (`author`, `created_at`, `published_at`, `archived_at`, `title`, `description`, `bodyText`, `image`, `type`, `status`)
VALUES
    ('John', '2023-01-01 12:00:00', '2023-01-02 10:00:00', NULL, 'Post 1 Title', 'Description', 'Text...', 'Image', 'post', 'published'),
    ('Jane', '2023-02-02 14:30:00', '2023-02-03 09:45:00', '2023-02-05 12:00:00', 'Post 2 Title', 'Description', 'Text...', 'Image', 'post', 'archived'),
    ('John', '2023-03-05 08:45:00', NULL, NULL, 'Post 3 Title', 'Description', 'Text...', 'Image', 'news', 'in_preparation'),
    ('Jane', '2023-04-08 11:20:00', '2023-04-09 14:00:00', NULL, 'Post 4 Title', 'Description', 'Text...', 'Image', 'post', 'published'),
    ('John', '2023-05-10 16:30:00', NULL, NULL, 'Post 5 Title', 'Description', 'Text...', 'Image', 'news', 'in_preparation'),
    ('Jane', '2023-06-13 19:15:00', '2023-06-14 08:00:00', NULL, 'Post 6 Title', 'Description', 'Text...', 'Image', 'post', 'published'),
    ('John', '2023-07-16 22:45:00', NULL, NULL, 'Post 7 Title', 'Description', 'Text...', 'Image', 'news', 'in_preparation'),
    ('Jane', '2023-08-19 06:30:00', NULL, NULL, 'Post 8 Title', 'Description', 'Text...', 'Image', 'news', 'in_preparation'),
    ('John', '2023-09-22 09:00:00', '2023-09-23 11:30:00', NULL, 'Post 9 Title', 'Description', 'Text...', 'Image', 'post', 'published'),
    ('Jane', '2023-10-25 14:20:00', NULL, NULL, 'Post 10 Title', 'Description', 'Text...', 'Image', 'news', 'in_preparation');
    
-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(250) NOT NULL,
    `last_name` VARCHAR(250) NOT NULL,
    `email` VARCHAR(250) NOT NULL,
    `password` VARCHAR(250) NOT NULL,
    `account_type` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY (`email`)
);

-- Insert data into users table
INSERT INTO `users` (`name`, `last_name`, `email`, `password`, `account_type`, `created_at`, `updated_at`)
VALUES
    ('John', 'Doe', 'john@example.com', 'password', 'user', '2023-01-01 12:00:00', '2023-01-01 12:00:00'),
    ('Jane', 'Smith', 'jane@example.com', 'password', 'admin', '2023-02-02 14:30:00', '2023-02-02 14:30:00'),
    ('Michael', 'Johnson', 'michael@example.com', 'password', 'user', '2023-03-05 08:45:00', '2023-03-05 08:45:00'),
    ('Emily', 'Brown', 'emily@example.com', 'password', 'user', '2023-04-08 11:20:00', '2023-04-08 11:20:00'),
    ('David', 'Lee', 'david@example.com', 'password', 'user', '2023-05-10 16:30:00', '2023-05-10 16:30:00'),
    ('Sarah', 'Wilson', 'sarah@example.com', 'password', 'admin', '2023-06-13 19:15:00', '2023-06-13 19:15:00'),
    ('James', 'Anderson', 'james@example.com', 'password', 'user', '2023-07-16 22:45:00', '2023-07-16 22:45:00'),
    ('Olivia', 'Taylor', 'olivia@example.com', 'password', 'user', '2023-08-19 06:30:00', '2023-08-19 06:30:00'),
    ('Ethan', 'Martinez', 'ethan@example.com', 'password', 'admin', '2023-09-22 09:00:00', '2023-09-22 09:00:00'),
    ('Ava', 'Thomas', 'ava@example.com', 'password', 'user', '2023-10-25 14:20:00', '2023-10-25 14:20:00'),
	('Deki', 'Deki', 'deki@deki.com', 'password', 'admin', '2023-10-25 14:20:00', '2023-10-25 14:20:00');

COMMIT;
