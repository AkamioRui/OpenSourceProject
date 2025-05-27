

<?php
    include_once __DIR__.'\..\library.php';
    $dbh = getPDO();

    $addUser = $dbh->prepare('
        INSERT INTO `user_t`( profilePic, username, email, password, admin)
        VALUES ( :profilePic, :username, :email, :password, :admin)
    ');
        $addUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic1.jpg')));
        $addUser->bindValue(':username','user1');
        $addUser->bindValue(':email','user1@gmail.com');
        $addUser->bindValue(':password','pass1');
        $addUser->bindValue(':admin',true);
    $addUser->execute();
        $addUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic2.jpg')));
        $addUser->bindValue(':username','user2');
        $addUser->bindValue(':email','user2@gmail.com');
        $addUser->bindValue(':password','pass2');
        $addUser->bindValue(':admin',0);
    $addUser->execute();
        $addUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic3.jpg')));
        $addUser->bindValue(':username','user3');
        $addUser->bindValue(':email','user3@gmail.com');
        $addUser->bindValue(':password','pass3');
        $addUser->bindValue(':admin',0);
    $addUser->execute();

    

    $addforum = $dbh->prepare("
        INSERT INTO `forum_t`(`name`, `banner`, `icon`, `creatorId`, `descriptions`)
        VALUES(:name, :banner, :icon, :creatorId, :descriptions)
    ");
        $addforum->bindValue(':name' , 'apple');
        $addforum->bindValue(':banner' , base64_encode(file_get_contents(__DIR__.'\forum_banner1.jpg')));
        $addforum->bindValue(':icon' , base64_encode(file_get_contents(__DIR__.'\forum_icon1.jpg')));
        $addforum->bindValue(':creatorId' , 1);
        $addforum->bindValue(':descriptions' , 'about apple');
    $addforum->execute();
        $addforum->bindValue(':name' , 'oranges');
        $addforum->bindValue(':banner' , base64_encode(file_get_contents(__DIR__.'\forum_banner2.jpg')));
        $addforum->bindValue(':icon' , base64_encode(file_get_contents(__DIR__.'\forum_icon2.jpg')));
        $addforum->bindValue(':creatorId' , 1);
        $addforum->bindValue(':descriptions' , 'about oranges');
    $addforum->execute();
        $addforum->bindValue(':name' , 'grape');
        $addforum->bindValue(':banner' , base64_encode(file_get_contents(__DIR__.'\forum_banner3.jpg')));
        $addforum->bindValue(':icon' , base64_encode(file_get_contents(__DIR__.'\forum_icon3.jpg')));
        $addforum->bindValue(':creatorId' , 1);
        $addforum->bindValue(':descriptions' , 'about grape');
    $addforum->execute();


    $addpost = $dbh->prepare("
        INSERT INTO `post_t`(`creatorId`, `createdAt`, `title`, `contents`, `forumId`, `like`)
        VALUES(:creatorId, :createdAt, :title, :contents, :forumId, :like)
    ");
    // $addpost->bindValue(':creatorId' , 2);
    // $addpost->bindValue(':createdAt' , date('Y-m-d H:i:s'));
    // $addpost->bindValue(':title' , 'new type of apple');
    // $addpost->bindValue(':contents' ,'the new type is ');
    // $addpost->bindValue(':forumId' , 1);
    // $addpost->bindValue(':like' , 'about apple');
    // $addpost->execute();
    
?>