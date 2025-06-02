<?php
    //this is executed by all php file
    session_start();
    $_SESSION['uid'] = $_SESSION['uid']??-1;


    //library
    
    function getPDO():PDO{
        // $dbh = new PDO('mysql:host=127.0.0.1;port=13306;dbname=myadmin_db;','root','ruidb');

        $param = json_decode(file_get_contents(__DIR__.'/../../databaseConfig.json'));
        $dbh = new PDO('mysql:
            host='.$param->database->host.';
            port='.$param->database->port.';
            dbname='.$param->database->dbname.';',
            $param->database->username,
            $param->database->password
        );
        
        return $dbh;            
    }

    function getProfilePic(){
        $defaulProfilePicPath = __DIR__.'\\'.json_decode(file_get_contents(__DIR__.'/../../databaseConfig.json'))->defaultUser->profilePic;
        $prefix = 'data:image/*;base64,';
        
        $dbh = getPDO();
        
        //get user info
        $selectUser = $dbh->prepare('
            SELECT profilePic FROM `user_t`
            WHERE id = :user_id
        ');
        $selectUser->setFetchMode(PDO::FETCH_COLUMN,0);
        $selectUser->bindValue(':user_id',$_SESSION['uid']);
        $selectUser->execute();
        
        
        $result = $selectUser->fetch()?:file_get_contents($defaulProfilePicPath);
        
        return $prefix.base64_encode($result);
    }


    
    
    
    

?>
