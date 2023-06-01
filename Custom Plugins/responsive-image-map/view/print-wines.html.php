<?php 
	
    extract( shortcode_atts( array(
        'region' => '',
    ), $atts) );
    
	   $args = array(
		'post_type' => 'wines',
		'posts_per_page' => -1,
		'orderby' => 'date',
		 'order' => 'ASC',
		  'tax_query' => array(
			array(
			  'taxonomy' => 'wine-region',
			  'field' => 'slug',
			  'terms' => $region,
			),
		  ),
		 );
     $loop = new WP_Query($args);
	
	
	//print_r($loop);
     if($loop->have_posts()) {	 ?>
        <div class="wines_container">
        <?php while($loop->have_posts()) : $loop->the_post(); ?>
            <div class="wines">
                <div class="wine_title"> 
                     <?php echo get_the_title(); ?> 
                </div>
            </div>
            <?php endwhile; ?>	 
            <!-- loop the wines container --> 
        </div>
<?php }
	if(!$loop->have_posts()) {
		echo 'No wines were found';
	}