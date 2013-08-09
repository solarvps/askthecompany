<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

  function Login()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    if ( $this->session->userdata('logged_in') == true )
      redirect('/admin');
  }

  function index()
  {
    $this->load->view('login/form');
  }

  function auth()
  {
    $this->load->helper('url');
    $this->load->library('adldap');

    $username = $this->input->post('username');
    $password = $this->input->post('password');

    if ($username && $password)
    {
      if ( $this->adldap->authenticate($username, $password) )
      {

        if ( in_array($username, $this->config->config['admins'] ) )
        {
          $this->session->set_userdata(array('logged_in' => true, 'username' => $username));
          redirect('/admin');
        }
        else
        {
          $this->session->set_flashdata('loginError', 'You should not be here');
          $this->load->view('login/form');
        }

      }
      else
      {
        $this->session->set_flashdata('loginError', 'Invalid Credentials');
        $this->load->view('login/form');
      }
    }
    else
    {
      $this->session->set_flashdata('loginError', 'Missing Credentials');
      $this->load->view('login/form');
    }

  }
}