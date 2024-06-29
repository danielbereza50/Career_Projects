<?php


    $school_user_id = get_current_user_id();
    // Call the function
    $result = get_completed_courses_count($school_user_id);

    $completed_courses_count = $result['completed_courses_count'];
    $total_time_spent_hours = $result['total_time_spent_hours'];
    //$average_time_spent_per_course = $result['average_time_spent_per_course'];

    include(THEME_PATH . '/models/get_daily_totals.php');

    //print_r($day_totals);
        
    /*
        Array ( [Sunday] => 0 [Monday] => 1085 [Tuesday] => 365 [Wednesday] => 0 [Thursday] => 0 [Friday] => 0 [Saturday] => 0 ) 
    */


        echo '<div class = "activity-container">';
            echo '<div class = "activity-left-side">';
                echo '<h2>Performance</h2>';
                echo '<div class = "performance-wrapper">';
                        echo '<div class = "performance-item">';
                            echo '<div class = "performance-image time-spent"><img src="/wp-content/uploads/2024/05/Icon-auto-stories-transparent.png" alt="Double Check Icon"></div>';
                
                            // Now you can use $completed_courses_count and $total_time_spent_hours as needed
                            echo "<div>Time Spent (hours): </div>";
                            echo '<div><b>'.$total_time_spent_hours.'</b></div>';
                        echo '</div>';

                        echo '<div class = "performance-item">';
                            echo '<div class = "performance-image average"><img src="/wp-content/uploads/2024/05/Icon-hourglass-bottom-transparent.png" alt="Double Check Icon"></div>';
                            echo "<div>Average / Day: </div>";
                            echo $average_hours;
                            




                        echo '</div>';

                        echo '<div class = "performance-item">';
                            echo '<div class = "performance-image finished"><img src="/wp-content/uploads/2024/05/Icon-check-double-transparent.png" alt="Double Check Icon"></div>';

                            // Now you can use $completed_courses_count and $total_time_spent_hours as needed
                            echo "<div>Finished Courses: </div>";
                            echo '<div><b>'.$completed_courses_count.'</b></div>';
                        echo '</div>';
                echo '</div>'; // end of wrapper
                


                echo '<h2>My Sessions</h2>';
                echo '<div class = "sessions-container">';  
                
                

                    echo '<div class = "session-container">';

                        // Example usage:
                        echo '<h4>Yesterday</h4>';
                        display_session_posts($one_days_ago_unique_course_ids);
                        echo '<hr>';
                        echo '<h4>Last 7 Days</h4>';
                        display_session_posts($seven_days_ago_unique_course_ids);








                    echo '</div>';

                echo '</div>';


            echo '</div>';

            echo '<div class = "activity-right-side">';
                    echo '<div class = "activity-graph-container">';
                        echo '<h2>Time Spent</h2>';
                        // Calculate total seconds spent
                        $total_seconds = array_sum($day_totals);
                        // Convert total seconds to hours
                        $total_hours = $total_seconds / 3600;
                        $total_hours = round($total_seconds / 3600, 2);

                        echo "$total_hours  hours";

                        echo '<canvas id="user_activity_graph" style="width:100%;max-width:600px"></canvas>';

                    echo '</div>';
            echo '</div>';

        echo '</div>';

        

        
















