<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";

    
    ///* test */$_SESSION['uid'] = 1;
    $homepage = new HOMEPAGE();
    


    class HOMEPAGE{

        //variable for populating the page
        public $forum_name;
        public $forum_postCount; //custom
        public $forum_icon;
        public $forum_descriptions;

        public $post_title; 
        public $post_contents;    
        

        //redirect fetch requirement
        //accountPopup
            // public $_SESSION['uid'];
        //forumpage
            public $forum_id; 
        //postpage
            public $post_id;
        //createforum
        
        //frequently used variable
        private $selectForum;
        private $selectPost;
        private $dbh;
        public $post_valid;
        public $forum_valid;

        function __construct(){
            
            $this->dbh = getPDO();
            // LEFT(`profilePic`, 256)

            
            //get forum info
            $this->selectForum = $this->dbh->prepare('
                SELECT *,(
                    SELECT COUNT(forumId) 
                    FROM post_t
                    WHERE post_t.forumId = forum_t.id
                ) as postCount
                FROM `forum_t`
                ORDER BY id DESC
            ');
            $this->selectForum->bindColumn('name', $this->forum_name);
            $this->selectForum->bindColumn('postCount', $this->forum_postCount);
            $this->selectForum->bindColumn('icon', $this->forum_icon);
            $this->selectForum->bindColumn('descriptions', $this->forum_descriptions);
            $this->selectForum->bindColumn('id', $this->forum_id);
            $this->selectForum->execute();
            $this->forum_valid = $this->selectForum->fetch()?true:false;
            
            

            //select Post
            $this->selectPost = $this->dbh->prepare('
                SELECT * 
                FROM `post_t`
                WHERE forumId = :forum_id
                ORDER BY `id` DESC
            ');
            $this->selectPost->bindParam(':forum_id', $this->forum_id);
            $this->selectPost->bindColumn('title', $this->post_title);
            $this->selectPost->bindColumn('contents', $this->post_contents);
            $this->selectPost->bindColumn('id', $this->post_id);
            $this->selectPost->execute();
            $this->post_valid = $this->selectPost->fetch()?true:false;

            $this->preprocess();
        
        }

        function preprocess(){
            if($this->forum_valid){
                $this->forum_icon = 'data:image/*;base64,'.base64_encode($this->forum_icon);
            }
        }
        function nextPost(){
            $this->post_valid = $this->selectPost->fetch()?true:false;
            $this->preprocess();
        }
        function nextForum(){
            $this->forum_valid = $this->selectForum->fetch()?true:false;
            $this->selectPost->execute();
            $this->post_valid = $this->selectPost->fetch()?true:false;
            $this->preprocess();
        }
        

    };
 

?>

<!-- ----------------------testing-------------------------------- -->

<!-- profile picture -->

<?php
    HOMEPAGE_TEST($homepage);
    function HOMEPAGE_TEST($homepage){
        while($homepage->forum_valid){
            ?>
                <div style="background-color: greenyellow;--forumId='<?=$homepage->forum_id?>'">
                    <p>name = <?=$homepage->forum_name?></p>
                    <p>postCount = <?=$homepage->forum_postCount?></p>
                    <p>icon =</p>
                        <img style="width:200px" src="<?=($homepage->forum_icon)?>">    
                    <p>descriptions = <?=$homepage->forum_descriptions?></p>
                    
                    
                    
                    
                    <?php
                        while($homepage->post_valid){
                            ?>
                                <div style="background-color: aqua;--postId='<?=$homepage->post_id?>'">
                                    <p>title = <?=$homepage->post_title?></p>
                                    <p>contents = <?=$homepage->post_contents?></p>
                                </div>
                                <hr>
                            <?php
                            $homepage->nextPost();
                        }
                    ?>
                    
                </div>
                <hr>
    
            <?php
            $homepage->nextForum();
        }
    }
    
?>



