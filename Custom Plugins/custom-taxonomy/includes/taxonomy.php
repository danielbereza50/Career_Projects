<?php
// class name
class taxonomy
{
    // class properties
    private $current_cat_1;
    private $current_cat_2;
    private $current_cat_3;

    // class methods
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_shortcode('taxonomy', array(
            $this,
            'check_for_taxonomy'
        ));
    }

    public static function check_for_taxonomy()
    {
        ob_start();

        $current_cat_1 = get_query_var('industry');
        $current_cat_2 = get_query_var('applications');
        $current_cat_3 = get_query_var('materials');

        /* start of Industry */

        $args_1 = array(
            'post_type' => 'solutions',
            'industry' => $current_cat_1
        );

        query_posts($args_1);

        $queried_object_1 = get_queried_object();

        //$term_name_1 = $queried_object_1->name;
        $term_description_1 = $queried_object_1->description;

        // print_r($term_name_1);
        $html_1 .= $term_description_1;

        if ($html_1)
        {
?>  
          <div class="taxonomy_content">
    <div class="taxonomy_image"> <?php $term_image_1 = z_taxonomy_image($queried_object_1->term_id); ?>
    </div>
    <div class="taxonomy_descr"> <?php echo $html_1; ?>
    </div>
</div>

        <?php
        }

        /* end of Industry */
        /* start of Applications */

        $args_2 = array(
            'post_type' => 'solutions',
            'applications' => $current_cat_2
        );

        query_posts($args_2);

        $queried_object_2 = get_queried_object();

        //$term_name_2 = $queried_object_2->name;
        $term_description_2 = $queried_object_2->description;
        $html_3 .= $term_description_2;

        if ($html_3)
        {

?>

             <div class="taxonomy_content">
    <div class="taxonomy_image"> <?php $term_image_2 = z_taxonomy_image($queried_object_2->term_id); ?>
    </div>
    <div class="taxonomy_descr"> <?php echo $html_3; ?>
    </div>
</div>
<?php
        }

        /* end of Applications */
        /* start of Materials */

        $args_3 = array(
            'post_type' => 'solutions',
            'materials' => $current_cat_3
        );

        query_posts($args_3);

        $queried_object_3 = get_queried_object();

        // $term_name_3 = $queried_object_3->name;
        $term_description_3 = $queried_object_3->description;
        $html_5 .= $term_description_3;

        if ($html_5)
        {
?>
   <div class="taxonomy_content">
    <div class="taxonomy_image"> <?php $term_image_3 = z_taxonomy_image($queried_object_3->term_id); ?>
    </div>
    <div class="taxonomy_descr"> <?php echo $html_5; ?>
    </div>
</div>
    <?php
        }

        /* end of Materials */
        wp_reset_query();
        return ob_get_clean();
    }

}
$obj2 = new taxonomy;

