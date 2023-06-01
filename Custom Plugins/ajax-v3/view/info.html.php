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

	global $wpdb; 
	$results = $wpdb->get_results( "SELECT p.ID, p.post_title, pm1.meta_value, pm2.meta_value
	FROM {$wpdb->prefix}posts p
	
	LEFT JOIN {$wpdb->prefix}postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'featured_professional' AND pm1.meta_value = 'yes')
	LEFT JOIN {$wpdb->prefix}postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'last_name')
	
	WHERE p.post_type = 'professionals'
	AND p.post_status = 'publish'
	ORDER BY (pm1.meta_value = 'yes') DESC, pm2.meta_value ASC" );

?>
<div id = "results" class = "professionals-container">
<?php
	 
	include(__DIR__.'/../view/loop-out.html.php');
	  

?>
</div>