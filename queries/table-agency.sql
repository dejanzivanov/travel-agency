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

-- Create dependents table
CREATE TABLE IF NOT EXISTS `dependents` (
                                            `id` INT UNSIGNED NOT NULL,
                                            `name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `phone_number` TEXT NOT NULL,
    FOREIGN KEY (`id`) REFERENCES `policy_holder`(`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

COMMIT;
