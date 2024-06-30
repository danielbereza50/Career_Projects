<?php

		$total_spent = 'total-spent';
		$amount_spent = 'amount-spent';

		
		if($total_spent_final > 500){
				 $formatted_total_spent = number_format($total_spent_final);

			 echo "<div class = ".$total_spent."><span class = ".$amount_spent.">Total Spent: $" . $formatted_total_spent . '</span><span class="qualify"> - You Qualify</span></div>';


				// Update qualify_for_discount to 1
				$sql_update = $wpdb->prepare(
					"UPDATE $wpdb->users
					SET qualify_for_discount = 1
					WHERE ID = %d",
					$user_id
				);

				$result = $wpdb->query($sql_update);

				if (false !== $result) {
					// echo 'User ' . $user_id . ' updated successfully.';
				} else {
				  //	echo 'Error updating user ' . $user_id . ': ' . $wpdb->last_error;
				}


		}
		if($total_spent_final < 500){
			echo "<div class = ".$total_spent.">Total Spent: $" . $total_spent_final .  '<span class = "do-not-qualify"> - You Do Not Qualify</span></div>';

			// Update qualify_for_discount to 1
			$sql_update = $wpdb->prepare(
				"UPDATE $wpdb->users
				SET qualify_for_discount = 0
				WHERE ID = %d",
				$user_id
			);

			$result = $wpdb->query($sql_update);

			if (false !== $result) {
			   // echo 'User ' . $user_id . ' updated successfully.';
			} else {
			  //  echo 'Error updating user ' . $user_id . ': ' . $wpdb->last_error;
			}

		}