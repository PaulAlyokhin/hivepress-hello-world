<?php
namespace HivePress\Controllers;

use HivePress\Blocks\Template;
use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Blocks;
use WP_REST_Request;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Controller class.
 */
final class Hello_World extends Controller {

    /**
     * Class constructor.
     *
     * @param array $args Controller arguments.
     */
    public function __construct( $args = [] ) {
        $args = hp\merge_arrays(
            [
                'routes' => [
                    'hello_world_page' => [
                        'title'     => __( 'Hello World', 'hivepress-hello-world' ),
                        'base'      => 'user_account_page',
                        'path'      => '/hello-world',
                        'redirect'  => [ $this, 'redirect_hello_world_page' ],
                        'action'    => [ $this, 'render_hello_world_page' ],
                    ],

                    // REST API routes
                    'hello_world_action' => [
                        'base'   => 'user_account_page',
                        'path'   => '/hello-world-save',
                        'method' => 'POST',
                        'action' => [ $this, 'hello_world_save' ],
                        'rest'   => true,
                    ],
                ],
            ],
            $args
        );

        parent::__construct( $args );
    }

    /**
     * Redirects hello world page.
     *
     * @return mixed
     */
    public function redirect_hello_world_page() {
        // Perform checks and return the redirect URL.
        if ( ! hivepress()->hello_world->is_current_user_can_hello_world() ) {
            return wp_redirect( get_home_url() );
        }

        // Return false to prevent the redirect.
        return false;
    }

    /**
     * Renders Hello World page.
     *
     * @return string
     */
    public function render_hello_world_page() {
        // Return the rendered page template.
        return ( new Template([
            'template' => 'hello_world_page',
        ]) )->render();
    }

    /**
     * Hello World REST API action.
     *
     * @param WP_REST_Request $request API request.
     * @return WP_Rest_Response
     */
    public function hello_world_save( $request ) {
        // Check authentication.
        if ( ! is_user_logged_in() ) {
            return hp\rest_error( 401 );
        }

        $user_id = get_current_user_id();
        $user_new_first_name = trim( $request->get_param('first_name') );
        $user_new_last_name = trim( $request->get_param('last_name') );

        // Update username
        wp_update_user([
            'ID' => $user_id,
            'first_name' => $user_new_first_name,
            'last_name' => $user_new_last_name,
        ]);

        // Create Hello World model instance
        $hello_world = ( new Models\Hello_World() )->fill([
            'status'      => 'publish',
            'username'    => get_userdata($user_id)->user_nicename,
            'description' => implode(', ', array_filter([$user_new_first_name, $user_new_last_name])),
        ]);
        $hello_world->save();

        // Send email notification
        $to = get_userdata($user_id)->user_email;
        $subject = __('Your name has been changed', 'hivepress-hello-world');
        $message = sprintf(
            __('Your name has been changed to %s', 'hivepress-hello-world'),
            trim($user_new_first_name . ' ' . $user_new_last_name)
        );

        wp_mail($to, $subject, $message);

        return hp\rest_response(
            200,
            [
                'data' => [
                    'success' => true,
                ],
            ]
        );
    }
}