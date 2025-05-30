<?php
    include_once __DIR__."/../HEADER.php";
    $dbh = getPDO();

    $addUser = $dbh->prepare('
        INSERT INTO `user_t`( profilePic, username, email, password, admin)
        VALUES ( :profilePic, :username, :email, :password, :admin)
    ');
    //     $addUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic1.jpg')));
    //     $addUser->bindValue(':username','user1');
    //     $addUser->bindValue(':email','user1@gmail.com');
    //     $addUser->bindValue(':password','pass1');
    //     $addUser->bindValue(':admin',true);
    // $addUser->execute();
    //     $addUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic2.jpg')));
    //     $addUser->bindValue(':username','user2');
    //     $addUser->bindValue(':email','user2@gmail.com');
    //     $addUser->bindValue(':password','pass2');
    //     $addUser->bindValue(':admin',0);
    // $addUser->execute();
    //     $addUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic3.jpg')));
    //     $addUser->bindValue(':username','user3');
    //     $addUser->bindValue(':email','user3@gmail.com');
    //     $addUser->bindValue(':password','pass3');
    //     $addUser->bindValue(':admin',0);
    // $addUser->execute();

    

    $addforum = $dbh->prepare("
        INSERT INTO `forum_t`(`name`, `banner`, `icon`, `creatorId`, `descriptions`)
        VALUES(:name, :banner, :icon, :creatorId, :descriptions)
    ");
    //     $addforum->bindValue(':name' , 'apple');
    //     $addforum->bindValue(':banner' , base64_encode(file_get_contents(__DIR__.'\forum_banner1.jpg')));
    //     $addforum->bindValue(':icon' , base64_encode(file_get_contents(__DIR__.'\forum_icon1.jpg')));
    //     $addforum->bindValue(':creatorId' , 1);
    //     $addforum->bindValue(':descriptions' , 'about apple');
    // $addforum->execute();
    //     $addforum->bindValue(':name' , 'oranges');
    //     $addforum->bindValue(':banner' , base64_encode(file_get_contents(__DIR__.'\forum_banner2.jpg')));
    //     $addforum->bindValue(':icon' , base64_encode(file_get_contents(__DIR__.'\forum_icon2.jpg')));
    //     $addforum->bindValue(':creatorId' , 1);
    //     $addforum->bindValue(':descriptions' , 'about oranges');
    // $addforum->execute();
    //     $addforum->bindValue(':name' , 'grape');
    //     $addforum->bindValue(':banner' , base64_encode(file_get_contents(__DIR__.'\forum_banner3.jpg')));
    //     $addforum->bindValue(':icon' , base64_encode(file_get_contents(__DIR__.'\forum_icon3.jpg')));
    //     $addforum->bindValue(':creatorId' , 1);
    //     $addforum->bindValue(':descriptions' , 'about grape');
    // $addforum->execute();


    $addpost = $dbh->prepare("
        INSERT INTO `post_t`(`creatorId`, `title`, `contents`, `forumId`, `like`)
        VALUES(:creatorId, :title, :contents, :forumId, :like)
    ");
    // $addpost->bindValue(':creatorId' , 2);
    // $addpost->bindValue(':title' , 'my new apple');
    // $addpost->bindValue(':contents' ,'a big round apple ');
    // $addpost->bindValue(':forumId' , 1);
    // $addpost->bindValue(':like' , 0);
    // $addpost->execute();
    // $addpost->bindValue(':creatorId' , 1);
    // $addpost->bindValue(':title' , 'sencond post about apple');
    // $addpost->bindValue(':contents' ,'a big round apple oooh ');
    // $addpost->bindValue(':forumId' , 1);
    // $addpost->bindValue(':like' , 0);
    // $addpost->execute();
    // $addpost->bindValue(':creatorId' , 3);
    // $addpost->bindValue(':title' , 'apple again');
    // $addpost->bindValue(':contents' ,'a big round apple NOOO');
    // $addpost->bindValue(':forumId' , 1);
    // $addpost->bindValue(':like' , 0);
    // $addpost->execute();

    $addpostPicture = $dbh->prepare("
        INSERT INTO `postPicture_t`(`postId`, `picture`)
        VALUES(:postId, :picture)
    ");
    // $addpostPicture->bindValue(':postId' , 2);
    // $addpostPicture->bindValue(':picture' , base64_encode(file_get_contents(__DIR__.'\post1img1.jpg')));
    // $addpostPicture->execute();
    // $addpostPicture->bindValue(':postId' , 2);
    // $addpostPicture->bindValue(':picture' , base64_encode(file_get_contents(__DIR__.'\post1img2.jpg')));
    // $addpostPicture->execute();
    // $addpostPicture->bindValue(':postId' , 3);
    // $addpostPicture->bindValue(':picture' , base64_encode(file_get_contents(__DIR__.'\post1img3.webp')));
    // $addpostPicture->execute();
    
    $addReqpost = $dbh->prepare("
        SELECT max(id) from post_t;
        INSERT INTO `post_t`(`creatorId`, `title`, `contents`, `forumId` )
        VALUES(:creatorId, :title, :contents, :forumId);
    ");
    $addReqpost->bindValue(':creatorId' , 2);
    $addReqpost->bindValue(':title' , 'my new red apple');
    $addReqpost->bindValue(':contents' ,'a sour apple ');
    $addReqpost->bindValue(':forumId' , 1);
    $addReqpost->execute();
    var_dump($addReqpost->fetch());
    
?>







