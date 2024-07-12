# Debate System 

D:\laragon\www\debates\wp-content\themes\porto\inc\plugins\plugins.php  /// satir  10 $plugin = PORTO_PLUGINS . '/sidebar-generator/sidebar_generator.php';


css and jss for will add version number 


https://dev.tvsdebates.com/



https://qodeinteractive.com/magazine/how-to-create-custom-wordpress-archive-page/


https://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-post-types-archive-page-in-wordpress/


How to get the WordPress post thumbnail (featured image) URL?

https://stackoverflow.com/questions/11261883/how-to-get-the-wordpress-post-thumbnail-featured-image-url

# TODO 
debates sayfalarinin nasil siralanacagi icin options ayari 
sayfalama nasil gorunuecek onun icin bir options ayari 



# wordpress gelismis kategori slug kullanimi ornegi bunu burada bir ornek olustur 
https://wordpress.stackexchange.com/questions/275825/display-custom-post-type-taxonomies-as-an-archive-page



# taxomoy page nasil yapilir 
https://wordpress.stackexchange.com/questions/172119/how-to-create-archive-page-for-taxonomy-terms-within-custom-post-type

There is an example in the WP Codex which should work for you:
Try the following naming convention for your taxonomy term archive template:
taxonomy-{taxonomy}-{term}.php
So, let's say you have a CPT named "Projects," a taxonomy named "Maintenance," and a term within the taxonomy named "Professional." Then your naming convention would be:
taxonomy-maintenance-professional.php


https://www.youtube.com/watch?v=8jiMZx_Ddg4

