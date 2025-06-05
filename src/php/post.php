<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";

    
    
    // /* test */$_GET['post_id'] = 1;
    if(!isset($_GET['post_id'])) {echo 'undefined post_id';return;}
    $postpage = new POSTPAGE($_GET['post_id']);
    
    $postpage->generatePage(__DIR__.'/../views/post.html');
    


    class POSTPAGE{

        //variable for populating the page
        public $post_title;//$_GET['post_id']
        public $post_creatorName;
        public $post_like;
        public $post_createdAt;
        public $post_contents;

        public $postPicture_picture;//$_GET['post_id']

        public $comment_comment;//$_GET['post_id']
        public $comment_like; 
        public $user_profilePic;
        public $user_username;
        
        public $UserCommentList;//rendering -> list of id and parent id
        public $comment_id;//rendering
        
        //redirect fetch requirement
        // redirect_Back();
            public $forum_id;
        // fetch_accountPopup();//session uid
        // fetch_CreateComment();
            public $post_id;
            //public $comment_id;//as parent Id
        
            
            
        
        //frequently used variable
        private $selectUserComment;
        private $dbh;
        public $post_valid;
        
        

        function __construct($post_id){
            $this->post_id = $post_id;

            $this->dbh = getPDO();
            
            $selectPost = $this->dbh->prepare('
                SELECT *,
                (SELECT `username` FROM `user_t` WHERE `user_t`.`id` = `post_t`.`creatorId`) as `creatorName`
                FROM `post_t`
                WHERE `id` = :post_id
            ');
            $selectPost->bindParam(':post_id', $post_id);
            $selectPost->bindColumn('title', $this->post_title);
            $selectPost->bindColumn('creatorName', $this->post_creatorName);
            $selectPost->bindColumn('like', $this->post_like);
            $selectPost->bindColumn('createdAt', $this->post_createdAt);
            $selectPost->bindColumn('contents', $this->post_contents);
            $selectPost->bindColumn('forumId', $this->forum_id);
            $selectPost->execute();
            $this->post_valid = $selectPost->fetch()?true:false;
            if($this->post_valid){
                $this->post_createdAt = date('m/d/Y',strtotime($this->post_createdAt));
            }
            
            

            $selectPostPicture = $this->dbh->prepare('
                SELECT `picture`
                FROM `postPicture_t`
                WHERE `postId` = :post_id
            ');
            $selectPostPicture->setFetchMode(PDO::FETCH_COLUMN,0);
            $selectPostPicture->bindParam(':post_id', $this->post_id);
            $selectPostPicture->execute();
            $this->postPicture_picture = $selectPostPicture->fetchAll();
            if($this->postPicture_picture){
                foreach($this->postPicture_picture as &$rawimg){
                    $rawimg = 'data:image/*;base64,'.base64_encode($rawimg);
                }
                unset($rawimg);
            }



            $this->selectUserComment = $this->dbh->prepare('
                SELECT 
                    C.`comment` as `comment_comment` ,
                    C.`like` as `comment_like` ,
                    U.`profilePic` as `user_profilePic` ,
                    U.`username` as `user_username` 
                FROM `comment_t` AS C
                INNER JOIN `user_t` AS U
                ON C.`creatorId` = U.`id`
                WHERE C.`id` = :comment_id
            ');
            $this->selectUserComment->bindParam(':comment_id', $this->comment_id);
            $this->selectUserComment->bindColumn('comment_comment', $this->comment_comment);
            $this->selectUserComment->bindColumn('comment_like', $this->comment_like);
            $this->selectUserComment->bindColumn('user_profilePic', $this->user_profilePic);
            $this->selectUserComment->bindColumn('user_username', $this->user_username);
            $this->selectUserComment->execute();

                
            

            $selectUserComment = $this->dbh->prepare('
                SELECT 
                    parentId,
                    id
                FROM `comment_t`
                WHERE postId = :post_id
            ');
            $selectUserComment->setFetchMode(PDO::FETCH_ASSOC);
            $selectUserComment->bindValue(':post_id', $this->post_id);
            $selectUserComment->execute();
            $this->UserCommentList = $selectUserComment->fetchAll();

            
        }

        

        function getComment($comment_id){
            $this->comment_id = $comment_id;
            $this->selectUserComment->execute();
            $this->selectUserComment->fetch();
                $this->user_profilePic = 'data:image/*;base64,'.base64_encode($this->user_profilePic);
            
        }
        
        function generatePage($HTMLpath){
            if(!$this->post_valid){echo 'post doesnt exist'; return;}

            $raw = file_get_contents($HTMLpath);

            list(
                $template_beforecomment,
                $template_comment,//never used, comment is hardcoded
                $template_aftercomment
            ) = extractfrom($raw,'<ul class="comment-list">','ul');
            
        
            //template_beforecomment
            foreach(get_object_vars($this) as $key => $value){
                
                try{ 
                    if(is_array($value) ){
                        if($value)$template_beforecomment = preg_replace('/\$'.$key.'/',$value[0],$template_beforecomment);
                        else $template_beforecomment = preg_replace(
                            '/<[^>]*class="post-img"[^>]*>/',
                            '',
                            $template_beforecomment
                        );
                    } else {

                        $template_beforecomment = preg_replace('/\$'.$key.'/',$value==NULL?'':$value,$template_beforecomment);
                    }
                    
                    
                }catch( Error $e ){}
            }
            echo $template_beforecomment;

            //template_post
            echo '<ul class="comment-list">';
            $this->COMMENT_print();
            echo '</ul>';

            //template_aftercomment
            foreach(get_object_vars($this) as $key => $value){
                try{ $template_aftercomment = preg_replace('/\$'.$key.'/',$value?:'',$template_aftercomment);
                }catch( Error $e ){}
            }
            echo $template_aftercomment;
            
        }


        function COMMENT_print_head($stackNotEmpty){
            if($stackNotEmpty){
                echo'
            <li class="comment reply">
                ';
            } else {
                echo '
            <li class="comment">
                ';
            }

            echo'
                <img
                    src="'.$this->user_profilePic.'"
                    alt=""
                    class="comment-avatar"
                />
                <div class="comment-content">
                    <h3 class="comment-author">'.$this->user_username.'</h3>
                    <div class="text-container">
                        <p class="comment-text">'.$this->comment_comment.'
                        </p>

                        <div class="comment-like">
                            <img src="/src/assets/heart.png" alt="like" />
                            <span>'.$this->comment_like.'Likes</span>
                        </div>
                    </div>
                    <button class="comment-reply" onclick="fetch_CreateComment('.$this->post_id.', '.$this->comment_id.')" >Reply</button>
                    <ul class="comment-replies">';
        }
        function COMMENT_print_foot(){
                    echo '
                    </ul>
                </div>
            </li>';
        }
        function COMMENT_print(){

            $directGraph = array();
            foreach($this->UserCommentList as $line){
                //$line['parentId'];
                //$line['id'];
    
                $directGraph[$line['id']] = array() ;
                if($line['parentId'] != NULL){
                    $directGraph[$line['parentId']][] = $line['id'];
                }
            }
    
            
    
            //create status array for depth first search taversal
            $status = $directGraph;
            foreach($status as &$val){
                $val =0;
                //0 unvisited
                //1 checked
                //-1 done
            }
    
            //depth first search traversal
            foreach($directGraph as $root => $var){
                if($status[$root]==-1)continue;
                $next = $root;
                $stack = array();
                do{
                    
                    $current = $next;
                    if($status[$current] == 0){//if current node is visited first time
                        $this->getComment($current);                        
                        $this->COMMENT_print_head(!empty($stack));
                            
                        // <button class="comment-reply" onclick="fetch_CreateComment('.$this->post_id.', '.$this->comment_id.')>Reply</button>
                    
                    }    
                    
                    if(empty($directGraph[$current])){// no neighbor
                        $status[$current] = -1;
                        $next = array_pop($stack);
                        $this->COMMENT_print_foot();
                 
                        
                                           
                    } else {//still have neighbor
                        $next = array_shift($directGraph[$current]);
                        $status[$current] = 1;
                        $stack[] = $current;
                        
                    }
                    

                }while($next != NULL);
                
            }
    
    
            
        }
    };
 

?>

<!-- ----------------------testing-------------------------------- -->


<?php
    //POSTPAGE_TEST($postpage);



    function POSTPAGE_TEST(POSTPAGE $postpage){
        if(! $postpage->post_valid) echo'no post';

        ?>
            <p>post_title =<?=$postpage->post_title?></p>
            <p>post_creatorName =<?=$postpage->post_creatorName?></p>
            <p>post_like =<?=$postpage->post_like?></p>
            <p>post_createdAt =<?=$postpage->post_createdAt?></p>
            <p>post_contents =<?=$postpage->post_contents?></p>
            <p>$postPicture_picture =<?=!$postpage->postPicture_picture?'no image':sizeof($postpage->postPicture_picture).'image';?></p>
            <?php 
                foreach($postpage->postPicture_picture as $image){
                    ?>
                    <img src="<?=$image?>">
                    <?php
                }
            
            ?>
            <hr>

        <?php

        /* while($postpage->UserComment_valid){
            ?>
                <div class="commentBody" style='--id=<?=$postpage->post_id?>'>
                    <p>user_username =<?= $postpage->user_username?></p>
                    <img style="width:200px" src="data:image/*;base64,<?=base64_encode($postpage->user_profilePic)?>">
                    <p>comment_comment = <?=$postpage->comment_comment?></p>
                    <p>comment_like :<?=$postpage->comment_like?></p>
                    <p>this post_id = <?=$postpage->post_id?>, parentId = <?=$postpage->comment_parentId?:0?></p>
                </div>
                <div class="commentChild" style="padding-left: 30px;">
                </div>
            <?php
            $postpage->nextComment();
        } */
        COMMENT_print($postpage);


    }

    function COMMENT_print(POSTPAGE $postpage){

        $directGraph = array();
        foreach($postpage->UserCommentList as $line){
            //$line['parentId'];
            //$line['id'];

            $directGraph[$line['id']] = array() ;
            if($line['parentId'] != NULL){
                $directGraph[$line['parentId']][] = $line['id'];
            }
        }

        

        //create status array for depth first search taversal
        $status = $directGraph;
        foreach($status as &$val){
            $val =0;
            //0 unvisited
            //1 checked
            //-1 done
        }

        //depth first search traversal
        foreach($directGraph as $root => $var){
            if($status[$root]==-1)continue;
            $next = $root;
            $stack = array();
            do{
                
                $current = $next;
                if($status[$current] == 0){
                    $postpage->getComment($current);
                    echo '
                        <hr>
                        <div class="commentBody">
                            <p>user_username ='. $postpage->user_username.'</p>
                            <img style="width:200px" src="'.$postpage->user_profilePic.'">
                            <p>comment_comment = '.$postpage->comment_comment.'</p>
                            <p>comment_like :'.$postpage->comment_like.'</p>
                            <p>this post_id = '.$postpage->post_id.', parentId = '.$postpage->comment_id .'</p>
                        </div>
                        <div class="commentChild" style="padding-left: 30px;">   
                    ';
                }
                    
                
                if(empty($directGraph[$current])){
                    $status[$current] = -1;
                    $next = array_pop($stack);
                    echo '</div><hr>
                    ';
                } else {
                    $next = array_shift($directGraph[$current]);
                    $status[$current] = 1;
                    $stack[] = $current;
                    
                }
            }while($next != NULL);
            
        }


        
    }
    
?>



