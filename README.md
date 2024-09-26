# Debate System 
         $src = wp_get_attachment_image_src( 4746, 'thumbnail', false, '' );
D:\laragon\www\debates\wp-content\themes\porto\inc\plugins\plugins.php  /// satir  10 $plugin = PORTO_PLUGINS . '/sidebar-generator/sidebar_generator.php';


http://debates.test/opinion/   --- bu sayfanin adi ne olacak bilmiyorum ? 

modallar title bakilacak 
tarih eklemelerde sorun var ona bak 
breadcrumb 
mailchimp newsletter 
debate satin almaya otomatik secme ozelligi 

social share ve breadcrumb icin setting e ekleme yapilacak 


doc hazirlama ornegi https://quadlayers.com/edit-breadcrumbs-in-wordpress/

https://dev.tvsdebates.com/




v


<?php
if(class_exists('breadcrumb_navxt')){
   echo 'plugin is active';
}else{
   echo 'plugin is not active';
}
?>






https://qodeinteractive.com/magazine/how-to-create-custom-wordpress-archive-page/


https://www.wpbeginner.com/wp-tutorials/how-to-create-a-custom-post-types-archive-page-in-wordpress/


How to get the WordPress post thumbnail (featured image) URL?

https://stackoverflow.com/questions/11261883/how-to-get-the-wordpress-post-thumbnail-featured-image-url

date time icin 
https://flatpickr.js.org/examples/



//https://wordpress.stackexchange.com/questions/40706/change-the-post-date-from-a-meta-box
function cfc_reset_postdate( $data ) {
    $date = get_post_meta( get_the_ID(), 'cfc_date', true );
    $date = DateTime::createFromFormat('D - M j, Y', $date);
    $date = $date->format('Y-m-d');

    $data['post_date'] = $date;
    return $data;
}

// add_filter( 'wp_insert_post_data', 'cfc_reset_postdate');






# TODO 
 
tarih icin singe debate ye bak 

https://pexetothemes.com/wordpress-functions/wp_date/

https://code.tutsplus.com/displaying-the-date-and-time-in-the-loop--cms-32237t

https://www.google.com/search?q=wordress+how+to+find+datetime+which+day&client=firefox-b-1-d&sca_esv=13893f5a13ed50a0&sca_upv=1&sxsrf=ADLYWIJTfgeS_AOvnop5r2dh-dFrjPVSKA%3A1723317650995&ei=kr23ZuC1PJWxur8PhrLwoQ8&ved=0ahUKEwjgxrDDkuuHAxWVmO4BHQYZPPQQ4dUDCBA&uact=5&oq=wordress+how+to+find+datetime+which+day&gs_lp=Egxnd3Mtd2l6LXNlcnAiJ3dvcmRyZXNzIGhvdyB0byBmaW5kIGRhdGV0aW1lIHdoaWNoIGRheTIIEAAYgAQYogQyCBAAGIAEGKIEMggQABiABBiiBDIIEAAYgAQYogQyCBAAGIAEGKIESJ8gUKUJWOsbcAN4AZABAJgBZqABkweqAQM4LjK4AQPIAQD4AQGYAg2gAr8HwgIKEAAYsAMY1gQYR8ICChAhGKABGMMEGAqYAwCIBgGQBgiSBwQxMC4zoAe1MA&sclient=gws-wiz-serp


-----http://debates.test/attend-the-debates/   bu css 
---- http://debates.test/presslist/2023/  css and metabox 
videolardaki background kalkacak 

single debates sayfasina 
transcrptu ve opions ve speakerlara link verme eklenecek 

speaker icin ayri bir sayfa hazilanabilir 

metabox larda hic veri olmamasi sorun cikariyor ----


single page sayfasinin nasil gorunecegi ? 

https://stackoverflow.com/questions/26070898/i-want-to-display-custom-taxonomies-list-in-home-page-wordpress
https://stackoverflow.com/questions/39652122/how-to-list-all-category-from-custom-post-type bu kategorilri bulma icindir options icine verilecek 

https://wordpress.stackexchange.com/questions/84921/how-do-i-query-a-custom-post-type-with-a-custom-taxonomy


https://pagely.com/blog/create-wordpress-custom-category-pages/  bu eklentiyi incele 

options spearker php de 	echo "Can't Display The Content"; mi gorunsun yonlendirme mi yapsin 


options video da otomatik oynatma ve ses calma icin ayar olabilir 

video sayfalarinin listelenmesi 
oylama sistemi olacak mi ?  #V2

https://jqueryui.com/sortable/   https://github.com/DubFriend/jquery.repeater/tree/master 

https://github.com/awps/Accordion.JS
http://dimsemenov.com/plugins/magnific-popup/

https://github.com/Brutenis/Repeater-Field-JS?tab=readme-ov-file


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



