<?php

//js note
/* 
    1. when after fetching a popup, make sure to disable the button to fetch this popup again before it's closed (for example hiding it)
    2. the create popup will only be provided if the user is signin(uid != -1). 
    3. fetch return the code in 
        document.body.style.getPropertyValue('--code')
    4. AccountPopup and loginPopup must update the user profile picture
    5. fetch user profile picture by sending to GENERAL_LISTENER.php, method post, form body having 'user_profilePic' = '1' . it will return a string that can be immediatelly placed in src of <img>
    6. back button in popup closes the popup. for back button in normal page: post -> forum -> homepage
    7. accountPopup::changeprofile, 
*/

//description use: LEFT(`profilePic`, 256)


//HOMEPAGE, FORUMPAGE put cap on how long the content 


//homepage
    //src
        //$_SESSION['uid'];
    //variable
        //$user_profilePic; //$_SESSION['uid']

        /* many */$forum_name;
        /* many */ /* custom */$forum_postCount;
        /* many */$forum_icon;
        /* many */$forum_descriptions;
        /* many */$forum_id;/* arg */

        
        /* many */$post_title; 
        /* many */$post_contents;    
    //function
        // fetch_accountPopup();
        // redirect_ForumPage();// each forum in html must have forum_Id
        // redirect_PostPage();// each post in html must have post_id
        // fetch_CreateForum();
//forumpage
    //src
        //$_SESSION['uid'];
        $_GET['forum_id'];

    //variable
        //$user_profilePic; //$_SESSION['uid']

        $forum_name; //$_GET['forum_id']
        $forum_banner;
        $forum_icon;
        $forum_createdAt;
        $forum_descriptions;
        /* custom */$forum_creator_name;

        /* many */$post_title;
        /* many */$post_createdAt;//$_GET['forum_id']
        /* many */$post_contents;
        /* many */$post_like;
        /* many */$post_id;/* arg */ 


        /* many */$postPicture_pictures; //$post_id;
    //function
        // redirect_Back();
        // fetch_accountPopup();
        // redirect_PostPage();//in js, must know this postId
        // fetch_CreatePost();
//postpage
    //src
        //$_SESSION['uid'];
        $_GET['post_id'];
    //variable
        //$user_profilePic; //$_SESSION['uid']

        $post_title;//$_GET['post_id']
        /* custom */$post_creatorName;
        $post_like;
        $post_createdAt;
        $post_contents;

        /* many */$postPicture_picture;//$_GET['post_id']

        /* many */$user_profilePic;//$comment_creatorId
        /* many */$user_username;

        /* many */$comment_comment;//$_GET['post_id']
        /* many */$comment_like;
        /* many */$comment_parentId;/* arg */
        /* many */$comment_creatorId;/* arg */
    //function
        // redirect_Back();//must know the previous fullpage
        // fetch_accountPopup();
        // fetch_CreateComment();
        

//accountPopup
    //src
        $_SESSION['uid'];// dictate if the option is login or logout
    //variable
        $user_createdAt;//$_SESSION['uid'];
        $user_profilePic;
        $user_username;
        $user_email;
        $user_admin;
    //function 
        // redirect_Back();//must know the previous fullpage
        // fetch_LoginPopup(); 
        change_profilePic();
            $_FILES['user_profilePic'];
            //UPDATE user_t
            // SET profilePic = file_get($_FILES['user_profilePic']['tmp_name'])
            // WHERE id = $_SESSION['uid'];
            //return profilepic
        logout();
            // $_SESSION['uid'] = -1; 
            //return a new page   
//loginPopup
    //src
        //$_SESSION['uid'];
    //variable
    //function 
        // redirect_Back();//must know the previous fullpage
        // fetch_SignupPopup();
        insert_Login();//on success give the image data
            /* custom */$_POST['user_arg'];
            $_POST['user_password'];
            // SELECT id FROM user_t 
            // WHERE (username = $_POST['user_arg'] OR email = $_POST['user_arg']) AND password = $_POST['user_password']
            //response profilepic
            //save to $_SESSION['uid']
        
            
//signupPopup
    //src
        //$_SESSION['uid'];
    //variable
    //function 
        // redirect_Back();//must know the previous fullpage
        // fetch_LoginPopup();
        insert_signup();        
            $_POST['user_username'];
            $_POST['user_email'];
            $_POST['user_password'];
            $user_profilePic; //uses user_defaultProfile
            // INSERT INTO user_t(`profilePic`, `username`, `email`, `password`) VALUES ($user_profilePic, $_POST['user_username'], $_POST['user_email'], $_POST['user_password'])


//createForumPopup
    //src
        // $_SESSION['uid'];
    //variable
        //$user_profilePic; //$_SESSION['uid']
    //function 
        // redirect_Back();//must know the previous fullpage
        insert_Forum();        
            INSERT INTO forum_t
            name = $_POST['name'];
            banner = file_get_contents($_FILES['banner']['tmp_name']);
            icon = file_get_contents($_FILES['icon']['tmp_name']);
            descriptions = $_POST['descriptions']; 
            creatorId = $_SESSION['uid'];
            // to see the result, refresh the web

//createPostPopup
    //src
        // $_SESSION['uid'];

        $_POST['forumId'];
    //variable
        // $user_profilePic; //$_SESSION['uid']
    //function 
        // redirect_Back();//must know the previous fullpage
        insert_Post(); 
            $post_id = 1 + (SELECT max(id) from post_t)
            INSERT INTO post_t 
            creatorId = $_SESSION['uid'];
            title = $_POST['title'];
            contents = $_POST['contents'];
            forumId = $_POST['forumId'];

            INSERT INTO postPicture_t 
            postId = $post_id;
            picture = file_get_contents($_FILES['postPicture']['tmp_name']);//repeatedly

             
//createCommentPopup
    //src
        // $_SESSION['uid'];

        $_POST['postId'];
        $_POST['parentId'];
    //variable
        // $user_profilePic; //$_SESSION['uid']
    //function 
        // redirect_Back();//must know the previous fullpage
        insert_Comment();        
        
        INSERT INTO comment_t
        creatorId = $_SESSION['uid']; 
        postId = $_POST['postId'];//body property
        parentId = $_POST['parentId'];//from comment property
        comment = $_POST['comment'];
        
?>

