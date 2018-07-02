<?php

	#PLUGIN BACK-END MANAGEMENT
	class hplugin_backend{
		
		#CONSTRUCT
		public function __construct(){
		}
		
		#INSERT OBJECT
		public function insert_object(){
			//check for object
			if(isset($_POST['object_name']) && isset($_POST['object'])){
				//access globals
				global $wpdb;
				//insert default object
				$sql_insert = $wpdb->query("
					INSERT INTO `". $wpdb->base_prefix ."hplugin_default_storage_table` (`object_name`, `json_object`)
					VALUES('". str_replace('"','&quot;',str_replace('\'','&#8217;',$_POST['object_name'])) ."','". $_POST['object'] ."');
				");
				echo json_encode($wpdb->insert_id);
				exit();
			}
			//respond with error
			echo json_encode(false);
			exit();
		}		
		
		#GET OBJECT LIST
		public function get_object_list(){
			//access globals
			global $wpdb;
			//select object list
			$objects = $wpdb->get_results("
				SELECT
					*
				FROM
					`". $wpdb->base_prefix ."hplugin_default_storage_table`
				WHERE
					`deleted` = 0;
			");
			//check that at least one object exists
			if(count($objects) > 0){
				//create return object
				$object_list = array();
				//iterate results
				foreach($objects as $object){
					array_push($object_list, array(
						'object_id' => intval($object->storage_id),
						'object_name' => $object->object_name
					));
				}
				//return object list
				echo json_encode($object_list);
				exit();				
			}
			//respond with nothing found
			echo json_encode(false);
			exit();
		}
		
		#GET OBJECT
		public function get_object(){
			//check for object
			if(isset($_POST['object_id'])){
				//access globals
				global $wpdb;
				//select object
				$object = $wpdb->get_results("
					SELECT
						*
					FROM
						`". $wpdb->base_prefix ."hplugin_default_storage_table`
					WHERE
						`storage_id` = ". $_POST['object_id'] ."
						AND `deleted` = 0;
				");
				//check that object exists
				if(count($object) > 0){
					//return object
					echo json_encode(array(
						'object_name' => $object[0]->object_name,
						'object' => $object[0]->json_object,
					));
					exit();
				}
			}
			//respond with error
			echo json_encode(false);
			exit();
		}
		
		#UPDATE OBJECT
		public function update_object(){
			//check for object
			if(isset($_POST['object_id']) && isset($_POST['object'])){
				//access globals
				global $wpdb;
				//insert default object
				$sql_update = $wpdb->query("
					UPDATE
						`". $wpdb->base_prefix ."hplugin_default_storage_table`
					SET
						`json_object` = '". $_POST['object'] ."'
					WHERE
						`storage_id` = ". $_POST['object_id'] .";
				");
				echo json_encode(true);
				exit();
			}
			//respond with error
			echo json_encode(false);
			exit();
		}
		
		#RENAME OBJECT
		public function rename_object(){
			//check for object
			if(isset($_POST['object_id']) && isset($_POST['object_name'])){
				//access globals
				global $wpdb;
				//insert default object
				$sql_update = $wpdb->query("
					UPDATE
						`". $wpdb->base_prefix ."hplugin_default_storage_table`
					SET
						`object_name` = '". $_POST['object_name'] ."'
					WHERE
						`storage_id` = ". $_POST['object_id'] .";
				");
				echo json_encode(true);
				exit();
			}
			//respond with error
			echo json_encode(false);
			exit();
		}
		
		#DELETE OBJECT
		public function delete_object(){
			//check for object_id
			if(isset($_POST['object_id'])){
				//access globals
				global $wpdb;
				//insert default object
				$sql_update = $wpdb->query("
					UPDATE
						`". $wpdb->base_prefix ."hplugin_default_storage_table`
					SET
						`deleted` = 1
					WHERE
						`storage_id` = ". $_POST['object_id'] .";
				");
				echo json_encode(true);
				exit();
			}
			//respond with error
			echo json_encode(false);
			exit();
		}
		
		#DUPLICATE OBJECT
		public function duplicate_object(){
			//check for object_id
			if(isset($_POST['object_id'])){
				//access globals
				global $wpdb;
				//select object
				$object = $wpdb->get_results("
					SELECT
						*
					FROM
						`". $wpdb->base_prefix ."hplugin_default_storage_table`
					WHERE
						`storage_id` = ". $_POST['object_id'] ."
						AND `deleted` = 0;
				");
				//check that object exists
				if(count($object) > 0){
					//create duplicate object
					$sql_insert = $wpdb->query("
						INSERT INTO `". $wpdb->base_prefix ."hplugin_default_storage_table` (`object_name`, `json_object`)
						VALUES('". $object[0]->object_name ." (clone)','". $object[0]->json_object ."');
					");
					echo json_encode($wpdb->insert_id);
					exit();
				}
			}
			//respond with error
			echo json_encode(false);
			exit();
		}
		
		#CODE ASSIST EXAMPLE
		public function code_assist_example(){
			
			//access post data
			$post_data = $_POST['form_data'];
			
			//convert post data to PHP object
			$form_data = array();
			parse_str($post_data, $form_data);
			
			//define response
			$response_message = 'Data received: ';
			
			//respond with JSON object
			echo json_encode($response_message . $form_data['my_input']);
			exit();
			
		}
		
	}