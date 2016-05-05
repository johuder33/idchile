<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

if ( has_post_thumbnail() ) {
	$image_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
	$image_link    = wp_get_attachment_url( get_post_thumbnail_id() );
	/*$image         = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
		'title'	=> get_the_title( get_post_thumbnail_id() )
	) );*/

	$attachment_count = count( $product->get_gallery_attachment_ids() );

	/*if ( $attachment_count > 0 ) {
		$gallery = '[product-gallery]';
	} else {
		$gallery = '';
	}*/

} else {
	$image_link = wc_placeholder_img_src();
}

//do_action( 'woocommerce_product_thumbnails' );

?>

<img src="<?php echo $image_link; ?>" alt="<?php echo $image_caption; ?>" title="<?php echo $image_caption; ?>" class="img-responsive center-block">

<!--<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
	<article class="product-box product-elastic-box">
		
		<figure>
			<img src="<?php echo $image_link; ?>" alt="<?php echo $image_caption; ?>" title="<?php echo $image_caption; ?>" class="img-responsive center-block">
			<figcaption class="figcaption">
				<h2>Sed Ut Perspiciatis</h2>
				<span class="price">$680.00</span>
			</figcaption>
		</figure>

		<div class="controls-box">
			<div class="view">
				<a href="!#">Ver Más</a>
			</div>

			<div class="subControls">
				<div class="heart"></div>
				<div class="save"></div>
			</div>
		</div>
	</article>
</div>-->
