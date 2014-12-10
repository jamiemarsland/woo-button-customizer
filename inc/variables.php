<?php
require_once 'classes.php';


$num_of_butts = 4;
$settings_prefix = 'shramee_b';

if(!function_exists( 'shramee_color_setting_create' )){
/**
 * Creates color settings input
 * @uses $wp_customize->add_setting
 * @uses $wp_customize->add_control
 * @param number $button
 * @param string $title
 * @param string $default
 * @param string $section
 */
	function shramee_color_setting_create($button, $title, $default, $section, $wp_customize, $priority_for_controls){
	//Vars for easy application
	$Title = $title;
	$title = strtolower($title);
	GLOBAL $settings_prefix;
//	GLOBAL $priority_for_controls;
//	$priority_for_controls++;
	$setting_name = $settings_prefix.$button.'_'.str_replace(array(' ', '/'), '_', $title);

	//Adding Setting
	$wp_customize->add_setting(
			$setting_name ,
			array(
					'default'     => $default,
//					'transport'   => 'postMessage'
			)
	);
	//Adding control
	$wp_customize->add_control(
			new WP_Customize_Color_Control(
					$wp_customize,
					$setting_name,
					array(
							'label'		=> __( $Title, '' ),
							'section'	=> $section,
							'settings'	=> $setting_name,
							'priority'	=> $priority_for_controls
					)
			)
	);

  }
}

if(!function_exists( 'shramee_new_setting_create' )){
/**
 * Creates setting input
 * @uses $wp_customize->add_setting
 * @uses $wp_customize->add_control
 * @param string $button
 * @param string $type text, checkbox, radio*, select*, dropdown-pages, textarea(WP4)
 * @param string $title
 * @param string $default
 * @param string $section
 * @param string $wp_customize
 * @param array $choices
 */
  function shramee_new_setting_create($button, $type, $title, $default, $section, $wp_customize, $priority_for_controls, $choices=null){
	$Title = $title;
	$title = strtolower($title);
	GLOBAL $settings_prefix;
//	GLOBAL $priority_for_controls;
//	$priority_for_controls++;
	$setting_name = $settings_prefix.$button.'_'.str_replace(array(' ', '/'), '_', $title);
	
	//Array of Arguments for settings
	$args = array(
			'label'          => __( $Title ),
			'section'        => $section,
			'settings'       => $setting_name,
			'type'           => $type,
	);
	//If choice available update Arguments for settings
	if (isset($choices)){
		$args = array(
	        'label'          => __( $Title ),
	        'section'        => $section,
	        'settings'       => $setting_name,
	        'type'           => $type,
	        'choices'        => $choices
	    );
	}
	
	//Adding Setting
	$wp_customize->add_setting(
			$setting_name ,
			array(
					'default'     => $default,
//					'transport'   => 'postMessage'
			)
	);
	//Adding control
	$wp_customize->add_control(
	    new WP_Customize_Control(
	        $wp_customize,
	        $setting_name,
	    	$args
	    )
	);
  }
}
?>