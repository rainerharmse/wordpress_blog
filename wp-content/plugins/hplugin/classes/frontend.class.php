<?php

	#PLUGIN FRONT-END MANAGEMENT
	class hplugin_frontend{
		
		#IMPLEMENT SHORTCODE LISTENER
		public function get_shortcode_content($atts){
			//fetch object and return
			return $this->get_object_from_database($atts['id']);
		}
		
		#GET OBJECT FROM DATABASE
		private function get_object_from_database($object_id){
			//check for object
			if(isset($object_id)){
				//access globals
				global $wpdb, $hplugin_helper;
				//select object
				$object = $wpdb->get_results("
					SELECT
						*
					FROM
						`". $wpdb->base_prefix ."hplugin_default_storage_table`
					WHERE
						`storage_id` = ". $object_id ."
						AND `deleted` = 0;
				");
				//check that object exists
				if(count($object) > 0){
					//generate unique name
					$unique_name = str_replace('-','',$hplugin_helper->genGUID());
					$response = '
						<script type="text/javascript" data-cfasync="false">
							var hplugin_default_object_'. $unique_name .' = '. $object[0]->json_object .';
							jQuery(function(){
								hplugin_initialise_frontend("'. $unique_name .'");
							});
						</script>
					';
					return $response;
				}
			}
			//respond with not found
			return 'Unable to locate object with id: '. $object_id;
		}
		
	}	