@ECHO OFF

rem http://stackoverflow.com/questions/1192476/format-date-and-time-in-a-windows-batch-script
set datetimef=%date%_%time:~0,2%-%time:~3,2%-%time:~6,2%
set datetimef=%datetimef: =0%

ECHO.
SET klasor=%date:~-10,2%.%date:~-7,2%.%date:~-4,4%
SET siliniecek_data=%datetimef%
mkdir "D:\EasyPHP-DevServer\data\localweb\chromatin\wp_bull\wp-content\themes\yedekler\%klasor%" 


ECHO sql yedekleme 
ECHO.
rem eski  
 rem "D:\EasyPHP-DevServer\binaries\mysql\bin\mysqldump.exe" --user=root --password= --skip-opt chromatin > chromatin/%datetimef%.sql"
"D:\EasyPHP-DevServer\binaries\mysql\bin\mysqldump.exe" --user=root --password= --skip-opt chromatin > chromatin/app.sql"
  
ECHO  Theme Files  
"C:\Program Files\7-Zip\7z.exe" a -tzip -x!.git "D:\EasyPHP-DevServer\data\localweb\chromatin\wp_bull\wp-content\themes\yedekler\%klasor%\chromatin-%datetimef%.zip" "D:\EasyPHP-DevServer\data\localweb\chromatin\wp_bull\wp-content\themes\chromatin\*" -mx5

rem eski; "D:\EasyPHP-DevServer\data\localweb\chromatin\wp_bull\wp-content\themes\chromatin\%siliniecek_data%.sql"
del "D:\EasyPHP-DevServer\data\localweb\chromatin\wp_bull\wp-content\themes\chromatin\app.sql"

ECHO.
rem "C:\Program Files\7-Zip\7z.exe" a -tzip -x!.git "D:\EasyPHP-DevServer\data\localweb\chromatin\wp_bull\wp-content\themes\yedekler\%klasor%\chromatin-%TODAY%.zip" "D:\EasyPHP-DevServer-14.1VC11\data\localweb\ecommerce\*" -mx5 -xr!*public\resimler\urunler\*


PAUSE