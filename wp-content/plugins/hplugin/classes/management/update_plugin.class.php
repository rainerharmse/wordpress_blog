<?php
	
	#UPDATE PLUGIN
	class hplugin_update_plugin{
		
		#CLASS VARS
		private $plugin_name;
		private $plugin_version;
		private $plugin_old_version;
		private $plugin_dir;
		private $object_manager;
		
		#CONSTRUCT
		public function __construct($plugin_name,$plugin_version,$plugin_old_version,$plugin_dir){
			//set class vars
			$this->plugin_name = $plugin_name;
			$this->plugin_version = $plugin_version;
			$this->plugin_old_version = $plugin_old_version;
			$this->plugin_dir = $plugin_dir;
			$this->object_manager = new hplugin_object_management($this->plugin_dir);
		}
		
		#TEARDOWN PLUGIN
		public function update_plugin(){
			//access globals
			global $wpdb;
			//update plugin tables
			/*
				-- update your plugin specific tables here --
				
				note: This should be version specific.				
			*/
			//update existing database objects with default object data
			$this->object_manager->update_database_objects();
			//mark the upgrade as successful
			$this->mark_update_complete();
		}
		
		#MARK UPDATE COMPLETE
		private function mark_update_complete(){
			//access globals
			global $wpdb;
			//once updates are complete, mark the plugin version in the DB
			$wpdb->query("UPDATE `". $wpdb->base_prefix ."hplugin_root` SET `plugin_version` = '". $this->plugin_version ."' WHERE `plugin_name` = '". $this->plugin_name ."';");
		}
		
	}