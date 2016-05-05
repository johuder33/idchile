<?php

get_header();

get_template_part('banner');

?>

<div class="container">

<?php

while(have_posts()):the_post();

get_template_part( 'template-parts/content', 'page' );

endwhile;

?>

</div>

<?PHP

get_footer();

?>