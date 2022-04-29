<?php
namespace WOPB;

defined('ABSPATH') || exit;

class Options_Settings{
    public function __construct() {
        add_submenu_page('wopb-settings', 'Settings', 'Settings', 'manage_options', 'wopb-option-settings', array( $this, 'create_admin_page'), 15);

        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    public function register_settings() {
        register_setting( 'wopb_options', 'wopb_options', array( $this, 'sanitize' ) );
    }


    /**
     * Sanitization callback
     */
    public function sanitize( $options ) {
        if ($options) {
            $settings = self::get_option_settings_keys();
            foreach ($settings as $key) {
                $options[$key] = isset($options[$key]) ? $options[$key] : '';
            }
            $old_data = wopb_function()->get_setting();
            $options = array_merge($old_data, $options);
        }
        return $options;
    }


    /**
     * Settings Fields Key Return
     */
    public function get_option_settings_keys() {
        $attr = array();
        $data = self::get_option_settings();
        if (!empty($data)) {
            foreach ($data as $key => $inner_data) {
                if (isset($inner_data['attr'])) {
                    foreach ($inner_data['attr'] as $k => $val) {
                        $attr[] = $k;
                    }
                }
            }
        }
        return $attr;
    }

    /**
     * Settings Field Return
     */
    public static function get_option_settings(){
        return apply_filters('wopb_settings', array(
            'general' => array(
                'label' => __('General Settings', 'product-blocks'),
                'attr' => array(
                    'general_heading' => array(
                        'type'  => 'heading',
                        'label' => __('General Settings', 'product-blocks'),
                    ),
                    'css_save_as' => array(
                        'type' => 'select',
                        'label' => __('CSS Add Via', 'product-blocks'),
                        'options' => array(
                            'wp_head'   => __( 'Header - (Internal)','product-blocks' ),
                            'filesystem' => __( 'File System - (External)','product-blocks' ),
                        ),
                        'default' => 'wp_head',
                        'desc' => __('Select where you want to save CSS.', 'product-blocks')
                    ),
                    'container_width' => array(
                        'type' => 'number',
                        'label' => __('Container Width', 'product-blocks'),
                        'default' => '1140',
                        'desc' => __('Change Container Width of the Page Template(Gutenberg Post Blocks Template).', 'product-blocks')
                    ),
                    'editor_container' => array(
                        'type' => 'select',
                        'label' => __('Editor Container', 'product-blocks'),
                        'options' => array(
                            'theme_default' => __( 'Theme Default','product-blocks' ),
                            'full_width' => __( 'Full Width','product-blocks' )
                        ),
                        'default' => 'theme_default',
                        'desc' => __('Select Editor Container Width.', 'product-blocks')
                    ),
                    'hide_import_btn' => array(
                        'type' => 'switch',
                        'label' => __('Hide Import Button', 'product-blocks'),
                        'default' => '',
                        'desc' => __('Hide Import Layout Button from the Gutenberg Editor.', 'product-blocks')
                    ),
                )
            )
        ));
    }


    /**
     * Changelog Data
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
                        $html .= '<div class="wopb-changelog-date">'.__('Released on ', 'product-blocks').' '.$changelog.'</div>';
                    } elseif($key == 'version') {
                        $html .= '<div class="wopb-changelog-version">'.__('Version', 'product-blocks').' : '.$changelog.'</div>';
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


    public static function get_settings_render( $data ) {
        $html = '';
        $option_data = wopb_function()->get_setting();

        foreach ($data as $key => $value) {
            if ($value['type'] == 'hidden') {
                $html .= '<input type="hidden" name="wopb_options['.$key.']" value="'.$value['value'].'"/>';
            } else {
                if ($value['type'] == 'heading') {
                    $html .= '<h2 class="wopb-settings-heading">'.$value['label'].'</h2>';
                    if ( isset($value['desc']) ) {
                        $html .= '<div class="wopb-settings-subheading">'.$value['desc'].'</div>';
                    }
                }
                $html .= '<div class="wopb-settings-wrap">';
                if ($value['type'] != 'heading') {
                        if (isset($value['label'])) {
                            $html .= '<div class="wopb-settings-label">'.$value['label'].'</div>';
                        }
                }
                    $html .= '<div class="wopb-settings-field-wrap">';
                        switch ($value['type']) {

                            case 'radio':
                                $html .= '<div class="wopb-settings-field">';
                                    $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                                    foreach ( $value['options'] as $id => $label ) {
                                        $html .= '<input type="radio" id="'.$id.'" name="wopb_options['.$key.']" value="'.$id.'" '.( $val == $id ? 'checked':'').'>';
                                        $html .= '<label for="'.$id.'">'.strip_tags( $label ).'</label><br>';   
                                    }
                                    if (isset($value['pro'])) {
                                        $disable = '';
                                        if (!wopb_function()->isPro()) {
                                            $disable = 'disabled';
                                        }
                                        foreach ($value['pro'] as $id => $label) {
                                            $html .= '<input '.$disable.' type="radio" id="'.$id.'" name="wopb_options['.$key.']" value="'.$id.'" '.( $val == $id ? 'checked':'').'>';
                                            $html .= '<label for="'.$id.'">'.strip_tags( $label ).' '.($disable ? '<a href="'.wopb_function()->get_premium_link().'" target="_blank">['.__('PRO', 'product-blocks').']</a>' : '').'</label><br>';
                                        }
                                    }
                                    if (isset($value['desc'])) {
                                        $html .= '<p class="description">'.$value['desc'].'</p>';    
                                    }
                                $html .= '</div>';
                                break;

                            case 'select':
                                $html .= '<div class="wopb-settings-field">';
                                    $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                                    $html .= '<select name="wopb_options['.$key.']">';
                                        foreach ( $value['options'] as $id => $label ) {
                                            $html .= '<option value="'.$id.'" '.( $val == $id ? ' selected="selected"':'').'>';
                                            $html .= strip_tags( $label );
                                            $html .= '</option>';
                                        }
                                        $html .= '</select>';
                                    if(isset($value['desc'])){
                                        $html .= '<p class="description">'.$value['desc'].'</p>';
                                    }
                                $html .= '</div>';
                                break;

                            case 'color':
                                $html .= '<div class="wopb-settings-field">';
                                    $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                                    $html .= '<input name="wopb_options['.$key.']" value="'.$val.'" class="wopb-color-picker" />';
                                    if(isset($value['desc'])){
                                        $html .= '<p class="description">'.$value['desc'].'</p>';    
                                    }
                                $html .= '</div>';
                                break;

                            case 'number':
                                $html .= '<div class="wopb-settings-field">';
                                    $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                                    $html .= '<input type="number" name="wopb_options['.$key.']" value="'.$val.'"/>';
                                    if(isset($value['desc'])){
                                        $html .= '<p class="description">'.$value['desc'].'</p>';    
                                    }
                                $html .= '</div>';
                                break;

                            case 'switch':
                                $html .= '<div class="wopb-settings-field wopb-settings-field-inline">';
                                    $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                                    
                                    $disable = '';
                                    if (isset($value['pro'])) {
                                        if (!wopb_function()->isPro()) {
                                            $disable = 'disabled';
                                        }
                                    }
                                    if(isset($value['options'])){
                                        foreach ($value['options'] as $option_key => $option_value){
                                            $html .= '<div>';
                                                $html .= '<label class="wopb-multi-switch">';
                                                    $html .= '<input '.$disable.' type="checkbox" value="'.$option_key.'" name="wopb_options['.$key.'][]" '.(($val && in_array($option_key,$val)) ? 'checked' : '').' /> '.$option_value;
                                                $html .= '</label>';
                                            $html .= '</div>';
                                        }
                                    }else{
                                        $html .= '<input '.$disable.' type="checkbox" value="yes" name="wopb_options['.$key.']" '.($val == 'yes' ? 'checked' : '').' />';
                                        if (isset($value['desc'])) {
                                        $html .= '<p class="switch-description">'.$value['desc'].' '.($disable ? '<a href="'.wopb_function()->get_premium_link().'" target="_blank">['.__('PRO', 'product-blocks').']</a>' : '').'</p>';
                                    }
                                    }
                                $html .= '</div>';
                                break;

                            case 'text':
                                $html .= '<div class="wopb-settings-field">';
                                    $val = isset($option_data[$key]) ? $option_data[$key] : (isset($value['default']) ? $value['default'] : '');
                                    $html .= '<input type="text" name="wopb_options['.$key.']" value="'.$val.'"/>';
                                    if(isset($value['desc'])){
                                        $html .= '<p class="description">'.$value['desc'].'</p>';    
                                    }
                                $html .= '</div>';
                                break;

                            default:
                                # code...
                                break;

                        }
                    $html .= '</div>';
                $html .= '</div>';
            }
        }
        echo $html;
    }


    /**
     * Settings page output
     */
    public static function create_admin_page() { 
        $data = self::get_option_settings();
        ?>
        <div class="wopb-option-body">
        
            <?php require_once WOPB_PATH . 'classes/options/Heading.php'; ?>

            <?php $section = isset($_GET['tab']) ? $_GET['tab'] :'general'; ?>
            <div class="wopb-tab-wrap">
                <div class="wopb-tab-title-wrap">
                    <?php foreach ($data as $key => $value) { 
                        if (isset($value['label'])) { ?>
                            <div data-title="<?php echo $key; ?>" class="wopb-tab-title<?php if($section == $key){ echo ' active'; } ?>"><?php echo $value['label']; ?></div>
                        <?php } 
                    } ?>
                    <div data-title="changelog" class="wopb-tab-title<?php if($section == 'changelog'){ echo ' active'; } ?>"><?php _e('Changelog', 'product-blocks'); ?></div>
                </div>
                <div class="wopb-content-wrap">
                    <form method="post" action="options.php">
                        <div class="wopb-settings">
                            <input type="hidden" name="option_page" value="wopb_options" />
                            <input type="hidden" name="action" value="update" />
                            <?php echo wp_nonce_field( "wopb_options-options" ); ?>
                            <?php foreach ($data as $key => $value) {
                                if (isset($value['attr'])) { ?>
                                    <div class="wopb-tab-content<?php if($section == $key){ echo ' active'; } ?>">
                                        <div class="wopb-tab-overview">
                                            <?php self::get_settings_render( $value['attr'] ); ?>
                                        </div>
                                    </div>
                                <?php }
                            } ?>
                            <div class="wopb-tab-content<?php if($section == 'changelog'){ echo ' active'; } ?>"><!-- #Changelog Content -->
                                <?php self::get_changelog_data(); ?>
                            </div>
                            <div class="wopb-settings-wrap wopb-submit-button">
                                <div></div><?php echo get_submit_button(); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <script type="text/javascript">
                jQuery( document ).ready(function() {
                    jQuery( document ).on( "click", '.wopb-tab-title', function(e){ 
                        jQuery(this).closest('.wopb-tab-wrap').find('.wopb-tab-title').removeClass('active').eq(jQuery(this).index()).addClass('active')
                        jQuery(this).closest('.wopb-tab-wrap').find('.wopb-tab-content').removeClass('active').eq(jQuery(this).index()).addClass('active');
                        let refresh = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=wopb-option-settings&tab='+jQuery(this).data('title');
                        window.history.pushState({ path: refresh }, '', refresh);
                        jQuery('input[name=_wp_http_referer]').val(window.location.pathname + '?page=wopb-option-settings&tab='+jQuery(this).data('title'));
                    });
                });
            </script>
        </div>

    <?php }


}