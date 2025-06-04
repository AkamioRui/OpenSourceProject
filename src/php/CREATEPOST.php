<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";
    
    /* test */$_POST['forum_id'] = 1;
    if(!isset($_POST['forum_id'])) {echo 'undefined forumId'; return;}
    $createpost = new CREATEPOST($_POST['forum_id']);
    $createpost->generatePage(__DIR__.'/../views/write/writepost.html');

    class CREATEPOST{
        public $forum_id;

        function __construct($forum_id){
            $this->forum_id = $forum_id;
        }

        function generatePage($htmlPath){
            $page = file_get_contents($htmlPath);
            foreach(get_object_vars($this) as $var => $value){
                $page = preg_replace('/\$'.$var.'/',$value,$page);
            }

            echo $page;        
        }
    }

    
      
    
?>

