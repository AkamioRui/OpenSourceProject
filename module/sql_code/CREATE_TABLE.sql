CREATE TABLE `user_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP,
    `profilePic` BLOB,
    `username` VARCHAR(1024),
    `email` VARCHAR(1024),
    `password` VARCHAR(1024),
    `admin` BOOL
);
CREATE TABLE `forum_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(1024),
    `banner` BLOB,
    `icon` BLOB,
    `createdAt` TIMESTAMP,
    `creatorId` INT  
        REFERENCES `user_t` (`id`) ON DELETE SET NULL ,
    `descriptions` VARCHAR(1024)
);
CREATE TABLE `post_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `creatorId` INT 
        REFERENCES `user_t` (`id`) ON DELETE SET NULL,
    `createdAt` TIMESTAMP,
    `title` VARCHAR(1024),
    `contents` VARCHAR(1024),
    `forumId` INT NOT NULL
        REFERENCES `forum_t` (`id`) ON DELETE CASCADE ,
    `like` INT
);
CREATE TABLE `postPicture_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `postId` INT NOT NULL
        REFERENCES `post_t` (`id`) ON DELETE CASCADE,
    `picture` BLOB
);
CREATE TABLE `comment_t` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `createdAt` TIMESTAMP,
    `creatorId` INT 
        REFERENCES `user_t` (`id`) ON DELETE SET NULL ,
    `postId` INT NOT NULL
        REFERENCES `post_t` (`id`) ON DELETE CASCADE ,
    `parentId` INT NOT NULL
        REFERENCES `comment_t` (`id`) ON DELETE CASCADE ,
    `comment` VARCHAR(1024),
    `like` INT
);




-- ADD TO `user_t` createdAt
-- ADD TO `forum_t` createdAt
-- ADD TO `comment_t` creatorId
-- ADD TO `postPicture_t` id
-- RENAME `post_t`.`date` TO `post_t`.`createdAt`
-- CHANGE ATTRIBUTE NAMING CONVENTION FROM USING _ TO CAMEL
-- CHANGE TYPE DATETIME to TIMESTAMP
