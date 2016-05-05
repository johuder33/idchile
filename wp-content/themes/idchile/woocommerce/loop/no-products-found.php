<?php
/**
 * Displayed when no products are found matching the current query
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/no-products-found.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$refer_url = $_SERVER['HTTP_REFERER'];
$short_refer_url = explode('//', $refer_url);
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (count($short_refer_url) === 2){
	$short_refer_url = $short_refer_url[1];
}

if ($short_refer_url === $url) {
	$refer_url = get_site_url();
}

?>

<div class="woocommerce-error text-center">
	<div class="alert alert-danger" role="alert">
		<p>
			<strong>
				<i class="fa fa-meh-o fa-3x" aria-hidden="true"></i>
				<?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?>
				<a href="<?php echo $refer_url; ?>">Regresar atras</a>
			</strong>
		</p>
	</div>
</div>
