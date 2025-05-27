<?php
    include_once "library.php";
    // header('Location:/module/SQL_on_PHP/POST.php');
//!!!!!!!!  if forum id = invalid , do what? 

    

    
    
    $dbh1 = $dbh1 ?? getPDO();
    $dbh2 = $dbh2 ?? getPDO();
    
    



    $select1 = $dbh1->prepare("
        SELECT * FROM `user_t`
    ");
    // $select1->bindColumn('username',$retName);
    $select1->setFetchMode(PDO::FETCH_ASSOC);
    $select1->execute();

    $select2 = $dbh1->prepare("
        SELECT * FROM `forum_t`
    ");
    $select2->setFetchMode(PDO::FETCH_ASSOC);
    $select2->execute();
    
    

    
    $result = $select1->fetch();
    foreach($result as $key=>$value){
        echo $key.':'.$value.' | ';
    }
    echo '<br>';

    // $select1->closeCursor();
    

    $result = $select2->fetch();
    foreach($result as $key=>$value){
        echo $key.':'.$value.' | ';
    }
    echo '<br>';


    // $select1->execute();
    $result = $select1->fetch();
    foreach($result as $key=>$value){
        echo $key.':'.$value.' | ';
    }
    echo '<br>';
    

    

   



    
    
?>

<html>
    <body>
    <h1> image </h1>    
    <!-- <img src="data:image/png;base64,<?=$img?>" /> -->
    </body>
</html>



<?php

/* CREATE TABLE `user_t` (
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
    `parentId` INT 
        REFERENCES `comment_t` (`id`) ON DELETE CASCADE ,
    `comment` VARCHAR(1024),
    `like` INT
); */
?>


