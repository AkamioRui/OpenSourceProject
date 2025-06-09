<?php


//D:\tugas\2_2\OpenSource\MessageBroardProject\module\SQL_on_PHP\test\test1.php
//D:\tugas\2_2\OpenSource\MessageBroardProject\module\SQL_on_PHP\HEADER.php
//include_once __DIR__."/../HEADER.php";


// preg_match(
//   '/(<[^<>]*id="sign-up"[^<>]*>)([^<>]*)(<[^<>]*>)/',
//   file_get_contents(__DIR__.'\..\..\..\src\views\account.html'),
//   $matches
// );
// var_dump($matches);

include_once __DIR__."/../../../module/SQL_on_PHP/HEADER.php"; 
getPDO();
// extractfrom(file_get_contents(__DIR__.'\..\..\..\src\views\homepage.html'),'<[^>]*repeat[^>]*>','div');


// function extractfrom($src,$fulltag,$tag){//only the first occurance

//   $keyMiddle = preg_split(
//       '/('.$fulltag.')/',
//       $src,
//       2,
//       PREG_SPLIT_DELIM_CAPTURE
//   );

  
   
//   //find the </div>
//   preg_match_all(
//       '/<[^<>]*'.$tag.'[^<>]*>|<\/[^<>]*'.$tag.'[^<>]*>/',
//       $keyMiddle[2],
//       $candidate,
//       PREG_OFFSET_CAPTURE
//   );
  
//   $offset;
//   $count = 1;
//   foreach ($candidate[0] as $instance){
//       if(preg_match('/<\/[^<>]*'.$tag.'[^<>]*>/',$instance[0]) ){
//           $count--;
//       } else{
//           $count++;
//       }
    
//       if($count == 0){
//         $offset = $instance[1] + strlen($instance[0]);
//         break;

//       }
//   }
//   // echo $keyMiddle[1].substr($keyMiddle[2],0,$offset)."\n";
//   $before = $keyMiddle[0];
//   $fulltag = $keyMiddle[1].substr($keyMiddle[2],0,$offset)."\n";
//   $after = substr($keyMiddle[2],$offset);

//   var_dump([$before,$fulltag,$after]);
//   return;


//   // var_dump($keyMiddle);
//   // echo substr($src,$keyMiddle[1][1],$keyMiddle[2][1] - $keyMiddle[1][1] );

//   return [$before,$fulltag,$after];
// }



  // class myvar{
  //   public $a;
  //   public $b;
  //   public $c;
  //   function __construct(){
  //     $this->a = 10;
  //     $this->b = 2;
  //     $this->c = 999;
  //   }
  // };
  
  // $obj = new myvar();
  // $arr =get_object_vars($obj);
  
  // $string = 'here is a = $a, b = $b, c = $c';
  // foreach(get_object_vars($obj) as $key => $value){
  //   $string = preg_replace('/\$'.$key.'/',$value,$string);
  // }
  
  // //$string = preg_replace('/\$a/',11,$string);
  // echo $string;
  
    
    
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
/home/dietpi/OpenSource/OpenSourceProject/module/SQL_on_PHP/test/test1.php


