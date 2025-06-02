<?php
    include_once __DIR__."/HEADER.php";

    if(isset($_POST['insert_Forum'])) insert_Forum(
        $_POST['name'],
        $_FILES['banner']['tmp_name'],
        $_FILES['icon']['tmp_name'],
        $_POST['descriptions'],
        
    );


function insert_Forum(
    $forum_name,
    $forum_bannerPath,
    $forum_iconPath,
    $forum_descriptions
){  
    $insertForum = getPDO()->prepare('
        INSERT INTO forum_t (`name`,`banner`,`icon`,`descriptions`,`creatorId`)
        VALUES(:name,:banner,:icon,:descriptions,:creatorId)
    ');      
    $insertForum->bindValue(':name',$forum_name);
    $insertForum->bindValue(':banner',file_get_contents($forum_bannerPath));
    $insertForum->bindValue(':icon',file_get_contents($forum_iconPath));
    $insertForum->bindValue(':descriptions',$forum_descriptions);
    $insertForum->bindValue(':creatorId',$_SESSION['uid']);
    

    try{
        $insertForum->execute();
        echo '<body style="--code:success"></body>';
    } catch(PDOException $e){
        echo '<body style="--code:\''.$e->getMessage() .'\'"></body>';
        
    }
 }
?>