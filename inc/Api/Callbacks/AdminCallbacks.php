<?php
/**
 * @package  Cris Plugin
 */

 namespace Inc\Api\Callbacks;

use \Inc\Base\Controller;

 class AdminCallbacks extends Controller{

    public function adminDashboard(){
        return require_once("$this->plugin_path/templates/Dashboard.php");
    }
    public function cptManager(){
        return require_once("$this->plugin_path/templates/CPTmanager.php");
    }
    public function taxonomyManager(){
        return require_once("$this->plugin_path/templates/Taxonomymanager.php");
    }
    public function widgetsManager(){
        return require_once("$this->plugin_path/templates/Widgetsmanager.php");
    }
    public function createEmployee(){
        return require_once("$this->plugin_path/templates/Employees-template.php");
    }
    public function marksView(){
        return require_once("$this->plugin_path/templates/Viewemployees.php");
    }

    public function myOptionsGroup($input){
        return $input;
    }
    public function myAdminSection(){
        echo 'This is the first Section.';
    }
    public function myFirstName(){
        $value = esc_attr(get_option('first_name'));
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write First Name here">';
    }
    public function myLastName(){
        $value = esc_attr(get_option('last_name'));
        echo '<input type="text" class="regular-text" name="last_name" value="' . $value . '" placeholder="Write Last Name here">';
    }
 }