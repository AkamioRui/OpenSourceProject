<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";
    
    $createpost = new CREATEPOST($_POST['forum_id']);
    $createpost->generate_CREATEPOST(__DIR__.'/../views/write/writepost.html');

    class CREATEPOST{
        public $forum_id;

        function __construct($forum_id){
            $this->forum_id = $forum_id;
        }

        function generate_CREATEPOST(){
            $page = file_get_contents(__DIR__.'\CREATEPOST_form.html');
            foreach(get_object_vars($this) as $var => $value){
                $page = preg_replace('/\$'.$var.'/',$value,$page);
            }

            if($_SESSION['uid'] == -1) preg_replace('(<[^<>]*id="sign-up">[^<>]*)([^<>]*)(<[^<>]*>)','',$page);

            echo $page;        
        }
    }

    
      
    
?>

