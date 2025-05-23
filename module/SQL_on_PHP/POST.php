<?php
    function getPDO():PDO{
        $param = json_decode(file_get_contents('databaseConfig.json'));
        $dbh = new PDO('mysql:
            host='.$param->host.';
            port='.$param->port.';
            dbname='.$param->dbname.';',
            $param->username,
            $param->password
        );
        
        return $dbh;            
    }


    // class POST{


    //     function getPost(){

    //     }
    // };

    // $dbh = new PDO('mysql:host=127.0.0.1;port=13306;dbname=myadmin_db;','root','ruidb');
    


    // echo data_uri('test.png','img/png')
    // $stmt = $dbh->prepare()


    // $dbh = getPDO();
    // $stmt = $dbh->prepare('
    //     INSERT INTO `user_t`(`createdAt`, `profilePic`, `username`, `email`, `password`, `admin`) 
    //     VALUES(:createdAt, :profilePic, :username, :email, :password, :admin) 
    // ');
    // $stmt->bindParam(':createdAt',$createdAt);
    // $stmt->bindParam(':profilePic',$profilePic);
    // $stmt->bindParam(':username',$username);
    // $stmt->bindParam(':email',$email);
    // $stmt->bindParam(':password',$password);
    // $stmt->bindParam(':admin',$admin);
    // $createdAt = strtotime('now');
    // $profilePic = NULL;
    // $username = 'testificate';
    // $email = 
    // $password = 
    // $admin = 

    // $result =  file_get_contents('./module/SQL_on_PHP/test.png');
    // $result =  file_get_contents('\module\SQL_on_PHP\test.html');
    // $result =  file_get_contents('D:\tugas\2_2\OpenSource\MessageBroardProject\module\SQL_on_PHP\test.html');
    
    // $result = base64_encode(file_get_contents('D:\tugas\2_2\OpenSource\MessageBroardProject\module\SQL_on_PHP\test.png'));
    $result = addslashes(file_get_contents('D:\tugas\2_2\OpenSource\MessageBroardProject\module\SQL_on_PHP\test.png'));
    
	
	
	
	
	

    
?>

<!-- <img src="data:image/png;base64,<?=$result?>" /> -->
<img src="<?=$result?>" />