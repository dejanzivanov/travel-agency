CREATE TABLE `travel-agency`.`posts` (
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
                                         PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
