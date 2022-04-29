<?php
/**
 * Options Action.
 * 
 * @package WOPB\Notice
 * @since v.1.0.0
 */
namespace WOPB;

defined('ABSPATH') || exit;

/**
 * Options class.
 */
class Options{

    /**
	 * Setup class.
	 *
	 * @since v.1.1.0
	 */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'menu_page_callback' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );

        add_action( 'in_admin_header', array($this, 'remove_all_notices') );
        add_filter( 'plugin_row_meta', array( $this, 'plugin_settings_meta' ), 10, 2 );
        add_filter( 'plugin_action_links_'.WOPB_BASE, array( $this, 'plugin_action_links_callback' ) );
    }

    /**
	 * Remove All Notification From Menu Page
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function remove_all_notices() {
        if ( isset( $_GET['page'] ) && ( $_GET['page'] === 'wopb-settings' || $_GET['page'] === 'wopb-features' || $_GET['page'] === 'wopb-addons' || $_GET['page'] === 'wopb-option-settings' || $_GET['page'] === 'wopb-contact' || $_GET['page'] === 'wopb-license' ) ) {
            remove_all_actions( 'admin_notices' );
            remove_all_actions( 'all_admin_notices' );
        }
    }


    /**
	 * Plugins Settings Meta Menu Add
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public function plugin_settings_meta( $links, $file ) {
        if ( strpos( $file, 'product-blocks.php' ) !== false ) {
            $new_links = array(
                'wopb_docs' =>  '<a href="https://docs.wpxpo.com/" target="_blank">'.__('Docs', 'product-blocks').'</a>',
                'wopb_tutorial' =>  '<a href="https://www.youtube.com/watch?v=JZxIflYKOuM&list=PLPidnGLSR4qcAwVwIjMo1OVaqXqjUp_s4" target="_blank">'.__('Tutorials', 'product-blocks').'</a>',
                'wopb_support' =>  '<a href="'.wopb_function()->get_premium_link('https://www.wpxpo.com/contact/').'" target="_blank">'.__('Support', 'product-blocks').'</a>'
            );
            
            $links = array_merge( $links, $new_links );
        }
        return $links;
    }


    /**
	 * Plugins Settings Meta Pro Link Add
     * 
     * @since v.1.1.0
	 * @return NULL
	 */
    public function plugin_action_links_callback ( $links ) {
        $upgrade_link = array();
        $setting_link = array();
        if(!defined('WOPB_PRO_VER')){
            $upgrade_link = array(
                'wopb_pro' => '<a href="'.wopb_function()->get_premium_link().'" target="_blank"><span style="color: #e83838; font-weight: bold;">'.__('Go Pro', 'product-blocks').'</span></a>'
            );
        }
        $setting_link['wopb_settings'] = '<a href="'. menu_page_url('wopb-option-settings', false) .'">'. __('Settings', 'wp-megamenu') .'</a>';
        return array_merge( $setting_link, $links, $upgrade_link);
    }


    /**
	 * Plugins Menu Page Added
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function menu_page_callback() {
        $wopb_menu_icon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MCA1MCI+PHBhdGggZD0iTTQxLjggMTIuMDdoLTUuMjZ2LS41NEMzNi41NCA1LjE4IDMxLjM3IDAgMjUgMGMtNi4zNiAwLTExLjU0IDUuMTgtMTEuNTQgMTEuNTR2LjU0SDguMjFjLTQuMjkgMC03LjU2IDMuODItNi44OSA4LjA2bDMuNzkgMjMuOTlDNS42NCA0Ny41IDguNTYgNTAgMTIgNTBoMjYuMDFjMy40MyAwIDYuMzYtMi41IDYuODgtNS44OGwzLjc5LTIzLjk5Yy42Ny00LjI0LTIuNjEtOC4wNi02Ljg4LTguMDZ6TTE2IDExLjU0YzAtNC45NiA0LjA0LTkgOS05czkgNC4wNCA5IDl2LjU0SDE2di0uNTR6bTExLjk5IDEyLjQ4YzAgLjE0LS4wNC4zLS4xMi40NGwtMS41MiAyLjctMS4xIDEuOTJjLS4xMS4xOS0uMzguMTktLjQ5IDBsLTIuNjMtNC42MmMtLjMzLS42LjEtMS4zMy43Ny0xLjMzaDQuMTljLjUzIDAgLjkuNDMuOS44OXptLTcuNTYgMTIuNzFjLS4zMy42LTEuMi42LTEuNTUgMGwtLjY1LTEuMTUtNS4yNS05LjIzYy0uNjUtMS4xNC0uMi0yLjUuODEtMy4xMi4yNS0uMTUuNTUtLjI3Ljg2LS4zMS4xMi0uMDIuMjMtLjAyLjM1LS4wMmgyLjE0YzEuMSAwIDIuMS41OCAyLjYzIDEuNTJsLjIzLjM5IDIuMzEgNC4wOC44OCAxLjU0Yy4yNS40NS4yNSAxLjAxIDAgMS40NmwtMiAzLjUxLS43NiAxLjMzem02LjY3IDIuNDVoLTQuMmMtLjUxIDAtLjg5LS40My0uODktLjg5IDAtLjE1LjA0LS4zLjEyLS40NGwxLjU0LTIuNjkgMS4xLTEuOTNjLjExLS4xOS4zOC0uMTkuNDkgMGwyLjYyIDQuNjJhLjg5My44OTMgMCAwMS0uNzggMS4zM3ptOS45NC0xMi44M2wtNS45MiAxMC4zOGMtLjMzLjYtMS4yLjYtMS41NSAwbC0uNzUtMS4zMi0xLjk5LTMuNTFjLS4yNi0uNDUtLjI2LTEuMDEgMC0xLjQ2bC44Ny0xLjU0IDIuMzItNC4wOC4yMS0uMzlhMy4wNCAzLjA0IDAgMDEyLjYzLTEuNTJoMi4xNWMuNDUgMCAuODYuMTIgMS4yLjMzYTIuMjkgMi4yOSAwIDAxLjgzIDMuMTF6IiBmaWxsPSIjYTdhYWFkIi8+PC9zdmc+';
        add_menu_page(
            esc_html__( 'ProductX', 'product-blocks' ),
            esc_html__( 'ProductX', 'product-blocks' ),
            'manage_options',
            'wopb-settings',
            '',
            $wopb_menu_icon
        );


        require_once WOPB_PATH . 'classes/options/Overview.php';
        require_once WOPB_PATH . 'classes/options/Addons.php';
        require_once WOPB_PATH . 'classes/options/Settings.php';
        require_once WOPB_PATH . 'classes/options/Contact.php';
        new \WOPB\Options_Overview();
        new \WOPB\Options_Addons();
        new \WOPB\Options_Settings();
        new \WOPB\Options_Contact();

        if( !function_exists('wopb_pro_function') ){
            global $submenu;
            $submenu['wopb-settings'][] = array( '<span class="wopb-dashboard-upgrade"><span class="dashicons dashicons-update"></span> Upgrade</span>', 'manage_options', wopb_function()->get_premium_link() );
        }
    }


    /**
	 * Register a setting and its sanitization callback.
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function register_settings() {
       register_setting( 'wopb_options', 'wopb_options', array( self::class, 'sanitize' ) );
    }


    /**
	 * Sanitization Callback Add.
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function sanitize( $options ) {
        if ($options) {
            $settings = self::get_option_settings();
            foreach ($settings as $key => $setting) {
                if (!empty($key)) {
                    $options[$key] = sanitize_text_field($options[$key]);
                }
            }
        }
        return $options;
    }


    /**
	 * General Option Settings
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function get_option_settings(){
        return array(
            'css_save_as' => array(
                'type' => 'select',
                'label' => __('CSS Save Method', 'product-blocks' ),
                'options' => array(
                    'wp_head'   => __( 'Header','product-blocks' ),
                    'filesystem' => __( 'File System','product-blocks' ),
                ),
                'default' => 'wp_head',
                'desc' => __('Select where you want to save CSS.', 'product-blocks' )
            ),
            'container_width' => array(
                'type' => 'number',
                'label' => __('Container Width', 'product-blocks' ),
                'default' => '1140',
                'desc' => __('Change Container Width.', 'product-blocks' )
            ),
            'hide_import_btn' => array(
                'type' => 'switch',
                'label' => __('Hide Import Button', 'product-blocks'),
                'default' => '',
                'desc' => __('Hide Import Layout Button from the Gutenberg Editor.', 'product-blocks')
            ),
        );
    }


    /**
	 * Changelog Data.
     * 
     * @since v.1.0.0
	 * @return NULL
	 */
    public static function get_changelog_data() {
        $html = '';
        $resource_data = file_get_contents(WOPB_PATH.'/readme.txt', "r");
        $data = array();
        if ($resource_data) {
            $resource_data = explode('== Changelog ==', $resource_data);
            if (isset($resource_data[1])) {
                $resource_data = $resource_data[1];
                $resource_data = explode("\n", $resource_data);
                $inner = false;
                $count = -1;
                
                foreach ($resource_data as $element) {
                    if ($element){
                        if (substr_count($element, '=') > 1) {
                            $count++;
                            $temp = trim(str_replace('=', '', $element));
                            if (strpos($temp, '-') !== false) {
                                $temp = explode('-', $temp);
                                $data[$count]['date'] = trim($temp[1]);
                                $data[$count]['version'] = trim($temp[0]);
                            }
                        }
                        if (strpos($element, '* New:') !== false) {
                            $data[$count]['new'][] = trim(str_replace('* New:', '', $element));
                        }
                        if (strpos($element, '* Fix:') !== false) {
                            $data[$count]['fix'][] = trim(str_replace('* Fix:', '', $element));
                        }
                        if (strpos($element, '* Update:') !== false) {
                            $data[$count]['update'][] = trim(str_replace('* Update:', '', $element));
                        }
                    }
                }
            }
        }
        if (!empty($data)) {
            foreach ($data as $k => $inner_data) {
                $html .= '<div class="wopb-changelog-wrap">';
                foreach ($inner_data as $key => $changelog) {
                    if ($key == 'date') {
                        $html .= '<div class="wopb-changelog-date">'.__('Released on ', 'product-blocks' ).' '.$changelog.'</div>';
                    } elseif($key == 'version') {
                        $html .= '<div class="wopb-changelog-version">'.__('Version', 'product-blocks' ).' : '.$changelog.'</div>';
                    } else {
                        foreach ($changelog as $keyword => $val) {
                            $html .= '<div class="wopb-changelog-title"><span class="changelog-'.$key.'">'.$key.'</span>'.$val.'</div>';
                        }
                    }
                }
                $html .= '</div>';
            }
        }
        echo $html;
    }
    
}