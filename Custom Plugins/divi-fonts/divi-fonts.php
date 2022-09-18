add_filter('et_websafe_fonts', 'load_divi_custom_font',10,2);

function load_divi_custom_font($fonts) {
  wp_enqueue_style( 'divi-child', get_stylesheet_directory_uri() . '/webfonts/stylesheet.css' );
  // Add multiple fonts to Divi's font menu
  $custom_font = array('Gotham' => array(
    'styles'        => '400italic,700italic,400,700',
    'character_set' => 'latin',
    'type'          => 'sans-serif',
    'standard'      => 1
  ),
  'Gotham Book' => array(
    'styles'        => '400italic,700italic,400,700',
    'character_set' => 'latin',
    'type'          => 'sans-serif',
    'standard'      => 1
  ));

  return array_merge($custom_font,$fonts);
}