<?php 
class controller_class{
    public function __construct()
    {
		$this->location();
    }
	public function location()
    {
        add_action('wp_head', array($this, 'ajax'));
    }
	public function route() {
	  register_rest_route( 'myplugin/v1', '/author/(?P<id>\d+)', array(
		'methods' => 'GET',
		'callback' => array($this,'my_awesome_func')
	  ) );
	}
	public function my_awesome_func( $data ) {
	  $posts = get_posts( array(
		'author' => $data['id'],
	  ) );

	  if ( empty( $posts ) ) {
		return 'nope';
	  }

	  return $posts[0]->post_title;
	}
	public function ajax(){ ?>
	<script>
	   jQuery(document).ready(function(){ 

	   // make a call to the server
	   jQuery.ajax({
			url: '/wordpress/wp-json/myplugin/v1/author/1',
			method: 'GET',
			data: {
				id: 1
			},
			success: function( data ) {
				console.log( data );
				jQuery('#replace').html( data );
			}
		});
	 });  
	</script>
	<?php
	}
}
$controller_obj = new controller_class();