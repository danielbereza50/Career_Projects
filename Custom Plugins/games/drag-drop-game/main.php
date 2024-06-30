<?php
/*
    Plugin Name: Drag and Drop
    Plugin URI:  
    Description: Simple drag and drop game you can play on a wordpress page.
    Version:     100.0.0
    Author:      
    Author URI:  
    License:     GPL2
    License URI: Licence URl
*/

add_action( 'wp_enqueue_scripts', 'my_custom_script_load' );
function my_custom_script_load(){
    wp_register_style('main-css', plugins_url('public/css/main.css',__FILE__ ));
    wp_enqueue_style('main-css');

    
    wp_enqueue_script('jquery');
    
    wp_register_script( 'main-js', plugins_url('public/js/game.js',__FILE__ ));
    wp_enqueue_script('main-js');   



}
add_shortcode('play_game', 'game_shortcode');
function game_shortcode() {
	 ob_start();
    ?>
         <div class="game-container">
        <?php
        $numbers = range(1, 10);
        shuffle($numbers);
        for ($i = 0; $i < 10; $i++) {
            $number = $numbers[$i];
            echo '<div class="box" draggable="true" data-number="'.$number.'">'.$number.'</div>';
        }
        ?>
    </div>
    
    <div class="game-container">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo '<div class="target" data-number="'.$i.'">Drop '.$i.'</div>';
        }
        ?>
    </div>
    <div class="score">Score: 0</div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}



