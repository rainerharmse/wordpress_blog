//DROPDOWN VIEW CORE

//globals
var object_id;
var object_name;

//get object
function load_default_object(json){
	//get object id
	object_id = json.object_id;
	//get object
	hplugin_get_object(object_id, 'load_view_content');
	//highlight active
	setTimeout(function(){
		jQuery('.hero_sub #sub_item_row_'+ json.object_id).addClass('active_sidebar_elem');
	},400);
	//unlock core view
	unlock_core_view_reload();
	//hide tooltip
	hide_hplugin_tooltip();
}

function load_view_content(object){
	//set title
	object_name = object.object_name;
	//define main object
	main_object = JSON.parse(object.object);
	//initialise object manager
	hplugin_bind_view_components(object_id, main_object);
	//load sub view
	manual_load_view('dropdown_default');
}