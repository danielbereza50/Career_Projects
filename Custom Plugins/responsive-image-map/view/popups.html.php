<?php
	   $args = array(
			'posts_per_page' => -1,
			'post_type'     => 'winery-location',
			'orderby' => 'date',
			'order' => 'DESC',
		);
		$latest = new WP_Query( $args ); 
		while( $latest->have_posts() ) : $latest->the_post(); 
			$slug = get_post_field( 'post_name', get_the_ID() ); ?>
		<h2><?php //echo $slug;  ?></h2>
		<div id="popup-<?php echo $slug ?>" class = "popup">
			<a href = "<?php echo get_permalink( get_the_ID() ) ?>">
					<div class = "overlay-image">
					  <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 'class' => '' ) ); ?>
					</div>
				<div class = "overlay-txt">
					  <?php echo get_the_title( get_the_ID() ); ?>
				</div>
			</a>
		</div>
		<?php endwhile; 
		 wp_reset_postdata(); 



