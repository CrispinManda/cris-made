<?php
/**
 * @package  Cris Plugin
 */

 namespace Inc\Pages;

 use \Inc\Api\SettingsApi;
 use \Inc\Api\Callbacks\AdminCallbacks;
 
 class Admin{

   public $settings;

   public $callbacks;

   public $pages = array();

   public $subpages = array();

   public function register(){
      $this->settings = new SettingsApi();

      $this->callbacks = new AdminCallbacks();

      $this->setPages();

      $this->setSubPages();

      $this->createSettings();

      $this->createSections();

      $this->createFields();

      $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();
   }

  public function setPages(){

   $this->pages = array(
      [
      'page_title'   =>    'Cris Dashboard',
      'menu_title'   =>    'Cris_Plugin',
      'capability'   =>    'manage_options',
      'menu_slug'    =>    'my_plugin_page',
      'callback'     =>    array( $this->callbacks, 'adminDashboard' ),
      'icon_url'     =>    'dashicons-admin-site-alt',
      'position'     =>    110
      ]

   );

  }
  public function setSubPages(){

   $this->subpages = array(
      [
         'parent_slug'  =>   'my_plugin_page',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'CPT',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'my_cpt',
         'callback'     =>   array($this->callbacks, 'cptManager'),
      ],
      [
         'parent_slug'  =>   'my_plugin_page',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'Taxonomies',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'my_taxonomies',
         'callback'     =>   array($this->callbacks, 'taxonomyManager'),
      ],
      [
         'parent_slug'  =>   'my_plugin_page',
         'page_title'   =>   'Custom Post Types',
         'menu_title'   =>   'Widgets',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'my_widgets',
         'callback'     =>   array($this->callbacks, 'widgetsManager'),
      ],
      [
         'parent_slug'  =>   'my_plugin_page',
         'page_title'   =>   'Create Employee',
         'menu_title'   =>   'Create Employee',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'create_employee',
         'callback'     =>   array($this->callbacks, 'createEmployee'),
      ],
      [
         'parent_slug'  =>   'my_plugin_page',
         'page_title'   =>    'View Employees',
         'menu_title'   =>   'View Employees',
         'capability'   =>   'manage_options',
         'menu_slug'    =>   'View Employees',
         'callback'     =>   array($this->callbacks, 'marksView'),
      ]

   );

  }

  public function createSettings(){
   $params = array(
      array(
         'option_group'    =>    'my_options_group',
         'option_name'     =>    'first_name',
         'callback'        =>    array($this->callbacks, 'myOptionsGroup')
      ),
      array(
         'option_group'    =>    'my_options_group',
         'option_name'     =>    'last_name',
         'callback'        =>    array($this->callbacks, 'myOptionsGroup')
      )
   );
   $this->settings->setSettings($params);
  }

  public function createSections(){
   $params = array(
      array(
         'id'           =>    'my_admin_index',
         'title'        =>    'Settings',
         'callback'     =>    [$this->callbacks, 'myAdminSection'],
         'page'         =>    'my_features'
      )
   );
   $this->settings->setSections($params);
  }

  public function createFields(){
   $params = array(
      array(
         'id'           =>    'first_name', //get from create settings option_name
         'title'        =>    'First Name',
         'callback'     =>    [$this->callbacks, 'myFirstName'],
         'page'         =>    'my_features',
         'section'      =>    'my_admin_index', //section id from create section id
         'args'         =>    [
            'label_for'    =>    'my_example',
            'class'        =>    'example_class'
         ]
         ),
         array(
            'id'           =>    'last_name', //get from create settings option_name
            'title'        =>    'Last Name',
            'callback'     =>    [$this->callbacks, 'myLastName'],
            'page'         =>    'my_features',
            'section'      =>    'wilson_admin_index', //section id from create section id
            'args'         =>    [
               'label_for'    =>    'my_example',
               'class'        =>    'example_class'
            ]
         )
   );
   $this->settings->setFields($params);
  }

}