<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div id="payment" class="woocommerce-checkout-payment">
<?php do_action( 'porto_woocommerce_after_checkout_table' ); ?>
<?php if ( porto_checkout_version() == 'v2' ) : ?>
	<h3><?php esc_html_e( 'Payment methods', 'woocommerce' ); ?></h3>
<?php endif; ?>

<?php if ( WC()->cart->needs_payment() ) : ?>
	<div class="porto-separator m-b-md"><hr class="separator-line  align_center"></div>
	<h4 class="px-2"><?php esc_html_e( 'Payment methods', 'woocommerce' ); ?></h4>
	<ul class="wc_payment_methods payment_methods methods px-2">
		<?php
		if ( ! empty( $available_gateways ) ) {
			foreach ( $available_gateways as $gateway ) {
				wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
			}
		} else {
			echo '<li>';
			wc_print_notice( apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ), 'notice' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
			echo '</li>';
		}
		?>
	</ul>
	<div class="porto-separator m-b-lg"><hr class="separator-line  align_center"></div>
<?php endif; ?>
	<div class="form-row place-order">
		<noscript>
			<?php /* translators: $1 and $2 opening and closing emphasis tags respectively */ ?>
			<?php printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' ); ?>
			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
		</noscript>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php if ( 'v2' == porto_checkout_version() ) : ?>

			<h3>
				<?php esc_html_e( 'Grand Total:', 'porto' ); ?>&nbsp;&nbsp;
				<span><?php wc_cart_totals_order_total_html(); ?></span>
			</h3>

		<?php endif; ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt btn-v-dark w-100 mt-3 py-3" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">'. esc_html( $order_button_text ) .'</button>' ); // @codingStandardsIgnoreLine ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>
</div>
<?php
if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
