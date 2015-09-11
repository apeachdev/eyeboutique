<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php if ( WC()->cart->needs_shipping() && ! WC()->cart->ship_to_billing_address_only() ) : ?>

	<?php
		if ( empty( $_POST ) ) {

			$ship_to_different_address = get_option( 'woocommerce_ship_to_billing' ) == 'no' ? 1 : 0;
			$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

		} else {

			$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

		}
	?>
    
    <h3><?php _e( 'Shipping Address', 'mr_tailor' ); ?></h3>

	<div id="ship-to-different-address">
		<input id="ship-to-different-address-checkbox" class="input-checkbox check_box" <?php checked( $ship_to_different_address, 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
        <label for="ship-to-different-address-checkbox" class="checkbox check_label"><?php _e( 'Ship to a different address?', 'mr_tailor' ); ?></label>
	</div>

	<div class="shipping_address">

		<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

		<?php foreach ($checkout->checkout_fields['shipping'] as $key => $field) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>

		<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

	</div>

<?php endif; ?>

<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

	<?php if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) : ?>

		<h3><?php _e( 'Additional Information', 'mr_tailor' ); ?></h3>

	<?php endif; ?>

	<?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) : ?>

		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

	<?php endforeach; ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>