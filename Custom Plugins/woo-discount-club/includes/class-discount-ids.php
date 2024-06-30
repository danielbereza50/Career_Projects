<?php

/**
 * Update a linked list from an array of results and store it in an option.
 *
 * @param array $results   The array of results containing IDs.
 * @param string $optionName   The name of the option to store the serialized IDs.
 *
 * @return void
 */

function updateLinkedListAndOption($results, $optionName) {
    $linked_list = array(); // Initialize the linked list

    if (!empty($results)) {
        foreach ($results as $row) {
            $ID = $row->ID;
            $node = array('ID' => $ID, 'next' => null);

            // Insert the node into the linked list
            if (empty($linked_list)) {
                $linked_list = $node;
            } else {
                $current = &$linked_list;
                while (!empty($current['next'])) {
                    $current = &$current['next'];
                }
                $current['next'] = $node;
            }
        }

        // Initialize an array to store the IDs
        $idsArray = array();

        // Traverse the linked list and store the IDs in the array
        $current = &$linked_list;
        while (!empty($current)) {
            $idsArray[] = $current['ID'];
            $current = &$current['next'];
        }

        // Serialize the array to a string
        $serializedIds = serialize($idsArray);

        // Store the serialized string in the specified option
        update_option($optionName, $serializedIds);

        // Traverse the linked list and print the IDs
        $current = &$linked_list;
        while (!empty($current)) {
            // echo $current['ID'];

            // Add a comma and space for separation, except for the last item
            if (!empty($current['next'])) {
                // echo ', ';
            }

            $current = &$current['next'];
        }
    } else {
        echo 'No results found.';
    }
	
	
}
updateLinkedListAndOption($results_30, 'discount_ids_30');
updateLinkedListAndOption($results_20, 'discount_ids_20');
updateLinkedListAndOption($results_10, 'discount_ids_10');
