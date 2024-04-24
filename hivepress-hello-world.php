<?php
/**
 * Plugin Name: HivePress Hello World
 * Description: HivePress Hello World extension.
 * Version: 1.0.0
 * Author: Pavlo Alokhin
 * Author URI: https://www.linkedin.com/in/pavlo-a-399113193/
 * Text Domain: hivepress-hello-world
 * Domain Path: /languages/
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Register extension directory.
add_filter(
    'hivepress/v1/extensions',
    function( $extensions ) {
        $extensions[] = __DIR__;

        return $extensions;
    }
);