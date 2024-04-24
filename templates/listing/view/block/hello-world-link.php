<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( hivepress()->hello_world->is_current_user_can_hello_world() ) :
    ?>
    <a href="<?php echo esc_url( hivepress()->router->get_url('hello_world_page') ); ?>" class="button button--large hp-button hp-button--wide hp-button--vendor-filter"><span><?php echo __('Hello World', ''); ?></span></a>
<?php
endif;
