<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$has_row    = false;
$alt        = 1;
$attributes = $product->get_attributes();
$counter = 0;

ob_start();

?>

<div class="attr-item brand-attr">
	<article class="optionBuy">
		<div>CARACTERÍSTICAS:</div>

		<?php if ( $product->enable_dimensions_display() ) : ?>
				<div class="brand-tag">
					<span class="text-line"><?php _e( 'Weight', 'woocommerce' ) ?></span>
					<article class="features">
						<span class="text-line"><?php echo $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ); ?></span>
					</article>
				</div>
		<?php endif; ?>

		<?php if ( $product->has_dimensions() ) : $has_row = true; ?>
				<div class="brand-tag">
					<span class="text-line"><?php _e( 'Dimensions', 'woocommerce' ) ?></span>
					<article class="features">
						<span class="text-line"><?php echo $product->get_dimensions(); ?></span>
					</article>
				</div>
		<?php endif; ?>

		<?php foreach ( $attributes as $attribute ) : ?>
				<?php $label = wc_attribute_label( $attribute['name'] ); ?>
				<div class="brand-tag">
					<span class="text-line"><?php echo $label; ?></span>
					<article class="features">
						<span class="text-line">
							<?php
								if ( $attribute['is_taxonomy'] ) {

									$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
									echo wptexturize( implode( ', ', $values ) );
									//echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

								} else {

									// Convert pipes to commas and display values
									$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
									/*echo wpautop( wptexturize( implode( ', ', $values ) ) );
									echo wptexturize( implode( ', ', $values ) );
									echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );*/
									echo wptexturize( implode( ', ', $values ) );

								}
							?>
						</span>
					</article>
				</div>
		<?php
			$counter++; 
			endforeach; 
		?>

	</article>
</div>

<?php
if ( $has_row ) {
	echo ob_get_clean();
} else {
	ob_end_clean();
}
