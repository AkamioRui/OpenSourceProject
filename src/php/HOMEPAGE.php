<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";

    
    ///* test */$_SESSION['uid'] = 1;
    $homepage = new HOMEPAGE();
    $homepage->generatePage(__DIR__.'/../views/homepage.html');
    

    class HOMEPAGE{

        //variable for populating the page
        public $forum_name;
        public $forum_postCount; //custom
        public $forum_icon;
        public $forum_descriptions;
        public $forum_contributor;

        public $post_title; 
        public $post_contents;    
        public $post_creator;  /* post_username */  
        

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
                SELECT *,
                (
                    SELECT COUNT(`post_t`.`forumId`) 
                    FROM `post_t`
                    WHERE `post_t`.`forumId` = `forum_t`.`id`
                ) as `postCount`,
                (
                    SELECT `user_t`.`username` 
                    FROM `user_t` 
                    WHERE `user_t`.`id` = `forum_t`.`creatorId` 
                ) as `contributor`
                FROM `forum_t`
                ORDER BY `id` DESC
            ');
            $this->selectForum->bindColumn('name', $this->forum_name);
            $this->selectForum->bindColumn('postCount', $this->forum_postCount);
            $this->selectForum->bindColumn('icon', $this->forum_icon);
            $this->selectForum->bindColumn('descriptions', $this->forum_descriptions);
            $this->selectForum->bindColumn('contributor', $this->forum_contributor);
            $this->selectForum->bindColumn('id', $this->forum_id);
            $this->selectForum->execute();
            $this->forum_valid = $this->selectForum->fetch()?true:false;
            
            

            //select Post
            $this->selectPost = $this->dbh->prepare('
                SELECT *,
                (
                    SELECT `user_t`.`username` 
                    FROM `user_t` 
                    WHERE `user_t`.`id` = `post_t`.`creatorId`
                ) AS `post_creator`
                FROM `post_t`
                WHERE `forumId` = :forum_id
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
        
        function generatePage($HTMLpath){
            $raw = file_get_contents($HTMLpath);
            //card-container = forum
            //card-content = post
            list($template_beforeforum,$template_forum,$template_afterforum) = extractfrom($raw,'<[^>]*repeat[^>]*>','div');
            $template_forum = preg_replace('/repeat/','',$template_forum,1);
            list($template_beforepost,$template_post,$template_afterpost) = extractfrom($template_forum,'<[^>]*repeat[^>]*>','div');
            $template_post = preg_replace('/repeat/','',$template_post,1);

            //$template_beforeforum
            foreach(get_object_vars($this) as $key => $value){
                try{ $template_beforeforum = preg_replace('/\$'.$key.'/',$value?:'',$template_beforeforum);
                }catch( Error $e ){}
            }
            echo $template_beforeforum;

            while($this->forum_valid){
                $beforepost = $template_beforepost;
                
                $afterpost = $template_afterpost;
                
                foreach(get_object_vars($this) as $key => $value){
                    try{ $beforepost = preg_replace('/\$'.$key.'/',$value?:'',$beforepost);
                    }catch( Error $e ){}
                }
                echo $beforepost;
                
                // //post
                while($this->post_valid){
                    $post = $template_post;
                    
                    
                    foreach(get_object_vars($this) as $key => $value){
                        try{ $post = preg_replace('/\$'.$key.'/',$value?:'',$post);
                        }catch( Error $e ){}
                    }
                    echo $post;
                    
                    $this->nextPost();                
                }

                foreach(get_object_vars($this) as $key => $value){
                    try{ $afterpost = preg_replace('/\$'.$key.'/',$value?:'',$afterpost);
                    }catch( Error $e ){}
                }
                echo $afterpost;

                
                
                $this->nextForum();                
            }
            
            //template_afterforum
            foreach(get_object_vars($this) as $key => $value){
                try{ $template_afterforum = preg_replace('/\$'.$key.'/',$value?:'',$template_afterforum);
                }catch( Error $e ){}
            }
            echo $template_afterforum;
        }

    };
 

?>

<!-- ----------------------testing-------------------------------- -->

<!-- profile picture -->

<?php
    



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



