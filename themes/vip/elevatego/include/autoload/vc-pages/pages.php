<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * @since 4.5
 */
function vc_page_css_enqueue() {
	wp_enqueue_style( 'vc_page-css', vc_asset_url( 'css/js_composer_settings.min.css' ), array(), WPB_VC_VERSION );
}

/**
 * Build group page objects.
 *
 * @param $slug
 * @param $title
 * @param $tab
 *
 * @since 4.5
 *
 * @return Vc_Pages_Group
 */
function vc_pages_group_build( $slug, $title, $tab = '' ) {
	global $vc_page_welcome_tabs;
	require_once vc_path_dir( 'CORE_DIR', 'class-vc-page.php' );
	require_once vc_path_dir( 'CORE_DIR', 'class-vc-pages-group.php' );
	// Create page.
	if ( ! strlen( $tab ) ) {
		$tab = $slug;
	}
	$page = new Vc_Page();
	$page->setSlug( $tab )
	     ->setTitle( $title )
	     ->setTemplatePath( 'pages/' . $slug . '/' . $tab . '.php' );
	// Create page group to stick with other in template.
	$pages_group = new Vc_Pages_Group();
	$pages_group->setSlug( $slug )
	            ->setPages( $vc_page_welcome_tabs )
	            ->setActivePage( $page )
	            ->setTemplatePath( 'pages/vc-welcome/index.php' );

	return $pages_group;
}

/**
 * @since 4.5
 */
function vc_menu_page_build() {
	if ( vc_user_access()
		->wpAny( 'manage_options' )
		->part( 'settings' )
		->can( 'vc-general-tab' )
		->get()
	) {
		define( 'VC_PAGE_MAIN_SLUG', 'vc-general' );
	} else {
		define( 'VC_PAGE_MAIN_SLUG', 'vc-welcome' );
	}
	add_menu_page( __( 'Elevate Widgets', 'js_composer' ), __( 'Elevate Widgets', 'js_composer' ), 'exist', VC_PAGE_MAIN_SLUG, null, vc_asset_url( 'vc/visual_composer.png' ), 76 );
	do_action( 'vc_menu_page_build' );
}

function vc_network_menu_page_build() {
	if ( vc_user_access()
			->wpAny( 'manage_options' )
			->part( 'settings' )
			->can( 'vc-general-tab' )
			->get() && ! is_main_site()
	) {
		define( 'VC_PAGE_MAIN_SLUG', 'vc-general' );
	} else {
		define( 'VC_PAGE_MAIN_SLUG', 'vc-welcome' );
	}
	add_menu_page( __( 'Elevate Widgets', 'js_composer' ), __( 'Elevate Widgets', 'js_composer' ), 'exist', VC_PAGE_MAIN_SLUG, null, vc_asset_url( 'vc/visual_composer.png' ), 76 );
	do_action( 'vc_network_menu_page_build' );
}

add_action( 'admin_menu', 'vc_menu_page_build' );
add_action( 'network_admin_menu', 'vc_network_menu_page_build' );