<?php
    include_once __DIR__."/../HEADER.php";
   
/* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    1. untuk ngirim file, kasih path ke gambarnya, gambarnya juga perlu di masukin ke folder debugging
    2. sudah tak kasih contoh, yang awalannya pake //
    2. nge run code yang sama bisa bikin duplikat
    
    
*/
    $db = new INPUT();
    $db->addUser(__DIR__.'/view.jpg','Lucky gunner','georgeygeorge@gmail.com','chickenwings', 1);
    $db->addUser(__DIR__.'/elephant.jpeg','Mighty Walrus','savetheelephants@gmail.com','trunktrunk', 0);
    $db->addUser(__DIR__.'/indonesia.png','Asep','asepjakarta@gmail.com','gadogado', 0);
    // $db->addUser(__DIR__.'/user_profilePic3.jpg','John','user3@gmail.com','pass3', 0);
    // $db->addUser(__DIR__.'/user_profilePic3.jpg','jacob','user123@gmail.com','pass123', 0);

    $db->addForum('Cooking without fire', __DIR__.'/cooking.jpeg', __DIR__.'/gordon.jpg', 1, 'This forum has been created to talk about the modern art of cooking, as a wise man once said that the difference between cooking and being cooked is that one holds the pot while the other is in the pot.');
    $db->addForum('Chocolate', __DIR__.'/chocolate.jpg', __DIR__.'/candy bar.jpg', 1, 'Welcome to the world of chocolate, where the sweetness is never ending and we arent talking about just chocolates.');
    $db->addForum('Presidents around the world', __DIR__.'/united nations.png', __DIR__.'/obama.jpeg', 1, 'The global political scene is ever-changing and unpredictably dynamic, in this forum we will respect the right to freedom of speech and be a safe space for opinions.');
    // $db->addForum('grape', __DIR__.'/forum_banner3.jpg', __DIR__.'/forum_icon3.jpg', 1, 'about grape');

    $db->addPost(1, 'Cooking', "I am honestly not that good at cooking but i am the first post here so there isn't much i can talk about", 3, 70);
    $db->addPost(1, 'I got a cookbook !', 'I recently got a cookbook published by Wong academy and i cannot wait to find out so much more about the art.', 3, 150);
    $db->addPost(2, 'Self-training', "I've always had a passion for cooking but not the finances to support it, that's why i decided to go to Wong academy to participate in their 3-month free cooking program.", 3, 20);
    $db->addPost(3, 'Living with diabetes', 'I was recently diagnosed with diabetes at the age of 72, which might not seem like much of a big deal; but considering my love for chocolate i am devastated. Any suggestions on how I can still enjoy sweets while looking after my health ?', 4, 15);
    $db->addPost(2, "Baking is expensive", "I'm a professional baker responsible for supplying over 10 bakeries with thier cakes, and I must say that running my business has only gotten tougher with the rising price of chocolates from all around the world.", 4, 300);
    $db->addPost(3, 'Adapting', "As someone with diabetes who still craves sweets, I've been trying to learn to bake with less sugar and I'm wondering if dark chocolate is less sweet because it has less sugar", 4, 10);
    $db->addPost(1, 'Trump', "I'm a non US citizen who is currently living in the states, just wondering how Americans feel about the current state of this country.", 6, 35);
    $db->addPost(2, 'Prabowo of Indonesia', "Never been to Southeast Asia but just curious to see how the current Indonesian president will deal with the problems that will sooner or later arise concerning his plan to provide free lunches to every student in his country with over 80 million children.", 6, 200);
    $db->addPost(3, 'Vatican', 'Just wondering, is the pope considered a president ?', 6, 500);
    // $db->addPost(1, 'sencond post about apple', 'a big round apple oooh ', 1, 0);

    $db->addPostPicture(2, __DIR__.'/cookbook.jpeg');
    $db->addPostPicture(9, __DIR__.'/papa leo.jpg');
    $db->addPostPicture(6, __DIR__.'/darkchocolate.jpg');
    // $db->addPostPicture(1, __DIR__.'/post1img3.webp');

    $db->addComment(1, 1, NULL, 'Its kinda lonely being the first to post in a forum.', 52);
    $db->addComment(2, 1, 1, 'Hey there, I would not call myself an expert but would love to answer your questions if any about cooking', 20);
    $db->addComment(3, 1, NULL, 'I cannot tell if this forum is about cooking or cooking.', 200);
    $db->addComment(1, 1, NULL, 'So good to see so many comments under my post !', 17);
    $db->addComment(1, 2, NULL, 'Wait a minute... this book is not actually about cooking as in making food.', 52);
    $db->addComment(2, 2, 14, "Can't believe there are still people out there who do not know what cooking is about.", 2000);
    $db->addComment(3, 2, NULL, 'I love cooking, it almost feels like roasting', 19);
    $db->addComment(1, 2, NULL, 'Not gonna lie, this type of cooking is also fun.', 17);
    $db->addComment(3, 3, NULL, 'I have always wanted to join that program, how did you apply ?', 70);
    $db->addComment(2, 3, 6, 'I applied through the wong academy official website', 10);
    $db->addComment(1, 3, NULL, 'Which edition of the cookbook did you get ?', 30);
    $db->addComment(3, 3, NULL, "I still don't know what coooking is about to be honest", 70);
    // $db->addComment(2, 1, NULL, 'comment2', 0);
    // $db->addComment(2, 1, NULL, 'comment2', 0);
    // $db->addComment(2, 1, NULL, 'comment2', 0);
    // $db->addComment(2, 1, NULL, 'comment2', 0);
    // $db->addComment(3, 1, NULL, 'comment3', 0);
    // $db->addComment(1, 1, 2, 'comment4', 0);
    // $db->addComment(1, 1, 2, 'comment5', 0);
    // $db->addComment(1, 1, 3, 'comment6', 0);
    // $db->addComment(1, 1, 6, 'comment7', 0);



    
   


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







