<?php
    include_once "library.php";
    // header('Location:/module/SQL_on_PHP/POST.php');
//!!!!!!!!  if forum id = invalid , do what? 

    $dbh = getPDO();


    $select = $dbh->prepare("
        SELECT * FROM `user_t`
    ");
    $select->bindColumn('profilePic',$img);
    $select->setFetchMode(PDO::FETCH_ASSOC);
    $select->execute();

    $select->fetch();

    
?>

<html>
    <body>
    <h1> image </h1>    
    <!-- <img src="data:image/png;base64,<?=$img?>" /> -->
    </body>
</html>



