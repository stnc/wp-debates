<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

require_once( PORTO_FUNCTIONS . '/layout/header.php' );
require_once( PORTO_FUNCTIONS . '/layout/breadcrumbs.php' );
require_once( PORTO_FUNCTIONS . '/layout/page-title.php' );
require_once( PORTO_FUNCTIONS . '/layout/footer.php' );

add_action( 'wp_head', 'porto_nofollow_block', 0 );
add_action( 'wp_head', 'porto_head_metas', 5 );

function porto_logo( $sticky_logo = false, $el_class = '' ) {
	global $porto_settings;

	ob_start();

	if ( isset( $porto_settings['logo-overlay'] ) && $porto_settings['logo-overlay'] && $porto_settings['logo-overlay']['url'] ) :
		$logo       = $porto_settings['logo-overlay']['url'];
		$logo_width = $porto_settings['logo-overlay-width'] ? $porto_settings['logo-overlay-width'] : 250;
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" class="overlay-logo<?php echo ! $el_class ? '' : ' ' . esc_attr( $el_class ); ?>">
			<?php
			echo '<img class="img-responsive" src="' . esc_url( str_replace( array( 'http:', 'https:' ), '', $logo ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" style="max-width:' . esc_attr( $logo_width ) . 'px;" />';
			?>
		</a>
		<?php
	endif;
		?>

	<div class="logo<?php echo ! $el_class ? '' : ' ' . esc_attr( $el_class ); ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" <?php echo ! $sticky_logo ? ' rel="home"' : ''; ?>>
		<?php
		if ( $porto_settings['logo'] && $porto_settings['logo']['url'] ) {
			$logo_width  = '';
			$logo_height = '';
			$logo        = $porto_settings['logo']['url'];
			if ( $sticky_logo && ! empty( $porto_settings['sticky-logo'] ) && $porto_settings['sticky-logo']['url'] ) {
				$logo = $porto_settings['sticky-logo']['url'];
			}
			if ( isset( $porto_settings['logo-retina-width'] ) && isset( $porto_settings['logo-retina-height'] ) && $porto_settings['logo-retina-width'] && $porto_settings['logo-retina-height'] ) {
				$logo_width  = (int) $porto_settings['logo-retina-width'];
				$logo_height = (int) $porto_settings['logo-retina-height'];
			}

			// sticky logo
			if ( ! $sticky_logo && isset( $porto_settings['sticky-logo-retina'] ) && $porto_settings['sticky-logo-retina'] && $porto_settings['sticky-logo-retina']['url'] ) {
				$sticky_retina_logo_src = $porto_settings['sticky-logo-retina']['url'];
			}
			if ( ! $sticky_logo && ! empty( $porto_settings['sticky-logo'] ) && $porto_settings['sticky-logo']['url'] ) {
				$sticky_logo_src = $porto_settings['sticky-logo']['url'];
				echo '<img class="img-responsive sticky-logo' . ( ! isset( $sticky_retina_logo_src ) || ! $sticky_retina_logo_src || $sticky_retina_logo_src == $sticky_logo_src ? ' sticky-retina-logo' : '' ) . '"' . ( $logo_width ? ' width="' . $logo_width . '"' : '' ) . ( $logo_height ? ' height="' . $logo_height . '"' : '' ) . ' src="' . esc_url( str_replace( array( 'http:', 'https:' ), '', $sticky_logo_src ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';
			}
			if ( isset( $sticky_retina_logo_src ) && $sticky_retina_logo_src && $sticky_retina_logo_src != $sticky_logo_src ) {
				echo '<img class="img-responsive sticky-retina-logo"' . ( $logo_width ? ' width="' . $logo_width . '"' : '' ) . ( $logo_height ? ' height="' . $logo_height . '"' : '' ) . ' src="' . esc_url( str_replace( array( 'http:', 'https:' ), '', $sticky_retina_logo_src ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" style="max-height:' . $logo_height . 'px;" />';
			}

			// default logo
			$retina_logo = '';
			if ( isset( $porto_settings['logo-retina'] ) && $porto_settings['logo-retina'] && $porto_settings['logo-retina']['url'] ) {
				$retina_logo = $porto_settings['logo-retina']['url'];
			}
			if ( $sticky_logo && isset( $porto_settings['sticky-logo-retina'] ) && $porto_settings['sticky-logo-retina'] && $porto_settings['sticky-logo-retina']['url'] ) {
				$retina_logo = $porto_settings['sticky-logo-retina']['url'];
			}

			$standard_logo_width  = $logo_width;
			$standard_logo_height = $logo_height;
			if ( ! $standard_logo_width && ! $standard_logo_height && ! $sticky_logo ) {
				if ( ! empty( $porto_settings['logo']['width'] ) ) {
					$standard_logo_width = (int) $porto_settings['logo']['width'];
				}
				if ( ! empty( $porto_settings['logo']['height'] ) ) {
					$standard_logo_height = (int) $porto_settings['logo']['height'];
				}

				if ( $retina_logo && $retina_logo != $logo ) {
					if ( ! empty( $porto_settings['logo-retina']['width'] ) ) {
						$logo_width = (int) $porto_settings['logo-retina']['width'];
					}
					if ( ! empty( $porto_settings['logo-retina']['height'] ) ) {
						$logo_height = (int) $porto_settings['logo-retina']['height'];
					}
				}
			}

			echo '<img class="img-responsive standard-logo' . ( ! $retina_logo || $retina_logo == $logo ? ' retina-logo' : '' ) . '"' . ( $standard_logo_width ? ' width="' . $standard_logo_width . '"' : '' ) . ( $standard_logo_height ? ' height="' . $standard_logo_height . '"' : '' ) . ' src="' . esc_url( str_replace( array( 'http:', 'https:' ), '', $logo ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />';

			if ( $retina_logo && $retina_logo != $logo ) {
				echo '<img class="img-responsive retina-logo"' . ( $logo_width ? ' width="' . $logo_width . '"' : '' ) . ( $logo_height ? ' height="' . $logo_height . '"' : '' ) . ' src="' . esc_url( str_replace( array( 'http:', 'https:' ), '', $retina_logo ) ) . '" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '"' . ( $logo_height ? ' style="max-height:' . $logo_height . 'px;"' : '' ) . ' />';
			}
		} else {
			?>
			<span class="logo-text"><?php echo do_shortcode( isset( $porto_settings['logo-text'] ) && $porto_settings['logo-text'] ? $porto_settings['logo-text'] : get_bloginfo( 'name', 'display' ) ); ?></span>
			<?php
		}
		?>
	</a>
	</div>
	<?php
		return apply_filters( 'porto_logo', ob_get_clean() );
}

function porto_banner( $banner_class = '' ) {
	global $porto_settings, $post;

	$banner_type   = porto_get_meta_value( 'banner_type' );
	$master_slider = porto_get_meta_value( 'master_slider' );
	$rev_slider    = porto_get_meta_value( 'rev_slider' );
	$banner_block  = porto_get_meta_value( 'banner_block' );
	$banner_block_tracking = 'meta-banner_block';
	if ( is_array( $banner_block ) ) {
		$banner_block_tracking = $banner_block[1];
		$banner_block = $banner_block[0];
	}
	if ( is_object( $post ) ) {

		// portfolio single banner
		$portfolio_single_banner_image = get_post_meta( $post->ID, 'portfolio_archive_image', true );
		$portfolio_images_count        = count( porto_get_featured_images() );

		$banner_class .= ( porto_get_wrapper_type() != 'boxed' && 'boxed' == $porto_settings['banner-wrapper'] ) ? ' banner-wrapper-boxed' : '';

		$post_types = array( 'post', 'portfolio', 'member', 'event' );
		foreach ( $post_types as $post_type ) {
			if ( is_singular( $post_type ) ) {
				if ( $portfolio_single_banner_image ) {
					wp_enqueue_script( 'skrollr' );
					?>
					<div class="banner-container">
						<section class="portfolio-parallax parallax section section-text-light section-parallax hidden-plus m-none image-height" data-plugin-parallax data-plugin-options='{"speed": 1.5}' data-image-src="<?php echo wp_get_attachment_url( $portfolio_single_banner_image ); ?>">
							<div class="container-fluid">
								<h2><?php the_title(); ?></h2>
								<?php if ( ! empty( $porto_settings['portfolio-image-count'] ) ) : ?>
								<span class="thumb-info-icons position-style-3 text-color-light">
									<span class="thumb-info-icon pictures background-color-primary">
										<?php echo porto_filter_output( $portfolio_images_count ); ?>
										<i class="far fa-image"></i>
									</span>
								</span>
								<?php endif; ?>
							</div>
						</section>
					</div>
					<style>h2.shorter{display: none;}</style>
					<?php
				} elseif ( isset( $porto_settings[ $post_type . '-banner-block' ] ) && $porto_settings[ $post_type . '-banner-block' ] ) {
					?>
					<div class="banner-container">
						<div id="banner-wrapper" class="<?php echo esc_attr( $banner_class ); ?>">
							<?php echo do_shortcode( '[porto_block name="' . esc_attr( $porto_settings[ $post_type . '-banner-block' ] ) . '" tracking="option-' . $post_type . '-banner-block"]' ); ?>
						</div>
					</div>
					<?php
				}
			}
		}
	}

	if ( 'master_slider' === $banner_type && isset( $master_slider ) ) {
		?>
		<div class="banner-container">
			<div id="banner-wrapper" class="<?php echo esc_attr( $banner_class ); ?>">
				<?php echo do_shortcode( '[masterslider id="' . esc_attr( $master_slider ) . '"]' ); ?>
			</div>
		</div>
	<?php } elseif ( 'rev_slider' === $banner_type && isset( $rev_slider ) && class_exists( 'RevSlider' ) ) { ?>
		<div class="banner-container">
			<div id="banner-wrapper" class="<?php echo esc_attr( $banner_class ); ?>">
				<?php putRevSlider( $rev_slider ); ?>
			</div>
		</div>
	<?php } elseif ( 'banner_block' === $banner_type && isset( $banner_block ) ) { ?>
		<div class="banner-container my-banner">
			<div id="banner-wrapper" class="<?php echo esc_attr( $banner_class ); ?>">
				<?php echo do_shortcode( '[porto_block name="' . $banner_block . '" tracking="' . $banner_block_tracking . '"]' ); ?>
			</div>
		</div>
		<?php
	}

}

function porto_currency_switcher( $el_class = '' ) {
	global $porto_settings;

	if ( empty( $porto_settings['wcml-switcher-html'] ) && ! has_nav_menu( 'currency_switcher' ) && ( porto_is_elementor_preview() || porto_vc_is_inline() ) ) {
		echo sprintf( esc_html__( '%1$sEnable%2$sTheme Options->Header->Currency Switcher%3$s%4$s', 'porto' ), '<span>', '<a class="ps-1 porto-setting-link" href="' . porto_get_theme_option_url( 'wcml-switcher-html' ) . '" target="_blank">', '</a>', '</span>' );
		return;
	}
	$menu_class = 'currency-switcher porto-view-switcher mega-menu show-arrow';
	if ( $el_class ) {
		$menu_class .= ' ' . esc_attr( trim( $el_class ) );
	}
	ob_start();
	if ( ! $porto_settings['wcml-switcher'] && has_nav_menu( 'currency_switcher' ) ) :
		wp_nav_menu(
			array(
				'theme_location' => 'currency_switcher',
				'container'      => '',
				'menu_class'     => $menu_class,
				'before'         => '',
				'after'          => '',
				'depth'          => 2,
				'link_before'    => '',
				'link_after'     => '',
				'fallback_cb'    => false,
				'walker'         => new porto_top_navwalker(),
			)
		);
	endif;

	if ( $porto_settings['wcml-switcher'] && '' == $porto_settings['wcml-switcher-pos'] ) {
		if ( class_exists( 'WOOCS' ) ) {
			global $WOOCS;
			$currencies       = $WOOCS->get_currencies();
			$current_currency = $WOOCS->current_currency;

			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				$label = ( $currency['flag'] ? '<span class="flag"><img src="' . esc_url( $currency['flag'] ) . '" height="12" alt="' . esc_attr( $currency['name'] ) . '" width="18" /></span>' : '' ) . esc_html( $currency['name'] . ' ' . $currency['symbol'] );
				if ( $currency['name'] == $current_currency ) {
					$active_c .= $label;
				} else {
					$other_c .= '<li rel="' . esc_attr( $currency['name'] ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $label ) . '</a></li>';
				}
			}
			?>
			<ul id="menu-currency-switcher" class="<?php echo esc_attr( $menu_class ); ?>">
				<li class="menu-item<?php echo ! $other_c ? '' : ' has-sub'; ?> narrow">
					<a class="nolink" href="#"><?php echo wp_kses_post( $active_c ); ?></a>
					<?php if ( $other_c ) : ?>
						<div class="popup">
							<div class="inner">
								<ul class="sub-menu woocs-switcher">
									<?php echo porto_filter_output( $other_c ); ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
				</li>
			</ul>
			<?php
		} elseif ( class_exists( 'WCML_Multi_Currency' ) ) {
			global $sitepress, $woocommerce_wpml;
            if ( ! empty( $sitepress ) ) {
				$current_language = $sitepress->get_current_language();
			} else {
				$current_language = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '';
			}
			$settings      = $woocommerce_wpml->get_settings();
			$format        = '%symbol% %code%';
			$wc_currencies = get_woocommerce_currencies();
			if ( ! isset( $settings['currencies_order'] ) ) {
				if ( ! empty( $woocommerce_wpml->multi_currency ) ) {
					$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
				} else {
					$currencies = array();
				}
			} else {
				$currencies = $settings['currencies_order'];
			}
			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				if ( $currency && $current_language && 1 == $woocommerce_wpml->settings['currency_options'][ $currency ]['languages'][ $current_language ] && $woocommerce_wpml->multi_currency ) {
					$selected        = $currency == $woocommerce_wpml->multi_currency->get_client_currency() ? ' selected="selected"' : '';
					$currency_format = preg_replace(
						array( '#%name%#', '#%symbol%#', '#%code%#' ),
						array( $wc_currencies[ $currency ], get_woocommerce_currency_symbol( $currency ), $currency ),
						$format
					);

					if ( $selected ) {
						$active_c .= $currency_format;
					} else {
						$other_c .= '<li rel="' . esc_attr( $currency ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $currency_format ) . '</a></li>';
					}
				}
			}
			?>
			<ul id="menu-currency-switcher" class="<?php echo esc_attr( $menu_class ); ?>">
				<li class="menu-item<?php echo ! $other_c ? '' : ' has-sub'; ?> narrow">
					<a class="nolink" href="#"><?php echo wp_kses_post( $active_c ); ?></a>
					<?php if ( $other_c ) : ?>
						<div class="popup">
							<div class="inner">
								<ul class="sub-menu wcml-switcher">
									<?php echo porto_filter_output( $other_c ); ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
				</li>
			</ul>
			<?php
		}
	}

	$result = str_replace( '&nbsp;', '', ob_get_clean() );
	if ( ! $result && ! empty( $porto_settings['wcml-switcher-html'] ) ) {
		$result = '<ul id="menu-currency-switcher" class="' . $menu_class . '">
					<li class="menu-item has-sub narrow">
						<a class="nolink" href="#">USD</a>
						<div class="popup">
							<div class="inner">
								<ul class="sub-menu wcml-switcher">
									<li class="menu-item"><a href="#">USD</a></li>
									<li class="menu-item"><a href="#">EUR</a></li>
								</ul>
							</div>
						</div>
					</li>
				</ul>';
	}
	return apply_filters( 'porto_currency_switcher', $result );
}

function porto_mobile_currency_switcher( $is_mobile_menu = false ) {
	global $porto_settings;

	$menu_class = $is_mobile_menu ? 'mobile-menu' : 'porto-view-switcher';

	ob_start();
	if ( ! $porto_settings['wcml-switcher'] && has_nav_menu( 'currency_switcher' ) ) :
		wp_nav_menu(
			array(
				'theme_location' => 'currency_switcher',
				'container'      => '',
				'menu_class'     => $menu_class . ' currency-switcher accordion-menu show-arrow',
				'before'         => '',
				'after'          => '',
				'depth'          => 2,
				'link_before'    => '',
				'link_after'     => '',
				'fallback_cb'    => false,
				'walker'         => new porto_accordion_navwalker(),
			)
		);
	endif;

	if ( $porto_settings['wcml-switcher'] && class_exists( 'WOOCS' ) ) {
		global $WOOCS;
		$currencies       = $WOOCS->get_currencies();
		$current_currency = $WOOCS->current_currency;

		$active_c = '';
		$other_c  = '';

		foreach ( $currencies as $currency ) {
			$label = ( $currency['flag'] ? '<span class="flag"><img src="' . esc_url( $currency['flag'] ) . '" height="12" alt="' . esc_attr( $currency['name'] ) . '" width="18" /></span>' : '' ) . esc_html( $currency['name'] . ' ' . $currency['symbol'] );
			if ( $currency['name'] == $current_currency ) {
				$active_c .= $label;
			} else {
				$other_c .= '<li rel="' . esc_attr( $currency['name'] ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $label ) . '</a></li>';
			}
		}
		?>
		<ul id="menu-currency-switcher-mobile" class="<?php echo esc_attr( $menu_class ); ?> currency-switcher accordion-menu show-arrow">
			<li class="menu-item<?php echo ! $other_c ? '' : ' has-sub'; ?> narrow">
				<a class="nolink" href="#"><?php echo wp_kses_post( $active_c ); ?></a>

				<?php if ( $other_c ) : ?>
					<span class="arrow"></span>
					<ul class="sub-menu woocs-switcher">
						<?php echo porto_filter_output( $other_c ); ?>
					</ul>
				<?php endif; ?>
			</li>
		</ul>
		<?php
	} elseif ( $porto_settings['wcml-switcher'] && class_exists( 'WCML_Multi_Currency' ) ) {
		global $sitepress, $woocommerce_wpml;
		if ( ! empty( $sitepress ) ) {
			$current_language = $sitepress->get_current_language();
		} else {
			$current_language = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '';
		}
		$settings      = $woocommerce_wpml->get_settings();
		$format        = '%symbol% %code%';
		$wc_currencies = get_woocommerce_currencies();
		if ( ! isset( $settings['currencies_order'] ) ) {
			if ( ! empty( $woocommerce_wpml->multi_currency ) ) {
				$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
			} else {
				$currencies = array();
			}
		} else {
			$currencies = $settings['currencies_order'];
		}
		$active_c = '';
		$other_c  = '';

		foreach ( $currencies as $currency ) {
			if ( isset( $woocommerce_wpml->settings['currency_options'][ $currency ] ) && 1 == $woocommerce_wpml->settings['currency_options'][ $currency ]['languages'][ $current_language ] && $woocommerce_wpml->multi_currency ) {
				$selected        = $currency == $woocommerce_wpml->multi_currency->get_client_currency() ? ' selected="selected"' : '';
				$currency_format = preg_replace(
					array( '#%name%#', '#%symbol%#', '#%code%#' ),
					array( $wc_currencies[ $currency ], get_woocommerce_currency_symbol( $currency ), $currency ),
					$format
				);

				if ( $selected ) {
					$active_c .= $currency_format;
				} else {
					$other_c .= '<li rel="' . esc_attr( $currency ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $currency_format ) . '</a></li>';
				}
			}
		}
		?>
		<ul id="menu-currency-switcher-mobile" class="<?php echo esc_attr( $menu_class ); ?> currency-switcher accordion-menu show-arrow">
			<li class="menu-item<?php echo ! $other_c ? '' : ' has-sub'; ?> narrow">
				<a class="nolink" href="#"><?php echo wp_kses_post( $active_c ); ?></a>
				<?php if ( $other_c ) : ?>
					<span class="arrow"></span>
					<ul class="sub-menu wcml-switcher">
						<?php echo porto_filter_output( $other_c ); ?>
					</ul>
				<?php endif; ?>
			</li>
		</ul>
		<?php
	}

	$result = str_replace( '&nbsp;', '', ob_get_clean() );
	if ( ! $result && ! empty( $porto_settings['wcml-switcher-html'] ) ) {
		$result = '<ul id="menu-currency-switcher-mobile" class="' . $menu_class . ' currency-switcher accordion-menu show-arrow">
			<li class="menu-item has-sub narrow">
				<a class="nolink" href="#">USD</a>
				<span class="arrow"></span>
				<ul class="sub-menu wcml-switcher">
					<li class="menu-item"><a href="#">USD</a></li>
					<li class="menu-item"><a href="#">EUR</a></li>
				</ul>
			</li>
		</ul>';
	}

	return apply_filters( 'porto_mobile_currency_switcher', $result );
}

function porto_view_switcher( $el_class = '' ) {
	global $porto_settings;
	if ( empty( $porto_settings['wpml-switcher-html'] ) && ! has_nav_menu( 'view_switcher' ) && ( porto_is_elementor_preview() || porto_vc_is_inline() ) ) {
		echo sprintf( esc_html__( '%1$sEnable%2$sTheme Options->Header->Language Switcher%3$s%4$s', 'porto' ), '<span>', '<a class="ps-1 porto-setting-link" href="' . porto_get_theme_option_url( 'wpml-switcher-html' ) . '" target="_blank">', '</a>', '</span>' );
		return;
	}
	$menu_class = 'view-switcher porto-view-switcher mega-menu show-arrow';
	if ( $el_class ) {
		$menu_class .= ' ' . esc_attr( trim( $el_class ) );
	}

	ob_start();
	if ( ! $porto_settings['wpml-switcher'] && has_nav_menu( 'view_switcher' ) ) :
		wp_nav_menu(
			array(
				'theme_location' => 'view_switcher',
				'container'      => '',
				'menu_class'     => $menu_class,
				'before'         => '',
				'after'          => '',
				'depth'          => 2,
				'link_before'    => '',
				'link_after'     => '',
				'fallback_cb'    => false,
				'walker'         => new porto_top_navwalker(),
			)
		);
	endif;

	if ( $porto_settings['wpml-switcher'] && '' == $porto_settings['wpml-switcher-pos'] ) {
		$languages = porto_icl_get_languages();
		if ( ! empty( $languages ) ) {
			$active_lang = '';
			$other_langs = '';
			foreach ( $languages as $l ) {
				if ( ! $l['active'] ) {
					$other_langs .= '<li class="menu-item"><a href="' . esc_url( $l['url'] ) . '">';
				}
				if ( $l['country_flag_url'] ) {
					if ( $l['active'] ) {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					} else {
						$other_langs .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					}
				}
				if ( $l['active'] ) {
					$active_lang .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				} else {
					$other_langs .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				}
				if ( ! $l['active'] ) {
					$other_langs .= '</a></li>';
				}
			}
			?>
			<ul class="<?php echo esc_attr( $menu_class ); ?>">
				<li class="menu-item<?php echo ! $other_langs ? '' : ' has-sub'; ?> narrow">
					<a class="nolink" href="#"><?php echo wp_kses_post( $active_lang ); ?></a>
					<?php if ( $other_langs ) : ?>
						<div class="popup">
							<div class="inner">
								<ul class="sub-menu">
									<?php echo wp_kses_post( $other_langs ); ?>
								</ul>
							</div>
						</div>
					<?php endif; ?>
				</li>
			</ul>
			<?php
		} elseif ( function_exists( 'qtranxf_getSortedLanguages' ) ) {
			global $q_config;

			$languages     = qtranxf_getSortedLanguages();
			$flag_location = qtranxf_flag_location();
			if ( is_404() ) {
				$url = esc_url( home_url() );
			} else {
				$url = '';
			}

			if ( ! empty( $languages ) ) {
				$active_lang = '';
				$other_langs = '';
				foreach ( $languages as $language ) {
					if ( $language != $q_config['language'] ) {
						$other_langs .= '<li class="menu-item"><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '">';
						$other_langs .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$other_langs .= $q_config['language_name'][ $language ];
						$other_langs .= '</a></li>';
					} else {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$active_lang .= $q_config['language_name'][ $language ];
					}
				}
				?>
				<ul class="<?php echo esc_attr( $menu_class ); ?>">
					<li class="menu-item<?php echo ! $other_langs ? '' : ' has-sub'; ?> narrow">
						<a class="nolink" href="#"><?php echo wp_kses_post( $active_lang ); ?></a>
						<?php if ( $other_langs ) : ?>
							<div class="popup">
								<div class="inner">
									<ul class="sub-menu">
										<?php echo wp_kses_post( $other_langs ); ?>
									</ul>
								</div>
							</div>
						<?php endif; ?>
					</li>
				</ul>
				<?php
			}
		}
	}

	$result = str_replace( '&nbsp;', '', ob_get_clean() );
	if ( ! $result && ! empty( $porto_settings['wpml-switcher-html'] ) ) {
		$result = '<ul class="' . $menu_class . '">
					<li class="menu-item has-sub narrow">
						<a class="nolink" href="#"><i class="flag-us"></i>Eng</a>
						<div class="popup">
							<div class="inner">
								<ul class="sub-menu">
									<li class="menu-item"><a href="#"><i class="flag-us"></i>Eng</a></li>
									<li class="menu-item"><a href="#"><i class="flag-fr"></i>Frh</a></li>
								</ul>
							</div>
						</div>
					</li>
				</ul>';
	}

	return apply_filters( 'porto_view_switcher', $result );
}

function porto_mobile_view_switcher( $is_mobile_menu = false ) {
	global $porto_settings;

	$menu_class = $is_mobile_menu ? 'mobile-menu' : 'porto-view-switcher';
	ob_start();
	if ( ! $porto_settings['wpml-switcher'] && has_nav_menu( 'view_switcher' ) ) :
		wp_nav_menu(
			array(
				'theme_location' => 'view_switcher',
				'container'      => '',
				'menu_class'     => $menu_class . ' view-switcher accordion-menu show-arrow',
				'before'         => '',
				'after'          => '',
				'depth'          => 2,
				'link_before'    => '',
				'link_after'     => '',
				'fallback_cb'    => false,
				'walker'         => new porto_accordion_navwalker(),
			)
		);
	endif;

	if ( $porto_settings['wpml-switcher'] ) {
		$languages = porto_icl_get_languages();
		if ( ! empty( $languages ) ) {
			$active_lang = '';
			$other_langs = '';
			foreach ( $languages as $l ) {
				if ( ! $l['active'] ) {
					$other_langs .= '<li class="menu-item"><a href="' . esc_url( $l['url'] ) . '">';
				}
				if ( $l['country_flag_url'] ) {
					if ( $l['active'] ) {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					} else {
						$other_langs .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					}
				}
				if ( $l['active'] ) {
					$active_lang .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				} else {
					$other_langs .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				}
				if ( ! $l['active'] ) {
					$other_langs .= '</a></li>';
				}
			}
			?>
			<ul class="<?php echo esc_attr( $menu_class ); ?> view-switcher accordion-menu show-arrow">
				<li class="menu-item<?php echo ! $other_langs ? '' : ' has-sub'; ?> narrow">
					<a class="nolink" href="#"><?php echo wp_kses_post( $active_lang ); ?></a>
					<?php if ( $other_langs ) : ?>
						<span class="arrow"></span>
						<ul class="sub-menu">
							<?php echo wp_kses_post( $other_langs ); ?>
						</ul>
					<?php endif; ?>
				</li>
			</ul>
			<?php
		} elseif ( function_exists( 'qtranxf_getSortedLanguages' ) ) {
			global $q_config;

			$languages     = qtranxf_getSortedLanguages();
			$flag_location = qtranxf_flag_location();
			if ( is_404() ) {
				$url = esc_url( home_url() );
			} else {
				$url = '';
			}

			if ( ! empty( $languages ) ) {
				$active_lang = '';
				$other_langs = '';
				foreach ( $languages as $language ) {
					if ( $language != $q_config['language'] ) {
						$other_langs .= '<li class="menu-item"><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '">';
						$other_langs .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$other_langs .= $q_config['language_name'][ $language ];
						$other_langs .= '</a></li>';
					} else {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$active_lang .= $q_config['language_name'][ $language ];
					}
				}
				?>
				<ul class="<?php echo esc_attr( $menu_class ); ?> view-switcher accordion-menu show-arrow">
					<li class="menu-item<?php echo ! $other_langs ? '' : ' has-sub'; ?> narrow">
						<a class="nolink" href="#"><?php echo wp_kses_post( $active_lang ); ?></a>
						<?php if ( $other_langs ) : ?>
							<span class="arrow"></span>
							<ul class="sub-menu">
								<?php echo wp_kses_post( $other_langs ); ?>
							</ul>
						<?php endif; ?>
					</li>
				</ul>
				<?php
			}
		}
	}

	$result = str_replace( '&nbsp;', '', ob_get_clean() );
	if ( ! $result && ! empty( $porto_settings['wpml-switcher-html'] ) ) {
		$result = '<ul class="' . $menu_class . ' view-switcher accordion-menu show-arrow">
					<li class="menu-item has-sub narrow">
						<a class="nolink" href="#"><i class="flag-us"></i>English</a>
						<span class="arrow"></span>
						<ul class="sub-menu">
							<li class="menu-item"><a href="#"><i class="flag-us"></i>English</a></li>
							<li class="menu-item"><a href="#"><i class="flag-fr"></i>French</a></li>
						</ul>
					</li>
				</ul>';
	}

	return apply_filters( 'porto_mobile_view_switcher', $result );
}

function porto_top_navigation( $el_class = '' ) {
	global $porto_settings;

	$html = '';

	// show language switcher
	if ( $porto_settings['wpml-switcher'] && 'top_nav' == $porto_settings['wpml-switcher-pos'] ) {
		$languages = porto_icl_get_languages();
		if ( ! empty( $languages ) ) {
			$active_lang = '';
			$other_langs = '';
			foreach ( $languages as $l ) {
				if ( ! $l['active'] ) {
					$other_langs .= '<li class="menu-item"><a href="' . esc_url( $l['url'] ) . '">';
				}
				if ( $l['country_flag_url'] ) {
					if ( $l['active'] ) {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					} else {
						$other_langs .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					}
				}
				if ( $l['active'] ) {
					$active_lang .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				} else {
					$other_langs .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				}
				if ( ! $l['active'] ) {
					$other_langs .= '</a></li>';
				}
			}
			$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_lang . '</a>';
			if ( $other_langs ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
				$html .= $other_langs;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		} elseif ( function_exists( 'qtranxf_getSortedLanguages' ) ) {
			global $q_config;

			$languages     = qtranxf_getSortedLanguages();
			$flag_location = qtranxf_flag_location();
			if ( is_404() ) {
				$url = esc_url( home_url() );
			} else {
				$url = '';
			}

			if ( ! empty( $languages ) ) {
				$active_lang = '';
				$other_langs = '';
				foreach ( $languages as $language ) {
					if ( $language != $q_config['language'] ) {
						$other_langs .= '<li class="menu-item"><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '">';
						$other_langs .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$other_langs .= $q_config['language_name'][ $language ];
						$other_langs .= '</a></li>';
					} else {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$active_lang .= $q_config['language_name'][ $language ];
					}
				}
				$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
				$html .= '<a class="nolink" href="#">' . $active_lang . '</a>';
				if ( $other_langs ) {
					$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
					$html .= $other_langs;
					$html .= '</ul></div></div>';
				}
				$html .= '</li>';
			}
		}
	}

	// show currency switcher
	if ( $porto_settings['wcml-switcher'] && 'top_nav' == $porto_settings['wcml-switcher-pos'] ) {
		if ( class_exists( 'WOOCS' ) ) {
			global $WOOCS;
			$currencies       = $WOOCS->get_currencies();
			$current_currency = $WOOCS->current_currency;

			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				$label = ( $currency['flag'] ? '<span class="flag"><img src="' . esc_url( $currency['flag'] ) . '" height="12" alt="' . esc_attr( $currency['name'] ) . '" width="18" /></span>' : '' ) . esc_html( $currency['name'] ) . ' ' . esc_html( $currency['symbol'] );
				if ( $currency['name'] == $current_currency ) {
					$active_c .= $label;
				} else {
					$other_c .= '<li rel="' . esc_attr( $currency['name'] ) . '" class="menu-item"><a class="nolink" href="#">' . $label . '</a></li>';
				}
			}
			$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_c . '</a>';
			if ( $other_c ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
				$html .= $other_c;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		} elseif ( class_exists( 'WCML_Multi_Currency' ) ) {
			global $sitepress, $woocommerce_wpml;
			if ( ! empty( $sitepress ) ) {
				$current_language = $sitepress->get_current_language();
			} else {
				$current_language = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '';
			}
			$settings      = $woocommerce_wpml->get_settings();
			$format        = '%symbol% %code%';
			$wc_currencies = get_woocommerce_currencies();
			if ( ! isset( $settings['currencies_order'] ) ) {
				if ( ! empty( $woocommerce_wpml->multi_currency ) ) {
					$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
				} else {
					$currencies = array();
				}
			} else {
				$currencies = $settings['currencies_order'];
			}
			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				if ( 1 == $woocommerce_wpml->settings['currency_options'][ $currency ]['languages'][ $current_language ] && $woocommerce_wpml->multi_currency ) {
					$selected        = $currency == $woocommerce_wpml->multi_currency->get_client_currency() ? ' selected="selected"' : '';
					$currency_format = preg_replace(
						array( '#%name%#', '#%symbol%#', '#%code%#' ),
						array( $wc_currencies[ $currency ], get_woocommerce_currency_symbol( $currency ), $currency ),
						$format
					);

					if ( $selected ) {
						$active_c .= $currency_format;
					} else {
						$other_c .= '<li rel="' . esc_attr( $currency ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $currency_format ) . '</a></li>';
					}
				}
			}
			$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_c . '</a>';
			if ( $other_c ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
				$html .= $other_c;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		}
	}

	// show login/logout link
	if ( isset( $porto_settings['menu-login-pos'] ) && 'top_nav' == $porto_settings['menu-login-pos'] ) {
		if ( is_user_logged_in() ) {
			$logout_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
			} else {
				$logout_link = wp_logout_url( get_home_url() );
			}
			$html .= '<li class="menu-item"><a href="' . esc_url( $logout_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' : '';
			$html .= esc_html__( 'Log out', 'porto' ) . '</a></li>';
		} else {
			$login_link    = '';
			$register_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$login_link = wc_get_page_permalink( 'myaccount' );
				if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
					$register_link = wc_get_page_permalink( 'myaccount' );
				}
			} else {
				$login_link    = wp_login_url( get_home_url() );
				$active_signup = get_site_option( 'registration', 'none' );
				$active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
				if ( 'none' != $active_signup ) {
					$register_link = wp_registration_url( get_home_url() );
				}
			}
			$html .= '<li class="menu-item"><a class="porto-link-login" href="' . esc_url( $login_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user"></i>' : '';
			$html .= esc_html__( 'Log In', 'porto' ) . '</a></li>';
			if ( $register_link && isset( $porto_settings['menu-enable-register'] ) && $porto_settings['menu-enable-register'] ) {
				$html .= '<li class="menu-item"><a class="porto-link-register" href="' . esc_url( $register_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user-plus"></i>' : '';
				$html .= esc_html__( 'Register', 'porto' ) . '</a></li>';
			}
		}
	}

	ob_start();
	if ( has_nav_menu( 'top_nav' ) ) :
		wp_nav_menu(
			array(
				'theme_location' => 'top_nav',
				'container'      => '',
				'menu_class'     => 'top-links mega-menu' . ( $porto_settings['menu-arrow'] ? ' show-arrow' : '' ) . ( $el_class ? ' ' . esc_attr( trim( $el_class ) ) : '' ),
				'before'         => '',
				'after'          => '',
				'depth'          => 2,
				'link_before'    => '',
				'link_after'     => '',
				'fallback_cb'    => false,
				'walker'         => new porto_top_navwalker(),
			)
		);
	endif;

	$output = str_replace( '&nbsp;', '', ob_get_clean() );

	if ( $output && $html ) {
		$output = preg_replace( '/<\/ul>$/', $html . '</ul>', $output, 1 );
	} elseif ( ! $output && $html ) {
		$output = '<ul class="' . 'top-links mega-menu' . ( $porto_settings['menu-arrow'] ? ' show-arrow' : '' ) . '" id="menu-top-navigation">' . $html . '</ul>';
	}

	return apply_filters( 'porto_top_navigation', $output );
}

function porto_mobile_top_navigation( $is_mobile_menu = false ) {
	global $porto_settings;

	$html = '';
	if ( isset( $porto_settings['menu-login-pos'] ) && 'top_nav' == $porto_settings['menu-login-pos'] ) {
		if ( is_user_logged_in() ) {
			$logout_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
			} else {
				$logout_link = wp_logout_url( get_home_url() );
			}
			$html .= '<li class="menu-item"><a href="' . esc_url( $logout_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' : '';
			$html .= esc_html__( 'Log out', 'porto' ) . '</a></li>';
		} else {
			$login_link    = '';
			$register_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$login_link = wc_get_page_permalink( 'myaccount' );
				if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
					$register_link = wc_get_page_permalink( 'myaccount' );
				}
			} else {
				$login_link    = wp_login_url( get_home_url() );
				$active_signup = get_site_option( 'registration', 'none' );
				$active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
				if ( 'none' != $active_signup ) {
					$register_link = wp_registration_url( get_home_url() );
				}
			}
			$html .= '<li class="menu-item"><a class="porto-link-login" href="' . esc_url( $login_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user"></i>' : '';
			$html .= esc_html__( 'Log In', 'porto' ) . '</a></li>';
			if ( $register_link && isset( $porto_settings['menu-enable-register'] ) && $porto_settings['menu-enable-register'] ) {
				$html .= '<li class="menu-item"><a class="porto-link-register" href="' . esc_url( $register_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user-plus"></i>' : '';
				$html .= esc_html__( 'Register', 'porto' ) . '</a></li>';
			}
		}
	}

	ob_start();
	if ( has_nav_menu( 'top_nav' ) ) :
		wp_nav_menu(
			array(
				'theme_location' => 'top_nav',
				'container'      => '',
				'menu_class'     => ( $is_mobile_menu ? 'mobile-menu' : 'top-links' ) . ' accordion-menu' . ( $porto_settings['menu-arrow'] ? ' show-arrow' : '' ),
				'before'         => '',
				'after'          => '',
				'depth'          => 2,
				'link_before'    => '',
				'link_after'     => '',
				'fallback_cb'    => false,
				'walker'         => new porto_accordion_navwalker(),
			)
		);
	endif;

	$output = str_replace( '&nbsp;', '', ob_get_clean() );

	if ( $output && $html ) {
		$output = preg_replace( '/<\/ul>$/', $html . '</ul>', $output, 1 );
	} elseif ( ! $output && $html ) {
		$output = '<ul class="' . ( $is_mobile_menu ? 'mobile-menu' : 'top-links' ) . ' accordion-menu' . ( $porto_settings['menu-arrow'] ? ' show-arrow' : '' ) . '" id="menu-top-navigation-1">' . $html . '</ul>';
	}

	return apply_filters( 'porto_mobile_top_navigation', $output );
}

function porto_main_menu( $depth = 0, $el_class = '' ) {
	global $porto_settings, $porto_layout, $porto_settings_optimize;

	$header_type = porto_get_header_type();

	$is_home = false;

	if ( is_front_page() && is_home() ) {
		$is_home = true;
	} elseif ( is_front_page() ) {
		$is_home = true;
	}

	if ( ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type ) && in_array( $porto_layout, porto_options_sidebars() ) && $porto_settings['menu-sidebar'] ) {
		if ( $is_home || ( ! $is_home && ! $porto_settings['menu-sidebar-home'] ) ) {
			return '';
		}
	}

	$html = '';

	// show language switcher
	if ( $porto_settings['wpml-switcher'] && 'main_menu' == $porto_settings['wpml-switcher-pos'] ) {
		$languages = porto_icl_get_languages();
		if ( ! empty( $languages ) ) {
			$active_lang = '';
			$other_langs = '';
			foreach ( $languages as $l ) {
				if ( ! $l['active'] ) {
					$other_langs .= '<li class="menu-item"><a href="' . esc_url( $l['url'] ) . '">';
				}
				if ( $l['country_flag_url'] ) {
					if ( $l['active'] ) {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					} else {
						$other_langs .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					}
				}
				if ( $l['active'] ) {
					$active_lang .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				} else {
					$other_langs .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				}
				if ( ! $l['active'] ) {
					$other_langs .= '</a></li>';
				}
			}
			$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_lang . '</a>';
			if ( $other_langs && 1 !== $depth ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
				$html .= $other_langs;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		} elseif ( function_exists( 'qtranxf_getSortedLanguages' ) ) {
			global $q_config;

			$languages     = qtranxf_getSortedLanguages();
			$flag_location = qtranxf_flag_location();
			if ( is_404() ) {
				$url = esc_url( home_url() );
			} else {
				$url = '';
			}

			if ( ! empty( $languages ) ) {
				$active_lang = '';
				$other_langs = '';
				foreach ( $languages as $language ) {
					if ( $language != $q_config['language'] ) {
						$other_langs .= '<li class="menu-item"><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '">';
						$other_langs .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$other_langs .= $q_config['language_name'][ $language ];
						$other_langs .= '</a></li>';
					} else {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$active_lang .= esc_html( $q_config['language_name'][ $language ] );
					}
				}
				$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
				$html .= '<a class="nolink" href="#">' . $active_lang . '</a>';
				if ( $other_langs && 1 !== $depth ) {
					$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
					$html .= $other_langs;
					$html .= '</ul></div></div>';
				}
				$html .= '</li>';
			}
		}
	}

	// show currency switcher
	if ( $porto_settings['wcml-switcher'] && 'main_menu' == $porto_settings['wcml-switcher-pos'] ) {
		if ( class_exists( 'WOOCS' ) ) {
			global $WOOCS;
			$currencies       = $WOOCS->get_currencies();
			$current_currency = $WOOCS->current_currency;

			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				$label = ( $currency['flag'] ? '<span class="flag"><img src="' . esc_url( $currency['flag'] ) . '" height="12" alt="' . esc_attr( $currency['name'] ) . '" width="18" /></span>' : '' ) . esc_html( $currency['name'] . ' ' . $currency['symbol'] );
				if ( $currency['name'] == $current_currency ) {
					$active_c .= $label;
				} else {
					$other_c .= '<li rel="' . esc_attr( $currency['name'] ) . '" class="menu-item"><a class="nolink" href="#">' . $label . '</a></li>';
				}
			}
			$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_c . '</a>';
			if ( $other_c && 1 !== $depth ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
				$html .= $other_c;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		} elseif ( class_exists( 'WCML_Multi_Currency' ) ) {
			global $sitepress, $woocommerce_wpml;
			if ( ! empty( $sitepress ) ) {
				$current_language = $sitepress->get_current_language();
			} else {
				$current_language = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '';
			}
			$settings      = $woocommerce_wpml->get_settings();
			$format        = '%symbol% %code%';
			$wc_currencies = get_woocommerce_currencies();
			if ( ! isset( $settings['currencies_order'] ) && $woocommerce_wpml->multi_currency ) {
				$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
			} else {
				$currencies = $settings['currencies_order'];
			}
			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				if ( 1 == $woocommerce_wpml->settings['currency_options'][ $currency ]['languages'][ $current_language ] && $woocommerce_wpml->multi_currency ) {
					$selected        = $currency == $woocommerce_wpml->multi_currency->get_client_currency() ? ' selected="selected"' : '';
					$currency_format = preg_replace(
						array( '#%name%#', '#%symbol%#', '#%code%#' ),
						array( $wc_currencies[ $currency ], get_woocommerce_currency_symbol( $currency ), $currency ),
						$format
					);

					if ( $selected ) {
						$active_c .= $currency_format;
					} else {
						$other_c .= '<li rel="' . esc_attr( $currency ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $currency_format ) . '</a></li>';
					}
				}
			}
			$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_c . '</a>';
			if ( $other_c && 1 !== $depth ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
				$html .= $other_c;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		}
	}

	// show login/logout link
	if ( isset( $porto_settings['menu-login-pos'] ) && 'main_menu' == $porto_settings['menu-login-pos'] ) {
		if ( is_user_logged_in() ) {
			$logout_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
			} else {
				$logout_link = wp_logout_url( get_home_url() );
			}

			if ( ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type ) ) {
				$html .= '<li class="' . ( is_rtl() ? 'pull-left' : 'pull-right' ) . '"><div class="menu-custom-block"><a href="' . esc_url( $logout_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' : '';
				$html .= esc_html__( 'Log out', 'porto' ) . '</a></div></li>';
			} else {
				$html .= '<li class="menu-item"><a href="' . esc_url( $logout_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' : '';
				$html .= esc_html__( 'Log out', 'porto' ) . '</a></li>';
			}
		} else {
			$login_link    = '';
			$register_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$login_link = wc_get_page_permalink( 'myaccount' );
				if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
					$register_link = wc_get_page_permalink( 'myaccount' );
				}
			} else {
				$login_link    = wp_login_url( get_home_url() );
				$active_signup = get_site_option( 'registration', 'none' );
				$active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
				if ( 'none' != $active_signup ) {
					$register_link = wp_registration_url( get_home_url() );
				}
			}
			if ( ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type ) ) {
				if ( $register_link && isset( $porto_settings['menu-enable-register'] ) && $porto_settings['menu-enable-register'] ) {
					$html .= '<li class="' . ( is_rtl() ? 'pull-left' : 'pull-right' ) . '"><div class="menu-custom-block"><a class="porto-link-register" href="' . esc_url( $register_link ) . '">';
					$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user-plus"></i>' : '';
					$html .= esc_html__( 'Register', 'porto' ) . '</a></div></li>';
				}
				$html .= '<li class="' . ( is_rtl() ? 'pull-left' : 'pull-right' ) . '"><div class="menu-custom-block"><a class="porto-link-login" href="' . esc_url( $login_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user"></i>' : '';
				$html .= esc_html__( 'Log In', 'porto' ) . '</a></div></li>';
			} else {
				$html .= '<li class="menu-item"><a class="porto-link-login" href="' . esc_url( $login_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user"></i>' : '';
				$html .= esc_html__( 'Log In', 'porto' ) . '</a></li>';
				if ( $register_link && isset( $porto_settings['menu-enable-register'] ) && $porto_settings['menu-enable-register'] ) {
					$html .= '<li class="menu-item"><a class="porto-link-register" href="' . esc_url( $register_link ) . '">';
					$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user-plus"></i>' : '';
					$html .= esc_html__( 'Register', 'porto' ) . '</a></li>';
				}
			}
		}
	}

	if ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type ) {
		if ( $porto_settings['menu-block'] ) {
			$html .= '<li class="menu-custom-content ' . ( is_rtl() ? 'pull-left' : 'pull-right' ) . '"><div class="menu-custom-block">' . wp_kses_post( $porto_settings['menu-block'] ) . '</div></li>';
		}
	}

	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		$depth = 2;
		add_filter( 'porto_lazymenu_depth', '__return_true' );
	}

	ob_start();
	$main_menu = porto_get_meta_value( 'main_menu' );
	if ( has_nav_menu( 'main_menu' ) || $main_menu ) :
		$args = array(
			'container'   => '',
			'menu_class'  => ( $el_class && 'overlay' != $porto_settings['menu-type'] ? $el_class . ' ' : '' ) . 'main-menu mega-menu' . ( $porto_settings['menu-type'] ? ' ' . $porto_settings['menu-type'] : '' ) . ( $porto_settings['menu-arrow'] ? ' show-arrow' : '' ),
			'before'      => '',
			'after'       => '',
			'link_before' => '',
			'link_after'  => '',
			'fallback_cb' => false,
		);
		if ( $main_menu ) {
			$args['menu'] = $main_menu;
		} else {
			$args['theme_location'] = 'main_menu';
		}
		if ( $depth ) {
			$args['depth'] = intval( $depth );
		}
		if ( 'overlay' != $porto_settings['menu-type'] ) {
			$args['walker'] = new porto_top_navwalker();
		}

		wp_nav_menu( $args );
	endif;

	$output = str_replace( '&nbsp;', '', ob_get_clean() );

	if ( $output && $html ) {
		$output = preg_replace( '/<\/ul>$/', $html . '</ul>', $output, 1 );
	} elseif ( ! $output && $html ) {
		$output = '<ul class="' . ( $el_class && 'overlay' != $porto_settings['menu-type'] ? $el_class . ' ' : '' ) . 'main-menu mega-menu' . ( $porto_settings['menu-arrow'] ? ' show-arrow' : '' ) . '" id="menu-main-menu">' . $html . '</ul>';
	}

	// main menu popup style
	if ( 'overlay' == $porto_settings['menu-type'] ) {
		$output = '<div class="porto-popup-menu' . ( $el_class ? ' ' . $el_class : '' ) . '"><button class="hamburguer-btn"><span class="hamburguer"><span></span><span></span><span></span></span><span class="close"><span></span><span></span></span></button>' . $output . '</div>';
	}
	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		remove_filter( 'porto_lazymenu_depth', '__return_true' );
	}
	return apply_filters( 'porto_main_menu', $output );
}

function porto_secondary_menu( $depth = 0, $el_class = '' ) {
	global $porto_settings, $porto_layout, $porto_settings_optimize;
	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		$depth = 2;
		add_filter( 'porto_lazymenu_depth', '__return_true' );
	}
	ob_start();
	$secondary_menu = porto_get_meta_value( 'secondary_menu' );
	if ( has_nav_menu( 'secondary_menu' ) || $secondary_menu ) :
		$args = array(
			'container'   => '',
			'menu_class'  => ( $el_class && 'overlay' != $porto_settings['menu-type'] ? $el_class . ' ' : '' ) . 'secondary-menu main-menu mega-menu' . ( $porto_settings['menu-type'] ? ' ' . $porto_settings['menu-type'] : '' ) . ( $porto_settings['menu-arrow'] ? ' show-arrow' : '' ),
			'before'      => '',
			'after'       => '',
			'link_before' => '',
			'link_after'  => '',
			'fallback_cb' => false,
			'walker'      => new porto_top_navwalker(),
		);
		if ( $depth ) {
			$args['depth'] = $depth;
		}
		if ( $secondary_menu ) {
			$args['menu'] = $secondary_menu;
		} else {
			$args['theme_location'] = 'secondary_menu';
		}
		wp_nav_menu( $args );
	endif;

	$output = str_replace( '&nbsp;', '', ob_get_clean() );

	// secondary menu popup style
	if ( 'overlay' == $porto_settings['menu-type'] ) {
		$output = '<div class="porto-popup-menu' . ( $el_class ? ' ' . $el_class : '' ) . '"><button class="hamburguer-btn"><span class="hamburguer"><span></span><span></span><span></span></span><span class="close"><span></span><span></span></span></button>' . $output . '</div>';
	}
	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		remove_filter( 'porto_lazymenu_depth', '__return_true' );
	}
	return apply_filters( 'porto_secondary_menu', $output );
}

function porto_main_toggle_menu( $depth = 0 ) {
	global $porto_settings, $porto_layout, $porto_settings_optimize;

	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		$depth = 2;
		add_filter( 'porto_lazymenu_depth', '__return_true' );
	}

	$header_type = porto_get_header_type();

	if ( 9 != $header_type && ! empty( $header_type ) ) {
		return porto_main_menu();
	}

	ob_start();
	$main_menu = porto_get_meta_value( 'main_menu' );
	if ( has_nav_menu( 'main_menu' ) || $main_menu ) :
		$args = array(
			'container'   => '',
			'menu_class'  => 'sidebar-menu',
			'before'      => '',
			'after'       => '',
			'link_before' => '',
			'link_after'  => '',
			'fallback_cb' => false,
			'walker'      => new porto_sidebar_navwalker(),
		);
		if ( $depth ) {
			$args['depth'] = $depth;
		}
		if ( $main_menu ) {
			$args['menu'] = $main_menu;
		} else {
			$args['theme_location'] = 'main_menu';
		}
		wp_nav_menu( $args );
	endif;

	$output = str_replace( '&nbsp;', '', ob_get_clean() );
	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		remove_filter( 'porto_lazymenu_depth', '__return_true' );
	}
	return apply_filters( 'porto_main_toggle_menu', $output );
}

function porto_header_side_menu( $depth = 0 ) {
	global $porto_settings, $porto_settings_optimize;

	$output = '';

	$html = '';

	// show language switcher
	if ( $porto_settings['wpml-switcher'] && 'main_menu' == $porto_settings['wpml-switcher-pos'] ) {
		$languages = porto_icl_get_languages();
		if ( ! empty( $languages ) ) {
			$active_lang = '';
			$other_langs = '';
			foreach ( $languages as $l ) {
				if ( ! $l['active'] ) {
					$other_langs .= '<li class="menu-item"><a href="' . esc_url( $l['url'] ) . '">';
				}
				if ( $l['country_flag_url'] ) {
					if ( $l['active'] ) {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					} else {
						$other_langs .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
					}
				}
				if ( $l['active'] ) {
					$active_lang .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				} else {
					$other_langs .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
				}
				if ( ! $l['active'] ) {
					$other_langs .= '</a></li>';
				}
			}
			$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_lang . '</a><span class="arrow"></span>';
			if ( $other_langs && 1 !== $depth ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
				$html .= $other_langs;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		} elseif ( function_exists( 'qtranxf_getSortedLanguages' ) ) {
			global $q_config;

			$languages     = qtranxf_getSortedLanguages();
			$flag_location = qtranxf_flag_location();
			if ( is_404() ) {
				$url = esc_url( home_url() );
			} else {
				$url = '';
			}

			if ( ! empty( $languages ) ) {
				$active_lang = '';
				$other_langs = '';
				foreach ( $languages as $language ) {
					if ( $language != $q_config['language'] ) {
						$other_langs .= '<li class="menu-item"><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '">';
						$other_langs .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$other_langs .= $q_config['language_name'][ $language ];
						$other_langs .= '</a></li>';
					} else {
						$active_lang .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
						$active_lang .= $q_config['language_name'][ $language ];
					}
				}
				$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
				$html .= '<a class="nolink" href="#">' . $active_lang . '</a><span class="arrow"></span>';
				if ( $other_langs && 1 !== $depth ) {
					$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
					$html .= $other_langs;
					$html .= '</ul></div></div>';
				}
				$html .= '</li>';
			}
		}
	}

	// show currency switcher
	if ( $porto_settings['wcml-switcher'] && 'main_menu' == $porto_settings['wcml-switcher-pos'] ) {
		if ( class_exists( 'WOOCS' ) ) {
			global $WOOCS;
			$currencies       = $WOOCS->get_currencies();
			$current_currency = $WOOCS->current_currency;

			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				$label = ( $currency['flag'] ? '<span class="flag"><img src="' . esc_url( $currency['flag'] ) . '" height="12" alt="' . esc_attr( $currency['name'] ) . '" width="18" /></span>' : '' ) . esc_html( $currency['name'] . ' ' . $currency['symbol'] );
				if ( $currency['name'] == $current_currency ) {
					$active_c .= $label;
				} else {
					$other_c .= '<li rel="' . esc_attr( $currency['name'] ) . '" class="menu-item"><a class="nolink" href="#">' . $label . '</a></li>';
				}
			}
			$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_c . '</a><span class="arrow"></span>';
			if ( $other_c && 1 !== $depth ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
				$html .= $other_c;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		} elseif ( class_exists( 'WCML_Multi_Currency' ) ) {
			global $sitepress, $woocommerce_wpml;
			if ( ! empty( $sitepress ) ) {
				$current_language = $sitepress->get_current_language();
			} else {
				$current_language = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '';
			}
			$settings      = $woocommerce_wpml->get_settings();
			$format        = '%symbol% %code%';
			$wc_currencies = get_woocommerce_currencies();
			if ( ! isset( $settings['currencies_order'] ) && $woocommerce_wpml->multi_currency ) {
				$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
			} else {
				$currencies = $settings['currencies_order'];
			}
			$active_c = '';
			$other_c  = '';

			foreach ( $currencies as $currency ) {
				if ( 1 == $woocommerce_wpml->settings['currency_options'][ $currency ]['languages'][ $current_language ] && $woocommerce_wpml->multi_currency ) {
					$selected        = $currency == $woocommerce_wpml->multi_currency->get_client_currency() ? ' selected="selected"' : '';
					$currency_format = preg_replace(
						array( '#%name%#', '#%symbol%#', '#%code%#' ),
						array( $wc_currencies[ $currency ], get_woocommerce_currency_symbol( $currency ), $currency ),
						$format
					);

					if ( $selected ) {
						$active_c .= $currency_format;
					} else {
						$other_c .= '<li rel="' . esc_attr( $currency ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $currency_format ) . '</a></li>';
					}
				}
			}
			$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
			$html .= '<a class="nolink" href="#">' . $active_c . '</a><span class="arrow"></span>';
			if ( $other_c && 1 !== $depth ) {
				$html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
				$html .= $other_c;
				$html .= '</ul></div></div>';
			}
			$html .= '</li>';
		}
	}

	// show login/logout link
	if ( isset( $porto_settings['menu-login-pos'] ) && 'main_menu' == $porto_settings['menu-login-pos'] ) {
		if ( is_user_logged_in() ) {
			$logout_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
			} else {
				$logout_link = wp_logout_url( get_home_url() );
			}
			$html .= '<li class="menu-item"><a href="' . esc_url( $logout_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' : '';
			$html .= esc_html__( 'Log out', 'porto' ) . '</a></li>';
		} else {
			$login_link    = '';
			$register_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$login_link = wc_get_page_permalink( 'myaccount' );
				if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
					$register_link = wc_get_page_permalink( 'myaccount' );
				}
			} else {
				$login_link    = wp_login_url( get_home_url() );
				$active_signup = get_site_option( 'registration', 'none' );
				$active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
				if ( 'none' != $active_signup ) {
					$register_link = wp_registration_url( get_home_url() );
				}
			}
			$html .= '<li class="menu-item"><a class="porto-link-login" href="' . esc_url( $login_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user"></i>' : '';
			$html .= esc_html__( 'Log In', 'porto' ) . '</a></li>';
			if ( $register_link && isset( $porto_settings['menu-enable-register'] ) && $porto_settings['menu-enable-register'] ) {
				$html .= '<li class="menu-item"><a class="porto-link-register" href="' . esc_url( $register_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user-plus"></i>' : '';
				$html .= esc_html__( 'Register', 'porto' ) . '</a></li>';
			}
		}
	}
	if ( ! empty( $porto_settings['menu-block'] ) ) {
		$html .= '<li class="menu-custom-item"><div class="menu-custom-block">' . wp_kses_post( $porto_settings['menu-block'] ) . '</div></li>';
	}

	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		$depth = 2;
		add_filter( 'porto_lazymenu_depth', '__return_true' );
	}

	ob_start();
	$main_menu = porto_get_meta_value( 'main_menu' );
	if ( has_nav_menu( 'main_menu' ) || $main_menu ) {
		$args = array(
			'container'   => '',
			'menu_class'  => 'sidebar-menu' . ( ( has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value( 'sidebar_menu' ) ) ? ' has-side-menu' : '' ) . ( isset( $porto_settings['side-menu-type'] ) && $porto_settings['side-menu-type'] ? ' side-menu-' . esc_attr( $porto_settings['side-menu-type'] ) : '' ),
			'before'      => '',
			'after'       => '',
			'link_before' => '',
			'link_after'  => '',
			'fallback_cb' => false,
			'walker'      => new porto_sidebar_navwalker(),
		);
		if ( $depth ) {
			$args['depth'] = $depth;
		}
		if ( $main_menu ) {
			$args['menu'] = $main_menu;
		} else {
			$args['theme_location'] = 'main_menu';
		}
		wp_nav_menu( $args );
	}

	$output .= str_replace( '&nbsp;', '', ob_get_clean() );

	if ( $output && $html ) {
		$output = preg_replace( '/<\/ul>$/', $html . '</ul>', $output, 1 );
	} elseif ( ! $output && $html ) {
		$output = '<ul class="' . 'sidebar-menu' . ( ( has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value( 'sidebar_menu' ) ) ? ' has-side-menu' : '' ) . ( isset( $porto_settings['side-menu-type'] ) && $porto_settings['side-menu-type'] ? ' side-menu-' . esc_attr( $porto_settings['side-menu-type'] ) : '' ) . '" id="menu-main-menu">' . $html . '</ul>';
	}

	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		remove_filter( 'porto_lazymenu_depth', '__return_true' );
	}
	return apply_filters( 'porto_header_side_menu', $output );
}

function porto_have_sidebar_menu() {
	global $porto_settings, $porto_layout;

	$header_type = porto_get_header_type();

	$is_home = false;
	if ( is_front_page() && is_home() ) {
		$is_home = true;
	} elseif ( is_front_page() ) {
		$is_home = true;
	}

	$have_sidebar_menu = false;

	if ( ! ( ( ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type ) && in_array( $porto_layout, porto_options_sidebars() ) && $porto_settings['menu-sidebar'] ) ) ) {

	} elseif ( ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type ) && ! $is_home && $porto_settings['menu-sidebar-home'] ) {

	} else {
		if ( isset( $porto_settings['menu-login-pos'] ) && 'main_menu' == $porto_settings['menu-login-pos'] ) {
			$have_sidebar_menu = true;
		}
		if ( ! empty( $porto_settings['menu-block'] ) ) {
			$have_sidebar_menu = true;
		}
		$main_menu = porto_get_meta_value( 'main_menu' );
		if ( has_nav_menu( 'main_menu' ) || $main_menu ) {
			$have_sidebar_menu = true;
		}
	}

	// sidebar menu
	$sidebar_menu = porto_get_meta_value( 'sidebar_menu' );
	if ( has_nav_menu( 'sidebar_menu' ) || $sidebar_menu ) {
		$have_sidebar_menu = true;
	}

	return apply_filters( 'porto_is_sidebar_menu', $have_sidebar_menu );
}

function porto_sidebar_menu( $depth = 0 ) {
	global $porto_settings, $porto_layout, $porto_settings_optimize;

	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		$depth = 2;
		add_filter( 'porto_lazymenu_depth', '__return_true' );
	}

	$header_type = porto_get_header_type();
	if ( 'header_builder_p' == $porto_settings['header-type-select'] ) { 
		$header_type = '';
	}
	$is_home = false;
	if ( is_front_page() && is_home() ) {
		$is_home = true;
	} elseif ( is_front_page() ) {
		$is_home = true;
	}

	$output = '';
	
	$html = '';
	if ( ! ( ( ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type || empty( $header_type ) ) && in_array( $porto_layout, porto_options_sidebars() ) && $porto_settings['menu-sidebar'] ) ) ) {

	} elseif ( ( 1 == $header_type || 4 == $header_type || 13 == $header_type || 14 == $header_type || empty( $header_type ) ) && ! $is_home && $porto_settings['menu-sidebar-home'] ) {

	} else {
		// show language switcher
		if ( $porto_settings['wpml-switcher'] && 'main_menu' == $porto_settings['wpml-switcher-pos'] ) {
			$languages = porto_icl_get_languages();
			if ( ! empty( $languages ) ) {
				$active_lang = '';
				$other_langs = '';
				foreach ( $languages as $l ) {
					if ( ! $l['active'] ) {
						$other_langs .= '<li class="menu-item"><a href="' . esc_url( $l['url'] ) . '">';
					}
					if ( $l['country_flag_url'] ) {
						if ( $l['active'] ) {
							$active_lang .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
						} else {
							$other_langs .= '<span class="flag"><img src="' . esc_url( $l['country_flag_url'] ) . '" height="12" alt="' . esc_attr( $l['language_code'] ) . '" width="18" /></span>';
						}
					}
					if ( $l['active'] ) {
						$active_lang .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
					} else {
						$other_langs .= porto_icl_disp_language( $l['native_name'], $l['translated_name'] );
					}
					if ( ! $l['active'] ) {
						$other_langs .= '</a></li>';
					}
				}
				$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
				$html .= '<a class="nolink" href="#">' . $active_lang . '</a><span class="arrow"></span>';
				if ( $other_langs && 1 !== $depth ) {
					$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
					$html .= $other_langs;
					$html .= '</ul></div></div>';
				}
				$html .= '</li>';
			} elseif ( function_exists( 'qtranxf_getSortedLanguages' ) ) {
				global $q_config;

				$languages     = qtranxf_getSortedLanguages();
				$flag_location = qtranxf_flag_location();
				if ( is_404() ) {
					$url = esc_url( home_url() );
				} else {
					$url = '';
				}

				if ( ! empty( $languages ) ) {
					$active_lang = '';
					$other_langs = '';
					foreach ( $languages as $language ) {
						if ( $language != $q_config['language'] ) {
							$other_langs .= '<li class="menu-item"><a href="' . qtranxf_convertURL( $url, $language, false, true ) . '">';
							$other_langs .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
							$other_langs .= $q_config['language_name'][ $language ];
							$other_langs .= '</a></li>';
						} else {
							$active_lang .= '<span class="flag"><img src="' . esc_url( $flag_location . $q_config['flag'][ $language ] ) . '" alt="' . esc_attr( $q_config['language_name'][ $language ] ) . '" /></span>';
							$active_lang .= $q_config['language_name'][ $language ];
						}
					}
					$html .= '<li class="menu-item' . ( $other_langs ? ' has-sub' : '' ) . ' narrow">';
					$html .= '<a class="nolink" href="#">' . $active_lang . '</a><span class="arrow"></span>';
					if ( $other_langs && 1 !== $depth ) {
						$html .= '<div class="popup"><div class="inner"><ul class="sub-menu">';
						$html .= $other_langs;
						$html .= '</ul></div></div>';
					}
					$html .= '</li>';
				}
			}
		}

		// show currency switcher
		if ( $porto_settings['wcml-switcher'] && 'main_menu' == $porto_settings['wcml-switcher-pos'] ) {
			if ( class_exists( 'WOOCS' ) ) {
				global $WOOCS;
				$currencies       = $WOOCS->get_currencies();
				$current_currency = $WOOCS->current_currency;

				$active_c = '';
				$other_c  = '';

				foreach ( $currencies as $currency ) {
					$label = ( $currency['flag'] ? '<span class="flag"><img src="' . esc_url( $currency['flag'] ) . '" height="12" alt="' . esc_attr( $currency['name'] ) . '" width="18" /></span>' : '' ) . esc_html( $currency['name'] . ' ' . $currency['symbol'] );
					if ( $currency['name'] == $current_currency ) {
						$active_c .= $label;
					} else {
						$other_c .= '<li rel="' . esc_attr( $currency['name'] ) . '" class="menu-item"><a class="nolink" href="#">' . $label . '</a></li>';
					}
				}
				$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
				$html .= '<a class="nolink" href="#">' . $active_c . '</a><span class="arrow"></span>';
				if ( $other_c && 1 !== $depth ) {
					$html .= '<div class="popup"><div class="inner"><ul class="sub-menu woocs-switcher">';
					$html .= $other_c;
					$html .= '</ul></div></div>';
				}
				$html .= '</li>';
			} elseif ( class_exists( 'WCML_Multi_Currency' ) ) {
				global $sitepress, $woocommerce_wpml;
				if ( ! empty( $sitepress ) ) {
					$current_language = $sitepress->get_current_language();
				} else {
					$current_language = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '';
				}
				$settings      = $woocommerce_wpml->get_settings();
				$format        = '%symbol% %code%';
				$wc_currencies = get_woocommerce_currencies();
				if ( ! isset( $settings['currencies_order'] ) && $woocommerce_wpml->multi_currency ) {
					$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
				} else {
					$currencies = $settings['currencies_order'];
				}
				$active_c = '';
				$other_c  = '';

				foreach ( $currencies as $currency ) {
					if ( 1 == $woocommerce_wpml->settings['currency_options'][ $currency ]['languages'][ $current_language ] && $woocommerce_wpml->multi_currency ) {
						$selected        = $currency == $woocommerce_wpml->multi_currency->get_client_currency() ? ' selected="selected"' : '';
						$currency_format = preg_replace(
							array( '#%name%#', '#%symbol%#', '#%code%#' ),
							array( $wc_currencies[ $currency ], get_woocommerce_currency_symbol( $currency ), $currency ),
							$format
						);

						if ( $selected ) {
							$active_c .= $currency_format;
						} else {
							$other_c .= '<li rel="' . esc_attr( $currency ) . '" class="menu-item"><a class="nolink" href="#">' . wp_kses_post( $currency_format ) . '</a></li>';
						}
					}
				}
				$html .= '<li class="menu-item' . ( $other_c ? ' has-sub' : '' ) . ' narrow">';
				$html .= '<a class="nolink" href="#">' . $active_c . '</a><span class="arrow"></span>';
				if ( $other_c && 1 !== $depth ) {
					$html .= '<div class="popup"><div class="inner"><ul class="sub-menu wcml-switcher">';
					$html .= $other_c;
					$html .= '</ul></div></div>';
				}
				$html .= '</li>';
			}
		}

		// show login/logout link
		if ( isset( $porto_settings['menu-login-pos'] ) && 'main_menu' == $porto_settings['menu-login-pos'] ) {
			if ( is_user_logged_in() ) {
				$logout_link = '';
				if ( class_exists( 'WooCommerce' ) ) {
					$logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
				} else {
					$logout_link = wp_logout_url( get_home_url() );
				}
				$html .= '<li class="menu-item"><a href="' . esc_url( $logout_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' : '';
				$html .= esc_html__( 'Log out', 'porto' ) . '</a></li>';
			} else {
				$login_link    = '';
				$register_link = '';
				if ( class_exists( 'WooCommerce' ) ) {
					$login_link = wc_get_page_permalink( 'myaccount' );
					if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
						$register_link = wc_get_page_permalink( 'myaccount' );
					}
				} else {
					$login_link    = wp_login_url( get_home_url() );
					$active_signup = get_site_option( 'registration', 'none' );
					$active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
					if ( 'none' != $active_signup ) {
						$register_link = wp_registration_url( get_home_url() );
					}
				}
				$html .= '<li class="menu-item"><a class="porto-link-login" href="' . esc_url( $login_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user"></i>' : '';
				$html .= esc_html__( 'Log In', 'porto' ) . '</a></li>';
				if ( $register_link && isset( $porto_settings['menu-enable-register'] ) && $porto_settings['menu-enable-register'] ) {
					$html .= '<li class="menu-item"><a class="porto-link-register" href="' . esc_url( $register_link ) . '">';
					$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user-plus"></i>' : '';
					$html .= esc_html__( 'Register', 'porto' ) . '</a></li>';
				}
			}
		}
		if ( ! empty( $porto_settings['menu-block'] ) ) {
			$html .= '<li class="menu-custom-item"><div class="menu-custom-block">' . wp_kses_post( $porto_settings['menu-block'] ) . '</div></li>';
		}

		ob_start();
		$main_menu = porto_get_meta_value( 'main_menu' );
		if ( has_nav_menu( 'main_menu' ) || $main_menu ) {
			$args = array(
				'container'   => '',
				'menu_class'  => 'sidebar-menu' . ( ( has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value( 'sidebar_menu' ) ) ? ' has-side-menu' : '' ) . ( isset( $porto_settings['side-menu-type'] ) && $porto_settings['side-menu-type'] ? ' side-menu-' . esc_attr( $porto_settings['side-menu-type'] ) : '' ),
				'before'      => '',
				'after'       => '',
				'link_before' => '',
				'link_after'  => '',
				'fallback_cb' => false,
				'walker'      => new porto_sidebar_navwalker(),
			);
			if ( $depth ) {
				$args['depth'] = intval( $depth );
			}
			if ( $main_menu ) {
				$args['menu'] = $main_menu;
			} else {
				$args['theme_location'] = 'main_menu';
			}
			wp_nav_menu( $args );
		}

		$output .= str_replace( '&nbsp;', '', ob_get_clean() );

		if ( $output && $html ) {
			$output = preg_replace( '/<\/ul>$/', $html . '</ul>', $output, 1 );
		} elseif ( ! $output && $html ) {
			$output = '<ul class="' . 'sidebar-menu' . ( ( has_nav_menu( 'sidebar_menu' ) || porto_get_meta_value( 'sidebar_menu' ) ) ? ' has-side-menu' : '' ) . ( isset( $porto_settings['side-menu-type'] ) && $porto_settings['side-menu-type'] ? ' side-menu-' . esc_attr( $porto_settings['side-menu-type'] ) : '' ) . '" id="menu-main-menu">' . $html . '</ul>';
		}
	}

	// sidebar menu
	ob_start();
	$sidebar_menu = porto_get_meta_value( 'sidebar_menu' );
	if ( has_nav_menu( 'sidebar_menu' ) || $sidebar_menu ) {
		$args = array(
			'container'   => '',
			'menu_class'  => 'sidebar-menu' . ( $output ? ' has-main-menu' : '' ) . ( isset( $porto_settings['side-menu-type'] ) && $porto_settings['side-menu-type'] ? ' side-menu-' . esc_attr( $porto_settings['side-menu-type'] ) : '' ),
			'before'      => '',
			'after'       => '',
			'link_before' => '',
			'link_after'  => '',
			'fallback_cb' => false,
			'walker'      => new porto_sidebar_navwalker(),
		);
		if ( $depth ) {
			$args['depth'] = intval( $depth );
		}
		if ( $sidebar_menu ) {
			$args['menu'] = $sidebar_menu;
		} else {
			$args['theme_location'] = 'sidebar_menu';
		}
		wp_nav_menu( $args );
	}

	$output .= str_replace( '&nbsp;', '', ob_get_clean() );

	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		remove_filter( 'porto_lazymenu_depth', '__return_true' );
	}
	return apply_filters( 'porto_sidebar_menu', $output );
}

function porto_mobile_menu( $secondary_menu = false, $mobile_type = false ) {
	global $porto_settings;
	$is_option = ( ! empty( $porto_settings['mobile-panel-type'] ) && 'side' == $porto_settings['mobile-panel-type'] && isset( $porto_settings['show-mobile-menus'] ) ) ? ( is_array( $porto_settings['show-mobile-menus'] ) ? true : 'empty' ) : false;
	$menu_is_tab = ( $is_option && ! empty( $porto_settings['show-mobile-menus'] ) && sizeof( $porto_settings['show-mobile-menus'] ) >= 2 ) ? sizeof( $porto_settings['show-mobile-menus'] ) : false;
	$html = '';
	if ( isset( $porto_settings['menu-login-pos'] ) && 'main_menu' == $porto_settings['menu-login-pos'] ) {
		if ( is_user_logged_in() ) {
			$logout_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$logout_link = wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) );
			} else {
				$logout_link = wp_logout_url( get_home_url() );
			}
			$html .= '<li class="menu-item"><a href="' . esc_url( $logout_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="avatar">' . get_avatar( get_current_user_id(), $size = '24' ) . '</i>' : '';
			$html .= esc_html__( 'Log out', 'porto' ) . '</a></li>';
		} else {
			$login_link    = '';
			$register_link = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$login_link = wc_get_page_permalink( 'myaccount' );
				if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) {
					$register_link = wc_get_page_permalink( 'myaccount' );
				}
			} else {
				$login_link    = wp_login_url( get_home_url() );
				$active_signup = get_site_option( 'registration', 'none' );
				$active_signup = apply_filters( 'wpmu_active_signup', $active_signup );
				if ( 'none' != $active_signup ) {
					$register_link = wp_registration_url( get_home_url() );
				}
			}
			$html .= '<li class="menu-item"><a class="porto-link-login" href="' . esc_url( $login_link ) . '">';
			$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user"></i>' : '';
			$html .= esc_html__( 'Log In', 'porto' ) . '</a></li>';
			if ( $register_link && isset( $porto_settings['menu-enable-register'] ) && $porto_settings['menu-enable-register'] ) {
				$html .= '<li class="menu-item"><a class="porto-link-register" href="' . esc_url( $register_link ) . '">';
				$html .= ( isset( $porto_settings['menu-show-login-icon'] ) && $porto_settings['menu-show-login-icon'] ) ? '<i class="fas fa-user-plus"></i>' : '';
				$html .= esc_html__( 'Register', 'porto' ) . '</a></li>';
			}
		}
	}

	// Mobile Menu Defaul Type
	$menu_list = array( 'main', 'secondary', 'sidebar' );
	$output = '';
	for ( $i = 0; $i < 4; $i++ ) {
		if ( true == $is_option ) {
			if ( isset( $porto_settings['show-mobile-menus'][$i] ) ) {
				$menu = $porto_settings['show-mobile-menus'][$i];
			} else {
				break;
			}
		} else {
			if ( isset( $menu_list[$i] ) ) {
				$menu = $menu_list[$i];
			} else {
				break;
			}
		}
		$menu_flag = 'secondary' == $menu ? $secondary_menu : true;
		if ( ( true === $is_option && in_array( $menu, $porto_settings['show-mobile-menus'] ) ) || ( ! $is_option && $menu_flag ) ) {
			if ( 'panel' == $mobile_type && 'navigation' == $menu ) {
				$menu_data = porto_mobile_top_navigation();
				if ( $menu_data ) {
					ob_start();
					if ( $menu_is_tab ) {
						echo '<div class="menu-wrap tab-pane' . ( 0 == $i ? ' active' : '' ) . '" tab-id="menu-navigation">' . $menu_data . '</div>';
					} else {
						echo '<div class="menu-wrap">' . $menu_data . '</div>';
					}
					$output .= ob_get_clean();
				}
			} else {
				$menu = 'side' == $menu ? 'sidebar' : $menu;
				if ( $menu_is_tab ) {
					$output .= '<div class="menu-wrap tab-pane' . ( 0 == $i ? ' active' : '' ) . '" tab-id="menu-'. $menu .'">';
				}
				$menu_data = porto_get_meta_value( $menu . '_menu' );
				ob_start();
				if (  has_nav_menu( $menu . '_menu' ) || $menu_data ) :
					$args = array(
						'container'   => '',
						'menu_class'  => 'mobile-menu accordion-menu',
						'before'      => '',
						'after'       => '',
						'link_before' => '',
						'link_after'  => '',
						'fallback_cb' => false,
						'walker'      => new porto_accordion_navwalker(),
					);
					if ( $menu_data ) {
						$args['menu'] = $menu_data;
					} else {
						$args['theme_location'] = $menu . '_menu';
					}
					wp_nav_menu( $args );
				endif;
			
				$output .= str_replace( '&nbsp;', '', ob_get_clean() );
				if ( 'main' == $menu && true == $is_option && $html ) {
					$output .= 'mobile-html';			
					$output = preg_replace( '/<\/ul>mobile-html/', $html . '</ul>', $output, 1 );
					$html = false;
				}
				if ( $menu_is_tab ) {
					$output .= '</div>';
				}

			}
		}
	}
	
	if ( $output && $html ) {
		$output = preg_replace( '/<\/ul>$/', $html . '</ul>', $output, 1 );
	} elseif ( ! $output && $html ) {
		$output = '<ul class="' . 'mobile-menu accordion-menu' . '" id="menu-main-menu">' . $html . '</ul>';
	}

	return apply_filters( 'porto_mobile_menu', $output );
}

/**
 * Show the mobile toggle icon.
 * 
 * @since 6.9.0
 */
function porto_mobile_toggle_icon() {
	return '<a class="mobile-toggle" href="#" aria-label="Mobile Menu"' . apply_filters( 'porto_mobile_toggle_data_attrs', '' ) . '><i class="fas fa-bars"></i></a>';
}

function porto_search_form( $el_class = '' ) {
	global $porto_settings;

	if ( ! $porto_settings['show-searchform'] ) {
		return '';
	}	
	if ( isset( $porto_settings['search-layout'] ) ) {
		if ( 'simple' == $porto_settings['search-layout'] ) {
			$el_class = $el_class ? $el_class . ' simple-search-layout' : 'simple-search-layout';
		} else if ( 'advanced' == $porto_settings['search-layout'] && ! empty( $porto_settings['show-searchform-mobile'] ) ) {
			$el_class = $el_class ? $el_class . ' ssm-advanced-search-layout' : 'ssm-advanced-search-layout';
		}
	}
	$result  = '';
	$result .= '<div class="searchform-popup' . ( isset( $porto_settings['search-layout'] ) && ( 'simple' == $porto_settings['search-layout'] || 'large' == $porto_settings['search-layout'] || 'reveal' == $porto_settings['search-layout'] || 'overlay' == $porto_settings['search-layout'] ) ? ' search-popup' : '' ) . ( $el_class ? ' ' . esc_attr( $el_class ) : '' ) . '">';
	$result .= '<a '. apply_filters( 'porto_searchtoggle_data_attrs', '' ) . ' class="search-toggle" aria-label="Search Toggle" href="#"><i class="porto-icon-magnifier"></i><span class="search-text">' . esc_html__( 'Search', 'porto' ) . '</span></a>';
	$result .= porto_search_form_content();
	$result .= '</div>';
	return apply_filters( 'porto_search_form', $result );
}

function porto_search_form_content( $is_mobile = false ) {
	global $porto_settings;

	if ( ! $porto_settings['show-searchform'] ) {
		return '';
	}

	ob_start();
	if ( isset( $porto_settings['search-type'] ) && 'product' === $porto_settings['search-type'] && class_exists( 'WooCommerce' ) && defined( 'YITH_WCAS' ) ) {
		if ( version_compare( YITH_WCAS_VERSION, '2.0.0', '>=' ) && ( yith_wcas_is_fresh_block_installation() || yith_wcas_user_switch_to_block() ) ) {
		} else {
			if ( version_compare( YITH_WCAS_VERSION, '2.0.0', '>=' ) ) {
				wp_enqueue_script( 'yith_autocomplete' );
				wp_enqueue_script( 'yith_wcas_jquery-autocomplete' );
				wp_enqueue_script( 'yith_wcas_frontend' );
				wp_enqueue_style( 'yith_wcas_frontend' );
			}
			$wc_get_template = function_exists( 'wc_get_template' ) ? 'wc_get_template' : 'woocommerce_get_template';
			$wc_get_template( 'yith-woocommerce-ajax-search.php', array(), '', YITH_WCAS_DIR . 'templates/' );
			return ob_get_clean();
		}
	}
	if ( isset( $porto_settings['search-placeholder'] ) && $porto_settings['search-placeholder'] ) {
		$placeholder_text = strip_tags( $porto_settings['search-placeholder'] );
	} else {
		$placeholder_text = __( 'Search&hellip;', 'porto' );
	}
	$show_cats = isset( $porto_settings['search-cats'] ) && $porto_settings['search-cats'];
	if ( $show_cats ) {
		wp_enqueue_script( 'jquery-selectric' );
	}
	if ( $show_cats && wp_is_mobile() ) {
		$show_cats = ( ! isset( $porto_settings['search-cats-mobile'] ) || $porto_settings['search-cats-mobile'] );
	}
	?>
	<form action="<?php echo esc_url( home_url() ); ?>/" method="get"
		class="searchform search-layout-<?php echo esc_html( $porto_settings['search-layout'] ),  isset( $porto_settings['search-type'] ) && ( 'post' === $porto_settings['search-type'] || 'product' === $porto_settings['search-type'] || 'portfolio' === $porto_settings['search-type'] ) && $show_cats ? ' searchform-cats' : ''; ?>">
		<div class="searchform-fields<?php echo ( 'overlay' == $porto_settings['search-layout']  && ! $is_mobile ? ' container' : '' ); ?>">
			<span class="text"><input name="s" type="text" value="<?php echo get_search_query(); ?>" placeholder="<?php echo esc_attr( $placeholder_text ); ?>" autocomplete="off" /></span>
			<?php if ( isset( $porto_settings['search-type'] ) && ( 'post' === $porto_settings['search-type'] || 'product' === $porto_settings['search-type'] || 'portfolio' === $porto_settings['search-type'] ) ) : ?>
				<input type="hidden" name="post_type" value="<?php echo esc_attr( $porto_settings['search-type'] ); ?>"/>
				<?php
				if ( $show_cats ) {
					$args = array(
						'show_option_all' => __( 'All Categories', 'porto' ),
						'hierarchical'    => 1,
						'class'           => 'cat',
						'echo'            => 1,
						'value_field'     => 'slug',
						'selected'        => 1,
					);
					if ( 'product' === $porto_settings['search-type'] && class_exists( 'WooCommerce' ) ) {
						$args['taxonomy'] = 'product_cat';
						$args['name']     = 'product_cat';
						if ( $is_mobile ) {
							$args['id'] = 'product_cat_mobile';
						}
					}
					if ( 'portfolio' === $porto_settings['search-type'] && true == $porto_settings['enable-portfolio'] ) {
						$args['taxonomy'] = 'portfolio_cat';
						$args['name']     = 'portfolio_cat';
						if ( $is_mobile ) {
							$args['id'] = 'portfolio_cat_mobile';
						}
					}

					if ( empty( $porto_settings['search-sub-cats'] ) ) {
						$args['depth'] = 1;
					}
					wp_dropdown_categories( $args );
				}
			endif;
			?>
			<span class="button-wrap">
				<button class="btn btn-special" title="<?php esc_attr_e( 'Search', 'porto' ); ?>" type="submit">
					<i class="porto-icon-magnifier"></i>
				</button>
				<?php if ( ( 'reveal' == $porto_settings['search-layout'] || 'overlay' == $porto_settings['search-layout'] ) && ! $is_mobile ) : ?>
					<a href="#" class="btn-close-search-form"><i class="fas fa-times"></i></a>
				<?php endif; ?>					
			</span>
		</div>
		<?php if ( ! $is_mobile && isset( $porto_settings['search-live'] ) && $porto_settings['search-live'] ) : ?>
		<div class="live-search-list"></div>
		<?php endif; ?>
	</form>
	<?php
	return apply_filters( 'porto_search_form_content', ob_get_clean(), $is_mobile );
}

function porto_header_socials( $el_class = '' ) {
	global $porto_settings;
	if ( ! $porto_settings['show-header-socials'] ) {
		if ( porto_is_elementor_preview() || porto_vc_is_inline() ) {
			echo sprintf( esc_html__( '%1$sEnable%2$sTheme Options->Header->Social Links%3$s%4$s', 'porto' ), '<span>', '<a class="ps-1 porto-setting-link" href="' . porto_get_theme_option_url( 'show-header-socials' ) . '" target="_blank">', '</a>', '</span>' );
		}
		return '';
	}

	if ( $porto_settings['header-socials-nofollow'] ) {
		$nofollow = ' rel="nofollow noopener noreferrer"';
	} else {
		$nofollow = ' rel="noopener noreferrer"';
	}

	ob_start();
	echo '<div class="share-links' . ( $el_class ? ' ' . esc_attr( $el_class ) : '' ) . '">';
	if ( $porto_settings['header-social-facebook'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-facebook" href="<?php echo esc_url( $porto_settings['header-social-facebook'] ); ?>" title="<?php esc_attr_e( 'Facebook', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-twitter'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-twitter" href="<?php echo esc_url( $porto_settings['header-social-twitter'] ); ?>" title="<?php esc_attr_e( 'Twitter', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-rss'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-rss" href="<?php echo esc_url( $porto_settings['header-social-rss'] ); ?>" title="<?php esc_attr_e( 'RSS', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-pinterest'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-pinterest" href="<?php echo esc_url( $porto_settings['header-social-pinterest'] ); ?>" title="<?php esc_attr_e( 'Pinterest', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-youtube'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-youtube" href="<?php echo esc_url( $porto_settings['header-social-youtube'] ); ?>" title="<?php esc_attr_e( 'Youtube', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-instagram'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-instagram" href="<?php echo esc_url( $porto_settings['header-social-instagram'] ); ?>" title="<?php esc_attr_e( 'Instagram', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-skype'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-skype" href="<?php echo esc_attr( $porto_settings['header-social-skype'] ); ?>" title="<?php esc_attr_e( 'Skype', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-linkedin'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-linkedin" href="<?php echo esc_url( $porto_settings['header-social-linkedin'] ); ?>" title="<?php esc_attr_e( 'LinkedIn', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-vk'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-vk" href="<?php echo esc_url( $porto_settings['header-social-vk'] ); ?>" title="<?php esc_attr_e( 'VK', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-xing'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-xing" href="<?php echo esc_url( $porto_settings['header-social-xing'] ); ?>" title="<?php esc_attr_e( 'Xing', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-tumblr'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-tumblr" href="<?php echo esc_url( $porto_settings['header-social-tumblr'] ); ?>" title="<?php esc_attr_e( 'Tumblr', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-reddit'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-reddit" href="<?php echo esc_url( $porto_settings['header-social-reddit'] ); ?>" title="<?php esc_attr_e( 'Reddit', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-vimeo'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-vimeo" href="<?php echo esc_url( $porto_settings['header-social-vimeo'] ); ?>" title="<?php esc_attr_e( 'Vimeo', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-telegram'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-telegram" href="<?php echo esc_url( $porto_settings['header-social-telegram'] ); ?>" title="<?php esc_attr_e( 'Telegram', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-yelp'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-yelp" href="<?php echo esc_url( $porto_settings['header-social-yelp'] ); ?>" title="<?php esc_attr_e( 'Yelp', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-flickr'] ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-flickr" href="<?php echo esc_url( $porto_settings['header-social-flickr'] ); ?>" title="<?php esc_attr_e( 'Flickr', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( $porto_settings['header-social-whatsapp'] ) :
		?>
		<a <?php echo porto_filter_output( $nofollow ); ?> class="share-whatsapp" style="display:none" href="whatsapp://send?text=<?php echo esc_attr( $porto_settings['header-social-whatsapp'] ); ?>" data-action="share/whatsapp/share" title="<?php esc_attr_e( 'WhatsApp', 'porto' ); ?>"><?php esc_html_e( 'WhatsApp', 'porto' ); ?></a>
		<?php
	endif;

	if ( ! empty( $porto_settings['header-social-wechat'] ) ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-wechat" href="<?php echo esc_url( $porto_settings['header-social-wechat'] ); ?>" title="<?php esc_attr_e( 'WeChat', 'porto' ); ?>"></a>
		<?php
	endif;

	if ( ! empty( $porto_settings['header-social-tiktok'] ) ) :
		?>
		<a target="_blank" <?php echo porto_filter_output( $nofollow ); ?> class="share-tiktok" href="<?php echo esc_url( $porto_settings['header-social-tiktok'] ); ?>" title="<?php esc_attr_e( 'Tiktok', 'porto' ); ?>"></a>
		<?php
	endif;

	echo '</div>';

	return apply_filters( 'porto_header_socials', ob_get_clean() );
}

function porto_minicart( $el_class = '' ) {
	global $woocommerce, $porto_settings;

	if ( isset( $porto_settings['minicart-type'] ) && 'none' == $porto_settings['minicart-type'] ) {
		return '';
	}

	if ( ! empty( $porto_settings['catalog-enable'] ) ) {
		if ( $porto_settings['catalog-admin'] || ( ! $porto_settings['catalog-admin'] && ! ( current_user_can( 'administrator' ) && is_user_logged_in() ) ) ) {
			if ( ! $porto_settings['catalog-cart'] ) {
				return '';
			}
		}
	}

	$minicart_type = porto_get_minicart_type();

	ob_start();
	if ( class_exists( 'Woocommerce' ) || ( defined( 'PORTO_DEMO' ) && PORTO_DEMO ) ) :
		$icon_class = 'minicart-icon';
		if ( empty( $porto_settings['minicart-icon'] ) ) {
			if ( 'simple' == $minicart_type ) {
				$icon_class .= ' minicart-icon-default';
			} else {
				$icon_class .= ' porto-icon-bag-2';
			}
		} else {
			$icon_class .= ' ' . trim( $porto_settings['minicart-icon'] );
		}
		?>
		<div id="mini-cart" class="mini-cart <?php echo esc_attr( $minicart_type ), isset( $porto_settings['minicart-content'] ) && $porto_settings['minicart-content'] ? ' minicart-offcanvas' : '', $el_class ? ' ' . esc_attr( $el_class ) : ''; ?>">
			<div class="cart-head">
			<?php
			if ( 'minicart-inline' == $minicart_type || 'minicart-text' == $minicart_type ) {
				$cart_text = empty( $porto_settings['minicart-text'] ) ? __( 'Cart', 'porto' ) : $porto_settings['minicart-text'];
				$format    = '<span class="cart-icon"><i class="' . esc_attr( $icon_class ) . '"></i><span class="cart-items">%s</span></span><span class="cart-subtotal">' . esc_html( $cart_text ) . ' %s</span>';
				if ( defined( 'WP_CACHE' ) && WP_CACHE ) {
					$_cart_qty   = '0';
					$_cart_total = $_cart_qty;
				} else {
					$_cart_qty   = $woocommerce->cart ? $woocommerce->cart->cart_contents_count : 0;
					$_cart_total = $woocommerce->cart ? $woocommerce->cart->get_cart_subtotal() : 0;
				}
				printf( $format, $_cart_qty, '<span class="cart-price">' . $_cart_total . '</span>' );
			} else {
				$format = '<span class="cart-icon"><i class="' . esc_attr( $icon_class ) . '"></i><span class="cart-items">%s</span></span><span class="cart-items-text">%s</span>';
				if ( ! class_exists( 'Woocommerce' ) && defined( 'PORTO_DEMO' ) && PORTO_DEMO ) {
					$_cart_qty  = 1;
					$_cart_qty1 = 1;
				} elseif ( defined( 'WP_CACHE' ) && WP_CACHE ) {
					$_cart_qty  = '0';
					$_cart_qty1 = $_cart_qty;
				} else {
					$_cart_qty = $woocommerce->cart ? $woocommerce->cart->cart_contents_count : 0;
					/* translators: %s: Cart quantity */
					$_cart_qty1 = sprintf( _n( '%d item', '%d items', $_cart_qty, 'porto' ), $_cart_qty );
				}

				printf( $format, $_cart_qty, $_cart_qty1 );
			}
			?>
			</div>
			<div class="cart-popup widget_shopping_cart">
				<div class="widget_shopping_cart_content">
				<?php if ( class_exists( 'Woocommerce' ) ) : ?>
					<div class="cart-loading"></div>
				<?php else : ?>
					<ul class="cart_list py-3 px-0 mb-0"><li class="empty pt-0"><?php esc_html_e( 'WooCommerce is not installed.', 'porto' ); ?></li></ul>
				<?php endif; ?>
				</div>
			</div>
		<?php
		if ( ! empty( $porto_settings['minicart-content'] ) ) {
			echo '<div class="minicart-overlay"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.minicart-svg{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><g id="cross"><line class="minicart-svg" x1="7" x2="25" y1="7" y2="25"/><line class="minicart-svg" x1="7" x2="25" y1="25" y2="7"/></g></svg></div>';
		}
		?>
		</div>
		<?php
	endif;

	return apply_filters( 'porto_minicart', ob_get_clean() );
}

function porto_wishlist( $el_class, $icon_cl = 'porto-icon-wishlist-2', $inline_style = '' ) {
	if ( ! class_exists( 'Woocommerce' ) || ! defined( 'YITH_WCWL' ) ) {
		return;
	}

	ob_start();
	$wc_count = yith_wcwl_count_products();
	global $porto_settings;
	if ( ! empty( $porto_settings['wl-offcanvas'] ) ) {
		echo '<div class="wishlist-offcanvas' . ( $el_class ? ' ' . esc_attr( $el_class ) : '' ) . '">';
	}
	echo '<a href="' . esc_url( YITH_WCWL()->get_wishlist_url() ) . '"' . ' title="' . esc_attr__( 'Wishlist', 'porto' ) . '" class="my-wishlist' . ( $el_class && empty( $porto_settings['wl-offcanvas'] ) ? ' ' . esc_attr( $el_class ) : '' ) . '"' . ( $inline_style ? ' style="' . esc_attr( $inline_style ) . '"' : '' ) . '><i class="' . esc_attr( $icon_cl ) . '"></i><span class="wishlist-count">' . intval( $wc_count ) . '</span></a>';

	if ( ! empty( $porto_settings['wl-offcanvas'] ) ) {
		echo '<div class="wishlist-popup"></div>';

		echo '<div class="minicart-overlay"><svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.minicart-svg{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><g id="cross"><line class="minicart-svg" x1="7" x2="25" y1="7" y2="25"/><line class="minicart-svg" x1="7" x2="25" y1="25" y2="7"/></g></svg></div>';
		echo '</div>';
		wp_enqueue_script( 'jquery-yith-wcwl' );
	}
	return apply_filters( 'porto_wishlist', ob_get_clean() );
}

function porto_account_menu( $el_class, $icon_cl = 'porto-icon-user-2', $inline_attr = '' ) {
	global $porto_settings;
	if ( empty( $porto_settings['show-account-dropdown'] ) || ! is_user_logged_in() ) {
		if ( ! is_user_logged_in() && empty( $porto_settings['woo-account-login-style'] ) ) {
			$el_class .= ' porto-link-login';
		}
		echo '<a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '"' . ' title="' . esc_attr__( 'My Account', 'porto' ) . '" class="my-account' . ( $el_class ? ' ' . esc_attr( $el_class ) : '' ) . '"' . porto_strip_script_tags( $inline_attr ) . '><i class="' . esc_attr( $icon_cl ) . '"></i></a>';
	} else {
		echo '<ul class="account-dropdown mega-menu show-arrow' . ( $el_class ? ' ' . esc_attr( $el_class ) : '' ) . '" >';
		echo '<li class="menu-item has-sub narrow">';
		echo '<a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '"' . ' title="' . esc_attr__( 'My Account', 'porto' ) . '" class="my-account"' . porto_strip_script_tags( $inline_attr ) . '><i class="' . esc_attr( $icon_cl ) . '"></i></a>';
		$html = '';

		$html .= '<div class="popup">';
		$html .= '<div class="inner">';
		if ( ! has_nav_menu( 'account_menu' ) ) {
			$html .= '<ul class="porto-narrow-sub-menu sub-menu">';
			foreach ( wc_get_account_menu_items() as $endpoint => $label ) :
				$html .= '<li class="' . wc_get_account_menu_item_classes( $endpoint ) . ' menu-item">';
				$html .= '<a href="' . esc_url( wc_get_account_endpoint_url( $endpoint ) ) . '">' . esc_html( $label ) . '</a>';
				$html .= '</li>';
			endforeach;
			$html .= '</ul>';
		} else {
			$html .= wp_nav_menu(
				array(
					'theme_location' => 'account_menu',
					'container'      => '',
					'menu_class'     => 'porto-narrow-sub-menu sub-menu',
					'before'         => '',
					'after'          => '',
					'depth'          => 2,
					'link_before'    => '',
					'link_after'     => '',
					'fallback_cb'    => false,
					'walker'         => new porto_top_navwalker(),
					'echo'           => false,
				)
			);
		}
		$html .= '</div>';
		$html .= '</div>';

		echo porto_filter_output( $html );
		echo '</li>';
		echo '</ul>';
	}
}

function porto_get_wrapper_type() {
	global $porto_settings;
	return apply_filters( 'porto_get_wrapper_type', $porto_settings['wrapper'] );
}

function porto_get_header_type() {
	global $porto_settings;
	$header_type = '';
	if ( 'header_builder_p' == $porto_settings['header-type-select'] ) {
		$hb_layout = porto_header_builder_layout();
		if ( empty( $hb_layout ) && empty( $porto_settings['elementor_pro_header'] ) ) {
			$header_type = '10';
		}
	} elseif ( porto_header_type_is_preset() && isset( $porto_settings['header-type'] ) ) {
		$header_type = $porto_settings['header-type'];
	}
	return apply_filters( 'porto_get_header_type', $header_type );
}
function porto_header_type_is_preset() {
	global $porto_settings;
	return ! isset( $porto_settings['header-type-select'] ) || empty( $porto_settings['header-type-select'] ) ? true : false;
}
function porto_header_type_is_side() {
	if ( porto_header_type_is_preset() ) {
		return 'side' == porto_get_header_type();
	}
	$current_layout = porto_header_builder_layout();
	if ( isset( $current_layout['type'] ) && 'side' == $current_layout['type'] ) {
		return true;
	}
	return false;
}
function porto_header_builder_layout() {
	global $porto_header_builder_layout;	
	if ( ! isset( $porto_header_builder_layout ) ) {
		global $porto_settings;
		if ( 'header_builder' == $porto_settings['header-type-select'] ) {
			$header_layouts  = get_option( 'porto_header_builder_layouts', array() );
			$selected_layout = get_option( 'porto_header_builder', array() );
			if ( is_customize_preview() && ! empty( $selected_layout ) ) {
				$porto_header_builder_layout         = $selected_layout;
				$porto_header_builder_layout['name'] = $selected_layout['selected_layout'];
			} elseif ( ! empty( $selected_layout ) && isset( $selected_layout['selected_layout'] ) && $selected_layout['selected_layout'] && isset( $header_layouts[ $selected_layout['selected_layout'] ] ) ) {
				$porto_header_builder_layout         = $header_layouts[ $selected_layout['selected_layout'] ];
				$porto_header_builder_layout['name'] = $selected_layout['selected_layout'];
			}
		} elseif ( 'header_builder_p' == $porto_settings['header-type-select'] ) {
			$builder_id = porto_check_builder_condition( 'header' );
			if ( $builder_id ) {
				$porto_header_builder_layout = array(
					'ID'                => $builder_id,
					'type'              => 'side' == get_post_meta( $builder_id, 'header_type', true ),
					'side_header_width' => intval( get_post_meta( $builder_id, 'header_side_width', true ) ),
				);
			}
		}
	}
	return apply_filters( 'porto_header_builder_current_layout', $porto_header_builder_layout );
}

function porto_get_minicart_type() {
	global $porto_settings;
	$minicart_type = ( isset( $porto_settings['minicart-type'] ) && $porto_settings['minicart-type'] ? $porto_settings['minicart-type'] : 'simple' );
	return apply_filters( 'porto_get_minicart_type', $minicart_type );
}

function porto_get_blog_id() {
	global $porto_settings;

	return apply_filters( 'porto_get_blog_id', get_current_blog_id() );
}

function porto_is_dark_skin() {
	global $porto_settings;

	return apply_filters( 'porto_is_dark_skin', ( isset( $porto_settings['css-type'] ) && 'dark' == $porto_settings['css-type'] ) );
}

add_filter( 'masterslider_layer_shortcode', 'porto_master_slider_iframe', 10, 4 );

function porto_master_slider_iframe( $layer, $merged, $atts, $content ) {
	return str_replace( '<iframe', '<iframe frameborder="0"', $layer );
}

function porto_render_rich_snippets( $title_tag = true, $author_tag = true, $updated_tag = true ) {

	global $porto_settings;

	if ( isset( $porto_settings['rich-snippets'] ) && $porto_settings['rich-snippets'] ) {
		if ( $title_tag ) {
			$title_tag = is_string( $title_tag ) ? esc_html( $title_tag ) : 'span';
			echo '<' . $title_tag . ' class="entry-title" style="display: none;">' . get_the_title() . '</' . $title_tag . '>';
		}
		if ( $author_tag ) {
			echo '<span class="vcard" style="display: none;"><span class="fn">';
			the_author_posts_link();
			echo '</span></span>';
		}
		if ( $updated_tag ) {
			echo '<span class="updated" style="display:none">' . get_the_modified_time( 'c' ) . '</span>';
		}
	}

}

function porto_get_button_style() {
	global $porto_settings;

	return isset( $porto_settings['button-style'] ) ? $porto_settings['button-style'] : '';
}

if ( ! function_exists( 'porto_icl_get_languages' ) ) :
	function porto_icl_get_languages( $args = '' ) {
		if ( function_exists( 'icl_get_languages' ) ) {
			return icl_get_languages( $args );
		}
		return apply_filters( 'wpml_active_languages', array(), $args );
	}
endif;

function porto_icl_disp_language( $native_name, $translated_name = false, $lang_native_hidden = false, $lang_translated_hidden = false ) {
	$lang_native_hidden     = apply_filters( 'porto_icl_native_hidden', $lang_native_hidden, $native_name );
	$lang_translated_hidden = apply_filters( 'porto_icl_translated_hidden', $lang_translated_hidden, $native_name );
	if ( function_exists( 'icl_disp_language' ) ) {
		return icl_disp_language( $native_name, $translated_name, $lang_native_hidden, $lang_translated_hidden );
	}
	$ret = '';

	if ( ! $native_name && ! $translated_name ) {
		$ret = '';
	} elseif ( $native_name && $translated_name ) {
		$hidden1 = '';
		$hidden2 = '';
		$hidden3 = '';
		if ( $lang_native_hidden ) {
			$hidden1 = 'style="display:none;"';
		}
		if ( $lang_translated_hidden ) {
			$hidden2 = 'style="display:none;"';
		}
		if ( $lang_native_hidden && $lang_translated_hidden ) {
			$hidden3 = 'style="display:none;"';
		}

		if ( $native_name != $translated_name ) {
			$ret =
				'<span ' .
				$hidden1 .
				' class="icl_lang_sel_native">' .
				$native_name .
				'</span> <span ' .
				$hidden2 .
				' class="icl_lang_sel_translated"><span ' .
				$hidden1 .
				' class="icl_lang_sel_native">(</span>' .
				$translated_name .
				'<span ' .
				$hidden1 .
				' class="icl_lang_sel_native">)</span></span>';
		} else {
			$ret = '<span ' . $hidden3 . ' class="icl_lang_sel_current">' . esc_html( $native_name ) . '</span>';
		}
	} elseif ( $native_name ) {
		$ret = $native_name;
	} elseif ( $translated_name ) {
		$ret = $translated_name;
	}

	return $ret;
}

function porto_get_featured_images( $post_id = null ) {
	if ( is_null( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	if ( class_exists( 'Dynamic_Featured_Image' ) ) {
		global $dynamic_featured_image;
		return $dynamic_featured_image->get_all_featured_images( $post_id );
	}
	$thumbnail_id    = get_post_thumbnail_id( $post_id );
	$featured_images = array();
	if ( ! empty( $thumbnail_id ) ) {
		$featured_image    = array(
			'thumb'         => wp_get_attachment_thumb_url( $thumbnail_id ),
			'full'          => wp_get_attachment_url( $thumbnail_id ),
			'attachment_id' => $thumbnail_id,
		);
		$featured_images[] = $featured_image;
	}
	return $featured_images;
}

function porto_show_archive_filter() {

	global $porto_settings;

	$value = false;

	if ( is_archive() ) {
		if ( is_post_type_archive( 'portfolio' ) && isset( $porto_settings['portfolio-cat-sort-pos'] ) ) {
			$value = 'sidebar' == $porto_settings['portfolio-cat-sort-pos'] && get_categories( array( 'taxonomy' => 'portfolio_cat' ) );
		} elseif ( is_post_type_archive( 'member' ) && isset( $porto_settings['member-cat-sort-pos'] ) ) {
			$value = 'sidebar' == $porto_settings['member-cat-sort-pos'] && get_categories( array( 'taxonomy' => 'member_cat' ) );
		} elseif ( is_post_type_archive( 'faq' ) ) {
			$value = 'sidebar' == $porto_settings['faq-cat-sort-pos'] && get_categories( array( 'taxonomy' => 'faq_cat' ) );
		} else {
			$term = get_queried_object();
			if ( $term && isset( $term->taxonomy ) && isset( $term->term_id ) ) {
				switch ( $term->taxonomy ) {
					case in_array( $term->taxonomy, porto_get_taxonomies( 'portfolio' ) ):
						$value = isset( $porto_settings['portfolio-cat-sort-pos'] ) && 'sidebar' == $porto_settings['portfolio-cat-sort-pos'] && get_categories(
							array(
								'taxonomy' => 'portfolio_cat',
								'child_of' => $term->term_id,
							)
						);
						break;
					case in_array( $term->taxonomy, porto_get_taxonomies( 'faq' ) ):
						$value = 'sidebar' == $porto_settings['faq-cat-sort-pos'] && get_categories(
							array(
								'taxonomy' => 'faq_cat',
								'child_of' => $term->term_id,
							)
						);
						break;
				}
			}
		}
	}

	return apply_filters( 'porto_show_archive_filter', $value );
}

if ( ! function_exists( 'porto_woocommerce_product_nav' ) ) :
	function porto_woocommerce_product_nav() {
		global $porto_settings;

		if ( apply_filters( 'porto_legacy_mode', true ) && ! $porto_settings['product-nav'] ) {
			return;
		}

		if ( porto_is_product() ) {
			echo '<div class="product-nav">';
			porto_woocommerce_prev_product( true );
			porto_woocommerce_next_product( true );
			echo '</div>';
		}
	}
endif;

if ( ! function_exists( 'porto_breadcrumbs_filter' ) ) :
	function porto_breadcrumbs_filter() {
		global $porto_settings;

		if ( is_archive() ) {
			if ( is_post_type_archive( 'portfolio' ) ) {
				if ( isset( $porto_settings['portfolio-cat-sort-pos'] ) && 'breadcrumbs' === $porto_settings['portfolio-cat-sort-pos'] && ! is_search() ) {
					porto_show_portfolio_archive_filter( 'global' );
				}
			} elseif ( is_post_type_archive( 'member' ) ) {
				if ( isset( $porto_settings['member-cat-sort-pos'] ) && 'breadcrumbs' === $porto_settings['member-cat-sort-pos'] && ! is_search() ) {
					porto_show_member_archive_filter( 'global' );
				}
			} elseif ( is_post_type_archive( 'faq' ) ) {
				if ( 'breadcrumbs' === $porto_settings['faq-cat-sort-pos'] && ! is_search() ) {
					porto_show_faq_archive_filter( 'global' );
				}
			} else {
				$term = get_queried_object();
				if ( $term && isset( $term->taxonomy ) && isset( $term->term_id ) ) {
					switch ( $term->taxonomy ) {
						case in_array( $term->taxonomy, porto_get_taxonomies( 'portfolio' ) ):
							if ( isset( $porto_settings['portfolio-cat-sort-pos'] ) && 'breadcrumbs' === $porto_settings['portfolio-cat-sort-pos'] ) {
								porto_show_portfolio_tax_filter( 'global' );
							}
							break;
						case in_array( $term->taxonomy, porto_get_taxonomies( 'faq' ) ):
							if ( 'breadcrumbs' === $porto_settings['faq-cat-sort-pos'] ) {
								porto_show_faq_tax_filter( 'global' );
							}
							break;
					}
				}
			}
		}
	}
endif;

if ( ! function_exists( 'porto_show_portfolio_archive_filter' ) ) :
	function porto_show_portfolio_archive_filter( $position = 'global' ) {
		global $porto_settings;

		$portfolio_infinite = isset( $porto_settings['portfolio-infinite'] ) ? $porto_settings['portfolio-infinite'] : true;

		$portfolio_taxs = array();

		$taxs = get_categories(
			array(
				'taxonomy' => 'portfolio_cat',
				'orderby'  => isset( $porto_settings['portfolio-cat-orderby'] ) ? $porto_settings['portfolio-cat-orderby'] : 'name',
				'order'    => isset( $porto_settings['portfolio-cat-order'] ) ? $porto_settings['portfolio-cat-order'] : 'asc',
			)
		);

		foreach ( $taxs as $tax ) {
			$portfolio_taxs[ urldecode( $tax->slug ) ] = $tax->name;
		}

		if ( ! $portfolio_infinite ) {
			global $wp_query;
			$posts_portfolio_taxs = array();
			if ( is_array( $wp_query->posts ) && ! empty( $wp_query->posts ) ) {
				foreach ( $wp_query->posts as $post ) {
					$post_taxs = wp_get_post_terms( $post->ID, 'portfolio_cat', array( 'fields' => 'all' ) );
					if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
						foreach ( $post_taxs as $post_tax ) {
							$posts_portfolio_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
						}
					}
				}
			}
			foreach ( $portfolio_taxs as $key => $value ) {
				if ( ! isset( $posts_portfolio_taxs[ $key ] ) ) {
					unset( $portfolio_taxs[ $key ] );
				}
			}
		}

		if ( 'global' !== $position ) {
			$position = 'sidebar';
		}

		if ( 'sidebar' == $position ) :
			?>
			<?php /* translators: $1 and $2 opening and closing strong tags respectively */ ?>
			<h4 class="filter-title"><?php printf( esc_html__( '%1$sFilter%2$s By', 'porto' ), '<strong>', '</strong>' ); ?></h4>
			<ul class="portfolio-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr( $position ); ?>">
				<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
				<?php foreach ( $portfolio_taxs as $tax_slug => $tax_name ) : ?>
					<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<ul class="portfolio-filter nav sort-source" data-position="<?php echo esc_attr( $position ); ?>">
				<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
				<?php foreach ( $portfolio_taxs as $tax_slug => $tax_name ) : ?>
					<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'porto_show_portfolio_tax_filter' ) ) :
	function porto_show_portfolio_tax_filter( $position = 'global' ) {
		global $porto_settings, $wp_query;

		$term    = $wp_query->queried_object;
		$term_id = $term->term_id;

		$portfolio_options  = get_metadata( $term->taxonomy, $term->term_id, 'portfolio_options', true ) == 'portfolio_options' ? true : false;
		$portfolio_infinite = $portfolio_options ? ( get_metadata( $term->taxonomy, $term->term_id, 'portfolio_infinite', true ) != 'portfolio_infinite' ? true : false ) : ( isset( $porto_settings['portfolio-infinite'] ) ? $porto_settings['portfolio-infinite'] : true );

		$portfolio_taxs = array();

		$taxs = get_categories(
			array(
				'taxonomy' => 'portfolio_cat',
				'child_of' => $term_id,
				'orderby'  => isset( $porto_settings['portfolio-cat-orderby'] ) ? $porto_settings['portfolio-cat-orderby'] : 'name',
				'order'    => isset( $porto_settings['portfolio-cat-order'] ) ? $porto_settings['portfolio-cat-order'] : 'asc',
			)
		);

		foreach ( $taxs as $tax ) {
			$portfolio_taxs[ urldecode( $tax->slug ) ] = $tax->name;
		}

		if ( ! $portfolio_infinite ) {
			global $wp_query;
			$posts_portfolio_taxs = array();
			if ( is_array( $wp_query->posts ) && ! empty( $wp_query->posts ) ) {
				foreach ( $wp_query->posts as $post ) {
					$post_taxs = wp_get_post_terms( $post->ID, 'portfolio_cat', array( 'fields' => 'all' ) );
					if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
						foreach ( $post_taxs as $post_tax ) {
							$posts_portfolio_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
						}
					}
				}
			}
			foreach ( $portfolio_taxs as $key => $value ) {
				if ( ! isset( $posts_portfolio_taxs[ $key ] ) ) {
					unset( $portfolio_taxs[ $key ] );
				}
			}
		}

		if ( 'global' !== $position ) {
			$position = 'sidebar';
		}

		if ( is_array( $portfolio_taxs ) && ! empty( $portfolio_taxs ) ) :
			if ( 'sidebar' == $position ) :
				?>
				<?php /* translators: $1 and $2 opening and closing strong tags respectively */ ?>
				<h4 class="filter-title"><?php printf( esc_html__( '%1$sFilter%2$s By', 'porto' ), '<strong>', '</strong>' ); ?></h4>
				<ul class="portfolio-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr( $position ); ?>">
					<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
					<?php foreach ( $portfolio_taxs as $tax_slug => $tax_name ) : ?>
						<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<ul class="portfolio-filter nav sort-source" data-position="<?php echo esc_attr( $position ); ?>">
					<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
					<?php foreach ( $portfolio_taxs as $tax_slug => $tax_name ) : ?>
						<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php
			endif;
		endif;
	}
endif;

if ( ! function_exists( 'porto_show_member_archive_filter' ) ) :
	function porto_show_member_archive_filter( $position = 'global' ) {
		global $porto_settings;

		$member_infinite = isset( $porto_settings['member-infinite'] ) ? $porto_settings['member-infinite'] : true;

		$member_taxs = array();

		$taxs = get_categories(
			array(
				'taxonomy' => 'member_cat',
				'orderby'  => isset( $porto_settings['member-cat-orderby'] ) ? $porto_settings['member-cat-orderby'] : 'name',
				'order'    => isset( $porto_settings['member-cat-order'] ) ? $porto_settings['member-cat-order'] : 'asc',
			)
		);

		foreach ( $taxs as $tax ) {
			$member_taxs[ urldecode( $tax->slug ) ] = $tax->name;
		}

		if ( ! $member_infinite || 'ajax' == $member_infinite ) {
			global $wp_query;
			$posts_member_taxs = array();
			if ( is_array( $wp_query->posts ) && ! empty( $wp_query->posts ) ) {
				foreach ( $wp_query->posts as $post ) {
					$post_taxs = wp_get_post_terms( $post->ID, 'member_cat', array( 'fields' => 'all' ) );
					if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
						foreach ( $post_taxs as $post_tax ) {
							$posts_member_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
						}
					}
				}
			}
			foreach ( $member_taxs as $key => $value ) {
				if ( ! isset( $posts_member_taxs[ $key ] ) ) {
					unset( $member_taxs[ $key ] );
				}
			}
		}

		if ( 'global' !== $position ) {
			$position = 'sidebar';
		}

		if ( 'sidebar' == $position ) :
			?>
			<?php /* translators: $1 and $2 opening and closing strong tags respectively */ ?>
			<h4 class="filter-title"><?php printf( esc_html__( '%1$sFilter%2$s By', 'porto' ), '<strong>', '</strong>' ); ?></h4>
			<ul class="member-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr( $position ); ?>">
				<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
				<?php foreach ( $member_taxs as $tax_slug => $tax_name ) : ?>
					<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<ul class="member-filter nav sort-source" data-position="<?php echo esc_attr( $position ); ?>">
				<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
				<?php foreach ( $member_taxs as $tax_slug => $tax_name ) : ?>
					<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'porto_show_faq_archive_filter' ) ) :
	function porto_show_faq_archive_filter( $position = 'global' ) {
		global $porto_settings;

		$faq_infinite = $porto_settings['faq-infinite'];

		$faq_taxs = array();

		$taxs = get_categories(
			array(
				'taxonomy' => 'faq_cat',
				'orderby'  => isset( $porto_settings['faq-cat-orderby'] ) ? $porto_settings['faq-cat-orderby'] : 'name',
				'order'    => isset( $porto_settings['faq-cat-order'] ) ? $porto_settings['faq-cat-order'] : 'asc',
			)
		);

		foreach ( $taxs as $tax ) {
			$faq_taxs[ urldecode( $tax->slug ) ] = $tax->name;
		}

		if ( ! $faq_infinite ) {
			global $wp_query;
			$posts_faq_taxs = array();
			if ( is_array( $wp_query->posts ) && ! empty( $wp_query->posts ) ) {
				foreach ( $wp_query->posts as $post ) {
					$post_taxs = wp_get_post_terms( $post->ID, 'faq_cat', array( 'fields' => 'all' ) );
					if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
						foreach ( $post_taxs as $post_tax ) {
							$posts_faq_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
						}
					}
				}
			}
			foreach ( $faq_taxs as $key => $value ) {
				if ( ! isset( $posts_faq_taxs[ $key ] ) ) {
					unset( $faq_taxs[ $key ] );
				}
			}
		}

		if ( 'global' !== $position ) {
			$position = 'sidebar';
		}

		if ( 'sidebar' == $position ) :
			?>
			<?php /* translators: $1 and $2 opening and closing strong tags respectively */ ?>
			<h4 class="filter-title"><?php printf( esc_html__( '%1$sFilter%2$s By', 'porto' ), '<strong>', '</strong>' ); ?></h4>
			<ul class="faq-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr( $position ); ?>">
				<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
				<?php foreach ( $faq_taxs as $tax_slug => $tax_name ) : ?>
					<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<ul class="faq-filter nav sort-source" data-position="<?php echo esc_attr( $position ); ?>">
				<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
				<?php foreach ( $faq_taxs as $tax_slug => $tax_name ) : ?>
					<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'porto_show_faq_tax_filter' ) ) :
	function porto_show_faq_tax_filter( $position = 'global' ) {
		global $porto_settings, $wp_query;

		$term    = $wp_query->queried_object;
		$term_id = $term->term_id;

		$faq_infinite = $porto_settings['faq-infinite'];

		$faq_taxs = array();

		$taxs = get_categories(
			array(
				'taxonomy' => 'faq_cat',
				'child_of' => $term_id,
				'orderby'  => isset( $porto_settings['faq-cat-orderby'] ) ? $porto_settings['faq-cat-orderby'] : 'name',
				'order'    => isset( $porto_settings['faq-cat-order'] ) ? $porto_settings['faq-cat-order'] : 'asc',
			)
		);

		foreach ( $taxs as $tax ) {
			$faq_taxs[ urldecode( $tax->slug ) ] = $tax->name;
		}

		if ( ! $faq_infinite ) {
			global $wp_query;
			$posts_faq_taxs = array();
			if ( is_array( $wp_query->posts ) && ! empty( $wp_query->posts ) ) {
				foreach ( $wp_query->posts as $post ) {
					$post_taxs = wp_get_post_terms( $post->ID, 'faq_cat', array( 'fields' => 'all' ) );
					if ( is_array( $post_taxs ) && ! empty( $post_taxs ) ) {
						foreach ( $post_taxs as $post_tax ) {
							$posts_faq_taxs[ urldecode( $post_tax->slug ) ] = $post_tax->name;
						}
					}
				}
			}
			foreach ( $faq_taxs as $key => $value ) {
				if ( ! isset( $posts_faq_taxs[ $key ] ) ) {
					unset( $faq_taxs[ $key ] );
				}
			}
		}

		if ( 'global' !== $position ) {
			$position = 'sidebar';
		}

		// Show Filters
		if ( is_array( $faq_taxs ) && ! empty( $faq_taxs ) ) :
			if ( 'sidebar' == $position ) :
				?>
				<?php /* translators: $1 and $2 opening and closing strong tags respectively */ ?>
				<h4 class="filter-title"><?php printf( esc_html__( '%1$sFilter%2$s By', 'porto' ), '<strong>', '</strong>' ); ?></h4>
				<ul class="faq-filter nav nav-list m-b-lg" data-position="<?php echo esc_attr( $position ); ?>">
					<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
					<?php foreach ( $faq_taxs as $tax_slug => $tax_name ) : ?>
						<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php else : ?>
				<ul class="faq-filter nav sort-source" data-position="<?php echo esc_attr( $position ); ?>">
					<li class="active" data-filter="*"><a href="#"><?php esc_html_e( 'Show All', 'porto' ); ?></a></li>
					<?php foreach ( $faq_taxs as $tax_slug => $tax_name ) : ?>
						<li data-filter="<?php echo esc_attr( $tax_slug ); ?>"><a href="#"><?php echo esc_html( $tax_name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<?php
			endif;
		endif;
	}
endif;

function porto_nofollow_block() {
	$post = isset( $GLOBALS['post'] ) ? $GLOBALS['post'] : null;
	if ( is_singular() && isset( $post->post_type ) && 'porto_builder' === $post->post_type ) {
		echo '<meta name="robots" content="noindex,nofollow" />';
	}
}

if ( ! function_exists( 'porto_portfolio_category_image' ) ) :
	function porto_portfolio_category_image() {
		$term = get_queried_object();
		if ( $term ) {
			$image = get_metadata( $term->taxonomy, $term->term_id, 'category_image', true );
			if ( $image ) {
				echo '<img src="' . esc_url( $image ) . '" class="category-image" alt="' . esc_attr( $term->name ) . '" />';
			}
		}
	}
endif;

function porto_header_elements( $elements, $el_class = '', $is_mobile = false ) {
	if ( ! $elements || empty( $elements ) ) {
		return;
	}
	foreach ( $elements as $element ) {
		global $porto_settings;
		if ( is_array( $element ) ) {
			echo '<div class="header-col-wide">';
				porto_header_elements( $element );
			echo '</div>';
		} else {
			foreach ( $element as $key => $value ) {
				if ( 'porto_block' == $key && $value ) {
					$str = '';
					if ( is_string( $value ) ) {
						$str = $value;
					} elseif ( is_object( $value ) && isset( $value->html ) ) {
						$str = $value->html;
					}
					if ( $str ) {
						echo do_shortcode( '[porto_block name="' . $str . '" el_class="' . ( is_object( $value ) && isset( $value->el_class ) ? $value->el_class : '' ) . '"]' );
					}
				} elseif ( 'html' == $key && $value ) {
					$str = '';
					if ( is_string( $value ) ) {
						$str = $value;
					} elseif ( is_object( $value ) && isset( $value->html ) ) {
						$str = $value->html;
					}
					echo '<div class="custom-html' . ( is_object( $value ) && isset( $value->el_class ) && $value->el_class ? ' ' . esc_attr( $value->el_class ) : '' ) . '">';
						echo do_shortcode( $str );
					echo '</div>';
				} elseif ( 'logo' == $key ) {
					echo porto_logo( false, $el_class );
				} elseif ( 'currency-switcher' == $key ) {
					echo porto_currency_switcher( $el_class );
				} elseif ( 'language-switcher' == $key ) {
					echo porto_view_switcher( $el_class );
				} elseif ( 'mini-cart' == $key ) {
					echo porto_minicart( $el_class );
				} elseif ( 'contact' == $key ) {
					$contact_info = isset( $porto_settings['header-contact-info'] ) ? $porto_settings['header-contact-info'] : '';
					if ( $contact_info ) {
						echo '<div class="header-contact">' . do_shortcode( $contact_info ) . '</div>';
					}
				} elseif ( 'search-form' == $key ) {
					echo porto_search_form( $el_class );
				} elseif ( 'social' == $key ) {
					echo porto_header_socials( $el_class );
				} elseif ( 'menu-icon' == $key ) {
					if ( $is_mobile && 'overlay' == $porto_settings['menu-type'] ) {
						echo porto_main_menu();
					} else {
						echo porto_mobile_toggle_icon();
					}
				} elseif ( 'nav-top' == $key ) {
					echo porto_top_navigation( $el_class );
				} elseif ( 'main-menu' == $key ) {
					if ( porto_header_type_is_side() ) {
						echo porto_header_side_menu();
					} else {
						echo porto_main_menu( 0, $el_class );
					}
				} elseif ( 'main-toggle-menu' == $key ) {
					echo '<div id="main-toggle-menu" class="' . ( $el_class ? $el_class . ' ' : '' ) . ( ( ! $porto_settings['menu-toggle-onhome'] && is_front_page() ) ? 'show-always' : 'closed' ) . '">';
						echo '<div class="menu-title closed">';
							echo '<div class="toggle"></div>';
					if ( $porto_settings['menu-title'] ) {
						echo do_shortcode( $porto_settings['menu-title'] );
					}
						echo '</div>';
						echo '<div class="toggle-menu-wrap side-nav-wrap">';
							echo porto_main_toggle_menu();
						echo '</div>';
					echo '</div>';
				} elseif ( 'secondary-menu' == $key ) {
					echo porto_secondary_menu( 0, $el_class );
				} elseif ( 'menu-block' == $key ) {
					if ( $porto_settings['menu-block'] ) {
						echo '<div class="menu-custom-block">' . wp_kses_post( $porto_settings['menu-block'] ) . '</div>';
					}
				} elseif ( 'divider' == $key ) {
					echo '<span class="separator"></span>';
				} elseif ( 'myaccount' == $key && class_exists( 'Woocommerce' ) ) {
					echo porto_account_menu( $el_class );
				} elseif ( 'wishlist' == $key && class_exists( 'Woocommerce' ) && defined( 'YITH_WCWL' ) ) {
					echo porto_wishlist( $el_class );
				} elseif ( 'compare' == $key && defined( 'YITH_WOOCOMPARE' ) && class_exists( 'YITH_Woocompare' ) ) {
					global $yith_woocompare;
					$compare_count = isset( $yith_woocompare->obj->products_list ) ? sizeof( $yith_woocompare->obj->products_list ) : 0;
					echo '<a href="#" title="' . esc_attr__( 'Compare', 'porto' ) . '" class="yith-woocompare-open' . ( $el_class ? ' ' . esc_attr( $el_class ) : '' ) . '"><i class="porto-icon-compare-link"></i><span class="compare-count">' . intval( $compare_count ) . '</span></a>';
				}
				do_action( 'porto_header_elements', $key, $value );
			}
		}
	}
}

if ( ! function_exists( 'porto_grid_post_column_class' ) ) :
	function porto_grid_post_column_class( $columns ) {
		switch ( $columns ) {
			case '1':
				return 'col-md-12';
			case '2':
				return 'col-md-6';
			case '3':
				return 'col-md-6 col-lg-4';
			case '4':
				return 'col-sm-6 col-lg-3';
			case '5':
				return 'col-sm-6 col-md-4 col-lg-3 col-xl-1-5';
			case '6':
				return 'col-6 col-md-4 col-lg-3 col-xl-2';
			default:
				return 'col-md-6 col-lg-4';
		}
	}
endif;


if ( ! function_exists( 'porto_grid_column_class' ) ) :
	function porto_grid_column_class( $columns, $columns_mobile = 1, $columns_tablet = '', $return_class = true ) {
		$options = array();
		$xxl_name = 'sl';
		if ( ! $return_class ) {
			$xxl_name = 'xxl';
		}
		switch ( $columns ) {
			case '1':
				$options['xs'] = 1;
				break;
			case '2':
				if ( ! $columns_tablet ) {
					$options['md'] = 2;
				} else {
					if ( 2 != $columns_tablet ) {
						$options['lg'] = 2;
					}
					$options['sm'] = $columns_tablet;
				}
				break;
			case '3':
				if ( ! $columns_tablet ) {
					$options['xl'] = 3;
					$options['md'] = 2;
				} else {
					if ( 3 != $columns_tablet ) {
						$options['xl'] = 3;
					}
					if ( $columns_tablet < 2 ) {
						$options['md'] = 2;
					}
					$options['sm'] = $columns_tablet;
				}
				break;
			case '4':
				if ( ! $columns_tablet ) {
					$options['xl'] = 4;
					$options['md'] = 3;
					$options['sm'] = 2;
				} else {
					if ( 4 != $columns_tablet ) {
						$options['lg'] = 4;
					}
					if ( $columns_tablet != $columns_mobile ) {
						$options['sm'] = $columns_tablet;
					}
				}
				break;
			case '5':
				if ( ! $columns_tablet ) {
					$options['xl'] = 5;
					$options['md'] = 4;
					$options['sm'] = 3;
				} else {
					if ( 5 != $columns_tablet ) {
						$options['xl'] = 5;
					}
					if ( 4 != $columns_tablet ) {
						$options['lg'] = 4;
					}
					if ( $columns_tablet != $columns_mobile ) {
						$options['md'] = $columns_tablet;
					}
					if ( $columns_tablet > 1 && $columns_tablet - 1 != $columns_mobile ) {
						$options['sm'] = $columns_tablet - 1;
					}
				}
				break;
			case '6':
				$options['xl'] = 6;
				if ( ! $columns_tablet ) {
					$options['lg'] = 5;
					$options['md'] = 4;
					$options['sm'] = 3;
				} else {
					if ( 5 != $columns_tablet ) {
						$options['lg'] = 5;
					}
					if ( $columns_tablet != $columns_mobile ) {
						$options['md'] = $columns_tablet;
					}
					if ( $columns_tablet > 1 && $columns_tablet - 1 != $columns_mobile ) {
						$options['sm'] = $columns_tablet - 1;
					}
				}
				break;
			case '7':
				$options['xl'] = 7;
				if ( ! $columns_tablet ) {
					$options['lg'] = 6;
					$options['md'] = 4;
					$options['sm'] = 3;
				} else {
					if ( 6 != $columns_tablet ) {
						$options['lg'] = 6;
					}
					if ( $columns_tablet != $columns_mobile ) {
						$options['md'] = $columns_tablet;
					}
					if ( $columns_tablet > 1 && $columns_tablet - 1 != $columns_mobile ) {
						$options['sm'] = $columns_tablet - 1;
					}
				}
				break;
			case '8':
				$options[ $xxl_name ] = 8;
				$options['xl'] = 7;
				if ( ! $columns_tablet ) {
					$options['lg'] = 6;
					$options['md'] = 4;
					$options['sm'] = 3;
				} else {
					if ( 6 != $columns_tablet ) {
						$options['lg'] = 6;
					}
					$options['md'] = $columns_tablet;
					if ( $columns_tablet > 1 && $columns_tablet - 1 != $columns_mobile ) {
						$options['sm'] = $columns_tablet - 1;
					}
				}
				break;
			case '9':
			case '10':
			case '11':
				$options[ $xxl_name ] = $columns;
				$options['xl'] = 8;
				if ( ! $columns_tablet ) {
					$options['lg'] = 6;
					$options['md'] = 5;
					$options['sm'] = 4;
				} else {
					if ( 6 != $columns_tablet ) {
						$options['lg'] = 6;
					}
					if ( $columns_tablet != $columns_mobile ) {
						$options['md'] = $columns_tablet;
					}
					if ( $columns_tablet > 1 && $columns_tablet - 1 != $columns_mobile ) {
						$options['sm'] = $columns_tablet - 1;
					}
				}
				break;
			default:
				$options['lg'] = $columns;
				$options['sm'] = $columns_tablet;
		}
		if ( 1 == $columns ) {
			$columns_mobile = 1;
		}
		$options['xs'] = $columns_mobile;

		$options = apply_filters( 'porto_grid_column_arr', $options, $columns, $columns_mobile, $columns_tablet );
		if ( $return_class ) {
			$cls = 'has-ccols';
			foreach ( $options as $breakpoint => $cols ) {
				if ( 'xs' == $breakpoint ) {
					$cls .= ' ccols-' . $cols;
				} else {
					$cls .= ' ccols-' . $breakpoint . '-' . $cols;
				}
			}
			return apply_filters( 'porto_grid_column_class', $cls, $columns, $columns_mobile, $columns_tablet );
		}
		return $options;
	}
endif;

/**
 * Generate product columns
 *
 * @since 6.4.0
 */
if ( ! function_exists( 'porto_generate_shop_columns' ) ) :

	function porto_generate_shop_columns( $cols = 4, $porto_layout = false ) {
		switch ( $cols ) {
			case 1:
				$cols_md = 1;
				$cols_xs = 1;
				$cols_ls = 1;
				break;
			case 2:
				$cols_md = 2;
				$cols_xs = 2;
				$cols_ls = 1;
				break;
			case 3:
				$cols_md = 3;
				$cols_xs = 2;
				$cols_ls = 1;
				break;
			case 4:
				$cols_md = 3;
				$cols_xs = 3;
				$cols_ls = 2;
				break;
			case 5:
				$cols_md = 4;
				$cols_xs = 3;
				$cols_ls = 2;
				break;
			case 6:
				$cols_md = 4;
				$cols_xs = 3;
				$cols_ls = 2;
				break;
			case 7:
				if ( porto_is_wide_layout( $porto_layout ) ) {
					$cols    = 6;
					$cols_xl = 7;
				}
				$cols_md = 5;
				$cols_xs = 3;
				$cols_ls = 2;
				break;
			case 8:
				if ( porto_is_wide_layout( $porto_layout ) ) {
					$cols    = 7;
					$cols_xl = 8;
				}
				$cols_md = 6;
				$cols_xs = 4;
				$cols_ls = 2;
				break;
			case 9:
				if ( porto_is_wide_layout( $porto_layout ) ) {
					$cols    = 8;
					$cols_xl = 9;
				}
				$cols_md = 7;
				$cols_xs = 5;
				$cols_ls = 3;
				break;
			default:
				$cols    = 4;
				$cols_md = 3;
				$cols_xs = 2;
				$cols_ls = 1;
		}

		$result = array( $cols_ls, $cols_xs, $cols_md, $cols );
		if ( isset( $cols_xl ) ) {
			$result[] = $cols_xl;
		}

		return $result;
	}
endif;

/**
 * Site Metas
 *
 * @since 6.5.0 Updated
 */
function porto_head_metas() {
	global $porto_settings, $porto_settings_optimize;

	// For Favicon
	if ( $porto_settings['favicon'] ) :
		?>
		<link rel="shortcut icon" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $porto_settings['favicon']['url'] ) ); ?>" type="image/x-icon" />
		<?php
	endif;

	// For iPhone
	if ( $porto_settings['icon-iphone'] ) :
		?>
		<link rel="apple-touch-icon" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $porto_settings['icon-iphone']['url'] ) ); ?>" />
		<?php
	endif;

	// For iPhone Retina
	if ( $porto_settings['icon-iphone-retina'] ) :
		?>
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $porto_settings['icon-iphone-retina']['url'] ) ); ?>" />
		<?php
	endif;

	// For iPad
	if ( $porto_settings['icon-ipad'] ) :
		?>
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $porto_settings['icon-ipad']['url'] ) ); ?>" />
		<?php
	endif;

	// For iPad Retina
	if ( $porto_settings['icon-ipad-retina'] ) :
		?>
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', $porto_settings['icon-ipad-retina']['url'] ) ); ?>" />
		<?php
	endif;

	if ( isset( $porto_settings_optimize['preload'] ) ) {
		if ( in_array( 'porto', $porto_settings_optimize['preload'] ) ) {
			echo '<link rel="preload" href="' . PORTO_URI . '/fonts/porto-font/porto.woff2" as="font" type="font/woff2" crossorigin />';
		}
		$font_awesome_font = ! empty( $porto_settings_optimize['optimize_fontawesome'] ) ? 'fontawesome_optimized' : 'fontawesome';
		if ( in_array( 'fas', $porto_settings_optimize['preload'] ) ) {
			echo '<link rel="preload" href="' . PORTO_URI . '/fonts/' . $font_awesome_font . '/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin />';
		}
		if ( in_array( 'far', $porto_settings_optimize['preload'] ) ) {
			echo '<link rel="preload" href="' . PORTO_URI . '/fonts/' . $font_awesome_font . '/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin />';
		}
		if ( in_array( 'fab', $porto_settings_optimize['preload'] ) ) {
			echo '<link rel="preload" href="' . PORTO_URI . '/fonts/' . $font_awesome_font . '/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin />';
		}
		if ( in_array( 'sli', $porto_settings_optimize['preload'] ) ) {
			echo '<link rel="preload" href="' . PORTO_URI . '/fonts/Simple-Line-Icons/Simple-Line-Icons.ttf" as="font" type="font/ttf" crossorigin />';
		}
	}
	if ( ! empty( $porto_settings_optimize['preload_custom'] ) ) {
		$font_urls = explode( PHP_EOL, $porto_settings_optimize['preload_custom'] );
		foreach ( $font_urls as $font_url ) {
			$dot_pos = strrpos( $font_url, '.' );
			if ( false !== $dot_pos ) {
				$type       = substr( $font_url, $dot_pos + 1 );
				$font_type  = array( 'ttf', 'woff', 'woff2', 'eot' );
				$image_type = array( 'jpg', 'jpeg', 'png', 'svg', 'gif', 'webp' );
				if ( in_array( $type, $font_type ) ) {
					echo '<link rel="preload" href="' . esc_url( $font_url ) . '" as="font" type="font/' . esc_attr( $type ) . '" crossorigin />';
				} elseif ( in_array( $type, $image_type ) ) {
					echo '<link rel="preload" href="' . esc_url( $font_url ) . '" as="image" />';
				} else {
					echo '<link rel="preload" href="' . esc_url( $font_url ) . '" />';
				}
			}
		}
	}

	// Open Graph
	if ( empty( $porto_settings['open-graph'] ) || ( isset( $_REQUEST['action'] ) && 'yith-woocompare-view-table' == $_REQUEST['action'] ) ) {
		return;
	}
	// Early exit if this is not a singular post/page/cpt.
	if ( ! is_singular() ) {
		return;
	}
	if ( function_exists( 'rank_math' ) ||  defined( 'WPSEO_VERSION' ) || defined( 'AIOSEO_PHP_VERSION_DIR' ) ) { // yoast seo
		return;
	}
	global $post;

	$image = '';
	if ( ! has_post_thumbnail( $post->ID ) ) {
		if ( ! empty( $porto_settings['logo'] ) ) {
			$image = $porto_settings['logo'];
		}
	} else {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		if ( ! empty( $thumbnail_src[0] ) ) {
			$image = esc_attr( $thumbnail_src[0] );
		}
	}

	if ( is_array( $image ) ) {
		$image = ( isset( $image['url'] ) && ! empty( $image['url'] ) ) ? $image['url'] : '';
	}
	$meta_title = strip_tags( str_replace( [ '"', "'" ], [ '&quot;', '&#39;' ], $post->post_title ) );
	?>
	<meta name="twitter:card" content="summary_large_image">
	<meta property="twitter:title" content="<?php echo esc_attr( $meta_title ); ?>"/>
	<meta property="og:title" content="<?php echo esc_attr( $meta_title ); ?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="<?php echo esc_url_raw( get_permalink() ); ?>"/>
	<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
	<meta property="og:description" content="<?php echo porto_trim_description( $post->post_content ); ?>"/>

	<?php if ( '' != $image ) : // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison ?>
		<?php if ( is_array( $image ) ) : ?>
			<?php if ( isset( $image['url'] ) ) : ?>
				<meta property="og:image" content="<?php echo esc_url_raw( $image['url'] ); ?>"/>
			<?php endif; ?>
		<?php else : ?>
			<meta property="og:image" content="<?php echo esc_url_raw( $image ); ?>"/>
		<?php endif; ?>
	<?php endif; ?>
	<?php
}

add_filter( 'language_attributes', 'porto_add_og_doctype' );
/**
 * Adding the Open Graph in the Language Attributes
 *
 * @since 6.5.0
 */
function porto_add_og_doctype( $doctype ) {
	if ( function_exists( 'rank_math' ) || defined( 'WPSEO_VERSION' ) || defined( 'AIOSEO_PHP_VERSION_DIR' ) ) { // yoast seo
		return $doctype;
	}

	global $porto_settings;
	if ( empty( $porto_settings['open-graph'] ) ) {
		return $doctype;
	}
	return $doctype . ' prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"';
}
