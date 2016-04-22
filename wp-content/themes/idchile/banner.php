<section class="banner">
	<div class="wrap-sliders">
		<?php
			if(is_home()){
				?>
					<img src="<?php bloginfo('template_url'); ?>/assets/images/banners/banner.png" alt="Banner" class="img-responsive center-block">
				<?php
			}else{
				?>
					<img src="<?php bloginfo('template_url'); ?>/assets/images/banners/bannersection.png" alt="Banner" class="img-responsive center-block">
				<?php
			}
		?>
	</div>
	<div class="line_bottom"></div>
</section>