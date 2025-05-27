<?php
    include_once __DIR__."/library.php";

    


    class HEADER{

        //variable for populating the page
        public $user_profilePic;

        //frequently used
        private $dbh;

        function __construct($forum_id,$user_id){
            
            $this->dbh = getPDO();
            // LEFT(`profilePic`, 256)

            
            //get user info
            $selectUser = $this->dbh->prepare('
                SELECT (profilePic) FROM `user_t`
                WHERE id = :user_id
            ');
            $selectUser->bindValue(':user_id',$user_id);
            $selectUser->bindColumn('profilePic', $this->user_profilePic);
            $selectUser->execute();
            $selectUser->fetch();
            //-------------------if null
            
        }
        
        //search function here

    };
    

    //start of code, mostlikely in the actuall php file
    session_start();
    $_SESSION['uid'] = 1;
    $forum_id = '1';
    $user_id = $_SESSION['uid'];
    $forum = new FORUM($forum_id,$user_id);


    
   
    

    

?>


<p></p>
<br>


<p></p>
<br>