<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions extends CI_Controller {

  public function index()
  {
    $this->load->view('questions/index');
  }

  public function create()
  {
    $this->load->database();
    $this->load->library('email');

    $question = $this->input->post('question');
    $name = $this->input->post('name') ?: "Anonymous";

    if ( $question )
    {
      // Insert into Table
      $this->db->insert('questions', array('question' => $question, 'name' => $name));

      // Email
      $this->email->from('noreply@fortressitx.com', 'New Question Alert');
      $this->email->to( $this->config->config['alertContacts'] );
      $this->email->subject('Someone asked a question...');
      $this->email->message("\r\n\r\nThis question is from $name.\r\n\r\n" . $question . "\r\n\r\n");
      // End Email

      if ( $this->email->send() )
      {
        $jsonResponse['status'] = 'Success';

        $this->output
          ->set_content_type('application/json')
          ->set_output(json_encode(array($jsonResponse)));

      }
    }
  }
}
