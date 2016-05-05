<?php

global $query_string;

get_header();

?>

<div class="container">
	<?php
		if(have_posts()) {
			while(have_posts()) {
				the_post();
				get_template_part('content', 'search');
			}
		} else {
				get_template_part( 'content', 'notfound' );
		}
	?>
</div>

<?php

get_footer();

?>