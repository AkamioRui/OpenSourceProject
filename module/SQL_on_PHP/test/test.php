<?php
  
    /* 
    <div class="forum-detail-card-header">
        <div class="title-container">
            <h2 class="forum-title">Forum Title</h2>
            <p class="forum-id">ID: {{FORUM.ID}}</p>
        </div>
        <p class="forum-description">
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
            ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
            aliquip ex ea commodo consequat. ."
        </p>
    </div>
    
    
    */
    include_once __DIR__."/../../../module/SQL_on_PHP/HEADER.php"; 
    $result = generatePage(__DIR__.'\..\..\..\src\views\homepage.html') ;
    
    //split the src into (before)+(tag)+(after)
    function generatePage($HTMLpath){
      $raw = file_get_contents($HTMLpath);
      //card-container = forum
      //card-content = post
      list($beforeforum,$forum,$afterforum) = extractfrom('<[^>]*repeat[^>]*>',$raw);
      $forum = preg_replace('/repeat/','',$forum,1);
      list($beforepost,$post,$afterpost) = extractfrom('<[^>]*repeat[^>]*>',$forum);
      $post = preg_replace('/repeat/','',$post,1);

      echo '--> beforeforum = '.$beforeforum."\n";
      echo '--> beforepost = '.$beforepost."\n";
      echo '--> post = '.$post."\n";
      echo '--> afterpost = '.$afterpost."\n";
      echo '--> afterforum = '.$afterforum."\n";
      
  }
    
    
    
    // preg_match_all(
    //     '/<div[^>]*>|<\/div>/',
    //     '
    //         <div>
    //         </div>
    //         <div class="aaa">
    //             <div>
    //             </div>
    //         </div>
        
    //     ',
    //     $matches,
    //     PREG_OFFSET_CAPTURE
    // );
    // var_dump($matches);
    

    /* 
    
$ php "d:\tugas\2_2\OpenSource\MessageBroardProject\module\SQL_on_PHP\test\test.php"
array(1) {
  [0]=>
  array(6) {
    [0]=>
    array(2) {
      [0]=>
      string(5) "<div>"
      [1]=>
      int(14)
    }
    [1]=>
    array(2) {
      [0]=>
      string(6) "</div>"
      [1]=>
      int(33)
    }
    [2]=>
    array(2) {
      [0]=>
      string(17) "<div class="aaa">"
      [1]=>
      int(53)
    }
    [3]=>
    array(2) {
      [0]=>
      string(5) "<div>"
      [1]=>
      int(88)
    }
    [4]=>
    array(2) {
      [0]=>
      string(6) "</div>"
      [1]=>
      int(111)
    }
    [5]=>
    array(2) {
      [0]=>
      string(6) "</div>"
      [1]=>
      int(131)
    }
  }
}    
    
    
    
    */
?>


