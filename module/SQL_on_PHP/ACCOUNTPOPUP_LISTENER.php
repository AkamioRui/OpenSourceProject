<?php
    include_once __DIR__."/HEADER.php";
    ///* test */$_SESSION['uid'] = 2;
    
    if(isset($_POST['change_profilePic']))change_profilePic($_FILES['user_profilePic']['tmp_name']);
    if(isset($_POST['logout']))logout();


//-----------------library-----------------------------------------------------------//
    function change_profilePic($imagePath){
        $image = file_get_contents($imagePath);


        $dbh = getPDO();
        $insertUser = $dbh->prepare('
            UPDATE user_t
            SET profilePic = :user_profilePic
            WHERE id = :user_id
        ');
        $insertUser->bindValue(':user_profilePic',$image);
        $insertUser->bindValue(':user_id',$_SESSION['uid']);
        $insertUser->execute();
        
         echo '<body style="--code:success">data:image/*;base64,'.base64_encode($image).'</body>';
        
        
 
            
    }
    function logout(){
        $_SESSION['uid'] = -1; 
        ob_start();
        include_once __DIR__.'\ACCOUNTPOPUP.php';
        $page = ob_get_clean();
        
    }


?>




