<?php
        
    // $date = '$forum_id, $data';
    // echo preg_replace('/\$([\w_]+)/','<=$1>', $date);

    //include_once __DIR__."/HEADER.php";
    // $dbh = getPDO();
    // $getid = $dbh->prepare('
    //     SELECT max(id) FROM post_t
    //     ');
    //     $getid->setFetchMode(PDO::FETCH_COLUMN,0);
    //     $getid->execute();
    //     var_dump($getid->fetch());

    // say();
    // function say(){
    //     echo 'hello';
    // }
    // say();
            
    // echo "first step\n";
    // return;
    // echo "second step\n";

    ob_start();
    echo file_get_contents('test.html');
    $page = ob_get_clean();    
    echo preg_replace('/<body.*>/','<body style="--code=\'mycode\'">',$page);
    ob_end_flush();
?>



