<?php
/**
 * Post types configuration.
 *
 * @package HivePress\Configs
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

return [
    'hello_world'    => [
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'supports'     => [ 'title', 'editor' ],

        'labels'       => [
            'name'               => esc_html__( 'Hello World', 'hivepress-hello-world' ),
            'singular_name'      => esc_html__( 'Hello World', 'hivepress-hello-world' ),
            'add_new'            => esc_html_x( 'Add New', 'email', 'hivepress-hello-world' ),
            'add_new_item'       => esc_html__( 'Add Hello World', 'hivepress-hello-world' ),
            'edit_item'          => esc_html__( 'Edit Hello World', 'hivepress-hello-world' ),
            'new_item'           => esc_html__( 'Add Hello World', 'hivepress-hello-world' ),
            'all_items'          => esc_html__( 'Hello World', 'hivepress-hello-world' ),
            'search_items'       => esc_html__( 'Search Hello World', 'hivepress-hello-world' ),
            'not_found'          => esc_html__( 'No Hello World found.', 'hivepress-hello-world' ),
            'not_found_in_trash' => esc_html__( 'No Hello World found.', 'hivepress-hello-world' ),
        ],
    ],
];
