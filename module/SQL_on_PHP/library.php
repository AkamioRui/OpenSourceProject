<?php
    function getPDO():PDO{
        // $dbh = new PDO('mysql:host=127.0.0.1;port=13306;dbname=myadmin_db;','root','ruidb');

        $param = json_decode(file_get_contents(__DIR__.'/../../databaseConfig.json'));
        $dbh = new PDO('mysql:
            host='.$param->host.';
            port='.$param->port.';
            dbname='.$param->dbname.';',
            $param->username,
            $param->password
        );
        
        return $dbh;            
    }

?>