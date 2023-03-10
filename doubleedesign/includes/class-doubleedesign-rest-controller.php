<?php

/**
 * This class defines customisations and additional endpoints for WordPress REST API responses.
 *
 * @since      1.0.0
 * @package    Doubleedesign
 * @subpackage Doubleedesign/includes
 * @author     Leesa Ward <leesa@doubleedesign.com.au>
 */
class Doubleedesign_REST_Controller {


    /**
     * Make nav menu available in the REST API
     * @wp-hook
     *
     * @return void
     */
    function make_menu_available_in_rest(): void {

        function get_main_menu(): bool|array {
            return wp_get_nav_menu_items('main-menu');
        }

        register_rest_route('wp/v2', '/menu', array(
            'methods' => 'GET',
            'callback' => 'get_main_menu'
        ));
    }


    /**
     * Surface all Gutenberg blocks in the REST API for post types with the "editor" option enabled
     * when Classic Editor is NOT active
     * Credit to https://wpscholar.com/blog/add-gutenberg-blocks-to-wp-rest-api/
     * @wp-hook
     *
     * @return void
     */
    function return_individual_blocks_in_rest(): void {
        if (!function_exists('use_block_editor_for_post_type')) {
            require ABSPATH . 'wp-admin/includes/post.php';
        }

        $post_types = get_post_types_by_support(['editor']);

        foreach ($post_types as $post_type) {
            if (use_block_editor_for_post_type($post_type)) {
                register_rest_field($post_type, 'blocks', [
                    'get_callback' => function (array $post) {
                        return parse_blocks($post['content']['raw']);
                    }
                ]);
            }
        }
    }
}
