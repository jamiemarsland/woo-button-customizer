<?php
require_once("variables.php");

function cx_bc_register_theme_customizer( $wp_customize ) {
	GLOBAL $our_fonts;
	
	$wp_customize->add_panel( 'cx_bc_buttons', array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => 'Buttons',
			'description'    => 'The Button Customizer for WooCommerce',
	) );
	
	//for loop to create all buttons and their settings
	for ($i=1; $i<=4; $i++){
		
		GLOBAL $our_fonts;
		
		$wp_customize->add_section(
			'cx_bc_button'.$i,
			array(
				'title'     => 'Button '.$i,
				'priority'  => 200 + $i,
				'description' => 'Please use the following shortcode for this button:<br>
[button class="bc-button'.$i.'"]Click here[/button]',
				'panel'  => 'cx_bc_buttons',
			)
		);
		
		//Redefining priority each time new button created

		$priority_for_controls = 0;
		//Creating the required settings
		woo_bc_s_color_setting_create($i, 'Button Color', '#0be', 'cx_bc_button'.$i, $wp_customize, 1);
		woo_bc_s_color_setting_create($i, 'Button Hover Color', '#09e', 'cx_bc_button'.$i, $wp_customize, 2);
		woo_bc_s_color_setting_create($i, 'Font Color', '#fff', 'cx_bc_button'.$i, $wp_customize, 3);
		
		if(isset($our_fonts)){
			$fonts = $our_fonts;
		}else{
			$fonts = array(
				'"Times New Roman", Times, serif' => '"Times New Roman", Times, serif',
				'Georgia, serif' => 'Georgia, serif',
				'"Palatino Linotype", "Book Antiqua", Palatino, serif' => '"Palatino Linotype", "Book Antiqua", Palatino, serif',
				'Helvetica, Arial' => 'Helvetica, Arial',
				'"Arial Black", Gadget, sans-serif' => '"Arial Black", Gadget, sans-serif',
				'"Comic Sans MS", cursive, sans-serif'  => '"Comic Sans MS", cursive, sans-serif', 
				'"Courier New", Courier, monospace' => '"Courier New", Courier, monospace'
			);
		}
		
		woo_bc_s_new_setting_create($i, 'select', 'Font Type', 'Helvetica, Arial', 'cx_bc_button'.$i, $wp_customize, 4, $fonts);
		woo_bc_s_new_setting_create($i, 'number', 'Font Size', '14', 'cx_bc_button'.$i, $wp_customize, 5);
		woo_bc_s_new_setting_create($i, 'radio', 'Font Weight', 'normal', 'cx_bc_button'.$i, $wp_customize, 6, 
			array(
			'normal' => 'Normal',
			'bold' => 'Bold'
			)
		);
		woo_bc_s_new_setting_create($i, 'number', 'Top/Bottom Padding', '7', 'cx_bc_button'.$i, $wp_customize, 7);
		woo_bc_s_new_setting_create($i, 'number', 'Left/Right Padding', '7', 'cx_bc_button'.$i, $wp_customize, 8);
		woo_bc_s_new_setting_create($i, 'number', 'Border Width', '1', 'cx_bc_button'.$i, $wp_customize, 9);
		woo_bc_s_color_setting_create($i, 'Border Color', '#09c', 'cx_bc_button'.$i, $wp_customize, 10);
		woo_bc_s_new_setting_create($i, 'number', 'Button Rounded Corners', '4', 'cx_bc_button'.$i, $wp_customize, 11);

		//Enque script to beautify display
		
		
		
	}
} // end cx_bc_register_theme_customizer
add_action( 'customize_register', 'cx_bc_register_theme_customizer' );
