

donwload apache2 
1. by typing:
    sudo apt install apapche2
2. make sure apache2 is active(running). To check, type in this command
    systemctl status apapche2
3. (optional)from experience, even though the apache2 service needs /var/log/apache2, this folder can somehow gets deleted every time the raspberry pi reboot.
this folder can be created every time apache2 is activated by adding this line to : /lib/systemd/system/apache2.service under the [service]
    ExecStartPre= mkdir -p /var/log/apache2
4.  then make sure the "document root" is the directory where this app is saved. For example:
    1. open /etc/apache2/apache2.conf or /etc/apache2/sites-enabled/000-default.conf
    2. navigate to any mention of "Document root" and change it to the directory where this app is saved
    3. add (change /the/app/direcory into the directory where this app is downloaded/cloned)
        <Directory /the/app/directory/>
            Require all granted	
        </Directory>
5. install the php support for apache. by typing the code below and restarting the apache service
    sudo apt install php libapache2-mod-php

    

download php
1. by typing
    sudo apt install php libapache2-mod-php
2. install mysql driver. by typing
    sudo apt install php-mysql
3. (optionally)by default, the maximum size for file being sent is 8MB, but it can be adjusted in php.ini by adding/editing this line
    upload_max_filesize = 128M
    post_max_size = 128M 



download mariadb.
1. by typing
    sudo apt install mariadb-server
2. make sure maridb server is running, if not then 
    systemctl start mariadb.service
3. then configure it. using the following command, 
    mysql_secure_installation
4. create a database in the newly installed mariadb
5. modify \databaseConfig.json file according to the database you want to use 
6. open mariadb then copy CREATE_TABLE.sql and run it.
7. (optional) \module\SQL_on_PHP\debugging\decoyEntry2.0.PHP can be run to add testing entry to the database





