<?php
    include_once __DIR__."/HEADER.php";

    
    ///* test */$_SESSION['uid'] = 1;
    /* test */$_GET['forum_id'] = 1;
    if(!isset($_GET['forum_id'])) {
        /* temp */echo 'invalid forum';
        return;
    }
    $forum = new FORUM($_GET['forum_id']);
    


    class FORUM{

        //variable for populating the page

        public $forum_name;
        public $forum_banner;
        public $forum_icon;
        public $forum_createdAt;
        public $forum_descriptions;
        public $forum_creator_name;//from user_t

        private $post_id;//for post_images
        public $post_createdAt;
        public $post_title;
        public $post_contents;
        public $post_like;
        

        public $postPicture_pictures;//return false when empty//need to be encoded to base64
        
        //frequently used variable
        private $selectPost;
        private $selectPostPicture;
        private $dbh;
        public $post_valid;
        public $forum_valid;

        function __construct($forum_id){
            
            $this->dbh = getPDO();
            // LEFT(`profilePic`, 256)

            
            //get forum info
            $selectForum = $this->dbh->prepare('
                SELECT *,(
                    SELECT username FROM `user_t` WHERE `user_t`.`id` = `forum_t`.`creatorId`
                    ) as creator_name 
                FROM `forum_t`
                WHERE id = :forum_id
            ');
            $selectForum->bindValue(':forum_id', $forum_id);
            $selectForum->bindColumn('name', $this->forum_name);
            $selectForum->bindColumn('banner', $this->forum_banner);
            $selectForum->bindColumn('icon', $this->forum_icon);
            $selectForum->bindColumn('createdAt', $this->forum_createdAt);
            $selectForum->bindColumn('descriptions', $this->forum_descriptions);
            $selectForum->bindColumn('creator_name', $this->forum_creator_name);
            $selectForum->execute();
            $this->forum_valid = $selectForum->fetch()?true:false;
            
            

            //select Post
            $this->selectPost = $this->dbh->prepare('
                SELECT * FROM `post_t`
                WHERE forumId = :forum_id
                ORDER BY `id` DESC
            ');
            $this->selectPost->bindValue(':forum_id', $forum_id);
            $this->selectPost->bindColumn('id', $this->post_id);
            $this->selectPost->bindColumn('createdAt', $this->post_createdAt);
            $this->selectPost->bindColumn('title', $this->post_title);
            $this->selectPost->bindColumn('contents', $this->post_contents);
            $this->selectPost->bindColumn('like', $this->post_like);
            $this->selectPost->execute();
            $this->post_valid = $this->selectPost->fetch()?true:false;
            

            //get post images
            $this->selectPostPicture = $this->dbh->prepare('
                SELECT picture FROM `postPicture_t`
                WHERE postId = :postId
            ');
            $this->selectPostPicture->setFetchMode(PDO::FETCH_COLUMN,0);
            $this->selectPostPicture->bindParam(':postId',$this->post_id);
            $this->selectPostPicture->execute();
            $this->postPicture_pictures = $this->selectPostPicture->fetchAll();

        }

        function nextPost(){
            $this->post_valid = $this->selectPost->fetch()?true:false;
            $this->selectPostPicture->execute();
            $this->postPicture_pictures = $this->selectPostPicture->fetchAll();

        }
        

    };
 

?>

<!-- ----------------------testing-------------------------------- -->

<!-- profile picture -->

<p>user_profilePic = </p>
<?php
    $original = $_SESSION['uid']; 
    $_SESSION['uid'] = -1;
?>
    <img style="width:200px" src="<?=getProfilePic()?>">
<?php
    $_SESSION['uid'] = 1;
?>
    <img style="width:200px" src="<?=getProfilePic()?>">
<?php
    $_SESSION['uid'] = 2;
?>
    <img style="width:200px" src="<?=getProfilePic()?>">
<?php
    $_SESSION['uid'] = 3;
?>
    <img style="width:200px" src="<?=getProfilePic()?>">
<?php
$_SESSION['uid'] = 4;
?>
    <img style="width:200px" src="<?=getProfilePic()?>">
<?php
    $_SESSION['uid'] = $original ;
?>
<br>
<hr>

<!-- forum  -->
<p>forum_name = <?=$forum->forum_name?></p>
<p>forum_banner = </p>
    <img style="width:200px" src="data:image/*;base64,<?=base64_encode($forum->forum_banner)?>">
<p>forum_icon =</p>
    <img style="width:200px"src="data:image/*;base64,<?=base64_encode($forum->forum_icon)?>" src="">
<p>forum_createdAt = <?=$forum->forum_createdAt?></p>
<p>forum_descriptions = <?=$forum->forum_descriptions?></p>
<p>forum_creator_name = <?=$forum->forum_creator_name?></p>

<hr>

<!-- posts -->
<?php
    while($forum->post_valid){
        ?>
        <p>post_createdAt = <?=$forum->post_createdAt?></p>
        <p>post_contents = <?=$forum->post_contents?></p>
        <p>post_title = <?=$forum->post_title?></p>
        <p>post_like = <?=$forum->post_like?></p>
        <?php



        if(!$forum->postPicture_pictures ) echo 'no image';
        else {
            foreach($forum->postPicture_pictures as $image){
                ?>
                <img style="width:200" src="data:image/*;base64,<?=base64_encode($image)?>">
                <?php

            }
        }
        $forum->nextPost();

        echo '<br> <br>';
        

    }
    echo '<hr>';
?>
