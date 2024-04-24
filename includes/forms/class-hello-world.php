<?php
namespace HivePress\Forms;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Hello_World extends Form {
    public function __construct( $args = [] ) {
        $args = hp\merge_arrays(
            [
                // Set the form parameters.
                'action'  => hivepress()->router->get_url( 'hello_world_action' ),
                'method'  => 'POST',
                'message' => __('Username updated successfully', 'hivepress-hello-world'),
                'reset'   => true,
                'description' => __('Please, specify your name', 'hivepress-hello-world'),

                // Set the field parameters.
                'fields'  => [
                    'first_name' => [
                        'label'    => __('First name', 'hivepress-hello-world'),
                        'type'     => 'text',
                        'required' => true,
                        '_order'   => 123,
                    ],
                    'last_name' => [
                        'label'    => __('Last name', 'hivepress-hello-world'),
                        'type'     => 'text',
                        'required' => false,
                        '_order'   => 123,
                    ],
                ],

                // Set the button parameters.
                'button'  => [
                    'label' => __('Save', 'hivepress-hello-world'),
                ],
            ],
            $args
        );

        parent::__construct( $args );
    }
}
