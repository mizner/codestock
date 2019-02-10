<?php
/**
 * @package   Sessionize.com
 * @author    Sessionize.com
 * @link      http://sessionize.com/
 *
 * Plugin Name:       Sessionize.com
 * Description:       Embed your Sessionize.com event
 * Version:           1.0.0
 * Author:            Sessionize.com
 * Author URI:        http://sessionize.com/
 * Text Domain:       sessionize
 */

class Sessionize{

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Sessionize API endpoint
	 *
	 * @since    1.0.0
	 *
	 */
	private $remote_embed_url = 'https://sessionize.com/api/v2/[ID]/meta/wordpress';


	/**
	 * Initialize the plugin
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		add_shortcode( 'sessionize', array( $this, 'sessionize_shortcode_handler' ) );
		add_action( 'admin_head', array( $this, 'sessionize_editor_button' ) );
		add_action( 'after_wp_tiny_mce', array( $this, 'tinymce_extra_vars' ) );
	
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Sessionize shortcode handler
	 *
	 * @since     1.0.0
	 *
	 */
	public function sessionize_shortcode_handler( $atts ) {

		$shortcode_atts = shortcode_atts( array(
		    'id' => '',
		    'embed_type' => '',
		), $atts );

		if ( empty( $shortcode_atts['id'] ) || empty( $shortcode_atts['embed_type'] ) )
			return;

		$event_id = $shortcode_atts['id'];
		$embed_type = $shortcode_atts['embed_type'];

		if( false === ( $embed_output = get_transient( 'sessionize_embed_'.$event_id.'_'.$embed_type ) ) ){

			$remote_embed_url =  $this->remote_embed_url;
			$remote_embed_url =  str_replace('[ID]', $event_id, $remote_embed_url);

			$embed = wp_remote_get( esc_url_raw( $remote_embed_url.'/'.$embed_type ) );

			$embed_output = wp_remote_retrieve_body( $embed );
			$response_code = wp_remote_retrieve_response_code( $embed );

			if( $response_code === 200 ){
				set_transient( 'sessionize_embed_'.$event_id.'_'.$embed_type, $embed_output, 10 * MINUTE_IN_SECONDS );
			}
		}

		return $embed_output;

	}

	/**
	 * Editor button hooks
	 *
	 * @since     1.0.0
	 *
	 */
	function sessionize_editor_button() {
	    
	    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
	        return;
	    }

	    add_filter( 'mce_external_plugins', array( $this, 'add_buttons' ) );
	    add_filter( 'mce_buttons', array( $this, 'register_buttons' ) );
	}

	/**
	 * Register button popup
	 *
	 * @since     1.0.0
	 *
	 */
	public function add_buttons( $plugin_array ) {
	    
	    $plugin_array['sessionize_button'] = plugins_url( 'assets/scripts/tinymce_button.js', __FILE__ );
	    return $plugin_array;
	
	}

	/**
	 * Register button
	 *
	 * @since     1.0.0
	 *
	 */
	public function register_buttons( $buttons ) {
	    
	    array_push( $buttons, 'sessionize_button' );
	    return $buttons;
	
	}

	/**
	 * Fetch sessionize embed types
	 *
	 * @since     1.0.0
	 *
	 */
	private function remote_embed_types(){
		
		$embed_types = array();

		if ( false === ( $embed_types = get_transient( 'sessionize_embed_types' ) ) ) {

			$remote_embed_types_url = str_replace( '[ID]/', '', $this->remote_embed_url );
			
			$remote_embed_types = wp_remote_get( esc_url_raw( $remote_embed_types_url ) );

			if ( !is_wp_error( $remote_embed_types ) ) {
				$remote_embed_types = json_decode( wp_remote_retrieve_body( $remote_embed_types ), true );
			}

			if( is_array( $remote_embed_types ) ){
				foreach( $remote_embed_types as $remote_embed_type_key => $remote_embed_type_value ){
					$embed_types[] = array(
						'text' => $remote_embed_type_value,
						'value' => $remote_embed_type_key,
					);
				}
			}

			set_transient( 'sessionize_embed_types', $embed_types, 6 * HOUR_IN_SECONDS );
		}

		return $embed_types;
	}

	/**
	 * Sessionize tinyMCE object
	 *
	 * @since     1.0.0
	 *
	 */
public function tinymce_extra_vars() { ?>
		
<script type="text/javascript">
	var sessionize_tinyMCE_object = <?php echo json_encode(
		array(
			'button_name' 		=> esc_html__( '', 'sessionize' ),
			'sessionize_icon' 	=> plugins_url( 'assets/images/sessionize-icon-filled.png', __FILE__ ),
			'button_title' 		=> esc_html__( 'Sessionize Embed', 'sessionize' ),
			'event_id_title' 	=> esc_html__( 'Embed ID', 'sessionize' ),
			'embed_type_title' 	=> esc_html__( 'View', 'sessionize' ),
			'embed_type_msg' 	=> esc_html__( 'Select the view', 'sessionize' ),
			'embed_types' 		=> $this->remote_embed_types(),
		)
	);
	?>;
</script><?php
	
}
}

Sessionize::get_instance();