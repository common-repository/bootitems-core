<?php
function bootitems_core_get_theme_name(){
    $current_theme = wp_get_theme();
    return $current_theme->get('Name');
}

function bootitems_core_plugin_check_activated(){
    $pluginList = get_option( 'active_plugins' );
    $bootitems_core_plugin = 'advanced-import/advanced-import.php'; 
    $checkPlugin = in_array( $bootitems_core_plugin , $pluginList );
    return $checkPlugin;
}

function bootitems_core_plugin_file_exists(){
    $bootitems_core_plugin = 'advanced-import/advanced-import.php'; 
    $pathpluginurl = WP_PLUGIN_DIR .'/'. $bootitems_core_plugin;
    $isinstalled = file_exists( $pathpluginurl );
    return $isinstalled;
}

function bootitems_core_get_theme_screenshot(){
    $current_theme = wp_get_theme();
    return $current_theme->get_screenshot();
}

function bootitems_core_get_current_theme_slug(){
    $current_theme = wp_get_theme();
    return $current_theme->stylesheet;
}

function bootitems_core_get_templates_lists( $theme_slug ){
    
    switch ( $theme_slug ):
	
        case "helphealth-medical":
			$demo_templates_lists = array(
				'helphealth-medical' =>array(
					'title' => esc_html__( 'Grid Main', 'bootitems-core' ),/*Title*/
					'is_pro' => false,  /*Premium*/
					'type' => 'free',
					'author' => esc_html__( 'Bootitems', 'bootitems-core' ),    /*Author Name*/
					'keywords' => array( 'helphealth-medical' , 'bootitems-core'),  /*Search keyword*/
					'categories' => array( 'free' ), /*Categories*/
					'template_url' => array(
						'content' => 'https://bootitems.com/files/helphealth-medical/content.json',
						'options' => 'https://bootitems.com/files/helphealth-medical/options.json',
						'widgets' => 'https://bootitems.com/files/helphealth-medical/widgets.json'
					),
					'screenshot_url' => 'https://bootitems.com/files/helphealth-medical/screenshot.png',
					'demo_url' => 'https://bootitems.com/wp/helphealth-medica/',
					'plugins' => ''
				),


			);
		break;
        case "bizindustries":
            $demo_templates_lists = array(

                'bizindustries' =>array(
                    'title' => esc_html__( 'Bizindustries', 'bootitems-core' ),/*Title*/
                    'is_pro' => false,  /*Premium*/
                    'type' => 'free',
                    'author' => esc_html__( 'Bootitems', 'bootitems-core' ),    /*Author Name*/
                    'keywords' => array( 'bizindustries' , 'bootitems-core'),  /*Search keyword*/
                    'categories' => array( 'free' ), /*Categories*/
                    'template_url' => array(
						'content' => 'https://bootitems.com/files/bizindustries/content.json',
						'options' => 'https://bootitems.com/files/bizindustries/options.json',
						'widgets' => 'https://bootitems.com/files/bizindustries/widgets.json'
                    ),
					'screenshot_url' => 'https://bootitems.com/files/bizindustries/screenshot.png',
					'demo_url' => 'https://bootitems.com/wp/bizindustries/',
                    'plugins' => ''
                ),

			);
		break;
		
	
        default:
            $demo_templates_lists = array();
    endswitch;

    return $demo_templates_lists;

}

if ( bc_fs()->can_use_premium_code() ) {
    add_action( 'advanced_import_is_pro_active','bootitems_core_set_premium_active' );
    function bootitems_core_set_premium_active( $is_pro_active ) {
        return true;
    }
}


