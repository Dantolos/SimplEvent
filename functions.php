<?php
//include Theme Setting Seite
require get_template_directory() . '/inc/function-admin.php';
require get_template_directory() . '/inc/enqeue.php';
require get_template_directory() . '/inc/ajax.php';

//Menu einstellung
function wpb_custom_new_menu() {
  register_nav_menus(
    array(
		'main-menu' => __( 'Hauptmenu' ),
		'sprachen' => __( 'Sprachen' ),
		'footer-menu' => __( 'Footermenu' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );

add_filter( 'wp_nav_menu_objects', 'submenu_limit', 10, 2 );

function submenu_limit( $items, $args ) {

    if ( empty( $args->submenu ) ) {
        return $items;
    }

    $ids       = wp_filter_object_list( $items, array( 'title' => $args->submenu ), 'and', 'ID' );
    $parent_id = array_pop( $ids );
    $children  = submenu_get_children_ids( $parent_id, $items );

    foreach ( $items as $key => $item ) {

        if ( ! in_array( $item->ID, $children ) ) {
            unset( $items[$key] );
        }
    }

    return $items;
}

function submenu_get_children_ids( $id, $items ) {

    $ids = wp_filter_object_list( $items, array( 'menu_item_parent' => $id ), 'and', 'ID' );

    foreach ( $ids as $id ) {

        $ids = array_merge( $ids, submenu_get_children_ids( $id, $items ) );
    }

    return $ids;
}

//activate Featured Image
add_theme_support('post-thumbnails');

//SVG Erlauben
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/**
 * JPEG-Komprimierung deaktivieren
 * https://wp-bibel.de/snippet/jpeg-komprimierung-deaktivieren/ ‎
 */

add_filter('jpeg_quality', 'wp_bibel_de_custom_jpeg_quality');
add_filter('wp_editor_set_quality', 'wp_bibel_de_custom_jpeg_quality');

function wp_bibel_de_custom_jpeg_quality($quality) {
	$quality = 100;
	return $quality;
}

/*ACF*/
function my_acf_admin_head() {
    ?>
    <style type="text/css">

    .se_ACF_modular { color: #dedede !important; background-color: #23282d; }
    .acf-field {border-left: 0px !important;}

    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');




function array_insert(&$array, $position, $insert)
{
    if (is_int($position)) {
        array_splice($array, $position, 0, $insert);
    } else {
        $pos   = array_search($position, array_keys($array));
        $array = array_merge(
            array_slice($array, 0, $pos),
            $insert,
            array_slice($array, $pos)
        );
    }
}
