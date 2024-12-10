@ECHO OFF
SET hr=%time:~0,2%
IF %hr% lss 10 SET hr=0%hr:~1,1%
 
Set TODAY=%date:~4,2%-%date:~7,2%-%date:~10,4%-%hr%%time:~3,2%%time:~6,2%%time:~9,2%
 
ECHO.
 
rem http://www.wikihow.com/Send-Sql-Queries-to-Mysql-from-the-Command-Line
rem utf sorunu http://makandracards.com/makandra/595-dumping-and-importing-from-to-mysql-in-an-utf-8-safe-way
rem backup icin http://webcheatsheet.com/sql/mysql_backup_restore.php
color 2
ECHO -----------------------sql silme ve oluşturma ---------------------------
ECHO.
"D:\xampp\mysql\bin\mysql.exe" --user=root --password= --default-character-set=utf8  chromatin -e "DROP DATABASE chromatin;CREATE DATABASE `chromatin` /*!40100 COLLATE 'utf8_general_ci' */;"

color 3
ECHO ----------------------sql geri yukleme yapılıyor ------------------------- 
"D:\xampp\mysql\bin\mysql.exe" --user=root --password= --default-character-set=utf8  chromatin < app.sql


color 5
ECHO ----------------------auto increment fix------------------------- 
D:\xampp\php\php.exe -f yedekler/autoincrement-fix/index.php -- -s run


color 4
echo -------------will done, happy coding-------------------------------
PAUSE
color 4
rem iptal edildi 
echo -------------işlem tamam-------------------------------
rem "D:\EasyPHP-DevServer-14.1VC11\binaries\mysql\bin\mysqldump.exe" --user=root --password=123456 --skip-opt chromatin > diger/%TODAY%.sql"




PAUSE