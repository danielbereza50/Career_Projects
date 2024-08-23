<?php



$html .= '<div class = "calculator-container">';

	$html .= '<div class = "calculator-top">
				<div class = "calculator-top-item top-text"><span>Contractor Employee Cost Comparison Calculator</span></div>
				<div class = "calculator-top-item top-image"><img src="/wp-content/plugins/contractor-calculator/public/images/ATS-logo-transparent.webp" alt="" width="100%"> </div>
			</div>';


	$tables = [
		'Internal Employees' => [
			'rows' => [
				
				'Hourly Pay Rate' => '
				
				<div class = "internal-input">
					$ <input type="number" id="internal-hourly-pay" name="internal-hourly-pay" size="10" placeholder = "Please enter" />
				</div>
				
				',
				
				'Fringe Benefits/Taxes*
				
				<ul>
					<li> FICA</li>
					<li> Workers’ Compensation</li>
					<li> Unemployment</li>
					<li> Federal Taxes</li>
					<li> Holiday Pay, Sick Leave,</li>
					<li> Vacation Pay</li>
				</ul>
				
				' => '<div class = "internal-fringe">$<span class = "IFA">0</span>/HR</div>',
				
				'Administrative/Payroll**' => '<div class = "internal-payroll">$<span class = "IPA">0</span>/HR</div>',
				
				'Recruiting Costs***' => '<div class = "internal-recruiting">$<span class = "IRA">0</span>/HR</div>',
				
				'Total' => '<div class = "internal-total">$<span class = "ITA">0</span>/HR</div>',
				
				'' => ''
				
			]
		],
		'Contract/Temporary Employee' => [
			'rows' => [
				
				'Hourly Bill Rate<br>(pay rate x mark-up % rate)' => '
				
				<div class="contract-input">
					<label for="internal-hourly-pay">Office Bill Rate - </label>
					$ <input type="number" id="temporary-office-pay" name="temporary-office" size="10" placeholder="Please enter" />
				</div>
				<div class="contract-input">
					<label for="internal-hourly-pay">Field Bill Rate - </label>
					$ <input type="number" id="temporary-field-pay" name="temporary-field" size="10" placeholder="Please enter" />
				</div>
				
				
				',
				
				'Fringe Benefits/Taxes*
				
				<ul>
					<li> FICA</li>
					<li> Workers’ Compensation</li>
					<li> Unemployment</li>
					<li> Federal Taxes</li>
					<li> Holiday Pay, Sick Leave,</li>
					<li> Vacation Pay</li>
				</ul>
				' => '<div class = "contract-fringe">$<span class = "CFA">0</span>/HR</div>',
				
				'Administrative/Payroll' => '<div class = "contract-payroll">$<span class = "CPA">0</span>/HR</div>',
				'Recruiting Costs' => '<div class = "contract-recruiting"><span class = "CRA">$0</span>/HR</div>',
				
				'Total' => '<div class = "contract-total-office">Office - $<span class = "CTOA">0</span>/HR</div>
							<div class = "contract-total-field">Field - $<span class = "CTFA">0</span>/HR</div>
				
				',
				
				'<span class = "savings-txt">Savings Per Hour</span>' => '
				
							<div class = "contract-savings-office"><span class = "savings-txt">Office - $<span class = "CSOA">0</span>/HR</span></div>
							<div class = "contract-savings-field"><span class = "savings-txt">Field - $<span class = "CSFA">0</span>/HR</span></div>',
				
				
				
			]
		]
	];

	$html .= '<div class="calculator">';
		$count = 0;
		foreach ($tables as $heading => $table) {

		$sanitized_heading = strtolower(str_replace([' ', '/'], '-', $heading));
			
		$html .= '<div class="item-outer '.$sanitized_heading.'">
						<div class="item-heading heading-'.$sanitized_heading.'">' . $heading . '</div>
						<table class="calculator-table">
						  ';

			foreach ($table['rows'] as $input => $output) {
				
				// Use ternary operators to check the conditions
				$extraClass = empty($input) ? 'empty-row' : '';
				$extraClass .= ($input === 'Hourly Pay Rate') ? ' hourly-rate-row' : '';
				$extraClass .= (stripos($input, 'Fringe Benefits/Taxes') !== false) ? ' fringe-row' : '';
				
				$extraClass .= (stripos($input, 'Administrative/Payroll') !== false) ? ' admin-row' : '';
				$extraClass .= (stripos($input, 'Recruiting Costs') !== false) ? ' recruiting-row' : '';
				
				$extraClass .= ($input === 'Total') ? ' total-row' : '';
				

				$html .= '<tr class="calculator-row ' . $extraClass . '">
							<td class="calculator-cell">' . $input . '</td>
							<td class="calculator-cell">' . $output . '</td>
						  </tr>';
				
				
			}

			$html .= '</table>
					  </div><!-- end of item outer -->';
			$count++;
		}

		$html .= ' <input type="hidden" name="totalRecruitingCostROI" id="totalRecruitingCostROI" value="4700">';
		$html .= '<input type="hidden" name="annualHoursWorkedROI" id="annualHoursWorkedROI" value="2080">';
	$html .= '</div><!-- end of calculator -->
	
	
	
	<table class = "bottom-table">
				<tbody>
					<tr class="calculator-row">
						<td class="">
							<div>*Based on National Average of 38% (U.S Department of Labor, 2023)</div>
							<div>**National Average of 12% (U.S. Department of Labor, 2023)</div>
							<div>*** National Average of $4,700 (SHRM, 2023)</div>
						</td>
				  </tbody>
				</table>
				
				<div class = "bottom-info-container">
				
				
				   <div class = "calculation-container">
					<div class = "">$<span class="CSOA"></span>/HR x 2080 hours/year = <span class = "savings-txt">Saving per clerical employee/year of 
					     $<span class = "footer-yearly-savings"></span></div>
						 
					<div class = "">$<span class = "CSFA"></span>/HR x 2080 hours/year = <span class = "savings-txt">Saving per field employee/year of 
						 $<span class = "footer-yearly-field"></span></div>
				   </div>
					
	
					<ul>';
					
						
						global $wpdb;

						// Raw SQL query to get the JSON value from the options table
						$existing_bullet_items = $wpdb->get_var("
						
						SELECT option_value 
						FROM {$wpdb->prefix}options 
						WHERE option_name = 'roi_bullet_items'
						
						");
						//print_r($existing_bullet_items);


						// Decode the JSON value into an array
						$bullet_items_array = $existing_bullet_items ? json_decode($existing_bullet_items, true) : [];

						// Check if the array is not empty before displaying
						if (!empty($bullet_items_array)) {
							foreach ($bullet_items_array as $item) {
								// Create a list item for each bullet point
								$html .= '<li>' . esc_html($item) . '</li>';
							}
						} else {
							$html .= '<p>No bullet items found.</p>'; // Message if no items exist
						}
							
							
			
					$html .= '</ul>
					
				</div>
			</div> 
			
			
		';
