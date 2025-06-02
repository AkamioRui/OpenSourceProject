<?php
    var_dump(0?true:false); 
    var_dump(1?true:false); 
    
    
    // $a = [3,4,5];
    // foreach($a as $key => &$value){
    //     // $key = $value + 1;
    //     $value = $value*2;
    //     echo "$value\n";
    // }
    // print_r($a);







    // $sub = ' class="commentBody" style=\'--id=12\'><p>bla bla bla<\/p>\n<';
    // $comment1= 
    // "<div class=\"commentBody\" style='--id=34'>\n".
    // "    <p>mi mi mi</p>\n".
    // "</div>\n".
    // "<div class=\"commentChild\" style=\"padding-left: 30px;\">\n".
    // "</div>\n"
    // ;
    // $comment2= "
    // <div class=\"commentBody\" style='--id=34'>
    //     <p>mi mi mi</p>
    // </div>
    // <div class=\"commentChild\" style=\"padding-left: 30px;\">
    // </div>
    // <div class=\"commentBody\" style='--id=35'>
    //     <p>mi mi mi</p>
    // </div>
    // <div class=\"commentChild\" style=\"padding-left: 30px;\">
    //     <p> old comment<p>
    // </div>
    // <div class=\"commentBody\" style='--id=36'>
    //     <p>mi mi mi</p>
    // </div>
    // <div class=\"commentChild\" style=\"padding-left: 30px;\">
    // </div>
    // ";
    // $comment3 = "
    //     <div class=\"commentBody\" style='--id=70'>
    //         <p>new kkkkkkkkkk</p>
    //     </div>
    //     <div class=\"commentChild\" style=\"padding-left: 30px;\">
            
    //     </div>
    // ";

    // $p1 = '--id=35';//1
    // $p2 = '(.|\s)*?';//2
    // $p3 = '<div class="commentChild" style="padding-left: 30px;">';//4
    // $p4 = '(.|\s)*?';//5
    // $p5 = '<\/div>' ;//7
    // preg_match(
    //     // '/(div)(.*)(\/div)/',
    //     // '/(div)( class=\"commentBody\" style=\'--id=12\'>\n<p>bla bla bla<\/p>\n<)(\/div)/',
    //     '/('.$p1.')('.$p2.')('.$p3.')('.$p4.')('.$p5.')/',
    //     $comment2,
    //     $matches
    // );
    // // var_dump($matches);
    // echo preg_replace(
    //     '/('.$p1.')('.$p2.')('.$p3.')('.$p4.')('.$p5.')/',
    //     '\\1\\2\\4\\5'.$comment3.'\\7',
    //     $comment2
    // )
    
  /* 
    (<div class=\"commentBody\" style='--id=34'>)\n
        <p>mi mi mi</p>\n
    </div>\n
    <div class=\"commentChild\" style=\"padding-left: 30px;\">\n
    </div>\n
 */



    // $a = array();
    // $a[] = 1;   
    // $a[] = 3;
    // echo sizeof($a)   ;
    // $date = '$forum_id, $data';
    // echo preg_replace('/\$([\w_]+)/','<=$1>', $date);

    // include_once __DIR__."/../HEADER.php";
    // $dbh = getPDO();
    // $getid = $dbh->prepare('
    //     SELECT *, U.id as UID 
    //     FROM user_t as U 
    //     INNER JOIN post_t P 
    //     ON U.id = P. creatorId
    // ');
    // $getid->setFetchMode(PDO::FETCH_ASSOC);
    // $getid->bindColumn('UID',$uid);
    // $getid->execute();
    // $result = $getid->fetch();
    // foreach( $result as $key=>$val){
    //     echo "$key \n";
    // }
    // echo "id = ".$result['id']." \n";
    // echo "uid = $uid\n";
    // say();
    // function say(){
    //     echo 'hello';
    // }
    // say();
            
    // echo "first step\n";
    // return;
    // echo "second step\n";

    // ob_start();
    // echo file_get_contents('test.html');
    // $page = ob_get_clean();    
    // echo preg_replace('/<body.*>/','<body style="--code=\'mycode\'">',$page);
    // ob_end_flush();

    // global $a;
    // $a = 1001;
    // say();
    // function say(){

    //     var_dump($a);
    //     var_dump(isset($a));
    // }
?>



