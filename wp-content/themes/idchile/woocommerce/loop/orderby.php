<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<form class="woocommerce-ordering" method="get">
	<div class="row all-products-block">
		<section class="controls-filters clearfix">
			<div class="col-xs-6 clearfix">
				<div class="pull-left">
					<?php
						$parentid = get_queried_object_id();

						$args = array(
							'parent' => 0
						);

						$terms = get_terms('product_cat', $args);

						if(count($terms) > 0){
							?>
							<div class="clearfix container-cat">
								<h3>Categorias: </h3>
								<ul class="list-inline ul-inline">
									<?php
										foreach($terms as $term){
											if($term->slug !== 'featured') {
												?>
													<li class="pull-left">
														<a href="<?php echo apply_filters( 'parseURL', 'product_cat', $term->slug); ?>"><?php echo $term->name;?></a>
													</li>
												<?php
											}
										}
									?>
								</ul>
							</div>
							<?php
						}
					?>

					<div class="controls">
						<div class="form-group wrap-form">
					    <label for="models" class="control-label">Modelos:</label>
					    <div class="wrap-select">
					      <select name="models" id="models" class="form-control">
									<option value="1">Modelo Uno</option>
									<option value="2">Modelo Dos</option>
									<option value="3">Modelo Tres</option>
								</select>
					    </div>
					  </div>

					  <div class="form-group wrap-form">
					    <label for="brands" class="control-label">Marcas:</label>
					    <div class="wrap-select">
					      <select name="brands" id="brands" class="form-control">
									<option value="1">Marca Uno</option>
									<option value="2">Marca Dos</option>
									<option value="3">Marca Tres</option>
								</select>
					    </div>
					  </div>

					</div>
				</div>
			</div>

			<div class="col-xs-6 clearfix">
				<div class="pull-right">
					<h3>Filtrar: </h3>
					<ul class="list-inline ul-inline">
						<li>
							<a href="<?php echo apply_filters( 'parseURL', 'orderby', 'price-desc'); ?>">Mayor precio</a>
						</li><!--
						--><li>
							<a href="<?php echo apply_filters( 'parseURL', 'orderby', 'price'); ?>">Menor precio</a>
						</li>
					</ul>

					<div class="control-button">
						<button class="btn btn-sm-btn-default custom-btn" id="comparer">
							comparar productos
						</button>
					</div>
				</div>
			</div>
		</section>
	</div>

<?php
	// Keep query string vars intact
	foreach ( $_GET as $key => $val ) {
		if ( 'orderby' === $key || 'submit' === $key ) {
			continue;
		}
		if ( is_array( $val ) ) {
			foreach( $val as $innerVal ) {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
			}
		} else {
			echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
		}
	}
?>

</form>

<?php
/*
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
</form>
*/
?>
