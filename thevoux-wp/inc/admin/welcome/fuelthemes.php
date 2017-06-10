<?php 
class Thb_Theme_Admin {
	/**
	 *	Main instance
	 */
	private static $_instance;
	
	/**
	 *	Theme Name
	 */
	public static $thb_theme_name;
	
	/**
	 *	Theme Version
	 */
	public static $thb_theme_version;
	
	/**
	 *	Theme Slug
	 */
	public static $thb_theme_slug;
	
	/**
	 *	Theme Directory
	 */
	public static $thb_theme_directory;
	
	/**
	 *	Theme Directory URL
	 */
	public static $thb_theme_directory_uri;
	
	/**
	 *	Product Key
	 */
	public static $thb_product_key;
	
	/**
	 *	Product Key Expiration
	 */
	public static $thb_product_key_expired;
	
	/**
	 *	Theme Constructor executed only once per request
	 */
	public function __construct() {
		if ( self::$_instance ) {
			_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
		}
	}
	
	/**
	 * You cannot clone this class
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	/**
	 * You cannot unserialize instances of this class
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}
	
	public static function instance() {
		global $thb_Theme_Admin;
		if ( ! self::$_instance ) {
			self::$_instance = new self();
			$thb_Theme_Admin = self::$_instance;
			
			// Theme Variables
			$theme = wp_get_theme();
			self::$thb_theme_name = $theme->get( 'Name' );
			self::$thb_theme_version = $theme->parent() ? $theme->parent()->get( 'Version' ) : $theme->get( 'Version' );
			self::$thb_theme_slug = $theme->template;
			self::$thb_theme_directory = get_template_directory() . '/';
			self::$thb_theme_directory_uri = get_template_directory_uri() . '/';
			
			self::$thb_product_key = get_option("thb_".self::$thb_theme_slug."_key");
			self::$thb_product_key_expired = get_option("thb_".self::$thb_theme_slug."_key_expired");
			
			// After Setup Theme
			add_action( 'after_setup_theme', array( self::$_instance, 'afterSetupTheme' ) );
			
			// Setup Admin Menus
			if ( is_admin() ) {
				self::$_instance->initAdminPages();
			}
		}
		
		return self::$_instance;
	}
	/**
	 *	After Theme Setup
	 */
	public function afterSetupTheme() {
		/* WooCommerce Support */
		add_theme_support( 'woocommerce' );
		
		/* WooCommerce Products per Page */
		if( $products_per_page = ot_get_option('products_per_page')) {
			add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $products_per_page . ';' ), 20 );
		}
		/* Text Domain */
		load_theme_textdomain('thevoux', THB_THEME_ROOT_ABS . '/inc/languages');
		
		/* Background Support */
		add_theme_support( 'custom-background', array( 'default-color' => 'ffffff') );
		
		/* Image Settings */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 180, 180, true );
		add_image_size('thevoux-single', 1170, 600, true );
		add_image_size('thevoux-vertical', 480, 640, true );
		add_image_size('thevoux-megamenu', 480, 300, true );
		add_image_size('thevoux-masonry', 900, 9999, false );
		add_image_size('thevoux-style1', 740, 560, true );
		add_image_size('thevoux-style2', 900, 900, true );
		add_image_size('thevoux-style3', 760, 600, true );
		add_image_size('thevoux-style3-small', 540, 280, true );
		add_image_size('thevoux-style9', 670, 400, true );
		add_image_size('thevoux-widget', 680, 300, true );
		
		/* Post Formats */
		add_theme_support('post-formats', array('image', 'gallery', 'video'));
		
		/* HTML5 Galleries */
		add_theme_support( 'html5', array( 'gallery', 'caption', 'comment-list' ) );
		add_filter( 'use_default_gallery_style', '__return_false' );
		
		/* Editor Styling */
		$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lora:300,400,400italic,500,600,700' );
		add_editor_style( array($font_url, 'assets/css/editor-style.css') );
		
		/* Required Settings */
		if(!isset($content_width)) $content_width = 1170;
		add_theme_support( 'automatic-feed-links' );
		
		/* Title Support */
		add_theme_support( 'title-tag' );
		
		/* Register Menus */
		register_nav_menus(
			array(
				'nav-menu' => __( 'Navigation Menu', 'thevoux' ),
				'mobile-menu' => __( 'Mobile Menu', 'thevoux' ),
				'secondary-mobile-menu' => __( 'Secondary Mobile Menu', 'thevoux' )
			)
		);
		
		$sidebars = ot_get_option('sidebars');
		$widget_style = ot_get_option('widget_style', 'style1');
		if(!empty($sidebars)) {
			foreach($sidebars as $sidebar) {
				register_sidebar( array(
					'name' => $sidebar['title'],
					'id' => $sidebar['id'],
					'description' => '',
					'before_widget' => '<div id="%1$s" class="widget cf %2$s '.esc_attr($widget_style).'">',
					'after_widget' => '</div>',
					'before_title' => '<strong><span>',
					'after_title' => '</span></strong>',
				));
			}
		}
	}
	public function thbDemos() {
		return array(
		    array(
		        'import_file_name'       => 'The Voux',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux/voux/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/voux/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/voux/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/voux_01.jpg",
		        'import_demo_url' => "http://thevoux.fuelthemes.net"
		    ),
		    array(
		        'import_file_name'       => 'Foodies',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux/foodies/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/foodies/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/foodies/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/thefoodies.jpg",
		        'import_demo_url' => "http://thevoux.fuelthemes.net/food-demo"
		    ),
		    array(
		        'import_file_name'       => 'Adventure Love',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux/adventurelove/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/adventurelove/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/adventurelove/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/adventurelove.jpg",
		        'import_demo_url' => "http://thevoux.fuelthemes.net/travel-demo"
		    ),
		    array(
		        'import_file_name'       => 'FashionMe Now',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux/fashionme/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/fashionme/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/fashionme/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/fashionmenow.jpg",
		        'import_demo_url' => "http://thevoux.fuelthemes.net/fashion-demo"
		    ),
		    array(
		        'import_file_name'       => 'Avantgarde',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux/avantgarde/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/avantgarde/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/avantgarde/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/avantgarde.jpg",
		        'import_demo_url' => "http://thevoux.fuelthemes.net/avantgarde"
		    ),
		    array(
		        'import_file_name'       => 'Madison',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux/madison/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/madison/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux/madison/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/madison.jpg",
		        'import_demo_url' => "http://thevoux.fuelthemes.net/madison"
		    ),
		);
	}
	/**
	 *	Inintialize Admin Pages
	 */
	public function initAdminPages() {
		global $pagenow;
		
		// Script and styles
		add_action( 'admin_enqueue_scripts', array( & $this, 'adminPageEnqueue' ) );
		
		// Menu Pages
		add_action( 'admin_menu', array( & $this, 'adminSetupMenu' ), 1 );
		
		// Theme Options Redirect
		if ( 'admin.php' == $pagenow && 'thb-theme-options' == $_GET['page'] ) {
			wp_redirect( admin_url( "themes.php?page=ot-theme-options" ) );
			die();
		}
		
		// Redirect to Main Page
		add_action( 'after_switch_theme', array( & $this, 'thb_activation_redirect' ) );
		
		// Ajax Option Update
		add_action("wp_ajax_thb_update_options", array( & $this, 'thb_update_options' ));
		add_action("wp_ajax_nopriv_thb_update_options", array( & $this, 'thb_update_options' ));
		
		// Admin Notices
		add_action( 'admin_notices', array( & $this, 'thb_admin_notices' ) );
		
		// Theme Updates
		add_action( 'admin_init', array( & $this, 'thb_theme_update') );
		
		// Plugin Update Nonce
		add_action( 'register_sidebar', array( & $this, 'thb_theme_admin_init' ) );
		
	}
	function thb_admin_notices() {
		$remote_ver = get_option("thb_".self::$thb_theme_slug."_remote_ver") ? get_option("thb_".self::$thb_theme_slug."_remote_ver") : self::$thb_theme_version;
		$local_ver = self::$thb_theme_version;

		if(version_compare($local_ver, $remote_ver, '<')) {
			if ( 
				( !self::$thb_product_key && ( self::$thb_product_key_expired == 0 ) ) || 
				( self::$thb_product_key && ( self::$thb_product_key_expired == 1 ) ) 
			) {
				echo '<div class="notice is-dismissible error thb_admin_notices">
				<p>There is an update available for the <strong>' . self::$thb_theme_name . '</strong> theme. Go to <a href="' . admin_url( 'admin.php?page=thb-product-registration' ) . '">Product Registration</a> to enable theme updates.</p>
				</div>';
			}
	
			if ( self::$thb_product_key && ( self::$thb_product_key_expired == 0 ) ) {
				echo '<div class="notice is-dismissible error thb_admin_notices">
				<p>There is an update available for the <strong>' . self::$thb_theme_name . '</strong> theme. <a href="' . admin_url() . 'update-core.php">Update now</a>.</p>
				</div>';
			}
    }
	}
	public function thb_update_options() {
		$key = $_POST['key'];
		$expired = $_POST['expired'];  
		update_option("thb_".self::$thb_theme_slug."_key", $key);
		update_option("thb_".self::$thb_theme_slug."_key_expired", $expired);
		wp_die();
	}
	public function thb_theme_update() {
		add_filter( 'pre_set_site_transient_update_themes', array( & $this, 'thb_check_for_update' ) );
		add_filter( 'upgrader_pre_download', array( $this, 'thb_upgradeFilter' ), 10, 4 );
	}
	public function thb_check_for_update_plugins() {
		$args = array(
			'timeout' => 30,
			'body' => array( 
				"item_ids" => '242431',
				"product_key" => self::$thb_product_key,
			)
		);
		$request = wp_remote_get( self::$_instance->dashboardUrl('plugin/version'), $args);
		$data = '';
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
			$data = json_decode( wp_remote_retrieve_body($request));
		}
		return $data;
	}
	public function thb_check_for_update( $transient ) {
		global $wp_filesystem;
		$args = array(
			'timeout' => 30,
			'body' => array( 
				"theme_name" => self::$thb_theme_name,
				"product_key" => self::$thb_product_key,
			)
		);

		$request = wp_remote_get( self::$_instance->dashboardUrl('version'), $args);

    if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
    	$data = json_decode( wp_remote_retrieve_body($request));
			update_option("thb_".self::$thb_theme_slug."_key_expired", 0);	
			
			if (isset($data->success) && $data->success == false) {
				self::$thb_product_key_expired = 1;
				update_option("thb_".self::$thb_theme_slug."_key_expired", 1);	
			} else {
				if(version_compare(self::$thb_theme_version, $data->version, '<')) {
					$transient->response[self::$thb_theme_slug] = array(
						"new_version"	=> 		$data->version,
						"package"		=>	    $data->download_url,
						"url"			=>		'http://fuelthemes.net'		
					);
	
					update_option("thb_".self::$thb_theme_slug."_remote_ver", $data->version);
				}
			}
		}
		return $transient;
	}
	public function thb_upgradeFilter( $reply, $package, $updater ) {
		global $wp_filesystem;

		if ( isset( $updater->skin->theme_info ) && $updater->skin->theme_info['Name'] == self::$thb_theme_name ) {
			if ( !self::$thb_product_key || (self::$thb_product_key_expired == 1) ) {
				return new WP_Error( 'no_credentials', sprintf( __( 'To receive automatic updates, registration is required. Please visit <a href="%1$s" target="_blank">Product Registration</a> to activate your theme.', 'thevoux' ), admin_url( 'admin.php?page=thb-product-registration' ) ) );
			}
		}
		
		// VisualComposer
		if ( (isset( $updater->skin->plugin )) && ( $updater->skin->plugin == 'js_composer/js_composer.php') ) {
			if ( !self::$thb_product_key || (self::$thb_product_key_expired == 1) ) {
				return new WP_Error( 'no_credentials', sprintf( __( 'To receive automatic updates, registration is required. Please visit <a href="%1$s" target="_blank">Product Registration</a> to activate your theme.', 'thevoux' ), admin_url( 'admin.php?page=thb-product-registration' ) ) );
			}
		}
		return $reply;
	}
	public function thb_plugins_install( $item ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$installed_plugins = get_plugins();

		$item['sanitized_plugin'] = $item['name'];

		// WordPress Repository
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}

		// Install Link
		if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
			$actions = array(
				'install' => sprintf(
					'<a href="%1$s" class="button" title="Install %2$s">Install Now</a>',
					esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),
								'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
								'tgmpa-install' => 'install-plugin',
								'return_url'    => network_admin_url( 'admin.php?page=thb-plugins' )
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-install',
						'tgmpa-nonce'
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		// Activate Link
		else if ( is_plugin_inactive( $item['file_path'] ) ) {
			$actions = array(
				'activate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'               => urlencode( $item['slug'] ),
							'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
							'thb-activate'       => 'activate-plugin',
							'thb-activate-nonce' => wp_create_nonce( 'thb-activate' ),
						),
						admin_url( 'admin.php?page=thb-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		// Update Link
		
		else if ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
			$actions = array(
				'update' => sprintf(
					'<a href="%1$s" class="button button-update" title="Install %2$s"><span class="dashicons dashicons-update"></span> Update</a>',
					wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),
								'tgmpa-update'  => 'update-plugin',
								'version'       => urlencode( $item['version'] ),
								'return_url'    => network_admin_url( 'admin.php?page=thb-plugins' )
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-update',
						'tgmpa-nonce'
					),
					$item['sanitized_plugin']
				),
			);
		} else if ( is_plugin_active( $item['file_path'] ) ) {
			$actions = array(
				'deactivate' => sprintf(
					'<a href="%1$s" class="button" title="Deactivate %2$s">Deactivate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'                 => urlencode( $item['slug'] ),
							'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
							// 'plugin_source'          => urlencode( $item['source'] ),
							'thb-deactivate'       => 'deactivate-plugin',
							'thb-deactivate-nonce' => wp_create_nonce( 'thb-deactivate' ),
						),
						admin_url( 'admin.php?page=thb-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}

		return $actions;
	}
	public function thb_theme_admin_init() {
	
		if ( isset( $_GET['thb-deactivate'] ) && $_GET['thb-deactivate'] == 'deactivate-plugin' ) {
			
			check_admin_referer( 'thb-deactivate', 'thb-deactivate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {
				if ( $plugin['Name'] == $_GET['plugin_name'] ) {
						deactivate_plugins( $plugin_name );
				}
			}

		} 

		if ( isset( $_GET['thb-activate'] ) && $_GET['thb-activate'] == 'activate-plugin' ) {
			
			check_admin_referer( 'thb-activate', 'thb-activate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {
				if ( $plugin['Name'] == $_GET['plugin_name'] ) {
					activate_plugin( $plugin_name );
				}
			}

		}

	}
	public function thb_activation_redirect() {
		$thevoux_installed = 'thevoux_installed';
		
		if ( false == get_option( $thevoux_installed, false ) ) {		
			update_option( $thevoux_installed, true );
			wp_redirect( admin_url( 'admin.php?page=thb-product-registration' ) );
			die();
		} 
		
		delete_option( $thevoux_installed );
	}
	public function adminPageEnqueue() {
		wp_enqueue_script( 'thb-admin-meta', Thb_Theme_Admin::$thb_theme_directory_uri .'assets/js/admin-meta.min.js', array('jquery'), esc_attr(self::$thb_theme_version));
		wp_enqueue_style("thb-admin-css", Thb_Theme_Admin::$thb_theme_directory_uri . "assets/css/admin.css", null, esc_attr(self::$thb_theme_version));

		if (class_exists('WPBakeryVisualComposerAbstract')) {
			wp_enqueue_style( 'vc_extra_css', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/css/vc_extra.css' );
		}
	}
	public function adminSetupMenu() {
		
		// Product Registration
		add_menu_page( Thb_Theme_Admin::$thb_theme_name, Thb_Theme_Admin::$thb_theme_name, 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_Product_Registration' ), '', 3 );
		
		// Product Registration
		add_submenu_page( 'thb-product-registration', 'Registration', 'Registration', 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_Product_Registration' ) );
		
		// Main Menu Item
		add_submenu_page( 'thb-product-registration', 'Plugins', 'Plugins', 'edit_theme_options', 'thb-plugins', array( & $this, 'thb_Plugins' ) );

		// Demo Import
		add_submenu_page( 'thb-product-registration', 'Demo Import', 'Demo Import', 'edit_theme_options', 'thb-demo-import', array( & $this, 'thb_Demo_Import' ) );
		
		// Theme Options
		add_submenu_page( 'thb-product-registration', 'Theme Options', 'Theme Options', 'edit_theme_options', 'thb-theme-options', '__return_false' ); 
		
	}
	public function thb_Plugins() {
		get_template_part( 'inc/admin/welcome/pages/plugins' );
	}
	public function thb_Product_Registration() {
		get_template_part( 'inc/admin/welcome/pages/registration' );
	}
	public function thb_Demo_Import() {
		get_template_part( 'inc/admin/welcome/pages/demo-import' );
	}
	/**
	 *	Inintialize API
	 */
	public function dashboardUrl($type = null) {
		$url = 'https://my.fuelthemes.net';
		switch ( $type ) {
			case 'verify':
				$url .= '/api/verify';
				break;
			case 'version':
				$url .= '/api/version';
				break;
			case 'plugin/version':
				$url .= '/api/plugin/version';
				break;
		}
		return $url;
	}
}
// Main instance shortcut
function thb_Theme_Admin() {
	global $thb_Theme_Admin;
	return $thb_Theme_Admin;
}
Thb_Theme_Admin::instance();