<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<div class="container-table margin-top">

<div class="clearfix row-header">
	<div class="col-xs-1 text-center">
		<h4><br></h4>
	</div>

	<div class="col-xs-2 text-center">
		<h4><br></h4>
	</div>

	<div class="col-xs-3 text-center">
		<h4>Producto</h4>
	</div>

	<div class="col-xs-2 text-center">
		<h4>Precio</h4>
	</div>

	<div class="col-xs-2 text-center">
		<h4>Cantidad</h4>
	</div>

	<div class="col-xs-2 text-center">
		<h4>Total</h4>
	</div>
</div>

<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 
				&& apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

				?>

					<div class="clearfix row-item">
						<div class="col-xs-1 text-center">
							<a class="btn btn-danger" href="<?php echo esc_url( WC()->cart->get_remove_url( $cart_item_key ) ); ?>">
							  <i class="fa fa-trash-o" title="Delete" aria-hidden="true"></i>
							  <span class="sr-only">Delete</span>
							</a>
						</div>

						<div class="col-xs-2 text-center">
							<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if ( ! $_product->is_visible() ) {
									echo $thumbnail;
								} else {
									apply_filters('custom_crop_image_cart', $_product->id, esc_url( $_product->get_permalink( $cart_item ) ));
								}
							?>
						</div>

						<div class="col-xs-3 text-center" data-title="<?php _e( 'Product', 'woocommerce' ); ?>">
							<?php
								if ( ! $_product->is_visible() ) {
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
								} else {
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
								}

								// Meta data
								echo WC()->cart->get_item_data( $cart_item );

								// Backorder notification
								if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
									echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>';
								}
							?>
						</div>

						<div class="col-xs-2 text-center" data-title="<?php _e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</div>

						<div class="col-xs-2 text-center" data-title="<?php _e( 'Quantity', 'woocommerce' ); ?>">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {
									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										'min_value'   => '0'
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
							?>
						</div>

						<div class="col-xs-2 text-center" data-title="<?php _e( 'Total', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</div>
					</div>

				<?php

			}
		}

		do_action( 'woocommerce_cart_contents' );
		do_action( 'woocommerce_after_cart_contents' );
?>


<?php /*do_action( 'woocommerce_cart_collaterals' ); ?>

<div class="clearfix divider-top">
	<div class="col-xs-12">
		<?php if ( wc_coupons_enabled() ) { ?>
			<div class="form-inline text-center block-coupon">
				<div class="form-group">
					<input type="text" name="coupon_code" class="form-control margin-right" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
					<input type="submit" class="btn btn-custom uppercase" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />	
					<?php do_action( 'woocommerce_cart_coupon' ); ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<?php
*/
?>

<div class="clearfix divider-top">
	<div class="col-xs-12 text-center">
		<div class="center-block block-coupon clearfix">
			<div class="col-xs-4">
				<a href="<?php bloginfo('url'); ?>/productos" class="btn btn-primary">Seguir Comprando</a>
			</div>

			<div class="col-xs-4">
				<input type="submit" class="btn-nomakeup uppercase btn btn-custom" name="update_cart" value="<?php esc_attr_e( 'Update Cart', 'woocommerce' ); ?>" />
			</div>

			<div class="col-xs-4">
				<a href="<?php bloginfo('url'); ?>/checkout" class="btn btn-info">Realizar Pedido</a>
			</div>

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</div>
	</div>
</div>

</div>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
