??? how smart is the people using the app
??? 
email and username must be unique
maximum size of every string is 1024

download apache2
then make sure the "document root" is the directory where this app (the MESSAGEBROARDPORJECT) is saved. For example:
    1. open /etc/apache2/apache2.conf or /etc/apache2/sites-enabled/000-default.conf
    2. navigate to any mention of "Document root" and change it to the directory where this app is saved
also make sure apache2 can open this directory. For example:
    1. open previously mentioned file again
    2. under the Document Root line, add 
    <Directory "/the/app/direcory">
        Require all granted
    </Directory>

download php
in php.ini enable php_mysql extension. For example by add the line:
    extension=./ext/php_pdo_mysql
by default, the maximum size for file being sent is 8MB, but it can be adjusted in php.ini
    upload_max_filesize = 128M
    post_max_size = 128M
    
client uploaded image is stored in default temp folder. for example:
    C:\Users\$user$\AppData\Local\Temp\


download mariadb
create a database then fill database identity (hostIP, port, database name,...) into /databaseConfig.json
run the code in \module\sql_code\CREATE_TABLE.sql on your database

general description of the mechanism 
1. if a page/popup need to send data to the database, then the data will be sent to their coresponding module/listener.php .
2. if a page/popup needs data from database, then the data will be provided by their php.
3. page/popup that doesn't dynamic change the html structure, for example the loginpage are directly referenced from it's html file, thus changing the html file will change the outputed page as well. while page/popup that do need 
4. not-signed in client will have user_id = -1
5. to change how not signin user appear in account page, change the databaseConfig.json. note that the profilePic is the path to the image file relative to the HEADER.php

    

