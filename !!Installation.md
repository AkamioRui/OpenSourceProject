window

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

linux

donwload apache2 
1. by typing:
    apt install apapche2
2. make sure apache2 is active(running). To check, type in this command
    systemctl status apapche2
3. from experience, even though the apache2 service needs /var/log/apache2, this folder can somehow gets deleted every time the raspberry pi reboot.
this folder can be created every time apache2 is activated by adding this line to : /lib/systemd/system/apache2.service under the [service]
    ExecStartPre= mkdir -p /var/log/apache2
4.  then make sure the "document root" is the directory where this app (the MESSAGEBROARDPORJECT) is saved. For example:
    1. open /etc/apache2/apache2.conf or /etc/apache2/sites-enabled/000-default.conf
    2. navigate to any mention of "Document root" and change it to the directory where this app is saved
    

download php
1. by typing
    sudo apt install php libapache2-mod-php
in php.ini enable php_mysql extension. For example by add the line:
    extension=./ext/php_pdo_mysql
by default, the maximum size for file being sent is 8MB, but it can be adjusted in php.ini
    upload_max_filesize = 128M
    post_max_size = 128M
    
client uploaded image is stored in default temp folder. for example:
    C:\Users\$user$\AppData\Local\Temp\


then make sure the "document root" is the directory where this app (the MESSAGEBROARDPORJECT) is saved. For example:
    1. open /etc/apache2/apache2.conf or /etc/apache2/sites-enabled/000-default.conf
    2. navigate to any mention of "Document root" and change it to the directory where this app is saved




download the PDO driver
    apt install php-php_mysql