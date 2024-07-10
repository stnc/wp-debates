<?php



function kama_paginate_links_data( array $args ): array {
	//https://wp-kama.com/function/paginate_links
	global $wp_query;

	$args += [
		'total'        => 1,
		'current'      => 0,
		'url_base'     => '/{pagenum}',
		'first_url'    => '',
		'mid_size'     => 2,
		'end_size'     => 1,
		'show_all'     => false,
		'a_text_patt'  => '%s',
		'is_prev_next' => false,
		'prev_text'    => '« Previous',
		'next_text'    => 'Next »',
	];

	$rg = (object) $args;

	$total_pages = max( 1, (int) ( $rg->total ?: $wp_query->max_num_pages ) );

	if( $total_pages === 1 ){
		return [];
	}

	// fix working parameters

	$rg->total = $total_pages;
	$rg->current = max( 1, abs( $rg->current ?: get_query_var( 'paged', 1 ) ) );

	$rg->url_base = $rg->url_base ?: str_replace( PHP_INT_MAX, '{pagenum}', get_pagenum_link( PHP_INT_MAX ) );
	$rg->url_base = wp_normalize_path( $rg->url_base );

	if( ! $rg->first_url ){
		// /foo/page(d)/2 >>> /foo/ /foo?page(d)=2 >>> /foo/
		$rg->first_url = preg_replace( '~/paged?/{pagenum}/?|[?]paged?={pagenum}|/{pagenum}/?~', '', $rg->url_base );
		$rg->first_url = user_trailingslashit( $rg->first_url );
	}

	// core array

	if( $rg->show_all ){
		$active_nums = range( 1, $rg->total );
	}
	else {

		if( $rg->end_size > 1 ){
			$start_nums = range( 1, $rg->end_size );
			$end_nums = range( $rg->total - ($rg->end_size - 1), $rg->total );
		}
		else {
			$start_nums = [ 1 ];
			$end_nums = [ $rg->total ];
		}

		$from = $rg->current - $rg->mid_size;
		$to = $rg->current + $rg->mid_size;

		if( $from < 1 ){
			$to = min( $rg->total, $to + absint( $from ) );
			$from = 1;

		}
		if( $to > $rg->total ){
			$from = max( 1, $from - ($to - $rg->total) );
			$to = $rg->total;
		}

		$active_nums = array_merge( $start_nums, range( $from, $to ), $end_nums );
		$active_nums = array_unique( $active_nums );
		$active_nums = array_values( $active_nums ); // reset keys
	}

	// fill by core array

	$pages = [];

	if( 1 === count( $active_nums ) ){
		return $pages;
	}

	$item_data = static function( $num ) use ( $rg ){

		$data = [
			'is_current'   => false,
			'page_num'     => null,
			'url'          => null,
			'link_text'    => null,
			'is_prev_next' => false,
			'is_dots'      => false,
		];

		if( 'dots' === $num ){

			return (object) ( [
			   'is_dots' => true,
			   'link_text' => '…',
			] + $data );
		}

		$is_prev = 'prev' === $num && ( $num = max( 1, $rg->current - 1 ) );
		$is_next = 'next' === $num && ( $num = min( $rg->total, $rg->current + 1 ) );

		$data = [
			'is_current'   => ! ( $is_prev || $is_next ) && $num === $rg->current,
			'page_num'     => $num,
			'url'          => 1 === $num ? $rg->first_url : str_replace( '{pagenum}', $num, $rg->url_base ),
			'is_prev_next' => $is_prev || $is_next,
		] + $data;

		if( $is_prev ){
			$data['link_text'] = $rg->prev_text;
		}
		elseif( $is_next ) {
			$data['link_text'] = $rg->next_text;
		}
		else {
			$data['link_text'] = sprintf( $rg->a_text_patt, $num );
		}

		return (object) $data;
	};

	foreach( $active_nums as $indx => $num ){

		$pages[] = $item_data( $num );

		// set dots
		$next = $active_nums[ $indx + 1 ] ?? null;
		if( $next && ($num + 1) !== $next ){
			$pages[] = $item_data( 'dots' );
		}
	}

	if( $rg->is_prev_next ){
		$rg->current !== 1 && array_unshift( $pages, $item_data( 'prev' ) );
		$rg->current !== $rg->total && $pages[] = $item_data( 'next' );
	}

	return $pages;
}

