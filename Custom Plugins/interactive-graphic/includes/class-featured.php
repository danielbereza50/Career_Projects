<?php

	/**
	 * Display Featured Graphic Shortcode.
	 *
	 * This shortcode function, 'display_featured_graphic', generates and returns
	 * HTML content. It can be used as a template for implementing
	 * more complex functionality related to featured graphics.
	 *
	 * @return string HTML content.
	*/

	add_shortcode('display_featured_graphic', 'get_featured_graphic');
	function get_featured_graphic(){
		$featured_image_base .= BM_INDEX .'public/images/cropped/';
		//  https://bmc4roof.com/wp-content/plugins/bryn-morgan/public/images/loading.gif

		$featured_images = [
			'state-normal' => ['file' => 'cropped-state-normal@2x.png', 'name' => 'Normal'],
			'state-1@2x'   => ['file' => 'cropped-state-1@2x.png', 'name' => 'Gutters'],
			'state-2@2x'   => ['file' => 'cropped-state-2@2x.png', 'name' => 'Bathroom'],
			'state-3@2x'   => ['file' => 'cropped-state-3@2x.png', 'name' => 'Storm Repair'],
			'state-4@2x'   => ['file' => 'cropped-state-4@2x.png', 'name' => 'House Flipping'],
			'state-5@2x'   => ['file' => 'cropped-state-5@2x.png', 'name' => 'Roofing'],
			'state-6@2x'   => ['file' => 'cropped-state-6@2x.png', 'name' => 'Basement'],
		];

		// print_r($featured_images);

		// indices: 0,1,2,3,4,5
		$featured_items = [
			'roofing' => [
				'id' => 'roofing-item',
				'class' => 'service-item',
				'data-image-index' => $featured_images['state-5@2x']['file'],
				'title' => 'Roofing',
				'body' => 'We are roofing specialists',
			],
			'gutters' => [
				'id' => 'gutters-item',
				'class' => 'service-item',
				'data-image-index' => $featured_images['state-1@2x']['file'],
				'title' => 'Gutters',
				'body' => 'If you are experiencing clogged or leaking gutters, call us for fast, professional replacement.',
			],
			'basement' => [
				'id' => 'basement-item',
				'class' => 'service-item',
				'data-image-index' => $featured_images['state-6@2x']['file'],
				'title' => 'Basement Remodels',
				'body' => 'Comfortable, stylish basement remodels that are upscale and contemporary, while also comfortable and practical.',
			],
			'bathroom' => [
				'id' => 'bathroom-item',
				'class' => 'service-item',
				'data-image-index' => $featured_images['state-2@2x']['file'],
				'title' => 'Bathroom Remodels',
				'body' => 'Our bathroom remodeling work is outstanding. We deliver beautiful designs with old-world craftsmanship to each project.',
			],
			'house_flipping' => [
				'id' => 'house-flipping-item',
				'class' => 'service-item',
				'data-image-index' => $featured_images['state-4@2x']['file'],
				'title' => 'House Flipping / Renovation',
				'body' => 'We will work with you to find economical and eye-catching solutions to all projects.',
			],
			'storm_repair' => [
				'id' => 'storm-repair-item',
				'class' => 'service-item',
				'data-image-index' => $featured_images['state-3@2x']['file'],
				'title' => 'Storm Repair',
				'body' => 'We mobilize our crew quickly and get the job done, with minimal downtime for your business or family.',
			],
		];

		// Start HTML content
		$html = '<div class="interactive-image-layout">';
			  $html .= '<div class="column left">';

				for ($i = 0; $i < 3; $i++) {
					$item = $featured_items[array_keys($featured_items)[$i]];
					$html .= '<div id="' . $item['id'] . '" class="' . $item['class'] . '" data-image-index="' . $item['data-image-index'] . '">
								<h2 class="image-title">' . $item['title'] . '</h2>
								<p class="image-body-txt">' . $item['body'] . '</p>
								
							  </div>';
				}	

			  $html .= '</div>';


			// Middle column with interactive image
			$image_url = $featured_image_base . $featured_images['state-normal']['file'];	
			$html .= '<div class="column middle">
							<img id = "featured-service-image" src="' . $image_url . '" alt="Interactive Image">
					  </div>

					  <div class = "modal"></div>

					  <script>
						var featuredImageBase = "' . $featured_image_base . '";
					 </script>';


			// Right column with text
			$html .= '<div class="column right">';

			for ($i = 3; $i < 6; $i++) {
				$item = $featured_items[array_keys($featured_items)[$i]];
				$html .= '<div id="' . $item['id'] . '" class="' . $item['class'] . '" data-image-index="' . $item['data-image-index'] . '">
				
							<h2 class="image-title">' . $item['title'] . '</h2>
							<p class="image-body-txt">' . $item['body'] . '</p>
							
						  </div>';
			}

			$html .= '</div>';


		// Close the layout container
		$html .= '</div>';

		return $html;
	}









