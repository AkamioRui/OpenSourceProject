<?php
    include_once __DIR__."/HEADER.php";

    if(isset($_POST['query_Login']))query_Login($_POST['user_arg'],$_POST['user_password']);

    function query_Login($user_arg, $user_password){
        $dbh = getPDO();
        $selectLogin = $dbh->prepare('
            SELECT `id` FROM `user_t `
            WHERE (username = :user_arg OR email = :user_arg) AND password = :user_password
        ');
        $selectLogin->setFetchMode(PDO::FETCH_COLUMN,0);
        $selectLogin->bindValue(':user_arg',$user_arg);
        $selectLogin->bindValue(':user_password',$user_password);
        $selectLogin->execute();
        $_SESSION['uid'] = $selectLogin->fetch()?:-1;

        if($_SESSION['uid'] == -1){
            echo '<body style="--code:fail"></body>';
        } else {
            echo '<body style="--code:success"></body>';
        }

    };

?>


