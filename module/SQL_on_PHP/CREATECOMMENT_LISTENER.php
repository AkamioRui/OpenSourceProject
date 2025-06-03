<?php
    include_once __DIR__."/HEADER.php";

    if($_SESSION['uid'] == -1){
        /* 
        ob_start();
        include_once __DIR__.'ACCOUNTPAGE.php';
        $page = ob_get_clean();    
        echo preg_replace('/<body.*>/','<body style="--code=\'no user_id\'">',$page);
        ob_end_flush();
        */
        /* TEMP */echo '<body src="--code:\'no user_id\'"> </body>';
        return;
    }
    if(isset($_POST['insert_Comment'])) insert_Comment(
        $_POST['postId'],
        $_POST['parentId'],
        $_POST['comment']
    );


function insert_Comment(
    $comment_postId,
    $comment_parentId,
    $comment_comment
){  
    $insertComment = getPDO()->prepare('
        INSERT INTO `comment_t` (`creatorId`,`postId`,`parentId`,`comment`)
        VALUES(:creatorId,:postId,:parentId,:comment)
    ');      
    $insertComment->bindValue(':creatorId',$_SESSION['uid']);
    $insertComment->bindValue(':postId',$comment_postId);
    $insertComment->bindValue(':parentId',$comment_parentId);
    $insertComment->bindValue(':comment',$comment_comment);
    
    try{
        $insertComment->execute();
        echo '<body style="--code:success"></body>';
    } catch(PDOException $e){
        echo '<body style="--code:\''.$e->getMessage() .'\'"></body>';
        
    }
 }
?>