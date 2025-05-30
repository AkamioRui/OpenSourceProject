CREATE TABLE `user_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `profilePic` MEDIUMBLOB,
    `username` VARCHAR(1024) NOT NULL UNIQUE,
    `email` VARCHAR(1024) NOT NULL UNIQUE,
    `password` VARCHAR(1024) NOT NULL,
    `admin` BOOL DEFAULT 0
);
CREATE TABLE `forum_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(1024),
    `banner` MEDIUMBLOB,
    `icon` MEDIUMBLOB,
    `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `creatorId` INT,
    `descriptions` VARCHAR(1024),
    FOREIGN KEY `forum_fk_creatorId` (`creatorId`) REFERENCES `user_t` (`id`) ON DELETE SET NULL 

);
CREATE TABLE `post_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `creatorId` INT,
    `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `title` VARCHAR(1024),
    `contents` VARCHAR(1024),
    `forumId` INT NOT NULL,
    `like` INT DEFAULT 0,
    FOREIGN KEY `post_fk_creatorId` (`creatorId`) REFERENCES `user_t` (`id`) ON DELETE SET NULL ,
    FOREIGN KEY `post_fk_forumId` (`forumId`) REFERENCES `forum_t` (`id`) ON DELETE CASCADE 
);
CREATE TABLE `postPicture_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `postId` INT NOT NULL,
    `picture` MEDIUMBLOB,
    FOREIGN KEY `postPicture_fk_postId` (`postId`) REFERENCES `post_t` (`id`) ON DELETE CASCADE
);
CREATE TABLE `comment_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `creatorId` INT ,
    `postId` INT NOT NULL,
    `parentId` INT ,
    `comment` VARCHAR(1024),
    `like` INT DEFAULT 0,
    FOREIGN KEY `comment_fk_creatorId` (`creatorId`) REFERENCES `user_t` (`id`) ON DELETE SET NULL ,
    FOREIGN KEY `comment_fk_postId` (`postId`) REFERENCES `post_t` (`id`) ON DELETE CASCADE ,
    FOREIGN KEY `comment_fk_parentId` (`parentId`) REFERENCES `comment_t` (`id`) ON DELETE CASCADE
);





-- ADD TO `user_t` createdAt
-- ADD TO `forum_t` createdAt
-- ADD TO `comment_t` creatorId
-- ADD TO `postPicture_t` id
-- RENAME `post_t`.`date` TO `post_t`.`createdAt`
-- CHANGE ATTRIBUTE NAMING CONVENTION FROM USING _ TO CAMEL
-- CHANGE TYPE DATETIME to TIMESTAMP DEFAULT CURRENT_TIMESTAMP
