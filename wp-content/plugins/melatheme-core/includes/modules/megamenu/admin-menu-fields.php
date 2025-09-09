<?php
/**
 * Add custom fields to nav menu items
 *
 * A simplified approach to debug the field visibility issue.
 *
 * @package MelaTheme Core
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Step 1: Add the custom field to the menu item editor.
 */
function melatheme_core_add_custom_fields_to_menu_items( $item_id, $item, $depth, $args ) {
    $content_id = get_post_meta( $item_id, '_melatheme_megamenu_content_id', true );
    $hide_title = get_post_meta( $item_id, '_melatheme_hide_column_title', true );
    ?>
    <div class="melatheme-megamenu-fields-wrapper">
        <p class="field-megamenu-content description description-wide">
            <label for="edit-menu-item-megamenu-content-<?php echo $item_id; ?>">
                <?php esc_html_e( 'Mega Menu Content', 'melatheme-core' ); ?><br />
                <select id="edit-menu-item-megamenu-content-<?php echo $item_id; ?>" class="widefat edit-menu-item-megamenu-content" name="menu-item-megamenu-content[<?php echo $item_id; ?>]">
                    <option value=""><?php esc_html_e( '&mdash; None &mdash;', 'melatheme-core' ); ?></option>
                    <?php
                    $megamenu_posts = get_posts( array(
                        'post_type'   => 'megamenu_content',
                        'post_status' => 'publish',
                        'numberposts' => -1,
                        'orderby'     => 'title',
                        'order'       => 'ASC',
                    ) );
                    foreach ( $megamenu_posts as $post ) {
                        printf(
                            '<option value="%s" %s>%s</option>',
                            esc_attr( $post->ID ),
                            selected( $content_id, $post->ID, false ),
                            esc_html( $post->post_title )
                        );
                    }
                    ?>
                </select>
            </label>
        </p>
        <p class="field-megamenu-hide-title description description-wide">
            <label for="edit-menu-item-hide-title-<?php echo $item_id; ?>">
                <input type="checkbox" id="edit-menu-item-hide-title-<?php echo $item_id; ?>" name="menu-item-hide-title[<?php echo $item_id; ?>]" value="1" <?php checked( $hide_title, 1 ); ?> />
                <?php esc_html_e( 'Hide Column Title', 'melatheme-core' ); ?>
            </label>
        </p>
    </div>
    <?php
}

/**
 * Step 2: Save the custom field value.
 */
function melatheme_core_save_custom_menu_item_fields( $menu_id, $menu_item_db_id, $args ) {
    // Save the Mega Menu Content ID
    if ( isset( $_POST['menu-item-megamenu-content'][ $menu_item_db_id ] ) ) {
        $value = sanitize_text_field( $_POST['menu-item-megamenu-content'][ $menu_item_db_id ] );
        update_post_meta( $menu_item_db_id, '_melatheme_megamenu_content_id', $value );
    } else {
        delete_post_meta( $menu_item_db_id, '_melatheme_megamenu_content_id' );
    }

    // Save the Hide Column Title checkbox
    if ( isset( $_POST['menu-item-hide-title'][ $menu_item_db_id ] ) ) {
        update_post_meta( $menu_item_db_id, '_melatheme_hide_column_title', 1 );
    } else {
        delete_post_meta( $menu_item_db_id, '_melatheme_hide_column_title' );
    }
}
