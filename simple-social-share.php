<?php
/**
 * Plugin Name: Zoo Practice
 * Plugin URI: https://akash.com
 * Description: This is a professional basement plugin
 * Version: 1.0.0
 * Author: Akash
 * Author URI: https://akash.com
 * License: GPL2
 * Text Domain: zoo-practice
 */

 class zoo_practice{
    public function __construct()
    {
      add_action('admin_menu', [$this, 'zoo_practice_setting']);
      add_action('admin_init', [$this, 'zoo_boss_save']);
      add_action('the_content', [$this, 'zoo_display_data']);
    }

    /**
     * Admin menu
    */

    public function zoo_practice_setting(){
      add_menu_page(
        esc_html__('Zoo Boss', 'zoo-practice'),
        esc_html__('Zoo Boss', 'zoo-practice'),
        'manage_options',
        'zoo-boss',
        [$this, 'zoo_boss_setting'],
        'dashicons-admin-generic',
        61
      );
    }

    public function zoo_boss_setting(){
     ?>
     <h1>Practice Form</h1>

     <form action="" method="post">
      <?php
      $messege = get_option('zoo_name');
      
      // echo $messege;
      echo '<pre>';
      print_r( $messege);
      echo '</pre>';
      

      $user_name = isset($messege['user_name']) ? $messege['user_name'] : '';
      $user_email = isset($messege['user_email']) ? $messege['user_email'] : '';
      $user_textarea = isset($messege['user_textara']) ? $messege['user_textara'] : '';
      $user_number = isset($messege['number_input']) ? $messege['number_input'] : '';
      $user_password = isset($messege['password_input']) ? str_repeat('*', strlen($messege['password_input'])) : '';
      
      ?>
        <table class="form-table">
            <!-- Text Input -->
            <tr>
                <th scope="row">
                    <label for="text_input">Text Input:</label>
                </th>
                <td>
                    <input type="text" name="zoo_name[user_name]" value="<?php echo esc_attr($user_name); ?>" placeholder="inter your name.."><br> <br>
                </td>
            </tr>
            
            <!-- Number Input -->
            <tr>
                <th scope="row">
                    <label for="number_input">Number Input:</label>
                </th>
                <td>
                    <input type="number" name="zoo_name[number_input]" value="<?php echo esc_attr($user_number); ?>" id="number_input" class="regular-text">
                </td>
            </tr>

            <!-- Email Input -->
            <tr>
                <th scope="row">
                    <label for="email_input">Email:</label>
                </th>
                <td>
                <input type="email" name="zoo_name[user_email]" value="<?php echo esc_attr($user_email); ?>" placeholder="inter your name.."><br> <br>
                </td>
            </tr>

            <!-- Password Input -->
            <tr>
                <th scope="row">
                    <label for="password_input">Password:</label>
                </th>
                <td>
                    <input type="password" name="zoo_name[password_input]" value="<?php echo esc_attr($user_password); ?>" id="password_input" class="regular-text">
                </td>
            </tr>

            <!-- Textarea -->
            <tr>
                <th scope="row">
                    <label for="textarea_input">Textarea:</label>
                </th>
                <td>
                  <textarea name="zoo_name[user_textara]" id=""><?php echo esc_html($user_textarea); ?></textarea><br> <br>
                </td>
            </tr>
        </table>


      <?php submit_button('Update', 'primary', 'submit'); ?>
     </form>

     <?php
    }

    public function zoo_boss_save(){
      if(isset($_POST['submit']) && !empty($_POST['zoo_name'])){
        update_option('zoo_name', $_POST['zoo_name']);
      }
    }

    public function zoo_display_data($content){
        if(is_single()){
            $messege = get_option('zoo_name');

            if(!empty($messege)){
                $user_name = isset($messege['user_name']) ? $messege['user_name'] : '';
                $user_email = isset($messege['user_email']) ? $messege['user_email'] : '';
                $user_textarea = isset($messege['user_textara']) ? $messege['user_textara'] : '';
                $user_number = isset($messege['number_input']) ? $messege['number_input'] : '';
                $user_password = isset($messege['password_input']) ? str_repeat('*', strlen($messege['password_input'])) : '';
            
                $html = '';
                $html .= '<p> Name: '.$user_name.' </p>';
                $html .= '<p> Email: '.$user_email.' </p>';
                $html .= '<p> Textarea: '.$user_textarea.' </p>';
                $html .= '<p> Number: '.$user_number.' </p>';
                $html .= '<p> Password: '.$user_password.' </p>';
    
    
                return $content.= $html;
    
            }
        }
        return $content;
        
    }




 }

 new zoo_practice();