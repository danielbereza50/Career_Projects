<form id="course-category-form" method="post">
	<div class = "flex-form-container">
		<div class = "flex-form-item course-category">
			<?php
				$terms = get_terms( array(
					'taxonomy' => 'ld_course_category',
					'hide_empty' => false,
				) );
				if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
					echo '<select id="course-category" name="ccategory">';
					echo '<option value="">Select Category</option>';
					foreach ( $terms as $term ) {
						echo '<option value="' . $term->name . '">' . $term->name . '</option>';
					}
					echo '</select>';
				} ?>	
		</div>
		<!--<div class = "flex-form-item reset">
			<div class="button-container-reset">
					<div id = "clear">Reset</div>
			</div>
		</div>-->
	</div>
</form>
<?php
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; // Get the current page number
	$the_query = new WP_Query( array(
		'post_type' => 'sfwd-courses',
		'posts_per_page' => -1,
		'orderby' => 'date',
 	  	'order' => 'ASC', 
		'paged' => $paged
	)); 
?>
<div id = "results" class = "sfwd-courses-container">
<?php
	if ( $the_query->have_posts() ){
		while ( $the_query->have_posts() ) : 	
		
		  include(__DIR__.'/../view/loop-out.html.php');

		endwhile; 
	}else{
		echo 'No results returned';
	} 
	
	// Display pagination links
    echo '<div id="pagination" class = "pagination">';
    echo paginate_links( array(
        'total' => $the_query->max_num_pages,
        'current' => $paged,
        'prev_text' => __( 'Prev', 'textdomain' ),
        'next_text' => __( 'Next', 'textdomain' ),
    ) );
    echo '</div>';
	?>
</div>	
<div class="modal"><!-- Place at bottom of page --></div>
<?php




