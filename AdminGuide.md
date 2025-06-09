
general description of the mechanism 
1. if a page/popup need to send data to the database, then the data will be sent to their coresponding module/listener.php .
2. if a page/popup needs data from database, then the data will be provided by their php.
3. while the php will automatically replace all the temporary variable placed in the html. But element that need to be repeated or need some special treatment must be hardcoded. this include the handling of the 'repeat' custom attribute

4. not-signed in client will have user_id = -1
5. to change how not signin user appear in account page, change the databaseConfig.json. note that the profilePic is the path to the image file relative to the HEADER.php

databaseConfig.json
"database":{
    "host": this is the host ip of the mariadb server 
    "port": this is the listening port of the mariadb server
    "dbname": this is the database inside the aformentioned server that is intended to house the data collected by the app
    "username": the username allowed to access the database
    "password": the password for the username
},
"defaultUser":{
    "createdAt":the placeholder text that will be shown in the 'created at' field in the account popup when user is not logged in
    "profilePic":the path to the placeholder profile pic (relative to the /module/SQL_on_PHP/HEADER.php) that will be shown in the account popup when user is not logged in
    "username":the placeholder text that will be shown in the 'username' field in the account popup when user is not logged in
    "email":the placeholder text that will be shown in the 'email' field in the account popup when user is not logged in
},
"homepage":{//NOT IMPLEMENTED
    "forum_max_description":the max length of every forum description in homepage,
    "post_max_description":the max length of every post description in homepage
},
"forumpage":{
    "post_max_description":the max length of every post description in forumpage
}



    

