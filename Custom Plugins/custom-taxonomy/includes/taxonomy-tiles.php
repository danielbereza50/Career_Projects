<?php
function list_terms_custom_taxonomy( $atts ) {?>
<?php
	// Inside the function we extract custom taxonomy parameter of our shortcode
 
    extract( shortcode_atts( array(
        'custom_taxonomy' => '',
    ), $atts ) );
 
	// arguments for function wp_list_categories
	$args = array( 
		'taxonomy' => $custom_taxonomy,
		'title_li' => ''
	);
	$html .= '<div class="flex_tile_container">';
	$categories = get_categories( $args );
	  foreach ( $categories as $category ): 

	$html .= '<div class="taxonomy_tile" style="background-image:url('. z_taxonomy_image_url($category->term_id). ')">';		
	$html .= '<a href="' . get_category_link( $category->term_id ). '">';
	$html .= '<div class="title_container">';
	$html .= '<div class = "title">' . $category->name . '</div>';
	$html .= '</div>';
	$html .= '</a>';
	$html .= '</div>';
			
        endforeach;
        $html .= '</div>';
        return $html;
}
 
add_shortcode( 'taxonomy_tile', 'list_terms_custom_taxonomy' );
 




