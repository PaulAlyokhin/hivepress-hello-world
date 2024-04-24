<?php
/**
 * User hello world page template.
 *
 * @package HivePress\Templates
 */

namespace HivePress\Templates;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * User Hello World page.
 */
class Hello_World_Page extends User_Account_Page {

    /**
     * Class initializer.
     *
     * @param array $meta Class meta values.
     */
    public static function init( $meta = [] ) {
        $meta = hp\merge_arrays(
            [
                'label' => hivepress()->translator->get_string( 'user' ) . ' (' . hivepress()->translator->get_string( 'settings' ) . ')',
            ],
            $meta
        );

        parent::init( $meta );
    }

    /**
     * Class constructor.
     *
     * @param array $args Template arguments.
     */
    public function __construct( $args = [] ) {
        $args = hp\merge_trees(
            [
                'blocks' => [
                    'page_content' => [
                        'blocks' => [
                            'hello_world_form' => [
                                'type'   => 'form',
                                'form'   => 'hello_world',
                                '_order' => 10,
                            ],
                        ],
                    ],
                ],
            ],
            $args
        );

        parent::__construct( $args );
    }
}
