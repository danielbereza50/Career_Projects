<?php


					$html .= '<div class="callout">
					  <div class="callout-header">Hint</div>
					  <div id="hint" class="callout-container">
						Hover over a empty row for a hint!
					  </div>
					</div>';

						// class = "mobile-crossword"
						$html .= '<div id="react-puzzle-component" class = "mobile-crossword" data-page-id="' . esc_attr($page_id) . '"></div>';
						$html .= '<div class="container-puzzle desktop-crossword" data-page-id="' . esc_attr($page_id) . '">';
							$html .= '<button class="btn" id="btnCreate">Create</button>';
							$html .= '<button class="btn" id="btnPlay">Play</button>';
							$html .= '<div class="center crossword" id="crossword"></div>'; 
							$counter = 0;
							$html .= '<div class="center">';
								if ($results) {
									// Loop through the results
									foreach ($results as $row) {

										// Check if the row contains the 'puzzle_meta' key
										if (isset($row->puzzle_meta)) {
											// Decode the JSON string to an array
											$word_hint_pairs = json_decode($row->puzzle_meta, true);
										} elseif (isset($row->meta_value)) {
											// Unserialize the PHP serialized data to an array
											$word_hint_pairs = unserialize($row->meta_value);
										} else {
											// Handle case where no 'puzzle_meta' or 'meta_value' key is found
											$html .= '<p>Error: Unable to find puzzle data</p>';
											continue; // Skip to the next row
										}

										// Check if decoding/unserialization was successful and $word_hint_pairs is an array
										if (is_array($word_hint_pairs)) {
											$html .= '<div class="hint-container">';
											// Loop through the word and hint pairs
											foreach ($word_hint_pairs as $pair) {
												$counter++;
												// Output HTML for each pair
												$html .= '<div class="line">';
												$html .= '<span class="number">' . $counter . '</span>';
													$html .= '<input class="word" data-word="' . esc_attr($counter) . '" type="text" value="' . esc_attr($pair['word']) . '" disabled />';
													$html .= '<input class="clue" data-hint="' . esc_attr($counter) . '" value="' . esc_attr($pair['hint']) . '" disabled />';
												$html .= '</div>';
											}
											$html .= '</div>';
										} else {
											// Handle case where decoding/unserialization fails
											$html .= '<p>Error: Unable to decode/unserialize puzzle data</p>';
										}
									}
								} else {
									// Handle case where no results are found
									$html .= '<p>No results found</p>';
								}

							$html .= '</div>';

						$html .= '</div>'; // end of the container





