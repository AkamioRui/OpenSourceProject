??? how smart is the people using the app
??? 
email and username must be unique
maximum size of every string is 1024


general description of the mechanism 
1. if a page/popup need to send data to the database, then the data will be sent to their coresponding module/listener.php .
2. if a page/popup needs data from database, then the data will be provided by their php.
3. page/popup that doesn't dynamic change the html structure, for example the loginpage are directly referenced from it's html file, thus changing the html file will change the outputed page as well. while page/popup that do need 
4. not-signed in client will have user_id = -1
5. to change how not signin user appear in account page, change the databaseConfig.json. note that the profilePic is the path to the image file relative to the HEADER.php



    

