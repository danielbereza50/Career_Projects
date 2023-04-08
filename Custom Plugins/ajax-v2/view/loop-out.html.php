<div class = "professional-wrapper">
			<?php 
			$the_query->the_post(); 
			$image = get_field( "image" ); ?>
				<div class = "professional-item">
					<img src="<?php echo $image ?>" alt="" width="200" height="200"> 
				</div>
				<div class = "professional-item">
					<span class = "professional-name"><?php echo the_title(); ?></span>
					<?php echo the_excerpt(); ?>	
					<div class = "button-container">
						<a href = "<?php echo get_post_permalink() ?>">
							<div class = "read-more">Read More</div>
						</a>	
					</div>	
				</div>
</div>
<hr>