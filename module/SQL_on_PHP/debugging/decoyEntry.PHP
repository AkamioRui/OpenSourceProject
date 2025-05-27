

<?php
    include_once __DIR__.'\..\library.php';
    $dbh = getPDO();

    $intoUser = $dbh->prepare('
        INSERT INTO `user_t`(createdAt, profilePic, username, email, password, admin)
        VALUES (:createdAt, :profilePic, :username, :email, :password, :admin)
    ');
        $intoUser->bindValue(':createdAt',date('Y-m-d H:i:s'));
        $intoUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic1.jpg')));
        $intoUser->bindValue(':username','user1');
        $intoUser->bindValue(':email','user1@gmail.com');
        $intoUser->bindValue(':password','pass1');
        $intoUser->bindValue(':admin',true);
    $intoUser->execute();
    //     $intoUser->bindValue(':createdAt',date('Y-m-d H:i:s'));
    //     $intoUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic2.jpg')));
    //     $intoUser->bindValue(':username','user2');
    //     $intoUser->bindValue(':email','user2@gmail.com');
    //     $intoUser->bindValue(':password','pass2');
    //     $intoUser->bindValue(':admin',false);
    // $intoUser->execute();
    //     $intoUser->bindValue(':createdAt',date('Y-m-d H:i:s'));
    //     $intoUser->bindValue(':profilePic',base64_encode(file_get_contents(__DIR__.'\user_profilePic3.jpg')));
    //     $intoUser->bindValue(':username','user3');
    //     $intoUser->bindValue(':email','user3@gmail.com');
    //     $intoUser->bindValue(':password','pass3');
    //     $intoUser->bindValue(':admin',false);
    // $intoUser->execute();

    

    // $addforum1 = $dbh1->prepare("
    //     INSERT INTO `forum_t`(`name`, `banner`, `icon`, `createdAt`, `creatorId`, `descriptions`)
    //     VALUES(:name, :banner, :icon, :createdAt, :creatorId, :descriptions)
    // ");
    // $addforum1->bindParam(':name' ,$name );
    // $addforum1->bindParam(':banner' ,$banner );
    // $addforum1->bindParam(':icon' ,$icon );
    // $addforum1->bindParam(':createdAt' ,$createdAt );
    // $addforum1->bindParam(':creatorId' ,$creatorId );
    // $addforum1->bindParam(':descriptions' ,$descriptions );
    // $name = 'genshin';
    // $banner = null ;
    // $icon = null;
    // $createdAt = date('Y-m-d H:i:s');
    // $creatorId = 1;
    // $descriptions = 'genshin impact';
    // $addforum1->execute();


    // $adduser1 = $dbh1->prepare("
    //     INSERT INTO `user_t`( `createdAt`, `profilePic`, `username`, `email`, `password`, `admin`)
    //     VALUES(:createdAt, :profilePic, :username, :email, :password, :admin)
    // ");
    // $adduser1->bindParam(':createdAt'  ,$createdAt  );
    // $adduser1->bindParam(':profilePic' ,$profilePic );
    // $adduser1->bindParam(':username'   ,$username   );
    // $adduser1->bindParam(':email'      ,$email      );
    // $adduser1->bindParam(':password'   ,$password   );
    // $adduser1->bindParam(':admin'      ,$admin      );
    // $createdAt = date('Y-m-d H:i:s');
    // $profilePic = null ;
    // $username = 'newcomer';
    // $email = 'newcomer@gmail.com';
    // $password = 'pass1';
    // $admin = true;
    // $adduser1->execute();
?>