<?php
    include_once __DIR__."/HEADER.php";
    
  
    class CREATEPOST{
        function generate_CREATEPOST(){
            /* temp */$page = file_get_contents(__DIR__.'\CREATEPOST_form.html');
            /* temp */$page = preg_replace('/\$forum_id/',$_POST['forum_id'],$page);
            echo $page;        
        }
    }

    $createpost = new CREATEPOST();
    $createpost->generate_CREATEPOST();
    
      
    
?>

<?php
    // $page = file_get_contents(__DIR__.'\..\..\src\views\homepage.html');
    // $page = preg_replace('#href="../css/homepage.css"#','href="/src/css/homepage.css"',$page);
    // echo $page;

?>