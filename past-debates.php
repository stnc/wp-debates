<?php get_header(); ?>





<div class="row">

    <div class="col-lg-3">

	<?php dynamic_sidebar('tvs-past-debates'); ?>
    </div>




    <div class="col-lg-9">
        <div id="content" role="main">

            <?php
	$args = array(
		// 'post_type'   => get_post_type(),
		'post_type'   => "debate",
		'post_status' => 'publish',
		// 'meta_key'    => 'event_start_date',
		'orderby'     => 'id',
	);

	$paged         = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	$args['paged'] = $paged;

	$event_query = new WP_Query( $args );
	?>

            <?php if ( $event_query->have_posts() ) : ?>
            <div class="page-events clearfix">
                <div class="row event-row archive-event-row">
                    <?php
				$event_count = 0;
				while ( $event_query->have_posts() ) {
					$event_count++;
					$event_query->the_post();
					?>
                    <div class="col-lg-12  col-md-12 offset-lg-0 offset-md-2 custom-sm-margin-bottom-1 p-b-lg">
                    











					<?php

global $porto_settings;

$post_layout     = 'medium';
$featured_images = porto_get_featured_images();

$post_class   = array();
$post_class[] = 'post post-' . $post_layout;
if ( isset( $porto_settings['post-title-style'] ) && 'without-icon' == $porto_settings['post-title-style'] ) {
	$post_class[] = 'post-title-simple';
}
$post_meta  = '';
$post_meta .= '<div class="post-meta ' . ( empty( $porto_settings['post-metas'] ) ? ' d-none' : '' ) . '">';

$post_meta .= '<ul>';
$post_meta .= '<li><a class="buttons"  href="">Details</a><


li>';
$post_meta .= '<li><a class="buttons"  href="">Transcript</a><li>';
$post_meta .= '<li><a class="buttons"  href="">Speakers</a><li>';
$post_meta .= '<li><a class="buttons"  href="">Opinion poll</a><li>';
$post_meta .= '</ul>';

	$post_meta .= '<span class="d-block float-sm-end mt-3 mt-sm-0"><a class="btn btn-xs btn-default text-xs text-uppercase" href="' . esc_url( apply_filters( 'the_permalink', get_permalink() ) ) . '">' . esc_html__( 'Read more...', 'porto' ) . '</a></span>';
$post_meta     .= '</div>';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<!-- Post meta before content -->
	<?php
	if ( isset( $porto_settings['post-meta-position'] ) && 'before' === $porto_settings['post-meta-position'] ) {
		echo '<div class="row"><div class="col-12">' . porto_filter_output( $post_meta ) . '</div></div>';}
	?>
	<div class="row">
	<?php if ( count( $featured_images ) ) : ?>
		<div class="col-lg-5">
			<?php
				// Post Slideshow
				$slideshow_type = get_post_meta( get_the_ID(), 'slideshow_type', true );

			if ( ! $slideshow_type ) {
				$slideshow_type = 'images';
			}
				porto_get_template_part(
					'views/posts/post-media/' . sanitize_file_name( $slideshow_type ),
					null,
					( 'images' == $slideshow_type ? array(
						'image_size' => 'blog-medium',
					) : false )
				);
			?>
		</div>
		<div class="col-lg-7">
	<?php else : ?>
		<div class="col-lg-12">
	<?php endif; ?>

			<div class="post-content">

				<?php
				if ( is_sticky() && is_home() && ! is_paged() ) {
					printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'porto' ) );
				}
				?>

				<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

				<?php
				porto_render_rich_snippets( false );
				if ( ! empty( $porto_settings['blog-excerpt'] ) ) {
					echo porto_get_excerpt( $porto_settings['blog-excerpt-length'], false );
				} else {
					echo '<div class="entry-content">';
					porto_the_content();
					wp_link_pages(
						array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'porto' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'porto' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						)
					);
					echo '</div>';
				}
				?>

			</div>
		</div>
	</div>

	<!-- Post meta after content -->
	<?php
	if ( isset( $porto_settings['post-meta-position'] ) && 'before' !== $porto_settings['post-meta-position'] ) {
		echo porto_filter_output( $post_meta );}
	?>

</article>
























                    </div>
                    <?php
					if ( 0 === $event_count % 2 && ( $event_query->current_post + 1 ) != ( $event_query->post_count ) ) {
						echo '</div><div class="row event-row archive-event-row">';
					}
				}
				?>
                </div>
                <?php porto_pagination(); ?>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php else : ?>
            <p><?php esc_html_e( 'Apologies, but no results were found for the requested archive.', 'porto' ); ?></p>
            <?php endif; ?>
        </div>


    </div>
</div>




<?php get_footer(); ?>