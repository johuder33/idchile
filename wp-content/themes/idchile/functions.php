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
	$templateControls = wcustom_get_template( 'woocommerce/loop/controls-button' );
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
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 16;' ), 20 );

// shorcode to show add to cart button
//echo do_shortcode('[add_to_cart id="99"]');
// shorcode to show add to cart button

// Single Product Page

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);

add_action('wc_custom_before_column_image_product', 'wc_column_image_open_single_product',10);

function wc_column_image_open_single_product(){
	$open_tag = '<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">';
	$open_tag .= '<article class="product-box product-elastic-box">';
	echo $open_tag;
}

add_action('wc_custom_after_column_image_product', 'wc_column_image_close_single_product',10);

function wc_column_image_close_single_product(){
	$close_tag = '</article>';
	$close_tag .= '</div>';
	echo $close_tag;
}

add_action('wc_custom_open_container_image_product', 'wc_image_open_single_product',10);

function wc_image_open_single_product(){
	$open_image = "<figure>";
	echo $open_image;
}

add_action('wc_custom_close_container_image_product', 'wc_image_close_single_product',10);

function wc_image_close_single_product(){
	$close_image = "</figure>";
	echo $close_image;
}

add_action('wc_custom_combo_image_product', 'wc_image_single_product',5);
add_action('wc_custom_combo_image_product', 'wc_open_figcaption_single_product',10);
//add_action('wc_custom_combo_image_product', 'woocommerce_template_single_title',15);
add_action('wc_custom_combo_image_product', 'woocommerce_template_single_price',20);
add_action('wc_custom_combo_image_product', 'wc_close_figcaption_single_product',25);

function wc_image_single_product(){
	$image = wcustom_get_template( 'woocommerce/single-product/product-image' );

	echo $image;
}

function wc_open_figcaption_single_product(){
	$open = '<figcaption>';
	echo $open;
}

function wc_close_figcaption_single_product(){
	$close = '</figcaption>';
	echo $close;
}

add_action('wc_custom_controlbox_single_product', 'wcustom_template_loop_product_get_controls',10);

add_action( 'wc_custom_before_summary_image_product', 'wc_custom_open_summary_single_product', 10 );

add_action('wc_custom_title_summary_single_product', 'woocommerce_template_single_title', 10);
add_action('wc_custom_title_summary_single_product', 'woocommerce_template_single_add_to_cart', 15);

add_action( 'wc_custom_after_summary_image_product', 'wc_custom_close_summary_single_product', 10 );

function wc_custom_open_summary_single_product(){
	$open = '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-lg-push-1 col-md-push-1">';
	$open .= '<div class="list-attr-item">';

	echo $open;
}

function wc_custom_close_summary_single_product(){
	$close = '</div>';
	$close .= '</div>';

	echo $close;
}

add_action( 'wc_custom_list-attributes_image_product', 'wc_custom_get_attrs_single_product', 10 );

function wc_custom_get_attrs_single_product(){
	global $product;

	$product->list_attributes();
}

// remove hook for count result products
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
// remove hook for breadcrumbs;
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_filter('parseURL', 'get_url_to_parse', 10, 2);

function get_url_to_parse($var_name, $slug){
	// get the current url
	$current_url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$current_url = array_shift(explode('?', $current_url));
	// get and merge all parameters
	$params = array_merge($_GET, array($var_name => $slug));
	// build the new url
	$paramsParse = http_build_query($params);

	$current_url .= '?'.$paramsParse;

	return $current_url;
}

add_filter('getUrl', 'handleUrl');

function handleUrl($path){
	if(is_home()) {
		return $path;
	}

	return bloginfo('url').$path;
}

// Metabox for custom fields to products
add_filter( 'rwmb_meta_boxes', 'wc_products_meta_boxes' );

function wc_products_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => __( 'Manual', 'manual_field' ),
        'post_types' => 'product',
        'context' => 'side',
        'priority' => 'low',
        'desc' => '',
        'fields'     => array(
            array(
                'id'   => 'manual',
                'name' => __( 'Manual', 'manual_field' ),
                'type' => 'file_advanced',
            )
        ),
    );

    /*
    Esto para asignar posts
    $meta_boxes[] = array(
        'title'      => __( 'Marcas', 'carousel_brands' ),
        'post_types' => 'marcas',
        'context' => 'advanced',
        'priority' => 'low',
        'desc' => 'Imagenes para el carrusel de las marcas',
        'fields'     => array(
            array(
                'id'   => 'carousel_brands',
                'name' => __( 'Marcas', 'carousel_brands' ),
                'type' => 'image_advanced',
            ),
            array(
                'id'   => 'post_selected	',
                'name' => __( 'Marcas', 'carousel_brands' ),
                'type' => 'post',
                'field_type' => 'select',
                'query_args' => get_posts()
            )
        ),
    );*/

    return $meta_boxes;
}


add_action('display_custom_cart', 'wc_display_custom_cart');

function wc_display_custom_cart() {
	global $woocommerce;
	$payment_page = get_permalink( woocommerce_get_page_id( 'pay' ) );

	if ( sizeof( $woocommerce->cart->cart_contents) > 0 ) :
		$cart = sprintf('
			<li class="btn-group">
				<a href="%s" class="btn btn-info btn-xs">
					<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
					<span class="badge currentTotalCart">%s</span>
				</a>
			</li>
			', $woocommerce->cart->get_cart_url(), sizeof( $woocommerce->cart->cart_contents)
		);

		echo $cart;
	endif;
}

// add filter to make a minithumbnail for cart images

add_filter('custom_crop_image_cart', 'wc_custom_crop', 10 , 2);

function wc_custom_crop($post_id, $permalink){
	if ($post_id) {
		$size = array(30,30);
		$image = get_the_post_thumbnail($post_id, $size);
		printf('<a href="%s">%s</a>', $permalink, $image);
	}
}

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;

  $fragments['currentTotal'] = sizeof( $woocommerce->cart->cart_contents);

  return $fragments;
}


/**
 * Add action to woocommerce_before_main_content to add container html on archive-product
 */

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper_start', 10);
/*add_action('woocommerce_before_main_content', 'wc_opener_container_tag', 10);

function wc_opener_container_tag() {
	echo "<div class='container'>";
}*/

/**
 * Add action to woocommerce_before_main_content to add container html on archive-product
 */

/*remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'wc_closer_container_tag', 10);

function wc_closer_container_tag() {
	echo "</div>";
}*/

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

// Our hooked in function - $fields is passed via the filter!
function custom_override_checkout_fields( $fields ) {

		$fields['billing']['billing_first_name']['class'] = array('col-xs-6');
    $fields['billing']['billing_first_name']['input_class'] = array('form-control');
    $fields['billing']['billing_first_name']['label_class'] = array('custom-require');
    $fields['billing']['billing_first_name']['label'] = 'Nombres';
		$fields['billing']['billing_first_name']['clear'] = false;


    $fields['billing']['billing_last_name']['class'] = array('col-xs-6');
    $fields['billing']['billing_last_name']['input_class'] = array('form-control');
    $fields['billing']['billing_last_name']['label_class'] = array('custom-require');
    $fields['billing']['billing_last_name']['label'] = 'Apellidos';
    $fields['billing']['billing_last_name']['clear'] = false;


    $fields['billing']['billing_company']['class'] = array('col-xs-12');
    $fields['billing']['billing_company']['input_class'] = array('form-control');
    $fields['billing']['billing_company']['label_class'] = array('custom-require');
    $fields['billing']['billing_company']['label'] = 'Compañia';
    $fields['billing']['billing_company']['clear'] = false;

    
    $fields['billing']['billing_email']['class'] = array('col-xs-6');
    $fields['billing']['billing_email']['input_class'] = array('form-control');
    $fields['billing']['billing_email']['label_class'] = array('custom-require');
    $fields['billing']['billing_email']['label'] = 'Correo Electrónico';
    $fields['billing']['billing_email']['clear'] = false;

    $fields['billing']['billing_phone']['class'] = array('col-xs-6');
    $fields['billing']['billing_phone']['input_class'] = array('form-control');
    $fields['billing']['billing_phone']['label_class'] = array('custom-require');
    $fields['billing']['billing_phone']['label'] = 'Teléfono';
    $fields['billing']['billing_phone']['clear'] = false;

    $fields['billing']['billing_address_1']['class'] = array('col-xs-6');
    $fields['billing']['billing_address_1']['input_class'] = array('form-control');
    $fields['billing']['billing_address_1']['label_class'] = array('custom-require');
    $fields['billing']['billing_address_1']['label'] = 'Dirección';
    $fields['billing']['billing_address_1']['clear'] = false;

    $fields['billing']['billing_address_2']['class'] = array('col-xs-6');
    $fields['billing']['billing_address_2']['input_class'] = array('form-control');
    $fields['billing']['billing_address_2']['label_class'] = array('custom-require');
    $fields['billing']['billing_address_2']['label'] = 'Dirección Adicional';
    $fields['billing']['billing_address_2']['clear'] = false;

    $fields['billing']['billing_city']['class'] = array('col-xs-6');
    $fields['billing']['billing_city']['input_class'] = array('form-control');
    $fields['billing']['billing_city']['label_class'] = array('custom-require');
    $fields['billing']['billing_city']['label'] = 'Ciudad';
    $fields['billing']['billing_city']['clear'] = false;

    $fields['billing']['billing_postcode']['class'] = array('col-xs-6');
    $fields['billing']['billing_postcode']['input_class'] = array('form-control');
    $fields['billing']['billing_postcode']['label_class'] = array('custom-require');
    $fields['billing']['billing_postcode']['label'] = 'Código Postal';
    $fields['billing']['billing_postcode']['clear'] = false;

    $fields['billing']['billing_state']['class'] = array('col-xs-6');
    $fields['billing']['billing_state']['input_class'] = array('form-control');
    $fields['billing']['billing_state']['label_class'] = array('custom-require');
    $fields['billing']['billing_state']['label'] = 'Estado';
    $fields['billing']['billing_state']['clear'] = false;

    $customer_country = WC()->countries->get_base_country();
    $woocommerce->countries->countries[ $customer_country ];
    $fields['billing']['billing_country']['class'] = array('col-xs-6');
    $fields['billing']['billing_country']['input_class'] = array('form-control');
    $fields['billing']['billing_country']['label_class'] = array('custom-require');
    $fields['billing']['billing_country']['label'] = 'País';
    $fields['billing']['billing_country']['clear'] = false;
    $fields['billing']['billing_country']['type'] = 'text';
    $fields['billing']['billing_country']['custom_attributes'] = array('readonly' => 'readonly');

    $fields['order']['order_comments']['input_class'] = array('form-control no-resize');
    $fields['order']['order_comments']['label'] = 'Especifícaciones del pedido';
    $fields['order']['order_comments']['custom_attributes'] = array('rows' => 5);

    return $fields;
}

add_action('phpmailer_init','send_smtp_email');
function send_smtp_email( $phpmailer )
{
    // Define que estamos enviando por SMTP
    $phpmailer->isSMTP();
 
    // La dirección del HOST del servidor de correo SMTP p.e. smtp.midominio.com
    $phpmailer->Host = "smtp.live.com";
 
    // Uso autenticación por SMTP (true|false)
    $phpmailer->SMTPAuth = true;
 
    // Puerto SMTP - Suele ser el 25, 465 o 587
    $phpmailer->Port = "587";
 
    // Usuario de la cuenta de correo
    $phpmailer->Username = "johudergb@hotmail.com";
 
    // Contraseña para la autenticación SMTP
    $phpmailer->Password = "10deabril";
 
    // El tipo de encriptación que usamos al conectar - ssl (deprecated) o tls
    $phpmailer->SMTPSecure = "tls";
 
    $phpmailer->From = "johudergb@hotmail.com";
    $phpmailer->FromName = "Johuder Gonzalez";
}


add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Custom Post for sections
add_action('init', 'theme_custom_types');

function theme_custom_types() {
    add_custom_post_type(
    	array(
        'type' => 'nosotros',
        'menu_name' => 'Nosotros',
				'plural' => 'Articulos de Nosotros',
        'supports' => array('title', 'thumbnail', 'editor')
      ),
    'admin-home');

    add_custom_post_type(
    	array(
        'type' => 'servicios',
        'menu_name' => 'Servicios',
				'plural' => 'Articulos de Servicios',
        'supports' => array('title', 'thumbnail', 'editor')
      ),
    'admin-home');

    add_custom_post_type(
    	array(
        'type' => 'marcas',
        'menu_name' => 'Marcas',
				'plural' => 'Articulos de Marcas',
        'supports' => array('title', 'editor')
      ),
    'admin-home');
};

?>