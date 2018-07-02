<?php 

	#PLUGIN INFORMATION
	/*
		Plugin Name: Hero Plugins
		Plugin URI: http://www.heroplugins.com
		Description: Hero Development Framework
		Version: 0.0.0
		Author: Hero Plugins
		Author URI: http://www.heroplugins.com
		License: GPLv2 or later
	*/
	
	#LICENSE INFORMATION
	/*  
		Copyright 2015  Hero Plugins (email : info@heroplugins.com)
	
		This program is free software; you can redistribute it and/or
		modify it under the terms of the GNU General Public License
		as published by the Free Software Foundation; either version 2
		of the License, or (at your option) any later version.
		
		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
		GNU General Public License for more details.
		
		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
	*/
	
	#PLUGIN INCLUDES
	require_once('classes/helper/check.helper.php');
	require_once('classes/management/activate_plugin.class.php');
	require_once('classes/management/update_plugin.class.php');
	require_once('classes/management/deactivate_plugin.class.php');
	require_once('classes/core/plugin_setup.class.php');
	require_once('classes/core/checkin.class.php');
	require_once('classes/core/promo.class.php');
	require_once('classes/core/display.class.php');
	require_once('classes/core/shortcode.class.php');
	require_once('classes/core/registration.class.php');
	require_once('classes/core/auto_generate.class.php');
	require_once('classes/core/frame_sec.class.php');
	require_once('classes/core/object_management.class.php');
	require_once('classes/backend.class.php');
	require_once('classes/frontend.class.php');
	require_once('inc/ajax.calls.php');
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	
	#DEFINE HELPER CLASS POINTER
	$hplugin_helper;
	
	#PLUGIN ROOT
	class heroplugin_hplugin{

		#PLUGIN CONFIG
		private $plugin_name = 'hplugin';
		private $plugin_friendly_name = 'Hero Plugin';
		private $plugin_friendly_description = 'Hero Development Framework';
		private $plugin_version = '0.0.0';
		private $plugin_prefix = 'hplugin_';
		private $first_release = '2015-01-01';
		private $last_update = '2015-01-01';
		private $api_version = '2.0.1';
		
		#CLASS VARS
		private $plugin_dir;
		private $plugin_url;
		private $plugin_basename;
		private $plugin_old_version;
		private $plugin_uuid;

		#CONSTRUCT
		public function __construct(){

			//define plugin vars
			$this->plugin_dir = dirname(__FILE__);
			$this->plugin_basename = plugin_basename(__FILE__);
			$this->plugin_url = plugins_url($this->plugin_name) .'/';
			
			//instantiate helper class
			global $hplugin_helper;
			$hplugin_helper = new hplugin_helper($this->plugin_prefix);
			
			//instantiate object manager
			$object_manager = new hplugin_object_management($this->plugin_dir);
			add_action('wp_ajax_hplugin_update_database_objects', array(&$object_manager, 'update_database_objects')); //admin: update database objects
			
			//register management hooks
			register_activation_hook(__FILE__,array(new hplugin_activate($this->plugin_name, $this->plugin_version, $this->plugin_dir), 'setup_plugin')); //activate
			register_deactivation_hook(__FILE__,array(new hplugin_deactivate($this->plugin_name), 'teardown_plugin')); //deactivate
			
			//detect if update required
			global $wpdb;
			if($this->plugin_old_version == NULL && $hplugin_helper->onAdmin()){ //only make the DB call if required
				$plugin_lookup = $wpdb->get_results("SELECT * FROM `". $wpdb->base_prefix ."hplugin_root` WHERE `plugin_name` = '". $this->plugin_name ."';");
				if($plugin_lookup){
					$this->plugin_old_version = $plugin_lookup[0]->plugin_version;
					$this->plugin_uuid = $plugin_lookup[0]->plugin_uuid; //define plugin uuid for check-in
				}
				if(version_compare($this->plugin_old_version,$this->plugin_version,'<')){
					$update = new hplugin_update_plugin($this->plugin_name,$this->plugin_version,$this->plugin_old_version, $this->plugin_dir);
					$update->update_plugin();
				}
			}

			//instantiate plugin setup
			new hplugin_setup($this->plugin_name,$this->plugin_dir,$this->plugin_url,$this->plugin_friendly_name,$this->plugin_version,$this->plugin_prefix,$this->first_release, $this->last_update, $this->plugin_friendly_description);
			
			//queue update check
			$checkin = new hplugin_checkin($this->plugin_basename,$this->plugin_name,$this->plugin_friendly_name,$this->api_version);
			add_filter('pre_set_site_transient_update_plugins', array(&$checkin, 'check_in'));
			
			//instantiate promotions class
			$promo = new hplugin_promo($this->plugin_basename,$this->plugin_name,$this->api_version);
			
			//instantiate admin class
			$backend = new hplugin_backend(); //this instance can be used by WP for ajax implementations
			
			//instantiate front-end class
			$frontend = new hplugin_frontend(); //this instance can be used by WP for ajax implementations
			
			//instantiate the frame security class
			$frame_sec = new hplugin_frame_sec($this->plugin_dir);
			
			//bind admin ajax listeners
			add_action('wp_ajax_hplugin_getPromotion', array(&$promo, 'get_promotion')); //admin: get plugin rating
			add_action('wp_ajax_hplugin_get_security_code', array(&$frame_sec, 'get_security_code')); //admin: get frame security code
			
			//instantiate registrations class (register all ajax hooks)
			new hplugin_registration($this->plugin_prefix, $backend, $frontend);
			
			//configure auto-generation class and hooks
			$autogenerate = new hplugin_autogenerate($this->plugin_dir);
			add_action('wp_ajax_hplugin_autoGenerateViews', array(&$autogenerate, 'create_views')); //admin: get plugin rating
			
		}
		
	}
	
	#INITIALISE THE PLUGIN CODE WHEN WP INITIALISES
	new heroplugin_hplugin();