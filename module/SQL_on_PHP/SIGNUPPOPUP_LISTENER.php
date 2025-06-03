<?php
    include_once __DIR__."/HEADER.php";

    if(isset($_POST['insert_signup'])) insert_signup(
        $_POST['user_username'],
        $_POST['user_email'],
        $_POST['user_password']
    );


function insert_signup($user_username,$user_email,$user_password){
    $user_profilePicPath = __DIR__.'\\'.json_decode(file_get_contents(__DIR__.'/../../databaseConfig.json'))->defaultUser->profilePic; 
    $insertUser = getPDO()->prepare('
        INSERT INTO `user_t`(`profilePic`, `username`, `email`, `password`) 
        VALUES (:profilePic, :username, :email, :password)
    ');
    // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $insertUser->bindParam(':profilePic',file_get_contents($user_profilePicPath));
    $insertUser->bindParam(':username',$user_username);
    $insertUser->bindParam(':email',$user_email);
    $insertUser->bindParam(':password',$user_password);


    
    try{
        $insertUser->execute();
        echo '<body style="--code:success"></body>';
    } catch(PDOException $e){
        preg_match('/(key \')(.*)(\')/',$e->getMessage(),$match);
        echo '<body style="--code:duplicate '.$match[2].'"></body>';
        
    }

    //return 

 }
?>