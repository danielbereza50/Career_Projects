<?php

function my_test_theme_enqueue_scripts() {
  // enqueue jQuery and AngularJS
  wp_enqueue_script( 'custom-js','https://code.jquery.com/jquery-2.2.4.min.js',NULL,true );
  wp_register_script('angular-core', 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.14/angular.js', array(), null, false);
  wp_enqueue_script('angular-route', '//ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular-route.min.js', array('angular-core'), null, false);


  wp_register_script('angular-app', '/wp-content/themes/Divi-Child-212/app.js', array('angular-core'), null, false);

  // enqueue all scripts
  wp_enqueue_script('angular-core');
  wp_enqueue_script('angular-route');
  wp_enqueue_script('angular-app');
  wp_enqueue_script('angular-directives');
}
add_action('wp_enqueue_scripts', 'my_test_theme_enqueue_scripts');

function do_donate(){

   $html .= '<div ng-app="MyApp" ng-controller="MyController">
    <button ng-click="redirect()" class = "donate">Yes I would like to donate</button>
  </div>';

	return $html;
}
add_shortcode('donate-btn', 'do_donate');