
@echo off

set path=D:\laragon\bin\mysql\mysql-8.0.30-winx64\bin

cd D:\laragon\bin\mysql\mysql-8.0.30-winx64\bin
.\mysqldump.exe  -u root  -p debates > D:\laragon\www\debates\wp-content\plugins\tvs-debate\other\debates-sqlfile.sql  

# UPDATE wp_options SET option_value = replace(option_value, 'http://www.oldurl', 'http://www.newurl') WHERE option_name = 'home' OR option_name = 'siteurl';

# UPDATE wp_posts SET guid = replace(guid, 'http://www.oldurl','http://www.newurl');

# UPDATE wp_posts SET post_content = replace(post_content, 'http://www.oldurl', 'http://www.newurl');

# UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://www.oldurl','http://www.newurl');