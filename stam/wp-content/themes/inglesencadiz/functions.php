<?php
	//enqueing jQuery
	wp_enqueue_script("jquery");

	//declare the main menu

	if (function_exists('register_nav_menus')) {

        function register_ingles_menus() {
          register_nav_menus(
            array(
              'main-nav' => __( 'Main Navigation Menu' ),
              'footer-nav' => __( 'Footer Menu' )
            )
          );
        }
    }
    			add_action( 'init', 'register_ingles_menus' );

    //conditional classes to main-nav
		
		
?>