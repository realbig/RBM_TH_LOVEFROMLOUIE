<?php
/**
 * Stories CPT
 *
 * @since   1.0.0
 * @package Love_From_Louie
 * @subpackage  Love_From_Louie/admin/post-types
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

class RBM_CPT_LFL_Story extends RBM_CPT {

    public $post_type = 'lfl-story';
    public $label_singular = null;
    public $label_plural = null;
    public $labels = array();
    public $icon = 'testimonial';
    public $post_args = array(
        'supports' => array( 'title', 'editor', 'author', 'thumbnail' ),
        'menu_position' => 20,
        'has_archive' => true,
        'rewrite' => array(
            'slug' => 'our-stories',
            'with_front' => false,
            'feeds' => false,
            'pages' => true
        ),
    );

    function __construct() {

        // This allows us to Localize the Labels
        $this->label_singular = _x( 'Story', 'Stories Label Singular', 'love-from-louie' );
        $this->label_plural = _x( 'Stories', 'Stories Label Plural', 'love-from-louie' );

        $this->labels = array(
            'menu_name' => _x( 'Stories', 'Stories Menu Name', 'love-from-louie' ),
            'all_items' => _x( 'All Stories', 'Stories All Items', 'love-from-louie' ),
        );

        parent::__construct();

    }

}

$lfl_story = new RBM_CPT_LFL_Story();