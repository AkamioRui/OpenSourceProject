<?php
    include_once __DIR__."/HEADER.php";
    // header('Location:/module/SQL_on_PHP/POST.php');
//!!!!!!!!  if forum id = invalid , do what? 

    $dbh = getPDO();


    $select = $dbh->prepare("
        SELECT (
            SELECT f.name
            FROM forum_t f
            WHERE f.creatorId = u.id
        ) as titles
        FROM `user_t` u
        WHERE u.id = 1;
    ");
    $select->bindColumn('titles',$name);
    $select->setFetchMode(PDO::FETCH_ASSOC);
    $select->execute();
    // $select->fetchAll();

    

    var_dump($select->fetch());
    var_dump($name);
    
?>
<html>
    <body>
    <h1> image </h1>    
    <img src="data:image/png;base64," />
    </body>
</html>





