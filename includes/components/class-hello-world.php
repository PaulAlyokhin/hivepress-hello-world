<?php
namespace HivePress\Components;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Emails;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Component class.
 */
final class Hello_World extends Component {

    /**
     * Class constructor.
     *
     * @param array $args Component arguments.
     */
    public function __construct( $args = [] ) {
        // Add a new menu item to the user account menu
        add_filter(
            'hivepress/v1/menus/user_account',
            function( $menu ) {
                if ( $this->is_current_user_can_hello_world() ) {
                    $menu['items']['hello_world'] = [
                        'label'  => __( 'Hello World', 'hivepress-hello-world' ),
                        'route'  => 'hello_world_page',
                        '_order' => 50,
                    ];
                }

                return $menu;
            }
        );

        // Add a new button to the listing page sidebar
        add_filter(
            'hivepress/v1/templates/listing_view_page',
            function( $template ) {
                return hivepress()->template->merge_blocks(
                    $template,
                    [
                        'page_sidebar' => [
                            'blocks' => [
                                'hello_world_link' => [
                                    'type'   => 'part',
                                    'path'   => 'listing/view/block/hello-world-link',
                                    '_order' => 30,
                                ],
                            ],
                        ],
                    ]
                );
            },
            1000
        );

        parent::__construct( $args );
    }

    /**
     * Check if current user is admin and registered at least 1 hour ago.
     * @return bool
     */
    public function is_current_user_can_hello_world() {
        return is_user_logged_in() && current_user_can('administrator') && abs( time() - strtotime( get_userdata( get_current_user_id() )->user_registered ) ) >= HOUR_IN_SECONDS;
    }
}