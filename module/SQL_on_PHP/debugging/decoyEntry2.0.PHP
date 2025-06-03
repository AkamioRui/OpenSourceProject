<?php
    include_once __DIR__."/../HEADER.php";
   
/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    1. untuk ngirim file, kasih path ke gambarnya, gambarnya juga perlu di masukin ke folder debugging
    2. sudah tak kasih contoh, yang awalannya pake //
    2. nge run code yang sama bisa bikin duplikat
    
    
*/
    $db = new INPUT();
    // $db->addUser(__DIR__.'\user_profilePic1.jpg','testificate','user1@gmail.com','pass1', 1);
    // $db->addUser(__DIR__.'\user_profilePic2.jpg','Jane','user2@gmail.com','pass2', 0);
    // $db->addUser(__DIR__.'\user_profilePic3.jpg','John','user3@gmail.com','pass3', 0);
    // $db->addUser(__DIR__.'\user_profilePic3.jpg','jacob','user123@gmail.com','pass123', 0);

    // $db->addForum('apple', __DIR__.'\forum_banner1.jpg', __DIR__.'\forum_icon1.jpg', 1, 'about apple');
    // $db->addForum('oranges', __DIR__.'\forum_banner2.jpg', __DIR__.'\forum_icon2.jpg', 1, 'about oranges');
    // $db->addForum('grape', __DIR__.'\forum_banner3.jpg', __DIR__.'\forum_icon3.jpg', 1, 'about grape');

    // $db->addPost(2, 'my new apple', 'a big round apple ', 1, 0);
    // $db->addPost(1, 'sencond post about apple', 'a big round apple oooh ', 1, 0);
    // $db->addPost(3, 'apple again', 'a big round apple NOOO', 1, 0);

    // $db->addPostPicture(2, __DIR__.'\post1img1.jpg');
    // $db->addPostPicture(2, __DIR__.'\post1img2.jpg');
    // $db->addPostPicture(3, __DIR__.'\post1img3.webp');

    $db->addComment(1, 1, NULL, 'comment1', 0);
    $db->addComment(2, 1, NULL, 'comment2', 0);
    $db->addComment(3, 1, NULL, 'comment3', 0);
    $db->addComment(1, 1, 2, 'comment4', 0);
    $db->addComment(1, 1, 2, 'comment5', 0);
    $db->addComment(1, 1, 3, 'comment6', 0);
    $db->addComment(1, 1, 6, 'comment7', 0);


    
   


//-------------------code---------------------------------------------------------//   
    class INPUT{
        public $addUser;
        public $addforum;
        public $addpost;
        public $addpostPicture;
        public $addComment;

        function __construct(){
            $dbh = getPDO();

            $this->addUser = $dbh->prepare('
                INSERT INTO `user_t`(`profilePic`, `username`, `email`, `password`, `admin`)
                VALUES ( :profilePic, :username, :email, :password, :admin)
            ');
            
            
            $this->addforum = $dbh->prepare("
                INSERT INTO `forum_t`(`name`, `banner`, `icon`, `creatorId`, `descriptions`)
                VALUES(:name, :banner, :icon, :creatorId, :descriptions)
            ");
            

            $this->addpost = $dbh->prepare("
                INSERT INTO `post_t`(`creatorId`, `title`, `contents`, `forumId`, `like`)
                VALUES(:creatorId, :title, :contents, :forumId, :like)
            ");
            

            $this->addpostPicture = $dbh->prepare("
                INSERT INTO `postPicture_t`(`postId`, `picture`)
                VALUES(:postId, :picture)
            "); 
            
            
            $this->addComment = $dbh->prepare("
                INSERT INTO `comment_t`(`creatorId`, `postId`, `parentId`, `comment`, `like`) 
                VALUES(:creatorId, :postId, :parentId, :comment, :like)
            ");
            
        }
        

        function addUser($profilePicPath, $username, $email, $password, $admin){
            $this->addUser->bindValue(':profilePic',file_get_contents($profilePicPath));
            $this->addUser->bindValue(':username',$username);
            $this->addUser->bindValue(':email',$email);
            $this->addUser->bindValue(':password',$password);
            $this->addUser->bindValue(':admin',$admin);
            $this->addUser->execute();
            
        }
        function addForum($name, $bannerPath, $iconPath, $creatorId, $descriptions) {
            $this->addforum->bindValue(':name',$name);
            $this->addforum->bindValue(':banner',file_get_contents($bannerPath));
            $this->addforum->bindValue(':icon',file_get_contents($iconPath));
            $this->addforum->bindValue(':creatorId',$creatorId);
            $this->addforum->bindValue(':descriptions',$descriptions);
            $this->addforum->execute();
        }
        function addPost($creatorId, $title, $contents, $forumId, $like) {
            $this->addpost->bindValue(':creatorId',$creatorId);
            $this->addpost->bindValue(':title',$title);
            $this->addpost->bindValue(':contents',$contents);
            $this->addpost->bindValue(':forumId',$forumId);
            $this->addpost->bindValue(':like',$like);
            $this->addpost->execute();
        }
        function addPostPicture($postId, $picture) {
            $this->addpostPicture->bindValue(':postId',$postId);
            $this->addpostPicture->bindValue(':picture',file_get_contents($picture));
            $this->addpostPicture->execute();
        }
        function addComment($creatorId, $postId, $parentId, $comment, $like) {
            $this->addComment->bindValue(':creatorId',$creatorId);
            $this->addComment->bindValue(':postId',$postId);
            $this->addComment->bindValue(':parentId',$parentId);
            $this->addComment->bindValue(':comment',$comment);
            $this->addComment->bindValue(':like',$like);
            $this->addComment->execute();
        }
                    
    }

?>







