<?php 

function thb_ocdi_before_widgets_import( $selected_import, $selected_import_files ) {

  $options_import_data = $selected_import_files;

	$options = unserialize( ot_decode( $options_import_data ) );
	
	/* get settings array */
	$settings = get_option( ot_settings_id() );
	
	/* has options */
	if ( is_array( $options ) ) {
	  
	  /* validate options */
	  if ( is_array( $settings ) ) {
	  
	    foreach( $settings['settings'] as $setting ) {
	    
	      if ( isset( $options[$setting['id']] ) ) {
	        
	        $content = ot_stripslashes( $options[$setting['id']] );
	        
	        $options[$setting['id']] = ot_validate_setting( $content, $setting['type'], $setting['id'] );
	        
	      }
	    
	    }
	  
	  }
	  
	  /* update the option tree array */
	  update_option( ot_options_id(), $options );
	}
}
add_action( 'pt-ocdi/before_widgets_import', 'thb_ocdi_before_widgets_import', 2, 2 );

function thb_ocdi_after_import( $selected_import ) {
	/* Set Pages */
	update_option( 'show_on_front', 'page' );
	
	if ( 'The Voux' === $selected_import['import_file_name'] ) {
		$home = get_page_by_title('Home - Style 1');
		$blog = get_page_by_title('Blog');
		update_option( 'page_for_posts', $blog->ID );
	} else {
		$home = get_page_by_title('Home');
	}
	
	update_option( 'page_on_front', $home->ID );
	
	/* Set Menus */
	$top_menu = get_term_by('name', 'Top Menu', 'nav_menu');
	$mobile_menu = get_term_by('name', 'Mobile Menu', 'nav_menu');
	
	if (!$mobile_menu->term_id) {
		$mobile_menu = $top_menu;
	}
	set_theme_mod( 'nav_menu_locations' , array('nav-menu' => $top_menu->term_id, 'mobile-menu' => $mobile_menu->term_id ) );
}
add_action( 'pt-ocdi/after_import', 'thb_ocdi_after_import' );