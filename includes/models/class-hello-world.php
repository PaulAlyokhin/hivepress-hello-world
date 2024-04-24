<?php
namespace HivePress\Models;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Model class.
 */
class Hello_World extends Post {

    /**
     * Class constructor.
     *
     * @param array $args Model arguments.
     */
    public function __construct( $args = [] ) {
        $args = hp\merge_arrays(
            [
                'fields' => [
                    'username'   => [
                        'type'     => 'text',
                        'required' => true,
                        '_alias'   => 'post_title',
                        '_model'   => 'post',
                    ],

                    'description' => [
                        'type'     => 'text',
                        'required' => true,
                        '_alias'   => 'post_content',
                        '_model'   => 'post',
                    ],
                ],
            ],
            $args
        );

        parent::__construct( $args );
    }
}