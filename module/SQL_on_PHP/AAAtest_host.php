<?php
    include_once __DIR__."/HEADER.php";

    

    /* 
        DEPENDENCY
        
        HOMEPAGE        = ACCOUNTPOPUP + FORUMPAGE + POSTPAGE + CREATEFORUM
        FORUMPAGE       = ACCOUNTPOPUP + POSTPAGE + CREATEPOST + $_GET['forum_id']
        POSTPAGE        = ACCOUNTPOPUP + CREATECOMMENT + $_GET['post_id']
        ACCOUNTPOPUP    = LOGINPOPUP
        LOGINPOPUP      = SIGNUPOPUP
        SIGNUPPOPUP     = LOGINPOPUP
        CREATEFORUM     =
        CREATEPOST      = $_POST['forumId']
        CREATECOMMENT   = $_POST['postId'] + $_POST['parentId']

        HOMEPAGE        = NULL
        FORUMPAGE       = $_GET['forum_id']
        POSTPAGE        = $_GET['post_id']
        ACCOUNTPOPUP    = LOGINPOPUP = SIGNUPOPUP = NULL
        CREATEFORUM     =
        CREATEPOST      = $_POST['forumId']
        CREATECOMMENT   = $_POST['postId'] + $_POST['parentId']
    
    
    */
    echo file_get_contents('AAA.html');
?>

