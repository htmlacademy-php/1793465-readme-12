CREATE DATABASE readme_db
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE readme_db;

CREATE TABLE `users` (
                        `id` INT(11) NOT NULL AUTO_INCREMENT ,
                        `reg_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                        `email` VARCHAR(50) NOT NULL ,
                        `login` VARCHAR(50) NOT NULL ,
                        `password` CHAR(64) NOT NULL , PRIMARY KEY (`id`),
                        `avatar_link` VARCHAR(100) NULL
) ENGINE = InnoDB;

CREATE TABLE `posts` (
                        `id` INT(11) NOT NULL AUTO_INCREMENT ,
                        `pub_date_post` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                        `title` VARCHAR(50) NOT NULL ,
                        `text` TEXT(2000) NOT NULL ,
                        `author_quote` VARCHAR(100) NOT NULL ,
                        `image_link` VARCHAR(100) NULL ,
                        `video_link` VARCHAR(100) NOT NULL ,
                        `site_link` VARCHAR(100) NOT NULL ,
                        `views` INT(11) NOT NULL DEFAULT 0,
                        `user_id` INT(11) NOT NULL ,
                        `content_type_id` INT(11) NOT NULL ,
                        `hashtag_id` INT(11) NULL
) ENGINE = InnoDB;

CREATE TABLE `comments` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT ,
                         `comment_pub_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                         `comment_content` TEXT(100) NOT NULL ,
                         `user_id` INT(11) NOT NULL ,
                         `post_id` INT(11) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `likes` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT ,
                         `user_id` INT(11) NOT NULL ,
                         `post_id` INT(11) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `subscriptions` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT ,
                         `user_id_subscribed` INT(11) NOT NULL ,
                         `user_id_subscribed_to` INT(11) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `messages` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT ,
                         `date_message_send` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                         `text_message` TEXT(2000) NOT NULL ,
                         `user_id_sender` INT(11) NOT NULL ,
                         `user_id_recipient` INT(11) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `hashtags` (
                         `id` INT(11) NOT NULL AUTO_INCREMENT ,
                         `hashtag_name` VARCHAR(50) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE `content_type` (
                          `id` INT(11) NOT NULL AUTO_INCREMENT ,
                          `type_name` VARCHAR(50) NOT NULL ,
                          `class_name` VARCHAR(50) NOT NULL
) ENGINE = InnoDB;
