<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $data['page_title'] = 'Let Us Dorm';
        
        $this->load->view('site_tier/pages/homepage_view', $data);
    } // ***END index() Method
    
}