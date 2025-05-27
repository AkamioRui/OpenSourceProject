<?php
    include_once __DIR__."/library.php";

    


    class FORUM{
        //variable for populating the page
        public $user_profilePic;

        public $forum_name;
        public $forum_banner;
        public $forum_icon;
        public $forum_createdAt;
        public $forum_descriptions;
        public $forum_creator_name;

        public $post_createdAt;
        public $post_title;
        public $post_contents;
        public $post_like;

        public $post_images;
        
        //frequently used variable
        private $selectPost;
        private $dbh;

        function __constructor($forum_id,$user_id){
            $this->$dbh = getPDO();
            // LEFT(`profilePic`, 256)

            
            //get user info
            $selectUser = $this->$dbh->prepare('
                SELECT (profilePic) FROM `user_t`
                WHERE id = :user_id
            ');
            $selectUser->bindValue(':user_id',$user_id);
            $selectUser->bindColumn('profilePic', $this->$user_profilePic);
            $selectUser->execute();
            $selectUser->fetch();
            //-------------------if null
            
            //get forum info
            $selectForum = $this->$dbh->prepare('
                SELECT *,(SELECT username FROM `user_t` WHERE `user_t`.`id` = `forum_t`.`creatorId`) as creator_name 
                FROM `forum_t`
                WHERE id = :forum_id
            ');
            $selectForum->bindValue(':forum_id', $forum_id);
            $selectForum->bindColumn('name', $this->$forum_name);
            $selectForum->bindColumn('banner', $this->$forum_banner);
            $selectForum->bindColumn('icon', $this->$forum_icon);
            $selectForum->bindColumn('createdAt', $this->$forum_createdAt);
            $selectForum->bindColumn('descriptions', $this->$forum_descriptions);
            $selectForum->bindColumn('creator_name', $this->$forum_creator_name);
            $selectForum->execute();
            $selectForum->fetch();
            
            

            //select Post
            $this->$selectPost = $this->$dbh->prepare('
                SELECT * FROM `post_t`
                WHERE forumId = :forum_id
                ORDER BY `id` DESC
            ');
            $this->$selectPost->bindValue(':forum_id', $forum_id);
            $this->$selectPost->bindColumn('createdAt', $this->$post_createdAt);
            $this->$selectPost->bindColumn('title', $this->$post_title);
            $this->$selectPost->bindColumn('contents', $this->$post_contents);
            $this->$selectPost->bindColumn('like', $this->$post_like);
            $this->$selectPost->execute();
            $this->$selectPost->fetch();

            //
            $this->$selectPost = $this->$dbh->prepare('
                SELECT * FROM `postPicture_t`
                WHERE forumId = :forum_id
                ORDER BY `id` DESC
            ');
            $this->$selectPost->bindValue(':forum_id', $forum_id);
            $this->$selectPost->bindColumn('createdAt', $this->$post_createdAt);
            $this->$selectPost->bindColumn('title', $this->$post_title);
            $this->$selectPost->bindColumn('contents', $this->$post_contents);
            $this->$selectPost->bindColumn('like', $this->$post_like);
            $this->$selectPost->execute();
            $this->$selectPost->fetch();


        }

        private function getForumOnce($forum_id){
            

        }
        function getPost(){
    
        }

    };
    

    session_start();
    $uid = isset($_SESSION['uid'])? $_SESSION['uid']: -1;
   
    $dbh = $dbh ?? getPDO();

    

?>