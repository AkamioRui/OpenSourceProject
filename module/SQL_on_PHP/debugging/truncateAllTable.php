

<?php
    include_once __DIR__."/HEADER.php";
    $dbh = getPDO();

    $RemoveAllConstraint = '
        ALTER TABLE `forum_t`        
            DROP CONSTRAINT `forum_fk_creatorId`;
        ALTER TABLE `post_t`
            DROP CONSTRAINT `post_fk_creatorId`,
            DROP CONSTRAINT `post_fk_forumId`;
        ALTER TABLE `postPicture_t`
            DROP CONSTRAINT `postPicture_fk_postId`;
        ALTER TABLE `comment_t`
            DROP CONSTRAINT `comment_fk_creatorId`,
            DROP CONSTRAINT `comment_fk_postId`,
            DROP CONSTRAINT `comment_fk_parentId`; 
    ';  
    $AddAllConstraint = '
        ALTER TABLE `forum_t` 
            ADD FOREIGN KEY `forum_fk_creatorId` (`creatorId`) REFERENCES `user_t` (`id`) ON DELETE SET NULL; 
        ALTER TABLE `post_t` 
            ADD FOREIGN KEY `post_fk_creatorId` (`creatorId`) REFERENCES `user_t` (`id`) ON DELETE SET NULL,
            ADD FOREIGN KEY `post_fk_forumId` (`forumId`) REFERENCES `forum_t` (`id`) ON DELETE CASCADE;
        ALTER TABLE `postPicture_t` 
            ADD FOREIGN KEY `postPicture_fk_postId` (`postId`) REFERENCES `post_t` (`id`) ON DELETE CASCADE;
        ALTER TABLE `comment_t` 
            ADD FOREIGN KEY `comment_fk_creatorId` (`creatorId`) REFERENCES `user_t` (`id`) ON DELETE SET NULL, 
            ADD FOREIGN KEY `comment_fk_postId` (`postId`) REFERENCES `post_t` (`id`) ON DELETE CASCADE, 
            ADD FOREIGN KEY `comment_fk_parentId` (`parentId`) REFERENCES `comment_t` (`id`) ON DELETE CASCADE;
    ';
    $TruncateAllTable = '
        TRUNCATE TABLE `user_t`;
        TRUNCATE TABLE `forum_t`;
        TRUNCATE TABLE `post_t`;
        TRUNCATE TABLE `postPicture_t`;
        TRUNCATE TABLE `comment_t`;
    ';
    $DropAllTable = '
        DROP TABLE `user_t`;
        DROP TABLE `forum_t`;
        DROP TABLE `post_t`;
        DROP TABLE `postPicture_t`;
        DROP TABLE `comment_t`;
    ';

    
    $cleaner = $dbh->prepare(
        $RemoveAllConstraint.
        $DropAllTable.
        $AddAllConstraint
    );
    $cleaner->execute();
         
    // echo $RemoveAllConstraint.
    //     $TruncateAllTable.
    //     $AddAllConstraint;



    
;

// ALTER TABLE `post_t`
// DROP CONSTRAINT `post_t_ibfk_1`,
// DROP CONSTRAINT `post_t_ibfk_2`;
// ALTER TABLE `postPicture_t`
// DROP CONSTRAINT `postpicture_t_ibfk_1`;
// ALTER TABLE `comment_t`
// DROP CONSTRAINT `comment_t_ibfk_1`,
// DROP CONSTRAINT `comment_t_ibfk_2`,
// DROP CONSTRAINT `comment_t_ibfk_3`;       

?>