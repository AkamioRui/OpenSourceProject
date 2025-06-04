<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";

    /* test */$_POST['postId'] = 1;
    /* test */$_POST['parentId'] = 0;
    if(!isset($_POST['postId'])) echo '<p>undefined postId</p>';
    if(!isset($_POST['parentId'])) echo '<p>undefined parentId</p>';
    if(!isset($_POST['parentId']) && !isset($_POST['postId']))  return;;
    $createpost = new CREATECOMMENT($_POST['postId'], $_POST['parentId']);
    $createpost->generatePage(__DIR__.'\..\views\write\commentbar.html');

    class CREATECOMMENT{
        public $postId;
        public $parentId;

        function __construct($postId, $parentId){
            $this->postId = $postId;
            $this->parentId = $parentId;
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