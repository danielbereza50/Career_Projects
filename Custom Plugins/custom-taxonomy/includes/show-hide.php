<?php 

// class name
class field_check
{
    // class properties
    private $value1;
    private $value2;
    private $value3;
    private $value4;
    private $value5;
    private $value6;
    private $value7;
    private $value8;
    private $value9;
    private $value10;
    private $value11;
    private $value12;
    private $value13;
    private $value14;
    private $value15;
    private $value16;
    private $value17;
    private $value18;
    private $value19;
    private $value20;
    private $value21;
    private $value22;
    private $value23;
    private $value24;
    private $value25;
    private $value26;

    // class methods
    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        add_shortcode('CPT', array(
            $this,
            'check_for_data'
        ));
    }
    public static function check_for_data()
    {
        ob_start();

        $value1 = get_field('solution_features_1');
        $value2 = get_field('solution_features_2');
        $value3 = get_field('solution_features_3');
        $value4 = get_field('solution_features_4');
        $value5 = get_field('solution_features_5');
        $value6 = get_field('solution_features_6');
        $value7 = get_field('solution_features_7');
        $value8 = get_field('solution_features_8');
        $value9 = get_field('solution_features_9');
        $value10 = get_field('solution_features_10');

        $value12 = get_field('feature_image_1');
        $value13 = get_field('feature_image_2');
        $value14 = get_field('feature_image_3');
        $value15 = get_field('feature_image_4');
        $value16 = get_field('feature_image_5');
        $value17 = get_field('feature_image_6');
        $value18 = get_field('feature_image_7');
        $value19 = get_field('feature_image_8');
        $value20 = get_field('feature_image_9');
        $value21 = get_field('feature_image_10');

        $value22 = get_field('application_image_1');
        $value23 = get_field('application_image_2');
        $value24 = get_field('application_image_3');
        $value25 = get_field('application_image_4');
        $value26 = get_field('application_image_5');
        $value27 = get_field('application_image_6');
		
		$value28 = get_field('solution_application_1');
        $value29 = get_field('solution_application_2');
        $value30 = get_field('solution_application_3');
        $value31 = get_field('solution_application_4');
        $value32 = get_field('solution_application_5');
        $value33 = get_field('solution_application_6');
		
		
		$value34 = get_field('solution_ref_doc_1');
        $value35 = get_field('solution_ref_doc_2');
        $value36 = get_field('solution_ref_doc_3');
        $value37 = get_field('solution_ref_doc_4');
        $value38 = get_field('solution_ref_doc_5');
		
        $value39 = get_field('video_1');
		$value40 = get_field('video_2');
        $value41 = get_field('video_3');
		
		
		
		
        // solution_feature_text_1
        // solution_feature_img_1
        // feature_row_1
        // solution_application_1
        
        /*  start of image check */

        if (!$value1 && $value12)
        {
            echo '<style>
    .solution-template-default
    .solution_feature_img_1{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value2 && $value13)
        {
            echo '<style>
    .solution-template-default
    .solution_feature_img_2{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value3 && $value14)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_3{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value4 && $value15)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_4{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value5 && $value16)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_5{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value6 && $value17)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_6{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value7 && $value18)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_7{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value8 && $value19)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_8{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value9 && $value20)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_9{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value10 && $value21)
        {
            echo '<style>
            .solution-template-default
    .solution_feature_img_10{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        /*  end of image check */
		
		
        /*  start of rows */
        if (!$value1)
        {
            echo '<style>
    .solution-template-default
    .feature_row_1{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value2)
        {
            echo '<style>
    .solution-template-default
    .feature_row_2{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value3)
        {
            echo '<style>
            .solution-template-default
    .feature_row_3{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value4)
        {
            echo '<style>
            .solution-template-default
    .feature_row_4{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value5)
        {
            echo '<style>
            .solution-template-default
    .feature_row_5{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value6)
        {
            echo '<style>
            .solution-template-default
    .feature_row_6{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value7)
        {
            echo '<style>
            .solution-template-default
    .feature_row_7{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value8)
        {
            echo '<style>
            .solution-template-default
    .feature_row_8{
    display:none !important;
    }
    </style>';
?>
            <?php
        }

        if (!$value9)
        {
            echo '<style>
            .solution-template-default
    .feature_row_9{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value10)
        {
            echo '<style>
            .solution-template-default
    .feature_row_10{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        /* end of rows */
		
        /*  start of application images */
        if (!$value22)
        {
            echo '<style>
            .solution-template-default
    .solution_application_1{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value23)
        {
            echo '<style>
            .solution-template-default
    .solution_application_2{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value24)
        {
            echo '<style>
            .solution-template-default
    .solution_application_3{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value25)
        {
            echo '<style>
            .solution-template-default
    .solution_application_4{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value26)
        {
            echo '<style>
            .solution-template-default
    .solution_application_5{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        if (!$value27)
        {
            echo '<style>
            .solution-template-default
    .solution_application_6{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
        /* end of application images */
		
		/*  start of sections */
		
		// Features
        if (!$value1 && !$value2 && !$value3 && !$value4 && !$value5 && !$value6 && !$value7 && !$value8 && !$value9 && !$value10)
        {
            echo '<style>
    .solution-template-default
    .solution_section_1{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
		// Applications
		  if (!$value28 && !$value29 && !$value30 && !$value31 && !$value32 && !$value33)
        {
            echo '<style>
    .solution-template-default
    .solution_section_2{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
		// Documents
		  if (!$value34 && !$value35 && !$value36 && !$value37 && !$value38)
        {
            echo '<style>
    .solution-template-default
    .solution_section_3{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
		// Videos
		  if (!$value39 && !$value40 && !$value41)
        {
            echo '<style>
    .solution-template-default
    .solution_section_4{
    display:none !important;
    }
    </style>';
?>
            <?php
        }
		
	    /*  end of sections */
		
        return ob_get_clean();
    }
}
$obj = new field_check;
