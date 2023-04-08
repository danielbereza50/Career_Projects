<form id="professionals-form" method="post">
	<div class = "flex-form-container">
		<div class = "flex-form-item state">
			<?php
				$terms = get_terms( array(
					'taxonomy' => 'state',
					'hide_empty' => false,
				) );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					echo '<select id="state" name="state">';
					echo '<option value="">Choose state</option>';
					foreach ( $terms as $term ) {
						echo '<option value="' . $term->name . '">' . $term->name . '</option>';
					}
					echo '</select>';
				} ?>	
		</div>
		<div class = "flex-form-item expert">	
			<?php
				$terms = get_terms( array(
					'taxonomy' => 'expertise',
					'hide_empty' => false,
				) );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					echo '<select id="expertise" name="expertise">';
					echo '<option value="">Choose specialty</option>';
					foreach ( $terms as $term ) {
						echo '<option value="' . $term->name . '">' . $term->name . '</option>';
					}
					echo '</select>';
				} ?>	
		</div>
		<div class = "flex-form-item kw">
			<input type="text" id="professional" name="professional" placeholder="Search by name/keyword">
		</div>
		<div class = "flex-form-item reset">
			<div class="button-container-reset">
							<div id = "clear">Reset</div>
			</div>
		</div>
	</div>
</form>
<?php
	$the_query = new WP_Query( array(
		'post_type' => 'professionals',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
	)); 
?>
<div id = "results" class = "professionals-container">
<?php
	if ( $the_query->have_posts() ){
		while ( $the_query->have_posts() ) : 

			include(__DIR__.'/../view/loop-out.html.php');

		endwhile; 
	}else{
		echo 'No results returned';
	} ?>
</div>	