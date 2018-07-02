{
    "menu": {
        "config": {
            "development_mode": true
        },
        "structure": [
            {
                "id": "dashboard",
                "title": "Dashboard",
                "icon": "dashboard",
                "type": "link",
				"show_in_sidebar": true,
                "auto_load_subview": false,
                "viewpath": "dashboard/",
                "header": {
                    "auto_generate": false,
                    "show_save": false,
                    "header_label": "",
                    "header_title": ""
                }
            },
            {
                "id": "dropdown_default",
                "title": "Objects",
                "icon": "code",
                "type": "dropdown",
                "auto_load_subview": false,
                "submenu": [
                    {
                        "id": "dropdown_submenu_holder",
                        "type": "holder"
                    },
                    {
                        "id": "sidebar_add_new_btn",
                        "title": "Add New",
                        "type": "button"
                    }
                ],
                "viewpath": "dropdown/",
                "header": {
                    "auto_generate": true,
                    "show_save": true,
                    "header_label": "",
                    "header_title": ""
                },
                "views": [
                    {
                        "id": "sub_example",
                        "title": "Example",
                        "icon": "code",
                        "submenu": [
                            {
                                "id": "sub_example_view",
                                "title": "Example",
								"auto_load_components": true,
                                "view": "sub_example_view"
                            },
                            {
                                "id": "sub_example_view2",
                                "title": "Example",
                                "auto_load_components": true,
                                "view": "sub_example_view2"
                            }
                        ]
                    }
                ]
            },
            {
                "id": "sample",
                "title": "Code Assist",
                "icon": "code",
                "type": "link",
				"show_in_sidebar": true,
                "auto_load_subview": true,
                "viewpath": "code_assist/",
                "header": {
                    "auto_generate": true,
                    "show_save": true,
                    "header_label": "Currently Viewing",
                    "header_title": "Framework Documentation"
                },
                "views": [
                    {
                        "id": "code_assist_getting_started",
                        "title": "Process",
                        "icon": "code",
                        "submenu": [
							{
                                "id": "getting_started",
                                "title": "Getting Started",
								"auto_load_components": true,
                                "view": "getting_started"
                            },
							{
                                "id": "packaging_plugin",
                                "title": "Packaging The Plugin",
								"auto_load_components": true,
                                "view": "packaging_plugin"
                            }
                        ]
                    },
					{
                        "id": "code_assist_framework",
                        "title": "Framework",
                        "icon": "code",
                        "submenu": [
							{
                                "id": "sample_object_management",
           						"title": "NoSQL Object Model",
								"auto_load_components": true,
                                "view": "sample_object_management"
                            },
							{
                                "id": "sample_components",
                                "title": "Components",
								"auto_load_components": true,
                                "view": "sample_components"
                            },
							{
                                "id": "sample_view_management",
                                "title": "Views",
								"auto_load_components": true,
                                "view": "sample_views"
                            },
							{
                                "id": "sample_notifications",
                                "title": "Notifications",
								"auto_load_components": true,
                                "view": "sample_notifications"
                            },
							{
                                "id": "sample_popups",
                                "title": "Popup Panels",
								"auto_load_components": true,
                                "view": "sample_popups"
                            },
							{
                                "id": "sample_save",
                                "title": "Persistance",
								"auto_load_components": true,
                                "view": "sample_save"
                            },
							{
                                "id": "sample_sidebar",
                                "title": "Sidebar",
								"auto_load_components": true,
                                "view": "sample_sidebar"
                            },
							{
                                "id": "sample_events",
                                "title": "Events",
								"auto_load_components": true,
                                "view": "sample_events"
                            },
							{
                                "id": "sample_menu",
                                "title": "Menu",
								"auto_load_components": true,
                                "view": "sample_menu"
                            },
							{
                                "id": "sample_files",
                                "title": "File Structure",
								"auto_load_components": true,
                                "view": "sample_files"
                            },
							{
                                "id": "sample_tooltips",
                                "title": "Tooltips",
								"auto_load_components": true,
                                "view": "sample_tooltips"
                            }
                        ]
                    },
					{
                        "id": "code_assist_code",
                        "title": "Code",
                        "icon": "code",
                        "submenu": [
							{
                                "id": "sample_ajax",
                                "title": "AJAX",
								"auto_load_components": true,
                                "view": "sample_ajax"
                            },
							{
                                "id": "sample_iframe",
                                "title": "Secure IFRAME",
								"auto_load_components": true,
                                "view": "sample_iframe"
                            },
							{
                                "id": "sample_media",
                                "title": "Media",
								"auto_load_components": true,
                                "view": "sample_media"
                            },
							{
                                "id": "sample_frontend",
                                "title": "Frontend Output",
								"auto_load_components": true,
                                "view": "sample_frontend"
                            },
							{
                                "id": "sample_libraries",
                                "title": "External Libraries",
								"auto_load_components": true,
                                "view": "sample_libraries"
                            },
							{
                                "id": "sample_development",
                                "title": "Development Tools",
								"auto_load_components": true,
                                "view": "sample_development"
                            }
                        ]
                    }
                ]
            },
            {
                "id": "root_example_btn",
                "title": "Button",
                "type": "button"
            }
        ]
    }
}