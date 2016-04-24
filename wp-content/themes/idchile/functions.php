<?php

$category = 'Producto Destacado';
$category_slug = 'featured';

// agregamos los estilos
wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
wp_enqueue_style('swiper_css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css');
wp_enqueue_style('style', get_stylesheet_uri());

// agregamos los js
wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js', array(), '1.12.2', true);
wp_enqueue_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array(), '3.3.6', true);
wp_enqueue_script('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js', array(), '3.3.1', true);
wp_enqueue_script('idchile', get_template_directory_uri().'/assets/js/idchile.js', array(), '', true);

// start tag to wrap for list of each product in products page
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
add_action('woocommerce_before_shop_loop_item', 'wcustom_template_loop_product_link_open', 10);

function wcustom_template_loop_product_link_open(){
	$open_tags = '<article class="product-box single-product">';

	echo $open_tags;
}

// close tag to wrap for list of each product in products page
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10);
add_action('woocommerce_after_shop_loop_item', 'wcustom_template_loop_product_link_close', 10);

function wcustom_template_loop_product_link_close(){
	$close_tags = '</article>';

	echo $close_tags;
}

//modify how display our image
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
// add new hooks for images
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_thumbnail_open_tag', 5);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_add_onsale', 10);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_thumbnail', 15);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_open_tag_info', 20);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_title', 25);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_price', 30);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_close_tag_info', 35);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_get_controls', 40);
add_action('woocommerce_before_shop_loop_item_title', 'wcustom_template_loop_product_thumbnail_close_tag', 45);

function wcustom_template_loop_product_thumbnail_open_tag(){
	echo "<figure>";
}

function wcustom_template_loop_product_add_onsale(){
	$onSaleTag = wcustom_get_template( 'woocommerce/loop/sale-flash' );
	echo $onSaleTag;
}

function wcustom_template_loop_product_thumbnail(){
	global $post;
	$size = array(265,265);
	$classes = 'img-responsive';
	$onSaleTag = wcustom_get_template( 'woocommerce/loop/sale-flash' );
	$format = '<div class="wrap-img-product"><img src="%s" class="%s" /></div>';

	//get_the_post_thumbnail($post->ID, $size ,$attrs);
	if(has_post_thumbnail()){
		$url = get_the_post_thumbnail_url($post->ID, $size);
		$image = sprintf($format, $url, $classes);
	}

	echo $image;

	/*<figcaption class="figcaption">
						<h2>Sed Ut Perspiciatis</h2>
						<span class="price">$680.00</span>
					</figcaption>*/
}

function wcustom_template_loop_product_open_tag_info(){
	echo '<figcaption class="figcaption">';
}

function wcustom_template_loop_product_title(){
	global $product;
	$title = sprintf('<h2>%s</h2>', get_the_title());
	echo $title;
}

function wcustom_template_loop_product_price(){
	global $post;
	$priceTemplate = wcustom_get_template( 'woocommerce/loop/price' );
	echo $priceTemplate;
	//echo the_permalink();
}

function wcustom_template_loop_product_close_tag_info(){
	echo '</figcaption>';
}

function wcustom_template_loop_product_get_controls(){
	$templateControls = $onSaleTag = wcustom_get_template( 'woocommerce/loop/controls-button' );
	echo $templateControls;
}

function wcustom_template_loop_product_thumbnail_close_tag(){
	echo "</figure>";
}

// helpers
function wcustom_get_template($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

add_action('custom_pagination_wc', 'custom_pagination_before_tag', 10);
add_action('custom_pagination_wc', 'custom_pagination', 20);
add_action('custom_pagination_wc', 'custom_pagination_after_tag', 30);

function custom_pagination_before_tag(){
	echo '<div class="row"><nav class="wrap-pagination text-center">';
}

function custom_pagination() {
    global $wp_query;

    $big = 999999999; // need an unlikely integer
    $pages = paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'prev_next' => false,
      'type'  => 'array',
      'prev_next'   => TRUE,
			'prev_text'    => __('<i class="glyphicon glyphicon-chevron-left"></i>'),
			'next_text'    => __('<i class="glyphicon glyphicon-chevron-right"></i>'),
    ) );

    if( is_array( $pages )  && count($pages) > 0) {
      $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');

      echo '<ul class="pagination">';
        foreach ( $pages as $page ) {
        	if(strpos($page, 'current')){
        		$currentPage = str_replace('current', 'disabled', $page);
        		$link = "<li class='active'>$currentPage</li>";
        	}else{
        		$link = "<li>$page</li>";
        	}
        	echo $link;
        }
     	echo '</ul>';
    }
}

function custom_pagination_after_tag(){
	echo '</nav></div>';
}

// limit how many products will be shown in th store page
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 8;' ), 20 );

// shorcode to show add to cart button
//echo do_shortcode('[add_to_cart id="99"]');
// shorcode to show add to cart button

?>