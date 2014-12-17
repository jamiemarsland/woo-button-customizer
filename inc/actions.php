<?php
require_once('variables.php');

function woo_bc_s_customizer_css() { 
	$num_of_butts = 4;
	GLOBAL $our_google_fonts;
	?>
	<?php
	if(isset($our_google_fonts)){
		for ($i=1; $i < ($num_of_butts+1); $i++) {
			GLOBAL $settings_prefix;
			if($our_google_fonts){
				$font = get_theme_mod( $settings_prefix.$i.'_font_type', 'Helvetica, Arial');
				if(array_key_exists($font, $our_google_fonts)){
					$font = ucwords($font);
					?>
					<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $font); ?>' rel='stylesheet' type='text/css'>
				<?php
				}
			}
		}
	}
	?>
	
	<style type="text/css" id='cx-bc-stylesheet'>
		<?php for ($i=1; $i < ($num_of_butts+1); $i++) {
		GLOBAL $settings_prefix;
		?>
		
	#wrapper a.woo-sc-button.bc-button<?php echo $i ?> { 
		background: <?php echo get_theme_mod( $settings_prefix.$i.'_button_color', '#0be' ); ?> !important;
		color: <?php echo get_theme_mod( $settings_prefix.$i.'_font_color' , '#fff'); ?> !important;
		font-size: <?php echo get_theme_mod( $settings_prefix.$i.'_font_size', '14' ); ?>px !important;
		font-family: <?php echo get_theme_mod( $settings_prefix.$i.'_font_type', 'Helvetica, Arial' ); ?> !important;
		font-weight: <?php echo get_theme_mod( $settings_prefix.$i.'_font_weight', 'normal'); ?> !important;
		padding: <?php echo get_theme_mod( $settings_prefix.$i.'_top_bottom_padding', '7' ) . 'px ' . get_theme_mod( $settings_prefix.$i.'_left_right_padding', '7' ); ?>px !important;
		border: <?php echo get_theme_mod( $settings_prefix.$i.'_border_width', '1' ).'px solid  '. get_theme_mod( $settings_prefix.$i.'_border_color', '#09c' ); ?> !important;
		-o-border-radius: <?php echo get_theme_mod( $settings_prefix.$i.'_button_rounded_corners', '4' ); ?>px !important;
		-moz-border-radius: <?php echo get_theme_mod( $settings_prefix.$i.'_button_rounded_corners', '4' ); ?>px !important;
		-webkit-border-radius: <?php echo get_theme_mod( $settings_prefix.$i.'_button_rounded_corners', '4' ); ?>px !important;
		border-radius: <?php echo get_theme_mod( $settings_prefix.$i.'_button_rounded_corners', '4' ); ?>px !important;
	}
	#wrapper a.woo-sc-button.bc-button<?php echo $i ?>:hover { 
		background: <?php echo get_theme_mod( $settings_prefix.$i.'_button_hover_color', '#09e' ); ?> !important;
	}
	
	<?php } ?>
	</style>
<?php }
add_action( 'wp_head', 'woo_bc_s_customizer_css' );

/**
 * Registers Javascript for live preview
 */
function cx_bc_customizer_live_preview() {
	wp_enqueue_script(
	'live_preview',
	get_template_directory_uri() . 'js/live-preview.js',
	array( 'jquery', 'customize-preview' ),
	'0.3.0',
	true
	);
} // end cx_bc_customizer_live_preview
add_action( 'customize_preview_init', 'cx_bc_customizer_live_preview' );
