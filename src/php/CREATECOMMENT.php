<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";

    $createpost = new CREATECOMMENT($_POST['postId'], $_POST['parentId']);
    $createpost->generate_CREATECOMMENT();

    class CREATECOMMENT{
        public $postId;
        public $parentId;

        function __construct($postId, $parentId){
            $this->$postId = $postId;
            $this->$parentId = $parentId;
        }
        
        function generate_CREATECOMMENT(){
            /* temp */$page = file_get_contents(__DIR__.'\CREATECOMMENT_form.html');
            foreach(get_object_vars($this) as $var => $value){
                $page = preg_replace('/\$'.$var.'/',$value,$page);
            }
            echo $page;        
        }
    }
   
?>