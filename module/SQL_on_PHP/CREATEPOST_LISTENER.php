<?php
    /*  
    code is in the document.body.style.getPropertyValue('--code')
        'no user_id' + ACCOUNTPAGE
        'no forum_id'
        'success'
    */

    include_once __DIR__."/HEADER.php";
    
    //control
    if($_SESSION['uid'] == -1){
        /* 
        ob_start();
        include_once __DIR__.'ACCOUNTPAGE.php';
        $page = ob_get_clean();    
        echo preg_replace('/<body.*>/','<body style="--code=\'no user_id\'">',$page);
        ob_end_flush();
        */
        /* TEMP */echo '<body style="--code:\'no user_id\'"> </body>';
        return;
    }
    if( !isset($_POST['forum_id']) ){ 
        echo '<body style="--code:\'no forum_id\';"> </body>';
        return;
    }
    $_POST['post_title'] ?? '';
    $_POST['post_contents'] ?? '';
    // $_FILES['postPicture_picture'];
    submitPostData();

    
    /* temp *///submitPostData_print();

    //library
    function submitPostData(){
        $dbh = getPDO();
        
        $insertPost = $dbh->prepare('
            SELECT max(`id`) FROM `post_t`;
            INSERT INTO `post_t`(`creatorId`, `title`, `contents`, `forumId`)
            VALUES(:creatorId, :title, :contents, :forumId);
        ');
        $insertPost->setFetchMode(PDO::FETCH_COLUMN,0);
        $insertPost->bindValue(':creatorId',$_SESSION['uid']);
        $insertPost->bindValue(':title',$_POST['post_title']??'');
        $insertPost->bindValue(':contents',$_POST['post_contents']??'');
        $insertPost->bindValue(':forumId',$_POST['forum_id']);
        $insertPost->execute();
        
        
        if(isset($_FILES['postPicture_picture']['tmp_name'])){
            $getid = $insertPost->fetch() + 1;
            $insertPost->closeCursor();
            $image = null;
            $insertPostPicture = $dbh->prepare('
                INSERT INTO `postPicture_t`(`postId`, `picture`)
                VALUES(:postId, :picture)
            ');
            $insertPostPicture->bindValue(':postId',$getid);
            $insertPostPicture->bindParam(':picture',$image);
            foreach($_FILES['postPicture_picture']['tmp_name'] as $file){
                $image= file_get_contents($file);
                $insertPostPicture->execute();
            }
        }
        
        
        
        
        echo '<body style="--code:\'success\';"> </body>';
    }

    function submitPostData_print(){
        ?>
        <p>$_SESSION['uid'] = <?=$_SESSION['uid']?> </p><br>
        <p>$_POST['post_title'] = <?=$_POST['post_title']?> </p><br>
        <p>$_POST['post_contents'] = <?=$_POST['post_contents']?> </p><br>
        <p>$_POST['forum_id'] = <?=$_POST['forum_id']?> </p><br>
        <?php
        
        if(!isset($_FILES['postPicture_picture']['tmp_name'])) {
            echo '<p> no picture </p>';
            return;
        }
        foreach($_FILES['postPicture_picture']['tmp_name'] as $image){
            ?>
                <img src="data:image/*;base64,<?=base64_encode(file_get_contents($image))?>"><br>
            <?php
        }
    }
    
?>

