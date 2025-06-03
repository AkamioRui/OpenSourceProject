<?php
    include_once __DIR__."/../../module/SQL_on_PHP/HEADER.php";


    
    /* test */$_SESSION['uid'] = -1;
    $accountpopup = new ACCOUNTPOPUP();
    
    ACCOUNTPOPUP_TEST($accountpopup);
        

//------------------------library-------------------------------------//

    function ACCOUNTPOPUP_TEST(ACCOUNTPOPUP $accountpopup){

        ?>
            <p>user_createdAt =<?=$accountpopup->user_createdAt?></p>
            <p>user_profilePic =<?=$accountpopup->user_profilePic?'yes':'no'?></p>
            <img style="width:200px" src="<?=$accountpopup->user_profilePic?>">
            <p>user_username =<?=$accountpopup->user_username?></p>
            <p>user_email =<?=$accountpopup->user_email?></p>
            <p>user_admin =<?=$accountpopup->user_admin?></p>
            <p>uid =<?=$_SESSION['uid']?></p>
            <button onclick="say()">say hello</button>
            
            <hr>

        <?php
        ;
            // mm/dd/yyyy
    }

    class ACCOUNTPOPUP{

        //variable for populating the page
        public $user_createdAt;//$_SESSION['uid']
        public $user_profilePic;
        public $user_username;
        public $user_email;
        public $user_admin;

        //redirect fetch requirement
        // redirect_Back();
        // fetch_LoginPopup(); 
        // change_profilePic();
        // logout();

        //frequently used variable
        private $dbh;
        private $user_valid;

        function __construct(){
            

            $this->dbh = getPDO();
            
            $selectUser = $this->dbh->prepare('
                SELECT *
                FROM `user_t`
                WHERE `id` = :user_id
            ');
            $selectUser->bindParam(':user_id', $_SESSION['uid']);
            $selectUser->bindColumn('createdAt', $this->user_createdAt);
            $selectUser->bindColumn('profilePic', $this->user_profilePic);
            $selectUser->bindColumn('username', $this->user_username);
            $selectUser->bindColumn('email', $this->user_email);
            $selectUser->bindColumn('admin', $this->user_admin);
            $selectUser->execute();
            $this->user_valid = $selectUser->fetch()?true:false;


            if(!$this->user_valid){
                $data = json_decode(file_get_contents(__DIR__.'\..\..\databaseConfig.json'));
                $this->user_createdAt = $data->defaultUser->createdAt;//already formated
                $this->user_profilePic = file_get_contents(__DIR__.'/../../module/SQL_on_PHP/'.$data->defaultUser->profilePic);
                $this->user_username = $data->defaultUser->username;
                $this->user_email = $data->defaultUser->email;
                $this->user_admin = 0;
            }
            
            $this->preprocess();
        }

        private function preprocess(){
            $this->user_profilePic = 'data:image/*;base64,'.base64_encode($this->user_profilePic);
            
            if($this->user_valid){
                $this->user_createdAt = date('m/d/Y',strtotime($this->user_createdAt));    
            } 
            
        }

    };
 

?>







