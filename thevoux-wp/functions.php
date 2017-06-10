<?php

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file.
	You have been warned!

-------------------------------------------------------------------------------------*/

// Define Theme Name for localization
define('THB_THEME_ROOT', esc_url(get_template_directory_uri()));
define('THB_THEME_ROOT_ABS', get_template_directory());

// Option-Tree Theme Mode
require get_template_directory() .'/inc/admin/option-tree/init.php';

// Theme Admin
require get_template_directory() .'/inc/admin/welcome/fuelthemes.php';

// TGM Plugin Activation Class
require get_template_directory() .'/inc/admin/plugins/plugins.php';

// Imports
require get_template_directory() .'/inc/admin/imports/import.php';

// Script Calls
require get_template_directory() .'/inc/script-calls.php';

// Ajax
require get_template_directory() .'/inc/ajax.php';

// Add Menu Support
require get_template_directory() .'/inc/wp3menu.php';

// Enable Sidebars
require get_template_directory() .'/inc/sidebar.php';

// Widgets
require get_template_directory() .'/inc/widgets.php';

// Social Functions 
require get_template_directory() .'/inc/post-social.php';

// Misc 
require get_template_directory() .'/inc/misc.php';

// Reviews
require get_template_directory() .'/inc/post-reviews.php';

// CSS Output of Theme Options
require get_template_directory() .'/inc/selection.php';

// Twitter oAuth
require get_template_directory() .'/inc/TwitterAPIExchange.php';

// Share Counts
require get_template_directory() .'/inc/posts-social-shares-count/posts-share-count.php';

// Visual Composer Integration
require get_template_directory() .'/inc/visualcomposer.php';

// Shortcode Generator & Shortcodes (+)
require get_template_directory() .'/inc/tinymce/tinymce-class.php';	
require get_template_directory() .'/inc/tinymce/shortcode-processing.php';

// WooCommerce Settings specific for theme
require get_template_directory() .'/inc/woocommerce.php';
require get_template_directory() .'/inc/woocommerce-category-image.php';

// SideKick Integration
define('SK_PRODUCT_ID',459);
define('SK_ENVATO_PARTNER', '5LXnCIbjT0TD4jcyZuhMSAgVwil8hU5TTxIW5cNNwbA=');
define('SK_ENVATO_SECRET', 'RqjBt/YyaTOjDq+lKLWhL10sFCMCJciT9SPUKLBBmso=');