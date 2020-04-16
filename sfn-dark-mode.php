<?php
/*
Plugin Name: SFN Dark Mode
Plugin URI:
Description: Provides dark mode toggle and cookie storage. The CSS is your own to do
Version: 1.0
Author: SFNdesign, Curtis McHale
Author URI: http://sfndesign.ca
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class SFN_Dark_Mode{

	private static $instance;

	/**
	 * Spins up the instance of the plugin so that we don't get many instances running at once
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 *
	 * @uses $instance->init()                      The main get it running function
	 */
	public static function instance(){

		if ( ! self::$instance ){
			self::$instance = new SFN_Dark_Mode();
			self::$instance->init();
		}

	} // instance

	/**
	 * Spins up all the actions/filters in the plugin to really get the engine running
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 *
	 * @uses $this->constants()                 Defines our constants
	 * @uses $this->includes()                  Gets any includes we have
	 */
	public function init(){

		$this->constants();
		$this->includes();

		add_action( 'wp_footer', array( $this, 'darkmode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

		// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
		register_activation_hook( __FILE__, array( $this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		register_uninstall_hook( __FILE__, array( __CLASS__, 'uninstall' ) );

	} // init

	/**
	 * Registers and enqueues scripts and styles
	 *
	 * @uses    wp_enqueue_style
	 * @uses    wp_enqueue_script
	 *
	 * @since   1.0
	 * @author  SFNdesign, Curtis McHale
	 */
	public function enqueue(){

		// styles plugin
		wp_enqueue_style( 'sfn_dark_mode_styles', plugins_url( '/sfn-dark-mode/sfn-dark-mode-styles.css' ), '', '1.0', 'all');

		// scripts plugin
		wp_enqueue_script('sfn_dark_mode_scripts', plugins_url( '/sfn-dark-mode/sfn-dark-mode-scripts.js' ), array('jquery'), '1.0', true);

	}

	/**
	 * Adds our dashicons and toggle area so that we can deal with the toggle
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 *
	 * @return  string      $html                   The HTML we need for the toggle
	 */
	public static function darkmode(){

		$html = '';

		$html .= '<div id="darkmode-toggle" class="dashicons dashicons-lightbulb"></div>';

		echo $html;

	} // darkmode

	/**
	 * Gives us any constants we need in the plugin
	 *
	 * @since 1.0
	 */
	public function constants(){

		define( 'SFN_DARK_MODE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

	}

	/**
	 * Includes any externals
	 *
	 * @since 1.0
	 * @author SFNdesign, Curtis McHale
	 * @access public
	 */
	public function includes(){

	}

	/**
	 * Fired when plugin is activated
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function activate( $network_wide ){

	} // activate

	/**
	 * Fired when plugin is deactivated
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function deactivate( $network_wide ){

	} // deactivate

	/**
	 * Fired when plugin is uninstalled
	 *
	 * @param   bool    $network_wide   TRUE if WPMU 'super admin' uses Network Activate option
	 */
	public function uninstall( $network_wide ){

	} // uninstall

} // SFN_Dark_Mode

SFN_Dark_Mode::instance();
