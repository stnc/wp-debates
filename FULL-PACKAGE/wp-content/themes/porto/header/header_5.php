<?php
global $porto_settings, $porto_layout;
?>
<header id="header" class="header-5<?php echo empty( $porto_settings['logo-overlay'] ) || empty( $porto_settings['logo-overlay']['url'] ) ? '' : ' logo-overlay-header'; ?>">
	<?php if ( $porto_settings['show-header-top'] ) : ?>
	<div class="header-top">
		<div class="container">
			<div class="header-left">
				<?php
				// show social links
				echo porto_header_socials();

				// show welcome message
				if ( $porto_settings['welcome-msg'] ) {
					echo '<span class="welcome-msg">' . do_shortcode( $porto_settings['welcome-msg'] ) . '</span>';
				}
				?>
			</div>
			<div class="header-right">
				<?php
				// show currency and view switcher
				$currency_switcher = porto_currency_switcher();
				$view_switcher     = porto_view_switcher();

				if ( $currency_switcher || $view_switcher ) {
					echo '<div class="switcher-wrap">';
				}

				echo porto_filter_output( $view_switcher );

				if ( $currency_switcher && $view_switcher ) {
					echo '<span class="gap switcher-gap">|</span>';
				}

				echo porto_filter_output( $currency_switcher );

				if ( $currency_switcher || $view_switcher ) {
					echo '</div>';
				}
				?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="header-main">
		<div class="container">
			<div class="header-left">
				<?php echo porto_logo(); ?>
			</div>
			<div class="header-center">
				<?php
				// show search form
				echo porto_search_form();

				// show mobile toggle
				echo porto_mobile_toggle_icon();
				?>
			</div>
			<div class="header-right">
				<div>
					<?php
					// show contact info and top navigation
					$contact_info = $porto_settings['header-contact-info'];

					if ( $contact_info ) {
						echo '<div class="header-contact">' . do_shortcode( $contact_info ) . '</div>';
					}

					$top_nav = porto_top_navigation();

					if ( $contact_info && $top_nav ) {
						echo '<span class="gap contact-gap">|</span>';
					}

					echo porto_filter_output( $top_nav );
					?>
					<div id="main-menu">
						<?php echo porto_main_menu(); ?>
					</div>
					<?php echo porto_minicart(); ?>
				</div>

				<?php get_template_part( 'header/header_tooltip' ); ?>

			</div>
		</div>
		<?php get_template_part( 'header/mobile_menu' ); ?>
	</div>
</header>
