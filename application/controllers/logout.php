<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

  public function index()
  {
    $this->load->helper('url');
    $this->load->library('session');
    $this->session->sess_destroy();
    redirect('/login');
  }
}