<?php 

/**
 * Plugin Name: Simple Social Share
 * Plugin URI: https://akash.com
 * Description: This is a professional basement plugin
 * Version: 1.0.0
 * Author: Rajendro
 * Author URI: https://akash.com
 * License: GPL2
 * Text Domain: zoo
 */

 if(!defined('ABSPATH')) {
     die;
 }

 class simple_social_share{

    public function __construct(){
        add_action('admin_menu', [$this, 'simple_social_share_admin']);
        add_action('admin_init', [$this, 'simple_social_share_settings_save']);
    }

    /**
     * Admin Menu Page
     */

     public function simple_social_share_admin(){
        add_menu_page(
            esc_html__('Simple Social Share Settings', 'simple-social-share'),
            esc_html__('Social Share', 'simple-social-share'),
            'manage_options',
            'simple-social-share',
            [$this, 'simple_social_share_settings_callback'],
            'dashicons-admin-settings',
            61
        );
     }

     public function simple_social_share_settings_callback(){
        ?>
        <h1>Simple Social Share Settings</h1>

        <form action="" method="post">
            <?php  
            $message = get_option('custom_message');
            
           if(!array($message)){
            $message =[
                'user_name' => '',
                'user_email' => '',
                'user_textarea' => '',
            ];
           }

           echo "<p>" . esc_html($message['user_name']) . "</p>";
           echo "<p>" . esc_html($message['user_email']) . "</p>";
           echo "<p>" . esc_html($message['user_textarea']) . "</p>";
            
            ?>  
            <input type="text" name="custom_message[user_name]" value="<?php echo esc_attr($message['user_name']); ?>" placeholder="inter your text.." /><br><br>
            <input type="email" name="custom_message[user_email]" value="<?php echo esc_attr($message['user_email']); ?>" placeholder="inter your email.." /><br><br>
            <textarea name="custom_message[user_textarea]" id="" placeholder="Enter your message" ></textarea>

            <?php  submit_button('Save', 'primary', 'my_form_submit'); ?>  
        </form>

        <?php
     }

     public function simple_social_share_settings_save(){
        
        
        if(isset($_POST['my_form_submit']) && !empty($_POST['custom_message'])){

            $settings = [
                'user_name' => sanitize_text_field($_POST['custom_message']['user_name']),
                'user_email' => sanitize_email($_POST['custom_message']['user_email']),
                'user_textarea' => sanitize_textarea_field($_POST['custom_message']['user_textarea']),
            ];

            update_option('custom_message', $settings);
        }
     }


 }

 new simple_social_share();