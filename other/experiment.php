<?php 


$the_query = new WP_Query( array('posts_per_page'=>4,
                                 'post_type'=>'debate',
                                 'paged' => get_query_var('paged') ? get_query_var('paged') : 1) 
                            ); 
                            ?>
<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
<div class="col-xs-12 file">
<a href="<?php the_permalink(); ?>" class="file-title" target="_blank">
<i class="fa fa-angle-right" aria-hidden="true"></i> <?php echo get_the_title(); ?>
</a>
<div class="file-description"><?php the_content(); ?></div>
</div>
<?php
endwhile;
echo "<div> wordpress  pagination </div>";
$big = 999999999; // need an unlikely integer
echo  paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
	
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $the_query->max_num_pages,
	'prev_text'    => __('← Previous'),
	'next_text'    => __('Next  →'),
	// 'type'  => 'list',
) );



//  $big = 999999999;
// $pagination  = paginate_links(array(
//     'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
//     'format' => '?paged=%#%',
//     'current' => max( 1, get_query_var('paged') ),
//     'total' => $the_query->max_num_pages,
// 	'prev_text'    => __('← Previous'),
// 	'next_text'    => __('Next  →'),
// 	// 'type'  => 'list',
// ));

// $pagination  = str_replace("<ul class='page-numbers'>", '<ul class="pagination">', $pagination );
// $pagination  = str_replace('page-numbers', 'page-link', $pagination );
// $pagination  = str_replace('<li>', '<li class="page-item">', $pagination );
// $pagination  = str_replace(
// 	'<li class="page-item"><span aria-current="page" class="page-link current">',
// 	'<li class="page-item active"><span aria-current="page" class="page-link">',
// 	$pagination 
// );
// echo $pagination ;
