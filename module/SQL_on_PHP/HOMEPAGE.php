<?php
    include_once __DIR__."/HEADER.php";

    class FORUM{

        //variable for populating the page
        public $user_profilePic;

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
        public $post_empty;

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
            $selectForum->fetch();
            
            

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
            $this->post_empty = empty($this->selectPost->fetch());
            

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
            $this->post_empty = empty($this->selectPost->fetch());
            $this->selectPostPicture->execute();
            $this->postPicture_pictures = $this->selectPostPicture->fetchAll();

        }
        

    };
 

?>

<?php
    //start of code, mostlikely in the actuall php file
    session_start();
    $_SESSION['uid'] = 1;
    $forum_id = '1';
    $forum = new FORUM($forum_id);
    $header= new HEADER($_SESSION['uid']);

?>

<!-- <img style="width:100px" src="Forumpage.png" > -->
<p>user_profilePic = </p>
    <img style="width:200px" src="data:image/*;base64,<?=$header->user_profilePic?>">
<?php
    $_SESSION['uid'] = 2;
    $header->updateProfile();
?>
    <img style="width:200px" src="data:image/*;base64,<?=$header->user_profilePic?>">
<?php
    $_SESSION['uid'] = 3;
    $header->updateProfile();
?>
    <img style="width:200px" src="data:image/*;base64,<?=$header->user_profilePic?>">
<br>

<p>forum_name = <?=$forum->forum_name?></p>
<p>forum_banner = </p>
    <img style="width:200px" src="data:image/*;base64,<?=$forum->forum_banner?>">
<p>forum_icon =</p>
    <img style="width:200px"src="data:image/*;base64,<?=$forum->forum_icon?>" src="">
<p>forum_createdAt = <?=$forum->forum_createdAt?></p>
<p>forum_descriptions = <?=$forum->forum_descriptions?></p>
<p>forum_creator_name = <?=$forum->forum_creator_name?></p>


<p>post_createdAt = <?=$forum->post_createdAt?></p>
<p>post_contents = <?=$forum->post_contents?></p>
<p>post_title = <?=$forum->post_title?></p>
<p>post_like = <?=$forum->post_like?></p>
<br>

<?php

    if(!$forum->postPicture_pictures ) echo 'no image';
    else {
        foreach($forum->postPicture_pictures as $image){
            ?>
            <img style="width:200" src="data:image/*;base64,<?=$image?>">
            <?php

        }
    }
?>
<h1>NEXT POST</h1>
<?php
    $forum->nextPost();
?>
<p>post_createdAt = <?=$forum->post_createdAt?></p>
<p>post_contents = <?=$forum->post_contents?></p>
<p>post_title = <?=$forum->post_title?></p>
<p>post_like = <?=$forum->post_like?></p>
<br>

<?php

    if(!$forum->postPicture_pictures ) echo 'no image';
    else {
        foreach($forum->postPicture_pictures as $image){
            ?>
            <img style="width:200" src="data:image/*;base64,<?=$image?>">
            <?php

        }
    }
?>
<br>

<?php
    $forum->nextPost();
?>
<p>post_empty = <?=empty($forum->post_empty)?'yes':'no'?></p>
<p>post_title = <?=$forum->post_title?></p>
<?php
    $forum->nextPost();
?>
    <p>post_empty = <?=empty($forum->post_empty)?'yes':'no'?></p>
    <p>post_title = <?=$forum->post_title?></p>
<?php
    $forum->nextPost();
?>
    <p>post_empty = <?=empty($forum->post_empty)?'yes':'no'?></p>
    <p>post_title = <?=$forum->post_title?></p>
<?php
    $forum->nextPost();
?>
    <p>post_empty = <?=empty($forum->post_empty)?'yes':'no'?></p>
    <p>post_title = <?=$forum->post_title?></p>

<p></p>
<br>


<p></p>
<br> 