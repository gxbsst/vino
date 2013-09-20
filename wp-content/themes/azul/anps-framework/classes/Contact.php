<?php 
include_once 'Framework.php';

class Contact extends Framework {
        
    public function contact_options() {
        return $options = array(
            'text' => 'Text',
            'textarea' => 'Textarea',
            'dropdown' => 'Dropdown',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio',
            'captcha' => 'Captcha'
        );
    }
    
    public function validation_options() {
        return $options = array(
            'none' => 'None', 
            'email' => 'Email', 
            'number' => 'Number', 
            'phone' => 'phone', 
            'text_only' => 'Text only'
        );
    }
    
    public function get_data() {
        return get_option($this->prefix.'contact');
    }
    
    public function save_data() {
        $j = 0;
        $arr = array();
        foreach ($_POST as $postname => $post) {
            if (strpos($postname, 'label') > -1) {
                $j++;
            }
            if(substr($postname, -1)==$j) {
                $arr[$j-1][substr($postname, 0, -2)] = $post;
            }
        } 

        update_option($this->prefix.'contact', $arr);
        header("Location: themes.php?page=theme_options&sub_page=contact_form");
    }
}
$contact = new Contact();