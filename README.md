# Debate System 

D:\laragon\www\debates\wp-content\themes\porto\inc\plugins\plugins.php  /// satir  10 $plugin = PORTO_PLUGINS . '/sidebar-generator/sidebar_generator.php';





https://dev.tvsdebates.com/



https://qodeinteractive.com/magazine/how-to-create-custom-wordpress-archive-page/


https://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-post-types-archive-page-in-wordpress/


How to get the WordPress post thumbnail (featured image) URL?

https://stackoverflow.com/questions/11261883/how-to-get-the-wordpress-post-thumbnail-featured-image-url

# TODO 
 
single page sayfasinin nasil gorunecegi ? 

video sayfalarinin listelenmesi 
oylama sistemi olacak mi ?  #V2

https://jqueryui.com/sortable/   https://github.com/DubFriend/jquery.repeater/tree/master 

https://github.com/awps/Accordion.JS
http://dimsemenov.com/plugins/magnific-popup/


---speaker sayfasi ??
---anasayfanin tasarlanmasi 

speakers listenen yere speaker icin link verelim ikinci versyion #V2
debates sayfalarinin nasil siralanacagi icin options ayari 
sayfalama nasil gorunuecek onun icin bir options ayari 
kategori sayfasindaki description i hangi sayfadan okucagini taxonomy options dan bulmali --- custom page icin ne olacak 


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


# gecerli kategoriyi bulmak 
 uses for \themes\porto-child\taxonomy-topics.php
//https://stackoverflow.com/questions/12289169/how-to-get-the-current-taxonomy-term-id-not-the-slug-in-wordpress
//https://www.google.com/search?q=wordpress+how+to+find+get+root+taxonomy&client=firefox-b-1-d&sca_esv=458fc5d25ecd7a59&sca_upv=1&sxsrf=ADLYWIIlnA1q8cg-fXYEu3_9fe9B7ClQeA%3A1720847111735&ei=BwuSZoDNLP2rur8Px_SruA8&oq=wordpress+how+to+find+get+root+tax&gs_lp=Egxnd3Mtd2l6LXNlcnAiIndvcmRwcmVzcyBob3cgdG8gZmluZCBnZXQgcm9vdCB0YXgqAggBMgUQIRigATIFECEYoAEyBRAhGKABMgUQIRigATIFECEYoAFI4z5QkytYnzJwBHgAkAEAmAFqoAHjAqoBAzMuMbgBA8gBAPgBAZgCB6ACvwLCAgoQABiwAxjWBBhHwgIFECEYqwKYAwCIBgGQBgiSBwM2LjGgB4YY&sclient=gws-wiz-serp
//    $tax = $wp_query->get_queried_object();
//    echo ''. $tax->name . '';
//    echo "<br>";  
//     echo ''. $tax->term_id . '';
//    echo "<br>";
//    echo ''. $tax->description .''; 

# porto yontemi ile  gecerli kategoriyi bulmak 
	$cat_list = get_the_term_list( $post->ID, 'portfolio_cat', '', ', ', '' );
					if ( isset( $porto_settings['portfolio-metas'] ) && in_array( 'cats', $porto_settings['portfolio-metas'] ) && $cat_list ) :
						?>
						<li>
							<i class="fas fa-tags"></i> <?php echo porto_filter_output( $cat_list ); ?>
						</li>
					<?php endif; ?>



# custom URL routes 

https://carlalexander.ca/wordpress-adventurous-rewrite-api/

https://digitalsetups.com/custom-rewrite-rules-vs-rest-routes/

 https://wpmudev.com/blog/building-customized-urls-wordpress/

https://anchor.host/wordpress-routing-hacks-for-single-page-applications/

https://github.com/varunsridharan/wp-endpoint

https://pexetothemes-com.translate.goog/wordpress-functions/add_query_arg/?_x_tr_sl=auto&_x_tr_tl=tr&_x_tr_hl=en-US

https://www.daggerhartlab.com/wordpress-rewrite-api-examples/

https://imranhsayed.medium.com/adding-rewrite-rules-in-wordpress-tutorial-b8603a37dcab


https://wordpress.stackexchange.com/questions/390382/how-to-add-custom-rewrite-rules-and-point-to-specific-templates

https://www.google.com/search?q=wordpress+rewrite+url&client=firefox-b-1-d&sca_esv=cfcd3706826e13a2&sca_upv=1&sxsrf=ADLYWIIdY7mgYKzr3Ld7pjb5bceaHobkLw%3A1719266978598&ei=ou55ZvmnJLvmkPIP-YyI8Ao&ved=0ahUKEwj5gKLMoPWGAxU7M0QIHXkGAq4Q4dUDCBA&uact=5&oq=wordpress+rewrite+url&gs_lp=Egxnd3Mtd2l6LXNlcnAiFXdvcmRwcmVzcyByZXdyaXRlIHVybDILEAAYgAQYkQIYigUyBRAAGIAEMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHjIGEAAYFhgeMgYQABgWGB4yBhAAGBYYHkjoPlD7BlijPXAAeAGQAQCYAVygAcwIqgECMTa4AQPIAQD4AQGYAhCgAr8IwgIEEAAYR8ICChAAGIAEGBQYhwLCAggQABgWGAoYHpgDAIgGAZAGCJIHAjE2oAfNYg&sclient=gws-wiz-serp#ip=1

https://www.hongkiat.com/blog/wordpress-url-rewrite/   buna bak 

 https://wordpress.stackexchange.com/questions/58683/how-to-create-a-front-end-user-profile-with-a-friendly-permalink

// https://revelationconcept.com/wordpress-rename-default-posts-news-something-else/



