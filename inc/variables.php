<?php
require_once 'classes.php';

$num_of_butts = 4;
$settings_prefix = 'woo_bc_s_b';

if(!function_exists('wp_get_current_user')) {
	include(ABSPATH . "wp-includes/pluggable.php");
}

$my_theme = wp_get_theme();
$theme_name = $my_theme->get( 'Name' );
if(strpos($theme_name, 'Canvas')!==false){
@include_once get_stylesheet_directory() . '/functions.php';
}
	/**
	 * Checks if google font available from canvas
	 * @uses wf_get_google_fonts_store
	 * @return array containing google fonts as name and value
	 */
	function get_google_fonts(){
		if(function_exists('wf_get_google_fonts_store')){
			$google_fonts_from_canvas = array();
			foreach(wf_get_google_fonts_store() as $f){
				$google_fonts_from_canvas[strtolower($f['name'])] = $f['name'];
			}
		}else{$google_fonts_from_canvas = false;}
			return $google_fonts_from_canvas;
		}
	
	/**
	 * Checks if system font available from canvas
	 * @uses wf_get_google_fonts_store
	 * @return array containing google fonts as name and value
	 */
	function get_system_fonts(){
		if(function_exists('wf_get_system_fonts')){
			$system_fonts_from_canvas = array();
		foreach(wf_get_system_fonts() as $k=>$v){
			$system_fonts_from_canvas[strtolower($k)] = $v;
		}
		}else{$system_fonts_from_canvas = false;}
		return $system_fonts_from_canvas;
	}
	
	$our_google_fonts = get_google_fonts();
	$our_system_fonts = get_system_fonts();
	
	if ($our_google_fonts && $our_system_fonts){
		$our_fonts = array_merge($our_google_fonts, $our_system_fonts);
		asort($our_fonts, 2);
	}elseif ($our_system_fonts){
		$our_fonts = $our_system_fonts;
	}elseif ($our_google_fonts){
		$our_fonts = $our_google_fonts;
	}else {
		$our_fonts = false;
	}
	
	if(!function_exists( 'woo_bc_s_color_setting_create' )){
/**
 * Creates color settings input
 * @uses $wp_customize->add_setting
 * @uses $wp_customize->add_control
 * @param number $button
 * @param string $title
 * @param string $default
 * @param string $section
 */
	function woo_bc_s_color_setting_create($button, $title, $default, $section, $wp_customize, $priority_for_controls){
	//Vars for easy application
	$Title = $title;
	$title = strtolower($title);
	GLOBAL $settings_prefix;
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
	/*
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
	*/
	$wp_customize->add_control(
			new Pluto_Customize_Alpha_Color_Control(
					$wp_customize,
					$setting_name,
					array(
							'label'    => __( $Title, '' ),
							'palette' => true,
							'section'	=> $section,
							'priority'	=> $priority_for_controls
					)
			)
	);
  }
}

if(!function_exists( 'woo_bc_s_new_setting_create' )){
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
  function woo_bc_s_new_setting_create($button, $type, $title, $default, $section, $wp_customize, $priority_for_controls, $choices=null){
	$Title = $title;
	$title = strtolower($title);
	GLOBAL $settings_prefix;
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
if(!function_exists( 'pluto_add_customizer_custom_controls' )){
	function pluto_add_customizer_custom_controls( $wp_customize ) {
		class Pluto_Customize_Alpha_Color_Control extends WP_Customize_Control {
			public $type = 'alphacolor';
			//public $palette = '#3FADD7,#555555,#666666, #F5f5f5,#333333,#404040,#2B4267';
			public $palette = true;
			public $default = '#3FADD7';
			protected function render() {
				$id = 'customize-control-' . str_replace( '[', '-', str_replace( ']', '', $this->id ) );
				$class = 'customize-control customize-control-' . $this->type; ?>
				<li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
					<?php $this->render_content(); ?>
				</li>
			<?php }
			public function render_content() { ?>
				<label>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<input type="text" data-palette="<?php echo $this->palette; ?>" data-default-color="<?php echo $this->default; ?>" value="<?php echo intval( $this->value() ); ?>" class="pluto-color-control" <?php $this->link(); ?>  />
				</label>
			<?php }
		}
	}
	add_action( 'customize_register', 'pluto_add_customizer_custom_controls' );
}
?>
