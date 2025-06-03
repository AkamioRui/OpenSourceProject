<?php
    //this is executed by all php file
    session_start();
    $_SESSION['uid'] = $_SESSION['uid']??-1;


    //library
    function replaceWithObj($obj,string $string){
        foreach(get_object_vars($obj) as $key => $value){
            $string = preg_replace('/\$'.$key.'/',$value,$string);
          }
    }
    
    function getPDO():PDO{
        // $dbh = new PDO('mysql:host=127.0.0.1;port=13306;dbname=myadmin_db;','root','ruidb');

        $param = json_decode(file_get_contents(__DIR__.'/../../databaseConfig.json'));
        $dbh = new PDO('mysql:
            host='.$param->database->host.';
            port='.$param->database->port.';
            dbname='.$param->database->dbname.';',
            $param->database->username,
            $param->database->password
        );
        
        return $dbh;            
    }

    function getProfilePic(){
        $defaulProfilePicPath = __DIR__.'\\'.json_decode(file_get_contents(__DIR__.'/../../databaseConfig.json'))->defaultUser->profilePic;
        $prefix = 'data:image/*;base64,';
        
        $dbh = getPDO();
        
        //get user info
        $selectUser = $dbh->prepare('
            SELECT `profilePic` FROM `user_t`
            WHERE id = :user_id
        ');
        $selectUser->setFetchMode(PDO::FETCH_COLUMN,0);
        $selectUser->bindValue(':user_id',$_SESSION['uid']);
        $selectUser->execute();
        
        
        $result = $selectUser->fetch()?:file_get_contents($defaulProfilePicPath);
        
        return $prefix.base64_encode($result);
    }

    function extractfrom($tag,$src){//only the first occurance

        $keyMiddle = preg_split(
            '/('.$tag.')/',
            $src,
            2,
            PREG_SPLIT_DELIM_CAPTURE
        );
         
        //find the </div>
        preg_match_all(
            '/<div[^>]*>|<\/div>/',
            $keyMiddle[2],
            $candidate,
            PREG_OFFSET_CAPTURE
        );
        $offset;
        $count = 1;
        foreach ($candidate[0] as $instance){
            if($instance[0] == '</div>'){
                $count--;
            } else{
                $count++;
            }
          
            if($count == 0){
              $offset = $instance[1] + strlen('</div>');
              break;

            }
        }
        // echo $keyMiddle[1].substr($keyMiddle[2],0,$offset)."\n";
        $before = $keyMiddle[0];
        $tag = $keyMiddle[1].substr($keyMiddle[2],0,$offset)."\n";
        $after = substr($keyMiddle[2],$offset);




        // var_dump($keyMiddle);
        // echo substr($src,$keyMiddle[1][1],$keyMiddle[2][1] - $keyMiddle[1][1] );

        return [$before,$tag,$after];
    }


    
    
    
    

?>
