CREATE DATABASE IF NOT EXISTS fithelp CHARACTER SET utf8mb4;

USE `fithelp`;

CREATE TABLE `types_articles`
(
    `category_article_id` INT AUTO_INCREMENT,
    `category_name` VARCHAR(50)  NOT NULL,
    PRIMARY KEY(`category_article_id`)
);

CREATE TABLE `body_parts`
(
    `body_part_id` INT AUTO_INCREMENT,
    `body_part` VARCHAR(50)  NOT NULL,
    `body_part_parent_id` INT,
    PRIMARY KEY(`body_part_id`),
    FOREIGN KEY(`body_part_parent_id`) REFERENCES `body_parts`(`body_part_id`)
);

CREATE TABLE `users`
(
    `user_id` INT AUTO_INCREMENT,
    `user_name` VARCHAR(50)  NOT NULL,
    `mail` VARCHAR(255) ,
    `password` VARCHAR(60)  NOT NULL,
    `inscription_date` DATE NOT NULL,
    `birthdate` DATE NOT NULL,
    `gender` BOOLEAN NOT NULL,
    `role` INT NOT NULL,
    PRIMARY KEY(`user_id`),
    UNIQUE(`mail`)
);

CREATE TABLE `articles`
(
    `article_id` INT AUTO_INCREMENT,
    `title` VARCHAR(255)  NOT NULL,
    `containt` VARCHAR(2500)  NOT NULL,
    `picture` VARCHAR(50) NOT NULL,
    `publication_date` DATE,
    `category_article_id` INT NOT NULL,
    PRIMARY KEY(`article_id`),
    FOREIGN KEY(`category_article_id`) REFERENCES `types_articles`(`category_article_id`)
);

CREATE TABLE `exercices`
(
    `exercice_id` INT AUTO_INCREMENT,
    `title` VARCHAR(50)  NOT NULL,
    `intro` VARCHAR(2500)  NOT NULL,
    `position` VARCHAR(2500)  NOT NULL,
    `movement` VARCHAR(2500)  NOT NULL,
    `image` VARCHAR(50)  NOT NULL,
    `targeted_muscles` VARCHAR(2500)  NOT NULL,
    `body_part_id` INT NOT NULL,
    PRIMARY KEY(`exercice_id`),
    FOREIGN KEY(`body_part_id`) REFERENCES `body_parts`(`body_part_id`)
);

CREATE TABLE `programs`
(
    `program_id` INT AUTO_INCREMENT,
    `name` VARCHAR(50)  NOT NULL,
    `description` VARCHAR(2500)  NOT NULL,
    `duration` INT NOT NULL,
    PRIMARY KEY(`program_id`)
);

CREATE TABLE `comments`
(
    `comment_id` INT AUTO_INCREMENT,
    `content` TEXT NOT NULL,
    `publication_date` DATE NOT NULL,
    `publicate` BOOLEAN,
    `user_id` INT NOT NULL,
    `article_id` INT NOT NULL,
    PRIMARY KEY(`comment_id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
    FOREIGN KEY(`article_id`) REFERENCES `articles`(`article_id`)
);

CREATE TABLE `calorie_calculate`
(
    `calorie_calculate_id` INT AUTO_INCREMENT,
    `created_at` DATE NOT NULL,
    `lvl_act` VARCHAR(50) NOT NULL,
    `objective` VARCHAR(50) NOT NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY(`calorie_calculate_id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`)
);

CREATE TABLE `data`
(
    `data_id` INT AUTO_INCREMENT,
    `weight` DECIMAL(5,2) NOT NULL,
    `height` DECIMAL(5,2) NOT NULL,
    `created_at` DATE NOT NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY(`data_id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`)
);

CREATE TABLE `like`
(
    `user_id` INT,
    `article_id` INT,
    PRIMARY KEY(`user_id`, `article_id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
    FOREIGN KEY(`article_id`) REFERENCES `articles`(`article_id`)
);

CREATE TABLE `mark`
(
    `user_id` INT,
    `exercice_id` INT,
    PRIMARY KEY(`user_id`, `exercice_id`),
    FOREIGN KEY(`user_id`) REFERENCES `users`(`user_id`),
    FOREIGN KEY(`exercice_id`) REFERENCES `exercices`(`exercice_id`)
);

CREATE TABLE `program_ex`
(
    `exercice_id` INT,
    `program_id` INT,
    PRIMARY KEY(`exercice_id`, `program_id`),
    FOREIGN KEY(`exercice_id`) REFERENCES `exercices`(`exercice_id`),
    FOREIGN KEY(`program_id`) REFERENCES `programs`(`program_id`)
);
